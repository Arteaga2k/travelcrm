<div class="chat">
<h3><?=$title?></h3>
<div id="wrapper">
<div id="chat_messages">
<?$last_rid = 0?>
<?foreach($messages as $m) { ?>
<p>
	<b><?=$m->emp_name?> <?=$m->msg_datetime?></b><br>
	<em><?=$m->descr?></em>
</p>
<?$last_rid = $m->rid?>
<? } ?>
</div>
<form id="chat_form" autocomplete="off">
	<div id="txt">
		<?=form_hidden('last_rid', $last_rid)?>
		<?=form_label(lang('MESSAGE'), 'mess')?><br>
		<?=form_textarea('mess', '', 'style="height: 50px;"')?>
    </div>
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit_chat" name="submit">
</form>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#chat_form').click(function(){
		update_messages('add');	
		return false;
	});
});

function periodical_updater(){
	update_messages('update');
	setTimeout("periodical_updater()", 2000);	
}

function update_messages(action){
	$.ajax({
		type:'POST',
		url: '<?=site_url("chat/update/go") ?>',
		data: {action:action, mess:$("textarea[name='mess']").val(), last_rid:$("input[name='last_rid']").val()},
		success:function(xml){
			add_messages(xml);
		}	
	});
	
}

function add_messages(xml){
	var last_rid = '';
	$(xml).find('message').each(function(){
		last_rid = $(this).attr('rid')
		var mess_text = $(this).find('text').text();
		var author_text = $(this).find('author').text();
		var html = '<p><b>'+author_text+'</b><br>'+mess_text+'</p>';
		alert(html);
		$('#chat_messages').append(html);
		$("input[name='last_rid']").val(last_rid);
		$("textarea[name='mess']").val("");
	});
	
}

periodical_updater();

</script>	