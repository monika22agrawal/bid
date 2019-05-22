<?php

class Seller_model extends CI_Model {

    //Creates directory 
    function makedirs($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='/upload/'){

        if(!@is_dir(FCPATH . $defaultFolder)) {

            mkdir(FCPATH . $defaultFolder, $mode);
        }
        if(!empty($folder)) {

            if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
            }
        } 
    }

    function updateGallery($fileName,$folder)
    {
        $this->makedirs($folder);
        $uploadPath = FCPATH . 'upload/' . $folder; 
        $storedFile = array();

        $files = $_FILES[$fileName];        
        $number_of_files = sizeof($_FILES[$fileName]['tmp_name']);
        // we first load the upload library
        $this->load->library('upload');
        // next we pass the upload path for the images
        $overwrite = FALSE;
        $config['upload_path'] = $uploadPath;
        // also, we make sure we allow only certain type of images
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '2048000';
        $config['encrypt_name'] = TRUE;
   
        for ($i = 0; $i < $number_of_files; $i++)
        {
            $_FILES[$fileName]['name'] = $files['name'][$i];
            $_FILES[$fileName]['type'] = $files['type'][$i];
            $_FILES[$fileName]['tmp_name'] = $files['tmp_name'][$i];
            $_FILES[$fileName]['error'] = $files['error'][$i];
            $_FILES[$fileName]['size'] = $files['size'][$i];

            //now we initialize the upload library
            $this->upload->initialize($config);
            if ($this->upload->do_upload($fileName))
            {
                $savedFile = $this->upload->data();//upload the image
                $folder_thumb = $folder.'/thumb/';
                $this->makedirs($folder_thumb);

                $width = 450;
                $height = 400;

                //your desired config for the resize() function
                $data = array(
                    'image_library' => 'gd2',
                    'source_image' =>$savedFile['full_path'], //get original image
                    'overwrite' =>FALSE,
                    'maintain_ratio' =>FALSE,
                    'create_thumb' => FALSE,
                    'width' => $width,
                    'height' => $height,
                    'new_image' => FCPATH.'upload/'.$folder_thumb.$savedFile['file_name'],
                );                 

                $folder_thumb1 = $folder.'/resize/';
                $this->makedirs($folder_thumb1);

                $width = 400;
                $height = 268;

                //your desired config for the resize() function
                $imgResize = array(
                    'image_library' => 'gd2',
                    'source_image' =>$savedFile['full_path'], //get original image
                    'overwrite' =>FALSE,
                    'maintain_ratio' =>FALSE,
                    'create_thumb' => FALSE,
                    'width' => $width,
                    'height' => $height,
                    'new_image' => FCPATH.'upload/'.$folder_thumb1.$savedFile['file_name'],
                );  

                $this->load->library('image_lib'); //load image_library
                $this->image_lib->initialize($data);    
                $this->image_lib->initialize($imgResize);

                if ( ! $this->image_lib->resize()){
                    $error = array('error' =>$this->image_lib->display_errors()); 
                    
                } else {
                    $thumb = $this->image_lib->resize($fileName); //generating thumb 
                    $storedFile[$i]['name'] = $savedFile['file_name'];
                    $storedFile[$i]['type'] = $savedFile['file_type'];
                }
                $this->image_lib->clear();
            } else {
                $storedFile[$i]['error'] = $this->upload->display_errors();
            }
        }
        return $storedFile;
    }

    function getLatLong($address){ // get lat and long by city name

        //$address = $data['address'];

        if(!empty($address)){
           
            $formattedAddr = str_replace(' ','+',$address);

            $url = 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyAH_tbuOQjByUQDu3fwDnBzXtVVEyQK9Ao&address='.$formattedAddr.'&sensor=false';
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
    
    function getUserInfo()
    {
        $req = $this->db->select('*')->where(array('id'=>$this->session->userdata('id')))
                ->get('users');
        
        if($req->num_rows()){
            $seller = $req->row();
            
            if(empty($seller->profileImage)){
                $seller->profileImage = base_url().'themes/front/img/default.png';
            } else {
                $seller->profileImage = base_url().'upload/profile/seller/'.$seller->profileImage;
            }

            return $seller;
        }
        return FALSE;
    }

    function checkCNO($contactNo){

        $isExist = $this->db->get_where('users',array('contactNo'=>$contactNo,'id !='=>$this->session->userdata('id')))->row();
        if(!empty($isExist)){
            return false;
        }else{
            return true;
        }
    }

    function updateProfile($userData)
    {  
        $sellerInfo['name'] = $userData['name'];
        $sellerInfo['contactNo'] = $userData['contactNo'];
        $sellerInfo['upd'] = date('Y-m-d H:i:s');

        if(!empty($userData['profileImage']))
            $sellerInfo['profileImage'] = $userData['profileImage'];
        
        $where = array('id'=>$this->session->userdata('id'));
        $this->db->update('users', $sellerInfo, $where);

        $this->User_model->session_create($this->session->userdata('id'));
        return true;
    }

    function getSellerData($pwd){

        $this->load->library('encrypt');
        $check = $this->db->get_where('users',array('id'=>$this->session->userdata('id')))->row();
        if(!empty($check)){    
            if(password_verify($pwd,$check->password)){
                return TRUE;
            }
        }
        return FALSE;
    }

    function updatePassword($pwd){
        $where = array('id'=>$this->session->userdata('id'));
        $this->db->update('users', $pwd, $where);
        return TRUE;
        
    } // end of function

    function getAllActivePropertyType(){

        $q = $this->db->select('*')->where('status',1)->get('propertyType');
        if($q->num_rows()>0){ 
            return $q->result();
        }
    }

    function getAllPropertyType(){

        $q = $this->db->select('*')->get('propertyType');
        if($q->num_rows()>0){ 
            return $q->result();
        }
    }

    function addProperty($insertdata,$pImage,$bidTime){

        $query = $this->db->select('*')->where(array('status'=>1,'userType'=>'1','id'=>$this->session->userdata('id')))->get('users')->row_array();   
        
        if(!empty($query)){

            $var = $this->getLatLong($insertdata['address']);

            $insertdata['latitude'] = $var['latitude'];
            $insertdata['longitude'] = $var['longitude'];

            if(!empty($insertdata['latitude']) && !empty($insertdata['longitude'])){

                $this->db->insert('property',$insertdata);
                $lastId = $this->db->insert_id();
            
                if(!empty($lastId)){

                    $imgData = array();
                    if(is_array($pImage['pImage']) && !empty($pImage['pImage'])){
                        $i = 0;
                        foreach($pImage['pImage'] as $val) {
                            
                            $imgData[$i]['pImage'] = !empty($val) ? $val : '';
                            $imgData[$i]['pId'] = $lastId;                  

                            $this->db->insert('propertyImages',$imgData[$i]);
                            
                            $i++;
                        }
                    }
                    
                    if(!empty($bidTime)){
                        $bidTime['pId'] = $lastId;
                        $this->db->insert('bidTime',$bidTime);     
                    }
                    
                    return 'PA'; // property added

                }else{
                    return false;
                }   
            }else{
                return 'ED'; // empty latlong
            }             
        }else{
            return 'NA'; // not active
        }
    }

    function getAllPropertyList($limit,$start,$searchArray){

        $var = $this->getLatLong($searchArray['address']);
    
        $data['latitude'] = $var['latitude'];
        $data['longitude'] = $var['longitude'];

        $var = explode('-', $searchArray['priceVal']);
       
        if(isset($var[0]) && isset($var[1])){
             
            $min = $var[0];       
            $max = $var[1];
            if($max == 'more'){
                $wherePrice = "purchaseAmount > ".$min."";  
            }else{
                if($min == 0){
                    $min = 1;
                    $wherePrice = "purchaseAmount BETWEEN ".$min." AND ".$max."";   
                }else{
                    $wherePrice = "purchaseAmount BETWEEN ".$min." AND ".$max."";
                }
            }
            
        } else{
            $min = $max = $wherePrice = '';
        }

        $area = explode('-', $searchArray['areaVal']);     
          
        if(isset($area[0]) && isset($area[1])){
             
            $minArea = $area[0];       
            $maxArea = $area[1];                     
            $whereArea = "area BETWEEN ".$minArea." AND ".$maxArea."";            
            
        } else{
            $minArea = $maxArea = $whereArea = '';
        }

        $miles = '20';
        if(!empty($data['latitude']) && !empty($data['longitude'])){
            
            $this->db->select("property.id,property.sellerId,property.propertyProofStatus,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,propertyType.typeName,property.latitude,property.longitude,property.isSold, ( 3959 * acos( cos( radians( ".$data['latitude']."  ) ) * cos( radians( property.latitude ) ) * cos( radians( property.longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( property.latitude ) ) ) ) AS distance"); 
            $this->db->having('distance <= ' . $miles);      
        
        }else{
            $this->db->select('property.id,property.sellerId,property.propertyProofStatus,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,property.isSold,propertyType.typeName');
            $this->db->order_by('property.id','desc'); 
        }

        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.sellerId'=>$this->session->userdata('id'),'property.isSold'=>0));
        !empty($searchArray['type']) ? $this->db->where(array('property.propertytypeId'=>$searchArray['type'])) : '';
        !empty($searchArray['bedRoom']) ? $this->db->where(array('property.bedRoom'=>$searchArray['bedRoom'])) : '';
        !empty($searchArray['bathRoom']) ? $this->db->where(array('property.bathRoom'=>$searchArray['bathRoom'])) : '';
        !empty($searchArray['carParking']) ? $this->db->where(array('property.carParking'=>$searchArray['carParking'])) : '';
        !empty($searchArray['swimmingPool']) ? $this->db->where(array('property.swimmingPool'=>$searchArray['swimmingPool'])) : '';
        !empty($searchArray['propStatus']) ? $this->db->where(array('property.propertyStatus'=>$searchArray['propStatus'])) : '';
        (!empty($wherePrice)) ? $this->db->where($wherePrice) : '';

        (!empty($whereArea)) ? $this->db->where($whereArea) : '';

        $this->db->limit($limit,$start); 
        $this->db->order_by('property.id','desc'); 
        $req = $this->db->get();
        $newData = array();
        if($req->num_rows()){
            
            $detail =  $req->result();
            foreach ($detail as $k => $value) {

                $newData[$k] = array(
                    'propertyId' => $value->id,
                    'propertyName' => $value->propertyName,
                    'purchaseAmount' => '$'.$value->purchaseAmount,
                    'area' => $value->area,
                    'address' => $value->address,
                    'typeName' => $value->typeName,
                    'propertyStatus' => $value->propertyStatus,
                    'isSold' => $value->isSold,
                    'propertyProofStatus' => $value->propertyProofStatus
                );
                
                $imgs = $this->db->select('*')->where(array('pId'=>$value->id))->get('propertyImages')->row_array();
                
                if(!empty($imgs)){
                    if(!empty($imgs['pImage'])){
                        $newData[$k]['pImage'] = base_url().'upload/propertyImage/'.$imgs['pImage'];
                    }else{
                       $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                    }
                }else{
                    $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                }               
            }
        } 
        return $newData;
    }

    function countAllPropertyList($searchArray) {

        $var = $this->getLatLong($searchArray['address']);
    
        $data['latitude'] = $var['latitude'];
        $data['longitude'] = $var['longitude'];

        $var = explode('-', $searchArray['priceVal']);
       
        if(isset($var[0]) && isset($var[1])){
             
            $min = $var[0];       
            $max = $var[1];
            if($max == 'more'){
                $wherePrice = "purchaseAmount > ".$min."";  
            }else{
                if($min == 0){
                    $min = 1;
                    $wherePrice = "purchaseAmount BETWEEN ".$min." AND ".$max."";   
                }else{
                    $wherePrice = "purchaseAmount BETWEEN ".$min." AND ".$max."";
                }
            }
            
        } else{
            $min = $max = $wherePrice = '';
        }

        $area = explode('-', $searchArray['areaVal']); 

        if(isset($area[0]) && isset($area[1])){
             
            $minArea = $area[0];       
            $maxArea = $area[1];                     
            $whereArea = "area BETWEEN ".$minArea." AND ".$maxArea."";            
            
        } else{
            $minArea = $maxArea = $whereArea = '';
        }

        $miles = '20';
        if(!empty($data['latitude']) && !empty($data['longitude'])){
            
            $this->db->select("property.id,property.sellerId,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,propertyType.typeName,property.latitude,property.longitude,property.isSold, ( 3959 * acos( cos( radians( ".$data['latitude']."  ) ) * cos( radians( property.latitude ) ) * cos( radians( property.longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( property.latitude ) ) ) ) AS distance"); 
            $this->db->having('distance <= ' . $miles);      
        
        }else{
            $this->db->select('property.id,property.sellerId,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,property.isSold,propertyType.typeName');
            $this->db->order_by('property.id','desc'); 
        }
        
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.sellerId'=>$this->session->userdata('id'),'property.isSold'=>0));
        !empty($searchArray['type']) ? $this->db->where(array('property.propertytypeId'=>$searchArray['type'])) : '';
        !empty($searchArray['bedRoom']) ? $this->db->where(array('property.bedRoom'=>$searchArray['bedRoom'])) : '';
        !empty($searchArray['bathRoom']) ? $this->db->where(array('property.bathRoom'=>$searchArray['bathRoom'])) : '';
        !empty($searchArray['carParking']) ? $this->db->where(array('property.carParking'=>$searchArray['carParking'])) : '';
        !empty($searchArray['swimmingPool']) ? $this->db->where(array('property.swimmingPool'=>$searchArray['swimmingPool'])) : '';
        !empty($searchArray['propStatus']) ? $this->db->where(array('property.propertyStatus'=>$searchArray['propStatus'])) : '';
        (!empty($wherePrice)) ? $this->db->where($wherePrice) : '';

         (!empty($whereArea)) ? $this->db->where($whereArea) : '';

        $req = $this->db->get()->num_rows();       
        return $req;
    }

    function viewProperty($pId){

        $q = $this->db->select('property.*,propertyType.typeName')->from('property')->join('propertyType','propertyType.id = property.propertytypeId')->where('property.id',$pId)->get();

        if($q->num_rows()>0){   

            $row = $q->row();

            $newProp = $this->db->select('id,status,propertyStatus,isApproved')->where(array('sellerId'=>$this->session->userdata('id'),'pId'=>$row->id))->get('booking'); 

            $row->isBooked = '1';
            
            if($newProp->num_rows() > 0){

                $row->isBooked = '';

                $nd = $newProp->row();

                if($nd->propertyStatus == '2' && $nd->isApproved == '0'){
                    $row->isBooked = '1';

                }else if($nd->propertyStatus == '1' && $nd->status == '2'){
                    $row->isBooked = '1';
                }                 
            } 

            $sql = 'SELECT * from bids where bidAmount = (select max(bidAmount) from bids where pId='.$row->id.') and pId="'.$row->id.'"'; 
            $bidData= $this->db->query($sql);
           
            $row->highestBidder = '';
            $row->highestBidAmt = '';

            if($bidData->num_rows() > 0){

                $bidderName = $this->db->select('name')->where(array('id'=>$bidData->row()->buyerId))->get('users');

                $row->highestBidder = $bidderName->row()->name;
                $row->highestBidAmt = $bidData->row()->bidAmount;
            }

            $req = $this->db->select('property.buyerId,users.name,users.email')->from('property')->join('users','users.id = property.buyerId')->where(array('property.id'=>$row->id,'property.isSold'=>1))->get();

            $row->soldToName = '';
            $row->soldToEmail = '';

            if($req->num_rows() > 0){

                $row->soldToName = $req->row()->name;
                $row->soldToEmail = $req->row()->email;
            }
            
            return $row;
        }
    }

    function getPropertyImages($pId){

        $q = $this->db->select('*')->from('propertyImages')->where(array('pId'=>$pId))->get();
        if($q->num_rows()>0){

            $result = $q->result();
            foreach ($result as $k =>$row) {

                if(!empty($row->pImage)){

                    $result[$k]->pImage = base_url().'upload/propertyImage/'.$row->pImage;
                }else{

                    $result[$k]->pImage = base_url().FRONT_THEME.'images/defaultProduct.png';
                }               
            }
            return $result;
        }
    }

    function recentAddedProperty($pId){
        $req = $this->db->select('id,propertyName,purchaseAmount')->from('property')->where(array('id !='=>$pId,'sellerId'=>$this->session->userdata('id'),'propertyProofStatus' =>1,'isSold' =>0,'buyerId'=>0))->limit(3)->get();

        $newData = array();
        if($req->num_rows()){
            
            $detail =  $req->result();
            foreach ($detail as $k => $value) {

                $newData[$k] = array(
                    'propertyId' => $value->id,
                    'propertyName' => $value->propertyName,
                    'purchaseAmount' => '$'.$value->purchaseAmount
                );
                
                $imgs = $this->db->select('*')->where(array('pId'=>$value->id))->get('propertyImages')->row_array();
                
                if(!empty($imgs)){
                    if(!empty($imgs['pImage'])){
                        $newData[$k]['pImage'] = base_url().'upload/propertyImage/'.$imgs['pImage'];
                    }else{
                       $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                    }
                }else{
                    $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                }               
            }
        } 
        return $newData;
    }

    function getAllBidders($pId){

        $req = $this->db->select('bids.bidAmount,bids.buyerId,bids.pId,bids.upd,users.name')->from('bids')->join('users','users.id = bids.buyerId')->where(array('bids.pId'=>$pId))->order_by('bids.bidAmount','DESC')->get();
        $newData = array();
        if($req->num_rows()){
            
            $detail =  $req->result();
            foreach ($detail as $k => $value) {

                $newData[$k] = array(
                    'bidAmount' => '$'.$value->bidAmount,
                    'bidderName' => $value->name,
                    'upd' => date('d M Y, H:i:s',strtotime($value->upd))
                );              
            }
        } 
        return $newData;
    }

    function countAllBidders($pId){

        $this->db->select('bids.bidAmount,bids.buyerId,bids.pId,bids.crd,users.name');
        $this->db->from('bids');
        $this->db->join('users','users.id = bids.buyerId');
        $this->db->where(array('bids.pId'=>$pId));
        $this->db->order_by('bids.bidAmount','DESC');
        $req = $this->db->get()->num_rows();       
        return $req;
    }

    function getBidTime($pId){

        $req = $this->db->select('*')->from('bidTime')->where('pId',$pId)->get();
        if($req->num_rows()>0){            
            return $req->row();
        }
    }

    function updateRecord($data, $bidTime, $id){
       
        $new = 1;
        if(!empty($data['address'])){
            $new = array();
            $var = $this->getLatLong($data['address']);

            $data['latitude'] = $var['latitude'];
            $data['longitude'] = $var['longitude'];
            $new['latitude'] = $var['latitude'];
            $new['longitude'] = $var['longitude'];
        }

        $where = array('id'=>$id);
        $this->db->update('property', $data, $where);

        if(!empty($bidTime)){
            $where = array('pId'=>$id);
            $this->db->update('bidTime',$bidTime); 
        }
        return $new;
    }

    function updatePropertyImage($id, $pId, $img){

        $where = array('id'=>$id,'pId'=>$pId);
        $this->db->update('propertyImages', $img, $where);

        return TRUE;
    }

    function addPropertyImage($img){
        
        $this->db->insert('propertyImages', $img);
        $lastId = $this->db->insert_id();
        return $lastId;
    }

    function deletePropertyImage($id, $pId){

        $this->db->where(array('id'=>$id,'pId'=>$pId));
        $this->db->delete('propertyImages');
        
        return true; 
    }

    function getAllSoldPropertyList($limit,$start){

        
        $this->db->select('property.id,property.propertyProofStatus,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.isSold,property.propertytypeId,property.address,property.isSold,propertyType.typeName');
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.sellerId'=>$this->session->userdata('id'),'property.isSold'=>1));
        $this->db->limit($limit,$start); 
        $this->db->order_by('property.id','desc'); 
        $req = $this->db->get();
        $newData = array();
        if($req->num_rows()){
            
            $detail =  $req->result();
            foreach ($detail as $k => $value) {

                $newData[$k] = array(
                    'propertyId' => $value->id,
                    'propertyName' => $value->propertyName,
                    'purchaseAmount' => '$'.$value->purchaseAmount,
                    'area' => $value->area,
                    'address' => $value->address,
                    'typeName' => $value->typeName,
                    'propertyStatus' => $value->propertyStatus,
                    'isSold' => $value->isSold,
                    'propertyProofStatus' => $value->propertyProofStatus
                );
                
                $imgs = $this->db->select('*')->where(array('pId'=>$value->id))->get('propertyImages')->row_array();
                
                if(!empty($imgs)){
                    if(!empty($imgs['pImage'])){
                        $newData[$k]['pImage'] = base_url().'upload/propertyImage/'.$imgs['pImage'];
                    }else{
                       $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                    }
                }else{
                    $newData[$k]['pImage'] = base_url().FRONT_THEME.'img/defaultProduct.png';
                }               
            }
        } 
        return $newData;
    }

    function countAllSoldPropertyList() {

        $this->db->select('property.id,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.isSold,property.address,property.isSold,propertyType.typeName');        
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.sellerId'=>$this->session->userdata('id'),'property.isSold'=>1));
        $this->db->order_by('property.id','desc'); 

        $req = $this->db->get()->num_rows();       
        return $req;
    }

} // end of class
