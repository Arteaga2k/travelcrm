<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-3">
	<?=form_label(lang('EMPLOYEER'), 'emp_name')?>
</div>
<div class="column span-21 last">
	<?=form_input('full_name', get_emp_fullname_byrid(set_value('_employeers_rid', $ds->_employeers_rid)), 'id="full_name" class="text part-5" readonly="readonly"')?>
</div>
<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('USER_LOGIN'), 'user_login')?>
</div>
<div class="column span-21 last">
	<?=form_input('user_login', set_value('user_login', $ds->user_login), 'id="user_login" readonly="readonly" class="text part-5"')?>
</div>
<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('USER_PASSWORD'), 'user_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_password('user_passwd', set_value('user_passwd', $ds->user_passwd), 'id="user_passwd" readonly="readonly" class="text part-5"')?>
</div>

<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('END_PASSWD_DATE'), 'edate_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_input('edate_passwd', set_value('edate_passwd', $ds->edate_passwd), 'id="edate_passwd" class="text date-entry" readonly="readonly"')?>
</div>
<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('CHANGE_PASSWD_DATE'), 'chdate_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_input('chdate_passwd', set_value('chdate_passwd', $ds->chdate_passwd), 'id="chdate_passwd" class="text date-entry" readonly="readonly"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-21 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>