<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {
    
    function __construct() {
        parent::__construct();
            date_default_timezone_set('Australia/Sydney');  
        /*if(!$this->session->userdata('front_login')){
            redirect(site_url('login'));
        }*/
        if($this->session->userdata('userType') == '1'){
            redirect(site_url('seller'));
        }

        if($this->uri->segment(2) == 'editProfile' || $this->uri->segment(2) == 'changePassword' || $this->uri->segment(2) == 'addPropertyPayment' || $this->uri->segment(2) == 'shoppingCart'){
            if($this->session->userdata('front_login') == FALSE ){
                redirect(site_url().'login');
            }
        }

        $this->load->model('Buyer_model');
    }
    
    function index()
    {
        $data['buyer'] = $this->Buyer_model->getUserInfo();
        $this->template->build('profile',$data);       
    }

    function buyerHome(){

        redirect('buyer/propertyList');
        //$this->template->build('buyer_home');      
    }

    function checkCNO(){

        $isCheck = $this->Buyer_model->checkCNO($this->input->get('contactNo'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function editProfile()
	{
        $this->load->model('login/User_model');
        $data['buyer'] = $this->Buyer_model->getUserInfo();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contactNo', 'Contact Number', 'required');
       
        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {
           
           $profileImg = '';
			if(!empty($_FILES['profileImage']['name'])){
				$profileImg = $this->Image_model->upload_img('profileImage', 'profile/buyer');

				if(is_string($profileImg)){
					$userData['profileImage'] = $profileImg;
				} elseif(is_array($profileImg)) {
					$data['error'] = 'Profile image could not be updated';
				}
			}

            $userData['name'] = $this->input->post('name');
            $userData['contactNo'] = $this->input->post('contactNo');            
           
            $isUpdate = $this->Buyer_model->updateProfile($userData);
            if($isUpdate == TRUE){
                $message = "Profile udpated successfully.";
                $this->session->set_flashdata('success', $message);
                redirect(site_url('buyer/editProfile'));
            }            
        }        
		$this->template->build('profile', $data);
	}
    
    function changePassword(){ 

        $pwd = $this->input->post('oldP');
        $existPass = $this->Buyer_model->getBuyerData($pwd); 
        if($existPass == true){
            $userData = array(
                'password'=>password_hash($this->input->post('newP'), PASSWORD_DEFAULT)
            );        
            $data = $this->Buyer_model->updatePassword($userData);
            echo json_encode(array('status'=>TRUE));
            exit();
        }        
        echo json_encode(array('status'=>FALSE));
        exit();   
                
    } 

    function propertyList(){

        $data['pType'] = $this->Buyer_model->getAllPropertyType();   
        $this->template->build('all_property',$data);
    }

    function allPropertyList(){

        $this->load->library('Ajax_pagination');

        $params = array('type','bedRoom','bathRoom','carParking','swimmingPool','propStatus','address','priceVal','areaVal');

        foreach ($params as $value) {
            $searchArray[$value] = $this->input->post($value);
        }
       
        $config = array();
        $config["base_url"] = base_url()."buyer/allPropertyList";
        $config["total_rows"] = $this->Buyer_model->countAllPropertyList($searchArray);
        $config["per_page"] = 6;
        $config['uri_segment'] =3;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="page-link" ';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['propertyList'] = $this->Buyer_model->getAllPropertyList($config["per_page"], $page, $searchArray);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_property_list',$data);
    }

    function viewProperty(){

        $pId = $this->uri->segment('3');
        $viewData['details'] = $this->Buyer_model->viewProperty($pId);
        $viewData['bidTime'] = $this->Buyer_model->getBidTime($pId);
        $viewData['images'] = $this->Buyer_model->getPropertyImages($pId);
        $viewData['featuredProperty'] = $this->Buyer_model->featuredProperty($pId);
        $this->template->build('property_detail',$viewData);
    }

    function addPropertyPayment(){
        
        $this->load->library('stripe');

        $pId = $this->uri->segment(3);

        $bankStatement = '';
        if(!empty($_FILES['bankStatement']['name'])) {
            $bankStatement = $this->Image_model->upload_img('bankStatement','bankStatement');
        }
       
        if(isset($bankStatement) && is_array($bankStatement)) {
            $data['error'] = $bankStatement['error'];
            $this->session->set_flashdata('error',$data['error']);
            redirect('buyer/propertyPayment/'.$pId);
        }else{
       
            $propData['buyerId'] = $this->session->userdata('id');            
            $propData['propertyStatus'] = $this->input->post('propertyStatus');            
            $propData['pId'] = $pId;            
            $propData['sellerId'] = $this->input->post('sellerId');           
            $propData['bookingAmount'] = 2000;  
            $propData['bankStatement']  = isset($bankStatement) ? $bankStatement : '';     
            $propData['crd'] = date('Y-m-d H:i:s'); 
            $propData['newPropEndDate'] = '';    
            
            if($propData['propertyStatus'] == 1){
                $startDate = time();
                $propData['newPropEndDate'] = date('Y-m-d H:i:s', strtotime('+5 day', $startDate)); 
                $propData['status'] = '1';  
            } 

            $name = $this->input->post('name');
            $number = $this->input->post('cardNumber');
            $exp_month = 1;
            $exp_year = $this->input->post('expYear');
            $cvv = $this->input->post('cvv');
            $token = $this->stripe->addCardAccount($name,$number,$exp_month,$exp_year,$cvv); 

            if(!empty($token['data']) && $token['status'] == true){
                $customerId = $this->stripe->save_card_id($token['data']);

                if(!empty($customerId['data']) && $customerId['status'] == true){
                
                    $result = $this->stripe->pay_by_card_id($propData['bookingAmount'],$customerId['data']);//pay

                    if(!empty($result['data']) && $result['status'] == true){

                        $transactionId = $result['data']->balance_transaction;
                        $chargeId =  $result['data']->id;
                        $status =  $result['data']->status;
                        $this->Buyer_model->addPayment($transactionId,$chargeId,$pId,$propData['bookingAmount'],$status);

                        $isAdded = $this->Buyer_model->addPropertyPayment($propData);
                        if($isAdded == TRUE){
                            //$this->session->set_userdata('successAlert','22');
                            $this->session->set_flashdata('successAlert','22');
                            redirect('buyer/propertyList/');
                        } 
                       
                    }else{

                        $this->session->set_flashdata('error',$result['message']);
                        redirect('buyer/propertyPayment/'.$pId);
                    }

                }else{
                    
                    $this->session->set_flashdata('error',$customerId['message']);
                    redirect('buyer/propertyPayment/'.$pId);
                }
            }else{
                    
                $this->session->set_flashdata('error',$token['message']);
                redirect('buyer/propertyPayment/'.$pId);
            }
        } 
    }


    function uploadDocument(){

        //$pId = $this->uri->segment(3);
        $pId = $this->input->post('propertyId');

        $bankStatement = '';
        if(!empty($_FILES['bankStatement']['name'])) {
            $bankStatement = $this->Image_model->upload_img('bankStatement','bankStatement');
        }
       
        if(isset($bankStatement) && is_array($bankStatement)) {
            $data['error'] = $bankStatement['error'];
            $this->template->build('payment',$data);
        }else{
                                  
            $sellerId = $this->input->post('sellerId');
            $propData['bankStatement']  = isset($bankStatement) ? $bankStatement : '';     
            $propData['status']  = '1';     
            $propData['upd'] = date('Y-m-d H:i:s');            
           
            $isAdded = $this->Buyer_model->uploadDocument($propData,$pId,$sellerId);
            if($isAdded == TRUE){
                $message = "";
                $this->session->set_flashdata('success', $message);
                redirect('buyer/shoppingCart');
            } 
        } 
    }

    function propertyPayment(){

        $pId = $this->uri->segment(3);
        $getData['propData'] = $this->Buyer_model->getpropertyData($pId);
        $this->template->build('payment',$getData);
    }

    function applyBidding(){

        $bidData['buyerId'] = $this->session->userdata('id');            
        $bidData['bidAmount'] = $this->input->post('bidAmt');            
        $bidData['pId'] = $this->input->post('pId');
        $bidData['startDate'] = $this->input->post('startDate');
        $bidData['endDate'] = $this->input->post('endDate');
        $isAdded = $this->Buyer_model->applyBidding($bidData);
        echo $isAdded;        
    }

    function shoppingCart(){
        
        $this->template->build('all_cart');  

    } // End of function

    function allCartPropertyList(){

        $this->load->library('Ajax_pagination');
       
        $config = array();
        $config["base_url"] = base_url()."buyer/allCartPropertyList";
        $config["total_rows"] = $this->Buyer_model->countAllCartPropertyList();
        $config["per_page"] = 6;
        $config['uri_segment'] =3;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="page-link" ';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['cartProperty'] = $this->Buyer_model->getAllCartPropertyList($config["per_page"], $page);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
       
        $this->load->view('all_cart_property_list',$data);
    }

    function orderPayment(){

        $pId = $this->uri->segment(3);
        $this->template->build('order_payment');
    }

    function payByCcToStripe(){
        
        $this->load->library('stripe');
        $pId = $this->uri->segment(3);
        $payment = 100;

        $name = $this->input->post('name');
        $number = $this->input->post('cardNumber');
        $exp_month = 1;
        $exp_year = $this->input->post('expYear');
        $cvv = $this->input->post('cvv');

        $token = $this->stripe->addCardAccount($name,$number,$exp_month,$exp_year,$cvv); 

        if(!empty($token['data']) && $token['status'] == true){

            $customerId = $this->stripe->save_card_id($token['data']);

            if(!empty($customerId['data']) && $customerId['status'] == true){
            
                $result = $this->stripe->pay_by_card_id($payment,$customerId['data']);//pay

                if(!empty($result['data']) && $result['status'] == true){

                    $transactionId = $result['data']->balance_transaction;
                    $chargeId =  $result['data']->id;
                    $status =  $result['data']->status;

                    $isAdded = $this->Buyer_model->updatePayment($transactionId,$chargeId,$pId,$payment,$status);
                    if($isAdded == TRUE){
                        $this->session->set_flashdata('success','Payment has been done, now you can view valuation report.');

                        redirect('buyer/viewProperty/'.$pId);
                    }
                   
                }else{

                    $this->session->set_flashdata('error',$result['message']);
                    redirect('buyer/orderPayment/'.$pId);
                }

            }else{
                
                $this->session->set_flashdata('error',$customerId['message']);
                redirect('buyer/orderPayment/'.$pId);
            }
        }else{
                
            $this->session->set_flashdata('error',$token['message']);
            redirect('buyer/orderPayment/'.$pId);
        }       
    }

    function propertyFinalDocuments(){

        $pId = $this->uri->segment(3);
        $data['propData'] = $this->Buyer_model->getpropertyData($pId);
       
        $this->template->build('property_final_document',$data);
    }


    function uploadPropertyFinalDocuments(){

        $pId = $this->uri->segment(3);
        $data['propData'] = $this->Buyer_model->getpropertyData($pId);
        
      /*  $this->load->library('form_validation');

        if(empty($_FILES['proofOfFund']['name'])) {
            $this->form_validation->set_rules('proofOfFund', 'Proof Of Fund', 'required');
        }

        if(empty($_FILES['EOI']['name'])) {
            $this->form_validation->set_rules('EOI', 'EOI', 'required');
        }
       
        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {*/

            $proofOfFund = $EOI = '';

            if(!empty($_FILES['proofOfFund']['name'])) {
                $proofOfFund = $this->Image_model->upload_img('proofOfFund','proofOfFund');
            }

            if(!empty($_FILES['EOI']['name'])) {
                $EOI = $this->Image_model->upload_img('EOI','EOI');
            }
           
            if(isset($proofOfFund) && is_array($proofOfFund)) {
                $data['error'] = $proofOfFund['error'];

            }elseif(isset($EOI) && is_array($EOI)) {
                $data['error'] = $EOI['error'];
            } else{
                                      
                $sellerId = $this->input->post('sellerId');
                $propertyStatus = $this->input->post('propertyStatus');
                $propData['proofOfFund']  = isset($proofOfFund) ? $proofOfFund : '';     
                $propData['EOI']  = isset($EOI) ? $EOI : '';         
                $propData['upd'] = date('Y-m-d H:i:s');            
               //print_r($propData);die;
                $isAdded = $this->Buyer_model->uploadPropertyFinalDocuments($propData,$pId,$sellerId,$propertyStatus);
                if($isAdded == TRUE){
                    $message = "Your proof of fund and property document have been uploaded successfully.";
                    $this->session->set_flashdata('success', $message);
                    redirect('buyer/viewProperty/'.$pId);
                } 
            } 
        
        $this->template->build('property_final_document',$data);
    }

} // End of class
