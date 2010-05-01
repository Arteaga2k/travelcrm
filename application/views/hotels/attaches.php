<?if($this->upload->display_errors()){?>
<div class="error">
<?=$this->upload->display_errors('<div>', "</div>")?>
</div>
<? } ?>
<table style="border-width: 0px;">
<?foreach($ds as $a){?>
<tr>
<td>
<?=anchor(base_url().$this->config->item('crm_upload_path').'/hotels/'.$a->file_name, img(base_url().$this->config->item('crm_upload_path').'/hotels/'.$a->raw_name.'_thumb'.$a->file_ext, 'border="0"'), 'target="blank"')?>
</td>
<td>
<?=anchor(base_url().$this->config->item('crm_upload_path').'/hotels/'.$a->file_name, $a->file_descr, 'target="blank"')?>
(<?=$a->file_size?>)Kb
<?if(!$readonly) { ?>
<a href="javascript: if(confirm('<?=lang('ATTACH_REMOVE_CONFIRM')?>')) attach_remove(<?=$a->rid?>); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a><br>
<? } ?>
</td>
</tr>
<?}?>
</table>


