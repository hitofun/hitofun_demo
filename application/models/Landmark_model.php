<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Landmark_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $updateUser = 0;
        $this->logData = array(
            'updateUser' => $updateUser,
            'updateDate' => date('Y-m-d H:i:s')
        );
    }

    public function countType($search, $tabs) {
        $selectStr = '';
        foreach($tabs as $tab) {
            $selectStr .= 'SUM(CASE WHEN landmarkType = ' . $tab->id . ' THEN 1 ELSE 0 END) AS type_' . $tab->id . ',';
        }
        $selectStr = substr($selectStr, 0, -1);

        //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->like('landmarkName', $search['searchText']);
            unset($search['searchText']);
        }
        $this->db->select($selectStr);
        $this->db->where($search);
        return $query = $this->db->get('landmark');
    }

    public function countLandmark($search) {
        //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->like('landmarkName', $search['searchText']);
            unset($search['searchText']);
        }
        $this->db->where($search);
        return $query = $this->db->count_all_results('landmark');
    }
   
    public function retrieveLandmarkListBySearch($search, $orderBy = '  landmarkId  DESC', $limit = 10, $offset = 0) {
    //如果有搜尋字串，則搜尋指定欄位
        if(isset($search['searchText'])) {
            $this->db->like('landmarkName', $search['searchText']);
            unset($search['searchText']);
        }
        $this->db->where($search);
        $this->db->order_by($orderBy);
        $this->db->limit($limit, $offset);
        return $query = $this->db->get('landmark');
    }

    public function retrieveLandmarkById($landmarkId){
        $this->db->where('landmarkId', $landmarkId);
        return $query = $this->db->get('landmark');
    }

    private function updateLog($landmarkId, $action) {
        $this->logData['landmarkId'] = $landmarkId;
        $this->logData['action'] = $action;
        $this->db->insert('log_landmark', $this->logData);
    }
}
/* End of file Landmark_model.php */