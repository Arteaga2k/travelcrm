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
class Finjournal extends Crmcontroller {

	public function __construct(){
		parent::__construct();
		$this->lang->load('finjournal');
		$this->load->model('finjournal_model');
		$this->load->helper('accountstates');
		$this->load->helper('finjournal');
		
		$this->load->helper('clients');
		$this->load->helper('filials');
		$this->load->helper('touroperators');
		$this->load->helper('employeers');
		$this->load->helper('finjournal');
		$this->load->helper('contrahens');
	}

	public function _remap($m_Name){
		switch ($m_Name) {
			case 'journal': {$this->journal();break;}
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'remove': {$this->remove();break;}
			case 'move': {$this->move();break;}
			case 'sort': {$this->sort();break;}
			case 'gccontr': {$this->output->set_output($this->gccontr());break;}
			case 'gdcontr': {$this->output->set_output($this->gdcontr());break;}
			case 'settings': {$this->settings(); break;}
			case 'limit': {$this->limit();break;}
			case 'help': {$this->help(); break;}
			default: show_404();
		}
	}

	
	public function journal(){
		# показываем только информацию относящуюся к конкретному документу
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = sprintf(lang('FINJOURNAL_TITLE'), $rid);
		$data['orid'] = $this->get_orid();
		$data['sort'] = $this->get_session('sort');
		$data['find'] = '';
		$data['doc_rid'] = $rid;
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 
		$data['fields']['sum_value'] =  array('label'=>lang('SUM'), 'colwidth'=>'15%', 'sort'=>True);
		$data['fields']['currency_name'] =  array('label'=>lang('CURENCY'), 'colwidth'=>'20%', 'sort'=>True);
		$data['fields']['oper_date'] =  array('label'=>lang('DATE'), 'colwidth'=>'20%', 'sort'=>True);
		$data['fields']['state_name'] =  array('label'=>lang('STATE'), 'colwidth'=>'30%', 'sort'=>True); 
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'10%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['tools'] = $this->get_tools(); 
		if(!$this->finjournal_model->check_document($rid)) show_404();
		$data['ds'] = $this->finjournal_model->get_ds($rid); 
		$data['balance'] = $this->get_balance($rid);
		$data['paging'] = $this->get_paging($this->finjournal_model->get_calc_rows(), True);
		$content = $this->load->view('finjournal/grid', $data, True);
		$this->load->view('layouts/valuepicker_layout', array('content'=>$content));		
		return;
	}

	private function create(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		if(!$this->finjournal_model->check_document($rid)) show_404();
		$data = array();
		$this->set_validation();
		$data['title'] = sprintf(lang('FINJOURNAL_TITLE_CREATE'), $rid);
		$data['doc_rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['success'] = null;
		if ($this->form_validation->run() === True){
			if($rid = $this->finjournal_model->create_record()){
				$this->session->set_flashdata('success', True);
				redirect(get_currcontroller()."/edit/$rid", 'refresh');
				return;
			}
			else {
				$data['success'] = false;
			} 
		}
		$data['content'] = $this->load->view('finjournal/create', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}
	
	private function edit(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->set_validation();
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->finjournal_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		$data['title'] = sprintf(lang('FINJOURNAL_TITLE_EDIT'), $data['ds']->_documents_rid);
		if ($this->form_validation->run() === True){
			if($this->finjournal_model->update_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->finjournal_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('finjournal/edit', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}

	

	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->finjournal_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		$data['title'] = sprintf(lang('FINJOURNAL_TITLE_DETAILS'), $data['ds']->_documents_rid);
		$data['content'] = $this->load->view('finjournal/details', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}



	protected function remove(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$this->finjournal_model->remove_items();
		redirect(get_currcontroller()."/journal/{$rid}", 'refresh');
	}

	

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->finjournal_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404();
		$data['title'] = sprintf(lang('FINJOURNAL_TITLE_MOVE'), $data['ds']->_documents_rid); 
		if ($this->form_validation->run() === True){
			if($this->finjournal_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
			$data['ds'] = $this->finjournal_model->get_edit($rid);
		}
		$data['content'] = $this->load->view('finjournal/move', $data, True);
		return $this->load->view('layouts/valuepicker_layout', $data);
	}
	
	protected function sort(){
		if(!$rid = element('doc_rid', $this->a_uri_assoc, null)) show_404();
		if(!$this->finjournal_model->check_document($rid)) show_404();
		$field = element('sort', $this->a_uri_assoc, null);
		if($field){
			$sort = array('c'=>$field, 'r'=>'ASC');
			if($oldSort = $this->get_session('sort')){
				if($oldSort['c']==$field) {
					$sort['r'] = ($oldSort['r']=='ASC')?'DESC':'ASC';
				}
			}
			$this->set_session('sort', $sort);
		}
		redirect(get_currcontroller()."/journal/{$rid}", 'refresh');
		return;
	}
	
	private function set_validation(){
		$this->form_validation->set_rules('_documents_rid', lang('DOC_NOT_FOUND'), 'trim|callback_check_doclink');
		$this->form_validation->set_rules('_currencies_rid', lang('CURENCY'), 'required|trim');
		$this->form_validation->set_rules('_account_states_rid', lang('STATE'), 'required|trim');
		$this->form_validation->set_rules('c_type_credit', lang('CREDIT'), 'required|trim');
		$this->form_validation->set_rules('c_type_debet', lang('DEBET'), 'required|trim');
		$this->form_validation->set_rules('creditor_rid', lang('CREDIT'), 'required|trim');
		$this->form_validation->set_rules('debetor_rid', lang('DEBET'), 'required|trim');
		$this->form_validation->set_rules('oper_date', lang('DATE'), 'required|trim');
		$this->form_validation->set_rules('sum_value', lang('SUM'), 'required|trim|floatval');
		$this->form_validation->set_rules('payment_type', lang('PAYMENT_TYPE'), 'required|trim');
		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		return;		
	}
	
	public function check_doclink($rid){
		if(!$rid){
			$this->form_validation->set_message('check_doclink', lang('DOCLINK_NOT_FOUND'));
			return False;
		}
		return True;
	}
	
	private function get_balance($doc_rid){
		$data = array();
		$data['in'] = $this->finjournal_model->get_doc_in($doc_rid);
		$data['out'] = $this->finjournal_model->get_doc_out($doc_rid);
		return $this->load->view('finjournal/balance', $data, True);
	}
	
	/**
	 * Получить value_picker для дебетового контрагента
	 * @return unknown_type
	 */
	private function gdcontr(){
		$data = array();
		return gdcontr($this->input->post('c_type_debet'), $value = null); 
	}
	
	/**
	 * Получить value_picker для кредетового контрагента
	 * @return unknown_type
	 */
	private function gccontr(){
		$data = array();
		return gccontr($this->input->post('c_type_credit'), $value = null); 
	}
	
}

