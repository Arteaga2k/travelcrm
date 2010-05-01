<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/edit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?if($success===False){?>
<div class="error">
	<?=lang('SAVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?if($success===True){?>
<div class="success">
	<?=lang('SAVE_SYSTEM_SUCCESS')?>
</div>
<?}?>

<div class="column span-4">
	<?=form_label(lang('POSITION').required_field(), '_positions_rid')?>
</div>
<div class="column span-8">
	<?=form_dropdown('_positions_rid', get_positions_list(), set_value('_positions_rid', $ds->_positions_rid), 'id="_positions_rid" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('MODULE'), '_modules_rid')?>
</div>
<div class="column span-8 last">
	<?=get_modules_vp(set_value('_modules_rid', $ds->_modules_rid))?>
	<?#=form_dropdown('_modules_rid', get_modules_list(), set_value('_modules_rid', $ds->_modules_rid), 'id="_modules_rid" class="text pzrt-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('ITEM_NAME').required_field(), 'item_name')?>
</div>
<div class="column span-8">
	<?=form_input('item_name', set_value('item_name', $ds->item_name), 'id="item_name" class="text part-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('PARENT'), 'parent')?>
</div>
<div class="column span-8 last" id="menu_tree">
	<?=build_tree_dropdown(set_value('_positions_rid', $ds->_positions_rid), $ds->parent)?>
</div>

<div class="column span-4">
	<?=form_label(lang('ORDER'), 'item_order')?>
</div>
<div class="column span-20 last">
	<?=form_input('item_order', set_value('item_order', $ds->item_order), 'id="item_order" class="text part"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
