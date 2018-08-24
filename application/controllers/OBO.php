<?php defined('BASEPATH') OR exit('No direct script access allowed');

class OBO extends Public_Controller {
    //一次性簽約驗證參數
    private $isOneTimeContract = FALSE;
    //搜尋半徑
    private $searchRadius = 0;

    function __construct(){
        parent::__construct();
        //相關參數設定
        $this->load->model('hotel_model');
        $this->load->model('promotion_model');
        $this->load->model('landmark_model');
    }

    public function filter() {
        //相關參數設定
        $this->data['view'] = 'OBO/filterView';
        $this->data['contentData'] = null;
        $this->data['isValidateMember'] = 'N';

        //檢查輸入
        $this->form_validation->set_rules('landmark','landmark','required');
        $this->form_validation->set_rules('startDate','startDate','required');
        $this->form_validation->set_rules('endDate','endDate','required');
        $this->form_validation->set_rules('people','people','required');
        $this->form_validation->set_rules('room','room','required');

        if($this->form_validation->run() === TRUE){
            //檢查日期區間
            if(strtotime($this->input->post('startDate') . ' 24:00') < time() || strtotime($this->input->post('endDate') . ' 24:00') < time()) {
                $this->session->set_flashdata('errorMessage', '日期不可小於今日！');
                redirect('/', 'refresh');
            }

            if($this->input->post('startDate') > $this->input->post('endDate') || $this->input->post('startDate') == $this->input->post('endDate')) {
                $this->session->set_flashdata('errorMessage', '日期區間格式錯誤！');
                redirect('/', 'refresh');
            }

            //取得座標範圍
            if(is_null($this->input->post('searchRadius'))) {
                $this->searchRadius = SEARCH_RADIUS;
            } else {
                $this->searchRadius = $this->input->post('searchRadius');
            }
            $landmark = $this->landmark_model->retrieveLandmarkById($this->input->post('landmark'))->row();
            $bound = $this->getCoordinateBound($landmark->landmarkLat, $landmark->landmarkLng, $this->searchRadius);

            //設定搜尋條件並取得searchResult物件
            $search = array(
                'enabled' => 'Y',
                'hotelLat <=' => $bound->latN,
                'hotelLat >=' => $bound->latS,
                'hotelLng <=' => $bound->lngE,
                'hotelLng >=' => $bound->lngW,
                'isOBO' => 'Y'
            );

            $searchResult = $this->search($search, $this->input->post('startDate'), $this->input->post('endDate'), $landmark);

            if(!$this->input->is_ajax_request()) {
                //設定其餘searchResult屬性
                $searchResult->countryId = $this->input->post('country') ? $this->input->post('country') : 0;
                $searchResult->stateId = $this->input->post('state') ? $this->input->post('state') : 0;
                $searchResult->cityId = $this->input->post('city') ? $this->input->post('city') : 0;
                $searchResult->landmarkId = $this->input->post('landmark') ? $this->input->post('landmark') : 0;
                $searchResult->startDate = $this->input->post('startDate');
                $searchResult->endDate = $this->input->post('endDate');
                $searchResult->people = $this->input->post('people');
                $searchResult->room = $this->input->post('room');
                //location參數
                $this->data['locationCountry'] = $this->location->getCountry();
                $this->data['locationState'] = $this->location->getState($searchResult->countryId);
                $this->data['locationCity'] = $this->location->getCity($searchResult->countryId, $searchResult->stateId);
                // $this->data['landmarkList'] = $this->getLandmark($searchResult->countryId, $searchResult->stateId, $searchResult->cityId);
                //地標參數
                $landMarkSearch = array(
                    'landmarkCountryId' => $searchResult->countryId,
                    'landmarkStateId' => $searchResult->stateId,
                    'landmarkCityId' => $searchResult->cityId
                );
                $this->data['landmarkList'] = $this->landmark_model->retrieveLandmarkListBySearch($landMarkSearch, 'landmarkId DESC', 0, 0)->result();
            }

            $this->data['searchResult'] = $searchResult;
        } else {
            $this->session->set_flashdata('errorMessage', validation_errors());
            redirect('/', 'refresh');
        }


        $this->load->view(WEB_TEMPLATE, $this->data);
    }

