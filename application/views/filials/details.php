<div class="grid">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('CODE'), 'code')?>
</div>

<div class="column span-8">
	<?=form_input('code', set_value('code', $ds->code), 'id="code" readonly="readonly" class="text"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('NAME'), 'name')?>
</div>

<div class="column span-8 last">
	<?=form_input('name', set_value('name', $ds->name), 'id="name" readonly="readonly" class="text"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('CITY'), 'city_name')?>
</div>

<div class="column span-8">
	<?=form_input('city_name', set_value('city_name', get_city_name_byrid($ds->_cities_rid)), 'id="city_name" readonly="readonly" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES'), 'phones')?>
</div>

<div class="column span-8 last">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" readonly="readonly" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?>
</div>

<div class="column span-8">
	<?=form_input('adress', set_value('adress', $ds->adress), 'id="adress" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('FAX'), 'fax')?>
</div>

<div class="column span-8 last">
	<?=form_input('fax', set_value('fax', $ds->fax), 'id="fax" class="text"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('MPHONES'), 'mobile_phones')?>
</div>

<div class="column span-8">
	<?=form_input('mobile_phones', set_value('mobile_phones', $ds->mobile_phones), 'id="mobile_phones" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>

<div class="column span-8 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

</div>
<div class="column span-24 last">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>