<div id="synonims_list" class="column span-24 last" style="font-style: italic;">
	<?if(validation_errors() && isset($add_oper)){?>
	<div class="error">
		<?=validation_errors('<div>', '</div>');?>
	</div>	
	<?}?>
	
	<? foreach($synonims_list as $synonim) { ?>
		<?=$synonim->hotel_name?>&nbsp;&nbsp;&nbsp;
		<?if(!@$readonly) {?>
			<a href="javascript: if(confirm('<?=lang('HOTEL_REMOVE_CONFIRM')?>')) remove_synonim(<?=$synonim->rid?>); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a>
		<? } ?>
		<br>
	<? } ?>
</div>
