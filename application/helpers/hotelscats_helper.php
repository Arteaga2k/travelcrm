<?php
function get_hotelscats(){
	$ci = &get_instance();
	$ci->load->model('hotelscats_model');
	return $ci->hotelscats_model->get_all();
}

function get_hotelscats_list(){
	$ci = &get_instance();
	$ci->load->model('hotelscats_model');
	$list = $ci->hotelscats_model->get_all();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->hotelcat_name;
	return $res;
	
}

?>