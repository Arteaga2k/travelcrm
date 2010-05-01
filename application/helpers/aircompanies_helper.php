<?php
function get_aircompanyname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('aircompanies_model');
	return $ci->aircompanies_model->get_aircompanyname_byrid($rid);
}

/**
 * Получить value_picker для Aircompanies
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_aircompanies_vp($default_value = null, $val_p = '_aircompanies_rid', $scr_p = 'aircompany_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('aircompanies/value_picker', $data, True); 
}
?>