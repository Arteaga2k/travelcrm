<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/create/{$doc_rid}", array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
<?=form_hidden('_documents_rid', $doc_rid) ?>
<div class="container editform">
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

<div class="column span-4">
	<?=form_label(lang('CREDIT'), 'c_type_credit')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('c_type_credit', get_ctypes_list(), set_value('c_type_credit', ''), 'id="c_type_credit" class="text" ')?>
	<span id="credit_contragent"> 
	<?=gccontr(set_value('c_type_credit', ''), set_value('creditor_rid', ''))?>
	</span>
</div>

<div class="column span-4">
	<?=form_label(lang('DEBET'), '_currencies_rid')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('c_type_debet', get_ctypes_list(), set_value('c_type_debet', ''), 'id="c_type_debet" class="text" ')?>
	<span id="debet_contragent">
	<?=gdcontr(set_value('c_type_debet', ''), set_value('debetor_rid', ''))?> 
	</span>
</div>


<div class="column span-4">
	<?=form_label(lang('SUM'), 'sum_value')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('sum_value', set_value('sum_value', '0'), 'id="sum_value" class="text" style="width: 50px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CURENCY'), '_currencies_rid')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', ''), 'id="_currencies_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('STATE'), '_account_states_rid')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_dropdown('_account_states_rid', get_states_list(), set_value('_account_states_rid', ''), 'id="_account_states_rid" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('DATE'), 'oper_date')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('oper_date', date_conv(set_value('oper_date', '')), 'id="oper_date" class="text date-entry"')?>
	<script type="text/javascript">
		$('#oper_date').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<div class="column span-4">
	<?=form_label(lang('PAYMENT_TYPE'), 'payment_type')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('payment_type', get_payment_types(), set_value('payment_type', ''), 'id="payment_type" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/journal/'.$doc_rid) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
<script type="text/javascript">
$(document).ready(
		function(){
			$('#c_type_credit').change(function(){
				var query_string = 'c_type_credit='+$('#c_type_credit').val();
				$.ajax({
					type: 'POST',
					url: "<?=site_url(get_currcontroller()."/gccontr/go")?>",
					data: query_string,
					success: function(html){
						$('#credit_contragent').html(html);
						return;
					} 
				});
			});
			$('#c_type_debet').change(function(){
				var query_string = 'c_type_debet='+$('#c_type_debet').val();
				$.ajax({
					type: 'POST',
					url: "<?=site_url(get_currcontroller()."/gdcontr/go")?>",
					data: query_string,
					success: function(html){
						$('#debet_contragent').html(html);
						return;
					} 
				});
			});
		}
)	
</script>
