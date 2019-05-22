<?php
class Property_model extends CI_Model {

	function upload_doc($profile_image,$folder)
	{ 
		$this->makedirs($folder);
		$config = array(
			'upload_path' => FCPATH.'../upload/'.$folder,
			'allowed_types' => "gif|jpg|png|jpeg|JPG|PNG|JPEG|doc|docx|xls|ppt|pdf|txt",
			'overwrite' => false,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'encrypt_name'=>TRUE ,
			'remove_spaces'=>TRUE
		);

	  	$this->load->library('upload');
	  	$this->upload->initialize($config);

	  	if(!$this->upload->do_upload($profile_image)){
   			$error = array('error' => $this->upload->display_errors());
			return $error;

		} else {

			$this->load->library('image_lib');
			$folder_thumb = $folder.'/thumb/';
			$this->makedirs($folder_thumb);

			$width = 100;
			$height = 100;

			$image_data = $this->upload->data(); //upload the image

			$resize['source_image'] = $image_data['full_path'];
			$resize['new_image'] = realpath(APPPATH . '../upload/' . $folder_thumb);
			$resize['maintain_ratio'] = true;
			$resize['width'] = $width;
			$resize['height'] = $height;

			//send resize array to image_lib's  initialize function
			$this->image_lib->initialize($resize);
			$this->image_lib->resize();
			$this->image_lib->clear();

			return $image_data['file_name'];
		}
	}

	//Creates directory 
	
