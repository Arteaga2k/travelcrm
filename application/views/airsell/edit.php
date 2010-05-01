<div class="grid fieldscontainer">
<script src="<?=base_url()?>public/js/ajaxupload.3.5.js" type="text/javascript"></script>
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/edit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
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

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-8">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part-2" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC').required_field(), 'date_doc')?> 
	</div>
	<div class="column span-8 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text date-entry"')?>
		<script type="text/javascript">
			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		</script>
	</div>	
	
	<div class="column span-4">
		<b><?=form_label(lang('ANULATED'), 'anulated')?></b>
	</div>
	<div class="column span-20 last">
		<?=form_checkbox('anulated', 1, set_value('anulated', $ds->anulated)==1, 'id="anulated"')?>
	</div>
	
</fieldset>


<div class="column span-4">
	<?=form_label(lang('DNUM'), 'dnum')?>
</div>
<div class="column span-20 last">
	<?=form_input('dnum', set_value('dnum', $ds->dnum), 'id="dnum" class="text part-2"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ADVERTISE').required_field(), 'source_name')?> 
</div>
<div class="column span-8">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', $ds->_advertisessources_rid))?>
</div>
<div class="column span-4">
	<?=form_label(lang('AIRCALL'), 'aircall_rid')?>
</div>
<div class="column span-8 last">
	<span id="call_rid_link"></span>
	<?=get_aircalls_vp(set_value('_aircalls_documents_rid', $ds->_aircalls_documents_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('CLIENT_L_NAME').required_field(), 'client_name')?> 
</div>
<div class="column span-20 last">
	<?=get_clients_vp(set_value('_clients_rid', $ds->_clients_rid))?>
</div>	


<fieldset>
<legend><?=lang('ROUTE_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('ISSUE').required_field(), 'issue')?> 
</div>
<div class="column span-20 last">
	<?=form_dropdown('issue', get_airissues_types(), set_value('issue', $ds->issue), 'id="issue" class="text"')?>
</div>

<div class="column span-24 last" id="routes">
	<?=$routes?>
</div>
<div class="column span-4">
	<?=form_label(lang('AIRCOMPANY').required_field(), '_aircompanies_rid')?> 
</div>
<div class="column span-8">
	<?=get_aircompanies_vp(set_value('_aircompanies_rid', ''))?>
</div>
<div class="column span-4">
	<?=form_label(lang('AIRCLASS').required_field(), 'air_class')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('air_class', get_airclasses(), set_value('air_class', ''), 'id="air_class" class="text" style="width:150px;"')?>
</div>
<div class="column span-12 bbordered">
	<b><?=lang('AREA_FROM')?></b>
</div>
<div class="column span-12 bbordered last">
	<b><?=lang('AREA_TO')?></b>
</div>
<div class="column span-4">
	<?=form_label(lang('COUNTRY_FROM').required_field(), '_countries_rid_from')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_countries_rid_from', get_countries_list(), set_value('_countries_rid_from', ''), 'id="_countries_rid_from" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('COUNTRY_TO').required_field(), '_countries_rid_to')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_countries_rid_to', get_countries_list(), set_value('_countries_rid_to', ''), 'id="_countries_rid_to" class="text" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('POINT_FROM').required_field(), 'point_from')?> 
