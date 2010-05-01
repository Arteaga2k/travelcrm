<?=doctype('html4-trans')?>
<html >
<head>
    <title>TravelCRM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?=link_tag('public/css/blueprint/src/reset.css');?>
	<?=link_tag('public/css/blueprint/src/liquid.css');?>
	<?=link_tag('public/css/blueprint/src/typography.css');?>
	<?=link_tag('public/css/blueprint/plugins/tabs/screen.css');?>
	
	<?=link_tag('public/css/modules/common.css');?>
	<?=link_tag('public/css/modules/editform.css');?>
	<?=link_tag('public/css/modules/grid.css');?>
	<?=link_tag('public/css/modules/help.css');?>
	<?=link_tag('public/css/modules/report.css');?>
	
	<!--[if IE]>
		<?=link_tag('public/css/blueprint/ie.css');?>
	<![endif]-->
	<script type="text/javascript" src="<?=base_url()?>public/js/jquery-1.4.1.min.js"></script>
	<script src="<?=base_url()?>public/js/jqueryslidemenu.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/js/jquery.dateentry.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/js/jquery.timeentry.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/js/vtip-min.js" type="text/javascript"></script>
</head>
	<body>
		<?=$this->load->view('common/logoheader_login.php', null, true);?>
		<?=$content; ?>
		<?=$this->load->view('common/footer.php', null, true);?>
	</body>
</html>