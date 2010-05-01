<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('NAME'), 'hotel_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('hotel_name', set_value('hotel_name', $ds->hotel_name), 'id="hotel_name" class="text part-5" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('HOTELCAT'), '_hotelscats_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_hotelscats_rid', get_hotelscats_list(), set_value('_hotelscats_rid', $ds->_hotelscats_rid), 'class="text" readonly="readonly" id="_hotelscats_rid"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?>
</div>
<div class="column span-20">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" readonly="readonly" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CUROURT'), '_curourts_rid')?>
</div>
<div class="column span-20 last">
	<?=form_input('curourt_name', get_curourtname_byrid(set_value('_curourts_rid', $ds->_curourts_rid)), 'id="curourt_name" class="text part-5" readonly="readonly"')?>
</div>

<fieldset>
	<legend><?=lang('SYNONIMS')?></legend>
	<?=$synonims_obj?>
</fieldset>

<fieldset>
<legend><?=lang('PHOTOS')?></legend>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
</fieldset>

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