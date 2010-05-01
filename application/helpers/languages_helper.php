<?php
/* Language helper */
function get_lang_panel(){
	$ci = &get_instance();
	$data = array();
	return $ci->load->view('common/languages_panel', $data, True);
}

?>