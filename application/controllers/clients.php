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
include_once APPPATH."libraries/core/Crmcontroller.php";
class Clients extends Crmcontroller {
		
	private $jtp = array('val'=>'rid', 'scr'=>'client_name', 'val_p'=>'_clients_rid', 'scr_p'=>'client_name');
	 
	public function __construct(){
		parent::__construct();
		$this->lang->load('demands');
		$this->lang->load('airsell');
		$this->lang->load('clients');
		$this->load->model('clients_model');
		$this->load->helper('clients');
		$this->load->helper('dcarts');
		$this->load->library('upload');

		# Overwrite jtp mapper if need 
		# It's very usable if form has some value_pickers with one type
		if(element('val_p', $this->a_uri_assoc, null)) $this->jtp['val_p'] = element('val_p', $this->a_uri_assoc, null);
		if(element('scr_p', $this->a_uri_assoc, null)) $this->jtp['scr_p'] = element('scr_p', $this->a_uri_assoc, null);
	}

	public function _remap($m_Name){
		switch ($m_Name) {
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'move': {$this->move();break;}
			case 'remove': {$this->remove();break;}
			case 'sort': {$this->sort();break;}
			case 'vcreate': {$this->vcreate();break;}
			case 'vedit': {$this->vedit();break;}
			case 'vdetails': {$this->vdetails();break;}
			case 'vremove': {$this->vremove();break;}
			case 'vmove': {$this->vmove();break;}
			case 'vsort': {$this->vsort();break;}
			case 'vjournal': 
			case 'vfind': {$this->vjournal(); break;}
			case 'addattach': {$this->output->set_output($this->addattach());break;}
			case 'removeattach': {$this->output->set_output($this->removeattach());break;}
			case 'limit': {$this->limit();break;}
			case 'help': {$this->help(); break;}
			default: $this->index();
		}
	}

