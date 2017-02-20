<?php


class pager
{
	public function __construct($key="default")
	{
	}
	public function page($rpp,$count,$href='',$page=1,$qstring='')
	{
		$fpage='';
		if(is_array($href))
		{
			$fpage=$href[1];
			$href=$href[0];
		}
		$pages=ceil($count/$rpp);
		if($page=='last')$page=$pages;
		if($page>$pages)$page=$pages;
		if($page<1)$page=1;
		if($page>1)
		{
			$fp=($page-1);
			$page1='<a href="'.$href.($fp>1?$fpage.$fp.$qstring:'').'" class="page1"> ก่อนหน้า </a>';
		}
		if($page<$pages&&$pages>1)$page2='<a href="'.$href.$fpage.($page+1).$qstring.'" class="page1"> ถัดไป </a>';
		if($count)
		{
			$pagerarr=array();
			$start_p=($page>5?$page-5:0);
			$stop_p=$start_p+10;
			for ($i=1;$i<=$pages; $i++)
			{
				if (($i!=$pages&&$i!=1)&&($start_p>$i||$stop_p<$i))
				{
					if(!$dotted)$pagerarr[]=" | ";
					$dotted=true;
					continue;
				}
				$dotted=false;
				if ($i!=$page)
				{
					$fp=$href.($i>1?$fpage.$i.$qstring:'');
					$pagerarr[]='<a href="'.$fp.'" class="page1">'.$i.'</a>';
				}
				else $pagerarr[]="<b class=\"page2\">$i</b>";
			}
			$pager=join("",$pagerarr);
		}
		$pagertop="<p class=\"pager\" align=\"right\">$page1 $pager $page2</p>";
		return array($pages>1?$pagertop:'',($page-1)*$rpp,$page);
	}
	public function bootstrap($rpp,$count,$href='',$page=1,$qstring='')
	{
		if(defined('BOOTSTRAP_VERSION'))
		{
			return $this->bootstrap3($rpp,$count,$href,$page,$qstring);
		}
		
		$fpage='';
		if(is_array($href))
		{
			$fpage=$href[1];
			$href=$href[0];
		}
		$pages=ceil($count/$rpp);
		if($page=='last')$page=$pages;
		if($page>$pages)$page=$pages;
		if($page<1)$page=1;
		if($page>1)
		{
			$fp=($page-1);
			$page1='<li><a href="'.$href.($fp>1?$fpage.$fp.$qstring:'').'"> ก่อนหน้า </a></li>';
		}
		if($page<$pages&&$pages>1)$page2='<li><a href="'.$href.$fpage.($page+1).$qstring.'"> ถัดไป </a></li>';
		if($count)
		{
			$pagerarr=array();
			$start_p=($page>5?$page-5:0);
			$stop_p=$start_p+10;
			for ($i=1;$i<=$pages; $i++)
			{
				if (($i!=$pages&&$i!=1)&&($start_p>$i||$stop_p<$i))
				{
					if(!$dotted)$pagerarr[]='<li class="disabled"><a href="#">...</a></li>';
					$dotted=true;
					continue;
				}
				$dotted=false;
				if ($i!=$page)
				{
					$fp=$href.($i>1?$fpage.$i.$qstring:'');
					$pagerarr[]='<li><a href="'.$fp.'">'.$i.'</a></li>';
				}
				else $pagerarr[]='<li class="active"><a href="#">'.$i.'</a><li>';
			}
			$pager=join("",$pagerarr);
		}
		$pagertop='<div class="pagination"><ul>'.$page1.' '.$pager.' '.$page2.'</ul></div>';
		return array($pages>1?$pagertop:'',($page-1)*$rpp,$page);
	}
	
	public function bootstrap3($rpp,$count,$href='',$page=1,$qstring='')
	{
		$fpage='';
		if(is_array($href))
		{
			$fpage=$href[1];
			$href=$href[0];
		}
		$pages=ceil($count/$rpp);
		if($page=='last')$page=$pages;
		if($page>$pages)$page=$pages;
		if($page<1)$page=1;
		if($page>1)
		{
			$fp=($page-1);
			$page1='<li><a href="'.$href.($fp>1?$fpage.$fp.$qstring:'').'"> ก่อนหน้า </a></li>';
		}
		if($page<$pages&&$pages>1)$page2='<li><a href="'.$href.$fpage.($page+1).$qstring.'"> ถัดไป </a></li>';
		if($count)
		{
			$pagerarr=array();
			$start_p=($page>5?$page-5:0);
			$stop_p=$start_p+10;
			for ($i=1;$i<=$pages; $i++)
			{
				if (($i!=$pages&&$i!=1)&&($start_p>$i||$stop_p<$i))
				{
					if(!$dotted)$pagerarr[]='<li class="disabled"><a href="#">...</a></li>';
					$dotted=true;
					continue;
				}
				$dotted=false;
				if ($i!=$page)
				{
					$fp=$href.($i>1?$fpage.$i.$qstring:'');
					$pagerarr[]='<li><a href="'.$fp.'">'.$i.'</a></li>';
				}
				else $pagerarr[]='<li class="active"><a href="#">'.$i.'</a><li>';
			}
			$pager=join("",$pagerarr);
		}
		$pagertop='<ul class="pagination">'.$page1.' '.$pager.' '.$page2.'</ul>';
		return array($pages>1?$pagertop:'',($page-1)*$rpp,$page);
	}
}
?>