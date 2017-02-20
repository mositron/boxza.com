<?php
if(_::$my['_id'])
{
	$type = 'OK';
	if(isset($_POST['key'])&&isset($_POST['val']))
	{
		switch($_POST['key'])
		{
			case 'if.fn':
			case 'if.ln':
				$val=trim(just_clean($_POST['val']));
				if(mb_strlen($val,'utf-8')<2)
				{
					$type='กรุณากรอกอย่างน้อย 2 ตัวอักษร';
				}
				else
				{
					_::user()->update(_::$my['_id'],array('$set'=>array($_POST['key']=>mb_substr($val,0,30,'utf-8'))));
					_::$my=_::user()->get(_::$my['_id'],true);
				}
				break;
			case 'if.lk':
				$link = strtolower(trim($_POST['val']));
				$invalid = require(HANDLERS.'boxza/invalid-sub.php');
				if(!preg_match('/^([0-9]+)$/',_::$my['link']))
				{
					$type='คุณกำหนดลิ้งค์โปรไฟล์ไปเรียบร้อยแล้ว';
				}
				elseif(preg_match('/^([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1})$/',$link,$c))
				{
					if(strpos($link,'..')>-1 || strpos($link,'--')>-1 || strpos($link,'.-')>-1 || strpos($link,'-.')>-1)
					{
						$type='ไม่สามารถใช้ . หรือ - ติดกันได้';
					}
					elseif(preg_match('/^([0-9]+)$/',$link))
					{
						$type='ไม่สามารถใช้เฉพาะตัวเลขได้';
					}
					elseif(is_numeric($link))
					{
						$type='ไม่สามารถใช้เฉพาะตัวเลขได้';
					}
					elseif(preg_match('/(.+)\.(php|js|css|htm|html|jpg|jpeg|png|gif)$/',$link))
					{
						$type='ไม่สามารถใช้ลิ้งค์โปรไฟล์นี้ได้';
					}
					if(strpos($link,'boxza')>-1 || strpos($link,'google')>-1 || strpos($link,'facebook')>-1 || strpos($link,'twitter')>-1 || strpos($link,'sanook')>-1 || strpos($link,'kapook')>-1 || strpos($link,'mthai')>-1)
					{
						$type='ไม่สามารถใช้งานลิ้งค์นี้ได้';
					}
					elseif(in_array($link,$invalid))
					{
						$type='ไม่สามารถใช้งานลิ้งค์นี้ได้';
					}
					elseif($db->findOne('user',array('if.lk'=>$link),array('if'=>1)))
					{
						$type='ลิ้งค์นี้มีผู้ใช้งานแล้ว กรุณาใช้ลิ้งค์อื่น';
					}
					else
					{
						_::db()->insert('line',array('u'=>_::$my['_id'],'ty'=>'link','tt'=>$link,'in'=>array(0)));
						_::user()->update(_::$my['_id'],array('$set'=>array('if.lk'=>$link)));
						_::$my=_::user()->get(_::$my['_id'],true);
					}
				}
				break;
			case 'if.bd':
					$date = intval($_POST['val']);
					if($date)
					{
						$now = date('Y');
						$year = date('Y',$date);
						$month = intval(date('m',$date));
						$day = intval(date('d',$date));
						if(($year<$now-110||$year>$now-10))
						{
							$type = 'กรุณาเลือกวันให้ถูกต้อง';
						}
						else
						{					
							_::user()->update(_::$my['_id'],array('$set'=>array('if.bd'=>new MongoDate($date),'if.bdk'=>$month.'-'.$day)));
							_::$my=_::user()->get(_::$my['_id'],true);
						}
					}
				break;
				
			case 'if.gd':
					$val = trim(strtolower($_POST['val']));
					if(isset(_::$config['gender'][$val]))
					{
							_::user()->update(_::$my['_id'],array('$set'=>array('if.gd'=>$val)));
							_::$my=_::user()->get(_::$my['_id'],true);
					}
					break;
					
			case 'if.rl':
					$val = intval(trim(strtolower($_POST['val'])));
					if(isset(_::$config['relate'][$val]))
					{
						if($val!=intval(_::$my['if']['rl']))
						{
							$db=_::db();
							$db->update('line',array('u'=>_::$my['_id'],'ty'=>'relate'),array('$set'=>array('hi'=>1)),array('multiple'=>true));				
							$op_rl=intval(_::$my['op']['pf']['rl']);									
							if((_::$config['relate'][$val]) && ($op_rl<3))
							{
								$db->insert('line',array('u'=>_::$my['_id'],'tt'=>$val,'ty'=>'relate','in'=>array($op_rl==2?-1:0)));
							}
						}
						_::user()->update(_::$my['_id'],array('$set'=>array('if.rl'=>$val)));
						_::$my=_::user()->get(_::$my['_id'],true);
					}
					break;
					
			case 'if.pr':
					$val = intval(trim($_POST['val']));
					$prov = include(HANDLERS.'boxza/province.php');
					if(isset($prov[$val]))
					{
							_::user()->update(_::$my['_id'],array('$set'=>array('if.pr'=>$val)));
							_::$my=_::user()->get(_::$my['_id'],true);
					}
					break;
					
			case 'if.ac':
			case 'op.em.rq':
			case 'op.em.ac':
			case 'op.em.ln':
					$val = oprank(intval(trim($_POST['val'])),1);
					_::user()->update(_::$my['_id'],array('$set'=>array($_POST['key']=>$val)));
					_::$my=_::user()->get(_::$my['_id'],true);
					break;
					
			case 'op.pf.al':
			case 'op.pf.ln':
					$val = oprank(intval(trim($_POST['val'])),2);
					_::user()->update(_::$my['_id'],array('$set'=>array($_POST['key']=>$val)));
					_::$my=_::user()->get(_::$my['_id'],true);
					break;
			
		}
	}
	elseif(isset($_POST['photo_base64']) && $_POST['photo_base64'])
	{
		if($img = base64_decode($_POST['photo_base64']))
		{
			$im = @imagecreatefromstring($img);
			if ($im !== false)
			{
				$f='/tmp/'._::$my['_id'].'.jpg';
				@imagejpeg($im, $f, 93);
					
				$q=_::upload()->send('s1','upload','@'.$f,array('name'=>'n','folder'=>'profile/'._::$my['if']['fd'],'width'=>200,'height'=>200,'fix'=>'width','type'=>'jpg'));
				if($q['status']=='OK')
				{
					_::upload()->send('s1','upload','@'.$f,array('name'=>'s','folder'=>'profile/'._::$my['if']['fd'],'width'=>50,'height'=>50,'fix'=>'width','type'=>'jpg'));
					_::user()->update(_::$my['_id'],array('$set'=>array('pf.av'=>'jpg')));
				}
				if(file_exists($f))
				{
					@unlink($f);
				}
			}
		}
	}
	
	$data = [];
	$data['if.av'] = _::$my['img'].'?'.rand(1,999);
	$data['if.fn'] = _::$my['if']['fn'];
	$data['if.ln'] = _::$my['if']['ln'];
	$data['if.lk'] = (is_numeric(_::$my['if']['lk'])?"":_::$my['if']['lk']);
	$data['if.gd'] = _::$my['if']['gd'];
	$data['if.pr'] = _::$my['if']['pr'];
	$data['if.bd'] = _::$my['if']['bd']->sec;
	$data['if.rl'] = _::$my['if']['rl'];
	$data['if.ac'] = _::$my['if']['ac'];
	$data['op.pf.al'] = _::$my['op']['pf']['al'];
	$data['op.pf.ln'] = _::$my['op']['pf']['ln'];
	
	$data['op.em.rq'] = intval(_::$my['op']['em']['rq']);
	$data['op.em.ac'] = intval(_::$my['op']['em']['ac']);
	$data['op.em.ln'] = intval(_::$my['op']['em']['ln']);
	
		_::$content[]=array('method'=>'setting','type'=>$type,'data'=>$data);
}



function just_clean($string)
{
	// Replace other special chars
	$s = '!@#$%^&*()_+-={}[]:";\'?/.,<>`~';
	for($i=0;$i<mb_strlen($s,'utf-8');$i++)
	{
		$string = str_replace(mb_substr($s,$i,1,'utf-8'),'', $string);
		$string = str_replace('  ',' ', $string);
	}
	return trim($string);
}

function oprank($i,$max=3)
{
	$i=intval($i);
	if($i<0 || $i>$max)
	{
		$i=0;
	}
	return $i;
}

?>