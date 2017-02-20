

<style>
.messages > div{margin:0px 0px; padding:5px 0px; border-bottom:1px solid #f0f0f0;}
.messages .av a img{ width:40px; height:40px; margin:2px; /*border-radius:20px;*/}
.messages .av a { width:44px; height:44px; /*border-radius:22px;*/}
.messages .av{width:44px;}
.messages .d{margin:0px 0px 0px 50px; height:22px;}
.messages .d a{ display:inline-block; padding:2px 5px; background-color:#f5f5f5; text-shadow:1px 1px 0px #fff; float:left; font-weight:bold;}
.messages .d .num{display:inline-block; margin:3px 0px 0px 10px; font-size:9px}
.messages .tm{float:right; margin:3px 0px 0px 0px}
.messages .m{margin:1px 0px 0px 50px; overflow:hidden; white-space: nowrap;text-overflow: ellipsis; height:26px; line-height:26px;}
.messages .m .s{display:inline-block; padding:0px 2px; font-size:9px; margin-top:-4px;}
</style>
<script>
function delch(a,b)
{
	_.box.confirm({title:'ลบข้อความ',detail:'คุณต้องการลบบทสนทนาทั้งหมดของ '+b+' หรือไม่',click:function(){_.ajax.gourl('/messages','dellog',a)}})
}
</script>
<div class="left pf-l">
<h3><a href="/messages" class="h">ข้อความ</a></h3>
<div class="messages">
<?php 
if(is_array($this->chat)):
	$this->chat=array_reverse($this->chat);
	foreach($this->chat as $n):
		$send=true;
		if($n['u']!=_::$my['_id'])
		{
			$uid = $this->user->profile($n['u']);
			$pid=$n['u'];
			$send=false;
		}
		else
		{
			$pid=$n['p'];
			$uid = $this->user->profile($n['p']);
		}
?>
<div>
<span class="av" av="<?php echo $uid['_id']?>"><a href="/messages/<?php echo $uid['_id']?>" class="h" title="<?php echo $uid['name']?>"><img src="<?php echo $uid['img']?>"></a></span>
<div class="d">
<a href="/messages/<?php echo $uid['_id']?>" class="h"><?php echo $uid['name']?></a> <span class="num">( <?php echo number_format(intval($n['count']))?> ข้อความ )</span>

<p class="tm">เมื่อ <span class="ago" datetime="<?php echo $n['da']->sec?>"></span></p>
<p class="clear"></p>
</div>

<div class="m">
<span class="s">&<?php echo $send?'l':'g'?>t;</span> <?php echo mb_substr($n['last'],0,50,'utf-8')?>... 
<p class="right"><span class="button" onClick="delch('<?php echo $pid?>','<?php echo htmlspecialchars($uid['name'], ENT_QUOTES,'utf-8')?>')">ลบ</span></p>
</div>
<div class="clear"></div>
</div>
<?php 
	endforeach;
else:
?>


<?php
endif;
?>
</div>
<br><br><br>
<br><br><br>
</div>
<div class="right pf-r">
<span class="ads-top"></span>
<div class="ads-box"><?php echo $this->service?></div>


</div>
<div class="clear"></div>

