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
class Airsell extends Doccontroller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('airsell');
		$this->load->model('airsell_model');
		$this->load->helper('advertisessources');
		$this->load->helper('clients');
		$this->load->helper('aircompanies');
		$this->load->helper('finjournal');
		$this->load->helper('aircalls');
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
			case 'getroutes': {$this->output->set_output($this->getroutes());break;}
			case 'limit': {$this->limit();break;}
			case 'help': {$this->help(); break;}
			default: $this->index();
		}
	}
	
	public function journal(){
		$data = array();
		$data['title'] = lang('AIRSELL_TITLE');
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['date_doc'] =  array('label'=>lang('DATE_DOC'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['client_name'] =  array('label'=>lang('CLIENT_L_NAME'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['dnum'] =  array('label'=>lang('DNUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['bill_code'] =  array('label'=>lang('BILL_CODE'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['bill_num'] =  array('label'=>lang('BILL_NUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['sum'] =  array('label'=>lang('SUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['emp_name'] =  array('label'=>lang('OWNER'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['anulated'] = array('label'=>lang('ANULATED'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no');
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'10%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->airsell_model->get_ds();
		$data['paging'] = $this->get_paging($this->airsell_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	
	private function create(){
		$data = array();
		$this->set_validation();
		$data['title'] = lang('AIRSELL_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->airsell_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			}
			
		}
		$data['routes'] = $this->getroutes(); 
		$data['content'] = $this->load->view('airsell/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	

	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = lang('AIRSELL_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->airsell_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->airsell_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->airsell_model->get_edit($rid);
		}
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid);
		# } список приаттаченых файлов
		$data['routes'] = $this->getroutes($rid); 
		$data['content'] = $this->load->view('airsell/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('AIRSELL_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->airsell_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid, True);
		# } список приаттаченых файлов
		$data['routes'] = $this->getroutes($rid); 
		$data['content'] = $this->load->view('airsell/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('AIRSELL_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->airsell_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->airsell_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('rid', 'Id', 'trim');
		$this->form_validation->set_rules('doc_from', lang('DOC_FROM'), 'trim');
		$this->form_validation->set_rules('doc_to', lang('DOC_TO'), 'trim');
		$this->form_validation->set_rules('_filials_rid', lang('FILIAL'), 'trim');
		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'trim');
		$this->form_validation->set_rules('bill_num', lang('bill_num'), 'trim');
		$this->form_validation->set_rules('bill_code', lang('bill_num'), 'trim');
		$this->form_validation->set_rules('client_name', lang('CLIENT_L_NAME'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('rid')) $search_rule['where']['_documents.rid'] = $this->input->post('rid');
			if($this->input->post('doc_from')) $search_rule['where']['_airsell_headers.date_doc >='] = date('Y-m-d', strtotime($this->input->post('doc_from')));
			if($this->input->post('doc_to')) $search_rule['where']['_airsell_headers.date_doc <='] = date('Y-m-d', strtotime($this->input->post('doc_to')));
			if($this->input->post('_filials_rid')) $search_rule['having']['_filials_rid'] = $this->input->post('_filials_rid');
			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');
			if($this->input->post('bill_code')) $search_rule['where']['_airsell_headers.bill_code'] = $this->input->post('bill_code');
			if($this->input->post('bill_num')) $search_rule['where']['_airsell_headers.bill_num'] = $this->input->post('bill_num');
			if($this->input->post('client_name')) $search_rule['like']['_clients.l_name'] = $this->input->post('client_name');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('airsell/find', $data, True);
	}
	
	private function set_validation(){
		$this->form_validation->set_rules('_advertisessources_rid', lang('ADVERTISE'), 'trim|required');
		$this->form_validation->set_rules('_aircalls_documents_rid', lang('AIRCALL'), 'trim');
		$this->form_validation->set_rules('_aircompanies_rids', lang('ROUTE_INFO'), 'callback_check_routes');
		$this->form_validation->set_rules('_clients_rid', lang('CLIENT_L_NAME'), 'trim|required');
		$this->form_validation->set_rules('bill_code', lang('BILL_CODE'), 'trim');
		$this->form_validation->set_rules('bill_num', lang('BILL_NUM'), 'trim');
		$this->form_validation->set_rules('issue', lang('ISSUE'), 'trim|required');
		$this->form_validation->set_rules('sum', lang('SUM'), 'trim|floatval');
		$this->form_validation->set_rules('_currencies_rid', lang('CURRENCY'), 'trim');
		$this->form_validation->set_rules('dnum', lang('DNUM'), 'trim');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		return;		
	}
	
	public function getroutes($doc_rid = null){
		$data = array();
		$data['show_errors'] = False;
		$data['routes'] = array();
		# если указан RID существующего документа
		# то получаем маршрут по нему из базы 
		# и отдаем контент
		if($doc_rid){
			$routes = $this->airsell_model->getroutes($doc_rid);
			foreach($routes as $r){
				$data['routes'][] = array('_aircompanies_rids'=>$r->_aircompanies_rid,
									'air_classes'=>$r->air_class,
									'_countries_rids_from'=>$r->_countries_rid_from,
									'_countries_rids_to'=>$r->_countries_rid_to,
									'points_from'=>$r->point_from,
									'points_to'=>$r->point_to,
									'departures'=>$r->departure,
									'arrivals'=>$r->arrival);
			}
		} else {
			if($this->input->post('_aircompanies_rids')){
				foreach($this->input->post('_aircompanies_rids') as $key=>$ar){
					$data['routes'][$key] = array('_aircompanies_rids'=>element($key, $this->input->post('_aircompanies_rids'), null),
										'air_classes'=>element($key, $this->input->post('air_classes'), null),
										'_countries_rids_from'=>element($key, $this->input->post('_countries_rids_from'), null),
										'_countries_rids_to'=>element($key, $this->input->post('_countries_rids_to'), null),
										'points_from'=>element($key, $this->input->post('points_from'), null),
										'points_to'=>element($key, $this->input->post('points_to'), null),
										'departures'=>element($key, $this->input->post('departures'), null),
										'arrivals'=>element($key, $this->input->post('arrivals'), null));
				}
			}
			if($this->input->post('add_route')){
				$this->form_validation->set_rules('_aircompanies_rid', lang('AIRCOMPANY'), 'trim|required');
				$this->form_validation->set_rules('air_class', lang('AIRCLASS'), 'trim|required');
				$this->form_validation->set_rules('_countries_rid_from', lang('COUNTRY_FROM'), 'trim|required');
				$this->form_validation->set_rules('_countries_rid_to', lang('COUNTRY_TO'), 'trim|required');
				$this->form_validation->set_rules('point_from', lang('POINT_FROM'), 'trim|required');
				$this->form_validation->set_rules('point_to', lang('POINT_TO'), 'trim|required');
				$this->form_validation->set_rules('departure', lang('DEPARTURE'), 'trim|required');
				$this->form_validation->set_rules('arrival', lang('ARRIVAL'), 'trim|required');
				$data['show_errors'] = True;
				if($this->form_validation->run()==True){
					$data['routes'][] = array('_aircompanies_rids'=>$this->input->post('_aircompanies_rid'),
										'air_classes'=>$this->input->post('air_class'),
										'_countries_rids_from'=>$this->input->post('_countries_rid_from'),
										'_countries_rids_to'=>$this->input->post('_countries_rid_to'),
										'points_from'=>$this->input->post('point_from'),
										'points_to'=>$this->input->post('point_to'),
										'departures'=>$this->input->post('departure'),
										'arrivals'=>$this->input->post('arrival'));
				}
			}
		}
		return $this->load->view('airsell/routes', $data, True); 
	}
	
	public function check_routes($a){
		if(!count($a)){
			$this->form_validation->set_message('check_routes', lang('ROUTES_EMPTY'));
			return False;
		}
		return True;
	}
	
	private function addattach(){
		$config['max_size']	= $this->config->item('crm_upload_max_size');
		$config['upload_path']	= $this->config->item('crm_upload_path');
		$config['encrypt_name'] = True;
		$config['allowed_types']	= $this->config->item('crm_allowed_types');
		$this->upload->initialize($config);
		if($this->upload->do_upload()){
			$this->airsell_model->addattach();
		}
		return $this->get_attaches($this->input->post('_documents_rid'));
	}
	
	private function get_attaches($doc_rid, $readonly = False){
		$data = array();
		$data['ds'] = $this->airsell_model->get_attaches($doc_rid);
		$data['readonly'] = $readonly;
		return $this->load->view('demands/attaches', $data, True);
	}
	
	private function removeattach(){
		$rid = $this->input->post('rid');
		$this->airsell_model->removeattach($rid);
		return $this->get_attaches($this->input->post('doc_rid'));
	}
	
}
?>