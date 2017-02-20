<?php



//_::$meta['title'] = 'ผลบอล ข่าวฟุตบอล วิเคราะห์บอล ผลบอลสด ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางการแข่งขัน บอลวันนี้ ติดตามข่าวสารเกี่ยวกับฟุตบอล';
//_::$meta['description'] = 'ฟุตบอล ข่าวฟุตบอล ผลบอล ผลบอลสด วิเคราะห์บอล ไฮไลท์ฟุตบอล โปรแกรมฟุตบอล ตารางคะแนน ตารางการแข่งขัน ฟุตบอลไทย พรีเมียร์ลีก ';
//_::$meta['keywords'] = 'ฟุตบอล, ข่าวฟุตบอล, ผลบอล, ไฮไลท์ฟุตบอล, โปรแกรมฟุตบอล, วิเคราะห์บอล, ผลบอลสด, ตารางคะแนน, เซียนบอล';


//_::time();
$db=_::db();
$template->assign('user',_::user());

$template->assign('service',_::sidebar()->service(array('racing'=>1)));
$template->assign('team_hot',$db->find('racing_team',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'mc'=>1),array('sort'=>array('mc'=>-1),'limit'=>20),false));
$template->assign('team_new',$db->find('racing_team',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'mc'=>1),array('sort'=>array('_id'=>-1),'limit'=>20),false));
_::$content=$template->fetch('team.home');

?>