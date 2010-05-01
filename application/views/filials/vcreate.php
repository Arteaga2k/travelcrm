<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vcreate/go", array('id'=>'vcreate_'.$orid, 'autocomplete'=>'off'))?>
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
<div class="column span-4">	<?=form_label(lang('CODE'), 'code')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('code', set_value('code', ''), 'id="code" class="text"')?></div>
<div class="column span-4">	<?=form_label(lang('NAME'), 'name')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('name', set_value('name', ''), 'id="name" class="text"')?></div><div class="column span-4">	<?=form_label(lang('CITY'), 'city_name')?> <font color="red">*</font></div><div class="column span-8">
	<?=get_cities_vp(set_value('_cities_rid', null))?></div><div class="column span-4">	<?=form_label(lang('PHONES'), 'phones')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('phones', set_value('phones', ''), 'id="phones" class="text"')?></div><div class="column span-4">	<?=form_label(lang('ADRESS'), 'adress')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('adress', set_value('adress', ''), 'id="adress" class="text"')?></div><div class="column span-4">	<?=form_label(lang('FAX'), 'fax')?></div><div class="column span-8 last">	<?=form_input('fax', set_value('fax', ''), 'id="fax" class="text"')?></div><div class="column span-4">	<?=form_label(lang('MPHONES'), 'mobile_phones')?></div><div class="column span-8">	<?=form_input('mobile_phones', set_value('mobile_phones', ''), 'id="mobile_phones" class="text"')?></div><div class="column span-4">	<?=form_label(lang('EMAIL'), 'email')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('email', set_value('email', ''), 'id="email" class="text"')?></div><div class="column span-4">
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
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>
</div>