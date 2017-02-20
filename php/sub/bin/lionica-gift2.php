<?php



require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');


$db=_::db();

$u=array('nu-mesex@hotmail.com',
/*
'cassanova.notime4@msn.com',
'innozent_b_@hotmail.com',
'jungang@hotmail.co.th',
'hooknau@hotmail.co.th',
'bbnarak22@hotmail.com',
'daylnw191@hotmail.com',
'limp.3izkit@gmail.com',
'zero_karnextion@hotmail.com',
'showmefone3@hotmail.com',
'terafrog1@hotmail.com',
'pooh_zaa_85@windowslive.com',
'death_note_near@windowslive.com',
'noonun_pmig@hotmail.com',
'paiyint@gmail.com'
*/
);


$user=$db->find('user',array('em'=>array('$in'=>$u)),array('_id'=>1,'em'=>1));

$us=array();
foreach($u as $v)
{
	$us[$v]=array();	
}

$items=array(405,459);

$pet=array();
foreach($user as $v)
{
	$us[$v['em']]=$v;
	if($char=$db->findone('lionica_char',array('u'=>$v['_id']),array('_id'=>1,'n'=>1)))
	{
		$us[$v['em']]['n']=$char['n'];
		foreach($items as $item)
		{
			if(!$db->findone('lionica_item',array('u'=>$us[$v['em']]['_id'],'item'=>$item)))
			{
				echo $char['n'].' ได้รับ '.$item.'<br>';
				$db->insert('lionica_item',array('u'=>$us[$v['em']]['_id'],'item'=>$item,'c'=>1,'ps'=>0));
			}
		}
	}
}

print_r($us);




?>