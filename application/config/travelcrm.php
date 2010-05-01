<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* is profile turn on*/
$config['crm_version']	= 'v0.4rc1';
$config['crm_profile_on']	= False;
$config['crm_chpass_period']	= 90; /*период смены пароля в днях*/
$config['crm_grid_limit']	= 25;
$config['crm_dropdown_empty']	= '--None--'; /*пустышка в выпадающем списке*/
$config['crm_upload_max_size'] = 2048; /* максимальный размер файла в прикрепленных файлах*/
$config['crm_allowed_types'] = 'gif|jpg|png';
$config['crm_upload_path'] = './public/attaches/';
$config['crm_chat_limit']	= 100;
$config['crm_date_format']	= '%d.%m.%Y';
$config['crm_date_entry_format']	= 'dmy.';
$config['crm_tasks_per_page']	= 5;
/* End of file config.php */
/* Location: ./system/application/config/config.php */