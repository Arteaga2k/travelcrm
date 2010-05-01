<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Clients_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _clients.rid, _clients.l_name, _clients.f_name, 
							_clients._dcarts_rid, _clients.email, _clients.archive, _clients.f_pass_num, 
							_dcarts.num as card_num,
							CONCAT(_clients.l_name," ",_clients.f_name) as client_name,
							DATE_FORMAT(_clients.birthday, \'%d.%m.%Y\') as birthday,
							DATE_FORMAT(_clients.f_pass_period, \'%d.%m.%Y\') as f_pass_period,
							_cities.city_name as city_name,
							DATE_FORMAT(_clients.modifyDT, \'%d.%m.%Y\') as modifyDT', False);
		$this->db->from('_clients');
		$this->db->join('_cities', '_clients._cities_rid = _cities.rid');
		$this->db->join('_demands_rows', '_demands_rows._clients_rid = _clients.rid', 'LEFT');
		$this->db->join('_demands_headers', '_demands_rows._demands_headers_rid = _demands_headers.rid', 'LEFT');
		$this->db->join('_tours', '_demands_headers._tours_rid = _tours.rid', 'LEFT');
		$this->db->join('_countries', '_tours._countries_rid = _countries.rid', 'LEFT');
		$this->db->join('_dcarts', '_clients._dcarts_rid = _dcarts.rid', 'LEFT');
		$this->db->group_by('_clients.rid');
		if($searchRule = element('like', $this->ci->get_session('searchrule'), null)) $this->db->like($searchRule);
		if($searchRule = element('where', $this->ci->get_session('searchrule'), null)) $this->db->where($searchRule);
		if($searchRule = element('having', $this->ci->get_session('searchrule'), null)) $this->db->having($searchRule);
		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);
		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));
		$query = $this->db_get('_clients');
		return $query->num_rows()?$query->result():array();
	}
	
	
	public function get_edit($rid){
		$this->db->select('_clients.*, CONCAT(_clients.l_name," ",_clients.f_name) as client_name,
							DATE_FORMAT(_clients.birthday, \'%d.%m.%Y\') as birthday, 
							DATE_FORMAT(_clients.f_pass_period, \'%d.%m.%Y\') as f_pass_period', False);
		$this->db->from('_clients');
		$this->db->where(array('_clients.rid'=>$rid));
		$query = $this->db_get('_clients');
		return $query->num_rows()?$query->row():False;
	}
	
	public function create_record(){
		$ins_arr = array('parent'=>$this->ci->input->post('parent'),                        
							'f_name'=>$this->ci->input->post('f_name'),                                  
							's_name'=>$this->ci->input->post('s_name'),                         
							'l_name'=>$this->ci->input->post('l_name'),                           
							'f_name_lat'=>$this->ci->input->post('f_name_lat'),                             
							'l_name_lat'=>$this->ci->input->post('l_name_lat'),  
							'sex'=>$this->ci->input->post('sex'),                     
							'birthday'=>date('Y-m-d', strtotime($this->ci->input->post('birthday'))),               
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),                
							'passp_seria'=>$this->ci->input->post('passp_seria'),              
							'passp_num'=>$this->ci->input->post('passp_num'),    
							'passp_out'=>$this->ci->input->post('passp_out'),
							'f_pass_out'=>$this->ci->input->post('f_pass_out'),                         
							'f_pass_seria'=>$this->ci->input->post('f_pass_seria'), 
							'f_pass_num'=>$this->ci->input->post('f_pass_num'), 
							'f_pass_period'=>$this->ci->input->post('f_pass_period')?date('Y-m-d', strtotime($this->ci->input->post('f_pass_period'))):null,
							'nal_number'=>$this->ci->input->post('nal_number'),           
							'_cities_rid'=>$this->ci->input->post('_cities_rid'),  
							'_dcarts_rid'=>$this->ci->input->post('_dcarts_rid')?$this->ci->input->post('_dcarts_rid'):null,                             
							'adress'=>$this->ci->input->post('adress'),                               
							'phones'=>$this->ci->input->post('phones'),                         
							'email'=>$this->ci->input->post('email'),             		
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_clients', $ins_arr);
		$ins_rid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $ins_rid;
		}		
	}
	
	public function update_record(){
		$update_arr = array('parent'=>$this->ci->input->post('parent'),                        
							'f_name'=>$this->ci->input->post('f_name'),                                  
							's_name'=>$this->ci->input->post('s_name'),                         
							'l_name'=>$this->ci->input->post('l_name'),                           
							'f_name_lat'=>$this->ci->input->post('f_name_lat'),                             
							'l_name_lat'=>$this->ci->input->post('l_name_lat'),  
							'sex'=>$this->ci->input->post('sex'),                     
							'birthday'=>date('Y-m-d', strtotime($this->ci->input->post('birthday'))),               
							'_countries_rid'=>$this->ci->input->post('_countries_rid'),                   
							'passp_seria'=>$this->ci->input->post('passp_seria'),              
							'passp_num'=>$this->ci->input->post('passp_num'),    
							'passp_out'=>$this->ci->input->post('passp_out'),  
							'f_pass_out'=>$this->ci->input->post('f_pass_out'),                  
							'f_pass_seria'=>$this->ci->input->post('f_pass_seria'), 
							'f_pass_num'=>$this->ci->input->post('f_pass_num'), 
							'f_pass_period'=>$this->ci->input->post('f_pass_period')?date('Y-m-d', strtotime($this->ci->input->post('f_pass_period'))):null,
							'nal_number'=>$this->ci->input->post('nal_number'),           
							'_cities_rid'=>$this->ci->input->post('_cities_rid'),  
							'_dcarts_rid'=>$this->ci->input->post('_dcarts_rid')?$this->ci->input->post('_dcarts_rid'):null,                            
							'adress'=>$this->ci->input->post('adress'),                               
							'phones'=>$this->ci->input->post('phones'),                         
							'email'=>$this->ci->input->post('email'),             		
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_clients', $update_arr, array('rid'=>$this->ci->input->post('rid')));
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
			$this->db->delete('_clients', array('rid'=>$rid));	
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	
	public function get_clientname_byrid($rid, $full = false){
		if($full) $this->db->select('CONCAT(l_name," ",f_name, " ",s_name) as client_name', False);
		else $this->db->select('CONCAT(l_name," ",f_name) as client_name', False);
		$this->db->from('_clients');
		$this->db->where(array('rid'=>$rid));
		$this->db->order_by('client_name');
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->client_name:null; 

	}	
	
	public function get_client_tours($clientRid){
		$this->db->select('_demands_headers._documents_rid as docRid,
							DATE_FORMAT(_demands_headers.date_doc, \'%d.%m.%Y\') as docDate,
							_countries.country_name as countryName, 
							_demands_headers.summ as summ,
							_demandsstatuses.demandsstatuses_name as demandsstatuses_name,
							_tours.hotel_name as hotel_name');
		$this->db->from('_demands_headers');
		$this->db->join('_demandsstatuses', '_demands_headers._demandsstatuses_rid = _demandsstatuses.rid');		
		$this->db->join('_demands_rows', '_demands_rows._demands_headers_rid = _demands_headers.rid');
		$this->db->join('_tours', '_demands_headers._tours_rid = _tours.rid');
		$this->db->join('_countries', '_tours._countries_rid = _countries.rid');
		$this->db->where(array('_demands_rows._clients_rid'=>$clientRid));
		$this->db->group_by('_demands_headers._documents_rid');
		$this->db->order_by('_demands_headers.date_doc');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result();
		return array();
	}
	
	public function get_attaches($cl_rid){
		$this->db->select('_attaches.*');
		$this->db->from('_attaches');
		$this->db->join('_clients_attaches', '_clients_attaches._attaches_rid = _attaches.rid');
		$this->db->where(array('_clients_attaches._clients_rid'=>$cl_rid));
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
		$ins_r = array('_clients_rid'=>$this->ci->input->post('_clients_rid'),
						'_attaches_rid'=>$attach_rid);
		$this->db->insert('_clients_attaches', $ins_r);
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
	
	
	public function get_tours_history($rid){
		$this->db->select('SQL_CALC_FOUND_ROWS _documents.rid, 
							DATE_FORMAT(_demands_headers.date_doc, \'%d.%m.%Y\') as date_doc, 
							_tours.sum as sum,
							CONCAT(_clients.l_name, \' \', SUBSTRING(_clients.f_name FROM 1 FOR 1), \'.\') as client_name,
							_clients.l_name as client_l_name,
							_countries.country_name as country_name,
							_tours.approve as approve,
							_tours.anulated as anulated,
							_hotels.hotel_name as hotel_name,
							DATE_FORMAT(_tours.date_from, \'%d.%m.%Y\') as date_from, 
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
		$this->db->join('_demands_headers', '_demands_headers._documents_rid = _documents.rid');
		$this->db->join('_demands_rows', '_demands_rows._demands_headers_rid = _demands_headers.rid');
		$this->db->join('_tours', '_demands_headers._tours_rid = _tours.rid');
		$this->db->join('_hotels', '_tours._hotels_rid = _hotels.rid', 'LEFT');
		$this->db->join('_countries', '_tours._countries_rid = _countries.rid');
		$this->db->join('_clients', '_demands_rows._clients_rid = _clients.rid');
		$this->db->join('_users', '_documents.owner_users_rid = _users.rid');
		$this->db->join('_employeers', '_employeers.rid = _users._employeers_rid');
		$this->db->group_by('_documents.rid');
		$this->db->where(array('_documents.doc_type'=>'DEMANDS'));
		$this->db->where(array('_clients.rid'=>$rid));
		$this->db->orderby('_demands_headers.date_doc');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function get_airs_history($rid){
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
		$this->db->where(array('_documents.doc_type'=>'AIRSELL'));
		$this->db->where(array('_clients.rid'=>$rid));
		$this->db->orderby('_airsell_headers.date_doc');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	
	public function check_unique_cardnum($_dcarts_rid, $rid){
		$this->db->select('*');
		$this->db->from('_clients');
		$this->db->where(array('_dcarts_rid'=>$_dcarts_rid, 'rid !='=>$rid));
		$query = $this->db->get();
		return $query->num_rows()?True:False;
	}
	
}
?>