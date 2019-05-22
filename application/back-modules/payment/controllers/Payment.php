<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MX_Controller {

    function __construct() {
        parent::__construct();
		if($this->session->userdata('id') == null){
			redirect(site_url().'login');
		}
        $this->load->model('Payment_model');
    }

    function allPayment(){
        $this->template->build('all_payment');
    }
    
    function allPaymentListing(){

        $this->load->library('Ajax_pagination');
        $search = $this->input->post('key');
        $type = $this->input->post('type');

        $config = array();
        $config["base_url"] = base_url()."payment/allPaymentListing";
        $config["total_rows"] = $this->Payment_model->countAllPayment($search,$type);
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
        $data['payment'] = $this->Payment_model->getAllPayment($config["per_page"], $page,$search,$type);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_payment_listing',$data);
    }

} //end of class

/* End of file user.php */
/* Location: ./application/controllers/user.php */
