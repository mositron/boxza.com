<?php

function update($service,$type,$id,$value,$input)
{
	$ajax=_::ajax();
	$db=_::db();
	$html=_::html();
	if($service=='news')
	{
		$id=intval($id);
		$db->update('msg',array('_id'=>'home_news'),array('$set'=>array('slot'.NEWS_TAB.'.'.$id=>intval(trim($value)))));
		$msg=$db->findone('msg',array('_id'=>'home_news'));

		if($slot=$msg['slot'.NEWS_TAB])	
		{
			if($value=intval($slot[$id]))
			{
				$news=$db->findone('news',array('_id'=>$value),array('_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'c'=>1,'cs'=>1,'url'=>1,'do'=>1,'ds'=>1));
				
				$ajax->jquery('#preview_'.NEWS_TAB.'_'.$id,'html','<p>ดู: '.number_format($news['do']).'<br>เมื่อ: '.time::show($news['ds'],'date').'</p><a href="'.link::news($news).'" target="_blank"><img src="http://s3.boxza.com/news/'.$news['fd'].'/s.jpg"><p>'.$news['t'].'</p></a>');
				list($text,$input)=$html->form($service.'_'.$type.'_'.$id,$value,$input);
				$ajax->html($service.'_'.$type.'_'.$id,$text,$input);
			}
		}
		
	}
}
?>