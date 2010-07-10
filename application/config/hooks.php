<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_ssl_on',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_profile_on',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_is_logged',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_init_user',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );
                                
$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_init_menu',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_check_security',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );
                                
$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'hook_config_reinit',
                                'filename' => 'crm_hooks.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );
                                
/* End of file hooks.php */
/* Location: ./system/application/config/hooks.php */