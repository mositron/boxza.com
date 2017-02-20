<div class="signup-service">
<div>
<div class="box1-l">
<p class="m e"><a href="http://movie.boxza.com" target="_blank" title="หนัง หนังใหม่ ดูหนังออนไลน์"><strong>หนัง</strong> มาใหม่ ดูหนังออนไลน์</a></p>
<a href="http://movie.boxza.com/<?php echo $this->movie['_id'].'-'.$this->movie['l']?>.html" target="_blank" style="margin:5px 0px 0px 0px; display:block; line-height:0px;"><img src="http://img.youtube.com/vi/<?php echo $this->movie['v'][0]['yt']?>/mqdefault.jpg" alt="" style="width:100%"></a>
<a href="http://movie.boxza.com/<?php echo $this->movie['_id'].'-'.$this->movie['l']?>.html" target="_blank" class="mv-a"><strong><?php echo $this->movie['t']?></strong> <?php echo $this->movie['t2']?></a>
เข้าฉาย: <?php echo time::show($this->movie['tm'],'date')?>
</div>

<div class="box1-r">
<p class="s e"><a href="http://forum.boxza.com/image" title="รูป รูปภาพ รูปการ์ตูน" target="_blank"><strong>รูปภาพ</strong></a></p>
<ul class="sx">
<?php for($i=0;$i<count($this->sexy);$i++):?>
<li class="s<?php echo $i?>"><a href="http://forum.boxza.com/topic/<?php echo $this->sexy[$i]['_id']?>" target="_blank"><img src="http://s3.boxza.com/forum/<?php echo $this->sexy[$i]['fd']?>/s.jpg" alt="<?php echo $this->sexy[$i]['t']?>"></a></li>
<?php if($i%3==2):?><p class="clear"></p><?php endif?>
<?php endfor?>
</ul>
</div>
<p class="clear"></p>
</div>

