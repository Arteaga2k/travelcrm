<div class="grid">
<style>
a#sbtn_creditor_rid, a#sbtn_creditor_rid_details, a#cbtn_creditor_rid,
a#sbtn_debetor_rid, a#sbtn_debetor_rid_details, a#cbtn_debetor_rid{
	display: none;
}
</style>
<h3><?=$title?></h3>
<div class="container editform">

<div class="column span-4">
	<?=form_label(lang('CREDIT'), 'c_type_credit')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('c_type_credit', get_ctypes_list(), set_value('c_type_credit', $ds->credit_c_type), 'id="c_type_credit" class="text" ')?>
	<span id="credit_contragent"> 
	<?=gccontr(set_value('c_type_credit', $ds->credit_c_type), set_value('creditor_rid', $ds->creditor_rid))?>
	</span>
</div>

<div class="column span-4">
	<?=form_label(lang('DEBET'), '_currencies_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('c_type_debet', get_ctypes_list(), set_value('c_type_debet', $ds->debet_c_type), 'id="c_type_debet" class="text" ')?>
	<span id="debet_contragent">
	<?=gdcontr(set_value('c_type_debet', $ds->debet_c_type), set_value('debetor_rid', $ds->debetor_rid))?> 
	</span>
</div>


<div class="column span-4">
	<?=form_label(lang('SUM'), 'sum_value')?>
</div>
<div class="column span-8">
	<?=form_input('sum_value', set_value('sum_value', $ds->sum_value), 'id="sum_value" class="text" readonly="readonly" style="width: 50px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CURENCY'), '_currencies_rid')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" readonly="readonly" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('STATE'), '_account_states_rid')?>
</div>
<div class="column span-8">
	<?=form_dropdown('_account_states_rid', get_states_list(), set_value('_account_states_ridd', $ds->_account_states_rid), 'id="_account_states_rid" readonly="readonly" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('DATE'), 'oper_date')?>
</div>
<div class="column span-8 last">
	<?=form_input('oper_date', date_conv(set_value('oper_date', $ds->oper_date)), 'id="oper_date" class="text date-entry" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PAYMENT_TYPE'), 'payment_type')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('payment_type', get_payment_types(), set_value('payment_type', $ds->payment_type), 'id="payment_type" class="text" ')?>
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
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/journal/'.$ds->_documents_rid) ?>';" id="reset" name="reset">
</div>

</div>