<?php
function get_sourcename_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('advertisessources_model');
	return $ci->advertisessources_model->get_sourcename_byrid($rid);
}

/**
 * Получить value_picker для Advertisessources
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_advertisessources_vp($default_value = null, $val_p = '_advertisessources_rid', $scr_p = 'source_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('advertisessources/value_picker', $data, True); 
}

?>