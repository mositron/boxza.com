<?php

# check session/login
_::session();

_::$content = array();
list($type,$relate) = explode('-',_::$path[0]);

if(in_array($type,array('me','profile','global','oauth')))
{
	if($type!='global')
	{
		define('NOTIFY',true);
	}
	require_once ROOT_MODULES.$type.'/'._::$type.'.'.$type.'.php';
}


_::$content[] = array('method'=>'logged','data'=>_::$my?strval(_::$my['_id']):'');


if(_::$my && defined('NOTIFY'))
{
	$ntf=_::$my['nf'];
	$ds=($ntf['ds']?$ntf['ds']->sec:0);
	$g=floatval($_GET['ntf']);
	//$ntf['g']='('.$ntf['fr'].'||'.$ntf['ot'].') : '.$ds.'-'.$g;
	if(($ntf['fr']||$ntf['ot']) && ($ds>0) && ($g>0) && ($ds>$g))
	{
		$ntf['in']=1;
		$u = _::db()->find('notify',array('p'=>_::$my['_id'],'da'=>array('$gt'=>new MongoDate($g)),'dr'=>array('$exists'=>false)),array('_id'=>1,'u'=>1,'p'=>1,'ty'=>1,'dr'=>1,'tt'=>1,'da'=>1,'rl'=>1),array('sort'=>array('da'=>-1),'limit'=>10));
		$user = _::user();
		for($i=0;$i<count($u);$i++)
		{
			$u[$i]['u'] = $user->profile($u[$i]['u']);
			$u[$i]['da']=$u[$i]['da']->sec;
			if($u[$i]['dr'])$u[$i]['dr']=$u[$i]['dr']->sec;
			switch($u[$i]['ty'])
			{
				case 'line':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='โพสข้อความถึงคุณ '.$u[$i]['tt'];
					break;
				case 'gift':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='ส่งของขวัญถึงคุณ '.$u[$i]['tt'];
					break;
				case 'pet':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='ซื้อคุณเป็น Collection ในราคา '.number_format($u[$i]['tt']).' บ๊อก';
					break;
				case 'lk':
				case 'like':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='โดนข้อความของคุณ';
					break;
				case 'lk-cm':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='โดนความคิดเห็นของคุณ '.$u[$i]['tt'];
					break;
				case 'po':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='ตอบคำถามของคุณ '.$u[$i]['tt'];
					break;
				case 'vt':
					$u[$i]['ms']='โหวตโปรไฟล์ของคุณ';
					break;
				case 'friend':
					$u[$i]['ms']='ส่งคำร้องขอเป็นเพื่อน';
					break;
				case 'follow':
					$u[$i]['ms']='กำลังติดตามคุณ';
					break;
				case 'friend-accept':
					$u[$i]['ms']='ตอบรับการเป็นเพื่อนของคุณแล้ว';
					break;
				case 'sp':
				case 'spam':
					$u[$i]['u'] = $user->get(0,false);
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='มีการแจ้งสแปมภายในข้อความของคุณ';
					break;
				case 'cm':
				case 'comment':
					$u[$i]['l']='/line/'.$u[$i]['rl'];
					$u[$i]['ms']='แสดงความคิดเห็น '.$u[$i]['tt'];
					break;
			}
		}
		$ntf['ntf']=$u;
		$ntf['ds']=new MongoDate();
	}
	_::$content[]=array('method'=>'notify','data'=>$ntf);
}

while(@ob_end_clean());
if($_GET['callback'])
{
	header('Content-type: text/javascript');
	echo $_GET['callback'].'('.json_encode((array)_::$content).')';
}
else
{
	header('Content-type: application/json');
	echo json_encode(_::$content);
}
exit;
?>