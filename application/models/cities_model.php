<?php
	public function __construct(){
	public function get_ds(){
	
	
	public function create_record(){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}

	
	public function update_record(){
							'city_name_lat'=>$this->ci->input->post('city_name_lat'),
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),		
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	
	public function remove_items(){
		foreach($this->ci->input->post('row') as $rid){
			$this->db->delete('_cities', array('rid'=>$rid));	
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
}
?>