<div class="navbar">
  <div class="navbar-inner" style="padding-top:3px;">
    <ul class="nav">
      <li class="active"><a href="/first"><i class="icon-home"></i> กิจกรรม</a></li>
    	<li class="divider-vertical"></li>
      <li><a href="/first/list"><i class="icon-list"></i> รูปภาพทั้งหมด</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="/first/apply"><i class="icon-plus-sign"></i> ลงทะเบียนร่วมกิจกรรม</a></li>
  </ul>
  </div>
</div>

<div class="box-promote" title="ร่วมสนุกกับกิจกรรม Boxza แค่เปิดกล่องก็สนุก">

<div class="l">
<p class="l1">สร้างสรรภาพถ่ายไอเดียสุดเจ๋งกับกล่อง ภายใต้คอนเซ็ป</p>
<p class="l2">"Boxza.com กล่องซ่า แค่เปิดกล่องก็สนุก"</p>
<p class="l3">โชว์ไอเดียกันได้เต็มที่ เพื่อเรียกคะแนนจากเพื่อนๆ</p>
<p class="l4">ผู้ที่ได้รับคะแนนโหวตมากสุด <span>รับไปเลยตุ๊กตา</span> <i title="Furby"></i> สุดฮิต</p>
<p class="l5">ผู้ร่วมให้คะแนนโหวตรูปที่คุณชื่นชอบ มีสิทธิ์ลุ้นรับเสื้อยืด boxza.com ฟรี</p>
<p class="l2">"ภาพที่โชว์ไอเดียสุดเจ๋ง รับคะแนนเพิ่มอีก 500 คะแนนฟรีๆ"</p>
<?php if(EVENT_ENABLED==1):?><a href="/first/apply" class="btn-register"></a><?php endif?>
</div>

</div>

<ul class="nav nav-tabs">
<?php if(EVENT_ENABLED==2):?>
<li class="active"><a href="/">ผลคะแนนที่ได้รับรางวัล</a></li>
<li><a href="/first/score">ผลคะแนนทั้งหมด</a></li>
<?php else:?>
 <li class="active"><a href="/">ผู้เข้าประกวดล่าสุด</a></li>
<li><a href="/first/list">ผู้เข้าประกวดทั้งหมด</a></li>
<?php endif?>
</ul>

<ul class="event-photo">
<?php for($i=0;$i<count($this->last);$i++):?>
<li<?php echo $this->last[$i]['pf']?' class="event-photo-top"':''?>>
<div>
<a href="/first/<?php echo $this->last[$i]['_id']?>"><img src="http://s3.boxza.com/event/first/<?php echo $this->last[$i]['fd']?>/<?php echo $this->last[$i]['n']?>.t.<?php echo $this->last[$i]['ty']?>" alt="<?php echo $this->last[$i]['t']?>"></a>
<?php if(EVENT_ENABLED==2):?>
<span><?php echo $i+1?></span>
<i><?php echo $this->last[$i]['v']?></i>
<?php endif?>
<p><?php echo $this->last[$i]['t']?></p>
</div>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>


<div class="box-reward1">
<div>ผู้ที่ได้รับคะแนนโหวตอันดับที่ 1-3 รับ <span>ตุ๊กตาเฟอร์บี้สุดฮิต</span> จำนวน 3 รางวัล</div>
</div>

<div class="box-reward2">
<div class="c">ผู้ที่ได้รับคะแนนโหวตอันดับที่ 4 รับ <span>Android Tablet จาก MOBILE D5</span> จำนวน 1 รางวัล</div>
<div class="l">
รายละเอียดของรางวัล<br>
7" Capacitive Touch Screen Tablet PC with internal 3G, WIFI and 2G/3G Voice Call, Video Call 4 GB.<br>
CPU:VIA 8850 (cortex A9 Mali400 processor speed 1.2GHZ)<br>
Display: 7.0 ” capacitive touch screen:800*480<br>
Touch Screen: Capacitive touch screen 5 points multi-touchNetworks: Wireless LAN 802.11 WIFI (3G – External)<br>
PC camera: Front Camera 1.3 Mega Pixels<br>
Power:Battery type Lithium-ion 2500mAh<br>
Battery life and worktime :Up to 3 hours of surfing the web using 3G data network<br>
Operating System: Google Android 4.0 Ice-Cream Sandwich<br>
<br>
<span>มูลค่า 3,999 บาท</span><br>
<div class="s">ผู้สนับสนุนของรางวัล <a href="http://www.d5mobilethailand.com" target="_blank" rel="nofollow">www.d5mobilethailand.com</a></div>
</div>
</div>

<div class="box-reward3">
<div class="c">ผู้ที่ได้รับคะแนนโหวตอันดับที่ 5 รับ <span>Wifi Router รุ่นESR150H แรงเว่อร์</span> จำนวน 1 รางวัล</div>
<div class="l">
รายละเอียดของรางวัล<br>
Engenius Wifi Router รุ่นESR150H<br>
สัญญาณแรง เหมาะสำหรับผู้ใช้เน็ตทั่วไป | มาตรฐาน IEEE802.11b/g/n <br>
ความเร็ว 150Mbps (1T1R)  | กำลังส่ง 23dBm (200mW)<br>
เสาอากาศSMA 2dBi ถอดเปลี่ยนได้ | RAM 32MB, Flash 4MB <br>
LAN : 4 x 10/100Mbps  | WAN : 1 x 10/100Mbps <br>
ทำ Repeater/WDS ได้ | ทำ Guest SSID ได้<br>
ทำ VPN Server/Client ได้ | มี Parential Control/Firewall<br>
Latest Firmware <br>
<br>
<span>มูลค่า 1,750 บาท</span><br>
<div class="s">ผู้สนับสนุนของรางวัล <a href="http://www.nvk.co.th/engenius/" target="_blank" rel="nofollow">www.nvk.co.th/engenius</a></div>
</div>
</div>

<div class="box-reward4">
<div class="c">ผู้ที่ได้รับคะแนนโหวตอันดับ 1-10 และสุ่มผู้โชคดีที่ร่วมให้คะแนนโหวต จำนวน 20 รางวัล <br>รับ <span>เสื้อยืด Boxza.com พร้อมสติ๊กเกอร์</span></div>
<div class="l">สติ๊กเกอร์ Boxza.com</div>
</div>