</div>
<div class="column span-8">
	<?=form_input('point_from', set_value('point_from', ''), 'id="point_from" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('POINT_TO').required_field(), 'point_to')?> 
</div>
<div class="column span-8 last">
	<?=form_input('point_to', set_value('point_to', ''), 'id="point_to" class="text part-5" ')?>
</div>


<div class="column span-4">
	<?=form_label(lang('DEPARTURE').required_field(), 'departure')?> 
</div>
<div class="column span-8">
	<?=form_input('departure', date_conv(set_value('departure', date('Y-m-d'))), 'id="departure" class="text date-entry"')?>
	<script type="text/javascript">
		$('#departure').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>	
<div class="column span-4">
	<?=form_label(lang('ARRIVAL').required_field(), 'arrival')?> 
</div>
<div class="column span-8 last">
	<?=form_input('arrival', date_conv(set_value('arrival', date('Y-m-d'))), 'id="arrival" class="text date-entry"')?>
	<script type="text/javascript">
		$('#arrival').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>	
<div class="column span-24 last controls">
	<?=form_button('add_route_row', lang('ADD'), 'id="add_route_row" class="button"')?>
</div>
</fieldset>

<fieldset>
<legend><?=lang('BILL_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('BILL_CODE'), 'bill_code')?>
</div>
<div class="column span-8">
	<?=form_input('bill_code', set_value('bill_code', $ds->bill_code), 'id="bill_code" class="text part"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('BILL_NUM'), 'bill_num')?>
</div>
<div class="column span-8 last">
	<?=form_input('bill_num', set_value('bill_num', $ds->bill_num), 'id="bill_num" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('LOCATOR_BRONE'), 'brone_locator')?>
</div>
<div class="column span-20 last">
	<?=form_input('brone_locator', set_value('brone_locator', $ds->brone_locator), 'id="brone_locator" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('SUM'), 'sum')?>
</div>
<div class="column span-8">
	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text part-2" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', ''), 'id="_currencies_rid" class="text" ')?>
</div>

</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-12">
	<?=lang('UPLOAD_DESCR')?><br>
	<?=form_input('upload_descr', '', 'id="upload_descr" class="text" style="width:300px;"')?><br>
	<?=form_button('upload_btn', lang('UPLOAD'), 'class="button" id="upload_btn" style=""')?>
</div>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
</fieldset>

<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
	<?=get_doc_balance($ds->rid)?>
	<?=anchor_popup(site_url('finjournal/journal/'.$ds->rid), lang('SHOW_FIN_OPERS'), array('title'=>lang('SHOW_FIN_OPERS'), 'id'=>"sbtn_cities_rid",  'name'=>"sbtn_clients_rid",  'width'=>'950', 'height'=>'600'))?>
</fieldset>


<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:300px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>

<script type="text/javascript">
function add_route(){
	var query_string = '';
	query_string = 'add_route=yes&'+$("input[name='_aircompanies_rid']").serialize()+'&'+
					$("#air_class").serialize()+'&'+
					$("#_countries_rid_from").serialize()+'&'+
					$("#_countries_rid_to").serialize()+'&'+
					$("#point_from").serialize()+'&'+
					$("#point_to").serialize()+'&'+
					$("#departure").serialize()+'&'+
					$("#arrival").serialize()+'&'+
					$("input[name='_aircompanies_rids[]']").serialize()+'&'+
					$("input[name='air_classes[]']").serialize()+'&'+
					$("input[name='_countries_rids_from[]']").serialize()+'&'+
					$("input[name='_countries_rids_to[]']").serialize()+'&'+
					$("input[name='points_from[]']").serialize()+'&'+
					$("input[name='points_to[]']").serialize()+'&'+
					$("input[name='departures[]']").serialize()+'&'+
					$("input[name='arrivals[]']").serialize();
	$.ajax({
		type: 'POST',
		url: "<?=site_url(get_currcontroller()."/getroutes/go")?>",
		data: query_string,
		success: function(html){
		    $('#routes').html(html);
		}
	});
}

function attach_remove(rid){
	$.ajax({
		type:'POST',
		url: '<?=site_url(get_currcontroller()."/removeattach/go")?>',
		data:{rid:rid, doc_rid:"<?=$ds->rid?>"},
		success: function(html){
			$('#attaches').html(html);
			return;
		}
	});
}

$(document).ready(
		function(){
			$('#add_route_row').click(function(){
				add_route();
			});

			new AjaxUpload('upload_btn', {
				action: '<?=site_url(get_currcontroller()."/addattach/go")?>',
				onSubmit: function() {
					this.setData({_documents_rid : "<?=$ds->rid?>", upload_descr:$('#upload_descr').val()});
				},
				onComplete: function(file, response) {
					$('#attaches').html(response);
					return;
				}
			});
		}
)	
</script>
