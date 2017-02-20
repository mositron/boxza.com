<?php

class opengraph
{
	
	static public function fetch($uri) {
		
		try{
			if(preg_match('|^http(s)?://[a-z0-9-]+\.([a-z0-9-\.]+)*(:[0-9]+)?(/.*)?$|i', $uri))
			{
				$art=@file_get_contents($uri,null,stream_context_create(array('http'=>array('ignore_errors'=>true,'method'=>"GET",
				'header'=>"Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
		Accept-Charset:UTF-8,*;q=0.5
		Accept-Language:en-US,en;q=0.8
		User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1
		"))));
					return self::_parse($art);
			}
			return NULL;
		}
		catch(Exception $e){ return NULL;}
	}

	static private function _parse($txt) {
		$HTML=strip_tags((string)$txt,'<html><head><body><meta><title><link>');
		if(preg_match('/charset="([a-z0-9\-_]+)/i',$HTML,$c))
		{
			$dt=trim(strtolower($c[1]));
		}
		else if(preg_match('/charset=([a-z0-9\-_]+)/i',$HTML,$c))
		{
			$dt=trim(strtolower($c[1]));
		}
		else if(strpos($HTML,'tis-620')>-1)
		{
			$dt='tis-620';
		}
		else if(strpos($HTML,'windows-874')>-1)
		{
			$dt='windows-874';
		}
		else
		{
			$dt = strtolower(mb_detect_encoding($HTML));
			if(!$dt)$dt='utf-8';
		}
		
		if($dt!='utf-8')$HTML = iconv($dt, 'utf-8',$HTML); 
		$HTML = mb_convert_encoding($HTML, 'html-entities','utf-8'); 
		$old_libxml_error = libxml_use_internal_errors(true);

		$doc = new DOMDocument();
		$doc->loadHTML($HTML);
		//_::ajax()->alert($dt);
		
		libxml_use_internal_errors($old_libxml_error);

		$page = array();
		
		$tmp = $doc->getElementsByTagName('title');
		$page['title'] = $tmp->item(0)->nodeValue;
		$tags = $doc->getElementsByTagName('link');
		foreach ($tags AS $tag) {
			if($tag->hasAttribute('rel') && strtolower(trim($tag->getAttribute('rel')))=='image_src')
			{
				$page['image_src'] = $tag->getAttribute('href');
			}
		}
		
		
		$tags = $doc->getElementsByTagName('meta');
		
		foreach ($tags AS $tag) {
			if($tag->hasAttribute('name') && strtolower(trim($tag->getAttribute('name')))=='description')
			{
				$page['description'] = $tag->getAttribute('content');
			}
			elseif ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) 
			{
				$key = strtr($tag->getAttribute('property'), '-', '_');
				$page[$key] = $tag->getAttribute('content');
			}
		}
		return $page;
	}

}
	