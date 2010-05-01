<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform"><div class="column span-4">	<?=form_label(lang('F_NAME'), 'f_name')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('F_NAME_LAT'), 'f_name_lat')?> <font color="red">*</font></div><div class="column span-8 lat">	<?=form_input('f_name_lat', set_value('f_name_lat', $ds->f_name_lat), 'id="f_name_lat" readonly="readonly" class="text"')?></div><div class="column span-4">	<?=form_label(lang('S_NAME'), 's_name')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('L_NAME_LAT'), 'l_name_lat')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('l_name_lat', set_value('l_name_lat', $ds->l_name_lat), 'id="l_name_lat" readonly="readonly" class="text"')?></div><div class="column span-4">	<?=form_label(lang('L_NAME'), 'l_name')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('BIRTHDAY'), 'birthday')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_input('birthday', set_value('birthday', $ds->birthday), 'id="birthday" class="text" readonly="readonly" style="width:90px;"')?></div><div class="column span-4">	<?=form_label(lang('BDATE'), 'bdate')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_input('bdate', set_value('bdate', $ds->bdate), 'id="bdate" class="text" readonly="readonly" style="width:90px;"')?></div><div class="column span-4">	<?=form_label(lang('EDATE'), 'edate')?></div><div class="column span-20 last">	<?=form_input('edate', set_value('edate', $ds->edate), 'id="edate" class="text" readonly="readonly" style="width:90px;"')?></div><div class="column span-4">	<?=form_label(lang('NAL_NUM'), 'nal_number')?></div><div class="column span-20">	<?=form_input('nal_number', set_value('nal_number', $ds->nal_number), 'id="nal_number" readonly="readonly" class="text" style="width: 150px;"')?></div><fieldset><legend><?=lang('CITIZEN_PASSPORT')?></legend><div class="column span-4">	<?=form_label(lang('PASSP_SERIA'), 'passp_seria')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('passp_seria', set_value('passp_seria', $ds->passp_seria), 'id="passp_seria" readonly="readonly" class="text" style="width: 50px;"')?></div><div class="column span-4">	<?=form_label(lang('PASSP_NUM'), 'passp_num')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('passp_num', set_value('passp_num', $ds->passp_num), 'id="passp_num" readonly="readonly" class="text" style="width: 150px;"')?></div></fieldset><fieldset><legend><?=lang('FOREIGN_PASSPORT')?></legend><div class="column span-4">	<?=form_label(lang('FPASSP_SERIA'), 'fpassp_seria')?></div><div class="column span-8">	<?=form_input('fpassp_seria', set_value('fpassp_seria', $ds->fpassp_seria), 'id="fpassp_seria" readonly="readonly" class="text" style="width: 50px;"')?></div><div class="column span-4">	<?=form_label(lang('FPASSP_NUM'), 'fpassp_num')?></div><div class="column span-8 last">	<?=form_input('fpassp_num', set_value('fpassp_num', $ds->fpassp_num), 'id="fpassp_num" readonly="readonly" class="text" style="width: 150px;"')?></div></fieldset><div class="column span-4">	<?=form_label(lang('EMAIL'), 'email')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_input('email', set_value('email', $ds->email), 'id="email" readonly="readonly" class="text" ')?></div>
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
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

</div>
<script type="text/javascript">
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>