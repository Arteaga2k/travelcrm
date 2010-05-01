<?php
function get_positions_list(){
	$ci = &get_instance();
	$ci->load->model('positions_model');
	$list = $ci->positions_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->name;
	return $res;
}

function get_areas(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'),
				'ALL'=>lang('A_A'),'FILIAL'=>lang('A_F'),'OWN'=>lang('A_O'));
	return $res;
}

?>