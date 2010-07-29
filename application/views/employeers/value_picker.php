<?=form_input($scr_p, get_emp_fullname_byrid(set_value($val_p, $default_value)), 'id="'.$scr_p.'" class="text part-4" readonly="readonly"')?>
<?=form_hidden($val_p, set_value($val_p, $default_value))?>
<span style="vertical-align:middle; margin-left: 3px;">
<?=anchor_popup('employeers/vjournal/go/val_p/'.$val_p.'/scr_p/'.$scr_p, img('public/img/icons/refresh.gif'), array('title'=>lang('SELECT_BTN'), 'id'=>"sbtn_{$val_p}",  'name'=>"sbtn_{$val_p}",  'width'=>'950', 'height'=>'600'))?>
<?if($show_details) { ?>
	<?=anchor_popup("employeers/vedit/'+$('input[name=\'{$val_p}\']').val()+'", img('public/img/icons/edit.gif'), array('title'=>lang('DETAILS_BTN'), 'id'=>"sbtn_{$val_p}_details",  'name'=>"sbtn_{$val_p}_details",  'width'=>'950', 'height'=>'600'))?>
<? } ?>
<?=anchor('', img('public/img/icons/close_dashboard.gif'), 'title="'.lang('CLEAR_BTN').'" id="cbtn_'.$val_p.'" name="cbtn_'.$val_p.'"')?>
</span>  
<script type="text/javascript">
$(document).ready(
		function(){
			$('#cbtn_<?=$val_p?>').click(function(){
				$("input[name='<?=$val_p?>']").val('');
				$('#<?=$scr_p?>').val('');
				return false;
			});
		}
)	
</script>