	function makedirs($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='../upload'){

		if(!@is_dir(FCPATH . $defaultFolder)) {

			mkdir(FCPATH . $defaultFolder, $mode);
		}
		if(!empty($folder)) {

			if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
				mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
			}
		} 
	}
	
	function addPropertyType($data) {

		$res = $this->db->select('id')->where(array('typeName'=>$data['typeName']))->get('propertyType');
		if($res->num_rows()){
			return 'AE';
		} else {
			$this->db->insert('propertyType',$data);
			return true;
		}
	}

	function getAllPropertyType($limit,$start,$search){

		$this->db->select('*');
		$this->db->from('propertyType');
		(!empty( $search)) ? $this->db->like('typeName', trim($search)) : '';
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$req = $this->db->get();
		
		if($req->num_rows()){
			$res = $req->result();
			return $res;
		}
		return FALSE;
	}
	
	function countAllPropertytype($search) {
		(!empty( $search)) ? $this->db->like('typeName', trim($search)) : '';
		return $this->db->count_all_results("propertyType");
	}

	function showPTypeInfo($id) {

		$this->db->select('*')->from('propertyType')->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	function updatePropertyType($data,$id) {

		$res = $this->db->select('id')->where(array('typeName'=>$data['typeName'],'id != '=>$id))->get('propertyType');
		if($res->num_rows() == 0){	
			$this->db->where('id',$id);
			$this->db->update('propertyType',$data);
			return true;
		}else{		
			return FALSE;
		}
	}

	function activePtype($id) {

		$data = $this->db->select('status')->from('propertyType')->where($id)->get();
		$userStatus = $data->row()->status;
		
		if($userStatus == 1){
			$status = "0";
		}else{
			$status = "1";
		}
		$this->db->where($id)->update('propertyType',array('status'=>$status));
		return  $status;
	}

	function deletePType($id) {

		$this->db->where('id',$id);
		$this->db->delete('propertyType');
		return true;
	}

	function getAllProperty($limit,$start,$search,$status){

		$this->db->select('property.id,property.propertyStatus,property.propertyName,property.isSold,property.sellerId,property.buyerId,sUser.name as sName,bUser.name as bName');
		$this->db->from('property');
		$this->db->join('users as sUser','sUser.id = property.sellerId');
		$this->db->join('users as bUser','bUser.id = property.buyerId','left');
		!empty($status) ? $this->db->where('property.propertyStatus',$status) : '';
		(!empty( $search)) ? $this->db->like('property.propertyName', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('sUser.name', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('bUser.name', trim($search)) : '';
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$req = $this->db->get();
		
		if($req->num_rows()){
			$res = $req->result();
			return $res;
		}
		return FALSE;
	}
	
	function countAllProperty($search,$status) {
		$this->db->select('property.id,property.propertyStatus,property.propertyName,property.isSold,property.sellerId,property.buyerId,sUser.name as sName,bUser.name as bName');
		$this->db->from('property');
		$this->db->join('users as sUser','sUser.id = property.sellerId');
		$this->db->join('users as bUser','bUser.id = property.buyerId','left');
		!empty($status) ? $this->db->where('property.propertyStatus',$status) : '';
		(!empty( $search)) ? $this->db->like('property.propertyName', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('sUser.name', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('bUser.name', trim($search)) : '';
		$this->db->order_by('id','desc');
		$req = $this->db->get();
		return $req->num_rows();
	}

	function getSellerDetail($sId){

		$req = $this->db->select('name,email,contactNo,postcode')->where(array('id'=>$sId))->get('users');
		if($req->num_rows() > 0){
			return $req->row();
		}
	}

	function getBuyerDetail($pId,$sId){

		$req = $this->db->select('buyerId')->where(array('id'=>$pId))->get('property');

		if($req->num_rows() > 0){

			$buyerId = $req->row()->buyerId;

			if($buyerId > 0){

				$bData = $this->db->select('name,email,contactNo,postcode')->where(array('id'=>$buyerId))->get('users');

				if($bData->num_rows() > 0){
					return $bData->row();
				}
			}
		}
	}

	function getPropertyDetail($pId){

		$this->db->select('property.id,property.sellerId,property.propertyName,property.propertytypeId,property.purchaseAmount,property.area,property.propertyStatus,property.bedRoom,property.bathRoom,property.carParking,property.swimmingPool,property.address,property.description,property.isSold,property.crd,property.propertyProof,property.propertyProofStatus,property.inspectionReport,propertyType.typeName');
		$this->db->from('property');
		$this->db->join('propertyType','propertyType.id = property.propertytypeId');
		$this->db->where('property.id',$pId);
		$req = $this->db->get();
		
		if($req->num_rows()){

			$res = $req->row_array();

			$req = $this->db->select('startDateTime,endDateTime')->where(array('sellerId'=>$res['sellerId'],'pId'=>$res['id']))->get('bidTime'); 

            $res['startDateTime'] = '';
            $res['endDateTime'] = '';

            if($req->num_rows() > 0){
                
                $res['startDateTime'] = $req->row()->startDateTime;
                $res['endDateTime'] = $req->row()->endDateTime;
            } 
			return $res;
		}
	}

	function getNewPropertyBuyerData($pId){

		$sql = $this->db->select('booking.*,users.name')->from('booking')->join('users','users.id = booking.buyerId')->where(array('booking.propertyStatus'=>'1','booking.pId'=>$pId,'booking.newPropEndDate >' => date('Y-m-d H:i:s')))->get();
        if($sql->num_rows() > 0){

            $data = $sql->row_array();
            return $data;
        }
	}

	function getPropertyImg($pId){
		$img = $this->db->select('*')->get_where('propertyImages',array('pId'=>$pId))->result_array();
		if(!empty($img)){
			return $img;
		}
	}

	function activePstatus($id,$status) {

		$this->db->where($id)->update('property',array('propertyProofStatus'=>$status));
		return  $status;
	}

	function getAllPropertyBidder($limit,$start,$pId){

		$this->db->select('booking.id,booking.isApproved,booking.crd,booking.bookingAmount,booking.pId,booking.buyerId,booking.sellerId,booking.bankStatement,bidTime.pId,bidTime.startDateTime,bidTime.endDateTime,users.name,property.buyerId as bId');
		$this->db->from('booking');
		$this->db->join('property','property.id = booking.pId');
		$this->db->join('users','users.id = booking.buyerId');
		$this->db->join('bidTime','bidTime.pId = property.id');
		$this->db->where(array('booking.pId'=>$pId,'booking.propertyStatus'=>'2'));
		$this->db->limit($limit,$start);
		$this->db->order_by('booking.id','desc');
		$req = $this->db->get();
		$newData = array();
		if($req->num_rows()){
			$res = $req->result();
			foreach ($res as $k => $value) {

                $newData[$k] = array(
                    'name' => $value->name,
                    'bookingAmount' => $value->bookingAmount,
                    'bankStatement' => $value->bankStatement,
                    'id' => $value->id,
                    'pId' => $value->pId,
                    'sellerId' => $value->sellerId,
                    'buyerId' => $value->buyerId,
                    'startDateTime' => $value->startDateTime,
                    'endDateTime' => $value->endDateTime,
                    'crd' => $value->crd,
                    'isApproved' => $value->isApproved,
                    'bId' => $value->bId
                );
                
                $bidAmt = $this->db->select('bidAmount')->where(array('pId'=>$value->pId,'buyerId'=>$value->buyerId))->get('bids')->row_array();

                if(!empty($bidAmt)){
                   	$newData[$k]['bidAmount'] = $bidAmt['bidAmount'];
                }else{
                    $newData[$k]['bidAmount'] = '';
                } 


                $chargeIds = $this->db->select('chargeId,totalAmount,refundId')->where(array('pId'=>$value->pId,'buyerId'=>$value->buyerId,'paymentType'=>2))->get('paymentDetail')->row_array();
                
                if(!empty($chargeIds)){
                   	$newData[$k]['chargeId'] = $chargeIds['chargeId'];
                   	$newData[$k]['refundId'] = $chargeIds['refundId'];
                }else{
                    $newData[$k]['chargeId'] = '';
                    $newData[$k]['refundId'] = '';
                }               
            }
            
			return $newData;	
		}
		return FALSE;
	}
	
	function countAllPropertyBidder($pId) {

		$this->db->select('booking.id,booking.isApproved,booking.crd,booking.bookingAmount,booking.pId,booking.buyerId,booking.sellerId,booking.bankStatement,bidTime.pId,bidTime.startDateTime,bidTime.endDateTime,users.name,property.buyerId as bId');
		$this->db->from('booking');
		$this->db->join('property','property.id = booking.pId');
		$this->db->join('users','users.id = booking.buyerId');
		$this->db->join('bidTime','bidTime.pId = property.id');
		$this->db->where(array('booking.pId'=>$pId,'booking.propertyStatus'=>'2'));
	
		$this->db->order_by('booking.id','desc');
		$req = $this->db->get();
		return $req->num_rows();
	}

	function approveBidRequest($id,$status,$buyerId,$pId,$sellerId) {

		//$this->db->where($id)->update('booking',array('isApproved'=>$status));

		$getPropData = $this->db->select('propertyName,id')->where(array('id'=>$pId,'sellerId'=>$sellerId))->get('property');

		if($getPropData->num_rows()){

			$new = $getPropData->row();
			$propName = $new->propertyName;
			$propId = $new->id;
		}

		if($status == 1){

			$this->db->where(array('id'=>$id))->update('booking',array('isApproved'=>1,'upd'=>date('Y-m-d H:i:s')));			
        	$subject = "Congratulations";
        	$content = "Your bid request has been aaproved for '".$propName."' property.Now you can apply bid for purchasing this property.";

        	$msg = array('status'=>1,'msg'=>'Bank statement approved successfully.');

		}else{

			$this->db->where(array('id'=>$id))->update('booking',array('isApproved'=>2,'upd'=>date('Y-m-d H:i:s')));

        	$subject = "Sorry";
        	$content = "You have requested for '".$propName."' property, but it is not approved by admin.";
        	$msg = array('status'=>0,'msg'=>'Bank statement not approved.');
		}		

		$getUserDetail = $this->db->select('name,email')->where(array('id'=>$buyerId))->get('users')->row();

        $useremail= $getUserDetail->email;

        $userData['name'] = $subject.' '.$getUserDetail->name;
        $userData['id'] = $propId;
        $userData['propertyName'] = $propName;
        $userData['content'] = $content;
        
        $message  = $this->load->view('approve_mail',$userData,TRUE);
        
        $this->emailSent($useremail,$message,$subject);
		
		return  $msg;
	}

	function approveNewPropRequest($id,$status,$buyerId,$pId,$sellerId) {

		$getPropData = $this->db->select('propertyName,id')->where(array('id'=>$pId,'sellerId'=>$sellerId))->get('property');

		if($getPropData->num_rows()){

			$new = $getPropData->row();
			$propName = $new->propertyName;
			$propId = $new->id;
		}

		if($status == 1){

			$this->db->where(array('id'=>$id))->update('booking',array('isApproved'=>1,'status'=>1,'upd'=>date('Y-m-d H:i:s')));			
			$where = array('id'=>$pId,'propertyStatus'=>1);
        	$this->db->update('property', array('buyerId'=>$buyerId,'isSold'=>1), $where);

        	$subject = "Congratulations";
        	$content = "You have reserved '".$propName."' property, and it is approved by admin.Now we will let you know further process of this property.";

        	$msg = array('status'=>1,'msg'=>'Bank statement approved successfully.');

		}else{

			$this->db->where(array('id'=>$id))->update('booking',array('isApproved'=>2,'status'=>2,'upd'=>date('Y-m-d H:i:s')));
			$where = array('id'=>$pId,'propertyStatus'=>1);
        	$this->db->update('property', array('buyerId'=>0,'isSold'=>0), $where);

        	$subject = "Sorry";
        	$content = "You have reserved '".$propName."' property, but it is not approved by admin.";
        	$msg = array('status'=>0,'msg'=>'Bank statement not approved.');
		}		

		$getUserDetail = $this->db->select('name,email')->where(array('id'=>$buyerId))->get('users')->row();

        $useremail= $getUserDetail->email;

        $userData['name'] = $subject.' '.$getUserDetail->name;
        $userData['id'] = $propId;
        $userData['propertyName'] = $propName;
        $userData['content'] = $content;
        
        $message  = $this->load->view('approve_mail',$userData,TRUE);
        
        $this->emailSent($useremail,$message,$subject);
		
		return  $msg;
	}

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
            
            return  array('emailType'=>'ES','email'=>'Approval/Disapproval' ); //ES emailSend
        }else{   
               
            return  array('emailType'=>'NS','email'=> show_error($this->email->print_debugger())) ; //NS NOSend
        }
    }//end function 

	function UploadDoc($img,$pId){

		if(!empty($img)){
			$where = $this->db->where(array('id'=>$pId));
			$this->db->update('property',$img,$where);
			return true;
		}else{
			return FALSE;
		}
	}

	function refundAmount($pId,$buyerId,$data){

		$this->db->where(array('pId'=>$pId,'buyerId'=>$buyerId,'paymentType'=>2));
		$this->db->update('paymentDetail',array('refundId'=>$data,'upd'=>date('Y-m-d H:i:s')));
		return true;
	}

}
?>
