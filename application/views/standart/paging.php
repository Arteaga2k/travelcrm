<span style="font-weight: normal;"><?=$p_descr?></span>
&nbsp;&nbsp;&nbsp;<span style="font-weight: normal;"><?=lang('PAGER_SHOW')?><?=form_dropdown('p_limit', array_combine(explode('|',$this->config->item('crm_grid_limits')), explode('|',$this->config->item('crm_grid_limits'))), $this->config->item('crm_grid_limit'), 'onchange="javascript: window.location.replace(\''.site_url(get_currcontroller()).'/limit/\'+$(this).val()+\''.($vp?('/'.$this->uri->assoc_to_uri($this->a_uri_assoc)):('')).'\');"')?></span>
&nbsp;&nbsp;&nbsp;
<?if(!empty($pagination)) { ?>
|&nbsp;&nbsp;&nbsp;
<?=$pagination?>
<? } ?>
