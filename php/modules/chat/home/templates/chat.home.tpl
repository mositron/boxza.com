<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->


<style>
._hd li.notify{padding:0px}
.tbservice td,.tbservice th{text-align:center;}
.tbservice td.tab_name{text-align:left; width:100px}
.tbservice td.tab_welcome{text-align:left}
.tab_published{ width:80px;}

.chat-feature li{height:130px; overflow:hidden;}
.chat-feature li > p{width:120px; float:left;padding:5px 0px; text-align:center; background:#f5f5f5; margin:0px 0px 0px 5px;}
.chat-feature li > div{margin:0px 0px 0px 130px;}
.chat-feature li > div h4 {height: 30px;line-height: 30px;background: #F0F0F0;padding: 0px 0px 0px 10px;text-shadow: 1px 1px 0px #FFF;}
.chat-feature li > div p{ line-height:1.8em; text-indent:10px;}
</style>
<div style="padding:5px; background:#f0f0f0; text-shadow:1px 1px 0px #fff; margin:0px 0px 5px 0px; text-align:center; font-size:14px">
<h4>สร้างห้องแชทฟรี <small><a href="/manage" class="btn btn-mini">  จัดการห้องแชทของฉัน</a></small></h4>
<p>แชท แชทหาเพื่อน แชทสด คุยสด แชทรูม ดูกล้อง ส่องเว็บแคม พูดคุยหาเพื่อน โชว์กล้องผ่านเว็บแคม </p>
<!--div style="margin:10px; text-align:center"><a href="/lobby" class="btn btn-warning btn-large">เข้าห้องแชท</a></div-->
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>


<iframe frameborder="0" width="100%" height="500" id="bz_chat" src="http://s0.boxza.com/static/chat/?r=1"></iframe>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
 
<div style="padding:10px; border:1px solid #f0f0f0; border-radius:5px; margin:0px 0px 10px;">
<h4>ห้องแชท</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table tbservice">
<thead>
<tr class="text-center">
<th>ชื่อห้อง</th>
<th></th>
<!--th>สร้างโดย</th-->
<th>สมาชิก</th>
<th>ทั่วไป</th>
</tr>
</thead>
<tbody>   
<?php for($i=0;$i<count($this->chat);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<td class="tab_name"><?php echo $this->chat[$i]['_id']?>. <a href="/<?php echo $this->chat[$i]['l']?$this->chat[$i]['l']:'room/'.$this->chat[$i]['_id']?>" target="_blank">ห้อง<?php echo $this->chat[$i]['n']?></a></td>
<td class="tab_welcome"><?php echo $this->chat[$i]['w']?></p></td>
<!--td class="tab_published"><?php $u=$this->user->profile($this->chat[$i]['u']);?><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td!-->
<td class="tab_published"><?php echo $this->chat[$i]['cu']?></td>
<td class="tab_published"><?php echo $this->chat[$i]['cv']?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div class="chat-feature">
<ul class="thumbnails row-count-2">
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-webcam.png" alt="แชทผ่านกล้อง"></p>
<div><h4>แชทผ่านกล้อง</h4>
<p>แชทสด คุยสด แชทรูม รองรับการสนทนาผ่านกล้องเว็บแคม สามารถดูกล้องทั้งเสียงและภาพ แบบไม่จำกัดจำนวนจอ</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-bank.png" alt="ธนาคาร"></p>
<div><h4>ธนาคาร</h4>
<p>ระบบธนาคาร สำหรับแลกบ๊อกเป็นคะแนน เพื่อมาใช้งานภายในห้องแชท</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-shop.png" alt="ร้านค้า"></p>
<div><h4>ร้านค้า</h4>
<p>ร้านค้าขายไอเท็มสำหรับใช้ภายในแชท เพื่อเพิ่มประสิทธิ์ภาพของไอดีคุณภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-namtoa.png" alt="เกมน้ำเต้า"></p>
<div><h4>เกมน้ำเต้า</h4>
<p>เกมเสี่ยงดวง น้ำเต้า ปู ปลา เพิ่มความสนุกสนานและเพื่อหาคะแนนเพิ่มจากการเสี่ยงดวงภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-slave.png" alt="เกมสลาฟ"></p>
<div><h4>เกมสลาฟ</h4>
<p>เกมไพ่สำหรับเล่นกับเพื่อนๆภายในแชท เพิ่มความสนุกและหาคะแนนเพิ่มเติมจากการวัดดวงกับเพื่อนภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-lotto.png" alt="ล็อตเตอรี่"></p>
<div><h4>ล็อตเตอรี่</h4>
<p>เกมเสี่ยงดวงจากการทายตัวเลข ที่อาจจะทำให้ควรรวยภายในพริบตา</p>
</div>
</li>
<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-thief.png" alt="ขโมย"></p>
<div><h4>ขโมย</h4>
<p>เกมขโมยคะแนนจากเพื่อน เพิ่มความสนุกสนานยิ่งขึ้น เมื่อคุณสามารถขโมยคะแนนจากผู้อื่นได้</p>
</div>
</li>

<li class="span6">
<p><img src="http://s0.boxza.com/static/images/chat/home-logs.png" alt="หน้าต่างเกมส์"></p>
<div><h4>หน้าต่างเกมส์</h4>
หน้าต่างแสดงการกระทำทุกอย่างภายในเกม ซึ่งแยกออกจากหน้าต่างแชท
</div>
</li>
</ul>

</div>
<div class="fb-comments" data-href="http://chat.boxza.com/" data-num-posts="50" data-width="720"></div>

