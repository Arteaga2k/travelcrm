<?php
function get_advertisestypes_list(){
	$ci = &get_instance();
	$ci->load->model('advertisestypes_model');
	$list = $ci->advertisestypes_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->type_name;
	return $res;
}
?>