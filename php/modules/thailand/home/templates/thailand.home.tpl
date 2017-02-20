<div class="ab">
<h3 class="ab-ha">HOT NOW!! </h3>
<div class="row-fluid">
<div class="span8">
<div class="row-fluid">
<div class="span6">
<a href="/<?php echo $this->hot['lk']?>" target="_blank" title="<?php echo $this->hot['n']?>" class="ab-img"><img src="http://s3.boxza.com/place/<?php echo $this->hot['fd']?>/t.jpg" alt="<?php echo $this->hot['n']?>"></a>
</div>
<div class="span6">
<h4 class="ab-hb"><a href="/<?php echo $this->hot['lk']?>" target="_blank" title="<?php echo $this->hot['n']?>"><?php echo $this->hot['n']?></a></h4>
<ul class="ab-ul">
<?php if($this->hot['adr']):?><li class="l">ที่อยู่: <?php echo $this->hot['adr']?></li><?php endif?>
<?php if($this->hot['op']):?><li class="l">เวลาเปิด/ปิด: <?php echo $this->hot['op']?></li><?php endif?>
<?php if($this->hot['ph']):?><li class="l">เบอร์โทรศัพท์: <?php echo $this->hot['ph']?></li><?php endif?>
<?php if($this->hot['c']):?><li class="l">ประเภท: <?php echo $this->cate[$this->hot['c']]['t'];?></li><?php endif?>
</ul>
</div>
</div>
<?php if(count($this->hin)):?>
<div>
<h3 class="ab-hd"><a href="<?php echo $hlink?>/instagram" target="_blank" title="Instagram <?php echo $this->hot['n']?>">Instagram <?php echo $this->hot['n']?></a></h3>
<ul class="ab-in">
<?php for($i=0;$i<count($this->hin);$i++):?>
<li><a href="<?php echo $hlink?>/instagram/<?php echo $this->hin[$i]['_id']?>" target="_blank"><img src=""></a></li>
<?php endfor?>
</ul>
</div>
<?php endif?>
</div>
<div class="span4">
<h4 class="ab-hc">ข่าว<?php echo $this->hot['n']?></h4>
<ul class="ab-news">
<?php for($i=0;$i<count($this->hnews);$i++):?>
<li>
<a href="<?php echo link::news($this->hnews[$i])?>" target="_blank">
<img src="http://s3.boxza.com/news/<?php echo $this->hnews[$i]['fd']?>/s.jpg">
<p><?php echo $this->hnews[$i]['t']?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
</div>
</div>


<?php require(HANDLERS.'ads/ads.adsense.body3.php');?>

<div style="padding:10px 5px">


