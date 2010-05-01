<?php
/**
 * User - пользователь системы
 * 
 * @author Mazvv
 * @package Extenders
 */
class User {
	private $a_urid; 	/*user rid*/
	private $a_uprid; 	/*user position rid*/
	private $a_uerid; 	/*user employeer rid*/
	private $a_ufn;		/*user full name*/
	private $a_upn;		/*user position name*/
	private $a_ufr;		/*user filial rid*/
	private $a_uem;		/*user employeers mail*/
	private $ciObject;	/*ci*/
	
	/**
	 * 
	 * @author Mazvv
	 * @param void
	 */
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->load->model('user_model');
	}
	
	public function is_logged(){
		$controller = $this->ciObject->uri->segment(1, 'login');
		if(!$this->ciObject->session->userdata('URID') && $controller !== 'login'){
			redirect('login', 'refresh');
			return False;
		}
		return True;
	}
	
	public function init_user(){
		$this->a_urid = $this->ciObject->session->userdata('URID');
		$this->a_uerid 	= $this->ciObject->user_model->get_uerid($this->a_urid);
		$this->a_uprid 	= $this->ciObject->user_model->get_uprid($this->a_urid);
		$this->a_ufrid 	= $this->ciObject->user_model->get_ufrid($this->a_urid);
		$this->a_ufn 	= $this->ciObject->user_model->get_fn($this->a_urid);
		$this->a_upn 	= $this->ciObject->user_model->get_pn($this->a_urid);
		$this->a_uem 	= $this->ciObject->user_model->get_uem($this->a_urid);
		return True;
	}
	
	public function get_ufn(){
		return $this->a_ufn;
	}

	public function get_upn(){
		return $this->a_upn;
	}
	
	public function get_ufrid(){
		return $this->a_ufrid;
	}

	public function get_ufiln(){
		return $this->ciObject->user_model->get_ufiln($this->a_urid);
	}

	public function get_urid() {
		return $this->a_urid;
	}
	
	public function get_uerid(){
		return $this->a_uerid;	
	}
	
	public function get_uprid(){
		return $this->a_uprid;
	}
	
	public function get_uem(){
		return $this->a_uem;
	}
	

}
?>