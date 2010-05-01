<?php
function get_contrahentname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('contrahens_model');
	return $ci->contrahens_model->get_contrahent_byrid($rid);
}

/**
 * Получить value_picker для Contrahens
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_contrahens_vp($default_value = null, $val_p = '_contrahens_rid', $scr_p = 'contrahens_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('contrahens/value_picker', $data, True); 
}

?>