    public function namePrice() {
        //相關參數設定
        $this->data['view'] = 'OBO/namePriceView';
        $this->data['contentData'] = null;
        $this->session->unset_userdata('orderConfirmInfo');

        //檢查輸入
        $this->form_validation->set_rules('landmark','landmark','required');
        $this->form_validation->set_rules('startDate','startDate','required');
        $this->form_validation->set_rules('endDate','endDate','required');
        $this->form_validation->set_rules('people','people','required');
        $this->form_validation->set_rules('room','room','required');
        $this->form_validation->set_rules('hotelIds[]','hotelIds','required');
        $this->form_validation->set_rules('minPrice','minPrice','required');
        $this->form_validation->set_rules('maxPrice','maxPrice','required');
        $this->form_validation->set_rules('hotelSubType','hotelSubType','required');
        $this->form_validation->set_rules('searchRadius','searchRadius','required');

        if($this->form_validation->run() === TRUE) {
            //檢查日期區間
            if(strtotime($this->input->post('startDate') . ' 24:00') < time() || strtotime($this->input->post('endDate')) < time()) {
                $this->session->set_flashdata('errorMessage', '日期不可小於今日！');
                redirect('/', 'refresh');
            }

            if($this->input->post('startDate') > $this->input->post('endDate') || $this->input->post('startDate') == $this->input->post('endDate')) {
                $this->session->set_flashdata('errorMessage', '日期區間格式錯誤！');
                redirect('/', 'refresh');
            }

            if($hotelList = $this->validateOboRequest($this->input->post())) {
            } else {
                redirect('/', 'refresh');
            }
        } else {
            $this->session->set_flashdata('errorMessage', validation_errors());
            redirect('/', 'refresh');
        }

        $filterResult = new stdClass;
        $filterResult->countryId = $this->input->post('country') ? $this->input->post('country') : 0;
        $filterResult->stateId = $this->input->post('state') ? $this->input->post('state') : 0;
        $filterResult->cityId = $this->input->post('city') ? $this->input->post('city') : 0;
        $filterResult->landmarkId = $this->input->post('landmark') ? $this->input->post('landmark') : 0;
        $filterResult->startDate = $this->input->post('startDate');
        $filterResult->endDate = $this->input->post('endDate');
        $filterResult->people = $this->input->post('people');
        $filterResult->room = $this->input->post('room');
        $filterResult->minPrice = $this->input->post('minPrice');
        $filterResult->maxPrice = $this->input->post('maxPrice');
        $filterResult->avgPrice = $this->input->post('avgPrice');
        $filterResult->hotelSubType = $this->input->post('hotelSubType');
        $filterResult->oboPrice = $this->input->post('oboPrice');
        $filterResult->searchRadius = $this->input->post('searchRadius');
        $filterResult->removeHotel = $this->input->post('removeHotel');
        $filterResult->hotelList = $hotelList;
        //location參數
        $locationSearch = array(
            'locationCityId' => $filterResult->cityId
        );
        $filterResult->locationInfo = $this->location->getLocationInfo($locationSearch);
        //landmark參數
        $filterResult->landmark = $this->landmark_model->retrieveLandmarkById($this->input->post('landmark'))->row();

        $this->data['filterResult'] = $filterResult;

        $this->load->view(WEB_TEMPLATE, $this->data);
    }

