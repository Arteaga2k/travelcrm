<?php
/**
 * Help for field
 * as default all helps for fields has name fith suffix '_FIELD_HELP' and it placed in module lang file
 */
function get_field_help($module, $field_name){
	$ci = &get_instance();
	$ci->lang->load($module);
	$data = array('help_conent'=>(lang($field_name.'_FIELD_HELP')?lang($field_name.'_FIELD_HELP'):lang('NO_HELP')));
	return $ci->load->view('common/field_help', $data, true);
}

?>