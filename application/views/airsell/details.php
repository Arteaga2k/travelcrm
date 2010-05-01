<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-8">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part-2" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC'), 'date_doc')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" readonly="readonly" class="text date-entry"')?>
	</div>	
	
	<div class="column span-4">
		<b><?=form_label(lang('ANULATED'), 'anulated')?></b>
	</div>
	<div class="column span-20 last">
		<?=form_checkbox('anulated', 1, set_value('anulated', $ds->anulated)==1, 'id="anulated" readonly="readonly"')?>
	</div>	
	
</fieldset>


<div class="column span-4">
	<?=form_label(lang('DNUM'), 'dnum')?>
</div>
<div class="column span-20 last">
	<?=form_input('dnum', set_value('dnum', $ds->dnum), 'id="dnum" readonly="readonly" class="text part-2"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ADVERTISE'), 'source_name')?>
</div>
<div class="column span-8">
	<?=form_input('source_name', get_sourcename_byrid(set_value('_advertisessources_rid', $ds->_advertisessources_rid)), 'id="source_name" class="text part-5" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('AIRCALL'), 'aircall_rid')?>
</div>
<div class="column span-8 last">
	<span id="call_rid_link"></span>
	<?=form_input('aircall_rid', set_value('_aircalls_documents_rid', $ds->_aircalls_documents_rid), 'id="aircall_rid" readonly="readonly" class="text part-2"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CLIENT_L_NAME'), 'client_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('client_name', get_clientname_byrid(set_value('_clients_rid', $ds->_clients_rid)), 'id="client_name" class="text part-5" readonly="readonly"')?>
</div>	


<fieldset>
<legend><?=lang('ROUTE_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('ISSUE'), 'issue')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('issue', get_airissues_types(), set_value('issue', $ds->issue), 'id="issue" readonly="readonly" class="text part-5"')?>
</div>

<div class="column span-24 last" id="routes">
	<?=$routes?>
</div>
</fieldset>

<fieldset>
<legend><?=lang('BILL_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('BILL_CODE'), 'bill_code')?>
</div>
<div class="column span-8">
	<?=form_input('bill_code', set_value('bill_code', $ds->bill_code), 'id="bill_code" readonly="readonly" class="text part-2"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('BILL_NUM'), 'bill_num')?>
</div>
<div class="column span-8 last">
	<?=form_input('bill_num', set_value('bill_num', $ds->bill_num), 'id="bill_num" readonly="readonly" class="text part-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('LOCATOR_BRONE'), 'brone_locator')?>
</div>
<div class="column span-20 last">
	<?=form_input('brone_locator', set_value('brone_locator', $ds->brone_locator), 'id="brone_locator" readonly="readonly" class="text part-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('SUM'), 'sum')?>
</div>
<div class="column span-8">
	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text part-2" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', ''), 'id="_currencies_rid" readonly="readonly" class="text" ')?>
</div>

</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
</fieldset>

<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
	<?=get_doc_balance($ds->rid)?>
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