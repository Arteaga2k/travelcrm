<?php
function get_hotelname_byrid($rid){
	$ci = &get_instance();
	$ci->load->model('hotels_model');
	return $ci->hotels_model->get_hotelname_byrid($rid);
}

/**
 * Получить value_picker для Hotels
 * 
 * @param $default_value значение по умолчанию
 * @param $val_p name field для значения
 * @param $scr_p name field для екранного отображения
 * @return unknown_type
 */
function get_hotels_vp($default_value = null, $val_p = '_hotels_rid', $scr_p = 'hotel_full_name', $show_details = True){
	$ci = &get_instance();
	$data = array();
	$data['default_value'] = $default_value;
	$data['val_p'] = $val_p;
	$data['scr_p'] = $scr_p;
	$data['show_details'] = $show_details;
	return $ci->load->view('hotels/value_picker', $data, True); 
}
?>