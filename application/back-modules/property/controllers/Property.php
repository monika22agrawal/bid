<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends MX_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Australia/Sydney');  
		if($this->session->userdata('id') == null){
			redirect(site_url().'login');
		}
        $this->load->model('Property_model');
    }

    function addPropertyType(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('typeName', 'Property type name', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
            $this->template->build('add_property',$data);
        } else {
            $date = date('Y-m-d H:i:s');
            $userData['typeName'] = $this->input->post('typeName');
            $userData['crd'] = $userData['upd'] = $date;
            $isAdded = $this->Property_model->addPropertyType($userData);
          
            if(is_string($isAdded) && $isAdded == 'AE'){
                $message = "Property already added";
                $this->session->set_flashdata('error', $message);
                redirect(site_url('property/addPropertyType'));
            } else {
                $message = "Property added successfully done.";
                $this->session->set_flashdata('success', $message);
                redirect(site_url('property/allPropertyType'));
            } 
        }
    }

    function allPropertyType(){

        $this->template->build('all_propertyType');
    }
    
    function allPropertyTypeList(){

        $this->load->library('Ajax_pagination');
        $search = $this->input->post('key');

        $config = array();
        $config["base_url"] = base_url() . "property/allPropertyTypeList";
        $config["total_rows"] = $this->Property_model->countAllPropertytype($search);
        $config["per_page"] = 10;
        $config['uri_segment'] =3;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin cs-no-mr">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="paginationlink" ';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pType'] = $this->Property_model->getAllPropertyType($config["per_page"], $page,$search);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_propertyType_list',$data);
    }

    function updatePropertyType(){

        $id = $this->uri->segment(3);
        $data['pType'] = $this->Property_model->showPTypeInfo($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('typeName', 'Property type name', 'required');
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = validation_errors();
        } else {

            $userData['typeName'] = $this->input->post('typeName');            
            $userData['upd'] = date('Y-m-d H:i:s');

            $result = $this->Property_model->updatePropertyType($userData,$id);

            if($result == true){
                $this->session->set_flashdata('success', 'Record updated successfully.');
                redirect('property/allPropertyType');
            } else {
                $data['error'] = 'Record already exist.';
            }
        }
        $this->template->build('update_propertyType',$data);  
    }

    function activePtype(){

        $id = $this->uri->segment(3);
        $data = $this->Property_model->activePtype(array('id'=>$id));
        if($data == 1){
            $this->session->set_flashdata('success', 'Property type activated successfully.');
            redirect('property/allPropertyType');
        }else{
            $this->session->set_flashdata('success', 'Property type inactivated.');
            redirect('property/allPropertyType');
        }
    }

    function deletePType(){

        $id = $this->uri->segment(3);
        $data = $this->Property_model->deletePType($id);
        if($data == true){
            $this->session->set_flashdata('success', 'Record deleted successfully.');
            redirect('property/allPropertyType');
        }
    }

    function allProperty(){
        $this->template->build('all_property');
    }
    
    function allPropertyList(){

        $this->load->library('Ajax_pagination');
        $search = $this->input->post('key');
        $status = $this->input->post('status');

        $config = array();
        $config["base_url"] = base_url() . "property/allPropertyList";
        $config["total_rows"] = $this->Property_model->countAllProperty($search,$status);
        $config["per_page"] = 10;
        $config['uri_segment'] =3;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin cs-no-mr">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="paginationlink" ';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['propertyData'] = $this->Property_model->getAllProperty($config["per_page"],$page,$search,$status);
   
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links($search);
        $this->load->view('all_property_list',$data);
    }

    function propertyDetail(){

        $pId = $this->uri->segment(3);
        $sId = $this->uri->segment(4);
        $data['sellerData'] = $this->Property_model->getSellerDetail($sId);
        $data['buyerData'] = $this->Property_model->getBuyerDetail($pId,$sId);     
        $data['propertyDetail'] = $this->Property_model->getPropertyDetail($pId);
        $data['pImages'] = $this->Property_model->getPropertyImg($pId);    
        $data['newPropData'] = $this->Property_model->getNewPropertyBuyerData($pId);    
        $this->template->build('property_detail',$data);
    }

    function activePstatus(){

        $status = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $sId = $this->uri->segment(5);
        $data = $this->Property_model->activePstatus(array('id'=>$id),$status);
        if($data == 1){
            $this->session->set_flashdata('success', 'Property proof approved successfully.');
            redirect('property/propertyDetail/'.$id.'/'.$sId);
        }else{
            $this->session->set_flashdata('success', 'Property proof disapproved successfully.');
            redirect('property/propertyDetail/'.$id.'/'.$sId);
        }
    }

    
    function allPropertyBidderList(){
        
        $this->load->library('Ajax_pagination');
        $pId = $this->input->post('pId');

        $config = array();
        $config["base_url"] = base_url() . "property/allPropertyBidderList";
        $config["total_rows"] = $this->Property_model->countAllPropertyBidder($pId);
        $config["per_page"] = 10;
        $config['uri_segment'] =3;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin cs-no-mr">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="paginationlink" ';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['propertyBidData'] = $this->Property_model->getAllPropertyBidder($config["per_page"],$page,$pId);
   
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_property_bidder_list',$data);
    }

    function approveBidRequest(){

        $status = $this->uri->segment(3);
        $id = $this->uri->segment(4);

        $pId = $this->uri->segment(5);
        $sellerId = $this->uri->segment(6);
        $buyerId = $this->uri->segment(7);       
       
        $data = $this->Property_model->approveBidRequest($id,$status,$buyerId,$pId,$sellerId);

        if($data['status'] == 1){
            $this->session->set_flashdata('success', $data['msg']);
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }else{
            $this->session->set_flashdata('error', $data['msg']);
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }
    }

    function approveNewPropRequest(){

        $status = $this->uri->segment(3);
        $id = $this->uri->segment(4);

        $pId = $this->uri->segment(5);
        $sellerId = $this->uri->segment(6);
        $buyerId = $this->uri->segment(7);
       
        $data = $this->Property_model->approveNewPropRequest($id,$status,$buyerId,$pId,$sellerId);
        
        if($data['status'] == 1){
            $this->session->set_flashdata('success', $data['msg']);
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }else{
            $this->session->set_flashdata('error',$data['msg'] );
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }
    }

    function UploadDoc(){

        $pId = $this->uri->segment(3);
        $sellerId = $this->uri->segment(4);

        $evaluationReport = '';

        if(!empty($_FILES['evaluationReport']['name'])){
            $evaluationReport = $this->Property_model->upload_doc('evaluationReport', 'evaluationReport');
            
        } else{
            $this->session->set_flashdata('error','Valuation report is not uploaded.');
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }
       // print_r($evaluationReport);die;
        if(isset($evaluationReport) && is_array($evaluationReport)) {
            $data['error'] = $evaluationReport['error'];
            $this->session->set_flashdata('error',$data['error']);
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }else{

            $img['evaluationReport'] = isset($evaluationReport) ? $evaluationReport : '';   
            $data = $this->Property_model->UploadDoc($img,$pId);

            if($data == TRUE){
                $this->session->set_flashdata('success', 'Valuation report uploaded successfully.');
                redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
            }else{
                $this->session->set_flashdata('success', 'Valuation report is not uploaded.');
                redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
            }
        }
        
    }

    function refundAmount(){

        $this->load->library('stripe');
        $chargeId = $this->uri->segment(3);
        $pId = $this->uri->segment(4);
        $sellerId = $this->uri->segment(5);
        $buyerId = $this->uri->segment(6);
        $refund = $this->stripe->refundToCard($chargeId);

        if(!empty($refund['data']) && $refund['status'] == true){

            $isRefunded = $this->Property_model->refundAmount($pId,$buyerId,$refund['data']);

            if($isRefunded == TRUE){

                $this->session->set_flashdata('success','Congratulations !! Amount has been refunded successfully.');
                redirect('property/propertyDetail/'.$pId.'/'.$sellerId);

            }else{
                $this->session->set_flashdata('error','Somthing going wrong');
                redirect('property/propertyDetail/'.$pId.'/'.$sellerId);

            }
        }else{
            $this->session->set_flashdata('error',$refund['message']);
            redirect('property/propertyDetail/'.$pId.'/'.$sellerId);
        }
    }

} //end of class

/* End of file user.php */
/* Location: ./application/controllers/user.php */
