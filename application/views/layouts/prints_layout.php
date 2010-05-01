<?=doctype('html4-trans')?>
<html>
<head>
    <title>TravelCRM - <?=$title?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?=link_tag('public/css/blueprint/src/reset.css');?>
	<?=link_tag('public/css/blueprint/src/forms.css');?>
	<?=link_tag('public/css/blueprint/src/liquid.css');?>
	<?=link_tag('public/css/blueprint/src/typography.css');?>
	<!--[if IE]>
		<?=link_tag('public/css/blueprint/ie.css');?>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="column span-24 last">
			<?=$content?>
		</div>
	</div>
</body>
</html>