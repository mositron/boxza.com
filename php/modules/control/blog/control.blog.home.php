<?php

$arg=array();
$error=array();
$db=_::db();

$cate=array(
'2'=>'ทั่วไป',
'3'=>'การเมือง',
'4'=>'กีฬา',
'5'=>'เกมส์',
'6'=>'เทคโนโลยี',
'7'=>'บันเทิง',
'8'=>'ภาพยนตร์',
'9'=>'เพลง',
'10'=>'ไลฟ์สไตล์',
'11'=>'ลึกลับ',
'12'=>'โดนๆ',
'13'=>'สังคมออนไลน์',
'14'=>'หวย',
'15'=>'ดูดวง',
'16'=>'พยากรณ์อากาศ',
'17'=>'บ้าน',
'18'=>'ท่องเที่ยว',
'19'=>'แม่และเด็ก',
'20'=>'แต่งงาน',
'21'=>'สัตว์เลี้ยง',
'22'=>'การศึกษา',
'23'=>'สุขภาพ',
'24'=>'รถยนต์'
);

$ac=$db->find('wpbg_domain');

if($_POST)
{
	$arg['t']=trim(stripslashes($_POST['t']));
	$arg['d']=trim(stripslashes($_POST['d']));
	$arg['c']=intval(trim($_POST['c']));
	$arg['kw']=trim(stripslashes($_POST['kw']));
	$arg['kl']=trim(stripslashes($_POST['kl']));
	$arg['k']=trim(stripslashes($_POST['k']));
	$ac=array();

	$time=time();
	$dlen=mb_strlen(str_replace(array(' ','&nbsp;'),array('',''),strip_tags($arg['d'])),'utf-8');
	if($dlen<500)
	{
		$error['d']='เนื้อหาสั้นเกินไป, อย่างน้อย 500 ตัวอักษร';
	}
	elseif($arg['t']&&$arg['d']&&$arg['c']&&$arg['k'])
	{
		if($last=$db->find('wpbg_domain',array('pl'=>1),array(),array('sort'=>array('ds'=>1),'limit'=>1)))
		{
			$blog=$last[0];
			$postid=wpp($blog,$arg);
			$la=array('i'=>$blog['_id'],'kw'=>$arg['kw'],'kl'=>$arg['kl'],'d'=>$blog['d'],'t'=>$arg['t'],'dt'=>$arg['d'],'k'=>$arg['k'],'da'=>new MongoDate(),'u'=>_::$my['_id']);
			$la['st']=$postid[0];
			$la['l']=$postid[1];
			$db->insert('wpbg',$la);
			$db->update('wpbg_domain',array('_id'=>$blog['_id']),array('$set'=>array('ds'=>new MongoDate())));
			_::move('?'.($la['st']?'url':'error').'='.urlencode($postid[1]));
		}
	}
}
function wpp($blog,$arg)
{
	$arg['t'] = htmlentities($arg['t'],ENT_NOQUOTES,'utf-8');
	
	$d=explode('{KEYWORD}',$arg['d']);
	if(count($d)>1)
	{
		if(count($d)==2)
		{
			$pos=0;	
		}
		else
		{
			$pos=rand(0,count($d)-2);
		}
		$detail='';
		for($i=0;$i<count($d);$i++)
		{
			$detail.=$d[$i];
			if($i<count($d)-1)
			{
				if(($pos==$i) && $arg['kl'])
				{
					$detail.='<a href="'.$arg['kl'].'" target="_blank">'.$arg['kw'].'</a>';	
				}
				else
				{
					$detail.='<strong>'.$arg['kw'].'</strong>';
				}
			}
		}
	}
	else
	{
		$detail=$arg['d'];
	}
	//$arg['d'] = htmlentities($arg['d'],ENT_NOQUOTES,'utf-8');
	$arg['k'] = htmlentities($arg['k'],ENT_NOQUOTES,'utf-8');
	
	$content = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'post_title' => $arg['t'],
        'post_content' => $detail,
      //  'terms' => array('category'=>array($arg['c'])),
        'comment_status' => 'closed',
    );
	
	$request = xmlrpc_encode_request('wp.newPost', array(0,$blog['u'],$blog['p'],$content),array('encoding'=>'UTF-8','escaping'=>'markup'));
	$context = stream_context_create(array('http' => array(
		'method' => "POST",
		'header' => "Content-Type: text/xml",
		'content' => $request
	)));
	
	//restore_error_handler();
	try
	{
		$file = file_get_contents('http://'.$blog['d'].'/xmlrpc.php', false, $context);
		//{
		//	die('ไม่สามารถติดต่อ: '.'http://'.$blog['d'].'/xmlrpc.php');
		//}
	}
	catch (Exception $e) {
		die('http://'.$blog['d'].'/xmlrpc.php'.'<br>'.$e->getMessage());
	}
	
	$response = xmlrpc_decode($file);
	if ($response && is_array($response) && xmlrpc_is_fault($response))
	{
		$status=false;
		$ms=$response['faultString'];
	} else {
		$status=true;
		$ms='http://'.$blog['d'].'/?p='.$response;
	}
	return array($status,$ms);
}

$user=_::user();
$lastseo=$db->find('wpbg',array(),array(),array('sort'=>array('_id'=>-1),'limit'=>10));


$template=_::template();
$template->assign('error',$error);
$template->assign('post',$arg);
$template->assign('cate',$cate);
$template->assign('user',$user);
$template->assign('lastseo',$lastseo);

_::$content=$template->fetch('blog.home');

?>