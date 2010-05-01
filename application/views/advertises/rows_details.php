<fieldset>
<legend><?=lang('DOC_BODY')?></legend>
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
				</td>
			</tr>
			<? } ?>
		</table>
	</div>
	<? } ?>

</fieldset>
