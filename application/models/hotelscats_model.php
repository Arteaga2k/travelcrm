<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Hotelscats_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _hotelscats.rid as rid, _hotelscats.code as code,
							_hotelscats.hotelcat_name as hotelcat_name,							DATE_FORMAT(_hotelscats.modifyDT, \'%d.%m.%Y\') as modifyDT, 

							_hotelscats.descr as descr, _hotelscats.archive', False);
		$this->db->from('_hotelscats');
		if($searchRule = $this->ci->get_session('searchrule')) $this->db->like($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_rooms');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('_hotelscats.rid as rid, _hotelscats.code as code,
							_hotelscats.hotelcat_name as hotelcat_name,
							DATE_FORMAT(_hotelscats.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT, 							_hotelscats.owner_users_rid,
							_hotelscats.descr as descr, _hotelscats.archive', False);
		$this->db->from('_hotelscats');
		$this->db->where(array('_hotelscats.rid'=>$rid));
		$query = $this->db_get('_hotelscats');
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('code'=>$this->ci->input->post('code'),
							'hotelcat_name'=>$this->ci->input->post('hotelcat_name'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_hotelscats', $ins_arr);
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
		$update_arr = array('code'=>$this->ci->input->post('code'),
							'hotelcat_name'=>$this->ci->input->post('hotelcat_name'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_hotelscats', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_hotelscats', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function check_unique($val, $type='code', $rid=null){
		$this->db->select('count(*) as quan');
		$this->db->from('_hotelscats');
		if($type=='code') $this->db->where(array('code'=>$val));
		else $this->db->where(array('hotelcat_name'=>$val));
		if($rid) $this->db->where(array('rid != '=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->quan:0;
	}
	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_hotelscats', $update_doc, array('_hotelscats.rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}		public function get_all(){		$this->db->select('*');		$this->db->from('_hotelscats');		$this->db->where(array('archive'=>0));		$query = $this->db->get();		return $query->num_rows()?$query->result():array();			}
	
}
?>