<?php
/**
 * Получить RSS Feed
 * 
 * @author Mazvv
 */
function get_rss(){
	$ci = &get_instance();
	$data = array();
	$ci->lang->load('rss');
	$data['title_news'] = lang('RSS_NEWS_TITLE');
	$data['title_docs'] = lang('RSS_DOCS_TITLE');
	$data['rss_empty'] = lang('RSS_EMPTY');
	$ci->load->library('RSSParser', array('url' => $ci->config->item('crm_rss_news_feed'), 'life'=>0));
	$data['rss_news'] = $ci->rssparser->getFeed(6);
	return $ci->load->view('welcome/rss', $data, True);
}