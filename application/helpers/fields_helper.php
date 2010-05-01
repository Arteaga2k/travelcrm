<?php

function get_valtype($val, $type, $mode='grid'){
	$ci = &get_instance();
	switch($type){
		case "yes_no":{
			return !$val?img('public/img/icons/decline_inline.gif'):img('public/img/icons/accept_inline.gif');
			break;
		}
		case "email":{
			return $val?safe_mailto($val):'';
			break;
		}
		case "url":{
			return $val?anchor(prep_url($val), lang('GO_LINK'), 'target="_blank"'):'';
			break;
		}
		default:{
			return $val; 
		}
	}
}


function get_currencies(){
	$ci = &get_instance();
	$ci->load->model('currencies_model');
	$currencies = $ci->currencies_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($currencies as $curr) $res[$curr->rid] = $curr->currency_name;
	return $res;
}

function date_conv($date, $time = False){
	if(!$date) return '';
	if($time) return date('H:i', strtotime($date));
	return date('d.m.Y', strtotime($date));
}

function get_airclasses(){
	$ci = &get_instance();
	return array(''=>$ci->config->item('crm_dropdown_empty'),
					'1'=>lang('AIRCLASS_1'),'2'=>lang('AIRCLASS_2'),'3'=>lang('AIRCLASS_3'));
}

function get_payment_types(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'),
					'1'=>lang('PAYMENT_TYPE_1'), '2'=>lang('PAYMENT_TYPE_2'), '3'=>lang('PAYMENT_TYPE_3'));
	return $res;
}

function get_airoper_types(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'),
					'1'=>lang('AIROPER_TYPE_1'), '2'=>lang('AIROPER_TYPE_2'), 
					'3'=>lang('AIROPER_TYPE_3'), '4'=>lang('AIROPER_TYPE_4'));
	return $res;
}

function get_airissues_types(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'), '1'=>lang('AIR_ISSUES_1'), '2'=>lang('AIR_ISSUES_2'));
	return $res;
}

function required_field(){
	return '&nbsp;<font color="red">*</font>';
	
}