<?php if($this->lotto):?>
<div class="lot"> <a href="http://lotto.boxza.com/" title="ตรวจหวย หวย ตรวจสลากกินแบ่งรัฐบาล" target="_blank"><i></i></a>
    <p>ตรวจสลากกินแบ่งรัฐบาล<br>
        งวดประจำวันที่ <strong><?php echo time::show($this->lotto['tm'],'date')?></strong></p>
    <p class="t">รางวัลที่ 1</p>
    <p class="b"><?php echo $this->lotto['a1']?></p>
    <p class="t">เลขท้าย 3 ตัว <small>รางวัลละ 2,000 บาท</small></p>
    <p class="b"><?php echo implode(' &nbsp; ',$this->lotto['l3'])?></p>
    <p class="t">เลขท้าย 2 ตัว <small>รางวัลละ 1,000 บาท</small></p>
    <p class="b"><?php echo $this->lotto['l2']?></p>
</div>
<?php endif?>
<div class="mn-global">
<h4><a href="http://boxza.com/" target="_blank">บริการทั้งหมดภายใน BoxZa</a></h4>
<?php /*if($this->movie):?>
<h5><a href="http://movie.boxza.com" target="_blank"><strong>ดูหนังออนไลน์</strong> หนังมาใหม่ ตัวอย่างหนัง</a></h5>
<a href="http://movie.boxza.com/<?php echo $this->movie['_id'].'-'.$this->movie['l']?>.html" target="_blank"><img src="http://img.youtube.com/vi/<?php echo $this->movie['v'][0]['yt']?>/mqdefault.jpg" alt="" style="width:100%"></a>
<a href="http://movie.boxza.com/<?php echo $this->movie['_id'].'-'.$this->movie['l']?>.html" target="_blank"><strong><?php echo $this->movie['t']?></strong> <?php echo $this->movie['t2']?></a><br>
เข้าฉาย: <?php echo time::show($this->movie['tm'],'date')?>
<?php endif */ ?>

<?php if($this->sexy):?>
<h5><a href="http://forum.boxza.com/image" title="รูปภาพ" target="_blank"><strong>รูปภาพ</strong></a></h5>
<ul class="sx">
<?php for($i=0;$i<count($this->sexy);$i++):?>
<li><a href="http://forum.boxza.com/topic/<?php echo $this->sexy[$i]['_id']?>" target="_blank"><img src="http://s3.boxza.com/forum/<?php echo $this->sexy[$i]['fd']?>/s.jpg" alt="<?php echo $this->sexy[$i]['t']?>"></a></li>
<?php endfor?>
</ul>
<?php endif?>

