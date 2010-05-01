<?php



	private function create(){

	private function edit(){
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('CALLS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->calls_model->get_edit($rid);
		$data['content'] = $this->load->view('calls/details', $data, True);
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
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('rid')) $search_rule['where']['_documents.rid'] = $this->input->post('rid');
			if($this->input->post('doc_from')) $search_rule['where']['_calls_headers.date_doc >='] = date('Y-m-d', strtotime($this->input->post('doc_from')));
			if($this->input->post('doc_to')) $search_rule['where']['_calls_headers.date_doc <='] = date('Y-m-d', strtotime($this->input->post('doc_to')));
			if($this->input->post('_filials_rid')) $search_rule['having']['_filials_rid'] = $this->input->post('_filials_rid');
			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');
			if($this->input->post('_countries_rid')) $search_rule['where']['_countries.rid'] = $this->input->post('_countries_rid');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('calls/find', $data, True);
	}

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('CALLS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->calls_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->calls_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	
	private function set_validation(){

?>