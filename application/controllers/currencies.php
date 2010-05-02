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
class Currencies extends Crmcontroller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load('currencies');
		$this->load->model('currencies_model');
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
		$data['title'] = lang('CURRENCIES_TITLE');
		
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['code'] =  array('label'=>lang('CODE'), 'colwidth'=>'10%', 'sort'=>True);
		$data['fields']['currency_name'] =  array('label'=>lang('NAME'), 'colwidth'=>'25%', 'sort'=>True);
		$data['fields']['left_word'] =  array('label'=>lang('LEFT_WORD'), 'colwidth'=>'20%', 'sort'=>True);
		$data['fields']['right_word'] =  array('label'=>lang('RIGHT_WORD'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->currencies_model->get_ds();
		$data['paging'] = $this->get_paging($this->currencies_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	
	private function create(){
		$data = array();

		$this->form_validation->set_rules('code', lang('CODE'), 'required|trim|callback_check_unique_code');
		$this->form_validation->set_rules('currency_name', lang('NAME'), 'required|trim|callback_check_unique_name');
		$this->form_validation->set_rules('left_word', lang('LEFT_WORD'), 'trim');
		$this->form_validation->set_rules('right_word', lang('RIGHT_WORD'), 'required|trim');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');

		$data['title'] = lang('CURRENCIES_TITLE_CREATE');
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->currencies_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('currencies/create', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();

		$this->form_validation->set_rules('code', lang('CODE'), 'required|trim|callback_check_unique_code');
		$this->form_validation->set_rules('currency_name', lang('NAME'), 'required|trim|callback_check_unique_name');
		$this->form_validation->set_rules('left_word', lang('LEFT_WORD'), 'trim');
		$this->form_validation->set_rules('right_word', lang('RIGHT_WORD'), 'required|trim');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		
		$data['title'] = lang('CURRENCIES_TITLE_EDIT');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->currencies_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->currencies_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->currencies_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('currencies/edit', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();

		$data['title'] = lang('CURRENCIES_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->currencies_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		$data['content'] = $this->load->view('currencies/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}

	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('code', lang('CODE'), 'trim');
		$this->form_validation->set_rules('currency_name', lang('NAME'), 'trim');
		$this->form_validation->set_rules('left_word', lang('LEFT_WORD'), 'trim');
		$this->form_validation->set_rules('right_word', lang('RIGHT_WORD'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('code')) $search_rule['_currencies.code'] = $this->input->post('code');
			if($this->input->post('currency_name')) $search_rule['_currencies.currency_name'] = $this->input->post('currency_name');
			if($this->input->post('left_word')) $search_rule['_currencies.left_word'] = $this->input->post('left_word');
			if($this->input->post('right_word')) $search_rule['_currencies.right_word'] = $this->input->post('right_word');			
			$this->set_searchrule($search_rule);
		}
		$data['search'] = $this->get_session('searchrule');
		return $this->load->view('currencies/find', $data, True);
	}
	
	public function check_unique_code($code){
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->currencies_model->check_unique($code, 'code', $rid)){
			$this->form_validation->set_message('check_unique_code', lang('CURRENCIES_CODE_NOTUNIQUE'));
			return False;
		}
		return True;
	}
	
	public function check_unique_name($code){
		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании
		if($this->currencies_model->check_unique($code, 'name', $rid)){
			$this->form_validation->set_message('check_unique_name', lang('CURRENCIES_NAME_NOTUNIQUE'));
			return False;
		}
		return True;
	}
	

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('CURRENCIES_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->currencies_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->currencies_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->currencies_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	
}

?>