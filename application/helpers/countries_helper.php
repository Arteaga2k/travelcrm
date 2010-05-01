<?php
function get_countries_list(){
	$ci = &get_instance();
	$ci->load->model('countries_model');
	$list = $ci->countries_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->country_name;
	return $res;
}

function get_countryname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('countries_model');
	return $ci->countries_model->get_countryname_byrid($rid);
}
?>