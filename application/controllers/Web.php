<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends Public_Controller
{

    function __construct(){
        parent::__construct();
        
        //相關參數設定
        $this->load->library('form_validation');
        $this->load->model('location_model');
        $this->load->model('landmark_model');
        $this->load->model('promotion_model');
    }

    public function index() {
        //相關參數設定
        $this->data['view'] = 'indexView';
        $this->data['contentData'] = null;

        //location參數
        $this->data['locationCountry'] = $this->location->getCountry();
        $this->data['locationCity'] = $this->location->getCity(1);

        $this->load->view(WEB_TEMPLATE, $this->data);
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

    public function getArea() {
        $countryId = $this->input->post('countryId');
        $stateId = $this->input->post('stateId');
        $cityId = $this->input->post('cityId');

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

    public function setAlreadySeenOnoNoticeCookie() {
        //檢查是否為ajax
        if(!$this->input->is_ajax_request()) {
            $this->session->set_flashdata('errorMessage', '<span>錯誤的操作方式，請依正常方式操作<span>');
            redirect('/', 'refresh');
        }

        //設定回傳物件
        $resultObj = new stdClass;

        //設定cookie
        set_cookie('alreadySeenOnoNotice', 'Y', 60 * 60 * 24 * 365);

        //回傳json
        echo(json_encode($resultObj, JSON_UNESCAPED_UNICODE));
    }
}
/* End of file wep.php */