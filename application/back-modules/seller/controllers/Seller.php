<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends MX_Controller {

    function __construct() {
        parent::__construct();
		if($this->session->userdata('id') == null){
			redirect(site_url().'login');
		}
        $this->load->model('Seller_model');
    }

    function allSeller(){
        $this->template->build('all_seller');
    }
    
    function allSellerListing(){

        $this->load->library('Ajax_pagination');
        $search = $this->input->post('key');

        $config = array();
        $config["base_url"] = base_url()."seller/allSellerListing";
        $config["total_rows"] = $this->Seller_model->countAllSeller($search);
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
        $data['seller'] = $this->Seller_model->getAllSeller($config["per_page"], $page,$search);
    
        $data["sn"] = $page+1;
        
        $data["links"] = $this->ajax_pagination->create_links();
        $this->load->view('all_seller_listing',$data);
    }

    function activeSeller(){

        $id = $this->uri->segment(3);
        $data = $this->Seller_model->activeUsers(array('id'=>$id));
        if($data == 1){
            $this->session->set_flashdata('success', 'Identity proof approved successfully.');
            redirect('seller/allSeller');
        }else{
            $this->session->set_flashdata('success', 'Identity proof disapproved.');
            redirect('seller/allSeller');
        }
    }

    function deleteSeller(){

        $id = $this->uri->segment(3);
        $data = $this->Seller_model->deleteUsers($id);
        if($data == true){
            $this->session->set_flashdata('success', 'Seller deleted successfully.');
            redirect('seller/allSeller');
        }
    }

} //end of class

/* End of file seller.php */
/* Location: ./application/controllers/seller.php */
