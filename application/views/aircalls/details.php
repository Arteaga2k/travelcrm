<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-4">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC'), 'date_doc')?> 
	</div>
	<div class="column span-4">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text date-entry" readonly="readonly"')?>
	</div>	

	<div class="column span-4">
		<?=form_label(lang('TIME_DOC'), 'time_doc')?>
	</div>
	<div class="column span-4 last">
		<?=form_input('time_doc', date_conv(set_value('time_doc', $ds->date_doc), True), 'id="time_doc" class="text date-entry" readonly="readonly"')?>
	</div>	
		
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ADVERTISE_SHORT'), 'source_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('source_name', get_sourcename_byrid(set_value('_advertisessources_rid', $ds->_advertisessources_rid)), 'readonly="readonly" id="source_name" class="text" readonly="readonly" style="width:150px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('L_NAME'), 'l_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" readonly="readonly" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME'), 'f_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" readonly="readonly" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" readonly="readonly" class="text part-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CLIENT'), '_clients_rid')?>
</div>
<div class="column span-20 last">
	<?=form_input('client_name', get_clientname_byrid(set_value('_clients_rid', $ds->_clients_rid)), 'id="client_name" class="text part-5" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES'), 'phones')?>
</div>
<div class="column span-20 last">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" readonly="readonly" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-20 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" readonly="readonly" class="text part-5"')?>
</div>


<fieldset>
<legend><?=lang('AIR_DETAILS')?></legend>
<div class="column span-4">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" readonly="readonly" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('AIRCLASS'), 'air_class')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('air_class', get_airclasses(), set_value('air_class', $ds->air_class), 'id="air_class" readonly="readonly" class="text')?>
</div>
<div class="column span-4">
	<?=form_label(lang('DATE_FROM'), 'date_from')?>
</div>
<div class="column span-20 last">
	<?=form_input('date_from', date_conv(set_value('date_from', $ds->date_from)), 'id="date_from" readonly="readonly" class="text date-entry" readonly="readonly"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('DATE_TO'), 'date_to')?>
</div>
<div class="column span-20 last">
	<?=form_input('date_to', date_conv(set_value('date_to', $ds->date_to)), 'id="date_to" readonly="readonly" class="text date-entry" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('SUM_TO'), 'sum_wanted_to')?>
</div>
<div class="column span-8">
	<?=form_input('sum_wanted_to', set_value('sum_wanted_to', $ds->sum_wanted_to), 'id="sum_wanted_to" readonly="readonly" class="text part-2"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" readonly="readonly" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('TOURISTS_QUAN'), 'tourists_quan')?>
</div>
<div class="column span-20 last">
	<?=form_input('tourists_quan', set_value('tourists_quan', $ds->tourists_quan), 'id="tourists_quan" class="text part" readonly="readonly"')?>
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
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>