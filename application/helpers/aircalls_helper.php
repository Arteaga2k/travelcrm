<?php
/**
 * Получить value_picker для Aircalls
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_aircalls_vp($default_value = null, $val_p = '_aircalls_documents_rid', $scr_p = 'aircall_rid', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('aircalls/value_picker', $data, True); 
}
?>