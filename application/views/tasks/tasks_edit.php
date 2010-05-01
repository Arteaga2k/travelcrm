<h3><?=lang('EDIT_TASK')?></h3>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?=form_open(get_currcontroller()."/tasks/edit/rid/{$ds->rid}", array('id'=>'edit_'.$ds->rid, 'autocomplete'=>'off'))?>
<?=form_hidden('rid', $ds->rid)?>
<div class="column span-3">
<?=form_label(lang('DATE_TASK'), 'edate')?> <font color="red">*</font>
</div>
<div class="column span-9">
<?=form_input('edate', set_value('edate', $ds->edate), 'id="edate_obj" class="text" readonly="readonly" style="width:90px;"')?>
<script type="text/javascript">
	$('#edate_obj').datepick({showOn: 'button', yearRange: '-60:+0',
    buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
</script>
</div>
<div class="column span-3">
<?=form_label(lang('PRIORITY'), 'priority')?>
</div>
<div class="column span-9 last">
<?=form_dropdown('priority', array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')), set_value('priority', $ds->priority), 'id="priority" class="text"')?>
</div>
<div class="column span-3">
<?=form_label(lang('DESCR_TASK'), 'descr')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:300px;height:30px;"')?>
</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit_tasks" name="submit" onclick="return task_edit(<?=$ds->rid?>);">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" id="reset_tasks" name="reset" onclick="return task_list();">
</div>
<?=form_close()?>