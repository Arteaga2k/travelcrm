<div class="container">
	<div class="column span-10 prepend-7 append-7 last " style="margin-top: 80px;">	
	<fieldset class="login">
	<legend><?=lang('LOGIN_CHPASS_TITLE'); ?></legend>
	<div class="notice">
	<?=sprintf(lang('LOGIN_CHPASS_DESCR'), '<em>'.get_curr_uname().'</em>'); ?>
	</div>

	<div class="error">
	<?=lang('M1_ERROR_CHANGE_PASSWD')?>
	</div>
	<?=anchor('welcome', lang('M1_BUTTON_CONTINUE_VALUE'))?><br>
	</fieldset>
	</div>
</div>

