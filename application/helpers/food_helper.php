<?php
function get_food(){
	$ci = &get_instance();
	$ci->load->model('food_model');
	return $ci->food_model->get_list();
}

function get_food_list(){
	$ci = &get_instance();
	$ci->load->model('food_model');
	$list = $ci->food_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->food_name;
	return $res;
}
?>