<div class="grid fieldscontainer">
<script src="<?=base_url()?>public/js/ajaxupload.3.5.js" type="text/javascript"></script>
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vedit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
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
	<?=form_label(lang('NAME').required_field(), 'hotel_name')?>
</div>
<div class="column span-8">
	<?=form_input('hotel_name', set_value('hotel_name', $ds->hotel_name), 'id="hotel_name" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('HOTELCAT').required_field(), '_hotelscats_rid')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_hotelscats_rid', get_hotelscats_list(), set_value('_hotelscats_rid', $ds->_hotelscats_rid), 'class="text" id="_hotelscats_rid"')?>
</div>


<div class="column span-4">
	<?=form_label(lang('COUNTRY').required_field(), '_countries_rid')?>
</div>
<div class="column span-8">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CUROURT'), '_curourts_rid')?>
</div>
<div class="column span-8 last">
	<?=get_curourts_vp(set_value('_curourts_rid', $ds->_curourts_rid))?>
</div>

<fieldset>
	<legend><?=lang('SYNONIMS')?></legend>
	
	<div class="column span-4">
		<?=form_label(lang('SYNONIM'), 'synonim')?>
	</div>
	<div class="column span-12">
		<?=form_input('synonim', set_value('synonim', null), 'id="synonim" class="text part-5"')?>
		<?=form_button('add_synonim', lang('ADD_BTN'), 'class="button" id="add_synonim" ')?>
	</div>
	<div class="column span-8 last">
		<?=$synonims_obj?>
	</div>
</fieldset>

<fieldset>
<legend><?=lang('PHOTOS')?></legend>
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
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}
function add_synonim(){
	$.ajax({
		type: 'POST',
		url: "<?=site_url(get_currcontroller()."/add_synonim")?>",
		data: {hotel_name: $('#synonim').val(), _hotels_rid: '<?=$rid?>'},
		success: function(html){
			$('#synonims_list').html(html);
		}
	});
}

function remove_synonim(rid){
	$.ajax({
		type: 'POST',
		url: "<?=site_url(get_currcontroller()."/remove_synonim")?>",
		data: {rid: rid, _hotels_rid: '<?=$rid?>'},
		success: function(html){
			$('#synonims_list').html(html);
		}
	});
}

function attach_remove(rid){
	$.ajax({
		type:'POST',
		url: '<?=site_url(get_currcontroller()."/removeattach/go")?>',
		data:{rid:rid, _hotels_rid:"<?=$ds->rid?>"},
		success: function(html){
			$('#attaches').html(html);
			return;
		}
	});
}

$(document).ready(
	function(){
		$('#add_synonim').click(function(){
			add_synonim();
		});

		new AjaxUpload('upload_btn', {
			action: '<?=site_url(get_currcontroller()."/addattach/go")?>',
			onSubmit: function() {
				this.setData({_hotels_rid : "<?=$ds->rid?>", upload_descr:$('#upload_descr').val()});
			},
			onComplete: function(file, response) {
				$('#attaches').html(response);
				return;
			}
		});
		
	}
)
</script>