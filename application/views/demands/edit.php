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
	<legend><?=lang('PRINT')?></legend>
	<div class="column span-4">
		<?=anchor_popup(get_currcontroller()."/print_agreement/{$rid}", lang('PRINT_AGREEMENT'), array('title'=>lang('PRINT_AGREEMENT'), 'id'=>"print_agreement",  'name'=>"print_agreement",  'width'=>'950', 'height'=>'600'))?>
	</div>
	<div class="column span-20 last">
		<?=anchor_popup(get_currcontroller()."/print_demand/{$rid}", lang('PRINT_DEMAND'), array('title'=>lang('PRINT_DEMAND'), 'id'=>"print_demand",  'name'=>"print_demand",  'width'=>'950', 'height'=>'600'))?>
	</div>
</fieldset>
	
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
		<?=form_label(lang('AGREEMENT'), 'agreement')?>
	</div>
	<div class="column span-20 last">
		<?=form_input('agreement', set_value('agreement', $ds->agreement), 'id="agreement" class="text part-3" readonly="readonly" ')?>
	</div>

	<div class="column span-4">
		<b><?=form_label(lang('ANULATED'), 'anulated')?></b>
	</div>
	<div class="column span-20 last">
		<?=form_checkbox('anulated', 1, set_value('anulated', $ds->anulated)==1, 'id="anulated"')?>
	</div>
				
</fieldset>




<div class="column span-4">
	<?=form_label(lang('ADVERTISE').required_field(), 'source_name')?> 
</div>
<div class="column span-8">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', $ds->_advertisessources_rid))?>
</div>
<div class="column span-4">
	<?=form_label(lang('CALL').required_field(), 'call_rid')?>
</div>
<div class="column span-8 last">
	<?=get_calls_vp(set_value('_calls_documents_rid', $ds->_calls_documents_rid))?>
</div>


<fieldset>
<legend><?=lang('TOUR_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('TOUROPERATOR').required_field(), '_touroperators_rid')?> 
</div>
<div class="column span-20">
	<?=get_touroperators_vp(set_value('_touroperators_rid', $ds->_touroperators_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('DATE_FROM').required_field(), 'date_from')?> 
</div>
<div class="column span-8">
	<?=form_input('date_from', date_conv(set_value('date_from', $ds->date_from)), 'id="date_from" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_from').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>	
<div class="column span-4">
	<?=form_label(lang('DATE_TO').required_field(), 'date_to')?> 
</div>
<div class="column span-8 last">
	<?=form_input('date_to', date_conv(set_value('date_to', $ds->date_to)), 'id="date_to" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_to').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>


<div class="column span-4">
	<?=form_label(lang('COUNTRY').required_field(), '_countries_rid')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CUROURT'), 'curourt_name')?>
</div>
<div class="column span-8 last">
	<?=get_curourts_vp(set_value('_curourts_rid', $ds->_curourts_rid))?>
</div>


<div class="column span-4">
	<?=form_label(lang('HOTEL'), '_hotels_rid')?>
</div>
<div class="column span-20 last">
	<?=get_hotels_vp(set_value('_hotels_rid', $ds->_hotels_rid))?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ROUTE').required_field(), 'route')?> 
</div>
<div class="column span-20 last">
	<?=form_textarea('route', set_value('route', $ds->route), 'class="text" id="route" style="width:200px;height:30px;"')?>
</div>	


<div class="column span-4">
	<?=form_label(lang('ROOM').required_field(), '_rooms_rid')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_rooms_rid', get_rooms_list(), set_value('_rooms_rid', $ds->_rooms_rid), 'class="text" id="_rooms_rid"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('FOOD').required_field(), '_food_rid')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_food_rid', get_food_list(), set_value('_food_rid', $ds->_food_rid), 'class="text" id="_food_rid"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('CROOM').required_field(), 'room_cat')?> 
