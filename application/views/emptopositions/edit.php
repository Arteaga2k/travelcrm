<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/edit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
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

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-8">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC').required_field(), 'date_doc')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text date-entry"')?>
		<script type="text/javascript">
			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		</script>
	</div>	
		
</fieldset>

<div class="column span-4">
	<?=form_label(lang('EMPLOYEER').required_field(), 'full_name')?>
</div>
<div class="column span-20 last">
	<?=get_employeers_vp(set_value('_employeers_rid', $ds->_employeers_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('FILIAL').required_field(), 'filial_name')?>
</div>
<div class="column span-20 last">
	<?=get_filials_vp(set_value('_filials_rid', $ds->_filials_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('POSITION').required_field(), '_positions_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_positions_rid', get_positions_list(), set_value('_positions_rid', $ds->_positions_rid), 'id="_positions_rid" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('BDATE').required_field(), 'bdate')?>
</div>
<div class="column span-20 last">
	<?=form_input('bdate', date_conv(set_value('bdate', $ds->bdate)), 'id="bdate" class="text date-entry"')?>
	<script type="text/javascript">
		$('#bdate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<fieldset>
<legend><?=lang('SALARY')?></legend>
<div class="column span-4">
	<?=form_label(lang('SALARY_VAL').required_field(), 'salary')?>
</div>
<div class="column span-20 last">
	<?=form_input('salary', set_value('salary', $ds->salary), 'id="salary" class="text part-2"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CURRENCY').required_field(), '_currencies_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" class="text"')?>
</div>
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:300px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
