<?php
if(_::$my)
{
	if($chat->myname!=_::$my['name'])
	{
		$nick=getnicks($chat->cache,$chat->room);
		$nick[$chat->myid]=array('_id'=>_::$my['_id'],'n'=>mb_substr(_::$my['name'],0,20,'utf-8'),'d'=>_::$my['name'],'l'=>_::$my['link'],'i'=>_::$my['img'],'t'=>$chat->time2,'mb'=>1,'am'=>$chat->myadmin);
		$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
		_::$content[] = array('method'=>'chatbox','type'=>'my','data'=>$nick[$chat->myid]);
		
		//$chat->inserttext(array('ty'=>'nick','m'=>'<a href="javascript:;" onclick="_.popup(\''.$chat->myid.'\')">'._::$my['name'].'</a>','c'=>21));
		
		$chat->inserttext(array('ty'=>'nick','m'=>'เปลี่ยนชื่อใหม่เป็น <a href="javascript:;" class="bz_chat_user" onclick="_.popup(\''.$chat->myid.'\')"><span>'.mb_substr(_::$my['name'],0,20,'utf-8').'</span></a>','c'=>21));
		
		$chat->myname=mb_substr(_::$my['name'],0,20,'utf-8');
		$chat->myimg=_::$my['img'];
		_::user()->update(_::$my['_id'],array('$set'=>array('if.ch.na'=>$chat->myname)));
	}
}
?>