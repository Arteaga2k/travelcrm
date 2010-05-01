<?php
function get_doc_balance($rid){
	$ci = &get_instance();
	$ci->load->model('finjournal_model');
	$ci->lang->load('finjournal');
	$data['in'] = $ci->finjournal_model->get_doc_in($rid);
	$data['out'] = $ci->finjournal_model->get_doc_out($rid);
	return $ci->load->view('finjournal/balance', $data, True);
}

function get_ctypes_list(){
	$ci = &get_instance();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'), 
				'CLIENT'=>lang('C_CLIENTS'), 
				'FILIAL'=>lang('C_FILIALS'),
				'TOUROPERATOR'=>lang('C_TOUROPERATORS'),
				'EMPLOYEER'=>lang('C_EMPLOYEERS'),
				'CONTRAHENT'=>lang('C_CONTRAHENS'));
	return $res;
}

function gdcontr($contr_type, $value = null){
	$ci = &get_instance();
	$data = array();
	$data['contr_type'] = $contr_type;
	$data['value'] = $value;
	return $ci->load->view('finjournal/debet_contr_pickers', $data, True);
}

function gccontr($contr_type, $value = null){
	$ci = &get_instance();
	$data = array();
	$data['contr_type'] = $contr_type;
	$data['value'] = $value;
	return $ci->load->view('finjournal/credit_contr_pickers', $data, True);
}

?>