<fieldset>
<legend><?=lang('DOC_BODY')?></legend>
<?if(validation_errors() && @$rows_action){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>

	<?if($rows) {?>
	<div class="column span-24 last" id="doc_body">
		<table style="width:100%;border: none;" id="rows">
			<tr>
				<th style="width: 5%;">
					#
				</th>
				<th style="width: 35%;">
					<?=lang('FILIAL')?>
				</th>
				<th style="width: 35%;">
					<?=lang('SUM')?>
				</th>
				<th style="width: 25%;">
				</th>
			</tr>
			<? foreach($rows as $key=>$r) {?>
			<tr id="row_<?=$key+1?>">
				<td><?=$key+1?></td>
				<td><?=get_filial_name_byrid($r['filial'])?><?=form_hidden('f_rid[]', $r['filial'])?></td>
				<td><?=form_input('row_sum[]', $r['sum'], 'class="text" style="width: 50px;"')?></td>
				<td>
					<a href="javascript: if(confirm('<?=lang('FILIAL_REMOVE_CONFIRM')?>')) removerow(<?=$r['filial']?>); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
	</div>
	<? } ?>

<div class="column span-4">
	<?=form_label(lang('FILIAL').required_field(), 'filial_name')?>
</div>
<div class="column span-10">
	<?=get_filials_vp(set_value('_filials_rid', ''))?>
</div>

<div class="column span-10 last">
	<?=form_button('all_filials', lang('ALL_FILIALS'), 'id="all_filials" class="button"')?>
</div>

<div class="clear"></div>

<div class="column span-4">
	<?=form_label(lang('SUM'), 'f_sum')?>
</div>

<div class="column span-10">
	<?=form_input('f_sum', set_value('f_sum', ''), 'id="f_sum" class="text part-2"')?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?=form_button('add_row', lang('ADD_BTN'), 'id="add_row" class="button"')?>
</div>

<div class="column span-10 last">
	<?=form_button('prop', lang('PROP'), 'id="prop" class="button"')?>
</div>

</fieldset>

<script type="text/javascript">
function removerow(frid){
	var dataStr = 'rows_action='+frid+'&'+$("input[name='f_sum']").serialize()+'&'+$("input[name='_filials_rid']").serialize()+'&'+$("input[name='f_rid[]']").serialize()+'&'+$("input[name='row_sum[]']").serialize();
	$.ajax({
		type: "POST",
		url: "<?=site_url(get_currcontroller()."/removerow/go")?>",
		data: dataStr,
		success: function(msg){
			$('#rows_body').html(msg);
		}
	});
}				
$(document).ready(
		function(){
			function addrow(){
				var dataStr = 'rows_action=add'+'&'+$("input[name='f_sum']").serialize()+'&'+$("input[name='_filials_rid']").serialize()+'&'+$("input[name='f_rid[]']").serialize()+'&'+$("input[name='row_sum[]']").serialize();
				$.ajax({
					type: "POST",
					url: "<?=site_url(get_currcontroller()."/addrow/go")?>",
					data: dataStr,
					success: function(msg){
						$('#_filials_rid').val('');
						$('#f_sum').val('');
						$('#rows_body').html(msg);
					}
				});
			}

			function allfilials(){
				if(confirm('<?=lang('CONFIRM_ALL_FILIALS')?>')){
				$.ajax({
					type: "POST",
					url: "<?=site_url(get_currcontroller()."/allfilials/go")?>",
					data: {},
					success: function(msg){
						$('#rows_body').html(msg);
					}
				});
				return true;
				}
				return false;
			}
			
			function prop(){
				var dataStr = 'rows_action=prop&sum='+$('#sum').val()+'&'+$("input[name='f_sum']").serialize()+'&'+$("input[name='_filials_rid']").serialize()+'&'+$("input[name='f_rid[]']").serialize()+'&'+$("input[name='row_sum[]']").serialize();
				if(confirm('<?=lang('CONFIRM_PROP')?>')){
				$.ajax({
					type: "POST",
					url: "<?=site_url(get_currcontroller()."/prop/go")?>",
					data: dataStr,
					success: function(msg){
						$('#rows_body').html(msg);
					}
				});
				return true;
				}
				return false;
			}

			$('#add_row').click(function(){ 
				addrow(); 
			});
			$('#all_filials').click(function(){ 
				allfilials(); 
			});		
			$('#prop').click(function(){ 
				prop(); 
			});		
					
		}
)	
</script>

