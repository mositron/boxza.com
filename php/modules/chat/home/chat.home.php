<?php


_::$meta['title'] = 'แชท Chat คุยสด แชทรูม แชทสด แชทผ่านกล้อง แชทหาเพื่อน สนทนา ผ่านกล้องเว็บแคม สร้างห้องแชทฟรี กับเพื่อนๆใน boxza';
_::$meta['description'] = 'แชท Chat พูดคุย คุยสด แชทรูม แชทสด แชทผ่านกล้อง แชทหาเพื่อน สนทนา ผ่านกล้องเว็บแคม ส่องเว็บแคม ส่องกล้อง สร้างห้องแชทฟรี กับเพื่อนๆใน boxza.com';
_::$meta['keywords'] = 'แชท, Chat, คุยสด, แชทสด, แชทรูม, คุยสด, แชทหาเพื่อน, สร้างแชทฟรี, สร้างห้องแชทฟรี, พูดคุย, สนทนา, เว็บแคม, กล้อง';

//_::$meta['google']=array('id'=>'112235668332689047152');
//_::move('http://friend.boxza.com/',true);
//exit;
if($_GET['r'])
{
	_::move('/room/'.$_GET['r'],true);
	
}
$db=_::db();

$chat = $db->find('chatroom',array('dd'=>array('$exists'=>false),'pl'=>1,'_id'=>array('$lte'=>6)),array('_id'=>1,'n'=>1,'u'=>1,'w'=>1,'da'=>1,'cu'=>1,'cv'=>1,'l'=>1),array('sort'=>array('_id'=>1)));
//$chat = $db->find('chatroom',array('dd'=>array('$exists'=>false),'pl'=>1,'du'=>array('$gte'=>new MongoDate(time()-600))),array('_id'=>1,'n'=>1,'u'=>1,'w'=>1,'da'=>1,'cu'=>1,'cv'=>1,'l'=>1),array('sort'=>array('cu'=>-1),'limit'=>10));
//$nchat = $db->find('chatroom',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'n'=>1,'u'=>1,'w'=>1,'da'=>1,'cu'=>1,'l'=>1),array('sort'=>array('_id'=>-1),'limit'=>20));
$template->assign('chat',$chat);
//$template->assign('nchat',$nchat);
$template->assign('user',_::user());
_::$content=$template->fetch('home');


#	$cache->set('ca1','fb_home',_::$content,false,300);
#}

?>