<?php
class profile
{
	public $line=[];
	private $_gift=NULL;
	private $_reason=NULL;
	
	public function __construct()
	{
		_::time();
	}
	
	public function line($who,$path='',$next=0,$limit=30)
	{
		$db = _::db();
		if(!$limit)$limit = 30;
		$coms = -3;
		$sort = ['_id'=>-1];
		$order='_id';
		$mode = (!_::$my?'profile':'');
		list($ty,$rl) = explode('-',$path,2);
		if($rl)
		{
			$ty.='-';
		}
		elseif(is_numeric($path))
		{
			$ty='numeric';
			$rl=intval($path);
		}
		elseif(empty($ty)&&_::$my)
		{
			if(!empty(_::$my['op']['ln']))
			{
				$ty=_::$my['op']['ln'];
			}
		}
		
		switch($ty)
		{
			case 'me':
				$_ = ['u'=>$who['uid'],'hi'=>['$exists'=>false],'dd'=>['$exists'=>false]];
				break;
				
			case 'profile':
				if(_::$my['_id'] && _::$my['_id']==_::$profile['_id'])
				{
					$_ = ['$or'=>[['u'=>$who['uid'],'p'=>['$exists'=>false]],['p'=>$who['uid']]],'hi'=>['$exists'=>false],'dd'=>['$exists'=>false]];
				}
				elseif(_::$my['_id'] && in_array($who['uid'],(array)_::$my['ct']['bl']))
				{
				}
				elseif(_::$my['_id'])
				{
					$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
					$_ = [
									'$and'=>[
															['$or'=>[
																					['in'=>0],
																					[
																									'in'=>-1,
																									'$or'=>[
																														['u'=>['$in'=>(array)_::$my['ct']['fl']]],
																														['p'=>['$in'=>(array)_::$my['ct']['fl']]]
																									],
																					],
																			],
															],
															['$or'=>[
																					['u'=>$who['uid'],'p'=>['$exists'=>false]],
																					['p'=>$who['uid']]
																			],
															],
									],
									'u'=>['$nin'=>$f],
									'p'=>['$nin'=>$f],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false]
								];
				}
				else
				{
					$_ = [
									'in'=>0,
									'$or'=>[
														['u'=>$who['uid'],'p'=>['$exists'=>false]],
														['p'=>$who['uid']]
									],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false]
							];
				}
				$mode='profile';
				break;
				
			case 'profile-':
				if(is_numeric($rl) && !in_array($who['uid'],(array)_::$my['ct']['bl']))
				{
					$_ = [
									'_id'=>intval($rl),
									'$or'=>[
														['u'=>$who['uid'],'p'=>['$exists'=>false]],
														['p'=>$who['uid']]
									],
									'dd'=>['$exists'=>false]
							];
					$mode='profile';
				}
				break;
				
