<?php
class Loan_model extends CI_Model {
	
	function getAllLoan($limit,$start,$search){

		$this->db->select('*');
		$this->db->from('loan');
		(!empty( $search)) ? $this->db->like('fullName', trim($search)) : '';
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$req = $this->db->get();

		if($req->num_rows()){
			$res = $req->result();
			return $res;
		}
		return FALSE;
	}
	
	function countAllLoan($search) {
		(!empty( $search)) ? $this->db->like('fullName', trim($search)) : '';
		return $this->db->count_all_results("loan");
	}
	
}
?>
