<?php
function get_koef_list(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'),
					'1'=>lang('PLUS'), '-1'=>lang('MINUS'));
	return $res;
}

function get_states_list(){
	$ci = &get_instance();
	$ci->load->model('accountstates_model');
	$list = $ci->accountstates_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->state_name;
	return $res;
}

?>