<?php
include_once APPPATH."libraries/core/Docmodel.php";
class Demands_model extends Docmodel{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _documents.rid, 
							DATE_FORMAT(_demands_headers.date_doc, \'%d.%m.%Y\') as date_doc, 
							_tours.sum as sum,
							CONCAT(_clients.l_name, \' \', SUBSTRING(_clients.f_name FROM 1 FOR 1), \'.\') as client_name,
							_clients.l_name as client_l_name,
							_countries.country_name as country_name,
							_curourts.curourt_name as curourt_name,
							_tours.approve as approve,
							_tours.anulated as anulated,
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
		$this->db->join('_curourts', '_tours._curourts_rid = _curourts.rid', 'LEFT');
		$this->db->join('_clients', '_demands_rows._clients_rid = _clients.rid');
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
							DATE_FORMAT(_demands_headers.date_doc, \'%d.%m.%Y\') as date_doc,
							_demands_headers._tours_rid as _tours_rid,
							_demands_headers._advertisessources_rid as _advertisessources_rid,
							_demands_headers.agreement as agreement,
							_demands_headers._calls_documents_rid as _calls_documents_rid,
							_tours._currencies_rid as _currencies_rid,
							_tours.tour_num as tour_num,
							_tours.sum as sum,
							_tours.cource as cource,
							_tours.discount_per as discount_per,
							_tours.discount_fix as discount_fix,
							_tours.to_koeff as to_koeff,
							_tours._food_rid as _food_rid,
							_tours._touroperators_rid as _touroperators_rid,
							_tours._rooms_rid as _rooms_rid,
							_tours.room_cat as room_cat,
							_tours._countries_rid as _countries_rid,
							_tours._curourts_rid as _curourts_rid,
							_tours.cif as cif,
							_tours.approve as approve,
							_tours.anulated as anulated,
							_tours.visa as visa,
							_tours.order_num as order_num,
							_tours.order_sum as order_sum,
							_tours._hotels_rid as _hotels_rid,
							_tours._countries_rid as _countries_rid,
							_tours._curourts_rid as _curourts_rid,
							_countries.country_name,
							_curourts.curourt_name,
							_hotels.hotel_name as hotel_name,
							_hotelscats.rid as _hotelscats_rid,
							DATE_FORMAT(_tours.order_date, \'%d.%m.%Y\') as order_date,
							DATE_FORMAT(_tours.date_from, \'%d.%m.%Y\') as date_from,
							DATE_FORMAT(_tours.date_to, \'%d.%m.%Y\') as date_to,
							_tours.route as route,
							_tours.transfer as transfer,
							_tours.excursions as excursions,
							_tours.sum_tour as sum_tour,
							_documents.descr as descr, _documents.archive', False);
		$this->db->from('_documents');
		$this->db->join('_demands_headers', '_demands_headers._documents_rid = _documents.rid');
		$this->db->join('_demands_rows', '_demands_rows._demands_headers_rid = _demands_headers.rid');
		$this->db->join('_tours', '_demands_headers._tours_rid = _tours.rid');
		$this->db->join('_hotels', '_tours._hotels_rid = _hotels.rid', 'LEFT');
		$this->db->join('_hotelscats', '_hotelscats.rid = _hotels._hotelscats_rid', 'LEFT');
		$this->db->join('_countries', '_tours._countries_rid = _countries.rid');
		$this->db->join('_curourts', '_tours._curourts_rid = _curourts.rid', 'LEFT');
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
		$ins_tours = array('_touroperators_rid'=>$this->ci->input->post('_touroperators_rid'),
								'_food_rid'=>$this->ci->input->post('_food_rid'),
								'_rooms_rid'=>$this->ci->input->post('_rooms_rid'),
								'_currencies_rid'=>$this->ci->input->post('_currencies_rid'),
								'room_cat'=>$this->ci->input->post('room_cat'),
								'route'=>$this->ci->input->post('route'),
								'_hotels_rid'=>$this->ci->input->post('_hotels_rid')?$this->ci->input->post('_hotels_rid'):null,
								'_countries_rid'=>$this->ci->input->post('_countries_rid'),
								'_curourts_rid'=>$this->ci->input->post('_curourts_rid')?$this->ci->input->post('_curourts_rid'):null,
								'date_from'=>date('Y-m-d', strtotime($this->ci->input->post('date_from'))),
								'date_to'=>date('Y-m-d', strtotime($this->ci->input->post('date_to'))),
								'transfer'=>$this->ci->input->post('transfer'),
								'excursions'=>$this->ci->input->post('excursions'),
								'visa'=>$this->ci->input->post('visa'),
								'cif'=>$this->ci->input->post('cif'),
								'approve'=>$this->ci->input->post('approve'),
								'tour_num'=>$this->ci->input->post('tour_num'),
								'sum_tour'=>$this->ci->input->post('sum_tour'),
								'cource'=>$this->ci->input->post('cource'),
								'to_koeff'=>$this->ci->input->post('to_koeff'),
								'discount_fix'=>$this->ci->input->post('discount_fix'),
								'discount_per'=>$this->ci->input->post('discount_per'),
								'sum'=>$this->ci->recalc(),
								'owner_users_rid'=>get_curr_urid(),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->insert('_tours', $ins_tours);
		$tour_rid = $this->db->insert_id();
		$ins_h = array('date_doc'=>date('Y-m-d', strtotime($this->ci->input->post('date_doc'))),
								'_documents_rid'=>$doc_rid,
								'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
								'_calls_documents_rid'=>$this->ci->input->post('_calls_documents_rid')?$this->ci->input->post('_calls_documents_rid'):null,
								'_tours_rid'=>$tour_rid,
								'agreement'=>$doc_rid.'-'.date('d/m/Y'),
								'archive'=>$this->ci->input->post('archive'),
								'owner_users_rid'=>get_curr_urid(),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->insert('_demands_headers', $ins_h);
		$h_rid = $this->db->insert_id();
		# выясняем кто заказчик и является ли он туристом
		$demander = floatval($this->ci->input->post('demander'));
		$demander_t = false; # заказчик не турист
		$demander_arr = explode('_', $this->ci->input->post('demander'));
		if(count($demander_arr) > 1 && $demander_arr[1]=='Z') $demander_t = True;
		foreach($this->ci->input->post('_cl_rid') as $cl_rid){
			$ins_r = array('_demands_headers_rid'=>$h_rid,
									'_clients_rid'=>$cl_rid,
									'demander'=>($cl_rid==$demander),
									'tourist'=>($cl_rid==$demander)?$demander_t:True,
									'owner_users_rid'=>get_curr_urid(),
									'modifier_users_rid'=>get_curr_urid());
			$this->db->insert('_demands_rows', $ins_r);
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $doc_rid;
		}		
	}
	
	public function get_clients_list($doc_rid){
		$this->db->select('*');
		$this->db->from('_demands_rows');
		$this->db->join('_demands_headers', '_demands_headers.rid = _demands_rows._demands_headers_rid');
		$this->db->where(array('_demands_headers._documents_rid'=>$doc_rid));
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();	
	}
	
	
	public function update_record(){
		$update_doc = array('doc_type'=>$this->ci->get_typedoc(), 
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_documents', $update_doc, array('_documents.rid'=>$this->ci->input->post('rid')));
		$query = $this->db->getwhere('_demands_headers', array('_demands_headers._documents_rid'=>$this->ci->input->post('rid')));
		if(!$query->num_rows()) {
			$this->db->trans_rollback();
    		return False;
		}
		$h_rid = $query->row()->rid;
		$tour_rid = $query->row()->_tours_rid;		
		$update_tours = array('_touroperators_rid'=>$this->ci->input->post('_touroperators_rid'),
								'_food_rid'=>$this->ci->input->post('_food_rid'),
								'_rooms_rid'=>$this->ci->input->post('_rooms_rid'),
								'_currencies_rid'=>$this->ci->input->post('_currencies_rid'),
								'room_cat'=>$this->ci->input->post('room_cat'),
								'route'=>$this->ci->input->post('route'),
								'_hotels_rid'=>$this->ci->input->post('_hotels_rid')?$this->ci->input->post('_hotels_rid'):null,
								'_countries_rid'=>$this->ci->input->post('_countries_rid'),
								'_curourts_rid'=>$this->ci->input->post('_curourts_rid')?$this->ci->input->post('_curourts_rid'):null,
								'date_from'=>date('Y-m-d', strtotime($this->ci->input->post('date_from'))),
								'date_to'=>date('Y-m-d', strtotime($this->ci->input->post('date_to'))),
								'order_date'=>date('Y-m-d', strtotime($this->ci->input->post('order_date'))),
								'order_sum'=>$this->ci->input->post('order_sum'),
								'order_num'=>$this->ci->input->post('order_num'),
								'transfer'=>$this->ci->input->post('transfer'),
								'excursions'=>$this->ci->input->post('excursions'),
								'visa'=>$this->ci->input->post('visa'),
								'cif'=>$this->ci->input->post('cif'),
								'approve'=>$this->ci->input->post('approve'),
								'anulated'=>$this->ci->input->post('anulated'),
								'tour_num'=>$this->ci->input->post('tour_num'),
								'sum_tour'=>$this->ci->input->post('sum_tour'),
								'cource'=>$this->ci->input->post('cource'),
								'to_koeff'=>$this->ci->input->post('to_koeff'),
								'discount_fix'=>$this->ci->input->post('discount_fix'),
								'discount_per'=>$this->ci->input->post('discount_per'),
								'sum'=>$this->ci->recalc(),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->update('_tours', $update_tours, array('_tours.rid'=>$tour_rid));
		$update_h = array('date_doc'=>date('Y-m-d', strtotime($this->ci->input->post('date_doc'))),
								'_advertisessources_rid'=>$this->ci->input->post('_advertisessources_rid'),
								'_calls_documents_rid'=>$this->ci->input->post('_calls_documents_rid')?$this->ci->input->post('_calls_documents_rid'):null,
								'_tours_rid'=>$tour_rid,
								'agreement'=>$this->ci->input->post('rid').'-'.date('d/m/Y'),
								'archive'=>$this->ci->input->post('archive'),
								'modifier_users_rid'=>get_curr_urid());
		$this->db->set('modifyDT', 'now()', False);
		$this->db->update('_demands_headers', $update_h, array('_demands_headers._documents_rid'=>$this->ci->input->post('rid')));
		$this->db->delete('_demands_rows', array('_demands_rows._demands_headers_rid'=>$h_rid));
		# выясняем кто заказчик и является ли он туристом
		$demander = floatval($this->ci->input->post('demander'));
		$demander_t = false; # заказчик не турист
		$demander_arr = explode('_', $this->ci->input->post('demander'));
		if(count($demander_arr) > 1 && $demander_arr[1]=='Z') $demander_t = True;
		foreach($this->ci->input->post('_cl_rid') as $cl_rid){
			$ins_r = array('_demands_headers_rid'=>$h_rid,
									'_clients_rid'=>$cl_rid,
									'demander'=>($cl_rid==$demander),
									'tourist'=>($cl_rid==$demander)?$demander_t:True,
									'owner_users_rid'=>get_curr_urid(),
									'modifier_users_rid'=>get_curr_urid());
			$this->db->insert('_demands_rows', $ins_r);
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $this->ci->input->post('rid');
		}		
	}
	
	
	public function get_clients_byrids($rids){
		$this->db->select('_clients.*,
							CONCAT(_clients.f_pass_seria, _clients.f_pass_num) as f_pass,
							DATE_FORMAT(_clients.birthday, \'%d.%m.%Y\') as birthday,
							DATE_FORMAT(_clients.f_pass_period, \'%d.%m.%Y\') as f_pass_period', False);
		$this->db->from('_clients');
		$this->db->where_in('_clients.rid', $rids);
		$this->db->order_by('_clients.l_name');
		$query = $this->db_get('_clients');
		#echo $this->db->last_query();
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