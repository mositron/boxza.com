<?php



# check session/login
_::session()->logout();

if($_GET['appid'] && isset(_::$config['apps'][$_GET['appid']]))
{
	$r=_::$config['apps'][$_GET['appid']];
	$data=array('_id'=>_::$my['_id']);
	$data['algorithm'] = 'HMAC-SHA256';
	$d = strtr(base64_encode(json_encode($data)), '+/', '-_');
	$s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
	_::move($r['uri'].'logout/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
}
elseif($_GET['redirect_uri'])
{
	_::move($_GET['redirect_uri']);
}
else
{
	_::move(array('sub'=>'m','path'=>'/'));
}
?>