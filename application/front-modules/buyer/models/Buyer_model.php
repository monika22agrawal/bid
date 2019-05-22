<?php

class Buyer_model extends CI_Model {

    function getLatLong($address){ // get lat and long by city name

        //$address = $data['address'];

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
    
    function getUserInfo()
    {
        $req = $this->db->select('*')->where(array('id'=>$this->session->userdata('id')))
                ->get('users');
        
        if($req->num_rows()){
            $buyer = $req->row();
            
            if(empty($buyer->profileImage)){
                $buyer->profileImage = base_url().'themes/front/img/default.png';
            } else {
                $buyer->profileImage = base_url().'upload/profile/buyer/'.$buyer->profileImage;
            }

            return $buyer;
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
        $buyerInfo['name'] = $userData['name'];
        $buyerInfo['contactNo'] = $userData['contactNo'];
        $buyerInfo['upd'] = date('Y-m-d H:i:s');
        if(!empty($userData['profileImage']))
            $buyerInfo['profileImage'] = $userData['profileImage'];
        
        $where = array('id'=>$this->session->userdata('id'));
        $this->db->update('users', $buyerInfo, $where);

        $this->User_model->session_create($this->session->userdata('id'));
        return true;
    }

    function getBuyerData($pwd){

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
    }

    function getAllPropertyType(){

        $q = $this->db->select('*')->get('propertyType');
        if($q->num_rows()>0){ 
            return $q->result();
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
            
            $this->db->select("property.id,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,propertyType.typeName,property.propertyProofStatus,property.latitude,property.longitude,property.isSold, ( 3959 * acos( cos( radians( ".$data['latitude']."  ) ) * cos( radians( property.latitude ) ) * cos( radians( property.longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( property.latitude ) ) ) ) AS distance"); 
            $this->db->having('distance <= ' . $miles);      
        
        }else{
            $this->db->select('property.id,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,propertyType.typeName,property.propertyProofStatus,property.isSold');
            $this->db->order_by('property.id','desc'); 
        }

        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.propertyProofStatus'=>1,'property.isSold'=>0));
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
                    'isSold' => $value->isSold,
                    'propertyStatus' => $value->propertyStatus
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
            
            $this->db->select("property.id,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,propertyType.typeName,property.propertyProofStatus,property.isSold,property.latitude,property.longitude, ( 3959 * acos( cos( radians( ".$data['latitude']."  ) ) * cos( radians( property.latitude ) ) * cos( radians( property.longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( property.latitude ) ) ) ) AS distance"); 
            $this->db->having('distance <= ' . $miles);      
        
        }else{
            $this->db->select('property.id,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.propertytypeId,property.address,property.propertyProofStatus,propertyType.typeName,property.isSold');
            $this->db->order_by('property.id','desc'); 
        }
        
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.propertyProofStatus'=>1,'property.isSold'=>0));
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

        $q = $this->db->select('property.*,propertyType.typeName,users.name,users.email')->from('property')->join('propertyType','propertyType.id = property.propertytypeId')->join('users','users.id = property.sellerId')->where('property.id',$pId)->get();

        if($q->num_rows()>0){ 

            $row = $q->row();

            $req = $this->db->select('isApproved,propertyStatus,bankStatement,newPropEndDate,proofOfFund,EOI,status')->where(array('buyerId'=>$this->session->userdata('id'),'propertyStatus'=>$row->propertyStatus,'pId'=>$row->id))->get('booking'); 
            $row->isApproved = '3';
            $row->bankStatement = '';
            $row->newPropEndDate = '';
            $row->proofOfFund = '';
            $row->EOI = '';
            $row->status = '';

            if($req->num_rows() > 0){
                
                $row->isApproved = $req->row()->isApproved;
                $row->bankStatement = $req->row()->bankStatement;
                $row->newPropEndDate = $req->row()->newPropEndDate;
                $row->proofOfFund = $req->row()->proofOfFund;
                $row->EOI = $req->row()->EOI;
                $row->status = $req->row()->status;
            }    

            $buyerBid = $this->db->select('bids.bidAmount,bids.buyerId,bids.pId')->from('bids')->where(array('bids.pId'=>$row->id,'buyerId'=>$this->session->userdata('id')))->get();

            $row->buyerBidAmount = '';

            if($buyerBid->num_rows() > 0){
                
                $row->buyerBidAmount = $buyerBid->row()->bidAmount;
            }

            $bidData = $this->db->select('max(bids.bidAmount) as bidAmount,bids.buyerId,bids.pId,users.name')->from('bids')->join('users','users.id = bids.buyerId')->where(array('bids.pId'=>$row->id))->get();

            $row->highestBidder = '';
            $row->highestBidAmt = '';

            if($bidData->num_rows() > 0){
                
                $row->highestBidder = $bidData->row()->name;
                $row->highestBidAmt = $bidData->row()->bidAmount;
            } 

            $paydetail = $this->db->select('paymentStatus')->where(array('buyerId'=>$this->session->userdata('id'),'pId'=>$row->id,'paymentType'=>1))->get('paymentDetail'); 
            $row->ispay = '';
            
            if($paydetail->num_rows() > 0){
                
                $row->ispay = $paydetail->row()->paymentStatus;
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

    function featuredProperty($pId){

        $req = $this->db->select('id,propertyName,purchaseAmount')->from('property')->where(array('id !='=>$pId,'propertyProofStatus' =>1,'isSold' =>0,'buyerId'=>0))->limit(3)->get();

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

    function getpropertyData($pId){

        $q = $this->db->select('sellerId,propertyStatus')->where('id',$pId)->get('property');
        if($q->num_rows()>0){ 
            return $q->row();
        }
    }

    function getBidTime($pId){

        $q = $this->db->select('*')->where('pId',$pId)->get('bidTime');
        if($q->num_rows()>0){ 
            return $q->row();
        }
    }

    function addPropertyPayment($propData){
        
        $this->db->insert('booking',$propData);

        if($propData['propertyStatus'] == 1){

            $where = array('id'=>$propData['pId']);
            $this->db->update('property', array('buyerId'=>$this->session->userdata('id'),'isSold'=>1), $where);
        }
        return true;
    }

    function uploadDocument($propData,$pId,$sellerId){

        $where = array('buyerId'=>$this->session->userdata('id'),'pId'=>$pId,'propertyStatus'=>1);
        $this->db->update('booking', $propData, $where);

        $where = array('id'=>$pId,'propertyStatus'=>1);
        $this->db->update('property', array('buyerId'=>$this->session->userdata('id'),'isSold'=>1), $where);
        return TRUE;
    }

    function applyBidding($bidData){

        $today = date('Y-m-d H:i:s');

        if( $today > $bidData['startDate'] && $today < $bidData['endDate'] ){

            $req = $this->db->select('*')->where(array('pId'=>$bidData['pId'],'buyerId'=>$bidData['buyerId']))->get('bids');

            if($req->num_rows()>0){ 

                    $reqBid = $this->db->select('max(bidAmount) as bidAmount,pId,buyerId')->where(array('pId'=>$bidData['pId']))->get('bids');
                    $reqBid = $reqBid->row();  
                    $amt = $reqBid->bidAmount;

                    if($amt < $bidData['bidAmount']){

                        $where = array('buyerId'=>$this->session->userdata('id'),'pId'=>$bidData['pId']);
                        $this->db->update('bids', array('bidAmount'=>$bidData['bidAmount'],'upd'=>date('Y-m-d H:i:s')), $where);

                        return 'BU'; // bid updated

                    }else{

                        return "AB"; // should be greater
                    }
               
            }else{
               
                $reqBid = $this->db->select('max(bidAmount) as bidAmount,pId,buyerId')->where(array('pId'=>$bidData['pId']))->get('bids');
                $reqBid = $reqBid->row();

                $amt = $reqBid->bidAmount;

                if($amt < $bidData['bidAmount']){

                    $this->db->insert('bids',array('pId'=>$bidData['pId'],'buyerId'=>$bidData['buyerId'],'bidAmount'=>$bidData['bidAmount'],'crd'=>date('Y-m-d H:i:s'),'upd'=>date('Y-m-d H:i:s')));

                    return 'AS'; // Added successfully

                }else{
                    $this->db->insert('bids',array('pId'=>$bidData['pId'],'buyerId'=>$bidData['buyerId'],'bidAmount'=>$bidData['bidAmount'],'crd'=>date('Y-m-d H:i:s'),'upd'=>date('Y-m-d H:i:s')));
                }
            }
        }else{
            return "BD"; // bidding done
        }
    }

    function timeElapsedString($datetime, $full = false) {

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' remaining' : '';

    } //end function

    function getAllCartPropertyList($limit,$start){
        
        $this->db->select('property.id,property.sellerId,property.propertyProofStatus,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.isSold,property.propertytypeId,property.address,propertyType.typeName');
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.buyerId'=>$this->session->userdata('id'),'property.isSold'=>1));
        $this->db->limit($limit,$start); 
        $this->db->order_by('property.id','desc'); 
        $req = $this->db->get();
        $newData = array();
        if($req->num_rows()){
            
            $detail =  $req->result();
            foreach ($detail as $k => $value) {

                $newData[$k] = array(
                    'propertyId' => $value->id,
                    'sellerId' => $value->sellerId,
                    'propertyName' => $value->propertyName,
                    'purchaseAmount' => '$'.$value->purchaseAmount,
                    'area' => $value->area,
                    'address' => $value->address,
                    'typeName' => $value->typeName,
                    'propertyStatus' => $value->propertyStatus,
                    'isSold' => $value->isSold,
                    'propertyProofStatus' => $value->propertyProofStatus
                );

                $remainingDays = $this->db->select('newPropEndDate')->where(array('pId'=>$value->id,'bankStatement'=>'','newPropEndDate >' =>date('Y-m-d H:i:s'),'propertyStatus'=>1))->get('booking')->row_array();
               
                $newData[$k]['remDays'] = $this->timeElapsedString($remainingDays['newPropEndDate']);
                
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
        /*echo '<pre>';
        print_r($newData);die;*/
        return $newData;
    }

    function countAllCartPropertyList() {

        $this->db->select('property.id,property.sellerId,property.propertyProofStatus,property.propertyName,property.purchaseAmount,property.area,property.propertyStatus,property.isSold,property.propertytypeId,property.address,propertyType.typeName');
        $this->db->from('property');
        $this->db->join('propertyType','propertyType.id = property.propertytypeId');
        $this->db->where(array('property.buyerId'=>$this->session->userdata('id'),'property.isSold'=>1));
        $this->db->order_by('property.id','desc');  

        $req = $this->db->get()->num_rows();       
        return $req;
    }

    function uploadPropertyFinalDocuments($propData,$pId,$sellerId,$propertyStatus){

        $where = array('buyerId'=>$this->session->userdata('id'),'pId'=>$pId,'propertyStatus'=>$propertyStatus);
        $this->db->update('booking', $propData, $where);
        return true;
    }

    function addPayment($transactionId,$chargeId,$pId,$payment,$status){
        
        $data['buyerId'] = !empty($this->session->userdata('id')) ? $this->session->userdata('id') : '';
        $data['transactionId'] = $transactionId;
        $data['chargeId'] = $chargeId;
        $data['pId'] = $pId;
        $data['totalAmount'] = $payment;
        $data['adminAmount'] = $payment;
        $data['paymentType'] = 2;
        $data['transactionDateTime'] = date('Y-m-d H:i:s');
        $data['paymentStatus'] = $status;
        $this->db->insert('paymentDetail',$data);
        return true;
    }

    function updatePayment($transactionId,$chargeId,$pId,$payment,$status){
        
        $data['buyerId'] = !empty($this->session->userdata('id')) ? $this->session->userdata('id') : '';
        $data['transactionId'] = $transactionId;
        $data['chargeId'] = $chargeId;
        $data['pId'] = $pId;
        $data['totalAmount'] = $payment;
        $data['adminAmount'] = $payment;
        $data['transactionDateTime'] = date('Y-m-d H:i:s');
        $data['paymentStatus'] = $status;
        $data['paymentType'] = 1;
        $this->db->insert('paymentDetail',$data);
        return true;
    }

} // end of class