	public function journal(){
		$data = array();
		$data['title'] = lang('CLIENTS_TITLE');
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['l_name'] =  array('label'=>lang('L_NAME'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['f_name'] =  array('label'=>lang('F_NAME'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['birthday'] =  array('label'=>lang('BIRTHDAY'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['f_pass_num'] =  array('label'=>lang('FPASSP_NUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['email'] =  array('label'=>lang('EMAIL'), 'colwidth'=>'10%', 'sort'=>True, 'type'=>'email');
		$data['fields']['card_num'] =  array('label'=>lang('CARD_NUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'10%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->clients_model->get_ds();
		$data['paging'] = $this->get_paging($this->clients_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}

	private function create(){
		$data = array();
		$this->set_validation();
		$data['title'] = lang('CLIENTS_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->clients_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('clients/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}

	

	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = lang('CLIENTS_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->clients_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->clients_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->clients_model->get_edit($rid);
		}
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid);
		# } список приаттаченых файлов
		$data['content'] = $this->load->view('clients/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}

	

	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('CLIENTS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->clients_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid, True);
		# } список приаттаченых файлов
		$data['content'] = $this->load->view('clients/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);

	}



	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('f_name', lang('F_NAME'), 'trim');
		$this->form_validation->set_rules('l_name', lang('L_NAME'), 'trim');
		$this->form_validation->set_rules('f_pass_num', lang('FPASSP_NUM'), 'trim');
		$this->form_validation->set_rules('archive', lang('HIDE_ARCHIVE'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('f_name')) $search_rule['like']['_clients.f_name'] = $this->input->post('f_name');
			if($this->input->post('l_name')) $search_rule['like']['_clients.l_name'] = $this->input->post('l_name');
			if($this->input->post('f_pass_num')) $search_rule['like']['_clients.f_pass_num'] = $this->input->post('f_pass_num');
			if($this->input->post('archive')==0) $search_rule['where']['_clients.archive'] = $this->input->post('archive');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('clients/find', $data, True);
	}

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('CLIENTS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->clients_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->clients_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->clients_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	

	/* Операции для Value Picker */
	private function vcreate(){
		$data = array();
		$this->set_validation();
		$data['title'] = lang('CLIENTS_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->clients_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/vedit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('clients/vcreate', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}

	
	public function vjournal(){
		$data = array();
		$data['title'] = lang('CLIENTS_TITLE');
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->vfind();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['l_name'] =  array('label'=>lang('L_NAME'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['f_name'] =  array('label'=>lang('F_NAME'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['birthday'] =  array('label'=>lang('BIRTHDAY'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['f_pass_num'] =  array('label'=>lang('FPASSP_NUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['email'] =  array('label'=>lang('EMAIL'), 'colwidth'=>'10%', 'sort'=>True, 'type'=>'email');
		$data['fields']['card_num'] =  array('label'=>lang('CARD_NUM'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'10%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['jtp'] = $this->jtp;
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->clients_model->get_ds();
		$data['paging'] = $this->get_paging($this->clients_model->get_calc_rows(), True);
		$content = $this->load->view('standart/vgrid', $data, True);
		$this->load->view('layouts/valuepicker_layout', array('content'=>$content));		
		return;
	}
	
	private function vedit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = lang('CLIENTS_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['jtp'] = $this->jtp;
		$data['ds'] = $this->clients_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->clients_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->clients_model->get_edit($rid);
		}
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid);
		# } список приаттаченых файлов
		$data['content'] = $this->load->view('clients/vedit', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}

	

	private function vdetails(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('CLIENTS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['jtp'] = $this->jtp;
		$data['ds'] = $this->clients_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		# { список приаттаченых файлов
		$data['attaches'] = $this->get_attaches($rid, True);
		# } список приаттаченых файлов
		$data['content'] = $this->load->view('clients/vdetails', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}



	private function vfind(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('f_name', lang('F_NAME'), 'trim');
		$this->form_validation->set_rules('l_name', lang('L_NAME'), 'trim');
		$this->form_validation->set_rules('f_pass_num', lang('FPASSP_NUM'), 'trim');
		$this->form_validation->set_rules('archive', lang('HIDE_ARCHIVE'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('f_name')) $search_rule['like']['_clients.f_name'] = $this->input->post('f_name');
			if($this->input->post('l_name')) $search_rule['like']['_clients.l_name'] = $this->input->post('l_name');
			if($this->input->post('f_pass_num')) $search_rule['like']['_clients.f_pass_num'] = $this->input->post('f_pass_num');
			if($this->input->post('archive')==0) $search_rule['where']['_clients.archive'] = $this->input->post('archive');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('clients/vfind', $data, True);
	}

	private function vmove(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('clients_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->clients_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->clients_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->clients_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('standart/vmove', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}
	
	private function set_validation(){
		$this->form_validation->set_rules('l_name', lang('L_NAME'), 'required|trim');
		$this->form_validation->set_rules('f_name', lang('F_NAME'), 'required|trim');
		$this->form_validation->set_rules('s_name', lang('S_NAME'), 'trim');
		$this->form_validation->set_rules('_dcarts_rid', lang('CARD_NUM'), 'trim|callback_check_unique_cardnum');
		$this->form_validation->set_rules('l_name_lat', lang('L_NAME_LAT'), 'required|trim');
		$this->form_validation->set_rules('f_name_lat', lang('F_NAME_LAT'), 'required|trim');
		$this->form_validation->set_rules('_countries_rid', lang('CITIZENSHIP'), 'required|trim');
		$this->form_validation->set_rules('_cities_rid', lang('CITY'), 'required|trim');
		$this->form_validation->set_rules('sex', lang('SEX'), 'required|trim');
		$this->form_validation->set_rules('nal_number', lang('NAL_NUM'), 'trim|numeric');
		$this->form_validation->set_rules('phones', lang('PHONES'), 'trim');
		$this->form_validation->set_rules('email', lang('EMAIL'), 'trim|valid_email');
		$this->form_validation->set_rules('passp_seria', lang('PASSP_SERIA'), 'trim|exact_length[2]');
		$this->form_validation->set_rules('passp_num', lang('PASSP_NUM'), 'trim|min_length[6]|numeric');
		$this->form_validation->set_rules('f_pass_seria', lang('FPASSP_SERIA'), 'trim|exact_length[2]');
		$this->form_validation->set_rules('f_pass_num', lang('FPASSP_NUM'), 'trim|min_length[6]|numeric');
		$this->form_validation->set_rules('passp_out', lang('PASSP_OUT'), 'trim|max_length[255]');
		$this->form_validation->set_rules('f_pass_out', lang('FPASSP_OUT'), 'trim|max_length[255]');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		return;		
	}
	
	private function addattach(){
		$config['max_size']	= $this->config->item('crm_upload_max_size');
		$config['upload_path']	= $this->config->item('crm_upload_path');
		$config['encrypt_name'] = True;
		$config['allowed_types']	= $this->config->item('crm_allowed_types');
		$this->upload->initialize($config);
		if($this->upload->do_upload()){
			$this->clients_model->addattach();
		}
		return $this->get_attaches($this->input->post('_clients_rid'));
	}
	
	private function get_attaches($cl_rid, $readonly = False){
		$data = array();
		$data['ds'] = $this->clients_model->get_attaches($cl_rid);
		$data['readonly'] = $readonly;
		return $this->load->view('clients/attaches', $data, True);
	}
	
	private function removeattach(){
		$rid = $this->input->post('rid');
		$this->clients_model->removeattach($rid);
		return $this->get_attaches($this->input->post('doc_rid'));
	}

	public function check_unique_cardnum($_dcarts_rid){
		if(!$_dcarts_rid) return True;
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->clients_model->check_unique_cardnum($_dcarts_rid, $rid)){
			$this->form_validation->set_message('check_unique_cardnum', lang('CLIENTS_CARDNUM_NOTUNIQUE'));
			return False;
		}
		return True;
	}

}



?>