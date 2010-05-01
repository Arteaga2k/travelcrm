<?php
	public function get_ds(){
	
	public function get_edit($rid){
	
	public function create_record(){
		$ins_arr = array('touroperator_name'=>$this->ci->input->post('touroperator_name'),  
							'stouroperator_name'=>$this->ci->input->post('stouroperator_name'), 
							'category'=>$this->ci->input->post('category'), 
							'license'=>$this->ci->input->post('license'), 
							'chief_name'=>$this->ci->input->post('chief_name'), 
							'contact_phone'=>$this->ci->input->post('contact_phone'), 
							'contact_email'=>$this->ci->input->post('contact_email'), 
							'www'=>$this->ci->input->post('www'),
							'contract'=>$this->ci->input->post('contract'), 
							'contract_period'=>date('Y-m-d', strtotime($this->ci->input->post('contract_period'))), 
							'adress'=>$this->ci->input->post('adress'),
							'fax'=>$this->ci->input->post('fax'),
							'contact_person'=>$this->ci->input->post('contact_person'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->insert('_touroperators', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
	
	public function update_record(){
		$update_arr = array('touroperator_name'=>$this->ci->input->post('touroperator_name'),  
		$this->db->trans_begin();
		$this->db->update('_touroperators', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function GetPair($p_value = 'rid', $p_name='stouroperator_name'){
		$this->db->select("_touroperators.{$p_value}, _touroperators.{$p_name}");
		$this->db->from('_touroperators');
		$this->db->orderby("_touroperators.{$p_name}");
		$query = $this->db->get();
		if($query->num_rows()>0) return $query->result();
		return False;
	}
	
	public function move_record(){
	public function get_touroperatorname_byrid($rid){
}
?>