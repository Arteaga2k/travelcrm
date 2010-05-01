<?php
/* Получить RID сотрудника по RID пользователя*/
function get_emprid_byurid($urid){
	$ci = &get_instance();
	$ci->load->model('users_model');
	return $ci->users_model->get_emprid_byurid($urid);
}

/* Получить RID пользователя по RID сотрудника */
function get_urid_byemprid($urid){
	$ci = &get_instance();
	$ci->load->model('users_model');
	return $ci->users_model->get_urid_byemprid($urid);
}

?>