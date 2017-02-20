<?php

//_::time();

$db=_::db();
$set=$db->find('lotto_set',array(),array(),array('sort'=>array('_id'=>-1),'limit'=>11));

$tm=time::show($set[0]['tm'],'date');

_::$meta['title'] = 'หวยหุ้น หวยหุ้นวันนี้ หวยหุ้นวันที่ '.$tm.' ห้วยหุ้นไทย สถิติหวยหุ้น';
_::$meta['description'] = 'หวยหุ้น สถิติหวยหุ้น ตรวจหวยหุ้น  หวยหุ้นวันนี้ ตรวจหวยหุ้นย้อนหลัง ห้วยหุ้นไทย เลขเด็ดหวยหุ้น  อัพเดทรวดเร็ว';
_::$meta['keywords'] = 'หวยหุ้น, หวย, ตรวจหวยหุ้น, สถิติหวยหุ้น, หวยหุ้นวันนี้, ห้วยหุ้นไทย';

$index=$db->findone('msg',array('_id'=>'lotto_set'));



$template=_::template();

$topic=$db->find('forum',array('c'=>array('$in'=>array(192)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>10),false);
$template->assign('set',$set);
$template->assign('index',$index);
$template->assign('topic',$topic);
$template->assign('user',_::user());

_::$content=$template->fetch('set');

?>