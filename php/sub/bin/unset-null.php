<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();

//$db->update('line',array('dd'=>NULL),array('$unset'=>array('dd'=>1)),array('multiple'=>true));

echo $db->count('line',array('dd'=>NULL)).'<br>';

echo $db->count('line',array('dd'=>array('$ne'=>NULL))).'<br>';

echo $db->count('line').'<br>';

?>