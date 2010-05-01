<?php
/* Чат */
function get_chat(){
	$ci = &get_instance();
	$ci->lang->load('chat');
	$ci->load->model('chat_model');
	$data = array();
	$data['title'] = lang('CHAT_TITLE');
	$data['messages'] = $ci->chat_model->get_ds();
	return $ci->load->view('chat/chat', $data, True);
}

?>