<?php
function save($name,$value,$input)
{
	$ajax=_::ajax();
	$db=_::db();
	$html=_::html();
	if(in_array($name,array('tt','ms','ty','in','rc')))
	{
		if($name=='tt')
		{
			$tt=trim(mb_substr(htmlspecialchars(stripslashes(strval($value)),ENT_QUOTES,'utf-8'),0,100,'utf-8'));
			if($tt)
			{
				$db->update('line',array('_id'=>intval(_::$path[0])),array('$set'=>array('tt'=>$tt)));
			}
			$tmp=$db->findone('line',array('_id'=>intval(_::$path[0])),array('tt'=>1));
			list($text,$input)=$html->form($name,$tmp['tt'],$input);
			$ajax->html($name,$text,$input);
		}
		elseif($name=='ms')
		{
			$ms=trim(mb_substr(htmlspecialchars(stripslashes(strval($value)),ENT_QUOTES,'utf-8'),0,2048,'utf-8'));
			$db->update('line',array('_id'=>intval(_::$path[0])),array('$set'=>array('ms'=>$ms)));
			$tmp=$db->findone('line',array('_id'=>intval(_::$path[0])),array('ms'=>1));
			list($text,$input)=$html->form($name,$tmp['ms'],$input);
			$ajax->html($name,$text,$input);
		}
		elseif($name=='ty')
		{
			$db->update('line',array('_id'=>intval(_::$path[0])),array('$set'=>array('pt.ty'=>intval($value))));
			
			$tmp=$db->findone('line',array('_id'=>intval(_::$path[0])),array('pt.ty'=>1));
			list($text,$input)=$html->form($name,$tmp['pt']['ty'],$input,false,_::$config['album']);
			$ajax->html($name,$text,$input);
		}
		elseif($name=='in')
		{
			$in=intval($value);
			$in=in_array($in,array(-2,-1,0))?$in:0;
			$db->update('line',array('_id'=>intval(_::$path[0])),array('$set'=>array('in'=>$in)));
			$tmp=$db->findone('line',array('_id'=>intval(_::$path[0])),array('in'=>1));
			list($text,$input)=$html->form($name,$tmp['in'],$input,false,array('0'=>'สาธารณะ','-1'=>'เฉพาะเพื่อน','-2'=>'เฉพาะฉัน'));
			$ajax->html($name,$text,$input);
		}
		elseif($name=='rc')
		{
			if(_::$my['am'])
			{
				$rc=intval($value);			
				if($rc)
				{
					$db->update('line',array('rc.ab'=>$rc),array('$set'=>array('rc.ab'=>0)),array('multiple'=>true));
				}
				$db->update('line',array('_id'=>intval(_::$path[0])),array('$set'=>array('rc.ab'=>$rc)));
				_::cache()->delete('ca1','home',0);
			}
			else
			{
				$ajax->alert('คุณไม่มีสิทธิ์ตั้งค่านี้ได้');
			}
			$tmp=$db->findone('line',array('_id'=>intval(_::$path[0])),array('rc.ab'=>1));
			list($text,$input)=$html->form($name,intval($tmp['rc']['ab']),$input,false,array('0'=>'ไม่ตั้งเป็นอัลบั้มแนะนำ','1'=>'ตำแหน่งที่ 1','2'=>'ตำแหน่งที่ 2','3'=>'ตำแหน่งที่ 3','4'=>'ตำแหน่งที่ 4','5'=>'ตำแหน่งที่ 5','6'=>'ตำแหน่งที่ 6','7'=>'ตำแหน่งที่ 7','8'=>'ตำแหน่งที่ 8','9'=>'ตำแหน่งที่ 9','10'=>'ตำแหน่งที่ 10','11'=>'ตำแหน่งที่ 11','12'=>'ตำแหน่งที่ 12','13'=>'ตำแหน่งที่ 13','14'=>'ตำแหน่งที่ 14','15'=>'ตำแหน่งที่ 15','16'=>'ตำแหน่งที่ 16'));
			$ajax->html($name,$text,$input);
		}
	}
}

