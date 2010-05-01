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
class Users extends Crmcontroller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('users');
		$this->load->model('users_model');
		$this->load->helper('employeers');
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
		$data['title'] = lang('USERS_TITLE');
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['emp_name'] =  array('label'=>lang('EMPLOYEER'), 'colwidth'=>'25%', 'sort'=>True);
		$data['fields']['user_login'] =  array('label'=>lang('USER_LOGIN'), 'colwidth'=>'15%', 'sort'=>True); 
		$data['fields']['edate_passwd'] =  array('label'=>lang('END_PASSWD_DATE'), 'colwidth'=>'15%', 'sort'=>True); 
		$data['fields']['chdate_passwd'] =  array('label'=>lang('CHANGE_PASSWD_DATE'), 'colwidth'=>'15%', 'sort'=>True);  
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'15%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->users_model->get_ds();
		$data['paging'] = $this->get_paging($this->users_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	private function create(){
		$data = array();
		$this->set_validation();
		$data['title'] = lang('USERS_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->users_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('users/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = lang('USERS_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->users_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->users_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->users_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('users/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('USERS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->users_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		$data['content'] = $this->load->view('users/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	
	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'trim');
		$this->form_validation->set_rules('user_login', lang('USER_LOGIN'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');
			if($this->input->post('user_login')) $search_rule['like']['_users.user_login'] = $this->input->post('user_login');			
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('users/find', $data, True);
	}
	
	public function check_unique_login($code){
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->users_model->check_unique($code, $rid)){
			$this->form_validation->set_message('check_unique_login', lang('USERS_LOGIN_NOTUNIQUE'));
			return False;
		}
		return True;
	}
	
	private function set_validation(){
		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'required');
		$this->form_validation->set_rules('user_login', lang('USER_LOGIN'), 'required|min_length[5]|max_length[20]|alpha_numeric|callback_check_unique_login');
		$this->form_validation->set_rules('user_passwd', lang('USER_PASSWORD'), 'trim|required|min_length[5]');
		$this->form_validation->set_rules('edate_passwd', lang('END_PASSWD_DATE'), 'trim|required');
		$this->form_validation->set_rules('chdate_passwd', lang('CHANGE_PASSWD_DATE'), 'trim|required');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		return;
	}
	
	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('USERS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->users_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->users_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->users_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
}

?>