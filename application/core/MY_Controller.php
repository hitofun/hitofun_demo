<?php defined('BASEPATH') OR exit('No direct script access allowed');

//AWS SDK name space
use Aws\Sns\SnsClient;
use Aws\Credentials\Credentials;

class MY_Controller extends CI_Controller
{

    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->library('My_pagination');
        $this->load->library('Location');
        $this->config->load('hitofun_config');
        $this->data['pageTitle'] = 'HitoFun';
        
        //語系判定
        if(!$this->session->has_userdata('language') && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            //從字串取出語言
            preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
            //將資料轉成小寫並將格式改掉
            $browserLang = mb_ereg_replace('-', '_', strtolower($matches[1]));
            switch ($browserLang) {
                case 'zh_tw':
                    $this->session->set_userdata('language', 'zh_tw');
                    break;
                case 'en':
                    $this->session->set_userdata('language', 'english');
                    break;
                case 'zh_cn':
                    $this->session->set_userdata('language', 'zh_cn');
                    break;
                default:
                    $this->session->set_userdata('language', 'english');
                    break;
            }
        }

        define('DEALER_ID', NULL);
        define('WEB_TEMPLATE', 'template/webTemplate');
        $this->dealerId = 0;

        $this->lang->load('hitofun_web', $this->session->userdata('language'));

        //設定時區
        date_default_timezone_set('Asia/Taipei');

        //OBO尋房旅館間數最小值
        define('MIN_OBO_SIZE', $this->config->item('MIN_OBO_SIZE'));

        //OBO入住及退房時間
        define('OBO_CHECK_IN_TIME', $this->config->item('OBO_CHECK_IN_TIME'));
        define('OBO_CHECK_OUT_TIME', $this->config->item('OBO_CHECK_OUT_TIME'));

        //稅率
        define('TAX_RATE', $this->config->item('TAX_RATE'));
        define('FEES', $this->config->item('FEES'));

        //OBO價格保護倍率
        define('OBO_PROTECTION_RATIO', $this->config->item('OBO_PROTECTION_RATIO'));

        //OBO尋房時限
        define('OBO_REQUIRE_TIME', $this->config->item('OBO_REQUIRE_TIME'));

        //OBO長期合約commission
        define('LONG_TERM_CONTRACT_COMMISSION', $this->config->item('LONG_TERM_CONTRACT_COMMISSION'));

        //OBO一次性合約commission
        define('ONE_TIME_CONTRACT_COMMISSION', $this->config->item('ONE_TIME_CONTRACT_COMMISSION'));

        //長期合約type
        define('LONG_TERM_CONTRACT_TYPE', $this->config->item('LONG_TERM_CONTRACT_TYPE'));

        //一次性合約type
        define('ONE_TIME_CONTRACT_TYPE', $this->config->item('ONE_TIME_CONTRACT_TYPE'));

        //週末obo倍率
        define('WEEKEND_OBO_RATIO', $this->config->item('WEEKEND_OBO_RATIO'));

        //預設搜尋半徑
        define('SEARCH_RADIUS', $this->config->item('SEARCH_RADIUS'));

        //預設搜尋半徑擴大距離
        define('SEARCH_RADIUS_EXPAND', $this->config->item('SEARCH_RADIUS_EXPAND'));

        //最大搜尋半徑
        define('MAX_SEARCH_RADIUS', $this->config->item('MAX_SEARCH_RADIUS'));

        //最少搜尋旅館家數
        define('MIN_OBO_SEARCH_SIZE', $this->config->item('MIN_OBO_SEARCH_SIZE'));

        //最多搜尋旅館家數
        define('MAX_OBO_SEARCH_SIZE', $this->config->item('MAX_OBO_SEARCH_SIZE'));

        //設定頁面cache
        $this->output->set_header('Cache-control: private');

        //設定跨域存取
        $this->output->set_header('Access-Control-Allow-Origin: ' . base_url());

        //測試帳號
        $this->testAccount = $this->config->item('testAccount');

        //合約推廣帳號
        $this->marketingAccount = $this->config->item('marketingAccount');

