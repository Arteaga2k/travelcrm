<?php
function get_rooms_list(){
	$ci = &get_instance();
	$ci->load->model('rooms_model');
	$list = $ci->rooms_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->room_name;
	return $res;
}
?>