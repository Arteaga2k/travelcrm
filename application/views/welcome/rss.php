<div class="grid fieldscontainer">
	<h3><?=$title_news?></h3>
	<div class="clear editform rss">
	<?if($rss_news){?>
		<?foreach($rss_news as $item){?>
			<div class="clear item">
				<h5><?=anchor($item['link'], $item['title'])?> | <?=$item['pubDate']?></h5>
				<div class="clear description">
					<?=word_limiter($item['description'], 50)?>
				</div>
			</div>
		<?}?>
	<?} else {?>
		<?=$rss_empty?>
	<?}?>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.item > h5 > a').attr('target', '_blank');
			$('.description a').attr('target', '_blank');
		})
	</script>
</div>