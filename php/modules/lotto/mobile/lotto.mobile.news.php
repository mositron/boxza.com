<?php




if(is_numeric(_::$path[1]))
{
	require_once(__DIR__.'/lotto.mobile.news.view.php');
}
else
{
	require_once(__DIR__.'/lotto.mobile.news.home.php');
}

?>