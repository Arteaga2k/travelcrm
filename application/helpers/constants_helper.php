<?php
function get_constant($code){
	$ci = &get_instance();
	return element($code, $ci->a_constants, null);
}
?>