<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Promotion_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function createPromotion($data) {
        if($this->db->insert('promotion', $data)) {
            $insertId = $this->db->insert_id();
            return $insertId;
        } else {
            return FALSE;
        }
    }

    public function retrievePromotionByMemberId($memberId){
        $this->db->where('memberId', $memberId);
        $this->db->order_by('promotionId DESC');
        return $query = $this->db->get('promotion');
    }

    public function retrievePromotionByHotelId($hotelId){
        $this->db->where('hotelId', $hotelId);
        $this->db->order_by('promotionId DESC');
        return $query = $this->db->get('promotion');
    }

    public function retrievePromotionByPromotionCode($promotionCode){
        $this->db->where('promotionCode', $promotionCode);
        $this->db->order_by('promotionId DESC');
        return $query = $this->db->get('promotion');
    }
}
/* End of file Promotion_model.php */