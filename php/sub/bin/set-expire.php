<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

_::time();
$db=_::db();

$time=time()+(14*24*3600);

echo $db->update('line',array('ex'=>array('$exists'=>false)),array('$set'=>array('ex'=>new mongodate($time))),array('multiple'=>true));

echo '<br>OK';
?>