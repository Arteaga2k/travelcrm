<div class="container fieldscontainer">
	<div class="column span-10 prepend-7 append-7 last " style="margin-top: 80px;">	
	<?=form_open('login/chpass', array('name'=>'f_login','id'=>'f_login', 'autocomplete'=>'off')) ?>
	<fieldset class="login">
	<legend><?=lang('LOGIN_CHPASS_TITLE'); ?></legend>
	<div class="notice">
	<?=sprintf(lang('LOGIN_CHPASS_DESCR'), '<em>'.get_curr_uname().'</em>'); ?>
	</div>
	<?if(validation_errors()){?>
	<?=validation_errors('<div class="error">', '</div>');?>
	<?}?>
	<p>	
		<label for="i_login"><?=lang('M1_PASSWORD_LABEL'); ?></label>
		<br/>
		<?=form_password(array('name'=>'i_password', 'class'=>'text', 'id'=>'i_password')); ?>
	</p>
	<p>
		<label for="i_password"><?=lang('M1_PASSWORD_CONFIRM_LABEL'); ?></label>
		<br/>
		<?=form_password(array('name'=>'i_cpassword', 'class'=>'text', 'id'=>'i_cpassword')); ?><br>
	</p>
	<?=form_submit('submit', lang('M1_BUTTON_SAVE_VALUE'), 'class="button controls"')?>  <?=form_reset('next', lang('M1_BUTTON_LATER_VALUE'), "onclick=javascript:window.location='".site_url('welcome')."'")?><br>
	</fieldset>
	<?=form_close() ?>
	</div>
</div>

