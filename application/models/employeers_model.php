<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Employeers_model extends Crmmodel{
	public function __construct(){
		parent::__construct();
	}


	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _employeers.*,
						CONCAT(l_name," ",f_name) as full_name, 
						(select _filials.name 
						FROM _emp_to_positions_rows 
						JOIN _emp_to_positions_headers ON _emp_to_positions_rows._emp_to_positions_headers_rid=_emp_to_positions_headers.rid
						JOIN _filials ON _emp_to_positions_rows._filials_rid=_filials.rid
						WHERE _emp_to_positions_rows._employeers_rid = _employeers.rid AND _emp_to_positions_headers.date_doc < now() 
						ORDER BY  _emp_to_positions_headers.date_doc ASC LIMIT 1) as filial_name,  
						(select _filials.rid 
						FROM _emp_to_positions_rows 
						JOIN _emp_to_positions_headers ON _emp_to_positions_rows._emp_to_positions_headers_rid=_emp_to_positions_headers.rid
						JOIN _filials ON _emp_to_positions_rows._filials_rid=_filials.rid
						WHERE _emp_to_positions_rows._employeers_rid = _employeers.rid AND _emp_to_positions_headers.date_doc < now() 
						ORDER BY  _emp_to_positions_headers.date_doc ASC LIMIT 1) as _filials_rid,						
						DATE_FORMAT(_employeers.birthday, \'%d.%m.%Y\') as birthday,
						DATE_FORMAT(_employeers.bdate,  \'%d.%m.%Y\') as bdate,
						DATE_FORMAT(_employeers.edate,  \'%d.%m.%Y\') as edate,
						DATE_FORMAT(_employeers.modifyDT,  \'%d.%m.%Y\') as modifyDT', False);
		$this->db->from('_employeers');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_employeers');
		return $query->num_rows()?$query->result():array();
	}

	

	public function get_edit($rid){
		$this->db->select('_employeers.*,
							CONCAT(l_name," ",f_name) as full_name, 
							DATE_FORMAT(_employeers.birthday, \'%d.%m.%Y\') as birthday,
							DATE_FORMAT(_employeers.bdate,  \'%d.%m.%Y\') as bdate,
							DATE_FORMAT(_employeers.edate,  \'%d.%m.%Y\') as edate,
							_employeers.owner_users_rid,
							DATE_FORMAT(_employeers.modifyDT,  \'%d.%m.%Y %H:%i\') as modifyDT', False);
		$this->db->from('_employeers');
		$this->db->where(array('_employeers.rid'=>$rid));
		$query = $this->db_get('employeers');
		return $query->num_rows()?$query->row():False;
	}

	

	public function create_record(){
		$ins_arr = array('f_name'=>$this->ci->input->post('f_name'),
							's_name'=>$this->ci->input->post('s_name'),
							'l_name'=>$this->ci->input->post('l_name'),
							'f_name_lat'=>$this->ci->input->post('f_name_lat'),
							'l_name_lat'=>$this->ci->input->post('l_name_lat'),
							'birthday'=>date('Y-m-d', strtotime($this->ci->input->post('birthday'))),
							'bdate'=>date('Y-m-d', strtotime($this->ci->input->post('bdate'))),
							'edate'=>$this->ci->input->post('edate')?date('Y-m-d', strtotime($this->ci->input->post('edate'))):null,
							'passp_seria'=>$this->ci->input->post('passp_seria'),	
							'passp_num'=>$this->ci->input->post('passp_num'),
							'fpassp_seria'=>$this->ci->input->post('fpassp_seria'),	
							'fpassp_num'=>$this->ci->input->post('fpassp_num'),	
							'stazh'=>$this->ci->input->post('stazh'),	
							'email'=>$this->ci->input->post('email'),
							'nal_number'=>$this->ci->input->post('nal_number'),	
							'is_legal'=>$this->ci->input->post('is_legal'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_employeers', $ins_arr);
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
		$update_arr = array('f_name'=>$this->ci->input->post('f_name'),
							's_name'=>$this->ci->input->post('s_name'),
							'l_name'=>$this->ci->input->post('l_name'),
							'f_name_lat'=>$this->ci->input->post('f_name_lat'),
							'l_name_lat'=>$this->ci->input->post('l_name_lat'),
							'birthday'=>date('Y-m-d', strtotime($this->ci->input->post('birthday'))),
							'bdate'=>date('Y-m-d', strtotime($this->ci->input->post('bdate'))),
							'edate'=>$this->ci->input->post('edate')?date('Y-m-d', strtotime($this->ci->input->post('edate'))):null,
							'passp_seria'=>$this->ci->input->post('passp_seria'),	
							'passp_num'=>$this->ci->input->post('passp_num'),
							'fpassp_seria'=>$this->ci->input->post('fpassp_seria'),	
							'fpassp_num'=>$this->ci->input->post('fpassp_num'),	
							'stazh'=>$this->ci->input->post('stazh'),	
							'email'=>$this->ci->input->post('email'),
							'nal_number'=>$this->ci->input->post('nal_number'),	
							'is_legal'=>$this->ci->input->post('is_legal'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_employeers', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_employeers', array('rid'=>$rid));
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}

	public function get_emp_fullname_byrid($rid){
		$this->db->select('CONCAT(l_name," ",f_name) as full_name', False);
		$this->db->from('_employeers');
		$this->db->where(array('rid'=>$rid));
		$this->db->order_by('full_name');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->full_name:null; 

	}	
	
	public function move_record(){
		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_employeers', $update_doc, array('_employeers.rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	public function get_emp_filial($rid, $date = null){
		$this->db->select('_emp_to_positions_rows._filials_rid');
		$this->db->from('_emp_to_positions_rows');
		$this->db->join('_emp_to_positions_headers', '_emp_to_positions_rows._emp_to_positions_headers_rid = _emp_to_positions_headers.rid');
		$this->db->join('_documents', '_emp_to_positions_headers._documents_rid = _documents.rid');
		$this->db->where(array('_emp_to_positions_rows._employeers_rid'=>$rid));
		if(!$date) $date = date('Y-m-d');
		$this->db->where(array('_emp_to_positions_rows.bdate <= '=>$date));
		$this->db->order_by('_emp_to_positions_rows.bdate', 'desc');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->_filials_rid:null; 
	}

	public function get_emp_position($rid, $date = null){
		$this->db->select('_emp_to_positions_rows._positions_rid');
		$this->db->from('_emp_to_positions_rows');
		$this->db->join('_emp_to_positions_headers', '_emp_to_positions_rows._emp_to_positions_headers_rid = _emp_to_positions_headers.rid');
		$this->db->join('_documents', '_emp_to_positions_headers._documents_rid = _documents.rid');
		$this->db->where(array('_emp_to_positions_rows._employeers_rid'=>$rid));
		if(!$date) $date = date('Y-m-d');
		$this->db->where(array('_emp_to_positions_rows.bdate <= '=>$date));
		$this->db->order_by('_emp_to_positions_rows.bdate', 'desc');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->_positions_rid:null; 
	}
	
}