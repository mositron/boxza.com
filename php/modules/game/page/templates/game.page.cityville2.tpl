<div style="background:#fff;margin-top:5px">
<div class="left pf-l">
<div style="line-height:0px;"><img src="http://s0.boxza.com/static/images/fb/hd-cityville2.jpg" alt="CityVille2"></div>
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
<h3 class="forum_cp" style="margin:5px 0px"><a href="/forum/citiville2">พูดคุยเกี่ยวกับเกมซิตี้วิลล์2 CityVille 2</a> <small>(<a href="/forum/new-topic/63">เพิ่มกระทู้ใหม่</a>)</small></h3>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
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
ดูกระทู้ที่เกี่ยวกับซิตี้วิลล์ ทั้งหมด <a href="/forum/citiville2">คลิกที่นี่</a>
</div>
</div>
<div class="right pf-r">
<div style="padding:5px; border:1px solid #ccc; background:#f9f9f9; text-shadow:1px 1px 0px #fff; line-height:1.8em">
<strong>CityVille 2</strong> - ศูนย์รวมคนเล่นเกมซิตี้วิลล์2 CityVille2 แลกเปลี่ยนเทคนิคการเล่น โปรแกรมบอท โปรแกรมโกง Cheats Speed Hack
เช่น โกงเงิน โกงกุญแจ โกงพลัง โกงเลเวล ปั๊มเลเวล หาเพื่อนเล่นเกมซิตี้วิลล์
</div>

<h3 class="forum_cp" style="margin:5px 0px"><i></i> Follow US on Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/CityVille2.THAI" data-width="245" data-height="400" data-show-faces="true" data-border-color="#eee" data-stream="false" data-header="false" style="margin-bottom:5px;"></div>
</div>
<div class="clear"></div>
</div>





