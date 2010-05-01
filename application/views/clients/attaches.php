<?if($this->upload->display_errors()){?>
<div class="error">
<?=$this->upload->display_errors('<div>', "</div>")?>
</div>
<? } ?>
<?foreach($ds as $a){?>
<?=anchor(base_url().$this->config->item('crm_upload_path').$a->file_name, $a->file_descr, 'target="blank"')?> (<?=$a->file_size?>)Kb
<?if(!$readonly) { ?>
<a href="javascript: if(confirm('<?=lang('ATTACH_REMOVE_CONFIRM')?>')) attach_remove(<?=$a->rid?>); void(0);"><?=img('public/img/icons/delete_inline.gif', 'border="0"')?></a><br>
<? } ?>
<?}?>
