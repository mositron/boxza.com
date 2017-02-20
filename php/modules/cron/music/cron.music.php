<?php
//http://images.rsonlinemusic.com/_content/musichub-images/default/default120x120.jpg
//http://www.rsonlinemusic.com/music.php?xajax=ajax_song_archive&xajaxr=1346579665677&xajaxargs[]=1&xajaxargs[]=8401&xajaxargs[]=9&xajaxargs[]=1&xajaxargs[]=1000&xajaxargs[]=10

require_once(__DIR__.'/simple_html_dom.php');

//_::db()->update('music_request',array(),array('$set'=>array('du'=>new MongoDate())),array('multiple'=>true));


if($_GET['ty']=='gm')
{
	getgmmusic();
}
elseif($_GET['ty']=='yp')
{
	getypmusic();
}
elseif($_GET['ty']=='rs')
{
	getrsmusic();
}
elseif($_GET['ty']=='ly')
{
	getlyrics();
}
else
{
	$s = rand(1,100);
	if($s<=30)
	{
		echo '---- rnd : '.$s.' : find song -----<br>';
		getgmmusic();
		getypmusic();
		getrsmusic();
	}
	else
	{
		echo '---- rnd : '.$s.' : find lyric -----<br>';
		getlyrics();
	}
}


function getypmusic()
{
	$html=str_get_html(_::http()->get('http://music.you2play.com/new_released/thai/'));
	$c=$html->find('.build_block_128');
	echo '--'.count($c).'--<pre>';
	$music=array();
	$db=_::db();
	if(count($c))
	{
		$k=1;
		foreach($c as $c2)
		{
			$ty='';
			$arg=array('ty'=>'yp');
			$arg['sid']= strval($c2->pi_id);
			$arg['img'] = trim($c2->find('a._player img',0)->src);
			$arg['t']=trim($c2->find('.song_title a',0)->innertext);
			$i=mb_stripos($arg['t'],'feat.',0,'utf-8');
			if($i>-1)
			{
				$l=mb_strlen($arg['t']);
				$arg['f']=trim(mb_substr($arg['t'],$i+5,$l-$i-5,'utf-8'));
				$arg['t']=trim(mb_substr($arg['t'],0,$i,'utf-8'));
			}
			$arg['a']=strval(trim($c2->find('.artist_title a',0)->innertext));
			array_unshift($music,$arg);
			print_r($arg);
		}
		
		foreach($music as $arg)
		{
			if($arg['sid']&&$arg['t'])
			{
				if(!$db->findone('music_request',array('ty'=>$arg['ty'],'sid'=>$arg['sid'])))
				{
					$arg['du']=new MongoDate(time()-(30*24*3600));
					$db->insert('music_request',$arg);
				}
			}
		}
	}
}

function getgmmusic()
{
	//http://music.gmember.com/music/song/renderNotInTopNewSongs/page/19
	
	
	$html=str_get_html(_::http()->get('http://music.gmember.com/music/song/renderNotInTopNewSongs/page/1'));
	$c=$html->find('#listLanding ul li');
	echo '--'.count($c).'--<pre>';
	$music=array();
	$db=_::db();
	if(count($c))
	{
		$k=1;
		foreach($c as $c2)
		{
			$ty='';
			$arg=array('ty'=>'gm');
			$arg['sid']= substr(strstr(trim($c2->find('a.cover',0)->href),'/Song-'),6);
			$arg['img'] = trim($c2->find('div.piccover div span img',0)->src);
			$arg['t']=trim($c2->find('p.tt a',0)->innertext);
			$i=mb_stripos($arg['t'],'feat.',0,'utf-8');
			if($i>-1)
			{
				$l=mb_strlen($arg['t']);
				$arg['f']=trim(mb_substr($arg['t'],$i+5,$l-$i-5,'utf-8'));
				$arg['t']=trim(mb_substr($arg['t'],0,$i,'utf-8'));
			}
			$arg['a']=strval(trim($c2->find('> p',1)->innertext));
			array_unshift($music,$arg);
			print_r($arg);
		}
		
		foreach($music as $arg)
		{
			if($arg['sid']&&$arg['t'])
			{
				if(!$db->findone('music_request',array('ty'=>$arg['ty'],'sid'=>$arg['sid'])))
				{
					$arg['du']=new MongoDate(time()-(30*24*3600));
					$db->insert('music_request',$arg);
				}
			}
		}
	}
}


