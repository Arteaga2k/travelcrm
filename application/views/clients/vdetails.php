<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('L_NAME'), 'l_name')?>
</div>
<div class="column span-4">
	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text" readonly="readonly" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME'), 'f_name')?>
</div>
<div class="column span-4">
	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text" readonly="readonly" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-4 last">
	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text" readonly="readonly" style="width:100px;"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('L_NAME_LAT'), 'l_name_lat')?>
</div>
<div class="column span-4">
	<?=form_input('l_name_lat', set_value('l_name_lat', $ds->l_name_lat), 'id="l_name_lat" class="text" readonly="readonly" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME_LAT'), 'f_name_lat')?>
</div>
<div class="column span-4">
	<?=form_input('f_name_lat', set_value('f_name_lat', $ds->f_name_lat), 'id="f_name_lat" class="text" readonly="readonly" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CITIZENSHIP'), '_countries_rid')?>
</div>
<div class="column span-4 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" readonly="readonly"  style="width: 150px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('SEX'), 'sex')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('sex', get_sex_list(), set_value('sex', $ds->sex), 'id="sex" readonly="readonly" class="text"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('BIRTHDAY'), 'birthday')?>
</div>
<div class="column span-20 last">
	<?=form_input('birthday', set_value('birthday', $ds->birthday), 'id="birthday" class="text date-entry" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('NAL_NUM'), 'nal_number')?>
</div>
<div class="column span-20 last">
	<?=form_input('nal_number', set_value('nal_number', $ds->nal_number), 'id="nal_number" readonly="readonly"  class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CITY'), 'city_name')?>
</div>
<div class="column span-8">
	<?=form_input('city_name', get_city_name_byrid(set_value('_cities_rid', $ds->_cities_rid)), 'id="city_name" class="text" readonly="readonly" style="width:100px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ADRESS'), 'adress')?>
</div>
<div class="column span-8 last">
	<?=form_input('adress', set_value('adress', $ds->adress), 'id="adress" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES'), 'phones')?>
</div>
<div class="column span-8">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" readonly="readonly" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-8 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" readonly="readonly" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CARD_NUM'), 'card_num')?>
</div>
<div class="column span-20 last">
	<?=form_input('card_num', set_value('card_num', get_dcartnum_byrid($ds->_dcarts_rid)), 'id="card_num" class="text" readonly="readonly" style="width:80px;"')?>
</div>

<div style="clear: both;"></div>
<fieldset>
	<legend><?=lang('PASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('PASSP_SERIA'), 'passp_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('passp_seria', set_value('passp_seria', $ds->passp_seria), 'id="passp_seria" class="text" readonly="readonly" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_NUM'), 'passp_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('passp_num', set_value('passp_num', $ds->passp_num), 'id="passp_num" class="text" readonly="readonly" style="width:100px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('PASSP_OUT'), 'passp_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('passp_out', set_value('passp_out', $ds->passp_out), 'id="passp_out" class="text" readonly="readonly" style="width:400px; height: 30px;"')?>
	</div>
</fieldset>

<fieldset>
	<legend><?=lang('FPASSP_INFO')?></legend>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_SERIA'), 'f_pass_seria')?>
	</div>
	<div class="column span-8">
		<?=form_input('f_pass_seria', set_value('f_pass_seria', $ds->f_pass_seria), 'id="f_pass_seria" class="text" readonly="readonly" style="width:30px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_NUM'), 'f_pass_num')?>
	</div>
	<div class="column span-8 last">
		<?=form_input('f_pass_num', set_value('f_pass_num', $ds->f_pass_num), 'id="f_pass_num" class="text" readonly="readonly" style="width:100px;"')?>
	</div>

	<div class="column span-4">
		<?=form_label(lang('FPASSP_PERIOD'), 'f_pass_period')?>
	</div>
	<div class="column span-20 last">
		<?=form_input('f_pass_period', set_value('f_pass_period', $ds->f_pass_period), 'id="f_pass_period" class="text date-entry" readonly="readonly"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('FPASSP_OUT'), 'f_pass_out')?>
	</div>
	<div class="column span-20 last">
		<?=form_textarea('f_pass_out', set_value('f_pass_out', $ds->f_pass_out), 'id="f_pass_out" class="text" readonly="readonly" style="width:400px; height: 30px;"')?>
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
			<?=form_dropdown('_clients_interests['.$interest->rid.']', get_interests_levels(), element($interest->rid, $this->input->post('_clients_interests'), element($interest->rid, get_client_interests($rid), null)), 'id="_clients_interests_'.$interest->rid.'" readonly="readonly"')?>
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
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
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