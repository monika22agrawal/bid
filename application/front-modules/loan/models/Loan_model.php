<?php

class Loan_model extends CI_Model {

    function checkCNO($contactNo){

        $isExist = $this->db->get_where('loan',array('contactNo'=>$contactNo))->row();
        if(!empty($isExist)){
            return false;
        }else{
            return true;
        }
    }

    function checkEmail($email){

        $isExist = $this->db->get_where('loan',array('email'=>$email))->row();
        if(!empty($isExist)){
            return false;
        }else{
            return true;
        }
    }


    function registerMember($userData){

        $isExist = $this->db->select('id')->where(array('email'=>$userData['email']))->get('loan');
        if($isExist->num_rows() > 0){
            return 'AE';
        } else {
            
            $this->db->insert('loan', $userData);
            
            return TRUE;
        }
    }
}