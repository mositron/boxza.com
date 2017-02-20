<?php
_::session()->logged();

if(!_::$my['am'])
{
	_::move('/');
}
$p=array(
					''=>'medal',
					'medal'=>'medal',
);
if(isset($p[_::$path[0]]))
{
	require_once(__DIR__.'/'.$p[_::$path[0]].'/asiangames.admin.'.$p[_::$path[0]].'.php');
}
else
{
	_::move('/');	
}




function checkout_nofollow($arg)
{
	if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(boxza|boxzacar|teededball|teededball|doodroid|google|ihappycare)\.com(.*)$/',$arg[1]))
	{
		return 	'<a href="'.$arg[1].'" target="_blank">';
	}
	else
	{
		return 	'<a href="http://out.teededball.com/#'.base64_encode($arg[1]).'" target="_blank">';
	}
}


function getdetail($t)
{
	$t=stripslashes(trim($t));
	$t=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$t);
	# add title to image(alt)
	$t=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?teededball.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2teededball.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$t);
	# add title to image(alt)
	$t=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?teededball.com\/([^"]*)"([^\>]*)\>/i','<img\1title="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\3src="http://\4teededball.com/\5"\6>',$t);
	return $t;
}
?>