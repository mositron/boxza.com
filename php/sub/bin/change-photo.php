<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

//db.accommodations.find( { $where: "this.name.length > 1" } );

if($photo=$db->find('line',array(
																			'pt'=>array('$exists'=>true),
																			'ty'=>array('$ne'=>'album'),
																			'$where'=>"this.pt.f.length == 5"
																	),
																	array('pt'=>1),
																	array('limit'=>50000)
											)
)
{
	echo '<pre>';
	for($i=0;$i<count($photo);$i++)
	{
		$p = $photo[$i]['pt'];
		if(is_array($p))
		{
			if(isset($p['fd'])&&isset($p['f'])&& is_string($p['f']))
			{
				$f = substr($p['fd'],0,2).'/'.substr($p['fd'],2,2).'/'.substr($p['fd'],4,2);
				$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('pt.f'=>$f)));
				echo ($i+1).'). '.$photo[$i]['_id'].' - '.$p['f'].' - '.$f.'<br>';
			}
		}
		//print_r($photo[$i]);
	}
}
?>