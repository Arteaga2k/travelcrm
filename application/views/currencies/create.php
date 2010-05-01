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
	<?=form_label(lang('CODE').required_field(), 'code')?>
</div>
<div class="column span-20 last ">
	<?=form_input('code', set_value('code', ''), 'id="code" class="text part-3"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME').required_field(), 'currency_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('currency_name', set_value('currency_name', ''), 'id="currency_name" class="text part-3"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('LEFT_WORD'), 'left_word')?> 
</div>
<div class="column span-20 last">
	<?=form_input('left_word', set_value('left_word', ''), 'id="left_word" class="text part"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('RIGHT_WORD').required_field(), 'right_word')?>
</div>
<div class="column span-20 last">
	<?=form_input('right_word', set_value('right_word', ''), 'id="right_word" class="text part"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', '0'), 'id="archive" class="text"')?>
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