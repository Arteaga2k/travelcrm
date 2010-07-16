<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Modules_model extends Crmmodel{	
	public function __construct(){		parent::__construct();	}	
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _modules.rid as rid, 							_modules.module_name as module_name,							CONCAT(_modules.module_name, "(", _modules.module_controller, ")") as module_full_name,							_modules.module_controller as module_controller, 							DATE_FORMAT(_modules.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_modules.descr as descr, _modules.archive', False);		$this->db->from('_modules');		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_modules');		return $query->num_rows()?$query->result():array();	}
		public function get_edit($rid){		$this->db->select('_modules.rid as rid,							CONCAT(_modules.module_name, "(", _modules.module_controller, ")") as module_full_name,							_modules.module_name as module_name,  							_modules.module_controller as module_controller, 							_modules.modifyDT as modifyDT, 							_modules.owner_users_rid,							_modules.descr as descr, _modules.archive');		$this->db->from('_modules');		$this->db->where(array('_modules.rid'=>$rid));		$query = $this->db_get('_modules');		return $query->num_rows()?$query->row():False;	}
	
	public function create_record(){
		$ins_arr = array('module_name'=>$this->ci->input->post('module_name'),
							'module_controller'=>$this->ci->input->post('module_controller'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_modules', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		} else {
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
	
	public function update_record(){
		$update_arr = array('module_name'=>$this->ci->input->post('module_name'),
							'module_controller'=>$this->ci->input->post('module_controller'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_modules', $update_arr, array('rid'=>$this->ci->input->post('rid')));		$this->db->delete('_modules_permissions', array('_modules_rid'=>$this->ci->input->post('rid')));		foreach($this->ci->input->post('permissions') as $positions_rid=>$p){			$ins_permission = array('_positions_rid'=>$positions_rid,									'_modules_rid'=>$this->ci->input->post('rid'),									'add_allow'=>element('add', $p, 0),									'edit_allow'=>element('edit', $p, 0),									'details_allow'=>element('details', $p, 0),									'delete_allow'=>element('delete', $p, 0),									'move_allow'=>element('move', $p, 0),									'archive_allow'=>element('archive', $p, 0),									'viewed_space'=>element('viewed_space', $p, null));			$this->db->insert('_modules_permissions', $ins_permission);		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function remove_items(){
		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_modules', array('rid'=>$rid));			}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}		public function get_list(){		$this->db->select('*');		$this->db->from('_modules');		$this->db->order_by('_modules.module_name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array(); 	}				public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_modules', $update_doc, array('_modules.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}	public function get_modulename_byrid($rid, $full = false){		if($full) $this->db->select('CONCAT(_modules.module_name, "(", _modules.module_controller, ")") as module_name', False);		else $this->db->select('_modules.module_name as module_name', False);		$this->db->from('_modules');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('module_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->module_name:null; 	}		public function get_module_permissions($module_rid){		$res = array();		$this->db->select('_positions.*');		$this->db->from('_positions');		$this->db->order_by('_positions.name');		$query = $this->db->get();		if($query->num_rows()){			foreach($query->result() as $r) $res[$r->rid] = array('position_rid'=>$r->rid,																	'position_name'=>$r->name,																	'add_allow'=>0,																	'edit_allow'=>0,																	'details_allow'=>0,																	'delete_allow'=>0,																	'move_allow'=>0,																	'archive_allow'=>0,																	'viewed_space'=>null);     		}		$this->db->select('_modules_permissions.*');		$this->db->from('_modules_permissions');		$this->db->where(array('_modules_permissions._modules_rid' => $module_rid));		$query = $this->db->get();		if($query->num_rows()){			foreach($query->result() as $r){				$res[$r->_positions_rid]['position_rid']=$r->_positions_rid;				$res[$r->_positions_rid]['add_allow']=$r->add_allow;				$res[$r->_positions_rid]['edit_allow']=$r->edit_allow;				$res[$r->_positions_rid]['details_allow']=$r->details_allow;				$res[$r->_positions_rid]['delete_allow']=$r->delete_allow;				$res[$r->_positions_rid]['move_allow']=$r->move_allow;				$res[$r->_positions_rid]['archive_allow']=$r->archive_allow;				$res[$r->_positions_rid]['viewed_space']=$r->viewed_space;			}		}		return $res;			}		public function check_unique_module($module_controller, $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_modules');		$this->db->where(array('module_controller'=>$module_controller));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}	}
?>