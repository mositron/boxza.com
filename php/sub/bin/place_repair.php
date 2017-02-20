<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');



$db=_::db();

$limit=5000;

$get=max(1,intval($_GET['start']));
$start=($get-1)*$limit;

$_id=100001+$start;


$p=$db->find('place',array('_id'=>array('$gte'=>$_id),'ty'=>5),array('_id'=>1,'p4'=>1,'p3'=>1,'n'=>1,'log'=>1,'gg'=>1),array('sort'=>array('_id'=>1),'limit'=>$limit));

for($i=0;$i<count($p);$i++)
{
	$v=$p[$i];
	$arg=array('q'=>$v['n']);
	
	if(!$v['p4'])
	{
		if($v['log']['dist']['id'])
		{
			if($v['log']['prv']['n']&&$v['log']['amp']['n']&&$v['log']['dist']['n']&&$dist=$db->findone('place',array('ty'=>4,'n'=>$v['log']['dist']['n'],'tt.t3.n'=>$v['log']['amp']['n'],'tt.t2.n'=>$v['log']['prv']['n'])))
			{
				echo 'เจอ<br>';
				$arg['p4']=$dist['_ky'];
				$arg['p3']=$dist['p3'];
				$arg['p2']=$dist['p2'];
				$arg['p1']=$dist['p1'];
				$arg['tt.t4']=array('n'=>$dist['n'],'lk'=>$dist['lk']);
				$arg['tt.t3']=$dist['tt']['t3'];
				$arg['tt.t2']=$dist['tt']['t2'];
				$arg['tt.t1']=$dist['tt']['t1'];
			}
			elseif($dist=$db->findone('place',array('ty'=>4,'ky'=>$v['log']['dist']['id'])))
			{
				$arg['p4']=$dist['_ky'];
				$arg['p3']=$dist['p3'];
				$arg['p2']=$dist['p2'];
				$arg['p1']=$dist['p1'];
				$arg['tt.t4']=array('n'=>$dist['n'],'lk'=>$dist['lk']);
				$arg['tt.t3']=$dist['tt']['t3'];
				$arg['tt.t2']=$dist['tt']['t2'];
				$arg['tt.t1']=$dist['tt']['t1'];
			}
		}
		elseif($v['log']['amp']['id'])
		{
			if($v['log']['prv']['n']&&$v['log']['amp']['n']&&$amp=$db->findone('place',array('ty'=>3,'n'=>$v['log']['amp']['n'],'tt.t2.n'=>$v['log']['prv']['n'])))
			{
				$arg['p3']=$amp['_ky'];
				$arg['p2']=$amp['p2'];
				$arg['p1']=$amp['p1'];
				$arg['tt.t3']=array('n'=>$amp['n'],'lk'=>$amp['lk']);
				$arg['tt.t2']=$amp['tt']['t2'];
				$arg['tt.t1']=$amp['tt']['t1'];	
			}
			elseif($amp=$db->findone('place',array('ty'=>3,'ky'=>$v['log']['amp']['id'])))
			{
				$arg['p3']=$amp['_ky'];
				$arg['p2']=$amp['p2'];
				$arg['p1']=$amp['p1'];
				$arg['tt.t3']=array('n'=>$amp['n'],'lk'=>$amp['lk']);
				$arg['tt.t2']=$amp['tt']['t2'];
				$arg['tt.t1']=$amp['tt']['t1'];
			}
		}
		elseif($v['log']['prv']['id'])
		{
			if($v['log']['prv']['n']&&$prv=$db->findone('place',array('ty'=>2,'n'=>$v['log']['prv']['n'])))
			{
				$arg['p2']=$prv['_ky'];
				$arg['p1']=$prv['p1'];
				$arg['tt.t2']=array('n'=>$prv['n'],'lk'=>$prv['lk']);
				$arg['tt.t1']=$prv['tt']['t1'];
			}
			elseif($prv=$db->findone('place',array('ty'=>2,'ky'=>$v['log']['prv']['id'])))
			{
				$arg['p2']=$prv['_ky'];
				$arg['p1']=$prv['p1'];
				$arg['tt.t2']=array('n'=>$prv['n'],'lk'=>$prv['lk']);
				$arg['tt.t1']=$prv['tt']['t1'];
			}
		}
		
		if(!$v['log']['prv']['id'])
		{
			if($g=$v['gg'])
			{
				if($y=$g['administrative_area_level_1'])
				{
					if($t=trim($y['long_name']))
					{
						$prov=$t;
						if(mb_substr($t,0,7,'utf-8')=='จังหวัด')
						{
							$prov=trim(mb_substr($t,7,NULL,'utf-8'));
						}
						if($provi=$db->findone('place',array('ty'=>2,'n'=>$prov)))
						{
							$arg['log.prv.id']=$provi['ky'];
							$arg['log.prv.n']=$provi['n'];
						}
					}
				}
				elseif($y=$g['locality'])
				{
					if($prov=trim($y['long_name']))
					{
						if($prov=='กรุงเทพมหานคร')
						{
							if($provi=$db->findone('place',array('ty'=>2,'n'=>$prov)))
							{
								$arg['log.prv.id']=$provi['ky'];
								$arg['log.prv.n']=$provi['n'];
							}
						}
					}
				}
			}
		}
		if(!$v['log']['amp']['id'])
		{
			if(($g=$v['gg'])&&$v['log']['prv']['id'])
			{
				foreach($g as $y)
				{
					if($t=trim($y['long_name']))
					{
						$prov=$t;
						if(mb_substr($t,0,3,'utf-8')=='เขต')
						{
							$prov=trim(mb_substr($t,3,NULL,'utf-8'));
							if($provi=$db->findone('place',array('ty'=>3,'n'=>$prov,'tt.t2.n'=>$v['log']['prv']['n'])))
							{
								$arg['log.amp.id']=$provi['ky'];
								$arg['log.amp.n']=$provi['n'];
							}
						}
						elseif(mb_substr($t,0,5,'utf-8')=='อำเภอ')
						{
							$prov=trim(mb_substr($t,5,NULL,'utf-8'));
							if($provi=$db->findone('place',array('ty'=>3,'n'=>$prov,'tt.t2.n'=>$v['log']['prv']['n'])))
							{
								$arg['log.amp.id']=$provi['ky'];
								$arg['log.amp.n']=$provi['n'];
							}
						}
					}
				}
			}
		}
		if(!$v['log']['dist']['id'])
		{
			if(($g=$v['gg'])&&$v['log']['amp']['id']&&$v['log']['prv']['id'])
			{
				foreach($g as $y)
				{
					if($t=trim($y['long_name']))
					{
						$prov=$t;
						if(mb_substr($t,0,4,'utf-8')=='ตำบล')
						{
							$prov=trim(mb_substr($t,4,NULL,'utf-8'));
							if($provi=$db->findone('place',array('ty'=>4,'n'=>$prov,'tt.t3.n'=>$v['log']['amp']['n'],'tt.t2.n'=>$v['log']['prv']['n'])))
							{
								$arg['log.dist.id']=$provi['ky'];
								$arg['log.dist.n']=$provi['n'];
							}
						}
						elseif(mb_substr($t,0,4,'utf-8')=='แขวง')
						{
							$prov=trim(mb_substr($t,4,NULL,'utf-8'));
							if($provi=$db->findone('place',array('ty'=>4,'n'=>$prov,'tt.t3.n'=>$v['log']['amp']['n'],'tt.t2.n'=>$v['log']['prv']['n'])))
							{
								$arg['log.dist.id']=$provi['ky'];
								$arg['log.dist.n']=$provi['n'];
							}
						}
					}
				}
			}
		}
		
		$db->update('place',array('_id'=>$v['_id']),array('$set'=>$arg));
	}
}

?>
<html>
<head></head>
<body>
<?php
if($p)
{
	echo '<script>setTimeout(function(){window.location.href="?start='.($get+1).'";},5000);</script>';
}
print_r($v);
?>
</body>
</html>


