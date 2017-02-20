<style>
.cal{}
.cal ul{border-left:1px solid #ccc;border-top:1px solid #ccc; margin:0px;}
.cal-h{text-align:center;}
.cal li{width:14.2857143%; float:left; text-align:center; margin:0px;}
.cal li.hd{background:#f0f0f0; height:25px; line-height:25px; color:#000; text-shadow:1px 1px 0px #fff;}
.cal ul > p{margin:0px; padding:0px;}
.cal li span{display: block;border-right: 1px solid #ccc;background: #fff;border-bottom: 1px solid #ccc; height:50px;}
</style>

<ul class="nav nav-tabs">
  <li class="active"><a href="<?php echo $this->year+543?>">ปฏิทินปี<?php echo $this->year+543?></a></li>
  <li><a href="<?php echo $this->year+543?>/holiday">วันหยุดประจำปี <?php echo $this->year+543?></a></li>
  <li><a href="<?php echo $this->year+543?>/important">วันสำคัญประจำปี <?php echo $this->year+543?></a></li>
</ul>

<div>
<?php for($m=1;$m<=12;$m++):?>
<div class="cal">
<h3 class="cal-h">ปฏิทินเดือน<?php echo time::$month[$m-1].' '.($this->year+543)?></h3>
<ul>
<?php for($d=0;$d<7;$d++):?>
<li class="hd"><?php echo time::$day[$d]?></li>
<?php endfor?>
<?php
	$prevm=$m-1;
	$prevy=$this->year;
	if($prevm<1)
	{
		$prevm=12;
		$prevy--;
	}
	$num_day = cal_days_in_month(0,$m,$this->year);
	$num_day_last_month = cal_days_in_month(0,$prevm,$prevy);
	$tanin_day = getdate(mktime(0,0,0,$m,1,$this->year));
	$num_week = ceil(($tanin_day['wday'] + $num_day)/7);
	
	$day_run = 1;
	for($i=1;$i<=$num_week;$i++):
?>

  <?php
   for($j=1;$j<=7;$j++):

	# algo of cal day
	 if ($i==1) {
       if (($j-1) < $tanin_day['wday']) {
		 $day = '';
		 $cclass="cdisable";
		 $m2 = $prevm;
		 $this->year2 = $prevy;
	   } else {
         $day = $day_run;
		 $day_run++;
		 $cclass="cenable";
		 $m2 = $m;
		 $this->year2 = $this->year;
	   }
	 } elseif ($i==$num_week) {
	   if ($day_run <= $num_day) {
	     $day = $day_run;
         $day_run++;
		 $cclass="cenable";
		 $m2 = $m;
		 $this->year2 = $this->year;
	   } else {
         $day = '';
		 $cclass="cdisable";
		 $m2 = $this->next_month;
		 $this->year2 = $this->next_year;
	   }
     } else {
       $day = $day_run;
	   $day_run++;
	   $cclass="cenable";
	   $m2 = $m;
	   $this->year2 = $this->year;
	 }
	 if($m2==$m && $m2==date("m") && $this->year2==date("Y") && $day==date("d"))
	 {
		 $cclass.=" ctoday";
	 }
  ?>
      <?php if($m2==$m):?>
     <li class="<?php echo $cclass?>" title="วัน<?php echo time::$day[$j-1]?>ที่ <?php echo $day?> <?php echo time::$month[$m-1].' '.($this->year+543)?>"><span class="cday"><?php echo $day;?></span></li>
     <?php else:?>
     <li class="<?php echo $cclass?>"><span></span></li>
		<?php endif?>
  <?php
   endfor;
  ?>
<?php
  endfor;
?>
<p class="clear"></p>
</ul>
</div>
<?php endfor?>
<p class="clear"></p>
</div>