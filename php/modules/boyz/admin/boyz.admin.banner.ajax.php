<?php

function update($service,$name,$id,$value,$input)
{
	$ajax=_::ajax();
	$db=_::db();
	$html=_::html();
	$template=_::template();
	if(in_array($name,array('t','p','l','pl','d')))
	{
		if(in_array($name,array('p')))
		{
			$db->update('boyz_banner',array('_id'=>intval($id)),array('$set'=>array($name=>intval(trim($value)))));
			$tmp=$db->findone('boyz_banner',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input,array(),array(
																																																									1=>'ตำแหน่งที่ 1',
																																																									2=>'ตำแหน่งที่ 2',
																																																									3=>'ตำแหน่งที่ 3',
																																																									4=>'ตำแหน่งที่ 4',
																																																									5=>'ตำแหน่งที่ 5',
																																																									6=>'ตำแหน่งที่ 6',
																																																									7=>'ตำแหน่งที่ 7',
																																																									8=>'ตำแหน่งที่ 8',
																																																									9=>'ตำแหน่งที่ 9',
																																																									10=>'ตำแหน่งที่ 10',
																																																								));
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
		elseif(in_array($name,array('pl')))
		{
			$db->update('boyz_banner',array('_id'=>intval($id)),array('$set'=>array($name=>intval(trim($value)))));
			$tmp=$db->findone('boyz_banner',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input,array(),array(
																																																									0=>'ไม่แสดงผล',
																																																									1=>'แสดงผล',
																																																								));
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
		elseif(in_array($name,array('t','l','d')))
		{
			$db->update('boyz_banner',array('_id'=>intval($id)),array('$set'=>array($name=>trim($value))));
			$tmp=$db->findone('boyz_banner',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
	}
}

function newbanner($arg)
{
	$db=_::db();
	$ajax=_::ajax();
	$id=$db->insert('boyz_banner',array('t'=>trim($arg['title'])));
	$ajax->redirect('/admin/banner/'.$id);
}


function delbanner($id)
{
	$db=_::db();
	$ajax=_::ajax();
	$id=$db->update('boyz_banner',array('_id'=>intval($id)),array('$set'=>array('dd'=>new MongoDate())));
	_::upload()->send('s3','delete','boyz/banner/'.$id.'.jpg');
	$ajax->redirect(URL);
}
?>