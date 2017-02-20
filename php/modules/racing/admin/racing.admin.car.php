<?php
if(_::$path[2])
{
	require_once(__DIR__.'/racing.admin.car.spec.php');
}
elseif(_::$path[1])
{
	require_once(__DIR__.'/racing.admin.car.brand.php');
}
else
{
	require_once(__DIR__.'/racing.admin.car.home.php');
}

?>