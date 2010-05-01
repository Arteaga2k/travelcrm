<?php
/* Рендеринг меню пользователя */
function get_menu(){
	$ci = &get_instance();
	return $ci->menu->render_menu();
}

/* Контроллер текущего пункта меню */
function get_currcontroller(){
	$ci = &get_instance();
	return $ci->menu->get_currcontroller();
}

?>