    public function confirmOrder() {
        //檢查session是否已有訂單相關資料(user前往登入後導回)
        if(!$this->session->has_userdata('orderConfirmInfo')) {
            //檢查輸入
            $this->form_validation->set_rules('oboPrice','oboPrice','required');
            $this->form_validation->set_rules('landmark','landmark','required');
            $this->form_validation->set_rules('startDate','startDate','required');
            $this->form_validation->set_rules('endDate','endDate','required');
            $this->form_validation->set_rules('people','people','required');
            $this->form_validation->set_rules('room','room','required');
            $this->form_validation->set_rules('hotelIds[]','hotelIds','required');
            $this->form_validation->set_rules('minPrice','minPrice','required');
            $this->form_validation->set_rules('maxPrice','maxPrice','required');
            $this->form_validation->set_rules('hotelSubType','hotelSubType','required');
            $this->form_validation->set_rules('searchRadius','searchRadius','required');

            if($this->form_validation->run() === TRUE) {
                //檢查日期區間
                if(strtotime($this->input->post('startDate') . ' 24:00') < time() || strtotime($this->input->post('endDate')) < time()) {
                    $this->session->set_flashdata('errorMessage', '日期不可小於今日！');
                    redirect('/', 'refresh');
                }

                if($this->input->post('startDate') > $this->input->post('endDate') || $this->input->post('startDate') == $this->input->post('endDate')) {
                    $this->session->set_flashdata('日期區間格式錯誤！', validation_errors());
                    redirect('/', 'refresh');
                }

                if($hotelList = $this->validateOboRequest($this->input->post())) {
                    $postData = $this->input->post();
                    if(!is_numeric($postData['oboPrice'])) {
                        $this->session->set_flashdata('errorMessage', '你的出價格式異常，請重新喊價');
                        redirect('/', 'refresh');
                    }
                    $this->session->set_userdata('orderConfirmInfo', $postData);
                } else {
                    redirect('/', 'refresh');
                }
            } else {
                $this->session->set_flashdata('errorMessage', validation_errors());
                redirect('/', 'refresh');
            }
        }

        //相關參數設定
        $this->data['view'] = 'OBO/confirmOrderView';
        $this->data['contentData'] = null;
        $postData = $this->session->userdata('orderConfirmInfo');

        //清除session中的折扣碼及折扣價格
        if(isset($postData['promotionCode'])) {
            unset($postData['promotionCode']);
            $this->session->set_userdata('orderConfirmInfo', $postData);
        }
        if(isset($postData['discountPrice'])) {
            unset($postData['promotionCode']);
            $this->session->set_userdata('orderConfirmInfo', $postData);
        }

        if($hotelList = $this->validateOboRequest($postData)) {
        } else {
            redirect('/', 'refresh');
        }

        $orderConfirmInfo = new stdClass;
        $orderConfirmInfo->countryId = $postData['country'] ? $postData['country'] : 0;
        $orderConfirmInfo->stateId = $postData['state'] ? $postData['state'] : 0;
        $orderConfirmInfo->cityId = $postData['city'] ? $postData['city'] : 0;
        $orderConfirmInfo->landmarkId = $postData['landmark'] ? $postData['landmark'] : 0;
        $orderConfirmInfo->startDate = $postData['startDate'];
        $orderConfirmInfo->endDate = $postData['endDate'];
        $orderConfirmInfo->totalDay = abs((strtotime($orderConfirmInfo->startDate) - strtotime($orderConfirmInfo->endDate)) / 86400);
        $orderConfirmInfo->people = $postData['people'];
        $orderConfirmInfo->room = $postData['room'];
        $orderConfirmInfo->minPrice = $postData['minPrice'];
        $orderConfirmInfo->maxPrice = $postData['maxPrice'];
        $orderConfirmInfo->avgPrice = $postData['avgPrice'];
        $orderConfirmInfo->hotelSubType = $postData['hotelSubType'];
        $orderConfirmInfo->hotelList = $hotelList;
        $orderConfirmInfo->oboPrice = $postData['oboPrice'];
        $orderConfirmInfo->totalPrice = $orderConfirmInfo->oboPrice * $orderConfirmInfo->room * $orderConfirmInfo->totalDay;
        $orderConfirmInfo->tax = round($orderConfirmInfo->totalPrice * TAX_RATE);
        $orderConfirmInfo->fees = round($orderConfirmInfo->totalPrice * FEES);
        $orderConfirmInfo->grandTotalPrice = $orderConfirmInfo->totalPrice + $orderConfirmInfo->tax + $orderConfirmInfo->fees;
        $orderConfirmInfo->searchRadius = $postData['searchRadius'];
        if(isset($postData['removeHotel'])) {
            $orderConfirmInfo->removeHotel = $postData['removeHotel'];
        }

        //location參數
        $locationSearch = array(
            'locationCityId' => $orderConfirmInfo->cityId
        );
        $orderConfirmInfo->locationInfo = $this->location->getLocationInfo($locationSearch);
        
        //landmark參數
        $orderConfirmInfo->landmark = $this->landmark_model->retrieveLandmarkById($postData['landmark'])->row();

        //檢查是否有折扣碼cookie
        if(!is_null(get_cookie('promotionCode'))) {
            $this->data['promotionCode'] = get_cookie('promotionCode');
        } else {
            $this->data['promotionCode'] = NULL;
        }

        $this->data['orderConfirmInfo'] = $orderConfirmInfo;
        
        $this->load->view(WEB_TEMPLATE, $this->data);
    }

