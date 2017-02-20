<?php

$db=_::db();


$template->assign('msg',$db->findone('msg',array('_id'=>'gold')));



_::$content=$template->fetch('gold.home');



?>
