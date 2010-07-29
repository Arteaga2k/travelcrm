<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Cities_model extends Crmmodel{
	public function __construct(){		parent::__construct();	}
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _cities.rid as rid, _cities.city_name as city_name,  							_cities.city_name_lat as city_name_lat,							_countries.country_name as country_name,  							DATE_FORMAT(_cities.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_cities.owner_users_rid,							_cities.descr as descr, _cities.archive', False);		$this->db->from('_cities');		$this->db->join('_countries','_cities._countries_rid = _countries.rid');		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_cities');		return $query->num_rows()?$query->result():array();	}
		public function get_edit($rid){		$this->db->select('_cities.rid as rid, _cities.city_name as city_name,  							_cities.city_name_lat as city_name_lat,							_cities._countries_rid as _countries_rid,														_cities.modifyDT as modifyDT, 							_cities.owner_users_rid,							_cities.descr as descr, _cities.archive');		$this->db->from('_cities');		$this->db->where(array('_cities.rid'=>$rid));		$query = $this->db_get('_cities');		return $query->num_rows()?$query->row():False;	}
	
	public function create_record(){		$ins_arr = array('city_name'=>$this->ci->input->post('city_name'),							'city_name_lat'=>$this->ci->input->post('city_name_lat'),							'_countries_rid'=>$this->ci->input->post('_countries_rid'),									'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'owner_users_rid'=>get_curr_urid(),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->insert('_cities', $ins_arr);		$insRid = $this->db->insert_id();		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}

	
	public function update_record(){		$update_arr = array('city_name'=>$this->ci->input->post('city_name'),
							'city_name_lat'=>$this->ci->input->post('city_name_lat'),
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),		
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_cities', $update_arr, array('rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	
	public function remove_items(){		$this->db->trans_begin();
		foreach($this->ci->input->post('row') as $rid){
			$this->db->delete('_cities', array('rid'=>$rid));			}		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}	public function check_unique($val, $type='name', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_cities');		if($type=='name') $this->db->where(array('city_name'=>$val));		else $this->db->where(array('city_name_lat'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}			public function get_list(){		$this->db->select('*');		$this->db->from('_cities');		$this->db->order_by('_cities.city_name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array(); 	}		public function get_name_byrid($rid){		$this->db->select('*');		$this->db->from('_cities');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('_cities.city_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->city_name:null; 	}				public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_cities', $update_doc, array('_cities.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}	
}
?>