<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();


if($photo=$db->find('line',array(
																			'pt'=>array('$exists'=>true),
																		'dd'=>array('$exists'=>false),
																			'ty'=>'album',
																	),
																	array('pt'=>1,'_id'=>1),
																	array('limit'=>1,'sort'=>array('ds'=>-1),'skip'=>intval($_GET['start']))
											)
)
{
	for($i=0;$i<count($photo);$i++)
	{
		$p = $photo[$i]['pt'];
		if(is_array($p))
		{
			if(isset($p['f'])&& is_array($p['f']))
			{
				/*
				$pho = $db->find('line',array('pt.a'=>$photo[$i]['_id'],'dd'=>array('$exists'=>false)),array('_id'=>1,'pt'=>1),array('sort'=>array('_id'=>-1)));
				
				$l = $c = count($pho);
				$pt=array('c'=>$c,'l'=>$l,'f'=>array());
				if($c>0)
				{
					for($j=0;$j<min($c,5);$j++)
					{
						$pt['f'][]=array('i'=>$pho[$j]['_id'],'f'=>$pho[$j]['pt']['f'],'e'=>$pho[$j]['pt']['e'],'w'=>$pho[$j]['pt']['w'],'h'=>$pho[$j]['pt']['h']);
					}
				}
				echo ($i+1).'). '.$photo[$i]['_id'].' - '.count($p['f']).' - '.count($pho).'<br>';
				$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('pt'=>$pt)));
				*/
				//if(count($p['f'])>0)
				//{
				//	$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('pt.cv'=>array('f'=>$p['f'][0]['f'],'i'=>$p['f'][0]['i'],'e'=>$p['f'][0]['e']))));
				//}
				//$ty = $db->findone('line_bk',array('_id'=>$photo[$i]['_id']),array('pt.vt'=>1));
				//if($ty['pt']['ty'])
				//{
					//$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('pt.vt'=>intval($ty['pt']['vt']))));
				//}
				//echo ($i+1).' - '.$photo[$i]['_id'].' - '.$ty['pt']['vt'].'<br>';
			}
		}
		//print_r($photo[$i]);
	}
}
?>