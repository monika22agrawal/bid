<?php

class User_model extends CI_Model {

    function emailSent($useremail,$message,$subject){

        $this->load->library('email');

        $config = array();
        $config['useragent']  = "CodeIgniter";
        $config['mailpath']  = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "sendmail";
        $config['smtp_host']= "bidhome.com.au";
        $config['smtp_port'] = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('admin@admin.com', 'BIDHOME');
        $this->email->to($useremail);

        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {    
            
            return  array('emailType'=>'ES','email'=>'Your password has been successfully sent to your email address!!' ); //ES emailSend
        }else{   
               
            return  array('emailType'=>'NS','email'=> show_error($this->email->print_debugger())) ; //NS NOSend
        }
    }//end function 

     function checkApproval($id){

        $req = $this->db->select()->where(array('id'=>$id,'status'=>0 ))->get('users');
        if($req->num_rows()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function bidTimeExpire(){

       // echo date('Y-m-d H:i:s');
        $this->db->select('property.sellerId,property.id,property.propertyName,property.address,property.buyerId,property.propertyName,property.propertyStatus,bidTime.pId,bidTime.endDateTime');
        $this->db->from('property');
        $this->db->join('bidTime','bidTime.pId = property.id');
        $this->db->where('property.propertyStatus','2');
        $this->db->where(array('bidTime.endDateTime' => date('Y-m-d H:i')));
        
        $sql = $this->db->get();

        if($sql->num_rows()){

            $res = $sql->result();

            foreach ($res as $value) {

                $this->db->select('max(bids.bidAmount) as bidAmount,bids.buyerId,users.id');
                $this->db->from('bids');
                $this->db->join('users','users.id = bids.buyerId');
                $this->db->where(array('bids.pId'=>$value->pId,'users.status'=>1));
                $check = $this->db->get();
               
                if($check->num_rows() >0 ){

                    $ress = $check->row();

                    $where = array('id'=>$value->pId);
                    $this->db->update('property', array('isSold'=>1,'buyerId'=>$ress->buyerId), $where);

                    $getUserDetail = $this->db->select('name,email')->where(array('id'=>$ress->buyerId))->get('users')->row();

                    $useremail= $getUserDetail->email;

                    $userData['name'] = $getUserDetail->name;
                    $userData['id'] = $value->pId;
                    $userData['propertyName'] = $value->propertyName;
                    $userData['address'] = $value->address;
                    
                    $message  = $this->load->view('highest_bidder',$userData,TRUE);
                            
                    $subject = "Highest Bidder";
                    
                    $this->emailSent($useremail,$message,$subject);
                }
            }
            return TRUE;
        }
        return false;

    }//End Function

    function uploadDocTimeExpire(){

        $sql = $this->db->select('pId')->where(array('propertyStatus'=>'1','newPropEndDate <' => date('Y-m-d H:i:s'),'bankStatement' => ''))->get('booking');

        if($sql->num_rows() > 0){
            $ids = $sql->result();

            foreach ($ids as $value) {
                $where = array('id'=>$value->pId,'propertyStatus'=>1);
                $this->db->update('property', array('buyerId'=>0,'isSold'=>0), $where);
            } 
        }

        $where = array('propertyStatus'=>'1','newPropEndDate <' => date('Y-m-d H:i:s'),'bankStatement' => '');
        $this->db->update('booking', array('status'=>2), $where);
        
        return TRUE;

    }//End Function

    function getAllProducts(){

		$this->db->select('property.id,property.propertyName,property.propertytypeId,property.purchaseAmount,property.area,property.bedRoom,property.bathRoom,property.address,property.propertyStatus,propertyType.typeName');
		$this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.status'=>1,'property.propertyProofStatus'=>1));
        $req = $this->db->get();
		if($req->num_rows()){
            $res = $req->result();          
            foreach($res as $value){
                $imgs = $this->db->select('*')->where(array('pId'=>$value->id))->get('propertyImages')->row_array();
                  
                if(!empty($imgs)){
                    if(!empty($imgs['pImage'])){
                        $value->pImage = base_url().'upload/propertyImage/'.$imgs['pImage'];
                    }else{
                       $value->pImage = base_url().FRONT_THEME.'img/defaultProduct.png';
                    }
                }else{
                    $value->pImage = base_url().FRONT_THEME.'img/defaultProduct.png';
                }
                $data[] = $value;
            }   
                    
            return $data;
        }   
	}
}