<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

/*
$db=_::db();

$char=$db->find('lionica_char',array('dd'=>array('$exists'=>false)),array('_id'=>1,'stats'=>1,'n'=>1,'hp'=>1,'mhp'=>1,'mp'=>1,'mmp'=>1,'xp'=>1,'mxp'=>1,'lv'=>1,'u'=>1,'job'=>1,'gender'=>1,'hair'=>1,'color'=>1,'atk'=>1,'def'=>1,'hit'=>1,'free'=>1,'g'=>1),array('sort'=>array('lv'=>-1,'xp'=>-1,'dl'=>1),'limit'=>50));		

$id=array();
for($i=0;$i<count($char);$i++)
{
	$u=$char[$i]['u'];
	$items=array(402,451);
	
	foreach($items as $item)
	{
		if(!$db->findone('lionica_item',array('u'=>$u,'item'=>$item)))
		{
			$db->insert('lionica_item',array('u'=>$u,'item'=>$item,'c'=>1,'ps'=>0));
		}
	}
}


*/
?>