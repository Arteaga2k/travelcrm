<?
	function menu_build($items){
		foreach($items as $item){
			$js = (empty($item['module_controller']))?'javascript: return false;':'';
			if($item['childNodes']){
				echo '<li>';
				echo anchor($item['module_controller'], $item['item_name'].' »', "title=\"{$item['descr']}\" onclick=\"{$js}\"");
					echo '<ul>';
						menu_build($item['childNodes']);
					echo '</ul>';
				echo '</li>'; 
			} else {
				echo '<li>'.anchor($item['module_controller'], $item['item_name'], "title=\"{$item['descr']}\" onclick=\"{$js}\"").'</li>';
			}
		}
	}
?>
<div class="jqueryslidemenu" id="main_menu">
	<ul>
		<li><?=anchor('welcome', lang('HOME'), 'title="'.lang('HOME').'"');?></li>
		<?menu_build($items)?>
		<li>
			<?=anchor('', lang('HELP').' »', 'title="'.lang('HELP').'" onclick="javascript: return false;"');?>
			<ul>
				<li><?=anchor('http://forum.travelcrm.org.ua', lang('FORUM'), 'title="'.lang('FORUM').'" target="_blank"');?></li>
				<li><?=safe_mailto($this->config->item('crm_support_email'), lang('DEV_EMAIL'))?></li>
			</ul>
		</li>
	</ul>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){jqueryslidemenu.buildmenu("main_menu")});
</script>