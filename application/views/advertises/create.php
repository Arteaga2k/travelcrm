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

			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		$('#bdate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		$('#edate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', ''))?>
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', ''))?>
<div class="column span-4">
	<?=form_button('recalc', lang('RECALC'), 'id="recalc" class="button"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>


<div class="column span-20 last">
</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
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