    public function payment() {
        //相關參數設定
        $this->data['view'] = 'OBO/paymentView';
        $this->data['contentData'] = null;
        $postData = $this->session->userdata('orderConfirmInfo');

        //清除session中的折扣碼及折扣價格
        if(isset($postData['promotionCode'])) {
            unset($postData['promotionCode']);
            $this->session->set_userdata('orderConfirmInfo', $postData);
        }
        if(isset($postData['discountPrice'])) {
            unset($postData['promotionCode']);
            $this->session->set_userdata('orderConfirmInfo', $postData);
        }

        if($hotelList = $this->validateOboRequest($postData)) {
        } else {
            redirect('/', 'refresh');
        }

        $orderConfirmInfo = new stdClass;
        $orderConfirmInfo->countryId = $postData['country'] ? $postData['country'] : 0;
        $orderConfirmInfo->stateId = $postData['state'] ? $postData['state'] : 0;
        $orderConfirmInfo->cityId = $postData['city'] ? $postData['city'] : 0;
        $orderConfirmInfo->landmarkId = $postData['landmark'] ? $postData['landmark'] : 0;
        $orderConfirmInfo->startDate = $postData['startDate'];
        $orderConfirmInfo->endDate = $postData['endDate'];
        $orderConfirmInfo->totalDay = abs((strtotime($orderConfirmInfo->startDate) - strtotime($orderConfirmInfo->endDate)) / 86400);
        $orderConfirmInfo->people = $postData['people'];
        $orderConfirmInfo->room = $postData['room'];
        $orderConfirmInfo->minPrice = $postData['minPrice'];
        $orderConfirmInfo->maxPrice = $postData['maxPrice'];
        $orderConfirmInfo->avgPrice = $postData['avgPrice'];
        $orderConfirmInfo->hotelSubType = $postData['hotelSubType'];
        $orderConfirmInfo->hotelList = $hotelList;
        $orderConfirmInfo->oboPrice = $postData['oboPrice'];
        $orderConfirmInfo->totalPrice = $orderConfirmInfo->oboPrice * $orderConfirmInfo->room * $orderConfirmInfo->totalDay;
        $orderConfirmInfo->tax = round($orderConfirmInfo->totalPrice * TAX_RATE);
        $orderConfirmInfo->fees = round($orderConfirmInfo->totalPrice * FEES);
        $orderConfirmInfo->grandTotalPrice = $orderConfirmInfo->totalPrice + $orderConfirmInfo->tax + $orderConfirmInfo->fees;
        $orderConfirmInfo->searchRadius = $postData['searchRadius'];
        if(isset($postData['removeHotel'])) {
            $orderConfirmInfo->removeHotel = $postData['removeHotel'];
        }

        //location參數
        $locationSearch = array(
            'locationCityId' => $orderConfirmInfo->cityId
        );
        $orderConfirmInfo->locationInfo = $this->location->getLocationInfo($locationSearch);
        
        //landmark參數
        $orderConfirmInfo->landmark = $this->landmark_model->retrieveLandmarkById($postData['landmark'])->row();
        $this->data['orderConfirmInfo'] = $orderConfirmInfo;

        $this->load->view(WEB_TEMPLATE, $this->data);
    }