			case 'hash-':
				if(_::$my['_id'])
				{
					$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
					$_ = [
									'$or'=>[
															['u'=>_::$my['_id']],
															['p'=>_::$my['_id']],
															['us'=>_::$my['_id']],
															[
																'in'=>0,
																'ty'=>['$ne'=>'signup'],
																'$or'=>[
																								['sp'=>['$exists'=>false]],
																								['sp.c'=>['$lt'=>5]]
																				],
																'ha'=>['$exists'=>false],
															],
															[
																'in'=>-1,
																'$and'=>[
																							['$or'=>[
																													['u'=>['$in'=>(array)_::$my['ct']['fl']]],
																													['p'=>['$in'=>(array)_::$my['ct']['fl']]],
																											],
																							],
																							['$or'=>[
																													['sp'=>['$exists'=>false]],
																													['sp.c'=>['$lt'=>5]]
																										],
																							],

																],
																'ha'=>['$exists'=>false],
														],
									],
									
									'u'=>['$nin'=>$f],
									'p'=>['$nin'=>$f],
									'hs'=>$rl,
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false],
								];
				}
				else
				{
					$_ = [
									'$or'=>[
														['sp'=>['$exists'=>false]],
														['sp.c'=>['$lt'=>5]]
									],
									'in'=>0,
									'hs'=>$rl,
									'ha'=>['$exists'=>false],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false],
							];
				}
				break;
				
			case 'list-':
				$rl=intval($rl)-1;
				if(_::$my['_id'])
				{
					if(isset(_::$my['ct']['gp'][$rl]))
					{
						$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
						$_ = [
										'$or'=>[
															['p'=>_::$my['_id']],
															['us'=>_::$my['_id']],
															[
																'in'=>0,
																'$or'=>[
																					['sp'=>['$exists'=>false]],
																					['sp.c'=>['$lt'=>5]]
																],
															],
															[
																'in'=>-1,
																'u'=>['$in'=>(array)_::$my['ct']['fl']],
																'$or'=>[
																						['sp'=>['$exists'=>false]],
																						['sp.c'=>['$lt'=>5]]	
																],
															],
										],
										'p'=>['$nin'=>$f],
										'u'=>['$nin'=>$f,'$in'=>_::$my['ct']['gp'][$rl]['u']],
										'hi'=>['$exists'=>false],
										'dd'=>['$exists'=>false],
							];
					}
				}
				break;
				
			case 'signup':
			case 'quiz':
			case 'gif':
			case 'album':
			case 'pet':
			case 'draw':
				$_ = ['ty'=>$ty,'hi'=>['$exists'=>false],'dd'=>['$exists'=>false]];
				break;
				
			case 'friends':
			case 'connect':
				if(_::$my['_id'])
				{
					$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
					$_ = [
									'$or'=>[
														['u'=>_::$my['_id']],
														['p'=>_::$my['_id']],
														[
															'u'=>['$in'=>(array)_::$my['ct']['fl']]
														],
									],
									'u'=>['$nin'=>$f],
									'p'=>['$nin'=>$f],
									'hu'=>['$ne'=>_::$my['_id']],
									'ha'=>['$exists'=>false],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false]
							];
				}
				break;
				
			case 'numeric':
				$coms = -50;
				if(_::$my)
				{
					$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
				}
				else
				{
					$f = [];
				}
				$_ = [
								'_id'=>$rl,
								'$or'=>[
													['u'=>$who['uid']],
													['p'=>$who['uid']],
													['cm.u'=>$who['uid']],
													['in'=>0],
													['us'=>$who['uid']]
								],
								'u'=>['$nin'=>$f],
								'p'=>['$nin'=>$f],
								'dd'=>['$exists'=>false]
					];
				break;
					
			case 'all':
				if(_::$my&&_::$my['am'])
				{
					$_ = [
									'ty'=>['$nin'=>['signup']],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false],
								];
				}
				break;
				
			case 'spam':
				if(_::$my&&_::$my['am'])
				{
					$_ = [
									'dd'=>['$exists'=>false],
									'sp'=>['$exists'=>true]
								];
					$sort = ['sp.ds'=>-1];
					$mode='spam';
					$this->_reason=require(HANDLERS.'boxza/reason.php');
				}
				break;
				
			default:
				if(_::$my['_id'])
				{
					$sort = ['dc'=>-1];
					$order = 'dc';
					$f = array_merge((array)_::$my['ct']['ig'],(array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2']);
					$_ = [
									'$or'=>[
														['u'=>_::$my['_id']],
														['p'=>_::$my['_id']],
														['us'=>_::$my['_id']],
														/*
														[
															'in'=>0,
															'$or'=>[
																							['sp'=>['$exists'=>false]],
																							['sp.c'=>['$lt'=>5]]
															],
															'ha'=>['$exists'=>false],
															'hr'=>['$exists'=>false],
														],
														*/
														[
															'$or'=>[
																										['sp'=>['$exists'=>false]],
																										['sp.c'=>['$lt'=>5]]
																			],
															'ha'=>['$exists'=>false],
															'hr'=>['$exists'=>false],
														]
										],
									//'u'=>['$nin'=>$f],
									//'p'=>['$nin'=>$f],
									'ty'=>['$nin'=>['signup','cover','private','relate']],
									'hu'=>['$ne'=>_::$my['_id']],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false],
							];
				}
				else
				{
					$_ = [
									'$or'=>[
														['sp'=>['$exists'=>false]],
														['sp.c'=>['$lt'=>5]]
									],
									'in'=>0,
									'ha'=>['$exists'=>false],
									'hi'=>['$exists'=>false],
									'dd'=>['$exists'=>false]
						];
				}
				break;		
		}
	
		if($next && !isset($_['_id']))
		{
			if($order=='dc')
			{
				define('SORT_DC',1);
				$last=$db->findone('line',array('_id'=>intval($next)),array('dc'=>1));
				$_['dc'] = ['$lt'=>$last['dc']];
			}
			else
			{
				$_[$order] = ['$lt'=>intval($next)];
			}
		}
		
		if(!isset($_))return;
		$_['ex']=array('$gte'=>new mongodate());
		$line = $db->find('line',$_,['_id'=>1,'ty'=>1,'tt'=>1,'u'=>1,'p'=>1,'s'=>1,'pt'=>1,'sp'=>1,'ms'=>1,'lk'=>1,'sh'=>1,'hs'=>1,'cid'=>1,'ha'=>1,'in'=>1,'us'=>1,'uk'=>1,'at'=>1,'lc'=>1,'de'=>1,'da'=>1,'ds'=>1,'ex'=>1,'cm.c'=>1,'cm.i'=>1,'cm.u'=>1,'cm.d'=>['$slice'=>$coms],'po.c'=>1,'po.d'=>1],['sort'=>$sort,'limit'=>$limit],false);
		$u = _::user();
		
		$this->line = [];
		foreach($line as $v)
		{
			if(!isset($this->line[$v['_id']]))
			{
				if($v = $this->expand($u,$v,$mode,$db))
				{
					$this->line[$v['_id']] = $v;
				}
			}
		}
		return array_values($this->line);
	}
	
	public function expand($u,$v,$mode='',$db)
	{
		$v['u'] = $u->profile($v['u']);
		if(!$v['u'])return false;
		if($v['cm'])
		{
			$cm=array();
			for($j=0;$j<count($v['cm']['d']);$j++)
			{
				if($v['cm']['d'][$j]['u'] = $u->profile($v['cm']['d'][$j]['u']))
				{
					if(in_array($v['cm']['d'][$j]['u']['_id'],(array)_::$my['ct']['bl']))
					{
					}
					elseif(in_array($v['cm']['d'][$j]['u']['_id'],(array)_::$my['ct']['bl2']))
					{
					}
					else
					{
						$v['cm']['d'][$j]['t'] = $v['cm']['d'][$j]['t']->sec;
						$v['cm']['d'][$j]['lm'] = (in_array(_::$my['_id'],(array)$v['cm']['d'][$j]['l']));
						$v['cm']['d'][$j]['lc'] = count($v['cm']['d'][$j]['l']);
						$cm[]=$v['cm']['d'][$j];
					}
				}
			}
			$v['cm']['d']=$cm;
		}
		if($v['at']&&$v['at']['l'])
		{
			$ur=parse_url($v['at']['l'],PHP_URL_HOST);
			if(strpos($ur,'boxza.com')===false)
			{
				$v['at']['l']='http://out.boxza.com/#'.base64_encode($v['at']['l']);
			}
		}
        $v['md']=$mode;
		$v['inm']=(array)$v['in'];
		if(isset($v['s']))
		{
			switch($v['s'])
			{
				case 1:
					$v['via']=['t'=>'มือถือ','l'=>'http://m.boxza.com/'];
					break;
				case 2:
					$v['via']=['t'=>'iPhone','l'=>'http://m.boxza.com/'];
					break;
				case 3:
					$v['via']=['t'=>'iPad','l'=>'http://m.boxza.com/'];
					break;
			}
		}
		if($v['p'])$v['p'] = $u->profile($v['p']);
		$da=$v['da'];
		$v['ex'] = time::show($v['ex'],'datetime',true);
		$v['da'] = $v['da']->sec;
		if($v['ds'])$v['ds'] = $v['ds']->sec;
		if($v['dc'])$v['dc'] = $v['dc']->sec;
		if($v['de'])$v['de'] = $v['de']->sec;
		if(!empty($mode))
		{
			if($mode=='profile')
			{
				$v['is_profile']=($v['p']['link']?$v['p']['link']:$v['u']['link']);
			}
			elseif($mode=='spam')
			{
				$su=[];
				$sr=[];
				for($i=count($v['sp']['u'])-1;$i>=0;$i--)
				{
					$un=$u->profile($v['sp']['u'][$i]);
					$su[]='<a href="/'.$un['link'].'" class="h">'.$un['name'].'</a>';
				}
				$r=array_unique((array)$v['sp']['r']);
				for($i=count($r)-1;$i>=0;$i--)
				{
					$sr[]=$this->_reason[$r[$i]];
				}
				$v['sp']['un']=implode(', ',$su);
				$v['sp']['rn']=implode(', ',$sr);
			}
		}
		switch($v['ty'])
		{
			case 'signup':
				$v['ms'] = 'ได้เข้าสู่โลกของ BoxZa แล้ว';
				break;
			case 'point':
				$v['ms'] = (intval($v['tt'])>0?'ได้รับ':'เสีย').'บ๊อก '.$v['tt'].'  เนื่องจาก '.$v['ms'];
				break;
			case 'link':
				$v['ms'] = 'แก้ไข้ชื่ออ้างอิงเป็น <a href="/'.$v['tt'].'" class="h">@'.$v['tt'].'</a> - http://social.boxza.com/'.$v['tt'];
				break;
			case 'relate':
				$v['ms'] = 'เปลี่ยนสถานะความสัมพันธ์เป็น "<strong>'._::$config['relate'][$v['tt']].'</strong>"';
				break;
			case 'photo':
			case 'blog':
			case 'draw':
				if($v['tt'])
				{
					$v['ms']='<div><a href="/'.$v['u']['link'].'/line/'.$v['_id'].'" class="h">'.$v['tt'].'</a> -- '.time::show($da,'date').'</div>'.$v['ms'];
				}
				if($v['pt'])
				{
					$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'].'/m.'.$v['pt']['e'];
				}
				break;
			case 'gif':
				if($v['pt'])$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'].'/o.'.$v['pt']['e'];
				break;
			case 'quiz':
				$v['ms']='<strong>Quiz</strong>: '.$v['ms'].'<br>';
				if($v['p'])
				{
					$v['ms'].='คำตอบคือ '.$v['tt']['a'].'<br>ผู้ตอบถูกคือ <a href="/'.$v['p']['link'].'" class="h">'.$v['p']['name'].'</a><br>ได้รับรางวัล '.$v['tt']['p'].' บ๊อก';
				}
				else
				{
					$v['ms'].='สามารถร่วมสนุกได้โดยการโพสคำตอบลงคอมเมนท์ด้านล่างนี้ (เฉพาะคำตอบเท่านั้น!)<br><br>ของรางวัลคือ '.$v['tt']['p'].' บ๊อก';
				}
				break;
			case 'pet':
				$v['ms'] = 'ซื้อ <a href="/'.$v['p']['link'].'" class="h">'.$v['p']['name'].'</a> เป็น Collection ในราคา '.$v['tt'].' บ๊อก';
				break;
			case 'cover':
				$v['ms'] = 'เปลี่ยนรูปภาพหน้าปกใหม่บน<a href="/'.$v['u']['link'].'" class="h">โปรไฟล์</a>';
				if($v['pt'])
				{
					$v['pt']['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'].'/m.'.$v['pt']['e'];
					//$v['pt']['tmp']=$this->crc32($v['pt']['f'],$v['pt']['n'],500,375,'inboth',$v['pt']['sv']);
				}
				break;
			case 'gift':
				if(!$this->_gift)
				{
					$this->_gift=array();
					$gift=_::db()->find('lionica_item_shop',array('ty'=>'gift'),array(),array('sort'=>array('da'=>-1)));
					foreach($gift as $g)
					{
						$this->_gift[$g['_id']]=$g;	
					}
				}
				$v['ms'] = '<strong>มอบของขวัญ '.$this->_gift[$v['tt']]['n'].' ให้ <a href="/'.$v['p']['link'].'" class="h">'.$v['p']['name'].'</a></strong><br> '.$v['ms'];
				break;
			case 'album':
				if($v['pt'])
				{
					$v['ms'] = 'เพิ่มรูปภาพใหม่ในอัลบั้ม "<a href="/photos/album-'.$v['_id'].'" class="h">'.$v['tt'].'</a>" จำนวน '.($v['pt']['l']<$v['pt']['c']?$v['pt']['l']:$v['pt']['c']).' รูปภาพ'.($v['pt']['l']<$v['pt']['c']?' จากทั้งหมด '.$v['pt']['c'].' รูปภาพ':'');
					if($v['pt']['f'])
					{
						$c=count($v['pt']['f']);
						for($b=0;$b<count($v['pt']['f']);$b++)
						{
							//if((_::$type=='mobile')||($c==3 && $b>0) ||($c==4 && $b>1) || ($c==5 && $b>0) || ($c>5))
							//{
								$v['pt']['f'][$b]['tmp']='http://s1.boxza.com/line/'.$v['pt']['f'][$b]['f'].'/s.'.$v['pt']['f'][$b]['e'];
								$v['pt']['f'][$b]['tmp2']='http://s1.boxza.com/line/'.$v['pt']['f'][$b]['f'].'/m.'.$v['pt']['f'][$b]['e'];
								
								//$v['pt']['f'][$b]['tmp']=$this->crc32($v['pt']['f'][$b]['f'],$v['pt']['f'][$b]['n'],200,120,'both',$v['pt']['f'][$b]['sv']);
							//}
							//else
							//{
								//$v['pt']['f'][$b]['tmp2']=$this->crc32($v['pt']['f'][$b]['f'],$v['pt']['f'][$b]['n'],500,375,'inboth',$v['pt']['f'][$b]['sv']);
							//}
						}
					}
				}
				break;
			case 'share':
				if($v['sh']['f'])
				{
					if(!isset($this->line[$v['_id']]))
					{
						$p=$db->findOne('line',['_id'=>$v['sh']['f'],'dd'=>['$exists'=>false]],['_id'=>1,'ty'=>1,'tt'=>1,'u'=>1,'p'=>1,'s'=>1,'pt'=>1,'ms'=>1,'lk'=>1,'sh'=>1,'serv'=>1,'thumb'=>1,'cid'=>1,'in'=>1,'us'=>1,'at'=>1,'lc'=>1,'po.c'=>1,'po.d'=>1]);
						$this->line[$v['_id']]=($p?$this->expand($u,$p,$mode,$db):'');
					}
					$v['sh']['d']=$this->line[$v['_id']];
				}
				break;
			default:
			
		}
		return $v;
	}
	
	
	public function crc32($folder,$file,$width=100,$height=100,$crop='both',$serv='1')
	{
		list($last,$type)=explode('.',$file,2);
		if($width==500)
		{
			return 'http://s1.boxza.com/line/'.$folder.'/m.'.$type;	
		}
		elseif($width==200)
		{
			return 'http://s1.boxza.com/line/'.$folder.'/s.'.$type;	
		}
		else
		{
			return 'http://s1.boxza.com/line/'.$folder.'/o.'.$type;
		}
	}
}