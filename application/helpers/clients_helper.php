<?php
function get_sex_list(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'), 'M'=>lang('MALE'), 'F'=>lang('FEMALE'));
	return $res;
}

function get_clientname_byrid($rid, $full = False){
	$ci = &get_instance();
	$ci->load->model('clients_model');
	return $ci->clients_model->get_clientname_byrid($rid);
}

function get_client_info($rid){
	$ci = &get_instance();
	$ci->load->model('clients_model');
	return $ci->clients_model->get_edit($rid);
}

function get_client_history($rid){
	$ci = &get_instance();
	$ci->load->model('clients_model');
	$data = array();
	$data['ds_tours'] = $ci->clients_model->get_tours_history($rid);
	$data['ds_airs'] = $ci->clients_model->get_airs_history($rid);
	return $ci->load->view('clients/history', $data, True);	
}

function get_client_interests($rid){
	$interests = array();
	$ci = &get_instance();
	$ci->load->model('clients_model');
	$interests_list = $ci->clients_model->get_interests($rid);
	foreach($interests_list as $interest) $interests[$interest->_interests_rid] = $interest->mark;
	return $interests; 	
}

/**
 * Построить диаграмму предпочтений клиента
 * 
 * @param $rid rid клиента
 */
function get_interests_chart($rid){
	$ci = &get_instance();
	$ci->load->plugin('ofc2');
	
}
/**
 * Получить value_picker для Clients
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_clients_vp($default_value = null, $val_p = '_clients_rid', $scr_p = 'client_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('clients/value_picker', $data, True); 
}
?>