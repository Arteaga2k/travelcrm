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
class Tasks extends Crmcontroller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load('tasks');
		$this->load->model('tasks_model');
	}
	
	public function _remap($m_Name){
		switch ($m_Name) {
			case 'create': {$this->output->set_output($this->create());break;}
			case 'close': {$this->output->set_output($this->close());break;}
			case 'remove': {$this->output->set_output($this->remove());break;}
			case 'refresh': {$this->output->set_output($this->refresh());break;}
			case 'list': {$this->output->set_output($this->getlist());break;}
		}
	}
	
	private function create(){
		$data = array();
		$this->set_validation();
		if ($this->form_validation->run() === True){
			$this->tasks_model->create_record();
		}
		return get_tasks();
	}

	protected function close(){
		if($rid = $this->input->post('rid')){
			$this->tasks_model->close_task();	
		}
		return get_tasks();
	}

	protected function remove(){
		if($rid = $this->input->post('rid')){
			$this->tasks_model->remove_items();	
		}
		return get_tasks();
	}
	
	private function set_validation(){
		$this->form_validation->set_rules('edate_tasks', lang('DATE_TASK'), 'required|trim');
		$this->form_validation->set_rules('descr_tasks', lang('DESCR_TASK'), 'trim|required|max_length[512]');
		return;
	}
	
	protected function refresh(){
		if($filter = $this->input->post('to_show_tasks')){
			$this->session->set_userdata('to_show_tasks', $filter);	
			if($objtype = $this->input->post('objtype')) $this->session->set_userdata('objtype_tasks', $objtype);
			else $this->session->unset_userdata('objtype_tasks');
			if($objrid = $this->input->post('objrid')) $this->session->set_userdata('objrid_tasks', $objrid); 
			else $this->session->unset_userdata('objrid_tasks');
			$this->session->set_userdata('tasks_page', 0);
		}
		return get_tasks();
	}

	protected function getlist(){
		$this->session->set_userdata('tasks_page', element('p', $this->a_uri_assoc, null));	
		return get_tasks();
	}

}

?>