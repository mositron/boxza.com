<?php
	for($i=0;$i<count($this->friend);$i++):
		$u=array(
			'_id'=>$this->friend[$i]['_id'],
			'name'=>$this->friend[$i]['if']['fn'].' '.$this->friend[$i]['if']['ln'],
			'img'=>'http://s1.boxza.com/profile/'.$this->friend[$i]['if']['fd'].'/s.'.($this->friend[$i]['pf']['av']?$this->friend[$i]['pf']['av']:'jpg'),
			'link'=>($this->friend[$i]['if']['lk']?$this->friend[$i]['if']['lk']:$this->friend[$i]['_id']),
		);
?>
<div class="n friend-<?php echo $u['_id']?>">
<span class="av" av="<?php echo $u['_id']?>">
<a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['img']?>"></a>
</span>
<strong><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></strong>

<span class="d">
<?php echo _::$config['gender'][$this->friend[$i]['if']['gd']]?>, <?php echo $this->province[$this->friend[$i]['if']['pr']]['name_th']?>
</span>
<span class="add button friend-request-<?php echo $u['_id']?>" onClick="_.friend.request(<?php echo $u['_id']?>)">เพิ่มเป็นเพื่อน</span>

<div class="clear"></div>
</div>
<script>
if(_.my && $.inArray(<?php echo $u['_id']?>,_.my.ct.fr)==-1 && $.inArray(<?php echo $u['_id']?>,_.my.ct.rq)==-1 && $.inArray(<?php echo $u['_id']?>,_.my.ct.bl)==-1)
{
	$('.add.friend-request-<?php echo $u['_id']?>').css('display','inline-block');
}
</script>
<?php endfor?>
<?php if($this->next):?>
<div class="next"><a href="javascript:;" onClick="_.ajax.gourl('/people/?q=<?php echo urlencode($_GET['q'])?>&gender=<?php echo urlencode($_GET['gender'])?>&province=<?php echo urlencode($_GET['province'])?>&start=<?php echo $this->next?>','morepeople');$(this).html('กรุณารอซํกครู่..').attr('onclick','')">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>

