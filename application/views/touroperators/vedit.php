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

<div class="column span-4">
	<?=form_label(lang('SNAME'), 'stouroperator_name')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('stouroperator_name', set_value('stouroperator_name', $ds->stouroperator_name), 'id="stouroperator_name" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME'), 'touroperator_name')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_textarea('touroperator_name', set_value('touroperator_name', $ds->touroperator_name), 'id="touroperator_name" class="text" style="width:200px; height: 50px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('LICENSE'), 'license')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('license', set_value('license', $ds->license), 'id="license" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CHIEF_NAME'), 'chief_name')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('chief_name', set_value('chief_name', $ds->chief_name), 'id="chief_name" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('WWW'), 'www')?>
</div>
<div class="column span-8">
	<?=form_input('www', set_value('www', $ds->www), 'id="www" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTRACT'), 'contract')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contract', set_value('contract', $ds->contract), 'id="contract" class="text" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTRACT_PERIOD'), 'contract_period')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('contract_period', set_value('contract_period', $ds->contract_period), 'id="contract_period" class="text date-entry"')?>
	<script type="text/javascript">
		$('#contract_period_from').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>
<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_textarea('adress', set_value('adress', $ds->adress), 'id="adress" class="text" style="width:200px; height: 50px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('FAX'), 'fax')?>
</div>
<div class="column span-8">
	<?=form_input('fax', set_value('fax', $ds->fax), 'id="fax" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTPERSON'), 'contact_person')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contact_person', set_value('contact_person', $ds->contact_person), 'id="contact_person" class="text" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTACTPHONE'), 'contact_phone')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('contact_phone', set_value('contact_phone', $ds->contact_phone), 'id="contact_phone" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTEMAIL'), 'contact_email')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contact_email', set_value('contact_email', $ds->contact_email), 'id="contact_email" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CATEGORY'), 'category')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('category', get_tocats(), set_value('category', $ds->category, ''), 'id="category" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
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