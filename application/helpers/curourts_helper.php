<?php
function get_curourtname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('curourts_model');
	return $ci->curourts_model->get_curourtname_byrid($rid);
}

/**
 * Получить value_picker для Curourts
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_curourts_vp($default_value = null, $val_p = '_curourts_rid', $scr_p = 'curourt_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('curourts/value_picker', $data, True); 
}
?>