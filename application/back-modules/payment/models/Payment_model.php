<?php
class Payment_model extends CI_Model {

	function getAllPayment($limit,$start,$search,$type){

		$this->db->select('paymentDetail.*,property.propertyName,users.name');
		$this->db->from('paymentDetail');
		$this->db->join('property','property.id = paymentDetail.pId');
		$this->db->join('users','users.id = paymentDetail.buyerId');
		!empty($type) ? $this->db->where('paymentDetail.paymentType',$type) : '';
		(!empty( $search)) ? $this->db->like('property.propertyName', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('users.name', trim($search)) : '';
		$this->db->limit($limit,$start);
		$this->db->order_by('paymentDetail.id','desc');
		$req = $this->db->get();
		if($req->num_rows()){
			$res = $req->result();

			return $res;
		}
		return FALSE;
	}
	
	function countAllPayment($search,$type) {
		$this->db->select('paymentDetail.*,property.propertyName,users.name');
		$this->db->from('paymentDetail');
		$this->db->join('property','property.id = paymentDetail.pId');
		$this->db->join('users','users.id = paymentDetail.buyerId');
		!empty($type) ? $this->db->where('paymentDetail.paymentType',$type) : '';
		(!empty( $search)) ? $this->db->like('property.propertyName', trim($search)) : '';
		(!empty( $search)) ? $this->db->or_like('users.name', trim($search)) : '';
		$this->db->order_by('paymentDetail.id','desc');
		$req = $this->db->get();
		return $req->num_rows();
	}

}
?>
