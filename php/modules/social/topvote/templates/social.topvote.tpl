<style>
#getpeople .n{border-radius: 5px;margin: 2px;border: 1px solid #e5e5e5; position:relative}
#getpeople .n .av{margin:5px}
#getpeople .n > strong{display:block; background:#f8f8f8; padding:5px; color:#0399BE}
#getpeople .n > strong a{color:#0399BE}
#getpeople .n .button{margin-top:5px}
#getpeople .add{display:none; position:absolute; right:10px; bottom:8px;}
#getpeople .d{display:inline-block; padding:8px 0px 0px 5px}
#getpeople .next{clear:both; width:100%; clear:both; padding:5px 0px; text-align:center;}
#getpeople .next a{display:block; height:30px; line-height:30px; text-align:30px; margin:0px auto; width:570px; border:1px solid #f0f0f0; background-color:#f8f8f8; text-align:center;}
</style>
<div class="left pf-l">
<div>
<div class="imp">
<p>ค้นหาเพื่อนของคุณจาก..</p>
<div class="imp-sc">
<a href="/import/facebook" class="show-tooltip-s" title="ค้นหาเพื่อนจาก Facebook"><img src="http://s0.boxza.com/static/images/profile/social/fb_contact-list.png"></a>
<a href="/import/google" class="show-tooltip-s" title="ค้นหาเพื่อนจาก Gmail"><img src="http://s0.boxza.com/static/images/profile/social/gg_contact-list.png"></a>
<a href="/import/twitter" class="show-tooltip-s" title="ค้นหาเพื่อนจาก Twitter"><img src="http://s0.boxza.com/static/images/profile/social/tw_contact-list.png"></a>
<a href="/import/live" class="show-tooltip-s" title="ค้นหาเพื่อนจาก Windows Live / Hotmail"><img src="http://s0.boxza.com/static/images/profile/social/wl_contact-list.png"></a>
<a href="/import/yahoo" class="show-tooltip-s" title="ค้นหาเพื่อนจาก Yahoo"><img src="http://s0.boxza.com/static/images/profile/social/yh_contact-list.png"></a>
<div class="clear"></div>
</div>
</div>



<h4 class="cp"><?php echo $this->bn?> (Top Vote)<p></p></h4>

<div id="getpeople">

<?php
	for($i=0;$i<count($this->topvote);$i++):
		$u=array(
			'_id'=>$this->topvote[$i]['_id'],
			'name'=>$this->topvote[$i]['if']['fn'].' '.$this->topvote[$i]['if']['ln'],
			'img'=>'http://s1.boxza.com/profile/'.$this->topvote[$i]['if']['fd'].'/s.'.($this->topvote[$i]['pf']['av']?$this->topvote[$i]['pf']['av']:'jpg'),
			'link'=>($this->topvote[$i]['if']['lk']?$this->topvote[$i]['if']['lk']:$this->topvote[$i]['_id']),
		);
?>
<div class="n friend-<?php echo $u['_id']?>">
<span class="av" av="<?php echo $u['_id']?>">
<a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['img']?>"></a>
</span>
<strong><?php echo $i+1?>. <a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></strong>

<span class="d">
คะแนนเดือนนี้ <strong><?php echo number_format($this->topvote[$i]['pf']['vt']['m'])?></strong> - คะแนนสะสมทั้งหมด <strong><?php echo number_format($this->topvote[$i]['pf']['vt']['a'])?></strong>
</span>
<span class="add button friend-request-<?php echo $u['_id']?>" onClick="_.friend.request(<?php echo $u['_id']?>)">เพิ่มเป็นเพื่อน</span>

<div class="clear"></div>
</div>

<script>
if(_.my && _.my._id!=<?php echo $u['_id']?> && $.inArray(<?php echo $u['_id']?>,_.my.ct.fr)==-1 && $.inArray(<?php echo $u['_id']?>,_.my.ct.rq)==-1 && $.inArray(<?php echo $u['_id']?>,_.my.ct.bl)==-1)
{
	$('.add.friend-request-<?php echo $u['_id']?>').css('display','inline-block');
}
</script>
<?php endfor?>
</div>

</div>
</div>
<div class="right pf-r">
<span class="ads-top"></span>
<div class="ads-box">
<div>
<div class="cp">10 อันดับสมาชิกยอดนิยม (<?php echo $this->lastmonth?>)</div>
<ul class="usuggest">
<?php for($i=1;$i<=10;$i++):?>
<?php $u=$this->user->profile($this->last[0]['n'.$i]['u'])?>
<li style="position:relative">
<span class="av" av="<?php echo $u['_id']?>"><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['himg']?>" title="<?php echo $u['name']?>"></a></span>
<span class="n"><?php echo $i?>. <a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></span>
<span style="position:absolute; right:3px; font-size:14px; color:#F60"><?php echo number_format($this->last[0]['n'.$i]['v'])?></span>
</li>
<?php endfor?>
<p></p>
</ul>
</div>



<?php echo $this->service?>

<div style="padding:5px 5px; margin:5px 0px 5px 0px; background-color:#f9f9f9; text-align:right; color:#999; font-size:11px">
&copy; 2013 BoxZa, All Rights Reserved.
</div>
</div>
</div>
<div class="clear"></div>
