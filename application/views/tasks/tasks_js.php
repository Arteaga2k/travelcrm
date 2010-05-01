<script type="text/javascript">

var objtype = <?=isset($objtype)?"'$objtype'":'false'?>; 
var objrid = <?=(isset($objrid) && $objrid)?"'$objrid'":'false'?>;


function remove_option(opval){
	$("#to_show_tasks option").each(function(){  
		if($(this).val()==opval) $(this).remove();  
	});
}

	
function get_query_string(){
	var query_string = $('#create_tasks').serialize();
	if(objtype!=false) query_string += '&objtype=' + objtype;
	if(objrid!=false) query_string += '&objrid=' + objrid;
	return query_string; 
}

function get_query_refresh_string(){
	var query_string = $('#filter_tasks').serialize();
	if(objtype!=false) query_string += '&objtype=' + objtype;
	if(objrid!=false) query_string += '&objrid=' + objrid;
	return query_string; 
}

function add_task(){
		$.ajax({
			type:'POST',
			data:get_query_string(),
			url:'<?=site_url("tasks/create/go")?>',
			success: function(html){
				$('#tasks').html(html);
				if(objrid==false){
					$('#cont-attach-to-obj').remove();
					remove_option('3');
				}
				vtip();
			}
		});
		return false;
}

function close_task(rid){
	$.ajax({
		type:'POST',
		data:{rid:rid},
		url:'<?=site_url("tasks/close/go")?>',
		success: function(html){
			$('#tasks').html(html);
			if(objrid==false){
				$('#cont-attach-to-obj').remove();
				remove_option('3');
			}
			vtip();
		}
	});
	return false;
}

function remove_task(rid){
	$.ajax({
		type:'POST',
		data:{rid:rid},
		url:'<?=site_url("tasks/remove/go")?>',
		success: function(html){
			$('#tasks').html(html);
			if(objrid==false){
				$('#cont-attach-to-obj').remove();
				remove_option('3');
			}
			vtip();
		}
	});
	return false;
}

function refresh_tasks(){
		$.ajax({
			type:'POST',
			data:get_query_refresh_string(),
			url:'<?=site_url("tasks/refresh/go")?>',
			success: function(html){
				$('#tasks').html(html);
				if(objrid==false){
					$('#cont-attach-to-obj').remove();
					remove_option('3');
				}
				vtip();
			}
		});
		return false;
}
</script>