    public function search($search = NULL, $startDate = NULL, $endDate = NULL, $landmark = NULL) {
        $searchResult = new stdClass;
        //設定default的type
        $filterType = 0;
        $filterGrade = 0;

        //計算個別類別項目的總數以及過濾選項
        if($this->input->is_ajax_request()) {
            $filterType = $this->input->post('hotelSubType');
        } else {
            // $searchResult->filterOptions = $this->getFilterOption($search, $filterType);
        }

        //設定搜尋選項
        if($this->input->is_ajax_request()) {
            //取得座標範圍
            $landmark = $this->landmark_model->retrieveLandmarkById($this->input->post('landmark'))->row();
            $bound = $this->getCoordinateBound($landmark->landmarkLat, $landmark->landmarkLng, $this->input->post('searchRadius'));

            $search = array(
                'enabled' => 'Y',
                'isOBO' => 'Y',
                'hotelLat <=' => $bound->latN,
                'hotelLat >=' => $bound->latS,
                'hotelLng <=' => $bound->lngE,
                'hotelLng >=' => $bound->lngW,
                'hotelSubType' => $this->input->post('hotelSubType'),
                'hotelGrade' => $this->input->post('hotelGrade')
            );

            if($filterType == 0) {
                unset($search['hotelSubType']);
            }

            $filterGrade = $this->input->post('hotelGrade');
            if($filterGrade == 0) {
                unset($search['hotelGrade']);
            }
        } else {
        }

        $orderBy = 'hotelReferanceOBO DESC';
        
        //計算各飯店obo價格調升
        $totalDay = abs((strtotime($startDate) - strtotime($endDate)) / 86400);
        $highPriceDayNum = 0;
        for($i = 0; $i < $totalDay ;$i++) {
            $dateW = date("w", strtotime($startDate . ' +'  . $i . 'day'));
            if($dateW == 5 || $dateW ==6) {
                $highPriceDayNum += 1;  
            }
        }
        $dayAVG = $highPriceDayNum / $totalDay * WEEKEND_OBO_RATIO;
        
        //檢查搜尋結果數量，若未達設定值，則重新搜尋
        $hotelListTemp = $this->hotel_model->retrieveHotelListBySearch($search, $orderBy);
        $oboSearchSize = $hotelListTemp->num_rows();

        if(!$this->input->is_ajax_request()) {
            while($oboSearchSize < MIN_OBO_SEARCH_SIZE && $this->searchRadius < MAX_SEARCH_RADIUS) {
                $this->searchRadius += SEARCH_RADIUS_EXPAND;
                $bound = $this->getCoordinateBound($landmark->landmarkLat, $landmark->landmarkLng, $this->searchRadius);
                $search['hotelLat <='] = $bound->latN;
                $search['hotelLat >='] = $bound->latS;
                $search['hotelLng <='] = $bound->lngE;
                $search['hotelLng >='] = $bound->lngW;

                $hotelListTemp = $this->hotel_model->retrieveHotelListBySearch($search, $orderBy);
                $oboSearchSize = $hotelListTemp->num_rows();
            }
        }

        //搜尋並設定各項參數
        $searchResult->hotelListTemp = $hotelListTemp->result();
        if($this->input->is_ajax_request()) {
            if(count($searchResult->hotelListTemp) < MIN_OBO_SIZE) {
                $searchResult->noResult = 'Y';
                echo(json_encode($searchResult));
                return;
            }
        } else {
            //若為由form搜尋，則判別是否有回傳值，若沒有則更換搜尋條件
            if(count($searchResult->hotelListTemp) < MIN_OBO_SIZE) {
                $searchResult->minOboPrice = 0;
                $searchResult->maxOboPrice = 0;
                return $searchResult; 
            } else {
                $searchResult->filterOptions = $this->getFilterOption($search, $filterType);
            }
        }

        //取得需要的資料放入hotelList後移除tempHotelList，並將list隨機排序
        $searchResult->hotelList = array();
        $oboPriceSum = 0;

        for($i = 0;$i < count($searchResult->hotelListTemp);$i++) {
            $hotel = new stdClass;
            $hotel->hotelId = $searchResult->hotelListTemp[$i]->hotelId;
            $hotel->hotelName = $searchResult->hotelListTemp[$i]->hotelName;
            $hotel->hotelReferanceOBO = round($searchResult->hotelListTemp[$i]->hotelReferanceOBO * (1 + $dayAVG));
            $hotel->hotelLat = $searchResult->hotelListTemp[$i]->hotelLat;
            $hotel->hotelLng = $searchResult->hotelListTemp[$i]->hotelLng;
            $hotel->hotelUrl = $searchResult->hotelListTemp[$i]->hotelUrl;
            $oboPriceSum += $hotel->hotelReferanceOBO;
            array_push($searchResult->hotelList, $hotel);
        }

        $searchResult->filterGrade = $filterGrade;
        $searchResult->searchCenterLat = $landmark->landmarkLat;
        $searchResult->searchCenterLng = $landmark->landmarkLng;
        $searchResult->searchRadius = $this->searchRadius;
        $searchResult->minOboPrice = round($searchResult->hotelList[count($searchResult->hotelList) - 1]->hotelReferanceOBO);
        $searchResult->maxOboPrice = round($searchResult->hotelList[0]->hotelReferanceOBO);

        unset($searchResult->hotelListTemp);
        shuffle($searchResult->hotelList);

        $searchResult->avgOboPrice = round($oboPriceSum / count($searchResult->hotelList));

        if($this->input->is_ajax_request()) {
            echo(json_encode($searchResult));
        } else {
            return $searchResult; 
        }
    }

