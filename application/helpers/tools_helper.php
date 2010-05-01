<?php
/* Инструменты грида 
 * $mode = 0 - режим грида, 1 - value picker
 * */
function get_tool($tool, $id, $mode = 0){
	$ci = &get_instance();
	switch($tool){
		case 'edit_allow':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vedit/'.$id, img('public/img/icons/edit_inline.gif'), 'title="'.lang('EDIT_TOOL').'"'):
					anchor(get_currcontroller().'/edit/'.$id, img('public/img/icons/edit_inline.gif'), 'title="'.lang('EDIT_TOOL').'"');
			break;
		}
		case 'details_allow':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vdetails/'.$id, img('public/img/icons/view_inline.gif'), 'title="'.lang('DETAILS_TOOL').'"'):
					anchor(get_currcontroller().'/details/'.$id, img('public/img/icons/view_inline.gif'), 'title="'.lang('DETAILS_TOOL').'"');
			break;
		}
		case 'move_allow':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vmove/'.$id, img('public/img/icons/move_inline.gif'), 'title="'.lang('MOVE_TOOL').'"'):
					anchor(get_currcontroller().'/move/'.$id, img('public/img/icons/move_inline.gif'), 'title="'.lang('MOVE_TOOL').'"');
			break;
		}
		
	}
	return null;
}
?>