<strong>ประเทศไทย</strong>แบ่งออกเป็น 6 ภาค คือ
<ol>
<li>
<a href="/ภาคกลาง" title="ภาคกลาง" target="_blank"><strong>ภาคกลาง</strong></a>  ประกอบด้วย 22 จังหวัด<br>
<a href="/กรุงเทพมหานคร" title="จังหวัดกรุงเทพมหานคร" target="_blank">กรุงเทพมหานคร</a>, 
<a href="/กำแพงเพชร" title="จังหวัดกำแพงเพชร" target="_blank">กำแพงเพชร</a>, 
<a href="/ชัยนาท" title="จังหวัดชัยนาท" target="_blank">ชัยนาท</a>, 
<a href="/นครนายก" title="จังหวัดนครนายก" target="_blank">นครนายก</a>, 
<a href="/นครปฐม" title="จังหวัดนครปฐม" target="_blank">นครปฐม</a>, 
<a href="/นครสวรรค์" title="จังหวัดนครสวรรค์" target="_blank">นครสวรรค์</a>, 
<a href="/นนทบุรี" title="จังหวัดนนทบุรี" target="_blank">นนทบุรี</a>, 
<a href="/ปทุมธานี" title="จังหวัดปทุมธานี" target="_blank">ปทุมธานี</a>, 
<a href="/พระนครศรีอยุธยา" title="จังหวัดพระนครศรีอยุธยา" target="_blank">พระนครศรีอยุธยา</a>, 
<a href="/พิจิตร" title="จังหวัดพิจิตร" target="_blank">พิจิตร</a>, 
<a href="/พิษณุโลก" title="จังหวัดพิษณุโลก" target="_blank">พิษณุโลก</a>, 
<a href="/ลพบุรี" title="จังหวัดลพบุรี" target="_blank">ลพบุรี</a>, 
<a href="/สมุทรปราการ" title="จังหวัดสมุทรปราการ" target="_blank">สมุทรปราการ</a>, 
<a href="/สมุทรสงคราม" title="จังหวัดสมุทรสงคราม" target="_blank">สมุทรสงคราม</a>, 
<a href="/สมุทรสาคร" title="จังหวัดสมุทรสาคร" target="_blank">สมุทรสาคร</a>, 
<a href="/สระบุรี" title="จังหวัดสระบุรี" target="_blank">สระบุรี</a>, 
<a href="/สิงห์บุรี" title="จังหวัดสิงห์บุรี" target="_blank">สิงห์บุรี</a>, 
<a href="/สุพรรณบุรี" title="จังหวัดสุพรรณบุรี" target="_blank">สุพรรณบุรี</a>, 
<a href="/สุโขทัย" title="จังหวัดสุโขทัย" target="_blank">สุโขทัย</a>, 
<a href="/อุทัยธานี" title="จังหวัดอุทัยธานี" target="_blank">อุทัยธานี</a>, 
<a href="/อ่างทอง" title="จังหวัดอ่างทอง" target="_blank">อ่างทอง</a>, 
<a href="/เพชรบูรณ์" title="จังหวัดเพชรบูรณ์" target="_blank">เพชรบูรณ์</a>
</li>
<li>
<a href="/ภาคตะวันออก" title="ภาคตะวันออก" target="_blank"><strong>ภาคตะวันออก</strong></a>  ประกอบด้วย 7 จังหวัด<br>
<a href="/จันทบุรี" title="จังหวัดจันทบุรี" target="_blank">จันทบุรี</a>, 
<a href="/ฉะเชิงเทรา" title="จังหวัดฉะเชิงเทรา" target="_blank">ฉะเชิงเทรา</a>, 
<a href="/ชลบุรี" title="จังหวัดชลบุรี" target="_blank">ชลบุรี</a>, 
<a href="/ตราด" title="จังหวัดตราด" target="_blank">ตราด</a>, 
<a href="/ปราจีนบุรี" title="จังหวัดปราจีนบุรี" target="_blank">ปราจีนบุรี</a>, 
<a href="/ระยอง" title="จังหวัดระยอง" target="_blank">ระยอง</a>, 
<a href="/สระแก้ว" title="จังหวัดสระแก้ว" target="_blank">สระแก้ว</a>
</li>
<li>
<a href="/ภาคตะวันออกเฉียงเหนือ" title="ภาคตะวันออกเฉียงเหนือ" target="_blank"><strong>ภาคตะวันออกเฉียงเหนือ</strong></a>  ประกอบด้วย 20 จังหวัด<br>
<a href="/กาฬสินธุ์" title="จังหวัดกาฬสินธุ์" target="_blank">กาฬสินธุ์</a>, 
<a href="/ขอนแก่น" title="จังหวัดขอนแก่น" target="_blank">ขอนแก่น</a>, 
<a href="/ชัยภูมิ" title="จังหวัดชัยภูมิ" target="_blank">ชัยภูมิ</a>, 
<a href="/นครพนม" title="จังหวัดนครพนม" target="_blank">นครพนม</a>, 
<a href="/นครราชสีมา" title="จังหวัดนครราชสีมา" target="_blank">นครราชสีมา</a>, 
<a href="/บึงกาฬ" title="จังหวัดบึงกาฬ" target="_blank">บึงกาฬ</a>, 
<a href="/บุรีรัมย์" title="จังหวัดบุรีรัมย์" target="_blank">บุรีรัมย์</a>, 
<a href="/มหาสารคาม" title="จังหวัดมหาสารคาม" target="_blank">มหาสารคาม</a>, 
<a href="/มุกดาหาร" title="จังหวัดมุกดาหาร" target="_blank">มุกดาหาร</a>, 
<a href="/ยโสธร" title="จังหวัดยโสธร" target="_blank">ยโสธร</a>, 
<a href="/ร้อยเอ็ด" title="จังหวัดร้อยเอ็ด" target="_blank">ร้อยเอ็ด</a>, 
<a href="/ศรีสะเกษ" title="จังหวัดศรีสะเกษ" target="_blank">ศรีสะเกษ</a>, 
<a href="/สกลนคร" title="จังหวัดสกลนคร" target="_blank">สกลนคร</a>, 
<a href="/สุรินทร์" title="จังหวัดสุรินทร์" target="_blank">สุรินทร์</a>, 
<a href="/หนองคาย" title="จังหวัดหนองคาย" target="_blank">หนองคาย</a>, 
<a href="/หนองบัวลำภู" title="จังหวัดหนองบัวลำภู" target="_blank">หนองบัวลำภู</a>, 
<a href="/อำนาจเจริญ" title="จังหวัดอำนาจเจริญ" target="_blank">อำนาจเจริญ</a>, 
<a href="/อุดรธานี" title="จังหวัดอุดรธานี" target="_blank">อุดรธานี</a>, 
<a href="/อุบลราชธานี" title="จังหวัดอุบลราชธานี" target="_blank">อุบลราชธานี</a>, 
<a href="/เลย" title="จังหวัดเลย" target="_blank">เลย</a>
</li>
<li>
<a href="/ภาคเหนือ" title="ภาคเหนือ" target="_blank"><strong>ภาคเหนือ</strong></a>  ประกอบด้วย 9 จังหวัด<br>
<a href="/น่าน" title="จังหวัดน่าน" target="_blank">น่าน</a>, 
<a href="/พะเยา" title="จังหวัดพะเยา" target="_blank">พะเยา</a>, 
<a href="/ลำปาง" title="จังหวัดลำปาง" target="_blank">ลำปาง</a>, 
<a href="/ลำพูน" title="จังหวัดลำพูน" target="_blank">ลำพูน</a>, 
<a href="/อุตรดิตถ์" title="จังหวัดอุตรดิตถ์" target="_blank">อุตรดิตถ์</a>, 
<a href="/เชียงราย" title="จังหวัดเชียงราย" target="_blank">เชียงราย</a>, 
<a href="/เชียงใหม่" title="จังหวัดเชียงใหม่" target="_blank">เชียงใหม่</a>, 
<a href="/แพร่" title="จังหวัดแพร่" target="_blank">แพร่</a>, 
<a href="/แม่ฮ่องสอน" title="จังหวัดแม่ฮ่องสอน" target="_blank">แม่ฮ่องสอน</a>
</li>
<li>
<a href="/ภาคตะวันตก" title="ภาคตะวันตก" target="_blank"><strong>ภาคตะวันตก</strong></a>  ประกอบด้วย 5 จังหวัด<br>
<a href="/กาญจนบุรี" title="จังหวัดกาญจนบุรี" target="_blank">กาญจนบุรี</a>, 
<a href="/ตาก" title="จังหวัดตาก" target="_blank">ตาก</a>, 
<a href="/ประจวบคีรีขันธ์" title="จังหวัดประจวบคีรีขันธ์" target="_blank">ประจวบคีรีขันธ์</a>, 
<a href="/ราชบุรี" title="จังหวัดราชบุรี" target="_blank">ราชบุรี</a>, 
<a href="/เพชรบุรี" title="จังหวัดเพชรบุรี" target="_blank">เพชรบุรี</a>
</li>
<li>
<a href="/ภาคใต้" title="ภาคใต้" target="_blank"><strong>ภาคใต้</strong></a>  ประกอบด้วย 14 จังหวัด<br>
<a href="/กระบี่" title="จังหวัดกระบี่" target="_blank">กระบี่</a>, 
<a href="/ชุมพร" title="จังหวัดชุมพร" target="_blank">ชุมพร</a>, 
<a href="/ตรัง" title="จังหวัดตรัง" target="_blank">ตรัง</a>, 
<a href="/นครศรีธรรมราช" title="จังหวัดนครศรีธรรมราช" target="_blank">นครศรีธรรมราช</a>, 
<a href="/นราธิวาส" title="จังหวัดนราธิวาส" target="_blank">นราธิวาส</a>, 
<a href="/ปัตตานี" title="จังหวัดปัตตานี" target="_blank">ปัตตานี</a>, 
<a href="/พังงา" title="จังหวัดพังงา" target="_blank">พังงา</a>, 
<a href="/พัทลุง" title="จังหวัดพัทลุง" target="_blank">พัทลุง</a>, 
<a href="/ภูเก็ต" title="จังหวัดภูเก็ต" target="_blank">ภูเก็ต</a>, 
<a href="/ยะลา" title="จังหวัดยะลา" target="_blank">ยะลา</a>, 
<a href="/ระนอง" title="จังหวัดระนอง" target="_blank">ระนอง</a>, 
<a href="/สงขลา" title="จังหวัดสงขลา" target="_blank">สงขลา</a>, 
<a href="/สตูล" title="จังหวัดสตูล" target="_blank">สตูล</a>, 
<a href="/สุราษฎร์ธานี" title="จังหวัดสุราษฎร์ธานี" target="_blank">สุราษฎร์ธานี</a>
</li>
</ol>

</div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>