function getlyrics()
{
	
	$db=_::db();
	if($m=$db->find('music_request',array('mid'=>array('$exists'=>false)),array(),array('sort'=>array('du'=>1,'_id'=>1),'limit'=>10)))
	{
		foreach($m as $v)
		{
			$db->update('music_request',array('_id'=>$v['_id']),array('$set'=>array('du'=>new MongoDate())));
			if($v['ty']=='rs')
			{
				$html=str_get_html(_::http()->get('http://www.rsonlinemusic.com/song.php?song_id='.$v['sid']));
				if($c=$html->find('.songLyric',0))
				{
					$arg=array();
					$arg['sn']=strval(trim($c->find('.songName span',0)->innertext));
					$arg['ar']=strval(trim($c->find('.artistName span',0)->innertext));
					$arg['al']=strval(trim($c->find('.albumName span',0)->innertext));
					$arg['ly']=strval(trim($c->find('p',0)->innertext));
					$arg['ly']=trim(str_replace("<br />\r\n","\r\n",$arg['ly']));
					$arg['ly']=trim(strip_tags(trim(str_replace("<br />","\r\n",$arg['ly']))));
					if($arg['sn']&&$arg['ar']&&$arg['al']&&$arg['ly'])
					{
						if(!$song=$db->findone('music',array('ty'=>$v['ty'],'sid'=>$v['sid'])))
						{
							$arg['ty']=$v['ty'];
							$arg['sid']=$v['sid'];
							$arg['fc']=array('sn'=>getfirstchar($arg['sn']),'ar'=>getfirstchar($arg['ar']));
							$id=$db->insert('music',$arg);
							$fd = _::folder()->fd($id);
							$folder = substr($fd,0,2).'/'.substr($fd,2,2);
							$name = substr($fd,4,2);
							$v['img']=str_replace(' ','%20',$v['img']);
							if($v['img'] && ($v['img']!='http://images.rsonlinemusic.com/_content/musichub-images/default/default120x120.jpg'))
							{
								@copy($v['img'],'/tmp/img.music.txt');
								$q=_::upload()->send('s3','upload','@/tmp/img.music.txt',array('name'=>$name,'folder'=>'music/'.$folder,'width'=>150,'height'=>150,'fix'=>'inboth','type'=>'jpg'));
								//if($o=_::photo()->thumb($name,$v['img'],'music/'.$folder,150,150,'inboth','jpg'))
								if($q['status']=='OK')
								{
									$db->update('music',array('_id'=>intval($id)),array('$set'=>array('fd'=>$folder,'s'=>$q['data']['n'])));
								}
							}
							$db->update('music_request',array('_id'=>$v['_id']),array('$set'=>array('mid'=>$id)));
						}
					}
					print_r($v);
					print_r($arg);
				}
			}
			elseif($v['ty']=='gm')
			{
				$html=str_get_html(_::http()->get('http://music.gmember.com/zzz/Song-'.$v['sid']));
				if($c=$html->find('#lyrics',0))
				{
					$arg=array();
					$c2=$html->find('div.deLeft div.title > p');
					foreach($c2 as $p)
					{
						$txt = trim(strip_tags($p->innertext));
						list($p1,$p2)=explode(':',$txt);
						$p1=trim($p1);
						$p2=trim($p2);
						if($p1=='เพลง')
						{
							$arg['sn']=$p2;
						}
						elseif($p1=='ศิลปิน')
						{
							$arg['ar']=$p2;
						}
						elseif($p1=='อัลบั้ม')
						{
							$arg['al']=$p2;
						}
					}
					
					echo '--'.count($c2).'--';
					$arg['ly']=strval(trim($c->innertext));
					$arg['ly']=trim(str_replace("<br />\r\n","\r\n",$arg['ly']));
					$arg['ly']=trim(strip_tags(trim(str_replace("<br />","\r\n",$arg['ly']))));
					
					print_r($arg);
				
				
					if($arg['sn']&&$arg['ar']&&$arg['al']&&$arg['ly'])
					{
						if(!$song=$db->findone('music',array('ty'=>$v['ty'],'sid'=>$v['sid'])))
						{
							$arg['ty']=$v['ty'];
							$arg['sid']=$v['sid'];
							$arg['fc']=array('sn'=>getfirstchar($arg['sn']),'ar'=>getfirstchar($arg['ar']));
							$id=$db->insert('music',$arg);
							
							
							$fd = _::folder()->fd($id);
							$folder = substr($fd,0,2).'/'.substr($fd,2,2);
							$name = substr($fd,4,2);
							$v['img']=str_replace(' ','%20',$v['img']);
							if($v['img'] && ($v['img']!='http://www.gmember.com/cover/100.jpg'))
							{
								@copy($v['img'],'/tmp/img.music.txt');
								$q=_::upload()->send('s3','upload','@/tmp/img.music.txt',array('name'=>$name,'folder'=>'music/'.$folder,'width'=>150,'height'=>150,'fix'=>'inboth','type'=>'jpg'));
								//if($o=_::photo()->thumb($name,$v['img'],'music/'.$folder,150,150,'inboth','jpg'))
								if($q['status']=='OK')
								{
									$db->update('music',array('_id'=>intval($id)),array('$set'=>array('fd'=>$folder,'s'=>$q['data']['n'])));
								}
							}
							$db->update('music_request',array('_id'=>$v['_id']),array('$set'=>array('mid'=>$id)));
						}
					}
				}
			}
			elseif($v['ty']=='yp')
			{
				$html=str_get_html(_::http()->get('http://music.you2play.com/play/'.$v['sid']));
				if($c=$html->find('.detail',0))
				{
					$arg=array();
					$c2=$html->find('.detail ul li');
					foreach($c2 as $p)
					{
						$txt = trim(strip_tags($p->innertext));
						list($p1,$p2)=explode(':',$txt);
						$p1=trim($p1);
						$p2=trim($p2);
						if($p->class=='entry_title')
						{
							$arg['sn']=trim(strip_tags($p->innertext));
						}
						elseif($p1=='ศิลปิน')
						{
							$arg['ar']=$p2;
						}
						elseif($p1=='อัลบั้ม')
						{
							$arg['al']=$p2;
						}
					}
					
					echo '--'.count($c2).'--';
					$arg['ly']=strval(trim($html->find('#song_lyric .content',0)->innertext));
					$arg['ly']=trim(str_replace(array("<br />\r\n","</div>"),"\r\n",$arg['ly']));
					$arg['ly']=str_replace('<div>','',$arg['ly']);
					$arg['ly']=trim(strip_tags(trim(str_replace("<br />","\r\n",$arg['ly']))));
					
					if(mb_substr($arg['ly'],0,15,'utf-8')=='ไม่พบ เนื้อเพลง')
					{
						unset($arg['ly']);
					}
					print_r($arg);
				
				
					if($arg['sn']&&$arg['ar']&&$arg['al']&&$arg['ly'])
					{
						if(!$song=$db->findone('music',array('ty'=>$v['ty'],'sid'=>$v['sid'])))
						{
							$arg['ty']=$v['ty'];
							$arg['sid']=$v['sid'];
							$arg['fc']=array('sn'=>getfirstchar($arg['sn']),'ar'=>getfirstchar($arg['ar']));
							$id=$db->insert('music',$arg);
							
							
							$fd = _::folder()->fd($id);
							$folder = substr($fd,0,2).'/'.substr($fd,2,2);
							$name = substr($fd,4,2);
							$v['img']=str_replace(' ','%20',$v['img']);
							if($v['img'])
							{							
								@copy($v['img'],'/tmp/img.music.txt');
								$q=_::upload()->send('s3','upload','@/tmp/img.music.txt',array('name'=>$name,'folder'=>'music/'.$folder,'width'=>150,'height'=>150,'fix'=>'inboth','type'=>'jpg'));
								//if($o=_::photo()->thumb($name,$v['img'],'music/'.$folder,150,150,'inboth','jpg'))
								if($q['status']=='OK')
								{
									$db->update('music',array('_id'=>intval($id)),array('$set'=>array('fd'=>$folder,'s'=>$q['data']['n'])));
								}
							}
							$db->update('music_request',array('_id'=>$v['_id']),array('$set'=>array('mid'=>$id)));
						}
					}
				}
			}
		}
	}
}

