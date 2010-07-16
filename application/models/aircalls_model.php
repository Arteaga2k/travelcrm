<?php
include_once APPPATH."libraries/core/Docmodel.php";
class Aircalls_model extends Docmodel{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('_documents.rid, 
							DATE_FORMAT(_aircalls_headers.date_doc, \'%d.%m.%Y\') as date_doc, 
							_aircalls_rows._countries_rid as _countries_rid,
							_countries.country_name as country_name,
							_aircalls_rows._advertisessources_rid as _advertisessources_rid,
							_advertisessources.source_name as source_name,
							if(_aircalls_rows._clients_rid, _clients.f_name, _aircalls_rows.f_name) as f_name,
							if(_aircalls_rows._clients_rid, _clients.l_name, _aircalls_rows.l_name) as l_name,
							(select _filials.rid 
								FROM _emp_to_positions_rows 
								JOIN _emp_to_positions_headers ON _emp_to_positions_rows._emp_to_positions_headers_rid=_emp_to_positions_headers.rid
								JOIN _filials ON _emp_to_positions_rows._filials_rid=_filials.rid
								WHERE _emp_to_positions_rows._employeers_rid = _employeers.rid AND _emp_to_positions_headers.date_doc < now() 
								ORDER BY  _emp_to_positions_headers.date_doc ASC LIMIT 1
							) as _filials_rid,						
							CONCAT(_employeers.l_name, \' \', SUBSTRING(_employeers.f_name FROM 1 FOR 1), \'.\') as emp_name,
							DATE_FORMAT(_documents.modifyDT, \'%d.%m.%Y\') as modifyDT, 
							_documents.descr as descr, _documents.archive', False);
		$this->db->from('_documents');
		$this->db->join('_aircalls_headers', '_aircalls_headers._documents_rid = _documents.rid');
		$this->db->join('_aircalls_rows', '_aircalls_rows._aircalls_headers_rid = _aircalls_headers.rid');
		$this->db->join('_countries', '_aircalls_rows._countries_rid = _countries.rid', 'LEFT');
		$this->db->join('_advertisessources', '_aircalls_rows._advertisessources_rid = _advertisessources.rid');
		$this->db->join('_currencies', '_aircalls_rows._currencies_rid = _currencies.rid');
		$this->db->join('_clients', '_aircalls_rows._clients_rid = _clients.rid', 'LEFT');
		$this->db->join('_users', '_documents.owner_users_rid = _users.rid');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid');
		$this->db->group_by('_documents.rid');
		$this->db->where(array('_documents.doc_type'=>$this->ci->get_typedoc()));
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_documents');
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_edit($rid){
		$this->db->select('DATE_FORMAT(_aircalls_headers.date_doc, \'%d.%m.%Y %H:%i\') as date_doc,
							_documents.rid,
							_documents.owner_users_rid,
							_aircalls_headers.rid as _aircalls_headers_rid,
							_aircalls_rows._clients_rid as _clients_rid,
							_aircalls_rows._countries_rid as _countries_rid,
							_aircalls_rows.air_class as air_class,
							_aircalls_rows._advertisessources_rid as _advertisessources_rid,
							_aircalls_rows._currencies_rid as _currencies_rid,
							_aircalls_rows.f_name as f_name,
							_aircalls_rows.s_name as s_name,
							_aircalls_rows.l_name as l_name,
							DATE_FORMAT(_aircalls_rows.date_from, \'%d.%m.%Y\') as date_from,
							DATE_FORMAT(_aircalls_rows.date_to, \'%d.%m.%Y\') as date_to,
							_aircalls_rows.sum_wanted_to as sum_wanted_to,
							_aircalls_rows.tourists_quan as tourists_quan,
							_aircalls_rows.phones as phones,
							_aircalls_rows.email as email,
							_documents.descr as descr, _documents.archive', False);
		$this->db->from('_documents');
		$this->db->join('_aircalls_headers', '_aircalls_headers._documents_rid = _documents.rid');
		$this->db->join('_aircalls_rows', '_aircalls_rows._aircalls_headers_rid = _aircalls_headers.rid');
		$this->db->join('_countries', '_aircalls_rows._countries_rid = _countries.rid');
		$this->db->join('_advertisessources', '_aircalls_rows._advertisessources_rid = _advertisessources.rid');
		$this->db->join('_currencies', '_aircalls_rows._currencies_rid = _currencies.rid');
		$this->db->join('_users', '_documents.owner_users_rid = _users.rid');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid');
		$this->db->where(array('_documents.rid'=>$rid));
		$query = $this->db_get('_documents');
		return $query->num_rows()?$query->row():False;
	}

	public function create_record(){
		$ins_doc = array('doc_type'=>$this->ci->get_typedoc(), 
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_documents', $ins_doc);
		$doc_rid = $this->db->insert_id();
		$ins_h = array('date_doc'=>date('Y-m-d H:i', strtotime($this->ci->input->post('date_doc').' '.$this->ci->input->post('time_doc'))),
							'_documents_rid'=>$doc_rid,
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->insert('_aircalls_headers', $ins_h);
		$h_rid = $this->db->insert_id();
		$ins_r = array('_aircalls_headers_rid'=>$h_rid,
							'_clients_rid'=>$this->ci->input->post('_clients_rid')?$this->ci->input->post('_clients_rid'):null,
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),
							'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
							'_currencies_rid'=>$this->ci->input->post('_currencies_rid'),
							'air_class'=>$this->ci->input->post('air_class'),
							'f_name'=>$this->ci->input->post('f_name'),
							's_name'=>$this->ci->input->post('s_name'),
							'l_name'=>$this->ci->input->post('l_name'),
							'date_from'=>date('Y-m-d', strtotime($this->ci->input->post('date_from'))),
							'date_to'=>date('Y-m-d', strtotime($this->ci->input->post('date_to'))),
							'sum_wanted_to'=>$this->ci->input->post('sum_wanted_to'),
							'tourists_quan'=>$this->ci->input->post('tourists_quan'),
							'phones'=>$this->ci->input->post('phones'),
							'email'=>$this->ci->input->post('email'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->insert('_aircalls_rows', $ins_r);
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $doc_rid;
		}		
	}
	
	public function update_record(){
		$update_doc = array('doc_type'=>$this->ci->get_typedoc(), 
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_documents', $update_doc, array('_documents.rid'=>$this->ci->input->post('rid')));
				
		$update_h = array('date_doc'=>date('Y-m-d H:i', strtotime($this->ci->input->post('date_doc').' '.$this->ci->input->post('time_doc'))),
							'modifier_users_rid'=>get_curr_urid());

		$this->db->update('_aircalls_headers', $update_h, array('_aircalls_headers._documents_rid'=>$this->ci->input->post('rid')));
		$query = $this->db->getwhere('_aircalls_headers', array('_aircalls_headers._documents_rid'=>$this->ci->input->post('rid')));
		if(!$query->num_rows()) {
			$this->db->trans_rollback();
    		return False;
		}
		$h_rid = $query->row()->rid;
		$update_r = array('_aircalls_headers_rid'=>$h_rid,
							'_clients_rid'=>$this->ci->input->post('_clients_rid')?$this->ci->input->post('_clients_rid'):null,
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),
							'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
							'_currencies_rid'=>$this->ci->input->post('_currencies_rid'),
							'air_class'=>$this->ci->input->post('air_class'),
							'f_name'=>$this->ci->input->post('f_name'),
							's_name'=>$this->ci->input->post('s_name'),
							'l_name'=>$this->ci->input->post('l_name'),
							'date_from'=>date('Y-m-d', strtotime($this->ci->input->post('date_from'))),
							'date_to'=>date('Y-m-d', strtotime($this->ci->input->post('date_to'))),
							'sum_wanted_to'=>$this->ci->input->post('sum_wanted_to'),
							'tourists_quan'=>$this->ci->input->post('tourists_quan'),
							'phones'=>$this->ci->input->post('phones'),
							'email'=>$this->ci->input->post('email'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);		
		$this->db->update('_aircalls_rows', $update_r, array('_aircalls_rows._aircalls_headers_rid'=>$h_rid));
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