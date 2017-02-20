<?php

$tmp=dirname(dirname(dirname(__DIR__))).'/files/bin/monkey/';
echo $tmp;
$icon=array();
if(is_dir($tmp))
{
   if($dh=opendir($tmp))
   {
      while(($dir=readdir($dh))!==false)
      {
         if(!in_array($dir,array('.','..')))
         {
             array_push($icon,substr($dir,0,-4));
         }
      }
      closedir($dh);
   }
}
sort($icon);
echo '<pre>';
//print_r($icon);

$tmp2=dirname($tmp).'/yoyo/';
for($i=0;$i<count($icon);$i++)
{
	copy($tmp.$icon[$i].'.gif',$tmp2.($i+1).'.gif');
   
}

?>