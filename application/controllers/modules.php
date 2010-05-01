<?php
class Modules extends Crmcontroller {
		parent::__construct();
		$this->lang->load('modules');
		$this->load->model('modules_model');
	
	public function _remap($m_Name){
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'remove': {$this->remove();break;}
			case 'sort': {$this->sort();break;}
		}
	}
	
	public function journal(){
		$data = array();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'10%', 'sort'=>True); 
		$data['fields']['module_name'] =  array('label'=>lang('MODULE_NAME'), 'colwidth'=>'30%', 'sort'=>True); 
		$data['fields']['module_controller'] =  array('label'=>lang('MODULE_CONTROLLER'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'20%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->modules_model->get_ds();
		return $this->load->view('standart/grid', $data, True);		
	}
	
	
	private function create(){
	
	private function edit(){
	
	private function details(){

	
	private function find(){
	