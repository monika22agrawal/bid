<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Australia/Sydney');  
        $this->load->model('home/user_model');        
    }

	function index() {

        $data['property'] = $this->user_model->getAllProducts();		
		$this->template->build('home',$data);
	}

    function checkApproval(){
        $data = $this->user_model->checkApproval($this->input->post('id'));
        echo $data;
    }

    function bidTimeExpire(){
        
        $data = $this->user_model->bidTimeExpire();
        if($data):
            echo "success";
        else :
            echo "Fail";
        endif;
    }

    function uploadDocTimeExpire(){
        
        $data = $this->user_model->uploadDocTimeExpire();
        if($data):
            echo "success";
        else :
            echo "Fail";
        endif;
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }

    function aboutUs(){
        $this->template->build('about_us');
    }

    function contactUs(){
        $this->template->build('contact_us');
    }
    
}
