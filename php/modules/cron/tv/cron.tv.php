<?php



$N=date('N');
$G=date('G');


$db=_::db();

$found=array();

$now=((date('Y')-2013)*366)+(date('n')*31)+date('j');
//(($date[4]-2013)*366)+($date[3]*31)+$date[2];
$month=array('มกราคม'=>1,'กุมภาพันธ์'=>2,'มีนาคม'=>3,'เมษายน'=>4,'พฤษภาคม'=>5,'มิถุนายน'=>6,'กรกฏาคม'=>7,'สิงหาคม'=>8,'กันยายน'=>9,'ตุลาคม'=>10,'พฤศจิกายน'=>11,'ธันวาคม'=>12);

$zone=array(
						array('drama','http://www.doolakorntv.com/Drama-%E0%B8%94%E0%B8%B9%E0%B8%A5%E0%B8%B0%E0%B8%84%E0%B8%A3%E0%B8%A2%E0%B9%89%E0%B8%AD%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87.html'),
						array('sitcom','http://www.doolakorntv.com/Sitcom-%E0%B8%94%E0%B8%B9%E0%B8%8B%E0%B8%B4%E0%B8%97%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%A2%E0%B9%89%E0%B8%AD%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87.html')
);
//echo 'http://xn--q3cropc2fyf.com/?page=sititi&id=2013';

$z=$db->findone('msg',array('_id'=>'drama'));
$zone_cur=intval($z['msg'])+1;
if($zone_cur>=count($zone))
{
	$zone_cur=0;
}
$db->update('msg',array('_id'=>'drama'),array('$set'=>array('msg'=>$zone_cur)));

$zone_type=$zone[$zone_cur][0];
$zone_link=$zone[$zone_cur][1];

$found=array();
$tmp=_::http()->get($zone_link);

if(preg_match_all('/\<a href=\'([^\']+)\'(\s+)class\="more\-link"/',$tmp,$drama))
{
	for($i=0;$i<count($drama[1]);$i++)
	{
		$arg=array();
		$arg['type']=$zone_type;
		$arg['order']=9999999;
		$arg['count']=0;
		$arg['last']=new mongodate();
		$arg['url']='http://www.doolakorntv.com/'.urldecode($drama[1][$i]);
		
		
		echo $arg['url'].'<br>';
		
		$ct=_::http()->get($arg['url']);
		if(preg_match('/<img(\s+)class="size\-thumbnail(\s+)wp\-image\-130" title\="([^"]+)"(\s+)src\="([^"]+)"/',$ct,$tmp2))
		{
			$arg['name']=$tmp2[3];
			$arg['img']='http://www.doolakorntv.com/'.$tmp2[5];
		}
		$arg['peach']=array();
		if(preg_match_all('/href\="([^"]+)"(\s+)class="more-link"(\s+)title\=\'([^\']+)\'/',$ct,$tmp2))
		{
			for($j=0;$j<count($tmp2[1]);$j++)
			{
				$link='http://www.doolakorntv.com/'.urldecode($tmp2[1][$j]);
				
				
				//if($arg['order']+10>$now)
				
				$ct2=_::http()->get($link);
				$vdo=explode('<iframe width="728" height="410" src="http://www.youtube.com/embed/',$ct2);
				$youtube=array();
				for($k=1;$k<count($vdo);$k++)
				{
					$youtube[]=mb_substr($vdo[$k],0,11,'utf-8');
				}
				if(!preg_match('/(.+)\-([0-9]{2})\-([0-9]{2})\-([0-9]{4})\-([0-9]+)/',$link,$date))
				{
					if(preg_match('/(.+)\_([0-9]{1,2})\_(.+)\_([0-9]{4})\-([0-9]+)/',$link,$date))
					{
						$date[3]=$month[$date[3]];
						$date[4]-=543;
					}
//				http://www.doolakorntv.com/_5_กกก_2556-15301.html	
				}
				if($j==0)
				{
					$arg['order']=(($date[4]-2013)*366)+($date[3]*31)+$date[2];
					
					$arg['count']=count($tmp2[1]);
					$arg['last']=new mongodate(strtotime($date[4].'-'.$date[3].'-'.$date[2].' 00:00:00'));
				}
				$arg['peach'][]=array(
														'link'=>$link,
														'title'=>$tmp2[4][$j],
														'date'=>$date[4].'-'.$date[3].'-'.$date[2],
														'ds'=>new mongodate(strtotime($date[4].'-'.$date[3].'-'.$date[2].' 00:00:00')),
														'youtube'=>$youtube
				);
			}
		}
		
		//" class="more-link"  title='
		//<img class="size-thumbnail wp-image-130" title="
		$found[]=$arg;
	}
}

echo '<pre>';
$drama=array_reverse($found);
foreach($drama as $v)
{
	if($v['name'])
	{
		if($d=$db->findone('tvreturn',array('name'=>$v['name'])))
		{
			echo 'อัพเดท: '.$v['name'].'<br>';
			$db->update('tvreturn',array('name'=>$v['name']),array('$set'=>array('peach'=>$v['peach'],'order'=>$v['order'],'count'=>$v['count'],'last'=>$v['last'],'type'=>$v['type'])));	
		}
		else
		{
			echo 'เพิ่ม: '.$v['name'].'<br>';
			$db->insert('tvreturn',$v);	
		}
	}
	else
	{
			echo 'ไม่เจอ: '.$v['url'].'<br>';
	}
}


print_r($drama);
?>