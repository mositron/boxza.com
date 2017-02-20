
<?php 
	for($i=0;$i<count($this->friend);$i++):
		$u=$this->user->profile($this->friend[$i]);
?>
<div class="n friend-<?php echo $u['_id']?>">
<span class="av" av="<?php echo $u['_id']?>">
<a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['img']?>"></a>
</span>
<strong><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></strong>
<div class="clear"></div>
</div>
<?php endfor?>
<?php if($this->next):?>
<div class="next"><a href="javascript:;" onClick="_.ajax.gourl('/<?php echo _::$profile['link']?>/friends','morefriends',<?php echo $this->next?>); $(this).parent().remove();">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>

