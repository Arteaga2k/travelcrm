<?php/** *  * @author Mazvv * @package Extenders */
class Menu{	private $ci;	private $a_menu_items = array();	private $a_currcontroller = null;	private $a_permissions = null;
	public function __construct() {		$this->ci = &get_instance();			$this->ci->load->model('menu_model');	}	
	public function init_menu(){		$assoc_arr = $this->ci->uri->uri_to_assoc(2);		$this->a_currcontroller = $this->ci->uri->segment(1);		$this->a_menu_items = $this->ci->menu_model->get_menu_items(get_curr_uprid());		$this->a_permissions = $this->ci->menu_model->get_permissions(get_curr_uprid(), $this->a_currcontroller);		return;	}		public function get_currcontroller(){		return $this->a_currcontroller;	}		public function render_menu(){		$data['items'] = transform2forest($this->a_menu_items, 'rid', 'parent');		return $this->ci->load->view('common/menu', $data, True);	}		public function get_rights(){		return $this->a_permissions;	}
	public function get_allowed_area(){		return element('viewed_space', $this->a_permissions, null);	}
}
?>