<?php
/**
 * TravelCRM
 *
 * An open source CRM system for travel agencies
 *
 * @author		Mazvv (vitalii.mazur@gmail.com)
 * @license		GNU GPLv3 (http://gplv3.fsf.org) 
 * @link		http://www.travelcrm.org.ua
 */
include_once APPPATH."libraries/core/Doccontroller.php";
class Demands extends Doccontroller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('demands');
		$this->load->model('demands_model');
		$this->load->helper('touroperators');
		$this->load->helper('advertisessources');
		$this->load->helper('curourts');
		$this->load->helper('hotelscats');
		$this->load->helper('rooms');
		$this->load->helper('food');
		$this->load->helper('clients');
		$this->load->helper('finjournal');
		$this->load->helper('calls');
		$this->load->helper('hotels');
		$this->load->library('upload');
	}
	
	public function _remap($m_cif_name){
		switch ($m_cif_name) {
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'remove': {$this->remove();break;}
			case 'move': {$this->move();break;}
			case 'sort': {$this->sort();break;}
			case 'addattach': {$this->output->set_output($this->addattach());break;}
			case 'removeattach': {$this->output->set_output($this->removeattach());break;}
			case 'getclients': {$this->output->set_output($this->getclients());break;}
			case 'recalc': {$this->output->set_output($this->recalc());break;} # пересчет данных по цене тура
			case 'limit': {$this->limit();break;}
			case 'help': {$this->help(); break;}
			# печатные формы
			case 'print_agreement': {$this->print_agreement();break;}
			case 'print_demand': {$this->print_demand();break;}
			default: $this->index();
		}
	}
	
	public function journal(){
		$data = array();
		$data['title'] = lang('DEMANDS_TITLE');
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['date_doc'] =  array('label'=>lang('DATE_DOC'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['client_name'] =  array('label'=>lang('CLIENT_L_NAME'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['country_name'] =  array('label'=>lang('COUNTRY'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['sum'] =  array('label'=>lang('SUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['date_from'] =  array('label'=>lang('DATE_FROM'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['emp_name'] =  array('label'=>lang('OWNER'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['anulated'] = array('label'=>lang('ANULATED'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no');
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no');  
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->demands_model->get_ds();
		$data['paging'] = $this->get_paging($this->demands_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	
	private function create(){
		$data = array();
		$this->set_validation();
		$data['title'] = lang('DEMANDS_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		$data['clients'] = $this->getclients();
		if ($this->form_validation->run() === True){
			if($rid = $this->demands_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('demands/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = lang('DEMANDS_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->demands_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->demands_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->demands_model->get_edit($rid);
		}
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid);
		# } список приаттаченых файлов
		# { список участников тура
		$sub_data['zt'] = null; # признак заказчика или туриста, 
		$clients_ds = $this->demands_model->get_clients_list($rid);
		$rids = array();
		foreach($clients_ds as $cl){
			$rids[] = $cl->_clients_rid;
			if($cl->demander) {
				$sub_data['zt'] = $cl->tourist?$cl->_clients_rid.'_Z':$cl->_clients_rid;
			}
		}
		$sub_data['cl_ds'] = $rids?$this->demands_model->get_clients_byrids($rids):array();
		if(!$sub_data['cl_ds']) $data['clients'] = '';
		else $data['clients'] = $this->load->view('demands/cllist', $sub_data, True);
		# } список участников тура
		
		$data['content'] = $this->load->view('demands/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('DEMANDS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->demands_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid, True);
		# } список приаттаченых файлов
		# { список участников тура
		$sub_data['zt'] = null; # признак заказчика или туриста, 
		$clients_ds = $this->demands_model->get_clients_list($rid);
		$rids = array();
		foreach($clients_ds as $cl){
			$rids[] = $cl->_clients_rid;
			if($cl->demander) {
				$sub_data['zt'] = $cl->tourist?$cl->_clients_rid.'_Z':$cl->_clients_rid;
			}
		}
		$sub_data['cl_ds'] = $rids?$this->demands_model->get_clients_byrids($rids):array();
		$sub_data['readonly'] = True; # исключаем возможность удаления клиентов из списка
		if(!$sub_data['cl_ds']) $data['clients'] = '';
		else $data['clients'] = $this->load->view('demands/cllist', $sub_data, True);
		# } список участников тура
		$data['content'] = $this->load->view('demands/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('DEMANDS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->demands_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->demands_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
		}
		$data['content'] = $this->load->view('demands/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('rid', 'Id', 'trim');
		$this->form_validation->set_rules('doc_from', lang('DOC_FROM'), 'trim');
		$this->form_validation->set_rules('doc_to', lang('DOC_TO'), 'trim');
		$this->form_validation->set_rules('_filials_rid', lang('FILIAL'), 'trim');
		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'trim');
		$this->form_validation->set_rules('_countries_rid', lang('COUNTRY'), 'trim');
		$this->form_validation->set_rules('_curourts_rid', lang('CUROURT'), 'trim');
		$this->form_validation->set_rules('_hotels_rid', lang('HOTEL'), 'trim');
		$this->form_validation->set_rules('client_name', lang('CLIENT_L_NAME'), 'trim');
		$this->form_validation->set_rules('tour_num', lang('TOUR_NUM'), 'trim');
		$this->form_validation->set_rules('_touroperators_rid', lang('TOUROPERATOR'), 'trim');			
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('rid')) $search_rule['where']['_documents.rid'] = $this->input->post('rid');
			if($this->input->post('doc_from')) $search_rule['where']['_demands_headers.date_doc >='] = date('Y-m-d', strtotime($this->input->post('doc_from')));
			if($this->input->post('doc_to')) $search_rule['where']['_demands_headers.date_doc <='] = date('Y-m-d', strtotime($this->input->post('doc_to')));
			if($this->input->post('_filials_rid')) $search_rule['having']['_filials_rid'] = $this->input->post('_filials_rid');
			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');
			if($this->input->post('_countries_rid')) $search_rule['where']['_tours._countries_rid'] = $this->input->post('_countries_rid');
			if($this->input->post('_curourts_rid')) $search_rule['where']['_tours._curourts_rid'] = $this->input->post('_curourts_rid');
			if($this->input->post('_hotels_rid')) $search_rule['where']['_tours._hotels_rid'] = $this->input->post('_hotels_rid');
			if($this->input->post('client_name')) $search_rule['like']['_clients.l_name'] = $this->input->post('client_name');
			if($this->input->post('tour_num')) $search_rule['where']['_demands_headers.tour_num'] = $this->input->post('tour_num');
			if($this->input->post('_touroperators_rid')) $search_rule['where']['_tours._touroperators_rid'] = $this->input->post('_touroperators_rid');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('demands/find', $data, True);
	}
	
	
	private function set_validation(){
		$this->form_validation->set_rules('_advertisessources_rid', lang('ADVERTISE'), 'trim|required');
		$this->form_validation->set_rules('_calls_documents_rid', lang('CALL'), 'trim');
		$this->form_validation->set_rules('_touroperators_rid', lang('TOUROPERATOR'), 'trim|required');
		$this->form_validation->set_rules('route', lang('ROUTE'), 'trim|required|max_length[255]');
		$this->form_validation->set_rules('date_from', lang('DATE_FROM'), 'trim|required');
		$this->form_validation->set_rules('date_to', lang('DATE_TO'), 'trim|required');
		$this->form_validation->set_rules('_hotels_rid', lang('HOTEL'), 'trim|callback_check_hotel');
		$this->form_validation->set_rules('_countries_rid', lang('COUNTRY'), 'trim|required|callback_check_curourt');
		$this->form_validation->set_rules('_curourts_rid', lang('CUROURT'), 'trim');
		$this->form_validation->set_rules('_rooms_rid', lang('ROOM'), 'trim|required');
		$this->form_validation->set_rules('_food_rid', lang('FOOD'), 'trim|required');
		$this->form_validation->set_rules('room_cat', lang('CROOM'), 'trim|required');
		$this->form_validation->set_rules('transfer', lang('TRANSFER'), 'trim|required');
		$this->form_validation->set_rules('excursions', lang('EXCURSIONS'), 'trim|required|max_length[512]');
		$this->form_validation->set_rules('tour_num', lang('TOUR_NUM'), 'trim');
		$this->form_validation->set_rules('_cl_rid', lang('TOUR_MEMBERS'), 'callback_clients_check');
		$this->form_validation->set_rules('visa', lang('VISA'), 'trim');
		$this->form_validation->set_rules('approve_tour', lang('APPROVE_TOUR'), 'trim');
		$this->form_validation->set_rules('demander', lang('CL_ZT'), 'trim|required|callback_check_zt');
		$this->form_validation->set_rules('sum_tour', lang('SUM_TOUR'), 'trim|floatval|required');
		$this->form_validation->set_rules('cource', lang('SUM_TOUR'), 'trim|floatval|required');
		$this->form_validation->set_rules('to_koeff', lang('TO_KOEFF'), 'trim|floatval|required');
		$this->form_validation->set_rules('discount_per', lang('DISCOUNT_PER'), 'trim|floatval');
		$this->form_validation->set_rules('discount_fix', lang('DISCOUNT_PER'), 'trim|floatval');
		$this->form_validation->set_rules('_currencies_rid', lang('CURRENCY'), 'trim|required');
		$this->form_validation->set_rules('sum', lang('SUM'), 'trim|floatval|required');
		$this->form_validation->set_rules('_calls_documents_rid', lang(''), 'trim');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		return;		
	}
	
	private function getclients(){
		#RID клиента который добавляется в список
		$add_rid = $this->input->post('add');
		#RID клиента который удаляется со списка
		$remove_rid = $this->input->post('remove');
		$data = array();
		$rids = array();
		if($add_rid) $rids[] = $add_rid;
		if($this->input->post('_cl_rid')){
			foreach($this->input->post('_cl_rid') as $cl){
				if($cl!==$remove_rid) $rids[] = $cl;
			}
		}
		$data['cl_ds'] = $rids?$this->demands_model->get_clients_byrids($rids):array();
		if(!$data['cl_ds']) return '';
		return $this->load->view('demands/cllist', $data, True);
	}
	
	public function clients_check($clients){
		if(!$clients){
			$this->form_validation->set_message('clients_check', lang('CLIENTS_EMPTY'));
			return False;
		}
		return True;
	}
	
	public function check_zt($cl){
		$t_cl = explode('_', $cl);
		if((count($t_cl)==2 && $t_cl[1]=='Z') || count($this->input->post('_cl_rid'))>1) return True;
		$this->form_validation->set_message('check_zt', lang('CLIENTS_EMPTY'));
		return False;
	}
	
	public function recalc(){
		$tour_sum = floatval($this->input->post('sum_tour'));
		$cource = floatval($this->input->post('cource'));
		$to_koeff = floatval($this->input->post('to_koeff'));
		$discount_per = floatval($this->input->post('discount_per'));
		$discount_fix = floatval($this->input->post('discount_fix'));
		# реализация алгоритма пересчета
		return 	ROUND((($tour_sum-$tour_sum*($discount_per/100)-$discount_fix)*$cource*(1+$to_koeff/100)), 2);		
	}
	
	
	private function addattach(){
		$config['max_size']	= $this->config->item('crm_upload_max_size');
		$config['upload_path']	= $this->config->item('crm_upload_path');
		$config['encrypt_name'] = True;
		$config['allowed_types']	= $this->config->item('crm_allowed_types');
		$this->upload->initialize($config);
		if($this->upload->do_upload()){
			$this->demands_model->addattach();
		}
		return $this->get_attaches($this->input->post('_documents_rid'));
	}
	
	private function get_attaches($doc_rid, $readonly = False){
		$data = array();
		$data['ds'] = $this->demands_model->get_attaches($doc_rid);
		$data['readonly'] = $readonly;
		return $this->load->view('demands/attaches', $data, True);
	}
	
	private function removeattach(){
		$rid = $this->input->post('rid');
		$this->demands_model->removeattach($rid);
		return $this->get_attaches($this->input->post('doc_rid'));
	}
	
	# Печатные формы
	private function print_agreement(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('DEMANDS_PRINT_AGREEMENT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->demands_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список участников тура
		$clients_ds = $this->demands_model->get_clients_list($rid);
		$data['clients'] = array();
		foreach($clients_ds as $cl){
			if($cl->demander){
				$data['demander'] = $cl;
				if($cl->tourist) $data['clients'][] = $cl;
			}
			else $data['clients'][] = $cl;
		}
		# } список участников тура
		$data['filial_info'] = get_filial_info(get_curr_ufrid());
		$data['touroperator_info'] = get_touroperator_info($data['ds']->_touroperators_rid);
		$data['content'] = $this->load->view('prints/agreement', $data, True);
		return $this->load->view('layouts/prints_layout', $data);
	}
	
	private function print_demand(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('DEMANDS_PRINT_DEMAND');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->demands_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список участников тура
		$clients_ds = $this->demands_model->get_clients_list($rid);
		$data['clients'] = array();
		foreach($clients_ds as $cl){
			if($cl->demander){
				$data['demander'] = $cl;
				if($cl->tourist) $data['clients'][] = $cl;
			}
			else $data['clients'][] = $cl;
		}
		# } список участников тура
		$data['filial_info'] = get_filial_info(get_curr_ufrid());
		$data['touroperator_info'] = get_touroperator_info($data['ds']->_touroperators_rid);
		$data['content'] = $this->load->view('prints/demand', $data, True);
		return $this->load->view('layouts/prints_layout', $data);
	}
	
	public function check_curourt($_countries_rid){
		if($this->input->post('_curourts_rid')){
			$this->load->model('curourts_model');
			if(!$this->curourts_model->is_curourt_from_country($_countries_rid, $this->input->post('_curourts_rid'))){
				$this->form_validation->set_message('check_curourt', lang('CUROURT_IS_NOT_IN_COUNTRY'));
				return False;
			}
			
		}
		return True;	
	}

	public function check_hotel($_hotels_rid){
		if($this->input->post('_hotels_rid')){
			$this->load->model('hotels_model');
			if(!$this->hotels_model->is_hotel_place($this->input->post('_countries_rid'), $this->input->post('_curourts_rid'), $_hotels_rid)){
				$this->form_validation->set_message('check_hotel', lang('HOTEL_IS_NOT_IN_PLACE'));
				return False;
			}
			
		}
		return True;	
	}
	
}

?>