<?php


function delalbum($line)
{
	$db=_::db();
	if($tmp = $db->findOne('line',array('_id'=>intval($line)),array('_id'=>1,'u'=>1,'s'=>1,'p'=>1,'pt'=>1,'sh'=>1,'ty'=>1,'lo'=>1,'dd'=>1)))
	{
		if(_::$my && !$tmp['lo'] && !$tmp['dd'])
		{
			if($tmp['u']==_::$my['_id']||_::$my['am']>=9||_::$my['_id']==4)
			{
				$db->update('line',array('_id'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())));
				if($tmp['ty']=='album')
				{
					$db->update('line',array('pt.a'=>intval($line)),array('$set'=>array('ud'=>_::$my['_id'],'dd'=>new MongoDate())),array('multiple'=>true));
				}
			}
		}
		_::ajax()->redirect(URL);
	}
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
				_::ajax()->redirect('http://album.boxza.com/update/'.$id);
			}
			else
			{
				_::ajax()->alert('คุณสามารถสร้างอัลบั้มได้สูงสุด 100 อัลบั้มเท่านั้น');
			}
			//_::ajax()->script('_.line.go("/photos/album-'.$id.'",true)');
		}
	}
}
?>