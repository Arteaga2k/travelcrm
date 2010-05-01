<?php/** * TravelCRM * * An open source CRM system for travel agencies * * @author		Mazvv (vitalii.mazur@gmail.com) * @license		GNU GPLv3 (http://gplv3.fsf.org)  * @link		http://www.travelcrm.org.ua */include_once APPPATH."libraries/core/Crmcontroller.php";class Welcome extends Crmcontroller {
	public function __construct(){		parent::__construct();		$this->lang->load('welcome');	}
		public function index(){		$data = array();		$data['title'] = lang('WELCOME_TITLEы');		$this->load->view('layouts/welcome_layout', $data);	}
}?>