<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Advertisessources_model extends Crmmodel{
	public function __construct(){
		parent::__construct();
	}
		public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _advertisessources.rid as rid, 							_advertisessources.source_name as source_name,							_advertisessources._advertisestypes_rid as _advertisestypes_rid,							_advertisestypes.type_name as type_name,  							DATE_FORMAT(_advertisessources.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_advertisessources.descr as descr, _advertisessources.archive', False);		$this->db->from('_advertisessources');		$this->db->join('_advertisestypes', '_advertisestypes.rid = _advertisessources._advertisestypes_rid');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_advertisessources');		return $query->num_rows()?$query->result():array();	}
		public function get_edit($rid){		$this->db->select('_advertisessources.rid as rid, 							_advertisessources.source_name as source_name,							_advertisessources._advertisestypes_rid as _advertisestypes_rid,							_advertisestypes.type_name as type_name,  							DATE_FORMAT(_advertisessources.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT, 							_advertisessources.owner_users_rid,							_advertisessources.descr as descr, _advertisessources.archive', False);		$this->db->from('_advertisessources');		$this->db->join('_advertisestypes', '_advertisestypes.rid = _advertisessources._advertisestypes_rid');		$this->db->where(array('_advertisessources.rid'=>$rid));		$query = $this->db_get('_advertisessources');		return $query->num_rows()?$query->row():False;	}
		public function create_record(){		$ins_arr = array('source_name'=>$this->ci->input->post('source_name'),							'_advertisestypes_rid'=>$this->ci->input->post('_advertisestypes_rid'),							'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'owner_users_rid'=>get_curr_urid(),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->insert('_advertisessources', $ins_arr);		$insRid = $this->db->insert_id();		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $insRid;		}			}
	
	public function update_record(){		$update_arr = array('source_name'=>$this->ci->input->post('source_name'),							'_advertisestypes_rid'=>$this->ci->input->post('_advertisestypes_rid'),							'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();
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
	public function get_sourcename_byrid($rid){		$this->db->select('_advertisessources.source_name as source_name', False);		$this->db->from('_advertisessources');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('source_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->source_name:null; 	}		
	public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_advertisessources', $update_doc, array('_advertisessources.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}}
?>