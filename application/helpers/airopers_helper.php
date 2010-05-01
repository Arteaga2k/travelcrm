<?php
function get_doc_balance($rid){
	$ci = &get_instance();
	$ci->load->model('finjournal_model');
	$ci->lang->load('finjournal');
	$data['in'] = $ci->finjournal_model->get_doc_in($rid);
	$data['out'] = $ci->finjournal_model->get_doc_out($rid);
	return $ci->load->view('finjournal/balance', $data, True);
}

?>