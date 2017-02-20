<?php if(count($this->ms)==30):?>

<p class="ln-next ptr2" onClick="_.ajax.gourl('/messages/<?php echo _::$path[0]?>','morechat',<?php echo intval($this->start)+30?>);$(this).remove()" style="margin:2px 0px 5px">โหลดข้อความเพิ่มเติม</p>

<?php 
endif;

//_::time();
$last = 0;
for($i=count($this->ms)-1;$i>=0;$i--):
	$n=$this->ms[$i];
	$uid=($n['u']==_::$my['_id']?_::$my:$this->p);
	$time = date('w-d-n-Y',$n['da']->sec);
	if($lasttime==$time)
	{
		$time='';
	}
	elseif($lasttime && $lasttime!=$time)
	{
		$lasttime=$time;
		$last=-1;
	}
	else
	{
		$lasttime=$time;
	}
?>
<?php if($last && $last!=$n['u']):?>
  </div>
<p class="clear"></p>
</div>
<?php endif?>

<?php if($time):
	$t = explode('-',$time);
?>
<div class="ch-time"><?php echo time::$day[$t[0]].' '.$t[1].' '.time::$month[$t[2]].' '.($t[3]+543)?></div>
<?php endif?>

<?php if($last!=$n['u']):?>
<div uid="<?php echo $n['u']?>" datetime="<?php echo $n['da']->sec?>">
<div class="left"><span class="av"><a href="/<?php echo $uid['link']?>" class="h"><img src="<?php echo $uid['img']?>"></a></span></div>
<div class="right">

<?php endif?>
  

<div class="ch-id-<?php echo $n['_id']?> ch-id" datetime="<?php echo $n['da']->sec?>"><p><?php echo date('H:i',$n['da']->sec)?></p><?php echo $n['ms']?></div>

        
  <?php 
$last=$n['u'];
endfor;
?>
  <?php if($last):?>
  </div>
  <p class="clear"></p>
</div>
<?php endif?>
