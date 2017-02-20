<?php
/*
+ ----------------------------------------------------------------------------+
|     BoxZa - for PHP 5.3
|
|     © 2013 iNet Revolutions Co.,Tld.
|     http://boxza.com
|     positron@boxza.com
|
|     $Revision: 1.1.0 $
|     $Date: 2013/02/19 19:42:00 $
|     $Author: Positron $
+-----------------------------------------------------------------------------+
*/
# start.
require_once('../../handlers/boxza.php');

# Initialization Application
_::load('upload');

# check session/login
//_::session();

if(_::$path[0]=='s1'&&_::$path[1]=='move')
{
	$db=_::db();
	if($photo=$db->find('line',array(
																				'pt'=>array('$exists'=>true),
																				'ty'=>array('$ne'=>'album'),
																				'dd'=>array('$exists'=>false)
																		),
																		array('pt'=>1),
																		array('limit'=>10000,'sort'=>array('_id'=>1),'skip'=>intval($_GET['start']))
												)
	)
	{
		echo '<pre>';
		$folder=_::folder();
		$j=1;
		for($i=0;$i<count($photo);$i++)
		{
			$p = $photo[$i]['pt'];
			if(is_array($p))
			{
				if(isset($p['fd'])&&isset($p['f'])&& is_string($p['f']))
				{
					$f = substr($p['fd'],0,2).'/'.substr($p['fd'],2,2);
					$n = substr($p['fd'],4,2);
					
					$e = $p['e'];
					
					$path = 'upload-s1/line/'.$p['f'].'/';
					
					$o = FILES.'upload-s1/line/photo/'.$f.'/'.$n;
					if(file_exists($o.'.jpg'))
					{
						$type='jpg';
						$o.='.jpg';
					}
					elseif(file_exists($o.'.gif'))
					{
						$type='gif';
						$o.='.gif';
					}
					elseif(file_exists($o.'.png'))
					{
						$type='png';
						$o.='.png';
					}
					
					$m = FILES.'upload-s1/line/photo-tmp/'.$f.'/500-375-inboth/'.$n;
					if(file_exists($m.'.jpg'))
					{
						$m.='.jpg';
						$m_type='jpg';
					}
					elseif(file_exists($m.'.gif'))
					{
						$m.='.gif';
						$m_type='gif';
					}
					elseif(file_exists($m.'.png'))
					{
						$m.='.png';
						$m_type='png';
					}
					
					$s = FILES.'upload-s1/line/photo-tmp/'.$f.'/200-120-both/'.$n;
					if(file_exists($s.'.jpg'))
					{
						$s.='.jpg';
						$s_type='jpg';
					}
					elseif(file_exists($s.'.gif'))
					{
						$s.='.gif';
						$s_type='gif';
					}
					elseif(file_exists($s.'.png'))
					{
						$s.='.png';
						$s_type='png';
					}
					
					
					//$f = substr($p['fd'],0,2).'/'.substr($p['fd'],2,2).'/'.substr($p['fd'],4,2);
					//$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('pt.f'=>$f)));
					if(file_exists($o)&&file_exists($m)&&file_exists($s)&&strlen($p['f'])==8)
					{
						
						//$folder->mkdir($path);
						//echo $j.'). '.$photo[$i]['_id'].' - '.$p['e'].' - '.$path.'<br>';
						//copy($o,FILES.$path.'o.'.$type);
						//copy($m,FILES.$path.'m.'.$m_type);
						//copy($s,FILES.$path.'s.'.$s_type);
						$j++;
					}
					else
					{
						//$db->update('line',array('_id'=>$photo[$i]['_id']),array('$set'=>array('dd'=>new MongoDate())));
						echo strlen($p['f']).'<br>';
						
					}
				}
			}
			//print_r($photo[$i]);
		}
	}
	
	exit;
}
require_once(
									_::run(
													array(
																	'line'=>'post',
																	'json'=>'json',
																	's1'=>'server',
																	's2'=>'server',
																	's3'=>'server',
													),
													true,
													function()
													{
														exit;
													}
									)
);

?>