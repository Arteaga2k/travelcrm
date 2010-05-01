<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/create/go", array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
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
	<?=form_input('stouroperator_name', set_value('stouroperator_name', ''), 'id="stouroperator_name" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME'), 'touroperator_name')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_textarea('touroperator_name', set_value('touroperator_name', ''), 'id="touroperator_name" class="text" style="width:200px; height: 50px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('LICENSE'), 'license')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('license', set_value('license', ''), 'id="license" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CHIEF_NAME'), 'chief_name')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('chief_name', set_value('chief_name', ''), 'id="chief_name" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('WWW'), 'www')?>
</div>
<div class="column span-8">
	<?=form_input('www', set_value('www', ''), 'id="www" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTRACT'), 'contract')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contract', set_value('contract', ''), 'id="contract" class="text" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTRACT_PERIOD'), 'contract_period')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('contract_period', set_value('contract_period', ''), 'id="contract_period" class="text date-entry"')?>
	<script type="text/javascript">
		$('#contract_period').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>
<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_textarea('adress', set_value('adress', ''), 'id="adress" class="text" style="width:200px; height: 50px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('FAX'), 'fax')?>
</div>
<div class="column span-8">
	<?=form_input('fax', set_value('fax', ''), 'id="fax" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTPERSON'), 'contact_person')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contact_person', set_value('contact_person', ''), 'id="contact_person" class="text" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTACTPHONE'), 'contact_phone')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('contact_phone', set_value('contact_phone', ''), 'id="contact_phone" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTEMAIL'), 'contact_email')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('contact_email', set_value('contact_email', ''), 'id="contact_email" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CATEGORY'), 'category')?> <font color="red">*</font>
</div>
<div class="column span-20 last">	<?=form_dropdown('category', get_tocats(), set_value('category', ''), 'id="category" class="text"')?></div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>