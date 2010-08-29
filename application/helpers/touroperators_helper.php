<?php
function get_tocats(){
	$ci = &get_instance();
	return array(
				''=>$ci->config->item('crm_dropdown_empty'),	
				lang('CAT_1')=>lang('CAT_1'), 
				lang('CAT_2')=>lang('CAT_2'), 
				lang('CAT_3')=>lang('CAT_3'), 
				lang('CAT_4')=>lang('CAT_4'));
}

function get_touroperatorname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('touroperators_model');
	return $ci->touroperators_model->get_touroperatorname_byrid($rid);
}

function get_touroperator_info($rid){
	$ci = &get_instance();
	$ci->load->model('touroperators_model');
	return $ci->touroperators_model->get_edit($rid, false);
}

/**
 * Получить value_picker для Employeers
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_touroperators_vp($default_value = null, $val_p = '_touroperators_rid', $scr_p = 'touroperator_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('touroperators/value_picker', $data, True); 
}

?>