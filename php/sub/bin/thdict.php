<?php

echo 'dd';

exit;
require_once('../../../handlers/boxza.php');

# Initialization Application
_::load('bin');
_::session();
if(_::$my['_id']!=1)exit;


if(isset($_GET['id'])) 
{
	$id=$_GET['id'];
	$http=_::http();
	
	$arg=array();
	
	$next=true;
	$page=0;
	
	$word=array();
	$last=array();
	$tmp=$http->get('http://rirs3.royin.go.th/word'.$id.'/word-'.$id.'-a'.$page.'.asp');
	
	$tmp2=explode('<a href = "http://rirs3.royin.go.th/word'.$id.'/word-'.$id.'-a',$tmp);
	for($i=1;$i<count($tmp2);$i++)
	{
		$tmp=$http->get('http://rirs3.royin.go.th/word'.$id.'/word-'.$id.'-a'.$i.'.asp');	
		
		$line=explode('<tr><td>',$tmp);
		for($x=1;$x<count($line);$x++)
		{
			$t='';
			$d='';
		
			$v=$line[$x];
			$s='</td>';	
			$j=strpos($v,$s);
			if($j>0)
			{
				$t=trim(strip_tags(substr($v,0,$j)));
				$t=iconv('tis-620','utf-8',$t);
			}
			
			$s='<td>';
			$j=strpos($v,$s);
			if($j>0)
			{
				$v2=substr($v,$j+strlen($s));
				$s='</td>';
				$j=strpos($v2,$s);
				if($j>0)
				{
					$d=trim(str_replace(array('<b>','</b>'),array('<br><strong>','</strong>'),strip_tags(substr($v2,0,$j),'<b>')));
					$d=iconv('tis-620','utf-8',$d);
				}
			}
			
			if($t)
			{
				if($last['t'])
				{
					$word[]=$last;
				}
				$last=array('t'=>$t,'d'=>$d);
			}
			elseif($d)
			{
				$last['d'].="\r\n".$d;
			}
		}
		
	}
	/*
	if($id>0&&$id<77)
	{
		$arg['s0']=file_get_contents(__DIR__.'/tarot/'.$id.'.txt');
	}
	file_put_contents(__DIR__.'/tarot/data.'.$id.'.js','card_data[\'c'.$id.'\']='.json_encode($arg).';');
	file_put_contents(__DIR__.'/tarot/'.$id.'.png',file_get_contents('http://www.myhora.com/astrology/tarot/image-tarot-card.aspx?id='.$id));
	if($id<77)
	{
		echo $id.'<script>setTimeout(function(){window.location.href="?id='.($id+1).'"},2000);</script>';	
	}
	*/
	//print_r($word);
	
	$fichier = $id.'.csv';
	$fp = fopen($fichier, 'w');
	foreach ($word as $w) 
	{
	   fputcsv($fp, array_values($w));
	}
	fclose($fp);
}
else
{
	echo 'no';	
}

?>