<p class="g e"><a href="http://game.boxza.com" target="_blank" title="เกม เกมส์ เกมส์ออนไลน์ เกมส์PC"><strong>เกมส์</strong> เกม เกมส์ออนไลน์ เกมส์ flash</a></p>
<ul class="gm">
<?php for($i=0;$i<count($this->game);$i++):?>
<li class="g<?php echo $i?>">
<a href="http://game.boxza.com/flash/<?php echo $this->game[$i]['_id']?>-<?php echo $this->game[$i]['l']?>.html" title="เกมส์<?php echo $this->game[$i]['t']?>" class="i" target="_blank"><img src="http://s3.boxza.com/game/flash/<?php echo $this->game[$i]['fd']?>/t.jpg" alt="เกมส์<?php echo $this->game[$i]['t']?>" title="เกมส์<?php echo $this->game[$i]['t']?>"></a>
<p class="t"><a href="http://game.boxza.com/flash/<?php echo $this->game[$i]['_id']?>-<?php echo $this->game[$i]['l']?>.html" title="เกมส์<?php echo $this->game[$i]['t2'].' '.$this->game[$i]['t']?>" target="_blank"><?php echo $this->game[$i]['t']?></a></p>
<p>เกมส์<?php echo $this->game[$i]['t2']?></p>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<p class="e">บริการอื่นๆ</p>
<ul class="signup-service-mn">
<li><a href="http://social.boxza.com/" title="ไลน์ สังคมออนไลน์ของคนไทย" target="_blank">สังคมออนไลน์  <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://news.boxza.com/" title="ข่าว ข่าววันนี้ ข่าวเด่น ข่าวติดกระแส ข่าวเกมส์ ข่าวเทคโนโลยี" target="_blank">ข่าววันนี้</a></li>
<li><a href="http://entertain.boxza.com/" title="ข่าวบันเทิง บันเทิง ข่าวดารา ข่าวนักร้อง ข่าวภาพยนต์" target="_blank">ข่าวบันเทิง</a></li>
<li><a href="http://drama.boxza.com/" title="ละคร ละครใหม่ เรื่องย่อละคร ละครย้อนหลัง" target="_blank"> ละคร</a></li>
<li><a href="http://car.boxza.com/" title="ราคารถใหม่ ราคา honda ราคา toyota ราคา mitsubishi" target="_blank">ราคารถใหม่</a></li>
<li><a href="http://racing.boxza.com/" title="รถแต่ง รถแข่ง รถสวย บิ๊กไบค์ แต่งรถ ชุดแต่ง ล้อแม็ก ยางรถยนต์ อุปกรณ์แต่งรถ" target="_blank">รถแต่ง <img src="http://s0.boxza.com/static/images/global/new/new5.gif" alt=""></a></li>
<li><a href="http://football.boxza.com/" title="ผลบอล บ้านผลบอล ผลบอลสด วิเคราะห์ บอลวันนี้ ตารางคะแนน โปรแกรมฟุตบอล" target="_blank">ผลบอล <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://beauty.boxza.com/" title="ผู้หญิง เสริมสวย แต่งหน้า แฟชั่น ความงาม สุขภาพ" target="_blank">ผู้หญิง แฟชั่น <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://friend.boxza.com/" title="หาเพื่อน หาแฟน หากิ๊ก หาคู่" target="_blank">หาเพื่อน</a></li>
<li><a href="http://chat.boxza.com/" title="แชท คุยสด หาเพื่อนคุย" target="_blank">แชท คุยสด <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://forum.boxza.com/image" title="รูป รูปภาพ รูปโป๊ สาวเซ็กส์ซี่ น่ารัก หนุ่มหล่อ สาวสวย" target="_blank">รูปภาพ</a></li>
<li><a href="http://forum.boxza.com/" title="เว็บบอร์ด กระดานสนทนา ฟอรั่ม" target="_blank">เว็บบอร์ด</a></li>
<li><a href="http://album.boxza.com/" title="แบ่งปันรูปภาพ" target="_blank">อัลบั้มรูปภาพ</a></li>
<li><a href="http://movie.boxza.com/" title="หนัง หนังใหม่ ดูหนังออนไลน์ โปรแกรมหนัง" target="_blank">หนัง</a></li>
<li><a href="http://game.boxza.com/" title="เกม เกมส์ เกมส์ออนไลน์" target="_blank">เกมส์</a></li>
<li><a href="http://market.boxza.com/" title="ลงประกาศฟรี" target="_blank">ลงประกาศฟรี</a></li>
<li><a href="http://lotto.boxza.com/" title="หวย ตรวจหวย ตรวจฉลากกินแบ่งรัฐบาล" target="_blank">ตรวจหวย</a></li>
<li><a href="http://lotto.boxza.com/set" title="หวยหุ้น หวยหุ้นวันนี้ หวยหุ้นไทย" target="_blank">หวยหุ้น</a></li>
<li><a href="http://video.boxza.com/" title="ดูทีวีออนไลน์ ดูทีวีย้อนหลัง" target="_blank">วิดีโอ</a></li>
<li><a href="http://glitter.boxza.com/" title="กลิตเตอร์ Glitter" target="_blank">Glitter</a></li>
<li><a href="http://radio.boxza.com/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์" target="_blank">ฟังเพลงออนไลน์</a></li>
<li><a href="http://horo.boxza.com/" title="ดูดวง ดูดวงประจำวัน ดูดวงความรัก ดูดวงไพ่ยิบซี ดูดวงเบอร์โทรศัพท์" target="_blank">ดูดวง</a></li>
<li><a href="http://music.boxza.com/" title="เพลง เพลงใหม่ เนื้อเพลง" target="_blank">เพลง</a></li>
<li><a href="http://image.boxza.com/" title="ฝากรูป ฝากรูปฟรี สูงสุด 10MB" target="_blank">ฝากรูป</a></li>
<li><a href="http://boyz.boxza.com/" title="เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ หาเพื่อนเกย์" target="_blank">เกย์ ชายรักชาย</a></li>
<li><a href="http://lesbian.boxza.com/" title="เลสเบี้ยน ทอมดี้ ทอม ดี้ สังคมชาวเลสเบี้ยน เลสไบ เลสโบท เลสคิง เลสควีน เลสรุก เลสรับ หาเพื่อนเลสเบี้ยน" target="_blank">เลสเบี้ยน ทอมดี้</a></li>
<li><a href="http://weather.boxza.com/" title="พยากรณ์อากาศ สภาพอากาศ" target="_blank">พยากรณ์อากาศ</a></li>
<li><a href="http://tech.boxza.com/" title="เทคโนโลยี ข่าวไอที" target="_blank">เทคโนโลยี</a></li>
<li><a href="http://people.boxza.com/" title="ดารา ประวัติดารา ประวัติ บุคคล ดารา นักร้อง นักการเมือง" target="_blank">ดารา</a></li>
<li><a href="http://calendar.boxza.com/" title="ปฏิทิน ปฏิทินวันหยุด ปฏิทินวันสำคัญ" target="_blank">ปฏิทิน</a></li>
<li><a href="http://place.boxza.com/" title="สถานที่ ตำแหน่ง สถานที่ท่องเที่ยว ที่พัก" target="_blank">สถานที่</a></li>
<li><a href="http://home.boxza.com/" title="บ้าน แบบบ้าน ห้องน้ำ ห้องนอน ห้องรับแขก ตัวอย่างบ้าน ตกแต่งบ้าน" target="_blank">แบบบ้าน</a></li>
<li><a href="http://pet.boxza.com/" title="สัตว์เลี้ยง สัตว์ แมว หมา สุนัข นก ปลา" target="_blank">สัตว์เลี้ยง</a></li>
<li><a href="http://wedding.boxza.com/" title="แต่งงาน ชุดแต่งงาน งานแต่งงาน พิธีแต่งงาน" target="_blank">แต่งงาน</a></li>
<li><a href="http://baby.boxza.com/" title="แม่และเด็ก การตั้งครรภ์ ให้นม" target="_blank">แม่และเด็ก</a></li>
<li><a href="http://travel.boxza.com/" title="ท่องเที่ยว สถานที่ท่องเที่ยว พาชิม ท่องเที่ยวไทย เที่ยวต่างประเทศ" target="_blank">ท่องเที่ยว</a></li>
<li><a href="http://education.boxza.com/" title="การศึกษา เรียนต่อ ทุนเรียนต่อ มหาวิทยาลัย โรงเรียน O-NET Admission" target="_blank">การศึกษา</a></li>
<li><a href="http://health.boxza.com/" title="สุขภาพ อาหารสุขภาพ สมุนไพร โรคภัยไข้เจ็บ ออกกำลังกาย" target="_blank">สุขภาพ</a></li>
<p class="clear"></p>
</ul>
</div>
