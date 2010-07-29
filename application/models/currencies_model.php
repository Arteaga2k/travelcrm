<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Currencies_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _currencies.rid as rid, _currencies.code as code,
							_currencies.currency_name as currency_name,
							_currencies.left_word as left_word,
							_currencies.right_word as right_word,  
							DATE_FORMAT(_currencies.modifyDT, \'%d.%m.%Y\') as modifyDT, 
							_currencies.owner_users_rid,
							_currencies.descr as descr, _currencies.archive', False);
		$this->db->from('_currencies');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_currencies');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('_currencies.rid as rid, _currencies.code as code,
							_currencies.currency_name as currency_name,
							_currencies.left_word as left_word,
							_currencies.right_word as right_word,  
							DATE_FORMAT(_currencies.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT,							_currencies.owner_users_rid,
							_currencies.descr as descr, _currencies.archive', False);
		$this->db->from('_currencies');
		$this->db->where(array('_currencies.rid'=>$rid));
		$query = $this->db_get('_currencies');
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('code'=>$this->ci->input->post('code'),
							'currency_name'=>$this->ci->input->post('currency_name'),
							'left_word'=>$this->ci->input->post('left_word'),
							'right_word'=>$this->ci->input->post('right_word'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_currencies', $ins_arr);
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
							'currency_name'=>$this->ci->input->post('currency_name'),
							'left_word'=>$this->ci->input->post('left_word'),
							'right_word'=>$this->ci->input->post('right_word'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_currencies', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_currencies', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function get_list(){
		$this->db->select('*');
		$this->db->from('_currencies');
		$this->db->order_by('_currencies.currency_name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array(); 
	}	
	
	public function check_unique($val, $type='code', $rid=null){
		$this->db->select('count(*) as quan');
		$this->db->from('_currencies');
		if($type=='code') $this->db->where(array('code'=>$val));
		else $this->db->where(array('currency_name'=>$val));
		if($rid) $this->db->where(array('rid != '=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->quan:0;
	}
	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_currencies', $update_doc, array('_currencies.rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	
}
?>