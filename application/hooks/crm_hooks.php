<?php
/**
 * Вкл/выкл отладчик
 * @return unknown_type
 */
function hook_profile_on(){
	$ci = &get_instance();
	return $ci->config->item('crm_profile_on')?$ci->output->enable_profiler(TRUE):$ci->output->enable_profiler(FALSE);
}

/**
 * Проверка на вход
 * @return unknown_type
 */
function hook_is_logged(){
	$ci = &get_instance();
	return $ci->user->is_logged();
}

/**
 * Инициализация пользоватиеля
 * @return unknown_type
 */
function hook_init_user(){
	$ci = &get_instance();
	return $ci->user->init_user();
}

/**
 * Инициализация меню
 * @return unknown_type
 */
function hook_init_menu(){
	$ci = &get_instance();
	return $ci->menu->init_menu();
}

/**
 * Проверка доступа
 * @return unknown_type
 */
function hook_check_security(){
	$ci = &get_instance();
	// исключаем welcome, login, logout, tasks
	$free_controllers = array('', 'login', 'logout', 'welcome', 'tasks');
	if(in_array($ci->menu->get_currcontroller(), $free_controllers)) return;
	$permissions = $ci->menu->get_rights();
	if(!element('viewed_space', $permissions, null)) return show_error(lang('MENU_SECURITY_ERROR'));
	if(!element('add_allow', $permissions, null) && element('create', $ci->a_uri_assoc, null)) return show_error(lang('MENU_SECURITY_ERROR')); 	
	if(!element('edit_allow', $permissions, null) && element('edit', $ci->a_uri_assoc, null)) return show_error(lang('MENU_SECURITY_ERROR'));
	if(!element('details_allow', $permissions, null) && element('details', $ci->a_uri_assoc, null)) return show_error(lang('MENU_SECURITY_ERROR'));
	if(!element('delete_allow', $permissions, null) && element('delete', $ci->a_uri_assoc, null)) return show_error(lang('MENU_SECURITY_ERROR'));	 
	return;
}

/**
 * При необходимости - переконфигурация
 * @return unknown_type
 */
function hook_config_reinit(){
	$ci = &get_instance();
	#init limit configuration
	if($limit = $ci->get_session('limit')) $ci->config->set_item('crm_grid_limit', $limit);
	return;
}