function getrsmusic()
{
	$html=str_get_html(_::http()->get('http://www.rsonlinemusic.com/music.php?xajax=ajax_song_archive&xajaxr=1346579665677&xajaxargs[]=1&xajaxargs[]=10000&xajaxargs[]=1&xajaxargs[]=1&xajaxargs[]=50&xajaxargs[]=1'));
	//$html=str_get_html(_::http()->get('http://www.rsonlinemusic.com/music.php?xajax=ajax_song_archive&xajaxr=1346579665677&xajaxargs[]=1&xajaxargs[]=10000&xajaxargs[]=1&xajaxargs[]=1&xajaxargs[]=100&xajaxargs[]=1'));
	$c=$html->find('xjx cmd',0);
	$html=str_replace(array('<![CDATA[',']]>','<!-- .col -->'),'',$c->innertext);
	$html=str_get_html($html);
	$c=$html->find('div.col');
	echo '--'.count($c).'--<pre>';
	$music=array();
	$db=_::db();
	if(count($c))
	{
		$k=1;
		foreach($c as $c2)
		{
			$ty='';
			$arg=array('ty'=>'rs');
			$arg['sid']= substr(strstr(trim($c2->find('a.songCover',0)->href),'song_id='),8);
			$arg['img'] = trim($c2->find('a.songCover img',0)->src);
			$arg['t']=trim($c2->find('p.songName a',0)->innertext);
			$i=mb_stripos($arg['t'],'feat.',0,'utf-8');
			if($i>-1)
			{
				$l=mb_strlen($arg['t']);
				$arg['f']=trim(mb_substr($arg['t'],$i+5,$l-$i-5,'utf-8'));
				$arg['t']=trim(mb_substr($arg['t'],0,$i,'utf-8'));
			}
			$arg['a']=strval(trim($c2->find('p.artistName a',0)->innertext));
			array_unshift($music,$arg);
		}
		
		foreach($music as $arg)
		{
			if($arg['sid']&&$arg['t'])
			{
				if(!$db->findone('music_request',array('ty'=>$arg['ty'],'sid'=>$arg['sid'])))
				{
					$arg['du']=new MongoDate(time()-(30*24*3600));
					$db->insert('music_request',$arg);
				}
			}
		}
	}
}

function getfirstchar($t)
{
	$r='!';
	$a=array('1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','ก','ข','ค','ฆ','ง','จ','ฉ','ช','ซ','ฌ','ญ','ฎ','ฐ','ฑ','ฒ','ฐ','ณ','ด','ต','ถ','ท','ธ','น','บ','ป','ผ','ฝ','พ','ฟ','ภ','ม','ย','ร','ฤ','ล','ว','ศ','ษ','ส','ห','ฬ','อ','ฮ');
	$t=mb_strtolower($t,'utf-8');
	$l=mb_strlen($t,'utf-8');
	for($i=0;$i<$l;$i++)
	{
		$s=mb_substr($t,$i,1,'utf-8');
		if(in_array($s,$a))
		{
			if(is_numeric($s))
			{
				return $r;
			}
			else
			{
				return $s;
			}
		}
	}
	return $r;
}
?>