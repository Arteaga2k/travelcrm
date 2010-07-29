<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['crm_version']	= 'v0.4.9b';
$config['crm_support_email']	= 'support@travelcrm.org.ua';
$config['crm_profile_on']	= False;
$config['crm_ssl_on']	= False;
$config['crm_chpass_period']	= 90; /*период смены пароля в днях*/
$config['crm_grid_limit']	= 25; /*лимит грида по умолчанию*/
$config['crm_grid_limits']	= '10|25|50|100|250|500'; /*список доступных лимитов грида*/
$config['crm_dropdown_empty']	= '--None--'; /*пустышка в выпадающем списке*/
$config['crm_upload_max_size'] = 2048; /* максимальный размер файла в прикрепленных файлах*/
$config['crm_allowed_types'] = 'gif|jpg|png';
$config['crm_upload_path'] = './public/attaches/';
$config['crm_chat_limit']	= 100;
$config['crm_date_format']	= '%d.%m.%Y';
$config['crm_date_entry_format']	= 'dmy.';
$config['crm_tasks_per_page']	= 5; 
$config['crm_rss_news_feed']	= 'http://travelcrm.org.ua/category/news/feed'; /* url of rss news feed */
$config['crm_rss_docs_feed']	= 'http://travelcrm.org.ua/category/dokumentacija/feed'; /* url of rss documentstion feed */
$config['crm_rss_feed_limit']	= '5'; /* rss feed limit */
