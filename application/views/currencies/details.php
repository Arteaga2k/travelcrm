<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('CODE'), 'code')?> 
</div>
<div class="column span-20 last">
	<?=form_input('code', set_value('code', $ds->code), 'id="code" class="text part-3" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME'), 'currency_name')?> 
</div>
<div class="column span-20 last">
	<?=form_input('currency_name', set_value('currency_name', $ds->currency_name), 'id="currency_name" class="text part-3" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('LEFT_WORD'), 'left_word')?> 
</div>
<div class="column span-20 last">
	<?=form_input('left_word', set_value('left_word', $ds->left_word), 'id="left_word" class="text part" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('RIGHT_WORD'), 'right_word')?>
</div>
<div class="column span-20 last">
	<?=form_input('right_word', set_value('right_word', $ds->right_word), 'id="right_word" class="text part" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>