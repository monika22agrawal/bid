<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        if($this->session->userdata('front_login')){
            redirect(base_url('home'));
        }
        $this->load->model('User_model');
    }
    
	function index()
	{
        $data = array();
		$this->load->library('form_validation');
       
        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {
            
            $userData['email'] = $this->input->post('email');
            $userData['password'] = $this->input->post('password');
            $userData['userType'] = $this->input->post('userType');
            
            $isLoggedIn = $this->User_model->login($userData);
            if(is_string($isLoggedIn) && $isLoggedIn=="LS"){
                /*remember me*/
                $email = $this->input->post("email");
                $password = $this->input->post("password");
                
                $remember = $this->input->post('rem');
                if($remember == 1) {    // if user check the remember me checkbox       
                    setcookie('email', $email, time()+60*60*24*100, "/");
                    setcookie('password', $password, time()+60*60*24*100, "/");
                } else {   // if user not check the remember me checkbox
                    setcookie('email', ' ', time()-60*60*24*100, "/");          
                    setcookie('password', ' ', time()-60*60*24*100, "/");          
                }

                $message = "Logged in successfully";
                $this->session->set_flashdata('success', $message);
                if($this->session->userdata('userType') == 1)
                    redirect('seller/sellerHome');
                if($this->session->userdata('userType') == 2)
                    redirect('buyer/buyerHome');               
                
            } elseif(is_string($isLoggedIn) && $isLoggedIn=="IA"){
                $message = "Currently your identity proof is disapproved by admin.";
                $this->session->set_flashdata('error', $message);
                redirect('login');

            } elseif(is_string($isLoggedIn) && $isLoggedIn == "WU"){
                $message = "Please select correct user type";
                $this->session->set_flashdata('error', $message);

            }elseif(is_string($isLoggedIn) && $isLoggedIn == "IP"){
                $message = "Incorrect Password";
                $this->session->set_flashdata('error', $message);

            }elseif(is_string($isLoggedIn) && $isLoggedIn == "IE"){
                $message = "Invalid Email";
                $this->session->set_flashdata('error', $message);

            }elseif(is_string($isLoggedIn) && $isLoggedIn == "IC"){
                $message = "Invalid Credential";
                $this->session->set_flashdata('error', $message);

            } else {
                $message = "Something going wrong";
                $this->session->set_flashdata('error', $message);
            }   
        }
        $this->template->build('login',$data);
	}

    function checkEmail(){

        $isCheck = $this->User_model->checkEmail($this->input->get('email'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    function checkCNO(){

        $isCheck = $this->User_model->checkCNO($this->input->get('contactNo'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function signUp()
	{
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');        
        $this->form_validation->set_rules('contactNo', 'Contact', 'required');
        if(empty($_FILES['identityProof']['name'])){
            $this->form_validation->set_rules('identityProof','Identity Proof','required');
        }

        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
            $this->template->build('register', $data);
        } else {           

            $userType = $this->input->post('userType');
            $folder = '';
            if($userType == 1){
                $folder = 'profile/seller';
            }elseif($userType == 2){
                $folder = 'profile/buyer';
            }

            $profileImage = '';
            if(!empty($_FILES['profileImage']['name'])) {
                $profileImage = $this->Image_model->upload_img('profileImage',$folder);
            }

            if(isset($profileImage) && is_array($profileImage)) {
                $data['error'] = $profileImage['error'];
                $this->template->build('register', $data);
            }

            $identityProof = '';
            if(!empty($_FILES['identityProof']['name'])) {
                $identityProof = $this->Image_model->upload_img('identityProof','identityProof');
            }
           
            if(isset($identityProof) && is_array($identityProof)) {
                $data['error'] = $identityProof['error'];
                $this->template->build('register', $data);
            }else{
                
                $userData['profileImage'] = isset($profileImage) ? $profileImage : '';
                $userData['identityProof'] = isset($identityProof) ? $identityProof : '';
                $userData['name'] = $this->input->post('name');
                $userData['email'] = $this->input->post('email');
                $userData['postcode'] = $this->input->post('postcode');
                $userData['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $userData['contactNo'] = $this->input->post('contactNo');
                $userData['userType'] = $userType;
                $userData['crd'] = date('Y-m-d H:i:s');

                // Add new user into the database
                $isAdded = $this->User_model->addNewUser($userData);
             
                if(is_string($isAdded) && $isAdded == 'AE'){
                    $message = "Email is already exist.";
                    $this->session->set_flashdata('error', $message);
                    redirect(site_url('login/signup'));
                } else {
                    $message = "Registration successfully done.";
                    $this->session->set_flashdata('success', $message);
                    if($this->session->userdata('userType') == 1)
                        redirect('seller/sellerHome');
                    if($this->session->userdata('userType') == 2)
                        redirect('buyer/buyerHome'); 
                }  
            } 
        }
	}

    function forgotPassword(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','required|valid_email');

        if($this->form_validation->run() == FALSE){
            $data=array('status'=>0,'error'=>strip_tags(validation_errors()));
            echo json_encode($data);
        }else{
            $this->load->library('encrypt');
            $email = $this->User_model->forgotPassword($this->input->post('email'));
            
            if(is_array($email)){
                $data=array('status'=>1);
                echo json_encode($data);
            } else {
                $data=array('status'=>0,'error'=>"Email is not exist");
                echo json_encode($data);  
            }   
        }
    }  
}
