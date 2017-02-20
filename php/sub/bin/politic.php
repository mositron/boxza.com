<?php

require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

$db=_::db();

$db->update('news',array('c'=>9),array('$set'=>array('c'=>9,'cs'=>1)),array('multiple'=>true));

/*
$db->update('news',array('c'=>7,'cs'=>2),array('$set'=>array('cs'=>0)),array('multiple'=>true));
$db->update('news',array('c'=>3),array('$set'=>array('cs'=>1)),array('multiple'=>true));
*/
?>