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
	<?=form_label(lang('SNAME').required_field(), 'scontrahens_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('scontrahens_name', set_value('scontrahens_name', ''), 'id="scontrahens_name" class="text part-5" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME').required_field(), 'contrahens_name')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('contrahens_name', set_value('contrahens_name', ''), 'id="contrahens_name" class="text part-5" style="height: 30px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CITY').required_field(), 'city_name')?>
</div>
<div class="column span-20 last">
	<?=get_cities_vp(set_value('_cities_rid', null))?>
</div>


<div class="column span-4">
	<?=form_label(lang('WWW'), 'www')?>
</div>
<div class="column span-20 last">
	<?=form_input('www', set_value('www', ''), 'id="www" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ADRESS').required_field(), 'adress')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('adress', set_value('adress', ''), 'id="adress" class="text part-5" style="height: 30px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('FAX'), 'fax')?>
</div>
<div class="column span-20 last">
	<?=form_input('fax', set_value('fax', ''), 'id="fax" class="text part-5" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTPERSON').required_field(), 'contact_person')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_person', set_value('contact_person', ''), 'id="contact_person" class="text part-5" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTACTPHONE').required_field(), 'contact_phone')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_phone', set_value('contact_phone', ''), 'id="contact_phone" class="text part-5" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTEMAIL').required_field(), 'contact_email')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_email', set_value('contact_email', ''), 'id="contact_email" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>