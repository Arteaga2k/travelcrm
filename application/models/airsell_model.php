<?php
include_once APPPATH."libraries/core/Docmodel.php";
class Airsell_model extends Docmodel{
	public function __construct(){
		parent::__construct();
	}

	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _documents.rid, 
							DATE_FORMAT(_airsell_headers.date_doc, \'%d.%m.%Y\') as date_doc, 
							_airsell_headers.bill_code as bill_code,
							_airsell_headers.bill_num as bill_num,
							_airsell_headers.sum as sum,
							CONCAT(_clients.l_name, \' \', SUBSTRING(_clients.f_name FROM 1 FOR 1), \'.\') as client_name,
							_airsell_headers.dnum as dnum,
							_airsell_headers.anulated as anulated,
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
		$this->db->join('_airsell_headers', '_airsell_headers._documents_rid = _documents.rid');
		$this->db->join('_airsell_routes', '_airsell_headers.rid = _airsell_routes._airsell_headers_rid');
		$this->db->join('_clients', '_airsell_headers._clients_rid = _clients.rid', 'LEFT');
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
		$this->db->select('_documents.rid, 
							_documents.owner_users_rid,
							DATE_FORMAT(_airsell_headers.date_doc, \'%d.%m.%Y\') as date_doc, 
							_airsell_headers.rid as _airsell_headers_rid,
							_airsell_headers._aircalls_documents_rid as _aircalls_documents_rid,
							_airsell_headers._advertisessources_rid as _advertisessources_rid,
							_airsell_headers.bill_code as bill_code,
							_airsell_headers.bill_num as bill_num,
							_airsell_headers.sum as sum,
							_airsell_headers.issue as issue,
							_airsell_headers.brone_locator as brone_locator,
							_airsell_headers.changes_before as changes_before,
							_airsell_headers.changes_after as changes_after,
							_airsell_headers.refund_before as refund_before,
							_airsell_headers.refund_after as refund_after,
							_airsell_headers.baggage_type as baggage_type,
							_airsell_headers.baggage_allowance as baggage_allowance,
							_airsell_headers.not_refund as not_refund,
							_airsell_headers.not_changes as not_changes,
							_airsell_headers._clients_rid as _clients_rid,
							_airsell_headers.descr as descr,
							_airsell_headers.dnum as dnum,
							_airsell_headers.anulated as anulated,
							_documents.descr as descr, _documents.archive', False);
		$this->db->from('_documents');
		$this->db->join('_airsell_headers', '_airsell_headers._documents_rid = _documents.rid');
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
		$ins_h = array('date_doc'=>date('Y-m-d', strtotime($this->ci->input->post('date_doc'))),
								'_documents_rid'=>$doc_rid,
								'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
								'_aircalls_documents_rid'=>$this->ci->input->post('_aircalls_documents_rid')?$this->ci->input->post('_aircalls_documents_rid'):null,
								'_clients_rid'=>$this->ci->input->post('_clients_rid'),
								'dnum'=>$this->ci->input->post('dnum')?$this->ci->input->post('dnum'):$doc_rid,
								'anulated'=>$this->ci->input->post('anulated'),
								'issue'=>$this->ci->input->post('issue'),
								'archive'=>$this->ci->input->post('archive'),
								'owner_users_rid'=>get_curr_urid(),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->insert('_airsell_headers', $ins_h);
		$h_rid = $this->db->insert_id();
		foreach($this->ci->input->post('_aircompanies_rids') as $key=>$route){
			$ins_r = array('_airsell_headers_rid'=>$h_rid,
								'_aircompanies_rid'=>element($key, $this->input->post('_aircompanies_rids'), null),
								'air_class'=>element($key, $this->input->post('air_classes'), null),
								'_countries_rid_from'=>element($key, $this->input->post('_countries_rids_from'), null),
								'_countries_rid_to'=>element($key, $this->input->post('_countries_rids_to'), null),
								'point_from'=>element($key, $this->input->post('points_from'), null),
								'point_to'=>element($key, $this->input->post('points_to'), null),
								'departure'=>date('Y-m-d', strtotime(element($key, $this->input->post('departures'), null))),
								'arrival'=>date('Y-m-d', strtotime(element($key, $this->input->post('arrivals'), null))),
								'owner_users_rid'=>get_curr_urid(),
								'modifier_users_rid'=>get_curr_urid());
			$this->db->insert('_airsell_routes', $ins_r);
		}
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
		$query = $this->db->getwhere('_airsell_headers', array('_airsell_headers._documents_rid'=>$this->ci->input->post('rid')));
		if(!$query->num_rows()) {
			$this->db->trans_rollback();
    		return False;
		}
		$h_rid = $query->row()->rid;
		$update_h = array('date_doc'=>date('Y-m-d', strtotime($this->ci->input->post('date_doc'))),
								'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
								'_aircalls_documents_rid'=>$this->ci->input->post('_aircalls_documents_rid')?$this->ci->input->post('_aircalls_documents_rid'):null,
								'_clients_rid'=>$this->ci->input->post('_clients_rid'),
								'dnum'=>$this->ci->input->post('dnum')?$this->ci->input->post('dnum'):$this->ci->input->post('rid'),
								'anulated'=>$this->ci->input->post('anulated'),
								'issue'=>$this->ci->input->post('issue'),
								'bill_code'=>$this->ci->input->post('bill_code'),
								'bill_num'=>$this->ci->input->post('bill_num'),
								'brone_locator'=>$this->ci->input->post('brone_locator'),
								'sum'=>$this->ci->input->post('sum'),
								'_currencies_rid'=>$this->ci->input->post('_currencies_rid')?$this->ci->input->post('_currencies_rid'):null,
								'archive'=>$this->ci->input->post('archive'),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->update('_airsell_headers', $update_h, array('_airsell_headers.rid'=>$h_rid));
		$this->db->delete('_airsell_routes', array('_airsell_routes._airsell_headers_rid'=>$h_rid));
		foreach($this->ci->input->post('_aircompanies_rids') as $key=>$route){
			$ins_r = array('_airsell_headers_rid'=>$h_rid,
								'_aircompanies_rid'=>element($key, $this->input->post('_aircompanies_rids'), null),
								'air_class'=>element($key, $this->input->post('air_classes'), null),
								'_countries_rid_from'=>element($key, $this->input->post('_countries_rids_from'), null),
								'_countries_rid_to'=>element($key, $this->input->post('_countries_rids_to'), null),
								'point_from'=>element($key, $this->input->post('points_from'), null),
								'point_to'=>element($key, $this->input->post('points_to'), null),
								'departure'=>date('Y-m-d', strtotime(element($key, $this->input->post('departures'), null))),
								'arrival'=>date('Y-m-d', strtotime(element($key, $this->input->post('arrivals'), null))),
								'owner_users_rid'=>get_curr_urid(),
								'modifier_users_rid'=>get_curr_urid());
			$this->db->insert('_airsell_routes', $ins_r);
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	public function getroutes($doc_rid){
		$this->db->select('_airsell_routes._aircompanies_rid, _airsell_routes._countries_rid_from, _airsell_routes._countries_rid_to,
							_airsell_routes.point_from, _airsell_routes.point_to,
							_airsell_routes.air_class, _airsell_routes.air_class,  
							DATE_FORMAT(_airsell_routes.departure, \'%d.%m.%Y\') as departure,
							DATE_FORMAT(_airsell_routes.arrival, \'%d.%m.%Y\') as arrival', False);
		$this->db->from('_airsell_routes');
		$this->db->join('_airsell_headers', '_airsell_headers.rid = _airsell_routes._airsell_headers_rid');
		$this->db->where(array('_airsell_headers._documents_rid'=>$doc_rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}	
	
	public function get_attaches($doc_rid){
		$this->db->select('_attaches.*, _documents_attaches.rid as dattach_rid');
		$this->db->from('_attaches');
		$this->db->join('_documents_attaches', '_documents_attaches._attaches_rid = _attaches.rid');
		$this->db->where(array('_documents_attaches._documents_rid'=>$doc_rid));
		$this->db->order_by('_attaches.rid');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function addattach(){
		$this->db->trans_begin();
		$upload_data = $this->ci->upload->data();
		$ins_r = array('file_descr'=>$this->ci->input->post('upload_descr')?$this->ci->input->post('upload_descr'):$upload_data['file_name'],
						'file_name'=>$upload_data['file_name'],
						'file_type'=>$upload_data['file_type'],
						'file_size'=>$upload_data['file_size'],
						'file_path'=>$upload_data['file_path']);
		$this->db->insert('_attaches', $ins_r);
		$attach_rid = $this->db->insert_id();
		$ins_r = array('_documents_rid'=>$this->ci->input->post('_documents_rid'),
						'_attaches_rid'=>$attach_rid);
		$this->db->insert('_documents_attaches', $ins_r);
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function removeattach($rid){
		$this->db->trans_begin();
		$query = $this->db->select('*')->from('_attaches')->where(array('rid'=>$rid))->get();
		if($query->num_rows()){
			$row = $query->row();
			@unlink($row->file_path.$row->file_name);
		}
		$this->db->delete('_attaches', array('rid'=>$rid));	

		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
}
?>