<?php
function get_advcompaniestypes_list(){
	$ci = &get_instance();
	$ci->lang->load('advertisescompanies');
	$res = array(''=>$ci->config->item('crm_dropdown_empty'),
					lang('TYPE_TRAVEL_VAL')=>lang('TYPE_TRAVEL'), 
					lang('TYPE_AVIA_VAL')=>lang('TYPE_AVIA'));
	return $res;
}

function get_companyname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('advertisescompanies_model');
	return $ci->advertisescompanies_model->get_companyname_byrid($rid);
}

/**
 * Получить value_picker для Advertisescompanies
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_advertisescompanies_vp($default_value = null, $val_p = '_advertisescompanies_rid', $scr_p = 'company_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('advertisescompanies/value_picker', $data, True); 
}

?>