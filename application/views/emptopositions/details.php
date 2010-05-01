<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-8">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC'), 'date_doc')?> 
	</div>
	<div class="column span-8 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text date-entry" readonly="readonly"')?>
	</div>	
		
</fieldset>

<div class="column span-4">
	<?=form_label(lang('EMPLOYEER'), 'full_name')?> 
</div>
<div class="column span-20 last">
	<?=form_input('full_name', get_emp_fullname_byrid(set_value('_employeers_rid', $ds->_employeers_rid)), 'id="full_name" class="text part-5" readonly="readonly" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('FILIAL'), 'filial_name')?> 
</div>
<div class="column span-20 last">
	<?=form_input('filial_name', get_filial_name_byrid(set_value('_filials_rid', $ds->_filials_rid)), 'id="filial_name" class="text part-5" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('POSITION'), '_positions_rid')?> 
</div>
<div class="column span-20 last">
	<?=form_dropdown('_positions_rid', get_positions_list(), set_value('_positions_rid', $ds->_positions_rid), 'id="_positions_rid" class="text part-5" readonly="readonly" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('BDATE'), 'bdate')?> 
</div>
<div class="column span-20 last">
	<?=form_input('bdate', date_conv(set_value('bdate', $ds->bdate)), 'id="bdate" class="text date-entry" readonly="readonly"')?>
</div>

<fieldset>
<legend><?=lang('SALARY')?></legend>
<div class="column span-4">
	<?=form_label(lang('SALARY_VAL'), 'salary')?> 
</div>
<div class="column span-20 last">
	<?=form_input('salary', set_value('salary', $ds->salary), 'id="salary" class="text part-3" readonly="readonly" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> 
</div>
<div class="column span-20 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" readonly="readonly"  class="text"')?>
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