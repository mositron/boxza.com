<?php

$error=array();

_::session()->logged();
_::ajax()->register('newvideo');

_::$content=$template->fetch('post');



function newvideo($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$cate=intval($arg['cate3']?$arg['cate3']:$arg['cate2']);
	if(!$cate)
	{
		$ajax->alert('กรุณาเลือกหมวดให้ถูกต้อง');
	}
	elseif($db->findone('video_cate',array('$or'=>array(array('p0'=>$cate),array('p1'=>$cate)))))
	{
		$ajax->alert('กรุณาเลือกหมวดให้ถูกต้อง');
	}
	elseif(!trim($arg['detail']))
	{
		$ajax->alert('กรุณากรอกคำอธิบายเพิ่มเติมเกี่ยวกับวิดีโอนี้');
	}
	elseif(preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/',$arg['url'],$c))
	{
		if ($c[7]&&strlen($c[7])==11)
		{
			if($db->findOne('video',array('yt'=>$c[7],'dd'=>array('$exists'=>false))))
			{
				$ajax->alert('มีวิดีโอนี้อยู่แล้วในระบบ');
			}
			else
			{
				$a = json_decode(_::http()->get('http://gdata.youtube.com/feeds/api/videos/'.$c[7].'?alt=json&v=2'),true);
				//$ajax->alert(print_r($a['entry'],true));
				//return;
				$wild=(trim($a['entry']['media$group']['yt$aspectRatio']['$t'])=='widescreen'?1:0);
				$title=trim($a['entry']['media$group']['media$title']['$t']);
				$content=trim($a['entry']['media$group']['media$description']['$t']);
				$img=trim($a['entry']['media$group']['media$thumbnail'][2]['url']);
				$duration=trim($a['entry']['media$group']['yt$duration']['seconds']);
				if($title && $img && $duration)
				{
					$detail=trim(mb_substr(strip_tags($arg['detail']),0,500,'utf-8'));
					if($id=$db->insert('video',array('yt'=>$c[7],'t'=>$title,'m'=>$content,'d'=>$detail,'w'=>$wild,'c'=>$cate,'u'=>_::$my['_id'],'ip'=>$_SERVER['REMOTE_ADDR'],'dr'=>intval($duration))))
					{					
						$fd = _::folder()->fd($id);
						$folder = substr($fd,0,2).'/'.substr($fd,2,2);
						$n=substr($fd,4,2);
						copy($img,'/tmp/'.$c[7].'.jpg');
						$q=_::upload()->send('s3','upload','@/tmp/'.$c[7].'.jpg',array('name'=>$n,'folder'=>'video/'.$folder,'width'=>150,'height'=>85,'fix'=>'both','type'=>'jpg'));
						@unlink('/tmp/'.$c[7].'.jpg');
						
						$link=_::format()->link(strtolower($title));
						if(!$link)$link='video';
						$db->update('video',array('_id'=>$id),array('$set'=>array('f'=>$folder,'n'=>$q['data']['n'],'l'=>$link)));
						
						_::tags()->update($arg['tags'], 'video', $id, $title,$content,'http://video.boxza.com/'.$id.'-'.$link.'.html','http://s3.boxza.com/video/'.$folder.'/'.$q['data']['n'],$cate,new MongoDate());
		
						$ajax->redirect('/update/'.$id);
					}
				}
				else
				{
					$ajax->alert('ไม่สามารถดึงข้อมูล Youtube นี้ได้');
				}
			}
		}
		else
		{
			$ajax->alert('รูปแบบ Youtube URLไม่ถูกต้อง (2)');
		}
	}
	else
	{
		$ajax->alert('รูปแบบ Youtube URLไม่ถูกต้อง');
	}
}
?>