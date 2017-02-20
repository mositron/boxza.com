<?php
$db=_::db();
if((!$glitter=$db->findone('glitter',array('_id'=>intval(_::$path[0]),'dd'=>array('$exists'=>false)))) || !$glitter['zp'])
{
	_::move('/');
}
$db->update('glitter',array('_id'=>$glitter['_id']),array('$set'=>array('do'=>intval($glitter['do'])+1)));
_::move('http://s3.boxza.com/glitter/'.$glitter['fd'].'/'.$glitter['zp'],true);
?>