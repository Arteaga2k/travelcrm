<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-3">
	<?=form_label(lang('MODULE_NAME'), 'module_name')?>
</div>
<div class="column span-21 last">
	<?=form_input('module_name', set_value('module_name', $ds->module_name), 'id="module_name" class="text" readonly="readonly"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('MODULE_CONTROLLER'), 'module_controller')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('module_controller', get_controllers_list(), set_value('module_controller', $ds->module_controller), 'id="module_controller" class="text" readonly="readonly"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-21 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>