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
class Rooms extends Crmcontroller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load('rooms');
		$this->load->model('rooms_model');
	}
	
	public function _remap($m_Name){
		switch ($m_Name) {
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'remove': {$this->remove();break;}
			case 'move': {$this->move();break;}
			case 'sort': {$this->sort();break;}
			case 'limit': {$this->limit();break;}
			case 'help': {$this->help(); break;}
			default: $this->index();
		}
	}
	
	public function journal(){
		$data = array();
		$data['title'] = lang('ROOMS_TITLE');
		
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['code'] =  array('label'=>lang('CODE'), 'colwidth'=>'30%', 'sort'=>True);
		$data['fields']['room_name'] =  array('label'=>lang('NAME'), 'colwidth'=>'30%', 'sort'=>True); 
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'30%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->rooms_model->get_ds();
		$data['paging'] = $this->get_paging($this->rooms_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	
	private function create(){
		$data = array();

		$this->form_validation->set_rules('code', lang('CODE'), 'required|trim|callback_check_unique_code');
		$this->form_validation->set_rules('room_name', lang('NAME'), 'required|trim|callback_check_unique_name');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');

		$data['title'] = lang('ROOMS_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->rooms_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('rooms/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();

		$this->form_validation->set_rules('code', lang('CODE'), 'required|trim|callback_check_unique_code');
		$this->form_validation->set_rules('room_name', lang('NAME'), 'required|trim|callback_check_unique_name');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		
		$data['title'] = lang('ROOMS_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->rooms_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->rooms_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->rooms_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('rooms/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();

		$data['title'] = lang('ROOMS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->rooms_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		$data['content'] = $this->load->view('rooms/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}

	
	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('code', lang('CODE'), 'trim');
		$this->form_validation->set_rules('room_name', lang('NAME'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('code')) $search_rule['_rooms.code'] = $this->input->post('code');
			if($this->input->post('room_name')) $search_rule['_rooms.room_name'] = $this->input->post('room_name');			
			$this->set_searchrule($search_rule);
		}
		$data['search'] = $this->get_session('searchrule');
		return $this->load->view('rooms/find', $data, True);
	}
	
	public function check_unique_code($code){
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->rooms_model->check_unique($code, 'code', $rid)){
			$this->form_validation->set_message('check_unique_code', lang('ROOMS_CODE_NOTUNIQUE'));
			return False;
		}
		return True;
	}
	
	public function check_unique_name($code){
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->rooms_model->check_unique($code, 'name', $rid)){
			$this->form_validation->set_message('check_unique_name', lang('ROOMS_NAME_NOTUNIQUE'));
			return False;
		}
		return True;
	}
	
	
	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('ROOMS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->rooms_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->rooms_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->rooms_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('rooms/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
}

?>