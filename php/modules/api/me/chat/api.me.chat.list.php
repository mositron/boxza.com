<?php

$db = _::db();

$data = $db->find('user',array('_id'=>array('$in'=>(array)_::$my['ct']['fr']),'updated'=>array('$gte'=>new MongoDate(time()-120))),array('_id'=>1,'first'=>1,'last'=>1,'link'=>1,'folder'=>1));


?>