<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyer extends MX_Controller {

    function __construct() {
        parent::__construct();
		if($this->session->userdata('id') == null){
			redirect(site_url().'login');
		}
        $this->load->model('Buyer_model');
    }

    function allBuyer(){
        $this->template->build('all_buyer');
    }
    
    function allBuyerListing(){

        $this->load->library('Ajax_pagination');
        $search = $this->input->post('key');

        $config = array();
        $config["base_url"] = base_url()."buyer/allBuyerListing";
        $config["total_rows"] = $this->Buyer_model->countAllBuyer($search);
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
        $data['buyer'] = $this->Buyer_model->getAllBuyer($config["per_page"], $page,$search);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_buyer_listing',$data);
    }

    function activeBuyer(){

        $id = $this->uri->segment(3);
        $data = $this->Buyer_model->activeBuyer(array('id'=>$id));
        if($data == 1){
            $this->session->set_flashdata('success', 'Identity proof approved successfully.');
            redirect('buyer/allBuyer');
        }else{
            $this->session->set_flashdata('success', 'Identity proof disapproved successfully.');
            redirect('buyer/allBuyer');
        }
    }

    function deleteBuyer(){

        $id = $this->uri->segment(3);
        $data = $this->Buyer_model->deleteBuyer($id);
        if($data == true){
            $this->session->set_flashdata('success', 'Buyer deleted successfully.');
            redirect('buyer/allBuyer');
        }
    }

} //end of class

/* End of file user.php */
/* Location: ./application/controllers/user.php */
