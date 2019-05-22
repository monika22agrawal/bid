<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Australia/Sydney');  
        if(!$this->session->userdata('front_login')){
            redirect(site_url('login'));
        }
        if($this->session->userdata('userType') == '2'){
            redirect(site_url('buyer'));
        }
        $this->load->model('seller_model');
    }
    
    function index(){

        $data['seller'] = $this->seller_model->getUserInfo();
        $this->template->build('profile',$data);       
    }

    function sellerHome(){
        
        $this->load->model('login/User_model');
        $isProperty = $this->User_model->getSellerProperty();
        if($isProperty > 0){
            redirect('seller/propertyList');
        }else{
            $this->template->build('seller_home');      
        }          
    }

    function checkCNO(){

        $isCheck = $this->seller_model->checkCNO($this->input->get('contactNo'));
        if($isCheck == FALSE){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function editProfile(){

        $this->load->model('login/User_model');
        $data['seller'] = $this->seller_model->getUserInfo();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contactNo', 'Contact Number', 'required');
       
        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {
           
            $profileImg = '';
			if(!empty($_FILES['profileImage']['name'])){
				$profileImg = $this->Image_model->upload_img('profileImage', 'profile/seller');

				if(is_string($profileImg)){
					$userData['profileImage'] = $profileImg;
				} elseif(is_array($profileImg)) {
					$data['error'] = 'Profile image could not be updated';
				}
			}

            $userData['name'] = $this->input->post('name');
            $userData['contactNo'] = $this->input->post('contactNo');
           
            $isUpdate = $this->seller_model->updateProfile($userData);
            if($isUpdate == TRUE){
                $message = "Profile udpated successfully.";
                $this->session->set_flashdata('success', $message);
                redirect(site_url('seller/editProfile'));
            }            
        }        
		$this->template->build('profile', $data);
	}
    
    function changePassword(){ 

        $pwd = $this->input->post('oldP');
        $existPass = $this->seller_model->getSellerData($pwd);            
        if($existPass == true){
            $userData = array(
                'password'=>password_hash($this->input->post('newP'), PASSWORD_DEFAULT)
            );        
            $data = $this->seller_model->updatePassword($userData);
            echo json_encode(array('status'=>TRUE));
            exit();
        }        
        echo json_encode(array('status'=>FALSE));
        exit();          
         
    } // End of function


    function uploadPropertyImage(){

        $id = $this->input->post('id');
        $imgCount = $this->input->post('imgCount');
        $pImage = '';            
        if(!empty($_FILES['pImage']['name'])){
            $folder = 'propertyImage';
            $pImage = $this->Image_model->upload_img('pImage',$folder);

        }


        if(isset($pImage) && is_array($pImage)) {
            $data['error'] = $pImage['error'];
            
            echo '0';
        } else {

            if(!empty($pImage)){
                
                $new['newImg'] = $pImage;
                $new['imgCount'] = $imgCount;
                
                $this->load->view('add_new_img',$new);  
                
            }else{
                echo '0';
            }
        }           
    }

    function addProperty(){
     //echo '<pre>';print_r($_POST);die;
        $this->load->library('form_validation');

        $this->form_validation->set_rules('propertyName','Property name','required');
        $this->form_validation->set_rules('description','Description','required');
        $this->form_validation->set_rules('purchaseAmount','Purchase amount','required');
        $this->form_validation->set_rules('area','Area','required');
        $this->form_validation->set_rules('propertytypeId','Property type name','required');
        $this->form_validation->set_rules('propertyStatus','Property status','required');
        $this->form_validation->set_rules('address','Address','required');

        $propertyStatus = $this->input->post('propertyStatus');

        if($propertyStatus == '2'){           // for old property status
            $this->form_validation->set_rules('startDateTime','Start date time','required');
            $this->form_validation->set_rules('endDateTime','End date time','required');
        }

        if(empty($_FILES['propertyProof']['name'])){
            $this->form_validation->set_rules('propertyProof','Property proof','required');
        }

        if(empty($_FILES['inspectionReport']['name'])){
            $this->form_validation->set_rules('inspectionReport','Inspection report','required');
        }

        $data['pType'] = $this->seller_model->getAllActivePropertyType();        
        
        if($this->form_validation->run() == FALSE){

            $data['error'] = validation_errors();

        } else {

            $date = date('Y-m-d H:i:s');
            
            $bidTime = array();
            
            $pImage['pImage'] = $this->input->post('img');   
 
            $propertyProof = '';
            if(!empty($_FILES['propertyProof']['name'])) {
                $propertyProof = $this->Image_model->upload_img('propertyProof','propertyProof');
            }
           
            if(isset($propertyProof) && is_array($propertyProof)) {
                $data['error'] = $propertyProof['error'];
            }

            $floorPlan = '';
            if(!empty($_FILES['floorPlan']['name'])) {
                $floorPlan = $this->Image_model->upload_img('floorPlan','floorPlan');
            }
           
            if(isset($floorPlan) && is_array($floorPlan)) {
                $data['error'] = $floorPlan['error'];
            }
            
            $inspectionReport = '';
            if(!empty($_FILES['inspectionReport']['name'])) {
                $inspectionReport = $this->Image_model->upload_img('inspectionReport','inspectionReport');
            }
           
            if(isset($inspectionReport) && is_array($inspectionReport)) {
                $data['error'] = $inspectionReport['error'];
            }else{

                $userData = array(
                    'sellerId' => $this->session->userdata('id'),
                    'propertyName'  => $this->input->post('propertyName'),
                    'description'  => $this->input->post('description'),
                    'purchaseAmount'  => $this->input->post('purchaseAmount'),                
                    'area'  => $this->input->post('area'),
                    'propertytypeId'  => $this->input->post('propertytypeId'),
                    'propertyProof'  => isset($propertyProof) ? $propertyProof : '',
                    'floorPlan'  => isset($floorPlan) ? $floorPlan : '',
                    'propertyStatus'  => $propertyStatus,
                    'bedRoom'  => $this->input->post('bedRoom'),
                    'bathRoom'  => $this->input->post('bathRoom'),
                    'carParking'  => $this->input->post('carParking'),
                    'swimmingPool'  => $this->input->post('swimmingPool'),
                    'address'  => $this->input->post('address'),
                    'inspectionReport'  => isset($inspectionReport) ? $inspectionReport : '',
                    'crd' => $date,
                    'upd' => $date
                );
                
                if($propertyStatus == '2'){     
                    $bidTime = array(
                        'sellerId' => $this->session->userdata('id'),
                        'startDateTime' => date('Y-m-d H:i:s',strtotime($this->input->post('startDateTime'))),
                        'endDateTime' => date('Y-m-d H:i:s',strtotime($this->input->post('endDateTime'))),
                        'crd' => date('Y-m-d H:i:s')
                    ); 
                }
                
                $result = $this->seller_model->addProperty($userData,$pImage,$bidTime); 

                if(is_string($result) && $result == "PA"){
                    $message = "Property added successfully.";
                    $this->session->set_flashdata('success', $message);
                    redirect('seller/propertyList');
                } elseif(is_string($result) && $result == "AE") {
                    $data['error'] = 'Record already exist.';
                } elseif(is_string($result) && $result == "ED") {
                    $data['error'] = 'Please select valid address';
                } else{
                    $data['error'] = 'Something going wrong.';
                }
            }
        }
        $this->template->build('add_property',$data);
    }

    function propertyList(){

        $data['pType'] = $this->seller_model->getAllPropertyType();   
        $this->template->build('all_property',$data);
    }

    function allPropertyList(){

        $this->load->library('Ajax_pagination');

        $params = array('type','bedRoom','bathRoom','carParking','swimmingPool','propStatus','address','priceVal','areaVal');

        foreach ($params as $value) {
            $searchArray[$value] = $this->input->post($value);
        }
       
        $config = array();
        $config["base_url"] = base_url()."seller/allPropertyList";
        $config["total_rows"] = $this->seller_model->countAllPropertyList($searchArray);
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
        $data['propertyList'] = $this->seller_model->getAllPropertyList($config["per_page"], $page, $searchArray);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_property_list',$data);
    }

    function viewProperty(){

        $pId = $this->uri->segment('3');
        $viewData['pType'] = $this->seller_model->getAllPropertyType();   
        $viewData['details'] = $this->seller_model->viewProperty($pId);
        $viewData['images'] = $this->seller_model->getPropertyImages($pId);
        $viewData['bidTime'] = $this->seller_model->getBidTime($pId);        
        $viewData['allBidders'] = $this->seller_model->getAllBidders($pId);
        $viewData['countBidders'] = $this->seller_model->countAllBidders($pId);
        $viewData['recentProperty'] = $this->seller_model->recentAddedProperty($pId);
        $this->template->build('property_detail',$viewData);
    }

    function updateRecord(){

        $bidTime = $data = array();
        $floorPlan = '';
        if(!empty($_FILES['floorPlan']['name'])){
            $folder = 'floorPlan';
            $floorPlan = $this->Image_model->upload_img('floorPlan',$folder);            
        } 

        if(!empty($floorPlan))
            $data['floorPlan'] = $floorPlan;

        if(!empty($this->input->post('propType')))
            $data['propertytypeId'] = $this->input->post('propType');

        if(!empty($this->input->post('area')))
            $data['area'] = $this->input->post('area');

        if(!empty($this->input->post('bedVal')))
            $data['bedRoom'] = $this->input->post('bedVal');

        if(!empty($this->input->post('bathVal')))
            $data['bathRoom'] = $this->input->post('bathVal');

        if(!empty($this->input->post('parkVal')))
            $data['carParking'] = $this->input->post('parkVal');

        if(!empty($this->input->post('poolVal')))
            $data['swimmingPool'] = $this->input->post('poolVal');

        if(!empty($this->input->post('propertyName')))
            $data['propertyName'] = $this->input->post('propertyName');

        if(!empty($this->input->post('purchaseAmount')))
            $data['purchaseAmount'] = $this->input->post('purchaseAmount');

        if(!empty($this->input->post('description')))
            $data['description'] = $this->input->post('description');

        if(!empty($this->input->post('address')))
            $data['address'] = $this->input->post('address');


        if(!empty($this->input->post('propStatus')) && $this->input->post('propStatus') == '2'){
            if(!empty($this->input->post('sDate')))
                $bidTime['startDateTime'] = date('Y-m-d H:i:s',strtotime($this->input->post('sDate')));
            if(!empty($this->input->post('eDate')))
                $bidTime['endDateTime'] = date('Y-m-d H:i:s',strtotime($this->input->post('eDate')));
        }

        $id = $this->input->post('id');
        $viewData = $this->seller_model->updateRecord($data, $bidTime, $id);
        if(!empty($viewData)){
            if(!empty($bidTime)){
               echo json_encode(array('startDate'=>date('d M Y, H:i',strtotime($this->input->post('sDate'))),'endDate'=>date('d M Y, H:i',strtotime($this->input->post('eDate')))));
            }else{
                echo json_encode($viewData);
            }
        }else{
            echo '0';
        }
    }

    function updatePropertyImage(){

        $pId = $this->input->post('pId');
        $id = $this->input->post('id');
        $pImage = '';            
        if(!empty($_FILES['pImage']['name'])){
            $folder = 'propertyImage';
            $pImage = $this->Image_model->upload_img('pImage',$folder);
        }

        if(!empty($pImage))
            $img['pImage'] = $pImage;

        $viewData = $this->seller_model->updatePropertyImage($id, $pId, $img);
        if($viewData == TRUE){            
            echo '1';            
        }else{
            echo '0';
        }          
    }

    function addPropertyImage(){

        $pId = $this->input->post('pId');
        $countImg = $this->input->post('countImg');
        $pImage = '';            
        if(!empty($_FILES['pImage']['name'])){
            $folder = 'propertyImage';
            $pImage = $this->Image_model->upload_img('pImage',$folder);
        }

        if(!empty($pImage))
            $img['pImage'] = $pImage;

        $img['pId'] = $pId;
        $new = array();
        $new['newImg'] = base_url().'upload/propertyImage/'.$pImage;
        $new['countImg'] =  $countImg;
        $new['lastId'] = $this->seller_model->addPropertyImage($img);
        if( $new['lastId'] > 0){            
            $this->load->view('new_img',$new);          
        }else{
            echo '0';
        }
    }

    function deletePropertyImage(){

        $pId = $this->input->post('pId');
        $id = $this->input->post('id');

        $viewData = $this->seller_model->deletePropertyImage($id, $pId);
        if($viewData == TRUE){            
            echo '1';            
        }else{
            echo '0';
        }          
    }

    function soldPropertyList(){

        $this->template->build('all_soldProperty');
    }

    function allSoldPropertyList(){

        $this->load->library('Ajax_pagination');
       
        $config = array();
        $config["base_url"] = base_url()."seller/allSoldPropertyList";
        $config["total_rows"] = $this->seller_model->countAllSoldPropertyList();
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
        $data['soldProperty'] = $this->seller_model->getAllSoldPropertyList($config["per_page"], $page);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_sold_property_list',$data);
    }

} // End of class
