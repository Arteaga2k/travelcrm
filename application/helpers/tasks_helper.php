<?php
/* Tasks list */
function get_tasks(){
	$ci = &get_instance();
	$ci->load->library('pagination');
	$data['orid'] = $ci->get_orid();
	
	$data['tasks_action'] = $ci->input->post('tasks_action');
	$data['title'] = lang('TASKS_TITLE');
	$data['to_show_tasks'] = $ci->session->userdata('to_show_tasks');
	$data['tasks'] = $ci->tasks_model->get_ds();
	/* { Tasks pagination*/
	$ci->load->library('pagination');
	$config['base_url'] = site_url('/tasks/list/go/p/');
	$config['total_rows'] = $ci->tasks_model->get_calc_rows();
	$config['uri_segment'] = 5;
	$config['num_links'] = 3;
	$config['per_page'] = $ci->config->item('crm_tasks_per_page');
	$config['first_link'] = '&lt;&lt;';
	$config['last_link'] = '&gt;&gt;';
	$ci->pagination->initialize($config);
	$ci->pagination->cur_page = $ci->session->userdata('tasks_page');
	$data['pagination'] = $ci->pagination->create_links();
	/* } Tasks pagination*/
	return $ci->load->view('tasks/grid', $data, True);
}

function get_task_class($date){
	if(date('Y-m-d')>date('Y-m-d', strtotime($date))) return 'outdated';
	else if(date('Y-m-d')==date('Y-m-d', strtotime($date))) return 'tooday';
	else return '';
}

function get_tasks_js(){
	$ci = &get_instance();
	$data = array();
	$data['orid'] = $ci->get_orid();
	/* Hack for related tasks */
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		$data['objtype'] = $ci->get_objtype();
		# for objects in edit mode only!
		$data['objrid'] = element('edit', $ci->a_uri_assoc, null);
		
		/* clear session vars if current obj is not previus */
		if($ci->session->userdata('objtype_tasks')!==$data['objtype'] || $ci->session->userdata('objrid_tasks')!==$data['objrid']){
			$ci->session->unset_userdata('objtype_tasks');
			$ci->session->unset_userdata('objrid_tasks');
			if($ci->session->userdata('to_show_tasks')=='3') $ci->session->unset_userdata('to_show_tasks'); 
		}
	}
	return $ci->load->view('tasks/tasks_js', $data, True); 
}
?>