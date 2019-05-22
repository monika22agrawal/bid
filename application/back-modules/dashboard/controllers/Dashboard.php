<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {

    parent::__construct();
    	$this->load->model('dashboard/Admin_model');  
		$session_id = $this->session->all_userdata('email'); 

		if(!$this->session->userdata('email')){
			redirect('login');
		}
    }

	function index() {   
		
		$data['sellerCount'] = $this->Admin_model->countSeller();
		$data['buyerCount'] = $this->Admin_model->countBuyer();
		$data['propertyTypeCount'] = $this->Admin_model->countPropertyType();
		/*$data['planCount'] = $this->Admin_model->countPlans();
		$data['categoryCount'] = $this->Admin_model->countCategory();*/
		$this->template->build('dashboard',$data);  
	}

	function logout(){

		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
