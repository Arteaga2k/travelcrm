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
<div class="column span-4">
		$('#birthday').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});


<div class="column span-4">
</div>