        //旅館業者後台預設群組權限
        $this->defaultHotelierGroups = array(3, 6, 12, 15, 16, 17, 18);

        //租車業者後台預設群組權限
        $this->defaultCarRentalGroups = array(1, 2, 3);
    }

    protected function getAllColumn($tableName) {
        return $this->db->list_fields($tableName);
    }

    protected function validateOboRequest($post) {
        $this->load->model('hotel_model');
        $this->load->model('landmark_model');

        //檢查輸入資料是否符合OBO條件
        //檢查輸入的旅館家數是否小於四家
        if(count($post['hotelIds']) < MIN_OBO_SIZE) {
            $this->session->set_flashdata('errorMessage', '篩選的旅館不可小於' . MIN_OBO_SIZE . '家');
            return FALSE;
        }
        //計算各飯店obo價格調升
        $startDate = $post['startDate'];
        $endDate = $post['endDate'];
        $totalDay = abs((strtotime($startDate) - strtotime($endDate)) / 86400);
        $highPriceDayNum = 0;
        for($i = 0; $i < $totalDay ;$i++) {
            $dateW = date("w", strtotime($startDate . ' +'  . $i . 'day'));
            if($dateW == 5 || $dateW ==6) {
                $highPriceDayNum += 1;
            }
        }
        $dayAVG = $highPriceDayNum / $totalDay * WEEKEND_OBO_RATIO;

        //取得座標範圍
        $landmark = $this->landmark_model->retrieveLandmarkById($post['landmark'])->row();
        $bound = $this->getCoordinateBound($landmark->landmarkLat, $landmark->landmarkLng, $post['searchRadius']);
        
        //檢查輸入的旅館id與其他篩選條件是否符合
        $search = array(
            'enabled' => 'Y',
            'isOBO' => 'Y',
            'hotelLat <=' => $bound->latN,
            'hotelLat >=' => $bound->latS,
            'hotelLng <=' => $bound->lngE,
            'hotelLng >=' => $bound->lngW,
            // 'hotelAreaId' => $post['area'],
            'hotelSubType' => $post['hotelSubType'],
            'hotelReferanceOBO * (1 +' . $dayAVG . ' ) >=' => $post['minPrice'],
            'hotelReferanceOBO * (1 +' . $dayAVG . ' ) <=' => $post['maxPrice']
        );
        if($search['hotelSubType'] == 0) {
            unset($search['hotelSubType']);
        }

        $hotelList = $this->hotel_model->retrieveHotelListBySearch($search)->result();

        if(isset($post['removeHotel'])) {
            $removeHotel = $post['removeHotel'];
            for($i = 0;$i < count($removeHotel);$i++) {
                foreach ($hotelList as $key => $value) {
                    if($removeHotel[$i] == $hotelList[$key]->hotelId) {
                        unset($hotelList[$key]);
                        break;
                    }
                }
            }
        }
        
        if(count($hotelList) != count($post['hotelIds'])) {
            $this->session->set_flashdata('errorMessage', '篩選資料異常，請重新篩選');
            return FALSE;
        }

        return $hotelList;
    }

    protected function getClientIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    //更換語系
    public function changeLanguage($language) {
        $this->session->set_userdata('language', $language);
        echo(json_encode('true'));
    }

    //座標範圍計算
    protected function getCoordinateBound($centerLat, $centerLng, $radius) {

        $degree = (24901 * 1609) / 360.0;

        $dpmLat = 1 / $degree;
        $radiusLat = $dpmLat * $radius;
        $latN = $centerLat + $radiusLat;
        $latS = $centerLat - $radiusLat;

        $dpmLng = 1 / $degree * cos($centerLat * (M_PI / 180));
        $radiusLng = $dpmLng * $radius;
        $lngE = $centerLng + $radiusLng;
        $lngW = $centerLng - $radiusLng;


        $bound = new stdClass;
        $bound->latN = $latN;
        $bound->latS = $latS;
        $bound->lngE = $lngE;
        $bound->lngW = $lngW;

        return $bound;
    }
}

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}
/* End of file MY_Controller.php */