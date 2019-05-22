<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Australia/Sydney');  
        $this->load->model('Loan_model');        
    }

	function index() {

        $data = array();
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('fullName', 'Full name', 'required');
        $this->form_validation->set_rules('contactNo', 'Contact number', 'required');
        $this->form_validation->set_rules('postCode', 'Postcode', 'required');
        
        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {
            
            $userData['email'] = $this->input->post('email');
            $userData['fullName'] = $this->input->post('fullName');
            $userData['contactNo'] = $this->input->post('contactNo');
            $userData['postcode'] = $this->input->post('postCode');
            $userData['crd'] = date('Y-m-d H:i:s');
            
            $isLoggedIn = $this->Loan_model->registerMember($userData);
            if(is_string($isLoggedIn) && $isLoggedIn=="AE"){
                $message = "User already exist.";
                $this->session->set_flashdata('error', $message);
                redirect('loan');        
                
            } elseif($isLoggedIn==true){
                $message = "You are registered successfully.";
                $this->session->set_flashdata('success', $message);
                redirect('loan');

            } else {
                $message = "Something going wrong";
                $this->session->set_flashdata('error', $message);
            }   
        }

        $this->template->build('home_loan',$data);
	}

    function checkCNO(){

        $isCheck = $this->Loan_model->checkCNO($this->input->get('contactNo'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    function checkEmail(){

        $isCheck = $this->Loan_model->checkEmail($this->input->get('email'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }
   
}
