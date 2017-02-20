<?php

//_::time();
$db=_::db();


$access=check_perm('gift');

if($_GET['cmd'])
{
	if(!$access)
	{
		_::move(URL);	
	}
}

if($access)
{
	if(isset($_FILES) && isset($_FILES['thumb']))
	{
		$s=array('status'=>'FAIL','message'=>'ไฟล์ไม่ถูกต้อง');
		if($_POST['gift'])
		{
			if($m=$_FILES['thumb']['tmp_name'])
			{
				$q=_::upload()->send('s1','gift-upload','@'.$m,array('name'=>strtolower($_POST['gift'])));
				if($q['status']=='OK')
				{
					$s['status']='OK';
					$s['pic']='http://s1.boxza.com/gift/128/'.$q['data']['n'].'?rand='.rand(1,999);
				}
				$s['message']=$q['message'].' - '.$q['status'];
			}
		}
		echo json_encode($s);
		exit;
	}
	
	if($_POST&&$_POST['name'])
	{
		require_once(__DIR__.'/control.gift.post.php');
	}
	
	_::ajax()->register(array('update'));
}

extract(_::split()->get('/gift/',0,array('page')));

if($count=$db->count('lionica_item_shop',array('ty'=>'gift')))
{
	list($pg,$skip)=_::pager()->bootstrap(50,$count,array($url,'page-'),$page);
	$gift=$db->find('lionica_item_shop',array('ty'=>'gift'),array(),array('skip'=>$skip,'limit'=>50,'sort'=>array('da'=>-1)));
}

$template->assign('access',$access);
$template->assign('count',$count);
$template->assign('gift',$gift);
$template->assign('pager',$pg);
$template->assign('user',_::user());
$template->assign('html',_::html());
_::$content=$template->fetch('gift');



function update($service,$type,$id,$value,$input='input')
{
	$db=_::db();
	$html=_::html();
	$ajax=_::ajax();
	$value=trim($value);
	if($service=='gift')
	{
		if(in_array($type,array('n','ex','pr','pl')))	
		{
			if($type=='n')
			{
				$db->update('lionica_item_shop',array('_id'=>$id),array('$set'=>array($type=>$value)));	
			}
			elseif(in_array($type,array('ex','pr')))
			{
				if(!$value)
				{
					$value=30;	
				}
				$db->update('lionica_item_shop',array('_id'=>$id),array('$set'=>array($type=>intval($value))));	
			}
			elseif(in_array($type,array('pl')))
			{
				$db->update('lionica_item_shop',array('_id'=>$id),array('$set'=>array($type=>intval($value))));	
			}
			$tmp=$db->findone('lionica_item_shop',array('_id'=>$id),array($type=>1));
			
			if($type=='pl')
			{
				list($text,$input)=$html->form($service.'_'.$type.'_'.$id,$tmp[$type],$input,array('tag'=>'div','full'=>1,'button'=>false),array('<strong class="pl0">ไม่แสดง</strong>','<strong class="pl1">แสดง</strong>'));
			}
			else
			{
				list($text,$input)=$html->form($service.'_'.$type.'_'.$id,$tmp[$type],$input);
			}
			$ajax->html($service.'_'.$type.'_'.$id,$text,$input);
		}
	}
}
?>