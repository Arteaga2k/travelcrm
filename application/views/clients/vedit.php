<div class="grid fieldscontainer">
<script src="<?=base_url()?>public/js/ajaxupload.3.5.js" type="text/javascript"></script>
<h3><?=$title?></h3>
<?= form_open_multipart(get_currcontroller()."/vedit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
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
	<?=form_label(lang('L_NAME'), 'l_name')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME'), 'f_name')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-4 last">
	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text" style="width:100px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('L_NAME_LAT'), 'l_name_lat')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('l_name_lat', set_value('l_name_lat', $ds->l_name_lat), 'id="l_name_lat" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME_LAT'), 'f_name_lat')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('f_name_lat', set_value('f_name_lat', $ds->f_name_lat), 'id="f_name_lat" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CITIZENSHIP'), '_countries_rid')?> <font color="red">*</font>
</div>
<div class="column span-4 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" style="width: 150px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('SEX'), 'sex')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('sex', get_sex_list(), set_value('sex', $ds->sex), 'id="sex" class="text"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('BIRTHDAY'), 'birthday')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_input('birthday', set_value('birthday', $ds->birthday), 'id="birthday" class="text date-entry" readonly="readonly"')?>
	<script type="text/javascript">
		$('#birthday').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<div class="column span-4">
	<?=form_label(lang('NAL_NUM'), 'nal_number')?>
</div>
<div class="column span-20 last">
	<?=form_input('nal_number', set_value('nal_number', $ds->nal_number), 'id="nal_number" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CITY'), 'city_name')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=get_cities_vp(set_value('_cities_rid', $ds->_cities_rid))?>
</div>
<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?>
</div>
<div class="column span-8 last">
	<?=form_input('adress', set_value('adress', $ds->adress), 'id="adress" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES'), 'phones')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-8 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CARD_NUM'), 'card_num')?>
</div>
<div class="column span-20 last">
	<?=get_dcarts_vp(set_value('_dcarts_rid', $ds->_dcarts_rid))?>
</div>

<div style="clear: both;"></div>
<fieldset>
	<legend><?=lang('PASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('PASSP_SERIA'), 'passp_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('passp_seria', set_value('passp_seria', $ds->passp_seria), 'id="passp_seria" class="text" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_NUM'), 'passp_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('passp_num', set_value('passp_num', $ds->passp_num), 'id="passp_num" class="text" style="width:100px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_OUT'), 'passp_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('passp_out', set_value('passp_out', $ds->passp_out), 'id="passp_out" class="text" style="width:400px; height: 30px;"')?>
	</div>
</fieldset>

<fieldset>
	<legend><?=lang('FPASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_SERIA'), 'f_pass_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('f_pass_seria', set_value('f_pass_seria', $ds->f_pass_seria), 'id="f_pass_seria" class="text" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_NUM'), 'f_pass_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('f_pass_num', set_value('f_pass_num', $ds->f_pass_num), 'id="f_pass_num" class="text" style="width:100px;"')?>
	</div>

	<div class="column span-4">
		<?=form_label(lang('FPASSP_PERIOD'), 'f_pass_period')?>
	</div>
	<div class="column span-20 last">
		<?=form_input('f_pass_period', set_value('f_pass_period', $ds->f_pass_period), 'id="f_pass_period" class="text date-entry" readonly="readonly"')?>
		<script type="text/javascript">
			$('#f_pass_period').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		</script>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_OUT'), 'f_pass_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('f_pass_out', set_value('f_pass_out', $ds->f_pass_out), 'id="f_pass_out" class="text" style="width:400px; height: 30px;"')?>
	</div>
	
</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-12">
	<?=lang('UPLOAD_DESCR')?><br>
	<?=form_input('upload_descr', '', 'id="upload_descr" class="text" style="width:300px;"')?><br>
	<?=form_button('upload_btn', lang('UPLOAD'), 'class="button" id="upload_btn" style=""')?>
</div>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

<?= form_close(); ?>

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

function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	

$(document).ready(
		function(){
			new AjaxUpload('upload_btn', {
				action: '<?=site_url(get_currcontroller()."/addattach/go")?>',
				onSubmit: function() {
					this.setData({_clients_rid : "<?=$ds->rid?>", upload_descr:$('#upload_descr').val()});
				},
				onComplete: function(file, response) {
					$('#attaches').html(response);
					return;
				}
			});
		}
)	
</script>