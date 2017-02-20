<?php
define('HIDE_REQUEST',1);

_::$meta['title'] = 'ยอดฮิต - เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา';
_::$meta['description'] = 'ยอดฮิต - เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook';
_::$meta['keywords'] = 'ยอดฮิต, เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง';

$db=_::db();
$count=$db->count('guess',array('pl'=>1,'rc'=>1,'dd'=>array('$exists'=>false)));

extract(_::split()->get('/hit/',0,array('page')));
list($pg,$skip)=_::pager()->bootstrap(100,$count,array('/hit/','page-'),$page);

$app=$db->find('guess',array('pl'=>1,'dd'=>array('$exists'=>false)),array('t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1),array('sort'=>array('do'=>-1),'skip'=>$skip,'limit'=>100));

$template=_::template();
$template->assign('pager',$pg);
$template->assign('user',_::user());
$template->assign('app',$app);
_::$content=$template->fetch('hit');

?>