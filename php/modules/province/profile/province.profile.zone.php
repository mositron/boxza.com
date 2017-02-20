<?php



$prov=$db->find('place',array('ty'=>2,'pl'=>1,'p1'=>$place['_ky']),array('_id'=>1,'n'=>1,'ne'=>1,'tt'=>1,'lk'=>1));

$template->assign('prov',$prov);



$template->assign('page',$template->fetch('profile.zone.home'));
?>