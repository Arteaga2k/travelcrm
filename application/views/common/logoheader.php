<div class="container logoheader">
	<div class="column span-8">		
		<?=img(array('src'=>'public/img/logos/travelcrm_md.png', 'border'=>'0'))?>
	</div>
	<div class="column span-8" style="text-align: right;">
		<b><?=lang('CURRENT_USER')?></b> <em><?=get_curr_uname()?></em>
		<br/>
		<b><?=lang('CURRENT_FILIAL')?> / <?=lang('CURRENT_POSITION')?></b> <em><?=get_curr_filname()?></em> / <em><?=get_curr_pname()?></em>
	</div>
	<div class="column span-8 last" style="text-align: right; float: right;">
		<div class="column span-5" style="text-align: right;text-align: center;">
			<?=anchor('language/russian', img('public/img/flags/ru.gif'))?>
			<?=anchor('language/english', img('public/img/flags/us.gif'))?>
			<?=anchor('language/latvian', img('public/img/flags/lv.gif'))?>
		</div>
		<div class="column span-3 last" style="text-align: right; float: right; margin: 0px;">	
			<?=anchor('login/logout', lang('EXIT'), 'onclick="return confirm(\''.lang('CONFIRM_EXIT').'\');"')?>
		</div>
	</div>
</div>
