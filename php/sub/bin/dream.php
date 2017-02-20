<?php
require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');
_::session();
if(_::$my['_id']!=1)exit;

$cate=array();
$arg=array();
	

$a='กขคฆงจฉชซญดตถทธนบปผฝพภมยรลวศสหอฮ';
$lc=mb_strlen($a,'utf-8');

	$http=_::http();
for($ai=0;$ai<$lc;$ai++)
{
	$id=urldecode(mb_substr($a,$ai,1,'utf-8'));
	/*
	echo '<li><a href="index.html?page=cate&id='.$id.'">'.$id.'</a></li>'."\n";
	continue;
	*/
	$tmp=$http->get('http://www.myhora.com/%E0%B8%94%E0%B8%B9%E0%B8%94%E0%B8%A7%E0%B8%87-%E0%B8%97%E0%B8%B3%E0%B8%99%E0%B8%B2%E0%B8%A2%E0%B8%9D%E0%B8%B1%E0%B8%99.aspx?dream='.urlencode($id));
	
	$tmp9=explode("<font style='font-size:1.08em;'>",$tmp);
	for($i=1;$i<count($tmp9);$i++)
	{
		$ar=array();
		$tmp=$tmp9[$i];
	
		$s='</font>';
		$j=mb_strpos($tmp,$s,NULL,'utf-8');
		if($j>0)
		{
			$ar['n']=trim(strip_tags(mb_substr($tmp,0,$j,'utf-8')));
		}

		$s='style="color:Black;font-size:14px;">';
		$j=mb_strpos($tmp,$s,NULL,'utf-8');
		if($j>0)
		{
			$tmp2=mb_substr($tmp,$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
			$s='</td>';
			$j=mb_strpos($tmp2,$s,NULL,'utf-8');
			if($j>0)
			{
				$ar['d']=trim(mb_substr($tmp2,0,$j,'utf-8'));
				$ar['d']=nl2br(trim(str_replace(array('<br/>','<br>','<br />',"\r\n","\n"),"\n",$ar['d'])));
				$ar['d']=trim(str_replace(array('<br /><br />',"<br />\n<br />",'<br><br>','<br/><br/>'),"<br />",$ar['d']));
				
				$s="<font style='color: #BB0000'>เลข  <font style='color: #BB0000;font-size:1.23em;'>";
				$j=mb_strpos($ar['d'],$s,NULL,'utf-8');
				if($j>0)
				{
					$tmp2=mb_substr($ar['d'],$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
					$s='</font>';
					$j=mb_strpos($tmp2,$s,NULL,'utf-8');
					if($j>0)
					{
						$ar['s1']=trim(mb_substr($tmp2,0,$j,'utf-8'));
					}
				}
				$s="เด่น   , เลข  <font style='color: #BB0000;font-size:1.23em;'>";
				$j=mb_strpos($ar['d'],$s,NULL,'utf-8');
				if($j>0)
				{
					$tmp2=mb_substr($ar['d'],$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
					$s='</font>';
					$j=mb_strpos($tmp2,$s,NULL,'utf-8');
					if($j>0)
					{
						$ar['s2']=trim(mb_substr($tmp2,0,$j,'utf-8'));
					}
				}
				$s="<font style='color: #BB0000;font-size:14pt;'>";
				$j=mb_strpos($ar['d'],$s,NULL,'utf-8');
				if($j>0)
				{
					$tmp2=mb_substr($ar['d'],$j+mb_strlen($s,'utf-8'),NULL,'utf-8');
					$s='</font>';
					$j=mb_strpos($tmp2,$s,NULL,'utf-8');
					if($j>0)
					{
						$ar['s3']=trim(mb_substr($tmp2,0,$j,'utf-8'));
					}
				}
				
				
				$s="</span>";
				$j=mb_strpos($ar['d'],$s,NULL,'utf-8');
				if($j>0)
				{
					$ar['d']=trim(mb_substr($ar['d'],0,$j,'utf-8'));
					$ar['d']=nl2br(trim(str_replace(array('<br/>','<br>','<br />',"\r\n","\n"),"\n",$ar['d'])));
					$ar['d']=trim(str_replace(array('<br /><br />',"<br />\n<br />",'<br><br>','<br/><br/>'),"<br />",$ar['d']));
				}
				
			}
		}
//		$cate[]=$ar
		$ar['c']=$id;
		$v=$ar['n'];
		unset($ar['n']);
		$arg[$v]=$ar;
	}
	
	
}

var_export($arg);
//echo json_encode($arg);
?>