<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Filials_model extends Crmmodel{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _filials.rid as rid, _filials.name as name, _filials._cities_rid,
							_filials.code as code, _filials.adress as adress,
							_filials.phones as phones, _filials.email as email,
							_filials.mobile_phones as mobile_phones, _filials.fax as fax,
							_cities.city_name as city_name,
							DATE_FORMAT(_filials.modifyDT, \'%d.%m.%Y\') as modifyDT, 
							_filials.descr as descr, _filials.archive', False);
		$this->db->from('_filials');
		$this->db->join('_cities', '_filials._cities_rid = _cities.rid');
		$this->db->join('_countries','_cities._countries_rid = _countries.rid');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_cities');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('_filials.rid as rid, _filials.name as name, _filials._cities_rid,  
							_filials.code as code, _filials.adress as adress,
							_filials.phones as phones, _filials.email as email,
							_filials.mobile_phones as mobile_phones, _filials.fax as fax,
							_filials.modifyDT as modifyDT, 
							_filials.owner_users_rid,
							_filials.descr as descr, _filials.archive');
		$this->db->from('_filials');
		$this->db->where(array('_filials.rid'=>$rid));
		$query = $this->db_get('_filials');
		echo $this->db->last_query();
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('code'=>$this->ci->input->post('code'),
							'_cities_rid'=>$this->ci->input->post('_cities_rid'),
							'adress'=>$this->ci->input->post('adress'),
							'phones'=>$this->ci->input->post('phones'),
							'mobile_phones'=>$this->ci->input->post('mobile_phones'),
							'fax'=>$this->ci->input->post('fax'),
							'email'=>$this->ci->input->post('email'),
							'name'=>$this->ci->input->post('name'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_filials', $ins_arr);
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
							'_cities_rid'=>$this->ci->input->post('_cities_rid'),
							'adress'=>$this->ci->input->post('adress'),
							'phones'=>$this->ci->input->post('phones'),
							'mobile_phones'=>$this->ci->input->post('mobile_phones'),
							'fax'=>$this->ci->input->post('fax'),
							'email'=>$this->ci->input->post('email'),
							'name'=>$this->ci->input->post('name'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);		
		$this->db->trans_begin();
		$this->db->update('_filials', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	public function remove_items(){		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_filials', array('rid'=>$rid));			}		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();	   		return False;		}else{    		$this->db->trans_commit();    		return True;		}			}
	/* Уникальность кода и наименования */	public function check_unique($val, $type='code', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_filials');		if($type=='code') $this->db->where(array('code'=>$val));		else $this->db->where(array('name'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}
	
	public function get_list(){
		$this->db->select('*');
		$this->db->from('_filials');
		$this->db->order_by('_filials.name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array(); 
	}	

	public function get_name_byrid($rid){
		$this->db->select('*');
		$this->db->from('_filials');
		$this->db->where(array('rid'=>$rid));
		$this->db->order_by('_filials.name');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->name:null; 

	}	
	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_filials', $update_doc, array('_filials.rid'=>$this->ci->input->post('rid')));
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