<?php

$a = 22;
echo $a.'+++'.($b=fd($a)).'+++'.rfd($b);


function fd($i)
{
	$a = array(
	'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	'y', 'z'
	);
	$s = '';
	$c = count($a);
	while($i > 0)
	{
		$s = (string)$a[$i % $c] . $s;
		$i = floor($i / $c);
	}
	return $s;
}

function rfd($s)
{
	$a = array(
	'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	'y', 'z'
	);
	$b=array_flip($a);
	$c = count($a);
	$t=mb_strlen($s,'utf-8');
	$l=0;
	for($i=0;$i<$t;$i++)
	{
		$o=mb_substr($s,$i,1,'utf-8');
		$g = ($b[$o]);
		$l = ($l*$c)+$g;
	}
	return $l;
}


?>