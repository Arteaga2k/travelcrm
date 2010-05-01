<div class="container">
	<div class="column span-10 prepend-7 append-7 last " style="margin-top: 80px;">	
	<fieldset class="login">
	<legend><?=lang('LOGIN_CHPASS_TITLE'); ?></legend>
	<div class="notice">
	<?=sprintf(lang('LOGIN_CHPASS_DESCR'), '<em>'.get_curr_uname().'</em>'); ?>
	</div>

	<div class="success">
	<?=lang('M1_CHANGE_PASSWD_SUCCESS')?>
	</div>
	<?=anchor('welcome', lang('M1_BUTTON_CONTINUE_VALUE'))?><br>
	</fieldset>
	</div>
</div>

