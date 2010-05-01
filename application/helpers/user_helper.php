<?php
/* Полное имя пользователя */
function get_curr_uname(){
	$ci = &get_instance();
	return $ci->user->get_ufn();
}

/* Название должности текущего пользователя */
function get_curr_pname(){
	$ci = &get_instance();
	return $ci->user->get_upn();
}

/* Название филиала текущего пользователя */
function get_curr_filname(){
	$ci = &get_instance();
	return $ci->user->get_ufiln();
}

/* Rid текущего пользователя */
function get_curr_urid(){
	$ci = &get_instance();
	return $ci->user->get_urid();
}

/* Rid должности текущего пользователя */
function get_curr_uprid(){
	$ci = &get_instance();
	return $ci->user->get_uprid();
}

/* Rid филиала текущего пользователя */
function get_curr_ufrid(){
	$ci = &get_instance();
	return $ci->user->get_ufrid();
}

?>