<?php
//_::session()->logged();

$template=_::template();
#$template->assign('site',$site);
$url = trim($_GET['url']);
$title = trim($_GET['title']);
$tags = trim($_GET['tags']);
if(_::$my)
{
	if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url))
	{
		_::move('/line');
	}
	if($tags)
	{
		$tags=array_values(array_filter(array_unique(array_map('trim',array_map('invalidchar',explode(',',$tags))))));
	}
	if($tags&&count($tags))
	{
		$template->assign('tags',$tags);
	}
	$template->assign('url',$url);
	$template->assign('title',$title);
	_::$content=$template->fetch('share.post');
}
else
{
	_::move(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode('http://boxza.com/share/?url='.urlencode($url).($title?'&title='.urlencode($title):''))));
	//_::$content=$template->fetch('share.login');
}

echo $template->display();


function invalidchar($t)
{
	return preg_replace('/\s+/',' ',preg_replace('/[\x21-\x2f\x3a-\x40\x5b-\x5e\x60\x7b-\x7e]/','',$t));
}

exit;
?>