	<h3><?=$title?></h3>

	<div class="taks-filter">
		<div class="column span-10">
			<strong><?=lang('TO_SHOW')?></strong>
		</div>
		<div class="column span-14 last tr">
			<?=form_open("tasks/refresh/go", array('id'=>'filter_tasks', 'autocomplete'=>'off'))?>
			<?=form_dropdown('to_show_tasks', array('All'=>lang('ALL'), '1'=>lang('TOODAY'), '2'=>lang('OUTDATED'), '3'=>lang('FOR_CURRENT_OBJ')), ((isset($to_show_tasks)&&$to_show_tasks)?$to_show_tasks:'1'), "id=to_show_tasks onchange='javascript: refresh_tasks();'")?>
			<?=form_close()?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="container legends">
		<span class="outdated marker"><?=lang('OUTDATED')?></span>
		<span class="tooday marker"><?=lang('TOODAY')?></span>
	</div>
	
	<div>
	<table style="width:100%;" cellspacing="0" cellpadding="0" id="tasks_table">
		<thead>
			<th width="15%" ><?=lang('DATE_TASK')?></th>
			<th><?=lang('DESCR_TASK')?></th>
			<th width="5%">&nbsp;</th>
			<th width="5%">&nbsp;</th>
		</thead>
		<tbody>

	<? if(count($tasks)) { ?>	
	
		<? foreach($tasks as $task) { ?>
		<tr class="<?=($task->done)?'task-done':get_task_class($task->edate)?>" id="task-<?=$task->rid?>">
			<td>
				<em><?=date('d.m', strtotime($task->edate))?></em>
			</td>
			<td>
				<?=$task->objrid?anchor(strtolower($task->objtype).'/edit/'.$task->objrid, character_limiter($task->descr, 32)):character_limiter($task->descr, 32)?><br>
				<b><?=lang('PRIORITY')?>:</b> <?=element($task->priority, array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')))?><br>
				<div id="task-descr-<?=$task->rid?>" class="task-descr">
					<b><?=lang('DESCR_TASK')?>:</b> <?=$task->descr?><br>
				</div>
			</td>
			<td>
				<a href="javascript: void(0);" title="<?=lang('EXPAND')?>" onclick="javascript: $('#task-descr-<?=$task->rid?>').show(); $('#expand-descr-<?=$task->rid?>').hide(); $('#colapse-descr-<?=$task->rid?>').show();" id="expand-descr-<?=$task->rid?>">
					<?=img('public/img/icons/plus_inline.gif', lang('EXPAND'))?>
				</a>
				<a href="javascript: void(0);" title="<?=lang('COLAPSE')?>" onclick="javascript: $('#task-descr-<?=$task->rid?>').hide(); $('#expand-descr-<?=$task->rid?>').show(); $('#colapse-descr-<?=$task->rid?>').hide();" style="display: none;" id="colapse-descr-<?=$task->rid?>">
					<?=img('public/img/icons/minus_inline.gif', lang('COLAPSE'))?>
				</a>
			</td>
			<td>
				<?if(!$task->done){?>
				<a href="javascript: if(confirm('<?=lang('CONFIRM_CLOSE_TASK')?>')) close_task(<?=$task->rid?>); void(0);" title="<?=lang('CLOSE_TASK')?>"><?=img('public/img/icons/close_inline.gif')?></a>
				<div style="clear:both;height:2px"></div>
				<a href="javascript: if(confirm('<?=lang('CONFIRM_DELETE_TASK')?>')) remove_task(<?=$task->rid?>); void(0);" title="<?=lang('DELETE_TASK')?>"><?=img('public/img/icons/delete_inline.gif')?></a>
				<?}?>
			</td>
		</tr>
		<? } ?>
	<? } else { ?>
	<tr>
		<td colspan="4" align="center"><em><?=lang('TASKS_EMPTY')?></em></td>
	</tr>
	<? } ?>
	
		</tbody>
	</table>
	</div>
	<div class="tasks-pagination" id="tasks-pagination">
		<?=$pagination?>
	</div>
	

<div id="new-task" >
	<h3><?=lang('NEW_TASK')?></h3>
	<?if(validation_errors() && isset($tasks_action) && $tasks_action){?>
	<div class="clear error">
		<?=validation_errors('<div>', '</div>');?>
	</div>	
	<?}?>
	
	<?=form_open("tasks/create/go", array('id'=>'create_tasks', 'autocomplete'=>'off'))?>
	<?=form_hidden('tasks_action', true)?>
	<div class="new-task">
		
		<div id="cont-attach-to-obj">
			<div class="column span-2">
				<?=form_checkbox('attach_to_obj', '1', false, 'id="attach_to_obj" class=""')?>
			</div>
			<div class="column span-22 last">
				<?=form_label(lang('ATTACH_TO_CURRENT_OBJ').get_field_help('tasks', 'ATTACH_TO_CURRENT_OBJ'), 'attach_to_obj')?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="column span-12 fl">		
			<?=form_label(lang('DATE_TASK').get_field_help('tasks', 'DATE_TASK').required_field(), 'edate')?><br>
			<?=form_input('edate_tasks', set_value('edate_tasks', ''), 'id="edate_task" class="text date-entry" readonly="readonly"')?>
			<script type="text/javascript">
				$('#edate_task').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
			</script>
		</div>
		<div class="column span-12 last fr">
			<?=form_label(lang('PRIORITY').get_field_help('tasks', 'PRIORITY'), 'priority_task')?><br>
			<?=form_dropdown('priority_tasks', array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')), set_value('priority', ''), 'id="priority_task" class="text"')?>
		</div>
	</div>
	<div class="column span-24 last">
			<?=form_label(lang('DESCR_TASK').get_field_help('tasks', 'DESCR_TASK').required_field(), 'descr')?><br>
			<div style="margin:0px;padding-right:4px;">
				<?=form_textarea('descr_tasks', set_value('descr_tasks', ''), 'id="descr_task" style="width: 100%;"')?>
			</div>
	</div>
		
	<div class="column span-24 last tools">
		<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit_tasks" name="submit" onclick="return add_task();">
	</div>
	
	<?=form_close()?>
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	if(objrid==false){
		$('#cont-attach-to-obj').remove();
		remove_option('3');
	} 	
	$('#tasks-pagination > a').click(function(){
		$.ajax({
			type:'GET',
			url:$(this).attr('href'),
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
	});
});
</script>
