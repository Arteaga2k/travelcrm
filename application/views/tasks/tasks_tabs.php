	<div class="column span-3">
		<b><?=lang('DATE_TASK')?></b>
	</div>
	<div class="column span-3">
		<b><?=lang('PRIORITY')?></b>
	</div>
	<div class="column span-16">
		<b><?=lang('DESCR_TASK')?></b>
	</div>
	<div class="column span-2 last">
		<b><?=lang('ACTIONS')?></b>
	</div><br>
	<hr style="background-color: blue;">
	
	<? if(count($hot)) { ?>
	<strong><?=lang('HOT_TASKS')?></strong>
		
	<div id="hot_tasks">
		<? foreach($hot as $t) { ?>
		<? $bkg = get_task_bkg($t->edate)?>
		<div class="column span-3" style="background-color: <?=$bkg?>">
			<?=$t->edate?>
		</div>
		<div class="column span-3" style="background-color: <?=$bkg?>">
			<?=element($t->priority, array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')))?>
		</div>
		<div class="column span-16" style="background-color: <?=$bkg?>">
			<?=$t->descr?>
		</div>
		<div class="column span-2 last" style="padding-left: 5px;">
			<a href="javascript: void(0);" title="<?=lang('CLOSE_TASK')?>" onclick="if(confirm('<?=lang('CONFIRM_CLOSE_TASK')?>')) task_close(<?=$t->rid?>);"><?=img('public/img/icons/close_inline.gif')?></a>
			<a href="javascript: void(0);" title="<?=lang('EDIT')?>" onclick="task_edit(<?=$t->rid?>);"><?=img('public/img/icons/edit_inline.gif')?></a>
			<a href="javascript: void(0);" title="<?=lang('REMOVE')?>" onclick="if(confirm('<?=lang('CONFIRM_DELETE_TASK')?>')) task_remove(<?=$t->rid?>);"><?=img('public/img/icons/delete_inline.gif')?></a>
		</div>
		<? } ?>
	</div>
	<? } ?>
	
	<? if(count($done)) { ?>
	<strong><?=lang('COMPLETE_TASKS')?></strong>
	
	<div id="done_tasks">
		<? foreach($done as $t) { ?>
		<div class="column span-3">
			<?=$t->edate?>
		</div>
		<div class="column span-3">
			<?=element($t->priority, array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')))?>
		</div>
		<div class="column span-16">
			<?=$t->descr?>
		</div>
		<div class="column span-2 last"  style="padding-left: 5px;">
			<a href="javascript: void(0);" title="<?=lang('OPEN_TASK')?>" onclick="if(confirm('<?=lang('CONFIRM_OPEN_TASK')?>')) task_close(<?=$t->rid?>);"><?=img('public/img/icons/accept_inline.gif')?></a>
		</div>
		<? } ?>
	</div>
	<? } ?>
	<br><br>
	<div class="column span-24 last">
		<input type="button" class="button" id="add_task_btn" name="add_task_btn" onclick="return task_add();" value="<?=lang('NEW_TASK')?>">
	</div>
