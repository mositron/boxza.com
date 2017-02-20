<?php

for($job=1;$job<=4;$job++)
{
	for($gender=1;$gender<=2;$gender++)
	{
		$x=(($job-1)*384)+(($gender-1)*96)+32;
		$y=384;
		echo '.char-class-'.$job.'-'.$gender.'.char-d{background-position:-'.$x.'px -'.$y.'px !important}';
		echo '.char-class-'.$job.'-'.$gender.'.char-l{background-position:-'.$x.'px -'.($y+(48)).'px !important}';
		echo '.char-class-'.$job.'-'.$gender.'.char-r{background-position:-'.$x.'px -'.($y+(48*2)).'px !important}';
		echo '.char-class-'.$job.'-'.$gender.'.char-u{background-position:-'.$x.'px -'.($y+(48*3)).'px !important}';
	}
}


for($gender=1;$gender<=2;$gender++)
{
	for($hair=1;$hair<=5;$hair++)
	{
		for($color=1;$color<=7;$color++)
		{	
			$x=(($hair-1)*672)+(($color-1)*96)+32;
			$y=(($gender-1)*192);
			echo '.char-head-'.$gender.'-'.$hair.'-'.$color.'.char-d>div{background-position:-'.$x.'px -'.$y.'px !important}';
			echo '.char-head-'.$gender.'-'.$hair.'-'.$color.'.char-l>div{background-position:-'.$x.'px -'.($y+(48)).'px !important}';
			echo '.char-head-'.$gender.'-'.$hair.'-'.$color.'.char-r>div{background-position:-'.$x.'px -'.($y+(48*2)).'px !important}';
			echo '.char-head-'.$gender.'-'.$hair.'-'.$color.'.char-u>div{background-position:-'.$x.'px -'.($y+(48*3)).'px !important}';
		}
	}
}
?>