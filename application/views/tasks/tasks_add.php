<h3><?=lang('NEW_TASK')?></h3>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?=form_open(get_currcontroller()."/tasks/add", array('id'=>'create_'.$objrid, 'autocomplete'=>'off'))?>
<?=form_hidden('objrid', $objrid)?>
<div class="column span-3">
<?=form_label(lang('DATE_TASK'), 'edate')?> <font color="red">*</font>
</div>
<div class="column span-9">
<?=form_input('edate', set_value('edate', ''), 'id="edate_obj" class="text" readonly="readonly" style="width:90px;"')?>
<script type="text/javascript">
	$('#edate_obj').datepick({showOn: 'button', yearRange: '-60:+0',
    buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
</script>
</div>
<div class="column span-3">
<?=form_label(lang('PRIORITY'), 'priority')?>
</div>
<div class="column span-9 last">
<?=form_dropdown('priority', array(2=>lang('HIGH'), 1=>lang('MEDIUM'), 0=>lang('LOW')), set_value('priority', ''), 'id="priority" class="text"')?>
</div>
<div class="column span-3">
<?=form_label(lang('DESCR_TASK'), 'descr')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:300px;height:30px;"')?>
</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit_tasks" name="submit" onclick="return task_add();">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" id="reset_tasks" name="reset" onclick="return task_list();">
</div>
<?=form_close()?>