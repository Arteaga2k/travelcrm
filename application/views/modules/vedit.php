<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vedit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?if($success===False){?>
<div class="error">
	<?=lang('SAVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?if($success===True){?>
<div class="success">
	<?=lang('SAVE_SYSTEM_SUCCESS')?>
</div>
<?}?>
<div class="column span-3">
	<?=form_label(lang('MODULE_NAME').required_field(), 'module_name')?>
</div>
<div class="column span-21 last">
	<?=form_input('module_name', set_value('module_name', $ds->module_name), 'id="module_name" class="text"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('MODULE_CONTROLLER').required_field(), 'module_controller')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('module_controller', get_controllers_list(), set_value('module_controller', $ds->module_controller), 'id="module_controller" class="text"')?>
</div>


<fieldset>
	<legend><?=lang('RIGHTS')?></legend>
	<div class="column span-10">
		<b><?=lang('POSITION')?></b>
	</div>
	<div class="column span-2">
		<?=lang('ADD')?>
	</div>
	<div class="column span-2">
		<?=lang('EDIT')?>
	</div>
	<div class="column span-2">
		<?=lang('DETAILS')?>
	</div>
	<div class="column span-2">
		<?=lang('DELETE')?>
	</div>
	<div class="column span-2">
		<?=lang('MOVE')?>
	</div>
	<div class="column span-2">
		<?=lang('ARCHIVE')?>
	</div>
	<div class="column span-2 last">
		<?=lang('SPACE')?>
	</div>
	 
	<?foreach(get_module_permissions($rid) as $r) { ?>
	<div class="column span-10">
		<?=$r['position_name']?>
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][add]", 1, set_value("permissions[{$r['position_rid']}][add]", $r['add_allow']))?>
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][edit]", 1, set_value("permissions[{$r['position_rid']}][edit]", $r['edit_allow']))?>
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][details]", 1, set_value("permissions[{$r['position_rid']}][details]", $r['details_allow']))?>	
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][delete]", 1, set_value("permissions[{$r['position_rid']}][delete]", $r['delete_allow']))?>	
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][move]", 1, set_value("permissions[{$r['position_rid']}][move]", $r['move_allow']))?>	
	</div>
	<div class="column span-2">
		<?=form_checkbox("permissions[{$r['position_rid']}][archive]", 1, set_value("permissions[{$r['position_rid']}][archive]", $r['archive_allow']))?>	
	</div>
	<div class="column span-2 last">
		<?=form_dropdown("permissions[{$r['position_rid']}][viewed_space]", get_areas(), set_value("permissions[{$r['position_rid']}][viewed_space]", $r['viewed_space']), 'id="item_area" class="text" style="margin:0px;"')?>
	</div>
	<?}?>
	
</fieldset>

<div class="column span-3">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-21 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

<?= form_close(); ?>

</div>

<script type="text/javascript">
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>
