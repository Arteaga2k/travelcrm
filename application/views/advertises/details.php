<div class="grid firldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<fieldset>	<legend><?=lang('DOCUMENT')?></legend>	<div class="column span-4">		<?=form_label('Id', 'rid')?>	</div>	<div class="column span-20 last">		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text part"')?>	</div>	<div class="column span-4">		<?=form_label(lang('DATE_DOC'), 'date_doc')?>	</div>	<div class="column span-20 last">		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text date-entry" readonly="readonly"')?>	</div>	</fieldset>
<div class="column span-4">	<?=form_label(lang('BDATE'), 'bdate')?></div><div class="column span-20 last">	<?=form_input('bdate', date_conv(set_value('bdate', $ds->bdate)), 'id="bdate" class="text date-entry" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('EDATE'), 'edate')?></div><div class="column span-20 last">	<?=form_input('edate', date_conv(set_value('edate', $ds->edate)), 'id="edate" class="text date-entry" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('COMPANY'), 'company_name')?></div><div class="column span-20 last">	<?=form_input('company_name', get_companyname_byrid(set_value('_advertisescompanies_rid', $ds->_advertisescompanies_rid)), 'id="company_name" class="text part-5" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('SOURCE'), 'source_name')?></div><div class="column span-20 last">	<?=form_input('source_name', get_sourcename_byrid(set_value('_advertisessources_rid', $ds->_advertisessources_rid)), 'id="source_name" class="text part-5" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('SUM'), 'sum')?></div><div class="column span-20 last">	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text part"')?>
</div><div class="column span-4">	<?=form_label(lang('CURRENCY'), '_currencies_rid')?></div><div class="column span-20 last">	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" readonly="readonly" class="text part-3"')?></div><div class="column span-24 last"  id="rows_body">
<?=$rows_body?>
</div>

<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
<div class="column span-4">
	<?=form_label(lang('ORDER_SUM'), 'order_sum')?>
</div>
<div class="column span-20 last">
	<?=form_input('order_sum', set_value('order_sum', $ds->order_sum), 'id="order_sum" class="text part" readonly="readonly"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ORDER_NUM'), 'order_num')?>
</div>
<div class="column span-20 last">
	<?=form_input('order_num', set_value('order_num', $ds->order_num), 'id="order_num" class="text part-3" readonly="readonly"')?>
</div>	

<div class="column span-4">
	<?=form_label(lang('ORDER_DATE'), 'order_date')?>
</div>
<div class="column span-20 last">
	<?=form_input('order_date', date_conv(set_value('order_date', $ds->order_date)), 'id="order_date" class="text date-entry" readonly="readonly"')?>
</div>	
	<?=get_doc_balance($ds->rid)?>
	<?=anchor_popup(site_url('finjournal/journal/'.$ds->rid), lang('SHOW_FIN_OPERS'), array('title'=>lang('SHOW_FIN_OPERS'), 'id'=>"sbtn_cities_rid",  'name'=>"sbtn_clients_rid",  'width'=>'950', 'height'=>'600'))?>
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
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" readonly="readonly" class="text"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:300px; height: 50px;"')?>
</div>
</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>
<script type="text/javascript">
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
			$('#all_filials').click(function(){
				if($('#all_filials').attr('checked')){
					$('#rows_body').hide('slow');
				} else $('#rows_body').show('slow');
			});
			$('#recalc').click(function(){
				var dataStr = 'rows_action=recalc&'+$('#sum').val()+'&'+$("input[name='f_sum']").serialize()+'&'+$("input[name='_filials_rid']").serialize()+'&'+$("input[name='f_rid[]']").serialize()+'&'+$("input[name='row_sum[]']").serialize();
				if(confirm('<?=lang('CONFIRM_RECALC')?>')){
					$.ajax({
						type: "POST",
						url: "<?=site_url(get_currcontroller()."/recalc/go")?>",
						data: dataStr,
						success: function(msg){
							$('#sum').val(msg);
						}
					});
					return true;
				}
				return false;
			});
		}
)	
</script>
