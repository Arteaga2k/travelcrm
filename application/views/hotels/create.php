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
	<?=form_label(lang('NAME').required_field(), 'hotel_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('hotel_name', set_value('hotel_name', ''), 'id="hotel_name" class="text"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('HOTELCAT').required_field(), '_hotelscats_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_hotelscats_rid', get_hotelscats_list(), set_value('_hotelscats_rid', ''), 'class="text" id="_hotelscats_rid"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('COUNTRY').required_field(), '_countries_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', ''), 'id="_countries_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CUROURT'), '_curourts_rid')?>
</div>
<div class="column span-20 last">
	<?=get_curourts_vp(set_value('_curourts_rid', ''))?>
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