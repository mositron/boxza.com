<?php 
	for($i=0;$i<count($this->friend);$i++):
		$u=array(
			'_id'=>$this->friend[$i]['_id'],
			'name'=>$this->friend[$i]['if']['fn'].' '.$this->friend[$i]['if']['ln'],
			'img'=>'http://s1.boxza.com/profile/'.$this->friend[$i]['if']['fd'].'/s.'.($this->friend[$i]['pf']['av']?$this->friend[$i]['pf']['av']:'jpg'),
			'link'=>($this->friend[$i]['if']['lk']?$this->friend[$i]['if']['lk']:$this->friend[$i]['_id']),
		);
?>
<div class="n l friend-<?php echo $u['_id']?>">
<span class="av">
<a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['img']?>"></a>
</span>
<strong><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></strong>
<span class="button" onClick="_.chat.add(<?php echo $u['_id']?>)">ส่งข้อความ</span>
<div class="clear"></div>
</div>
<?php endfor?>
<?php if($this->next):?>
<div class="next"><a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','morefriends',<?php echo $this->next?>);$(this).html('กรุณารอซํกครู่..').attr('onclick','')">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>

