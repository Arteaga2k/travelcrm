<?php
	public function get_ds(){
	
	public function get_edit($rid){
	
	public function create_record(){
		$ins_arr = array('_cities_rid'=>$this->ci->input->post('_cities_rid'),
							'contrahens_name'=>$this->ci->input->post('contrahens_name'), 
							'contact_phone'=>$this->ci->input->post('contact_phone'), 
							'contact_email'=>$this->ci->input->post('contact_email'), 
							'www'=>$this->ci->input->post('www'),
							'adress'=>$this->ci->input->post('adress'),
							'fax'=>$this->ci->input->post('fax'),
							'contact_person'=>$this->ci->input->post('contact_person'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->insert('_contrahens', $ins_arr);
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
		$update_arr = array('_cities_rid'=>$this->ci->input->post('_cities_rid'),
		$this->db->trans_begin();
		$this->db->update('_contrahens', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
	
	public function move_record(){
	public function get_contrahent_byrid($rid){
}
?>