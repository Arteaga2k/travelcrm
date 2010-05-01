<?php
/**
 * 
 * @package LoginManagement
 * @author Mazvv
 */ 
?>
<?php echo $M1_CHANGE_PASSWORD_TITLE; ?>
<?php echo $this->validation->error_string; ?>
<?php echo form_open('login/c', array('name'=>'f_cpasswd','id'=>'f_cpasswd')) ?>

<?php echo $M1_PASSWORD_LABEL; ?>:
<?php echo form_password(array('name'=>'i_passwd', 'class'=>'', 'id'=>'i_passwd')); ?><br>
<?php echo $M1_PASSWORD_CONFIRM_LABEL; ?>:
<?php echo form_password(array('name'=>'i_cpasswd', 'class'=>'', 'id'=>'i_cpasswd')); ?><br>
<?php echo form_submit('i_submit', $M1_BUTTON_SAVE_VALUE); ?>
<input type="button" value="<?php echo $M1_BUTTON_LATER_VALUE; ?>" onclick="window.location.href='<?php echo site_url(); ?>/welcome'">

<?php echo form_close() ?>
