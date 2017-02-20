<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

//db.accommodations.find( { $where: "this.name.length > 1" } );

$db->update('forum',array('sk'=>1,'u'=>array('$ne'=>1)),array('$set'=>array('sk'=>0)),array('multiple'=>true));

?>