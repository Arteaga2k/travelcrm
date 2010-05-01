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
	</ul>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){jqueryslidemenu.buildmenu("main_menu")});
</script>