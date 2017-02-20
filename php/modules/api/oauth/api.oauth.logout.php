<?php


_::session()->logout();

_::$my=NULL;

_::$content[] = array('method'=>'oauth','data'=>['status'=>'OK','cookie'=>'']);
?>

