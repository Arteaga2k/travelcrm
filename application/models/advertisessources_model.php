<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Advertisessources_model extends Crmmodel{
	public function __construct(){
		parent::__construct();
	}
	
	
	
	
	public function update_record(){
		$this->db->update('_advertisessources', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function remove_items(){
		$this->db->trans_begin();
		foreach($this->ci->input->post('row') as $rid){
			$this->db->delete('_advertisessources', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function check_unique($val, $type='name', $rid=null){
		$this->db->select('count(*) as quan');
		$this->db->from('_advertisessources');
		$this->db->where(array('source_name'=>$val));
		if($rid) $this->db->where(array('rid != '=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->quan:0;
	}
	public function get_sourcename_byrid($rid){
	public function move_record(){
?>