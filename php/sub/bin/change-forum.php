<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

/*

$db=_::db();

if($user=$db->find('user',array(),array('_id'=>1,'sg'=>1)))
{
	$bbcode=_::bbcode();
	echo '<pre>';
	for($i=0;$i<count($user);$i++)
	{
		$db->update('user',array('_id'=>$user[$i]['_id']),array('$set'=>array('sg'=>$bbcode->get($user[$i]['sg'],true))));
		echo $user[$i]['_id'].'<br>';
	}
}

if($forum=$db->find('forum'))
{
	$bbcode=_::bbcode();
	echo '<pre>';
	for($i=0;$i<count($forum);$i++)
	{
		$set=array('d'=>$bbcode->get($forum[$i]['d'],true));
		
		if($cm=$forum[$i]['cm'])
		{
			if(is_array($cm['d']))
			{
				$_cm=array();
				foreach($cm['d'] as $v)
				{
					$v['m']=$bbcode->get($v['m'],true);
					$_cm[]=$v;
				}
				$set['cm.d']=$_cm;
			}
		}
		$db->update('forum',array('_id'=>$forum[$i]['_id']),array('$set'=>$set));
		echo $forum[$i]['_id'].'<br>';
	}
}
*/
?>