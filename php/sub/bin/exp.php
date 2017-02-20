<?php


for($i=1;$i<100;$i++)
{
	echo $i.' - '.ceil((25*pow($i-1,2.5+($i/100)))+($i*50)).'<br>';	
	
	
//		$mxp=ceil((25*pow($this->char['lv']-1,3.8))+($this->char['lv']*50));
	
}

?>