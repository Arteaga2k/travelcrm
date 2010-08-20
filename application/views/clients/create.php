<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/create/go", array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
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
	<?=form_label(lang('L_NAME'), 'l_name')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('l_name', set_value('l_name', ''), 'id="l_name" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME'), 'f_name')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('f_name', set_value('f_name', ''), 'id="f_name" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-4 last">
	<?=form_input('s_name', set_value('s_name', ''), 'id="s_name" class="text" style="width:100px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('L_NAME_LAT'), 'l_name_lat')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('l_name_lat', set_value('l_name_lat', ''), 'id="l_name_lat" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME_LAT'), 'f_name_lat')?> <font color="red">*</font>
</div>
<div class="column span-4">
	<?=form_input('f_name_lat', set_value('f_name_lat', ''), 'id="f_name_lat" class="text" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CITIZENSHIP'), '_countries_rid')?> <font color="red">*</font>
</div>
<div class="column span-4 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', ''), 'id="_countries_rid" class="text" style="width: 150px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('SEX'), 'sex')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('sex', get_sex_list(), set_value('sex', ''), 'id="sex" class="text"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('BIRTHDAY'), 'birthday')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_input('birthday', set_value('birthday', ''), 'id="birthday" class="text date-entry" readonly="readonly"')?>
	<script type="text/javascript">
		$('#birthday').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<div class="column span-4">
	<?=form_label(lang('NAL_NUM'), 'nal_number')?>
</div>
<div class="column span-20 last">
	<?=form_input('nal_number', set_value('nal_number', ''), 'id="nal_number" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CITY'), 'city_name')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=get_cities_vp(set_value('_cities_rid', null))?>
</div>
<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?>
</div>
<div class="column span-8 last">
	<?=form_input('adress', set_value('adress', ''), 'id="adress" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES'), 'phones')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('phones', set_value('phones', ''), 'id="phones" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-8 last">
	<?=form_input('email', set_value('email', ''), 'id="email" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CARD_NUM'), 'card_num')?>
</div>
<div class="column span-20 last">
	<?=get_dcarts_vp(set_value('_dcarts_rid', null))?>
</div>

<div style="clear: both;"></div>
<fieldset>
	<legend><?=lang('PASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('PASSP_SERIA'), 'passp_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('passp_seria', set_value('passp_seria', ''), 'id="passp_seria" class="text" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_NUM'), 'passp_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('passp_num', set_value('passp_num', ''), 'id="passp_num" class="text" style="width:100px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_OUT'), 'passp_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('passp_out', set_value('passp_out', ''), 'id="passp_out" class="text" style="width:400px; height: 30px;"')?>
	</div>
</fieldset>

<fieldset>
	<legend><?=lang('FPASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_SERIA'), 'f_pass_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('f_pass_seria', set_value('f_pass_seria', ''), 'id="f_pass_seria" class="text" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_NUM'), 'f_pass_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('f_pass_num', set_value('f_pass_num', ''), 'id="f_pass_num" class="text" style="width:100px;"')?>
	</div>

	<div class="column span-4">
		<?=form_label(lang('FPASSP_PERIOD'), 'f_pass_period')?>
	</div>
	<div class="column span-20 last">
		<?=form_input('f_pass_period', set_value('f_pass_period', ''), 'id="f_pass_period" class="text date-entry" readonly="readonly"')?>
		<script type="text/javascript">
			$('#f_pass_period').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		</script>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_OUT'), 'f_pass_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('f_pass_out', set_value('f_pass_out', ''), 'id="f_pass_out" class="text" style="width:400px; height: 30px;"')?>
	</div>
	
</fieldset>

<fieldset>
	<legend><?=lang('INTERESTS_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('CLIENTS_INTERESTS'), '_clients_interests')?>
	</div>
	<div class="column span-20 last">
		<?foreach(get_interests() as $interest){?>
		<div class="column span-10">
			<?=form_label($interest->interests_name, '_clients_interests['.$interest->rid.']')?>
			<?=($interest->descr?('<br><em>('.$interest->descr.')</em>'):'')?>
			
		</div>
		<div class="column span-10 last">
			<?=form_dropdown('_clients_interests['.$interest->rid.']', get_interests_levels(), element($interest->rid, $this->input->post('_clients_interests'), null, 'id="_clients_interests_'.$interest->rid.'"'))?>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#_clients_interests_<?=$interest->rid?>").jSlider({});
			});			
			</script>
		</div>
		<div class="clear"></div>
		<?}?>
	</div>
	
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
