<?php
function get_cities_list(){
	$ci = &get_instance();
	$ci->load->model('cities_model');
	$list = $ci->cities_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->city_name;
	return $res;
}

function get_city_name_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('cities_model');
	return $ci->cities_model->get_name_byrid($rid);
}


/**
 * Получить value_picker для Cities
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_cities_vp($default_value = null, $val_p = '_cities_rid', $scr_p = 'city_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('cities/value_picker', $data, True); 
}
?>