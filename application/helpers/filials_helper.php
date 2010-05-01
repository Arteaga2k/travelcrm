<?php
function get_filial_name_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('filials_model');
	return $ci->filials_model->get_name_byrid($rid);
}

function get_filial_info($rid){
	$ci = &get_instance();
	$ci->load->model('filials_model');
	return $ci->filials_model->get_edit($rid);
}

/**
 * Получить value_picker для Filials
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_filials_vp($default_value = null, $val_p = '_filials_rid', $scr_p = 'filial_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('filials/value_picker', $data, True); 
}

?>