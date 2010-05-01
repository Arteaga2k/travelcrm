<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform"><div class="column span-3">	<?=form_label(lang('CODE'), 'code')?></div><div class="column span-21 last">	<?=form_input('code', set_value('code', $ds->code), 'id="code" class="text part-5" readonly="readonly"')?></div><div class="column span-3">	<?=form_label(lang('NAME'), 'state_name')?></div><div class="column span-21 last">	<?=form_input('state_name', set_value('state_name', $ds->state_name), 'id="state_name" class="text part-5" readonly="readonly"')?></div><div class="column span-3">	<?=form_label(lang('TYPE'), 'koef')?></div><div class="column span-21 last">	<?=form_dropdown('koef', get_koef_list(), set_value('koef', $ds->koef), 'id="koef" class="text" readonly="readonly"')?></div>
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