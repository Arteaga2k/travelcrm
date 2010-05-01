<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">	<?=form_label(lang('COUNTRY'), '_countries_rid')?></div><div class="column span-20 last">	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('NAME'), 'curourt_name')?></div><div class="column span-20 last">	<?=form_input('curourt_name', set_value('curourt_name', $ds->curourt_name), 'id="curourt_name" class="text part-5" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('NAME_LAT'), 'curourt_name_lat')?></div><div class="column span-20 last">	<?=form_input('curourt_name_lat', set_value('curourt_name_lat', $ds->curourt_name_lat), 'id="curourt_name_lat" class="text part-5" readonly="readonly"')?></div>
<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

</div>
<script type="text/javascript">
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>