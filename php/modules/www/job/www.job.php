<?php

$template->assign('job',_::db()->findone('msg',array('_id'=>'job')));
_::$content=$template->fetch('job');
?>