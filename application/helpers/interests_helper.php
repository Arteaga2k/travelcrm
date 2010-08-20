<?php
function get_interests(){
	$ci = &get_instance();
	$ci->load->model('interests_model');
	return $ci->interests_model->get_list();
}

function get_interests_list(){
	$ci = &get_instance();
	$ci->load->model('interests_model');
	$list = $ci->interests_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->interests_name;
	return $res;
}

function get_interests_levels(){
	$ci = &get_instance();
	$ci->lang->load('interests');
	return array(0=>$ci->config->item('crm_dropdown_empty'), 1=>lang('VERY_LOW'), 2=>lang('LOW'), 3=>lang('MEDIUM'), 4=>lang('HIGH'), 5=>lang('VERY_HIGH'));
}

?>