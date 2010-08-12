<?if($res_list){?>
<?foreach($res_list as $country_rid=>$country_data){?>
	<?=form_hidden('_countries_rids[]', $country_rid)?>
	<?=$country_data['name']?>
	<?if(isset($country_data['curourts']) and is_array($country_data['curourts'])){?>
		(
			<?foreach($country_data['curourts'] as $curourt_rid=>$curourt_name){?>
				<?=form_hidden('_curourts_rids[]', $curourt_rid)?>
				<?=$curourt_name?>
				<a href="javascript: if(confirm('<?=lang('CUROURT_REMOVE_CONFIRM')?>')) list_processing('remove_curourt', '<?=$curourt_rid?>'); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a>
			<?}?>
		)
	<?} else {?>
		<a href="javascript: if(confirm('<?=lang('COUNTRY_REMOVE_CONFIRM')?>')) list_processing('remove_country', '<?=$country_rid?>'); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a>		
	<?}?>
	<br>
<?}?>
<?} else {?>
<?=lang('LIST_EMPTY')?>
<?}?>

