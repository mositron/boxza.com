<?php


function moreblogs($next=0)
{
	_::ajax()->jquery('#getblogs','append',getblogs($next));
	_::ajax()->script('_.profile.updating=false;');
}
?>