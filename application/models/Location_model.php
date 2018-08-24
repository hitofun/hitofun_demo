<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Location_model extends CI_Model {

    function __construct(){
        parent::__construct();
       
    }
     //從資料庫拿國家~州~城市~行政區的資訊
    public function retrieveCountry(){
        return $query = $this->db->get('location_country');
    }

    public function retrieveState($countryId = 0) {
        $this->db->where('locationCountryId', $countryId);
        return $query = $this->db->get('location_state');
    }
    
    public function retrieveCity($countryId = 0, $stateId = 0) {
        $this->db->where('locationCountryId', $countryId);
        $this->db->where('locationStateId', $stateId);
        return $query = $this->db->get('location_city');
    }

    public function retrieveArea($countryId = 0, $stateId = 0, $cityId = 0) {
        $this->db->where('locationCountryId', $countryId);
        $this->db->where('locationStateId', $stateId);
        $this->db->where('locationCityId', $cityId);
        $query = $this->db->get('location_area');
        return $query;

    }

    public function retrieveLocationInfoBySearch($search) {
        $this->db->where($search);
        return $query = $this->db->get('location_view');
    }

    //取得每個area中OBO旅館的數量
    public function countAreaObo($search, $areaList) {
        $selectStr = '';
        foreach($areaList as $area) {
            $selectStr .= 'SUM(CASE WHEN hotelAreaId = ' . $area->locationAreaId . ' THEN 1 ELSE 0 END) AS area_' . $area->locationAreaId . ',';
        }
        $selectStr = substr($selectStr, 0, -1);

        $this->db->select($selectStr);
        $this->db->where($search);

        return $query = $this->db->get('hotel');
    }
}
/* End of file hotel_model.php */