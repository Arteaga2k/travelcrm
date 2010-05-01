<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('SNAME'), 'scontrahens_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('scontrahens_name', set_value('scontrahens_name', $ds->scontrahens_name), 'id="scontrahens_name" readonly  class="text part-5" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME'), 'contrahens_name')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('contrahens_name', set_value('contrahens_name', $ds->contrahens_name), 'id="contrahens_name" readonly class="text part-5" style="height: 30px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CITY'), 'city_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('city_name', set_value('city_name', get_city_name_byrid($ds->_cities_rid)), 'id="city_name" readonly="readonly" class="text part-5"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('WWW'), 'www')?>
</div>
<div class="column span-20 last">
	<?=form_input('www', set_value('www', $ds->www), 'id="www" class="text part-5" readonly ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('adress', set_value('adress', $ds->adress), 'id="adress" readonly class="text part-5" style="height: 30px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('FAX'), 'fax')?>
</div>
<div class="column span-20 last">
	<?=form_input('fax', set_value('fax', $ds->fax), 'id="fax" class="text part-5" readonly ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTPERSON'), 'contact_person')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_person', set_value('contact_person', $ds->contact_person), 'id="contact_person" class="text part-5" readonly ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CONTACTPHONE'), 'contact_phone')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_phone', set_value('contact_phone', $ds->contact_phone), 'id="contact_phone" class="text part-5" readonly ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CONTACTEMAIL'), 'contact_email')?>
</div>
<div class="column span-20 last">
	<?=form_input('contact_email', set_value('contact_email', $ds->contact_email), 'id="contact_email" class="text part-5" readonly ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;" readonly ')?>
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