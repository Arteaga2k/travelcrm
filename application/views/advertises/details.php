<div class="grid firldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<fieldset>

</div>
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