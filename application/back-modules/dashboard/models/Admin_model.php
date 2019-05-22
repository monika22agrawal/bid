<?php
class Admin_model extends CI_Model {
	

	function countSeller(){
        $res = $this->db->select('id')->where(array('status'=>1,'userType'=>1))->get('users');
		return $res->num_rows();
	} 

	function countBuyer(){

		$res = $this->db->select('id')->where(array('status'=>1,'userType'=>2))->get('users');
		return $res->num_rows();
	}

	function countPropertyType(){

		$res = $this->db->select('id')->where(array('status'=>1))->get('propertyType');
		return $res->num_rows();
	} 

	/*function countCategory(){

		$res = $this->db->select('id')->where(array('status'=>1))->get('category');
		return $res->num_rows();
	} */
}
?>
