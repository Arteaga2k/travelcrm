<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vmove/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
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
	<?=form_label(lang('NEW_OWNER'), '_employeers_rid')?>
</div>
<div class="column span-20">
	<?=get_employeers_vp(set_value('_employeers_rid', get_emprid_byurid($ds->owner_users_rid)))?>
</div>
</div>

<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()).'/vjournal/go/' ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