</div>
<div class="column span-8">
	<?=form_input('room_cat', set_value('room_cat', $ds->room_cat), 'class="text part-5" id="room_cat"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('TRANSFER').required_field(), 'transfer')?> 
</div>
<div class="column span-8 last">
	<?=form_textarea('transfer', set_value('transfer', $ds->transfer), 'class="text" id="transfer" style="width:200px;height:40px;"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('EXCURSIONS').required_field(), 'excursions')?> 
</div>
<div class="column span-20 last">
	<?=form_textarea('excursions', set_value('excursions', $ds->excursions), 'class="text" id="excursions" style="width:200px;height:40px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CIF'), 'cif')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('cif', set_value('cif', $ds->cif), 'class="text" id="cif" style="width:200px;height:40px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('TOUR_NUM'), 'tour_num')?>
</div>
<div class="column span-20 last">
	<?=form_input('tour_num', set_value('tour_num', $ds->tour_num), 'class="text part-5" id="tour_num"')?>
</div>	
	
<div class="column span-4">
	<b><?=form_label(lang('APPROVE_TOUR'), 'approve')?></b>
</div>
<div class="column span-8">
	<?=form_checkbox('approve', 1, set_value('approve', $ds->approve)==1, 'id="approve"')?>
</div>	

<div class="column span-4">
	<b><?=form_label(lang('VISA'), 'visa')?></b>
</div>
<div class="column span-8 last">
	<?=form_checkbox('visa', 1, set_value('visa', $ds->visa)==1, 'id="visa"')?>
</div>	
	
</fieldset>

<fieldset>
<legend><?=lang('TOUR_MEMBERS')?></legend>
<div class="column span-24 last" id="clients_list">
	<?=$clients?>
</div>
<div class="column span-4">
	<b><?=form_label('<b>'.lang('ADD_MEMBER').'</b>', 'client_name')?></b>
</div>
<div class="column span-20">
	<?=get_clients_vp(set_value('_clients_rid', null))?>
</div>	
<div class="column span-20 last">
	<?=form_button('add_client_row', lang('ADD_BTN'), 'class="button" id="add_client_row"')?>	
</div>
</fieldset>

<fieldset>
<legend><?=lang('PRICE_INFO')?></legend>

<div class="column span-4">
	<?=form_label(lang('SUM_TOUR').required_field(), 'sum_tour')?> 
</div>
<div class="column span-8">
	<?=form_input('sum_tour', set_value('sum_tour', $ds->sum_tour), 'class="text" id="sum_tour" style="width:100px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('CURRENCY').required_field(), '_currencies_rid')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" class="text" ')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('CURR_COURCE').required_field(), 'cource')?> 
</div>
<div class="column span-8 last">
	<?=form_input('cource', set_value('cource', $ds->cource), 'id="cource" class="text" style="width:50px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('OPERATOR_KOEFF').required_field(), 'to_koeff')?> 
</div>
<div class="column span-8 last">
	<?=form_input('to_koeff', set_value('to_koeff', $ds->to_koeff), 'id="to_koeff" class="text" style="width:50px;"')?>
</div>	
<div class="clear"></div>
<div class="column span-4">
	<?=form_label(lang('DISCOUNT_PER'), 'discount_per')?>
</div>
<div class="column span-8">
	<?=form_input('discount_per', set_value('discount_per', $ds->discount_per), 'id="discount_per" class="text" style="width:50px;"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('DISCOUNT_FIX'), 'discount_fix')?>
</div>
<div class="column span-8 last">
	<?=form_input('discount_fix', set_value('discount_fix', $ds->discount_fix), 'id="discount_fix" class="text" style="width:50px;"')?>
</div>	

<div class="column span-4">
	<?=form_label('<b>'.lang('SUM').'</b>', 'SUM')?>
</div>
<div class="column span-20 last">
	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text" style="width:100px;" readonly="readonly"')?>
	<br>
	<?=form_button('recalc', lang('RECALC'), 'class="button" id="recalc" style=""')?>
</div>	


</fieldset>
<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('ORDER_SUM'), 'order_sum')?>
</div>
<div class="column span-8">
	<?=form_input('order_sum', set_value('order_sum', $ds->order_sum), 'id="order_sum" class="text" style="width:90px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ORDER_NUM'), 'order_num')?>
</div>
<div class="column span-8 last">
	<?=form_input('order_num', set_value('order_num', $ds->order_num), 'id="order_num" class="text" style="width:90px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ORDER_DATE'), 'order_date')?>
</div>
<div class="column span-20 last">
	<?=form_input('order_date', date_conv(set_value('order_date', $ds->order_date)), 'id="order_date" class="text date-entry"')?>
	<script type="text/javascript">
		$('#order_date').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>	
	<?=get_doc_balance($ds->rid)?>
	<?=anchor_popup(site_url('finjournal/journal/'.$ds->rid), lang('SHOW_FIN_OPERS'), array('title'=>lang('SHOW_FIN_OPERS'), 'id'=>"sbtn_cities_rid",  'name'=>"sbtn_clients_rid",  'width'=>'950', 'height'=>'600'))?>
</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-12">
	<?=lang('UPLOAD_DESCR')?><br>
	<?=form_input('upload_descr', '', 'id="upload_descr" class="text part-5"')?><br>
	<?=form_button('upload_btn', lang('UPLOAD'), 'class="button" id="upload_btn" style=""')?>
</div>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
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
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>

<script type="text/javascript">
function client_processing(cl_rid, mode){
	var query_string = '';
	if(mode=='add'){
		query_string = 'add='+cl_rid+'&'+$("input[name='_cl_rid[]']").serialize();
	} else {
		query_string = 'remove='+cl_rid+'&'+$("input[name='_cl_rid[]']").serialize();
	}
	$.ajax({
		type: 'POST',
		url: "<?=site_url(get_currcontroller()."/getclients/go")?>",
		data: query_string,
		success: function(html){
		    $('#clients_list').html(html);
		    $("input[name='client_name']").val('');
		    $("#_clients_rid").val('');
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
			$('#add_client_row').click(function(){
				var clients_rid = $("input[name='_clients_rid']").val();
				if(clients_rid==''){
					alert('<?=lang('CLIENT_RID_NOT_SET')?>');
				} else {
					client_processing(clients_rid, 'add');
				}
			});
			$('#recalc').click(function(){
				// пересчет суммы тура на стороне сервера
				$('#sum_tour').val($('#sum_tour').val().replace(',','.'));
				$('#cource').val($('#cource').val().replace(',','.'));
				$('#to_koeff').val($('#to_koeff').val().replace(',','.'));
				$('#discount_per').val($('#discount_per').val().replace(',','.'));
				$('#discount_fix').val($('#discount_fix').val().replace(',','.'));
				var query_string = 'sum_tour='+$('#sum_tour').val()+'&'+
									'cource='+$('#cource').val()+'&'+
									'to_koeff='+$('#to_koeff').val()+'&'+
									'discount_per='+$('#discount_per').val()+'&'+
									'discount_fix='+$('#discount_fix').val();
				$.ajax({
					type: 'POST',
					url: "<?=site_url(get_currcontroller()."/recalc/go")?>",
					data: query_string,
					success: function(val){
						$('#sum').val(val);
						return;
					} 
				});
			});
			/* -- } Value picker --*/
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
