<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Dcarts_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _dcarts.rid as rid, _dcarts.num as num,
							_dcarts.discount as discount,
							DATE_FORMAT(_dcarts.modifyDT, \'%d.%m.%Y\') as modifyDT,
							_dcarts.descr as descr, _dcarts.archive', False);
		$this->db->from('_dcarts');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_food');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('_dcarts.rid as rid, _dcarts.num as num,
							_dcarts.discount as discount,
							DATE_FORMAT(_dcarts.modifyDT, \'%d.%m.%Y %H:%i\') as modifyDT,
							_dcarts.owner_users_rid,
							_dcarts.descr as descr, _dcarts.archive', False);
		$this->db->from('_dcarts');
		$this->db->where(array('_dcarts.rid'=>$rid));
		$query = $this->db_get('_dcarts');
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('num'=>$this->ci->input->post('num'),
							'discount'=>floatval($this->ci->input->post('discount')),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_dcarts', $ins_arr);
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
		$update_arr = array('num'=>$this->ci->input->post('num'),
							'discount'=>floatval($this->ci->input->post('discount')),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_dcarts', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_dcarts', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	public function check_unique($val, $type='num', $rid=null){
		$this->db->select('count(*) as quan');
		$this->db->from('_dcarts');
		$this->db->where(array('num'=>$val));
		if($rid) $this->db->where(array('rid != '=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->quan:0;
	}
	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_dcarts', $update_doc, array('_dcarts.rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	public function get_dcartnum_byrid($rid){
		$this->db->select('_dcarts.num as num');
		$this->db->from('_dcarts');
		$this->db->where(array('_dcarts.rid'=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->num:'';
	}
}
?>