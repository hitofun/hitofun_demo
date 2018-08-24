<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Hotel_model extends CI_Model {

    function __construct(){
        parent::__construct();

        $updateUser = NULL;
        $updateUserHotelier = NULL;
        $updateUser = 0;
        $this->logData = array(
            'updateUser' => $updateUser,
            'updateUserHotelier' => $updateUserHotelier,
            'updateDate' => date('Y-m-d H:i:s')
        );
    }

    public function countType($search, $tabs) {
        $selectStr = '';
        foreach($tabs as $tab) {
            $selectStr .= 'SUM(CASE WHEN hotelType = ' . $tab->id . ' THEN 1 ELSE 0 END) AS type_' . $tab->id . ',';
        }
        $selectStr = substr($selectStr, 0, -1);

        //如果有設定userId及powerUserId，修改where
        if(isset($search['userId']) && isset($search['powerUserId'])) {
            $this->db->where('(userId = ' . $search['userId'] . ' OR powerUserId = ' . $search['powerUserId'] . ')');
            unset($search['userId']);
            unset($search['powerUserId']);
        }
        //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->like('hotelName', $search['searchText']);
            $this->db->or_like('hotelFullAddress', $search['searchText']);
            unset($search['searchText']);
        }
        //如果有指定要有email，修改where
        if(isset($search['hasEmail'])) {
            $this->db->where('(hotelEmail IS NOT NULL OR hotelCotactEmail IS NOT NULL OR hotelReservationEmail IS NOT NULL)');
            unset($search['hasEmail']);
        }
        $this->db->select($selectStr);
        $this->db->where($search);
        return $query = $this->db->get('hotel_view');
    }

    public function countSubType($search, $tabs) {
        $selectStr = '';
        foreach($tabs as $tab) {
            $selectStr .= 'SUM(CASE WHEN FIND_IN_SET(' . $tab->id . ', hotelSubType)' . ' THEN 1 ELSE 0 END) AS type_' . $tab->id . ',';
        }
        $selectStr = substr($selectStr, 0, -1);

        //如果有設定userId及powerUserId，修改where
        if(isset($search['userId']) && isset($search['powerUserId'])) {
            $this->db->where('(userId = ' . $search['userId'] . ' OR powerUserId = ' . $search['powerUserId'] . ')');
            unset($search['userId']);
            unset($search['powerUserId']);
        }
        //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->like('hotelName', $search['searchText']);
            $this->db->or_like('hotelFullAddress', $search['searchText']);
            unset($search['searchText']);
        }
        //如果有指定要有email，修改where
        if(isset($search['hasEmail'])) {
            $this->db->where('(hotelEmail IS NOT NULL OR hotelCotactEmail IS NOT NULL OR hotelReservationEmail IS NOT NULL)');
            unset($search['hasEmail']);
        }
        $this->db->select($selectStr);
        $this->db->where($search);
        return $query = $this->db->get('hotel_view');
    }

    public function retrieveHotelById($hotelId) {
        $this->db->where('hotelId', $hotelId);
        return $query = $this->db->get('hotel_view');
    }

    public function retrieveHotelListBySearch($search, $orderBy = 'hotelId DESC', $limit = NULL, $offset = NULL) {
        //如果有設定userId及powerUserId，修改where
        if(isset($search['userId']) && isset($search['powerUserId'])) {
            $this->db->where('(userId = ' . $search['userId'] . ' OR powerUserId = ' . $search['powerUserId'] . ')');
            unset($search['userId']);
            unset($search['powerUserId']);
        }
        //如果有設定subType，修改where
        if(isset($search['hotelSubType'])) {
            $this->db->where('FIND_IN_SET(' . $search['hotelSubType'] . ', hotelSubType)');
            unset($search['hotelSubType']);
        }
        //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->group_start();
            $this->db->like('hotelName', $search['searchText']);
            $this->db->or_like('hotelFullAddress', $search['searchText']);
            $this->db->group_end();
            unset($search['searchText']);
        }
        //如果有指定要有email，修改where
        if(isset($search['hasEmail'])) {
            $this->db->where('((hotelEmail IS NOT NULL AND hotelEmail != \'\') OR (hotelCotactEmail IS NOT NULL AND hotelCotactEmail != \'\') OR (hotelReservationEmail IS NOT NULL AND hotelReservationEmail != \'\'))');
            unset($search['hasEmail']);
        }
        //如果有設定特定旅館id，修改where
        if(isset($search['hotelIds'])) {
            $this->db->where_in('hotelId', $search['hotelIds']);
            unset($search['hotelIds']);
        }
        $this->db->where($search);
        $this->db->order_by($orderBy);
        if(!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
        }

        return $query = $this->db->get('hotel_view');
    }

    public function retrieveHotelPropertyByHolteId($hotelId) {
        $this->db->where('hotelId', $hotelId);
        return $query = $this->db->get('hotel_property');
    }

    private function updateLog($hotelId, $action) {
        $this->logData['hotelId'] = $hotelId;
        $this->logData['action'] = $action;
        $this->db->insert('log_hotel', $this->logData);
    }

}
/* End of file hotel_model.php */