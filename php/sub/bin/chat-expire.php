<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$db->update('user',array('$or'=>array(array('if.ch.ci'=>45),array('if.ch.ci'=>46))),array('$set'=>array('if.ch.ci'=>0)),array('multiple'=>true));
$db->update('user',array('if.ch.inv'=>45),array('$pull'=>array('if.ch.inv'=>45)),array('multiple'=>true));
$db->update('user',array('if.ch.inv'=>46),array('$pull'=>array('if.ch.inv'=>46)),array('multiple'=>true));
?>