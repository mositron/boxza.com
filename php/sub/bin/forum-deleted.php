<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();


$tmp=$db->find('forum_cate',array('s'=>'deleted'));
foreach($tmp as $v)
{
	$db->update('forum',array('c'=>$v['_id']),array('$set'=>array('dd'=>new MongoDate(),'reason'=>'cate-delete')),array('multiple'=>true));
}
?>