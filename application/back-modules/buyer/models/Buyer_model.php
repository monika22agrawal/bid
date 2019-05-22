<?php
class Buyer_model extends CI_Model {
	
	function activeBuyer($id) {

		$data = $this->db->select('status')->from('users')->where($id)->get();
		$userStatus = $data->row()->status;
		
		if($userStatus == 1){
			$status = "0";
		}else{
			$status = "1";
		}
		$this->db->where($id)->update('users',array('status'=>$status));
		return  $status;
	}

	function deleteBuyer($id) {

		$this->db->where('id',$id);
		$this->db->delete('users');		
		return true;
	}

	function getAllBuyer($limit,$start,$search){

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('userType'=>'2'));
		(!empty( $search)) ? $this->db->like('name', trim($search)) : '';
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$req = $this->db->get();
		if($req->num_rows()){
			$res = $req->result();
			return $res;
		}
		return FALSE;
	}
	
	function countAllBuyer($search) {
		$this->db->where(array('userType'=>'2'));
		(!empty( $search)) ? $this->db->like('name', trim($search)) : '';
		return $this->db->count_all_results("users");
	}

}
?>
