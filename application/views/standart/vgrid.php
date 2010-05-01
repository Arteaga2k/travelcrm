<div class="grid">
<h3><?=$title?></h3>
<?=$find?>
<?if($this->session->flashdata('vremove_success')===True){?>
<div class="success">
	<?=lang('REMOVE_SYSTEM_SUCCESS')?>
</div>
<?}?>
<?if($this->session->flashdata('vremove_failed')===True){?>
<div class="error">
	<?=lang('REMOVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?= form_open(get_currcontroller()."/vremove/go", array('id'=>'vgrid_'.$orid, 'autocomplete'=>'off'))?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="<?=count($fields)+2?>" style="text-align: right;background-color: #f6f6f6;">
			<div class="column span-12" style="text-align: left;padding-top:3px;">
				<?if(element('add_allow', $tools, null)) { ?>
					<input type="button" value="<?=lang('NEW_TOOL')?>" class="button" name="create_btn_<?=$orid?>" onclick="window.location='<?=site_url(get_currcontroller()."/vcreate/go");?>'">
				<? } ?>
				<?if(element('delete_allow', $tools, null)) { ?>
					<input type="button" value="<?=lang('REMOVE_TOOL')?>" class="button" name="delete_btn_<?=$orid?>" id="delete_btn_<?=$orid?>">
				<? } ?>
			</div>
			<div class="column span-12 last">
				<div id="paging"><?=$paging?></div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="gridHeader" style="padding-left: 2px; white-space: nowrap;">
			<?if(element('delete_allow', $tools, null)) { ?>
				<input type="checkbox" name="all" id="call" value="1">
			<? } ?> 
		</td>
		<?foreach($fields as $key=>$field) { ?>
		<td class="gridHeader" width="<?=element('colwidth', $field, '')?>" style="white-space: nowrap;">
			<? if($field['sort']) { ?>
			<?=anchor(get_currcontroller().'/vsort/'.$key, $field['label'], "title=\"".$field['label']."\"")?>
			&nbsp;&nbsp;&nbsp;
			<? if(element('c', $sort, null)==$key) { ?>
				<? if(element('r', $sort, null)=='ASC') { ?>
					<?=img('public/css/images/icons/arrow_down.gif')?>
				<? } else {?>
					<?=img('public/css/images/icons/arrow_up.gif')?>
				<? } ?>
			<? } else {?>
				<?=img('public/css/images/icons/arrow.gif')?>
			<? } ?>
			<? }else{ ?>
			<?=$field['label']?>
			<? } ?>
		</td>
		<?}?>
		<td class="gridHeader">
			&nbsp;
		</td>
	</tr>
	<?foreach($ds as $record) { ?>
	<tr class="dataRow" ondblclick="joinToParent('<?=$record->$jtp['val']?>', '<?=$record->$jtp['scr']?>')">
		<td>
			<?if(element('delete_allow', $tools, null)) { ?>
				<input type="checkbox" name="row[]" value="<?=$record->rid?>" id="crow_<?=$record->rid?>">
			<? } ?> 
		</td>
		<?foreach($fields as $key=>$field) {?>
		<td style="<?=element('style', $field, '')?>">
			<?=get_valtype($record->$key, element('type', $field, ''))?> 
		</td>
		<?}?>
		<td nowrap="nowrap">
			
			<?
				foreach($tools as $key=>$val) {
					if(!$val) continue;
					# хак для заархивированных записей 
					if($record->archive && !element('archive_allow', $tools, null) && $key!='details_allow') {
						continue;
					} 
			?>
				<?=get_tool($key, $record->rid, 1)?>
			<?}?>		
					
		</td>
	</tr>
	<?}?>
	<tr>
		<td colspan="<?=count($fields)+2?>" style="text-align: right;background-color: #f6f6f6;">
			<div class="column span-12" style="text-align: left;padding-top:3px;">
				&nbsp;			
			</div>
			<div class="column span-12 last">
				<div id="paging"><?=$paging?><br></div>
			</div>
		</td>
	</tr>
</table>
<?=form_close();?>
</div>
<script type="text/javascript">
$(document).ready(function (){
	$('#call').click(function (){
       $("[name='row[]']").each( function() {
           $(this).attr('checked', !$(this).attr('checked'));
       });
	});
	$('#delete_btn_<?=$orid?>').click(function(){
		if(confirm('<?=lang('CONFIRM_DEL')?>')){
			$('#vgrid_<?=$orid?>').submit();
			return true;	
		} else {
			return false;
		}
	});	
})
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>