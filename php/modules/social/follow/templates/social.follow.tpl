


<div class="left pf-l">
<div class="imp">
<p>ค้นหาเพื่อนของคุณจาก..</p>
<div class="imp-sc">
<a href="/import/facebook"><img src="http://s0.boxza.com/static/images/profile/social/fb_contact-list.png"></a>
<a href="/import/google"><img src="http://s0.boxza.com/static/images/profile/social/gg_contact-list.png"></a>
<a href="/import/twitter"><img src="http://s0.boxza.com/static/images/profile/social/tw_contact-list.png"></a>
<a href="/import/live"><img src="http://s0.boxza.com/static/images/profile/social/wl_contact-list.png"></a>
<a href="/import/yahoo"><img src="http://s0.boxza.com/static/images/profile/social/yh_contact-list.png"></a>
<div class="clear"></div>
</div>
</div>

<ul class="tabs profile-about" style="margin-bottom:10px;">
<li<?php echo !_::$path[0]?' class="active"':''?>><a href="/folow" title="กำลังติดตาม" class="h no-top">กำลังติดตาม (<?php echo number_format(count(_::$my['ct']['fl']))?>/500)</a></li>
<p class="clear"></p>
</ul>
<?php if(_::$path[0]!='request'):?>
<ul class="tabs">
<?php $gd=array_reverse(_::$config['gender'] );foreach($gd as $k=>$v):?>
<li<?php echo _::$path[0]==$k?' class="active"':''?> style="float:right"><a href="/follow/<?php echo $k?>" class="h"><?php echo $v?></a></li>
<?php endforeach?>
<li<?php echo !_::$path[0]?' class="active"':''?> style="float:right"><a href="/follow" class="h">เพื่อนทุกเพศ</a></li>
<p class="clear"></p>
</ul>
<?php endif?>
<div id="getfriends" class="getfriends"><?php echo $this->getfriends?></div>

<br><br><br>
</div>


<div class="right pf-r">
<span class="ads-top"></span>
<div class="ads-box">
<h3 class="cp">ออนไลน์ล่าสุด</h3>
<div class="getfriends">
<?php 
	for($i=0;$i<count($this->flast);$i++):
		$u=array(
			'_id'=>$this->flast[$i]['_id'],
			'name'=>$this->flast[$i]['if']['fn'].' '.$this->flast[$i]['if']['ln'],
			'img'=>'http://s1.boxza.com/profile/'.$this->flast[$i]['if']['fd'].'/s.'.($this->flast[$i]['pf']['av']?$this->flast[$i]['pf']['av']:'jpg'),
			'link'=>($this->flast[$i]['if']['lk']?$this->flast[$i]['if']['lk']:$this->flast[$i]['_id']),
		);
?>
<div class="n friend-<?php echo $u['_id']?>">
<span class="av">
<a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['img']?>"></a>
</span>
<strong><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></strong>
<span class="button" onClick="_.line.go('/messages/<?php echo $u['_id']?>',true)">ส่งข้อความ</span>
<span class="button" onClick="_.friend.del(<?php echo $u['_id']?>,'<?php echo str_replace('\'','\\\'',$u['name'])?>')">ลบเพื่อน</span>
<div class="clear"></div>
</div>
<?php endfor?>
</div>
</div>
</div>
<div class="clear"></div>