    //搜尋頁選項設定
    private function getFilterOption($search, $nowOption) {
        $this->load->model('hotel_type_model');

        $filterOptions = new stdClass;
        $filterOptions->options = array();

        $hotelTypeSearch = array();
        $hotelTypeList = $this->hotel_type_model->retrieveHotelType($hotelTypeSearch, 'hotelTypeId ASC')->result();

        foreach ($hotelTypeList as $hotelType) {
            $filterOptions->options[] = $hotelType;
        }

        for($i = 0;$i < count($filterOptions->options);$i++) {
            $filterOptions->options[$i]->id = $filterOptions->options[$i]->hotelTypeId;
            $filterOptions->options[$i]->name = $filterOptions->options[$i]->hotelTypeName;
            unset($filterOptions->options[$i]->hotelTypeId);
            unset($filterOptions->options[$i]->hotelTypeName);
        }

        $typeCount = $this->hotel_model->countSubType($search, $filterOptions->options)->row();

        $optionsSize = count($filterOptions->options);
        for($i = 0;$i < $optionsSize;$i++) {
            $filterOptions->options[$i]->size = $typeCount->{'type_' . $filterOptions->options[$i]->id};
            if($filterOptions->options[$i]->size < MIN_OBO_SIZE) {
                $filterOptions->options[$i]->size = 0;
            }
        }

        $filterOptions->nowOption = $nowOption;

        return $filterOptions;
    }

    public function getCountry() {
        echo(json_encode($this->location->getCountry()));
    }

    public function getState() {
        $countryId = $this->input->post('countryId');
        echo(json_encode($this->location->getState($countryId)));
    }

    public function getCity() {
        $countryId = $this->input->post('countryId');
        $stateId = $this->input->post('stateId');
        echo(json_encode($this->location->getCity($countryId, $stateId)));
    }

    public function getArea(){
        $countryId = $this->input->post('countryId');
        $stateId = $this->input->post('stateId');
        $cityId = $this->input->post('cityId');

        // $areaList = $this->location->getArea($countryId, $stateId, $cityId);

        // echo(json_encode($this->location->getAreaCanObo($areaList)));
        echo(json_encode($this->location->getArea($countryId, $stateId, $cityId)));
    }

    public function getLandmark() {
        $landmarkSearch = array(
            'landmarkCountryId' =>$this->input->post('countryId'),
            'landmarkStateId' =>$this->input->post('stateId'),
            'landmarkCityId' =>$this->input->post('cityId')
        );

        echo(json_encode($this->landmark_model->retrieveLandmarkListBySearch($landmarkSearch, 'landmarkType ASC', 0, 0)->result()));
    }
}
/* End of file OBO.php */