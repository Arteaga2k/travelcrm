<?php
function get_dcartnum_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('dcarts_model');
	return $ci->dcarts_model->get_dcartnum_byrid($rid);
}
/**
 * Получить value_picker для Dcarts
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_dcarts_vp($default_value = null, $val_p = '_dcarts_rid', $scr_p = 'num', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('dcarts/value_picker', $data, True); 
}
?>