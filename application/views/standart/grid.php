<div class="grid">

	<div class="column span-18"> 
		<h3><?=$title?></h3>
	</div>
	<div class="column span-6 last fr tr">
		<?=anchor_popup(get_currcontroller()."/help/go", lang('HELP'), array('title'=>lang('SELP'), 'id'=>"help_".get_currcontroller(),  'name'=>"sbtn_".get_currcontroller(),  'width'=>'950', 'height'=>'600', 'style'=>"font-weight: normal;"))?>
	</div>

<?=$find?>
<?if($this->session->flashdata('remove_success')===True){?>
<div class="success">
	<?=lang('REMOVE_SYSTEM_SUCCESS')?>
</div>
<?}?>
<?if($this->session->flashdata('remove_failed')===True){?>
<div class="error">
	<?=lang('REMOVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?= form_open(get_currcontroller()."/remove/go", array('id'=>'grid_'.$orid, 'autocomplete'=>'off'))?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="<?=count($fields)+2?>" class="tr tools">
			<div class="column span-12 tl controls">
				<?if(element('add_allow', $tools, null)) { ?>
					<input type="button" value="<?=lang('NEW_TOOL')?>" class="button" name="create_btn_<?=$orid?>" onclick="window.location='<?=site_url(get_currcontroller()."/create/go");?>'">
				<? } ?>
				<?if(element('delete_allow', $tools, null)) { ?>
					<input type="button" value="<?=lang('REMOVE_TOOL')?>" class="button" name="delete_btn_<?=$orid?>" id="delete_btn_<?=$orid?>">
				<? } ?>
			</div>
			<div class="column span-12 last" id="paging">
				<?=$paging?>
			</div>
		</td>
	</tr>
	<tr>
		<?if(element('delete_allow', $tools, null)) { ?>
		<td class="gridHeader" style="padding-left: 2px; white-space: nowrap;">
				<input type="checkbox" name="all" id="call" value="1">
		</td>
		<? } ?>
		<?foreach($fields as $key=>$field) { ?>
		<td class="gridHeader" width="<?=element('colwidth', $field, '')?>" style="white-space: nowrap;">
			<? if($field['sort']) { ?>
			<?=anchor(get_currcontroller().'/sort/'.$key, $field['label'], "title=\"".$field['label']."\"")?>
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
	<?$num_records = count($ds); $counter = 0; foreach($ds as $record) { $counter++;?>
	<tr class="dataRow<?=($counter == $num_records)?' last_row':''?>" ondblclick="javascript:window.location = '<?if(element('edit_allow', $tools, null)) { ?><?=site_url(get_currcontroller().'/edit/'.$record->rid)?><?}else{?><?=site_url(get_currcontroller().'/details/'.$record->rid)?><?}?>';">
		<?if(element('delete_allow', $tools, null)) { ?>
		<td>
			<input type="checkbox" name="row[]" value="<?=$record->rid?>" id="crow_<?=$record->rid?>">
		</td>
		<? } ?>
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
				<?=get_tool($key, $record->rid)?>
			<?}?>		
		</td>
	</tr>
	<?}?>
	<tr>
		<td colspan="<?=count($fields)+2?>" class="tr tools" id="paging" width="1%">
			<?=$paging?>
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
			$('#grid_<?=$orid?>').submit();
			return true;	
		} else {
			return false;
		}
	});	
})
</script>