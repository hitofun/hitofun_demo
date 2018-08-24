<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Hotel_type_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function retrieveHotelType($search, $orderBy = 'hotelTypeId DESC', $limit = NULL, $offset = NULL) {
        $this->db->where($search);
        $this->db->order_by($orderBy);
        if(!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
        }
        return $query = $this->db->get('hotel_type');
    }

}
/* End of file Hotel_type_model.php */