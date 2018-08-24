<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location {

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('location_model');
    }

    public function getCountry(){
        return $this->CI->location_model->retrieveCountry()->result();
    }

    public function getState($countryId = 0) {
        return $this->CI->location_model->retrieveState($countryId)->result();
    }
    
    public function getCity($countryId = 0, $stateId = 0) {
        return $this->CI->location_model->retrieveCity($countryId,$stateId)->result();
    }

    public function getArea($countryId = 0, $stateId = 0, $cityId = 0) {
        return $this->CI->location_model->retrieveArea($countryId,$stateId,$cityId)->result();
    }

    public function getLocationInfo($search) {
        return $this->CI->location_model->retrieveLocationInfoBySearch($search)->row();
    }

    public function getAreaCanObo($areaList) {
        //取得有一口價的地區
        $search = array(
            'hotelCountryId' => $areaList[0]->locationCountryId,
            'hotelStateId' => $areaList[0]->locationStateId,
            'hotelCityId' => $areaList[0]->locationCityId,
            'isOBO' => 'Y'
        );
        $areaOboCount = $this->CI->location_model->countAreaObo($search, $areaList)->row();

        $areaListSize = count($areaList);
        //移除小於最小OBO限制的area
        for($i = 0;$i < $areaListSize;$i++) {
            if($areaOboCount->{'area_' . $areaList[$i]->locationAreaId} < MIN_OBO_SIZE) {
                unset($areaList[$i]);
            }
        }

        return array_values($areaList);   
    }

}

/* End of file Location.php */