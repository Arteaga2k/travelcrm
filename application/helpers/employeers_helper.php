<?php
function get_emp_fullname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('employeers_model');
	return $ci->employeers_model->get_emp_fullname_byrid($rid);
}

/**
 * Получить value_picker для Employeers
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_employeers_vp($default_value = null, $val_p = '_employeers_rid', $scr_p = 'full_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('employeers/value_picker', $data, True); 
}
?>