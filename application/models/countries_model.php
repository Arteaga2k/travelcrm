<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Countries_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _countries.rid as rid, _countries.country_code as country_code,  
							_countries.country_name as country_name, 
							_countries.country_name_lat as country_name_lat,
							DATE_FORMAT(_countries.modifyDT, \'%d.%m.%Y\') as modifyDT, 
							_countries.owner_users_rid,
							_countries.descr as descr, _countries.archive', False);
		$this->db->from('_countries');
		if($searchRule = $this->ci->get_session('searchrule')) $this->db->like($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_food');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('_countries.rid as rid, _countries.country_code as country_code,  
							_countries.country_name as country_name, 
							_countries.country_name_lat as country_name_lat,							_countries.owner_users_rid,
							DATE_FORMAT(_countries.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT, 
							_countries.descr as descr, _countries.archive', False);
		$this->db->from('_countries');
		$this->db->where(array('_countries.rid'=>$rid));
		$query = $this->db_get('_countries');
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('country_name'=>$this->ci->input->post('country_name'),
							'country_name_lat'=>$this->ci->input->post('country_name_lat'),
							'country_code'=>$this->ci->input->post('country_code'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_countries', $ins_arr);
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
		$update_arr = array('country_name'=>$this->ci->input->post('country_name'),
							'country_name_lat'=>$this->ci->input->post('country_name_lat'),
							'country_code'=>$this->ci->input->post('country_code'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);		
		$this->db->trans_begin();
		$this->db->update('_countries', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_countries', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}		public function get_list(){		$this->db->select('*');		$this->db->from('_countries');		$this->db->order_by('_countries.country_name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array(); 	}			public function check_unique($val, $type='code', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_countries');		if($type=='code') $this->db->where(array('country_code'=>$val));		else if($type=='name') $this->db->where(array('country_name'=>$val));		else $this->db->where(array('country_name_lat'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_countries', $update_doc, array('_countries.rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	public function get_countryname_byrid($rid){
		$this->db->select('_countries.country_name as country_name', False);
		$this->db->from('_countries');
		$this->db->where(array('rid'=>$rid));
		$this->db->order_by('country_name');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->country_name:null; 

	}	
	
}
?>