function setcover($photo)
{
	$db=_::db();
	if(_::$my)
	{
		if($al=$db->findOne('line',array('_id'=>intval(_::$path[0]),'ty'=>'album')))
		{
			if($pt=$db->findOne('line',array('_id'=>intval($photo),'ty'=>'photo','u'=>$al['u'],'pt.a'=>$al['_id'],'dd'=>array('$exists'=>false))))
			{
				$db->update('line',array('_id'=>$al['_id']),array('$set'=>array('pt.cv'=>array('i'=>$pt['_id'],'f'=>$pt['pt']['f'],'n'=>$pt['pt']['n']))));
				getrefresh();
			}
		}
	}
}


function delline($line)
{
	$db=_::db();
	if($tmp = $db->findOne('line',array('_id'=>intval($line)),array('_id'=>1,'u'=>1,'s'=>1,'p'=>1,'pt'=>1,'sh'=>1,'ty'=>1,'lo'=>1,'dd'=>1)))
	{
		if(_::$my && !$tmp['lo'] && !$tmp['dd'])
		{
			if($tmp['u']==_::$my['_id']||_::$my['am']>=9)
			{
				$db->update('line',array('_id'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())));
				if($tmp['ty']=='album')
				{
					$db->update('line',array('pt.a'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
				}
				elseif($tmp['ty']=='photo')
				{
					if($tmp['pt']['a'])
					{
						if($album=$db->findOne('line',array('_id'=>intval($tmp['pt']['a']),'ty'=>'album'),array('_id'=>1,'pt'=>1)))
						{
							if(!is_array($album['pt']))$album['pt']=array();
							if($album['pt']['cv'] && $album['pt']['cv']['i']==intval($line))
							{
								unset($album['pt']['cv']);
							}
							$album['pt']['c']=max(intval($album['pt']['c'])-1,0);
							if(is_array($album['pt']['f']))
							{
								for($i=0;$i<count($album['pt']['f']);$i++)
								{
									if($album['pt']['f'][$i]['i']==intval($line))
									{
										unset($album['pt']['f'][$i]);
										$album['pt']['l']=max(intval($album['pt']['l'])-1,0);
										break;
									}
								}
							}
							$album['pt']['f']=array_values((array)$album['pt']['f']);
							$db->update('line',array('_id'=>$album['_id']),array('$set'=>array('pt'=>$album['pt'])));
						}
					}
				}
			}
		}
		getrefresh();
	}
}


function setdetail($arg=array())
{
	$album=0;
	if(_::$my && $arg['_id'])
	{
		if(!is_array($arg['_id']))
		{
			$arg['_id']=array($arg['_id']);
			$arg['detail']=array($arg['detail']);
			$arg['to']=array($arg['to']);
		}
		$db=_::db();
		for($i=0;$i<count($arg['_id']);$i++)
		{
			if($p=$db->findOne('line',array('_id'=>intval($arg['_id'][$i]),'dd'=>array('$exists'=>false))))
			{
				if(_::$my['am']>=9 || $p['u']==_::$my['_id'])
				{
					if(!$album)$album=$p['pt']['a'];
					$upd=array('ms'=>trim(mb_substr(htmlspecialchars(stripslashes($arg['detail'][$i]),ENT_QUOTES,'utf-8'),0,2048,'utf-8')));
					if(isset($arg['to'][$i]))
					{
						$to = intval($arg['to'][$i]);
						$upd['in']=(in_array($to,array(0,-1))?$to:0);
					}
					$db->update('line',array('_id'=>$p['_id']),array('$set'=>$upd));
					if($arg['edit'])_::ajax()->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
				}
			}
		}
	}
}


function getdetail($id)
{
	$album=0;
	if(_::$my && $id)
	{
		if($p=_::db()->findone('line',array('_id'=>intval($id),'dd'=>array('$exists'=>false))))
		{
			if(_::$my['am']>=9 || $g['u']==_::$my['_id'])
			{
				_::ajax()->script('getdetail('.json_encode(array('_id'=>$p['_id'],'img'=>'http://s1.boxza.com/line/'.$p['pt']['f'].'/s.'.$p['pt']['e'],'ms'=>strval($p['ms']),'pin'=>intval($p['in']))).')');
			}
		}
	}
}

function getrefresh()
{
	_::template()->assign('album',_::db()->findOne('line',array('_id'=>intval(_::$path[0]),'ty'=>'album')));
		_::ajax()->jquery('#getphotos','html',getphotos());
}
?>
