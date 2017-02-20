<div style="background:#fff;margin-top:5px">
<div class="left pf-l">
<div style="line-height:0px"><img src="http://s0.boxza.com/static/images/fb/hd-farmville2.jpg" alt="FarmVille 2"></div>
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
<h3 class="forum_cp" style="margin:5px 0px"><a href="/c-62">พูดคุยเกี่ยวกับเกมฟาร์มวิลล์2 FarmVille 2</a> <small>(<a href="/new-topic/62">เพิ่มกระทู้ใหม่</a>)</small></h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
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
ดูกระทู้ที่เกี่ยวกับฟาร์มวิลล์2 ทั้งหมด <a href="/c-62">คลิกที่นี่</a>
</div>
</div>
<div class="right pf-r">
<div style="padding:5px; border:1px solid #ccc; background:#f9f9f9; text-shadow:1px 1px 0px #fff; line-height:1.8em">
<strong>FarmVille 2</strong> - ศูนย์รวมคนเล่นเกมฟาร์มวิลล์2 FarmVille2 แลกเปลี่ยนเทคนิคการเล่น โปรแกรมบอท โปรแกรมโกง Cheats Speed Hack
เช่น โกงน้ำ โกงเงิน โกงเหรียญเขียว โกงเครดิต ปั๊มเลเวล ข้ามเควส ขยายฟาร์ม หรือวิธีการแฮกต่างๆ ไม่ว่าจะเป็น น้ำ เงิน เหรียญเขียว พลัง ไซโล บ้าน ตุ๊กตา พืช ของตกแต่งฟาร์ม และอื่นๆอีกมากมาย<br><br>
<strong>กระทู้วิธีการแฮกหรือโกงต่างๆ</strong><br>
- <a href="/topic/483" target="_blank">โกงเลเวล ปั๊มเลเวล farmville2</a><br>
- <a href="/topic/604" target="_blank">โกงเงินเขียว farmville2</a><br>
- <a href="/topic/426" target="_blank">โกงเงิน farmville2</a><br>
- <a href="/topic/745" target="_blank">กำจัดหินและไม้ farmville2</a><br>
- <a href="/topic/715" target="_blank">โกงไซโล เพิ่มไซโล farmville2</a><br>
- <a href="/topic/590" target="_blank">โกงรางร่มเงา เพิ่มรางร่มเงา farmville2</a><br>
- <a href="/topic/36" target="_blank">หาเพื่อน farmville2</a>
</div>

<h3 class="forum_cp" style="margin:5px 0px"><i></i> Follow US on Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/FarmVille2.TH" data-width="245" data-height="400" data-show-faces="true" data-border-color="#eee" data-stream="false" data-header="false" style="margin-bottom:5px;"></div>
</div>
<div class="clear"></div>
</div>






