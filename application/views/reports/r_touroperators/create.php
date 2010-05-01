<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/run/go", array('id'=>'run_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<div class="column span-3">
	<?=form_label(lang('DATE_REPORT_FROM').required_field(), 'date_report_from')?>
</div>
<div class="column span-21">
	<?=form_input('date_report_from', set_value('date_report_from', ''), 'id="date_report_from" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_report_from').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>
<div class="column span-3">
	<?=form_label(lang('DATE_REPORT_TO').required_field(), 'date_report_to')?>
</div>
<div class="column span-21">
	<?=form_input('date_report_to', set_value('date_report_to', ''), 'id="date_report_to" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_report_to').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>
<div class="column span-3">
	<?=form_label(lang('FILIAL'), 'filial_name')?>
</div>
<div class="column span-21 last">
	<?=get_filials_vp(set_value('_filials_rid', null), '_filials_rid', 'filial_name', False)?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>
</div>
<? if(isset($ds)) { ?>
<div class="container" style="margin-top: 20px;">
<h5><?=$r_body_title?></h5>
	<table>
		<thead>
			<tr>
				<th>
					<?=lang('TOUROPERATOR')?>
				</th>
				<th>
					<?=lang('COUNTRY')?>
				</th>
				<th>
					<?=lang('TOURISTS_QUAN')?>
				</th>
				<th>
					<?=lang('SUM')?>
				</th>
				<th>
					<?=lang('DOXOD')?>
				</th>
			</tr>
		</thead>
		<? $curr_to_rid = null; 
		$total_tourists = $total_sum = $total_doxod = 0;  
		$to_tourists = $to_sum = $to_doxod = 0;
		foreach($ds as $r) { 
			$total_tourists += $r->tourists_quan; 
			$total_sum += $r->oborot; 
			$total_doxod += $r->doxod;
		?>
		<? if($r->touroperator_rid!=$curr_to_rid && $curr_to_rid) { ?>
		<tr>
			<td>
					
			</td>
			<td>
				
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_tourists?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_sum?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_doxod?>
			</td>
		</tr>
		<? 
			$to_tourists = 0;
			$to_sum = 0;
			$to_doxod = 0;
		}  else {
			$to_tourists += $r->tourists_quan;
			$to_sum += $r->oborot;
			$to_doxod += $r->doxod;
		}?>
		<tr>
			<td>
				<? if($r->touroperator_rid!=$curr_to_rid){
						$curr_to_rid = $r->touroperator_rid;
						$to_tourists = $r->tourists_quan;
						$to_sum = $r->oborot;
						$to_doxod = $r->doxod;
						echo $r->stouroperator_name;
					} else echo ''?>
			</td>
			<td>
				<?=$r->country_name?>
			</td>
			<td>
				<?=$r->tourists_quan?>
			</td>
			<td>
				<?=$r->oborot?>
			</td>
			<td>
				<?=$r->doxod?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<td>
					
			</td>
			<td>
				
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_tourists?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_sum?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$to_doxod?>
			</td>
		</tr>

		<tr style="background-color: #cccccc;">
			<td style="font-weight: bold;">
				<?=lang('RES');?>					
			</td>
			<td>
				
			</td>
			<td style="font-weight: bold;">
				<?=$total_tourists?>
			</td>
			<td style="font-weight: bold;">
				<?=ROUND($total_sum, 2)?>
			</td>
			<td style="font-weight: bold;">
				<?=ROUND($total_doxod, 2)?>
			</td>
		</tr>
		
	</table>	
</div>
<? } ?>
