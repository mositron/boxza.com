<?php
function delbrand($i)
{
	$db=_::db();
	if($news=$db->findone('car_brand',array('_id'=>intval($i),'dd'=>array('$exists'=>false))))
	{
		if(_::$my['am']>=9)
		{
			$db->update('car_brand',array('_id'=>intval($i)),array('$set'=>array('dd'=>new MongoDate())));
			_::ajax()->redirect(URL);
		}
		else
		{
			_::ajax()->alert('คุณไม่มีสิทธ์ลบข่าวนี้');
		}
	}
	else
	{
		_::ajax()->redirect(URL);
	}
}


function newbrand($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$name=trim($arg['title']);
	$link=_::format()->link($name,false);
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อยี่ห้อ');	
	}
	elseif($db->findone('car_brand',array('link'=>$link)))
	{
		$ajax->alert('มียี่ห้อนี้อยู่แล้ว');	
	}
	else
	{
		$_=array(
			'en'=>$name,
			'th'=>$name,
			'link'=>$link
		);
		
		if($db->insert('car_brand',$_))
		{
			$ajax->redirect('/admin/car');
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}


function newgen($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$name=trim($arg['title']);
	$link=_::format()->link($name,false);
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อยี่ห้อ');	
	}
	elseif($db->findone('car_brand',array('link'=>$link)))
	{
		$ajax->alert('มียี่ห้อนี้อยู่แล้ว');	
	}
	else
	{
		$_=array(
			'en'=>$name,
			'th'=>$name,
			'link'=>$link
		);
		
		if($db->insert('car_brand',$_))
		{
			$ajax->redirect('/admin/car');
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}

function newspec($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$name=trim($arg['title']);
	$type=intval($arg['type']);
	$link=_::format()->link($name,false);
	if(!$arg['title'])
	{
		$ajax->alert('กรุณากรอกชื่อรุ่น');	
	}
	elseif($db->findone('car_spec',array('link'=>$link,'brand'=>BRAND_ID)))
	{
		$ajax->alert('มีรุ่นนี้อยู่แล้ว');	
	}
	else
	{
		$_=array(
			'en'=>$name,
			'th'=>$name,
			'link'=>$link,
			'brand'=>BRAND_ID,
			'type'=>$type
		);
		
		if($db->insert('car_spec',$_))
		{
			$ajax->jquery('#speclist','html',getspec());
		}
		else
		{
			$ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');	
		}
	}
}

function update($service,$name,$id,$value,$input)
{
	$ajax=_::ajax();
	$db=_::db();
	$html=_::html();
	if(in_array($service,array('spec')))
	{
		if(in_array($name,array('en','th')))
		{
			$db->update('car_spec',array('_id'=>intval($id)),array('$set'=>array($name=>trim($value))));
			$tmp=$db->findone('car_spec',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
		elseif($name=='link')
		{
			$value=_::format()->link($value,false);
			$db->update('car_spec',array('_id'=>intval($id)),array('$set'=>array($name=>$value)));
			$tmp=$db->findone('car_spec',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
		elseif($name=='type')
		{
			$db->update('car_spec',array('_id'=>intval($id)),array('$set'=>array($name=>$value)));
			$tmp=$db->findone('car_spec',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input,array(),_::template()->spectype);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
	}
	elseif(in_array($service,array('brand')))
	{
		if(in_array($name,array('en','th')))
		{
			$db->update('car_brand',array('_id'=>intval($id)),array('$set'=>array($name=>trim($value))));
			$tmp=$db->findone('car_brand',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
		elseif($name=='link')
		{
			$value=_::format()->link($value,false);
			$db->update('car_brand',array('_id'=>intval($id)),array('$set'=>array($name=>$value)));
			$tmp=$db->findone('car_brand',array('_id'=>intval($id)),array($name=>1));
			list($text,$input)=$html->form($service.'_'.$name.'_'.$id,$tmp[$name],$input);
			$ajax->html($service.'_'.$name.'_'.$id,$text,$input);
		}
	}
}
?>