<?php

class User_model extends CI_Model {

    function getLatLong($address){ // get lat and long by address

        if(!empty($address)){
           
            $formattedAddr = str_replace(' ','+',$address);

            $url = 'http://maps.google.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $output = json_decode($response);
            if(isset($output->results[0]->geometry->location->lat)){
                $data['latitude']  = $output->results[0]->geometry->location->lat; 
                $data['longitude'] = $output->results[0]->geometry->location->lng;
                if(!empty($data)){
                    return $data;
                }else{
                    return false;
                }
            }else{
                return false;   
            }
        }else{
            return false;   
        }
    }

    function checkEmail($email){

        $isExist = $this->db->get_where('users',array('email'=>$email))->row();
        if(!empty($isExist)){
            return false;
        }else{
            return true;
        }
    }

    function checkCNO($contactNo){

        $isExist = $this->db->get_where('users',array('contactNo'=>$contactNo))->row();
        if(!empty($isExist)){
            return false;
        }else{
            return true;
        }
    }

    function addNewUser($userData) {
        $isExist = $this->db->select('id')->where(array('email'=>$userData['email']))->get('users');
        if($isExist->num_rows() > 0){
            return 'AE';
        } else {
            
            $this->db->insert('users', $userData);
            $userId = $this->db->insert_id();
            $this->session_create($userId);
            
            return TRUE;
        }        
    }
    
    function login($userData) {

        /*$row = $this->db->select('id,password')->where(array('email' =>$userData['email'],'status' => 0))->get('users');
        if($row->num_rows()){

            return "IA"; // Inactive user
        }else{*/
            $sql = $this->db->select('id,password,userType')->where(array('email' =>$userData['email']))->get('users');

            if($sql->num_rows() > 0){
                
                $user = $sql->row(); 
                if($user->userType == $userData['userType']){

                    if(password_verify($userData['password'],$user->password)){
                        $this->session_create($user->id);
                        return 'LS'; // Login successfull    
                    }else{ 
                        return "IP"; // Invalid password
                    }
                }else{
                    return "WU"; // Wront usertype
                }
            } else{ 
                return "IC"; // Invalid crendential
            }
        //}
        return 'IE'; // Invalid email
    } //End Function

    function session_create($lastId){

        $sql = $this->db->select('*')->where(array('id'=>$lastId))->get('users');
        if($sql->num_rows()):
            $user= $sql->row();
            $sessionData = array(
                'email'         => $user->email,
                'name'         => $user->name,
                'status'        => $user->status,
                'id'            => $user->id,
                'userType'      => $user->userType,
                'contactNo'     => $user->contactNo,
                //'status'     => $user->status,
                'front_login'   => true
            );
            $this->session->set_userdata($sessionData);
            return true;
        endif;
        return false; 

    } //End Of Function

    function getSellerProperty(){
        $res = $this->db->select('id')->where(array('sellerId'=>$this->session->userdata('id')))->get('property');
        return $res->num_rows();
    }
    
    function getUserInfo()
    {
        $req = $this->db->where(array('id'=>$this->session->userdata('id')))->get('users');
        
        if($req->num_rows()){
            $user = $req->row();
            
            if(empty($user->profileImage)){
                $user->profileImage = base_url().'/assets/front/images/default.png';
            } else {
                $user->profileImage = base_url().'/upload/profile/seller/'.$user->profileImage;
            }
            
            return $user;
        }        
        return FALSE;        
    }
    
    function updateProfile($userData)
    {
        $where = array('id'=>$this->session->userdata('user_id'));
        $this->db->update('users', $userData, $where);
    }

    /*function forgotPassword($email){

        $reqQuery = $this->db->select('email,name,password')->where(array('email'=>$email))->get('users');
        
        if($reqQuery->num_rows()){
            $name = $reqQuery->row()->name;
            $getEmail = $reqQuery->row()->email;
            $newPassword = $this->encrypt->decode($reqQuery->row()->password);
            $subject     = 'Bid Home Password';
            return $this->sendEmail($getEmail,$newPassword,$subject,$name);
        }
        return FALSE;
    }*/

    function randomKey($length) {

        $pool = array_merge(range(1,9), range(0,9),range(0,9));
        $key = '';
        for($i=0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }

        return $key;
    }

    function forgotPassword($email){

        $req = $this->db->select('id,email')->where(array('email'=>$email))->get('users');

        if($req->num_rows()){

            $res = $req->row();
            $key = $this->randomKey(8);
            $randPass = password_hash($key, PASSWORD_DEFAULT);
            $this->db->set('password',$randPass);
            $this->db->where('id',$res->id);
            $this->db->update('users');

            $record = $this->db->select('id,email,name,password')->where(array('email'=>$res->email))->get('users')->row();

            $useremail= $record->email;
            $password= $key ;
            $name =  "Hello ".''.$record->name;            
            $userData['name'] = $name ;
            $userData['password'] = $password;
            $message  = $this->load->view('forgot_password',$userData,TRUE); 
            $subject = "BidHome Forgot Password";

            return $this->sendEmail($useremail,$message,$subject);
        }else{
            return false;
        }
    }//end funtion


    function sendEmail($useremail,$message,$subject){

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

   /* function emailSent($email,$message,$subject)
    {
        $CI = & get_instance();

        
        $CI->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $CI->email->initialize($config);

        $CI->email->clear();
        $CI->email->set_newline("\r\n");

        $CI->email->from('deepaks.mindiii@gmail.com', 'AVA');
        $CI->email->to($email);
        $CI->email->subject($subject);
        $CI->email->message($message);

        $a = $CI->email->send();
        // var_dump($a);

        // die();

        if($CI->email->send()) return TRUE;

        return FALSE;   
    }  */

}
