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
/**
 * Авторизация пользователей 
 * 
 * @author Mazvv
 * @package LoginManagement
 */
include_once APPPATH."libraries/core/Crmcontroller.php";
class Login extends Crmcontroller {

	
	public function __construct(){
		parent::__construct();
		$this->lang->load('login');
		$this->load->model('user_model');
	}
	
	/**
	 * @param void
	 * @return void
	 */
	public function index(){
		$data = array();
		$data['page_title'] = lang('M1_LOGIN_AREA_TITLE');
		$this->form_validation->set_rules('i_login', lang('M1_LOGIN_LABEL'), 'required|callback_check_user|callback_check_edate');
		$this->form_validation->set_rules('i_password', lang('M1_PASSWORD_LABEL'), 'trim');
		if($this->form_validation->run() === False){
			$data['content']=$this->load->view('login/login_form.php', null, True);
			$this->load->view('layouts/login_layout', $data);		
			return;			
		}
		$this->login_processing($this->input->post('i_login'), $this->input->post('i_language'));
		return True;
	}
	
	/**
	 * Процесс авторизации
	 * 
	 * @author Mazvv
	 * @param void
	 * @return void
	 */
	private function login_processing($login, $language){
		$today = date('Y-m-d');
		$urid = $this->user_model->get_urid_by_login($login);
		$chdate = $this->user_model->get_chdate_by_urid($urid);
		$this->session->set_userdata('URID', $urid);
		$this->session->set_userdata('LANGUAGE', $language);
		if($chdate <= $today) {
			redirect('login/chpass', 'refresh');
		} else redirect('welcome', 'refresh');
	}
	
	/**
	 * Log OUT
	 *
	 */
	public function logout(){
		$this->session->unset_userdata('URID');
		redirect('login', 'refresh');
	}
	
	/**
	 * Проверка пользователя
	 * 
	 * @author Mazvv
	 * @param str
	 * @return boolean
	 */
	public function check_user($login){
		$row = $this->user_model->check_user($login, $this->input->post('i_password'));
		if($row){
			return True;
		}
		$this->form_validation->set_message('check_user', lang('M1_AUTH_ERROR_TITLE'));
		return False;
	}

	/**
	 * Проверка даты истечения пароля пользователя
	 * 
	 * @author Mazvv
	 * @param str
	 * @return boolean
	 */
	public function check_edate($login){
		$row = $this->user_model->check_edate($login);
		if($row){
			return True;
		}
		$this->form_validation->set_message('check_edate', lang('M1_END_PASSWORD_TIME'));
		return False;
	}
	

	/**
	 * Смена пароля
	 * 
	 * @author Mazvv
	 * @param void
	 * @return void
	 */
	public function chpass(){
		$data = array();
		$data['page_title'] = lang('LOGIN_CHPASS_TITLE');
		$this->form_validation->set_rules('i_password', lang('M1_PASSWORD_LABEL'), 'required|matches[i_cpassword]|trim|min_length[6]');
		$this->form_validation->set_rules('i_cpassword', lang('M1_PASSWORD_CONFIRM_LABEL'), 'required|');
		if($this->form_validation->run() === False){
			$data['content']=$this->load->view('login/chpass_form.php', null, True);
		} else {
			if($this->chpass_processing($this->input->post('i_password'))){
				$data['content']=$this->load->view('login/chpass_success.php', null, True);
			}
			else $data['content']=$this->load->view('login/chpass_error.php', null, True);
		}
		$this->load->view('layouts/login_layout', $data);
		return True;
	}
	
	private function chpass_processing($passwd){
		return $this->user_model->cp(get_curr_urid(), $passwd, $this->config->item('crm_chpass_period'));
	}

}
?>