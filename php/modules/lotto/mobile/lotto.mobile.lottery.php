<?php

if(is_numeric(_::$path[1]))
{
	require_once(__DIR__.'/lotto.mobile.lottery.view.php');
}
else
{
	require_once(__DIR__.'/lotto.mobile.lottery.home.php');
}
?>