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
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" readonly="readonly" class="text date-entry" readonly="readonly"')?>
	</div>	

	<div class="column span-4">
		<?=form_label(lang('AGREEMENT'), 'agreement')?>
	</div>
	<div class="column span-20 last">
		<?=form_input('agreement', set_value('agreement', $ds->agreement), 'id="agreement" class="text" readonly="readonly" ')?>
	</div>
	<div class="column span-4">
		<b><?=form_label(lang('ANULATED'), 'anulated')?></b>
	</div>
	<div class="column span-20 last">
		<?=form_checkbox('anulated', 1, set_value('anulated', $ds->anulated)==1, 'id="anulated" readonly="readonly"')?>
	</div>	
		
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ADVERTISE'), 'source_name')?> 
</div>
<div class="column span-8">
	<?=form_input('source_name', get_sourcename_byrid(set_value('_advertisessources_rid', $ds->_advertisessources_rid)), 'id="source_name" class="text" readonly="readonly" style="width:150px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CALL'), 'call_rid')?>
</div>
<div class="column span-8 last">
	<span id="call_rid_link"></span>
	<?=form_input('call_rid', set_value('_calls_documents_rid', $ds->_calls_documents_rid), 'id="call_rid" readonly="readonly" class="text" style="width: 70px;"')?>
</div>


<fieldset>
<legend><?=lang('TOUR_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('TOUROPERATOR'), '_touroperators_rid')?> 
</div>
<div class="column span-20">
	<?=form_input('touroperator_name', get_touroperatorname_byrid(set_value('_touroperators_rid', $ds->_touroperators_rid)), 'id="touroperator_name" class="text" readonly="readonly" style="width:150px;"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('DATE_FROM'), 'date_from')?> 
</div>
<div class="column span-8">
	<?=form_input('date_from', date_conv(set_value('date_from', $ds->date_from)), 'id="date_from" class="text date-entry" readonly="readonly"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('DATE_TO'), 'date_to')?> 
</div>
<div class="column span-8">
	<?=form_input('date_to', date_conv(set_value('date_to', $ds->date_to)), 'id="date_to" class="text date-entry" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" readonly="readonly" class="text part-5" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CUROURT'), 'curourt_name')?>
</div>
<div class="column span-8">
	<?=form_input('curourt_name', get_curourtname_byrid(set_value('_curourts_rid', $ds->_curourts_rid)), 'id="curourt_name" class="text part-5" readonly="readonly"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('HOTEL'), '_hotels_rid')?>
</div>
<div class="column span-20 last">
	<?=form_input('hotel_name', get_hotelname_byrid(set_value('_hotels_rid', $ds->_hotels_rid)), 'id="hotel_name" class="text part-5" readonly="readonly"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ROUTE'), 'route')?> 
</div>
<div class="column span-20 last">
	<?=form_textarea('route', set_value('route', $ds->route), 'class="text" id="route" readonly="readonly" style="width:200px;height:30px;"')?>
</div>		

<div class="column span-4">
	<?=form_label(lang('ROOM'), '_rooms_rid')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_rooms_rid', get_rooms_list(), set_value('_rooms_rid', $ds->_rooms_rid), 'class="text" readonly="readonly" id="_rooms_rid"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('FOOD'), '_food_rid')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_food_rid', get_food_list(), set_value('_food_rid', $ds->_food_rid), 'class="text" readonly="readonly" id="_food_rid"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('CROOM'), 'room_cat')?> 
</div>
<div class="column span-8">
	<?=form_input('room_cat', set_value('room_cat', $ds->room_cat), 'class="text part-5" readonly="readonly" id="room_cat"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('TRANSFER'), 'transfer')?> 
</div>
<div class="column span-8 last">
	<?=form_textarea('transfer', set_value('transfer', $ds->transfer), 'class="text" id="transfer" readonly="readonly" style="width:200px;height:40px;"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('EXCURSIONS'), 'excursions')?> 
</div>
<div class="column span-20 last">
	<?=form_textarea('excursions', set_value('excursions', $ds->excursions), 'class="text" readonly="readonly" id="excursions" style="width:200px;height:40px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CIF'), 'cif')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('cif', set_value('cif', $ds->cif), 'class="text" id="cif" readonly="readonly" style="width:200px;height:40px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('TOUR_NUM'), 'tour_num')?>
</div>
<div class="column span-20 last">
	<?=form_input('tour_num', set_value('tour_num', $ds->tour_num), 'class="text part-5" readonly="readonly" id="tour_num"')?>
</div>	
	
<div class="column span-4">
	<b><?=form_label(lang('APPROVE_TOUR'), 'approve')?></b>
</div>
<div class="column span-8">
	<?=form_checkbox('approve', 1, set_value('approve', $ds->approve)==1, 'readonly="readonly" id="approve"')?>
</div>	

<div class="column span-4">
	<b><?=form_label(lang('VISA'), 'visa')?></b>
</div>
<div class="column span-8 last">
	<?=form_checkbox('visa', 1, set_value('visa', $ds->visa)==1, 'readonly="readonly" id="visa"')?>
</div>	
	
</fieldset>

<fieldset>
<legend><?=lang('TOUR_MEMBERS')?></legend>
<div class="column span-24 last" id="clients_list">
	<?=$clients?>
</div>
</fieldset>

<fieldset>
<legend><?=lang('PRICE_INFO')?></legend>

<div class="column span-4">
	<?=form_label(lang('SUM_TOUR'), 'sum_tour')?> 
</div>
<div class="column span-8">
	<?=form_input('sum_tour', set_value('sum_tour', $ds->sum_tour), 'class="text" id="sum_tour" readonly="readonly" style="width:100px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" readonly="readonly" class="text" ')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('CURR_COURCE'), 'cource')?> 
</div>
<div class="column span-8 last">
	<?=form_input('cource', set_value('cource', $ds->cource), 'id="cource" class="text" readonly="readonly" style="width:50px;"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('OPERATOR_KOEFF'), 'to_koeff')?> 
</div>
<div class="column span-8 last">
	<?=form_input('to_koeff', set_value('to_koeff', $ds->to_koeff), 'id="to_koeff" readonly="readonly" class="text" style="width:50px;"')?>
</div>	
<div class="clear"></div>
<div class="column span-4">
	<?=form_label(lang('DISCOUNT_PER'), 'discount_per')?>
</div>
<div class="column span-8">
	<?=form_input('discount_per', set_value('discount_per', $ds->discount_per), 'id="discount_per" readonly="readonly" class="text" style="width:50px;"')?>
</div>	
<div class="column span-4">
	<?=form_label(lang('DISCOUNT_FIX'), 'discount_fix')?>
</div>
<div class="column span-8 last">
	<?=form_input('discount_fix', set_value('discount_fix', $ds->discount_fix), 'id="discount_fix" readonly="readonly" class="text" style="width:50px;"')?>
</div>	

<div class="column span-4">
	<?=form_label('<b>'.lang('SUM').'</b>', 'SUM')?>
</div>
<div class="column span-20 last">
	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text" style="width:100px;" readonly="readonly"')?>
</div>	


</fieldset>
<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
	<?=get_doc_balance($ds->rid)?>
</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-24  last" id="attaches">
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
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>