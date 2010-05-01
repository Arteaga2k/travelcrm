<?php
	public function _remap($m_Name){

	private function create(){
		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');
		$data['title'] = lang('FILIALS_TITLE_CREATE');
	private function edit(){

	

	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('FILIALS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->filials_model->get_edit($rid);
		if(!$data['ds']) show_404(); 
		$data['content'] = $this->load->view('filials/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}



	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('code', lang('CODE'), 'trim');
		$this->form_validation->set_rules('name', lang('NAME'), 'trim');
		$this->form_validation->set_rules('_cities_rid', lang('CITY'), 'trim');
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('code')) $search_rule['like']['_filials.code'] = $this->input->post('code');
			if($this->input->post('name')) $search_rule['like']['_filials.city_name_lat'] = $this->input->post('city_name_lat');
			if($this->input->post('_cities_rid')) $search_rule['where']['_filials._cities_rid'] = $this->input->post('_cities_rid');
			$this->set_searchrule($search_rule);
		}
	}

	

	public function check_unique_code($code){

		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании

		if($this->filials_model->check_unique($code, 'code', $rid)){

			$this->form_validation->set_message('check_unique_code', lang('FILIALS_CODE_NOTUNIQUE'));

			return False;

		}

		return True;

	}

	
	public function check_unique_name($code){

		$rid = $this->input->post('rid'); # для случая если проверка идет при редактировании

		if($this->filials_model->check_unique($code, 'name_lat', $rid)){

			$this->form_validation->set_message('check_unique_name', lang('FILIALS_NAME_NOTUNIQUE'));

			return False;

		}

		return True;

	}





?>