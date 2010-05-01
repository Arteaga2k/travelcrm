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
<fieldset>	<legend><?=lang('DOCUMENT')?></legend>	<div class="column span-4">		<?=form_label(lang('DATE_DOC').required_field(), 'date_doc')?>	</div>	<div class="column span-20 last">		<?=form_input('date_doc', date_conv(set_value('date_doc', date('Y-m-d'))), 'id="date_doc" class="text date-entry"')?>		<script type="text/javascript">
			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});		</script>	</div>	</fieldset><div class="column span-4">	<?=form_label(lang('BDATE').required_field(), 'bdate')?></div><div class="column span-20 last">	<?=form_input('bdate', date_conv(set_value('bdate', '')), 'id="bdate" class="text date-entry"')?>	<script type="text/javascript">
		$('#bdate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});	</script></div><div class="column span-4">	<?=form_label(lang('EDATE'), 'edate')?></div><div class="column span-20 last">	<?=form_input('edate', date_conv(set_value('edate', '')), 'id="edate" class="text date-entry"')?>	<script type="text/javascript">
		$('#edate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});	</script></div><div class="column span-4">	<?=form_label(lang('COMPANY').required_field(), 'company_name')?></div><div class="column span-20 last">
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', ''))?></div><div class="column span-4">	<?=form_label(lang('SOURCE').required_field(), 'source_name')?></div><div class="column span-20 last">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', ''))?></div>
<div class="column span-4">	<?=form_label(lang('SUM').required_field(), 'sum')?></div><div class="column span-20">	<?=form_input('sum', set_value('sum', '0.00'), 'id="sum" class="text" style="width:50px;"')?>
	<?=form_button('recalc', lang('RECALC'), 'id="recalc" class="button"')?></div><div class="column span-4">	<?=form_label(lang('CURRENCY').required_field(), '_currencies_rid')?></div><div class="column span-20 last">	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', null), 'id="_currencies_rid" class="text"')?></div><div class="column span-24 last" id="rows_body"><?=$rows_body?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

<div class="column span-4">	<?=form_label(lang('DESCR'), 'descr')?></div>
<div class="column span-20 last">	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?></div>
</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div><script type="text/javascript">$(document).ready(		function(){			$('#all_filials').click(function(){				if($('#all_filials').attr('checked')){					$('#rows_body').hide('slow');				} else $('#rows_body').show('slow');			});
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
		})	</script>