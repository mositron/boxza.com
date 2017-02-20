<?php


function morephotos($next=0)
{
	_::ajax()->jquery('#getphotos','append',getphotos($next));
	_::ajax()->script('_.profile.pt.layout(\'.photos > li\');_.profile.updating=false;');
}

function newalbum($arg)
{
	if(_::$my)
	{
		$t=trim($arg['title']);
		$tya=intval($arg['category']);
		if(!$t)
		{
			_::ajax()->alert('กรุณากรอกชื่ออัลบั้ม');
		}
		elseif(!$tya)
		{
			_::ajax()->alert('กรุณาเลือกประเภทอัลบั้ม');
		}
		else
		{
			$db = _::db();
			$count = intval($db->count('line',array('u'=>_::$my['_id'],'ty'=>'album','dd'=>array('$exists'=>false))));
			if($count<100)
			{
				$id=$db->insert('line',array('u'=>_::$my['_id'],'tt'=>mb_substr($t,0,50,'utf-8'),'ty'=>'album','pt'=>array('ty'=>$tya),'in'=>array(0),'hi'=>1));
				_::ajax()->script('_.line.go("/photos/album-'.$id.'");');
				//_::ajax()->redirect('http://album.boxza.com/update/'.$id);
			}
			else
			{
				_::ajax()->alert('คุณสามารถสร้างอัลบั้มได้สูงสุด 100 อัลบั้มเท่านั้น');
			}
			//_::ajax()->script('_.line.go("/photos/album-'.$id.'",true)');
		}
	}
}

function editfilter($line)
{
	if(_::$my)
	{
		if($p = _::db()->findOne('line',array('_id'=>intval($line),'u'=>_::$my['_id'],'ty'=>'photo'),array('_id'=>1,'pt'=>1,'hi'=>1)))
		{
			$f = 'http://s1.boxza.com/line/'.$p['pt']['f'].'/o.'.$p['pt']['e'];
			#if(file_exists($f))
			#{
				_::ajax()->script('_.profile.pt.efilter('.$line.',"'.base64_encode(file_get_contents($f)).'","'.$p['pt']['e'].'",'.intval($p['hi']).')');
			#}
		}
	}
}

function savefilter($arg)
{
	if(_::$my)
	{
		if($p = _::db()->findOne('line',array('_id'=>intval($arg['l']),'u'=>_::$my['_id'],'ty'=>'photo','dd'=>array('$exists'=>false)),array('_id'=>1,'pt'=>1,'hi'=>1)))
		{
			$update=false;
			if($arg['f'])
			{
				try
				{
					if($img = base64_decode($arg['f']))
					{
						$im = @imagecreatefromstring($img);
						if ($im !== false)
						{
							if(imagesx($im)==$p['pt']['w'] && imagesy($im)==$p['pt']['h'])
							{
								$update=true;
								$q=_::upload()->send('s1','fromstring','line/'.$p['pt']['f'].'/o.'.$p['pt']['e'],array('ext'=>$p['pt']['e'],'string'=>$arg['f']));
							}							
						}
						else
						{
							_::ajax()->alert('สร้างรูปภาพจากข้อความไม่ได้');
						}
					}
					else
					{
						_::ajax()->alert('decode ไม่ถูกต้อง');
					}
				} catch (Exception $e) {$err = $e->getMessage();}
			}
			if(($rotate=intval($arg['r'])) && $rotate>0)
			{
				$rotate = ($rotate % 4);
				if($rotate > 0)
				{
					$rotate = $rotate*90;
					$q=_::upload()->send('s1','rotate','line/'.$p['pt']['f'].'/o.'.$p['pt']['e'],array('ext'=>$p['pt']['e'],'rotate'=>$rotate));
					$update=true;
				}
			}
			if($update)
			{
				
				$q=_::upload()->send('s1','getsize','line/'.$p['pt']['f'].'/o.'.$p['pt']['e']);
				if($q['status']=='OK')
				{
					_::db()->update('line',array('_id'=>intval($arg['l'])),array('$set'=>array('pt.w'=>$q['data']['w'],'pt.h'=>$q['data']['h'],'pt.s'=>$q['data']['s'])));
				}
				list($name,$ext)=explode('.',$p['pt']['n'],2);
				_::upload()->send('s1','line-thumb','line/'.$p['pt']['f'].'/o.'.$p['pt']['e'],array('to'=>$p['pt']['f'],'ext'=>$p['pt']['e']));
							
				_::ajax()->script('$(".ln-'.$arg['l'].' .i a img").attr("src","'._::profile()->crc32($p['pt']['f'],$p['pt']['n'],200,120,'both',$p['pt']['sv']).'?'.time().'");');
				_::ajax()->script('_.profile.pt.cache="?'.time().'";');
			}
		}
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
			if($p=$db->findOne('line',array('_id'=>intval($arg['_id'][$i]),'u'=>_::$my['_id'])))
			{
				if(!$album)$album=$p['pt']['a'];
				$upd=array('ms'=>trim(mb_substr(htmlspecialchars(stripslashes($arg['detail'][$i]),ENT_QUOTES,'utf-8'),0,2048,'utf-8')));
				if(isset($arg['to'][$i]))
				{
					$to = intval($arg['to'][$i]);
					$upd['in']=(in_array($to,array(0,-1))?$to:0);
				}
				$db->update('line',array('_id'=>$p['_id']),array('$set'=>$upd));
			}
		}
	}
	_::ajax()->script('_.line.go("/photos/album-'.$album.'",true)');
}

function setcover($album,$photo)
{
	$db=_::db();
	if(_::$my)
	{
		if($al=$db->findOne('line',array('_id'=>intval($album),'ty'=>'album','u'=>_::$my['_id'])))
		{
			if($pt=$db->findOne('line',array('_id'=>intval($photo),'ty'=>'photo','u'=>_::$my['_id'],'pt.a'=>$al['_id'],'dd'=>array('$exists'=>false))))
			{
				$db->update('line',array('_id'=>$al['_id']),array('$set'=>array('pt.cv'=>array('i'=>$pt['_id'],'f'=>$pt['pt']['f'],'e'=>$pt['pt']['e']))));
				_::ajax()->script('_.line.go("/photos/album-'.$album.'")');
			}
		}
	}
}

function setalbum($arg)
{
	if(_::$my)
	{
		$tt=trim(mb_substr(htmlspecialchars(stripslashes(strval($arg['title'])),ENT_QUOTES,'utf-8'),0,100,'utf-8'));
		$ms=trim(mb_substr(htmlspecialchars(stripslashes(strval($arg['detail'])),ENT_QUOTES,'utf-8'),0,2048,'utf-8'));
		$tya=intval($arg['category']);
		$in=intval($arg['in']);
		$in=in_array($in,array(-2,-1,0))?$in:0;
		if(!$tt)
		{
			_::ajax()->alert('กรุณากรอกชื่ออัลบั้ม');
		}
		elseif(!$tya)
		{
			_::ajax()->alert('กรุณาเลือกประเภทอัลบั้ม');
		}
		else
		{
			$db=_::db();
			if($al=$db->findOne('line',array('_id'=>intval($arg['line']),'ty'=>'album','u'=>_::$my['_id'],'dd'=>array('$exists'=>false))))
			{
				$db->update('line',array('_id'=>$al['_id']),array('$set'=>array('tt'=>$tt,'pt.ty'=>$tya,'ms'=>$ms,'in'=>array($in))));
				_::ajax()->script('_.line.go("/photos/album-'.$al['_id'].'")');
			}
		}
	}
}
?>