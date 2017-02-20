<style>
.forum-home-list li{width: 245px;margin: 5px 0px 0px;}
.forum-home-list li h4{width:125px;}
</style>

<div style="background:#fff;margin-top:5px">
<div class="left pf-l">
<div style="line-height:0px"><img src="http://s0.boxza.com/static/images/forum/banner/ios.jpg" alt="iOS, Apple, iPhone, iPad, iPod, Apps ใหม่ๆ, Apps ยอดฮิต"></div>

 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; margin:5px 0px;">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<h3 class="forum_cp" style="margin:5px 0px 5px"><a href="/c-401">พูดคุยเกี่ยวกับ iOS, Apple, iPhone, iPad, iPod, Apps ใหม่ๆ, Apps ยอดฮิต</a></h3>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หมวด</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="tcate"><p><a href="/c-<?php echo $val['c']?>"><?php echo $this->cate[$val['c']]['t']?></a></p></td>
	<td class="ttitle ttitle2"><p><a href="/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime',true)?>
     <?php else:?>
     <?php echo time::show($val['ds'],'datetime',true)?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<div style="padding:5px; text-align:right; background:#f7f7f7; margin:2px 0px">
ดูกระทู้ที่เกี่ยวกับ iOS ทั้งหมด <a href="/c-401">คลิกที่นี่</a>
</div>

</div>
<div class="right pf-r">
<div style="padding:5px; border:1px solid #ccc; background:#f9f9f9; text-shadow:1px 1px 0px #fff; line-height:1.8em">
<strong>iOS</strong> - ศูนย์รวมคนใช้งาน iOS - ข้อมูลข่าวสารเกี่ยวกับ iOS, Apple, iPhone, iPad, iPod, iTunes, แอพใหม่ๆ และอื่นๆเกี่ยวกับ iOS
</div>
<h3 class="forum_cp" style="margin:5px 0px 0px">หมวดต่างๆใน iOS</h3>
<ul class="forum-home-list">
<?php foreach($this->cate[401]['l'] as $s):?>
<li>
<span>
<a href="<?php echo $url.'c-'.$s?>"><img src="http://s0.boxza.com/static/images/forum/thumb/<?php echo $s?>.png" alt="<?php echo $this->cate[$s]['t']?>"></i></a>
</span>
<div>
<h4><a href="<?php echo $url.'c-'.$s?>"><?php echo $this->cate[$s]['t']?></a></h4>
<div><?php echo $this->cate[$s]['d']?></div>
<p>กระทู้: <?php echo number_format(intval($this->cate[$s]['tp']))?> | ตอบ: <?php echo number_format(intval($this->cate[$s]['rp']))?><br>อ่าน: <?php echo number_format(intval($this->cate[$s]['do']))?></p>
</div>
<p></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>

<h3 class="forum_cp" style="margin:0px 0px 5px"><i></i> Follow US on Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/boxza.ios" data-width="245" data-height="400" data-show-faces="true" data-border-color="#eee" data-stream="false" data-header="false" style="margin-bottom:5px;"></div>
</div>
<div class="clear"></div>
</div>






