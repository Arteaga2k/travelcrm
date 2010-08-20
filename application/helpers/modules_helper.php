<?php
function get_controllers_list(){
	$ci = &get_instance();
	$ci->load->helper('directory');
	$map = directory_map(APPPATH.'/controllers/', False);
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($map as $c){
		$file_info = pathinfo(APPPATH.'/controllers/'.$c);
		if('.'.$file_info['extension']==EXT) $res[$file_info['filename']] = $file_info['filename'];
	}
	asort($res);
	return $res;
}

function get_module_permissions($module_rid){
	$ci = &get_instance();
	$ci->load->model('modules_model');
	return $ci->modules_model->get_module_permissions($module_rid);
}

function get_modules_list(){
	$ci = &get_instance();
	$ci->load->model('modules_model');
	$list = $ci->modules_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->module_name.($c->module_controller?('|'.$c->module_controller):'');
	return $res;
}

function get_modulename_byrid($rid, $full=False){
	$ci = &get_instance();
	$ci->load->model('modules_model');
	return $ci->modules_model->get_modulename_byrid($rid, $full);
}

function get_modulerid_bycontroller($controller_name){
	$ci = &get_instance();
	$ci->load->model('modules_model');
	return $ci->modules_model->get_modulerid_bycontroller($controller_name);
}

/**
 * Получить value_picker для Modules
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_modules_vp($default_value = null, $val_p = '_modules_rid', $scr_p = 'module_full_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('modules/value_picker', $data, True); 
}
?>