<?php if($this->game):?>
<h5><a href="http://game.boxza.com" target="_blank"><i class="i5"></i> <strong>เกมส์</strong> เกมส์ออนไลน์ เกมส์ flash</a></h5>
<ul class="gm">
<?php for($i=0;$i<count($this->game);$i++):?>
<li>
<a href="http://game.boxza.com/flash/<?php echo $this->game[$i]['_id']?>-<?php echo $this->game[$i]['l']?>.html" title="เกมส์<?php echo $this->game[$i]['t']?>" class="i" target="_blank"><img src="http://s3.boxza.com/game/flash/<?php echo $this->game[$i]['fd']?>/t.jpg" alt="เกมส์<?php echo $this->game[$i]['t']?>" title="เกมส์<?php echo $this->game[$i]['t']?>"></a>
<p class="t"><a href="http://game.boxza.com/flash/<?php echo $this->game[$i]['_id']?>-<?php echo $this->game[$i]['l']?>.html" title="เกมส์<?php echo $this->game[$i]['t2'].' '.$this->game[$i]['t']?>" target="_blank"><?php echo $this->game[$i]['t']?></a></p>
<p>เกมส์<?php echo $this->game[$i]['t2']?></p>
</li>
<?php endfor?>
</ul>
<?php endif?>
<h5><a href="http://about.boxza.com" target="_blank"><i class="i5"></i> <strong>คลังข้อมูล</strong> ข้อมูลน่ารู้</a></h5>
<div style="padding:0px 5px 10px; text-align:left">
<?php for($i=0;$i<count($this->about);$i++):?><?php echo $i>0?', ':''?><a href="http://about.boxza.com/<?php echo $this->about[$i]['lk']?>" title="<?php echo $this->about[$i]['t']?>"target="_blank"><?php echo $this->about[$i]['t']?></a><?php endfor?>
</div>
<ul class="mn-global-mn">
<li><a href="http://social.boxza.com/" title="ไลน์ สังคมออนไลน์ของคนไทย" target="_blank"><i class="icon-star-empty"></i> สังคมออนไลน์  <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://news.boxza.com/" title="ข่าว ข่าววันนี้ ข่าวเด่น ข่าวติดกระแส ข่าวเกมส์ ข่าวเทคโนโลยี" target="_blank"><i class="icon-star-empty"></i> ข่าววันนี้</a></li>
<li><a href="http://politic.boxza.com/" title="ข่าวการเมือง การเมืองวันนี้ ข่าวการเมืองล่าสุด ข่าวการเมืองวันนี้" target="_blank"><i class="icon-star-empty"></i> ข่าวการเมือง <img src="http://s0.boxza.com/static/images/global/new/new5.gif" alt=""></a></li>
<li><a href="http://entertain.boxza.com/" title="ข่าวบันเทิง บันเทิง ข่าวดารา ข่าวนักร้อง ข่าวภาพยนต์" target="_blank"><i class="icon-star-empty"></i> ข่าวบันเทิง <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://drama.boxza.com/" title="ละคร ละครใหม่ เรื่องย่อละคร ละครย้อนหลัง" target="_blank"><i class="icon-star-empty"></i> ละคร</a></li>
<li><a href="http://car.boxza.com/" title="ราคารถใหม่ ราคา honda ราคา toyota ราคา mitsubishi" target="_blank"><i class="icon-star-empty"></i> ราคารถใหม่</a></li>
<li><a href="http://racing.boxza.com/" title="รถแต่ง รถแข่ง รถสวย บิ๊กไบค์ แต่งรถ ชุดแต่ง ล้อแม็ก ยางรถยนต์ อุปกรณ์แต่งรถ" target="_blank"><i class="icon-star-empty"></i> รถแต่ง</a></li>
<li><a href="http://football.boxza.com/" title="ผลบอล บ้านผลบอล ผลบอลสด วิเคราะห์ บอลวันนี้ ตารางคะแนน โปรแกรมฟุตบอล" target="_blank"><i class="icon-star-empty"></i> ผลบอล <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://beauty.boxza.com/" title="ผู้หญิง เสริมสวย แต่งหน้า แฟชั่น ความงาม สุขภาพ" target="_blank"><i class="icon-star-empty"></i> ผู้หญิง แฟชั่น</a></li>
<li><a href="http://friend.boxza.com/" title="หาเพื่อน หาแฟน หากิ๊ก หาคู่" target="_blank"><i class="icon-star-empty"></i> หาเพื่อน</a></li>
<li><a href="http://chat.boxza.com/" title="แชท คุยสด หาเพื่อนคุย" target="_blank"><i class="icon-star-empty"></i> แชท คุยสด <img src="http://s0.boxza.com/static/images/global/hot.gif" alt=""></a></li>
<li><a href="http://forum.boxza.com/image" title="รูป รูปภาพ รูปโป๊ สาวเซ็กส์ซี่ น่ารัก หนุ่มหล่อ สาวสวย" target="_blank"><i class="icon-star-empty"></i> รูปภาพ</a></li>
<li><a href="http://forum.boxza.com/" title="เว็บบอร์ด กระดานสนทนา ฟอรั่ม" target="_blank"><i class="icon-star-empty"></i> เว็บบอร์ด</a></li>
<li><a href="http://album.boxza.com/" title="แบ่งปันรูปภาพ" target="_blank"><i class="icon-star-empty"></i> อัลบั้มรูปภาพ</a></li>
<li><a href="http://movie.boxza.com/" title="หนัง หนังใหม่ ดูหนังออนไลน์ โปรแกรมหนัง" target="_blank"><i class="icon-star-empty"></i> หนัง</a></li>
<li><a href="http://game.boxza.com/" title="เกม เกมส์ เกมส์ออนไลน์" target="_blank"><i class="icon-star-empty"></i> เกมส์</a></li>
<li><a href="http://market.boxza.com/" title="ลงประกาศฟรี" target="_blank"><i class="icon-star-empty"></i> ลงประกาศฟรี</a></li>
<li><a href="http://lotto.boxza.com/" title="หวย ตรวจหวย ตรวจฉลากกินแบ่งรัฐบาล" target="_blank"><i class="icon-star-empty"></i> ตรวจหวย</a></li>
<li><a href="http://lotto.boxza.com/set" title="หวยหุ้น หวยหุ้นวันนี้ หวยหุ้นไทย" target="_blank"><i class="icon-star-empty"></i> หวยหุ้น</a></li>
<li><a href="http://video.boxza.com/" title="ดูทีวีออนไลน์ ดูทีวีย้อนหลัง" target="_blank"><i class="icon-star-empty"></i> วิดีโอ</a></li>
<li><a href="http://glitter.boxza.com/" title="กลิตเตอร์ Glitter" target="_blank"><i class="icon-star-empty"></i> Glitter</a></li>
<li><a href="http://radio.boxza.com/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์" target="_blank"><i class="icon-star-empty"></i> ฟังเพลงออนไลน์</a></li>
<li><a href="http://horo.boxza.com/" title="ดูดวง ดูดวงประจำวัน ดูดวงความรัก ดูดวงไพ่ยิบซี ดูดวงเบอร์โทรศัพท์" target="_blank"><i class="icon-star-empty"></i> ดูดวง</a></li>
<li><a href="http://music.boxza.com/" title="เพลง เพลงใหม่ เนื้อเพลง" target="_blank"><i class="icon-star-empty"></i> เพลง</a></li>
<li><a href="http://image.boxza.com/" title="ฝากรูป ฝากรูปฟรี สูงสุด 10MB" target="_blank"><i class="icon-star-empty"></i> ฝากรูป</a></li>
<li><a href="http://boyz.boxza.com/" title="เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ หาเพื่อนเกย์" target="_blank"><i class="icon-star-empty"></i> เกย์ ชายรักชาย</a></li>
<li><a href="http://lesbian.boxza.com/" title="เลสเบี้ยน ทอมดี้ ทอม ดี้ สังคมชาวเลสเบี้ยน เลสไบ เลสโบท เลสคิง เลสควีน เลสรุก เลสรับ หาเพื่อนเลสเบี้ยน" target="_blank"><i class="icon-star-empty"></i> เลสเบี้ยน ทอมดี้</a></li>
<li><a href="http://weather.boxza.com/" title="พยากรณ์อากาศ สภาพอากาศ" target="_blank"><i class="icon-star-empty"></i> พยากรณ์อากาศ</a></li>
<li><a href="http://tech.boxza.com/" title="เทคโนโลยี ข่าวไอที" target="_blank"><i class="icon-star-empty"></i> เทคโนโลยี</a></li>
<li><a href="http://people.boxza.com/" title="ดารา ประวัติดารา ประวัติ บุคคล ดารา นักร้อง นักการเมือง" target="_blank"><i class="icon-star-empty"></i> ดารา</a></li>
<li><a href="http://calendar.boxza.com/" title="ปฏิทิน ปฏิทินวันหยุด ปฏิทินวันสำคัญ" target="_blank"><i class="icon-star-empty"></i> ปฏิทิน</a></li>
<li><a href="http://place.boxza.com/" title="สถานที่ ตำแหน่ง สถานที่ท่องเที่ยว ที่พัก" target="_blank"><i class="icon-star-empty"></i> สถานที่</a></li>
<li><a href="http://home.boxza.com/" title="บ้าน แบบบ้าน ห้องน้ำ ห้องนอน ห้องรับแขก ตัวอย่างบ้าน ตกแต่งบ้าน" target="_blank"><i class="icon-star-empty"></i> แบบบ้าน</a></li>
<li><a href="http://pet.boxza.com/" title="สัตว์เลี้ยง สัตว์ แมว หมา สุนัข นก ปลา" target="_blank"><i class="icon-star-empty"></i> สัตว์เลี้ยง</a></li>
<li><a href="http://wedding.boxza.com/" title="แต่งงาน ชุดแต่งงาน งานแต่งงาน พิธีแต่งงาน" target="_blank"><i class="icon-star-empty"></i> แต่งงาน</a></li>
<li><a href="http://baby.boxza.com/" title="แม่และเด็ก การตั้งครรภ์ ให้นม" target="_blank"><i class="icon-star-empty"></i> แม่และเด็ก</a></li>
<li><a href="http://travel.boxza.com/" title="ท่องเที่ยว สถานที่ท่องเที่ยว พาชิม ท่องเที่ยวไทย เที่ยวต่างประเทศ" target="_blank"><i class="icon-star-empty"></i> ท่องเที่ยว</a></li>
<li><a href="http://education.boxza.com/" title="การศึกษา เรียนต่อ ทุนเรียนต่อ มหาวิทยาลัย โรงเรียน O-NET Admission" target="_blank"><i class="icon-star-empty"></i> การศึกษา</a></li>
<li><a href="http://health.boxza.com/" title="สุขภาพ อาหารสุขภาพ สมุนไพร โรคภัยไข้เจ็บ ออกกำลังกาย" target="_blank"><i class="icon-star-empty"></i> สุขภาพ</a></li>
<li><a href="http://tv.boxza.com/" title="ดูทีวีออนไลน์ ดูทีวี ดูทีวีย้อนหลัง" target="_blank"><i class="icon-star-empty"></i> ดูทีวีออนไลน์</a></li>
<li><a href="http://about.boxza.com/" title="คลังข้อมูล" target="_blank"><i class="icon-star-empty"></i> คลังข้อมูล</a></li>
<div class="clear"></div>
</ul>


</div>
