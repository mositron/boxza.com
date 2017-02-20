<style>
.rcmatch{background:#161616;}
.rcmatch thead tr th{text-align:center; background:#414042; color:#F7941E}
.rcmatch thead tr th.no{width:60px;}
.rcmatch thead tr th.dt{width:100px;}
.rcmatch tbody tr td{text-align:center;background:#161616; border-top:1px solid #58595B;}
.rcmatch tbody tr td.l{text-align:left; width:610px;}
.rcmatch tbody tr.i1 td{background:#0f0f0f;}
.rcmatch td a{color:#808285}
.rcmatch td.r{color:#F7941E}

.box-c {background: #111;margin: 5px;color: #FFF;border-radius: 5px;border: 3px solid #333;}
.box-c h4{padding:6px 10px; background:#BCBEC0; text-shadow:1px 1px 0px #fff; border-top-left-radius:5px; border-top-right-radius:5px;}
.box-c h4 {padding: 6px 10px;background: url(http://s0.boxza.com/static/images/racing/forum-bar.png) 0px 0px repeat-x;text-shadow: 1px 1px 0px #000;border-top-left-radius: 3px;border-top-right-radius: 3px;color: #FFF;}
.box-c div{padding:5px 10px;border-radius:5px;}
.box-c ul{list-style: inside circle;}
.box-c ul li{padding:3px 10px;}

.tbdj td{border-top:1px solid #444; line-height:19px !important;}
</style>


<!--div style="text-align:center; position:relative;windth:980px"><div style="margin:0px 0px 0px -20px"><img src="http://s0.boxza.com/static/images/racing/home-soon.png" alt="เตรียมพบกับเว็บไซต์ BoxZa Racing เต็มรูปแบบ ครบทุกเรื่องราววงการรถแต่ง ไม่ว่าจะเป็นเรื่องรถแต่งสวย แต่งรถ แนะนำอู่โมดิฟายต์ชั้นนำ พริตตี้ สาวสวย อัพเดทข่าวสารมอเตอร์สปอร์ต"></div></div-->


 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; padding:0px 0px 5px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<h3 class="hb"><a href="/forum/c-1000"><i></i> ประกาศจากทีมงาน</a></h3>
<div class="row-fluid announce">
<ul class="thumbnails">
<?php foreach($this->announcement as $val):?>
<li class="span3">
<a href="/forum/topic/<?php echo $val['_id']?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/s.jpg" alt="<?php echo $val['t']?>">
<p><?php echo $val['t']?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>

 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<!--div style="text-align:center; padding:0px 0px 5px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div-->
<?php endif?>
<!-- END - BANNER : D -->


<h3 class="hb"><a href="/forum"><i></i> กระทู้แนะนำ</a></h3>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic_rec as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	$p=$this->user->profile($val['cm']['d'][0]['u']);
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime')?>
     <?php else:?>
     <?php echo time::show($val['da'],'datetime')?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>



<h3 class="hb"><a href="/forum"><i></i> กระทู้ล่าสุด</a></h3>

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
	$p=$this->user->profile($val['cm']['d'][0]['u']);
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime')?>
     <?php else:?>
     <?php echo time::show($val['da'],'datetime')?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>


<!--div class="fb-like-box" data-href="https://www.facebook.com/BoxZaRacing" data-width="245" data-height="258" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-border-color="#fff" data-header="false"></div>
<?php #echo $this->service?>



<div class="schedule">
<h3>การแข่งขันรถยนต์ทางเรียบ (Schedule Circuit Racing)</h3>
<table width="100%" cellpadding="0" cellspacing="5" border="0">
<tr>
<td width="50%" valign="top">
<h4>Thailand Super Series 2013</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1-2</td><td>25-26 พฤษภาคม</td><td>เซปัง อินเตอร์เนชั่นแนล เซอร์กิต (มาเลเซีย)</td></tr>
<tr><td>3-4</td><td>13-14 กรกฎาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>5-6</td><td>5-6 ตุลาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>7-8</td><td>14-15 ธันวาคม</td><td>บางแสน สตรีทเซอร์กิต</td></tr>
</tbody>
</table>
</td><td width="50%" valign="top">
<h4>Pro. Racing Series 2013</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>29-30 มิถุนายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>2</td><td>27-28 กรกฎาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>3</td><td>28-29 กันยายน</td><td>แก่งกระจาน เซอร์กิต จ.เพชรบุรี</td></tr>
<tr><td>4</td><td>26-27 ตุลาคม</td><td>แก่งกระจาน เซอร์กิต จ.เพชรบุรี</td></tr>
</tbody>
</table>
</td></tr>
<tr>
<td width="50%" valign="top">
<h4>Toyota Motorsport 2013</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>15-16 มิถุนายน</td><td>เซปัง อินเตอร์เนชั่นแนล เซอร์กิต (มาเลเซีย)</td></tr>
<tr><td>2</td><td>20-21 กรกฎาคม</td><td>สวนสาธารณะสะพานหิน</td></tr>
<tr><td>3</td><td>31 สิงหาคม–1 กันยายน</td><td>สนามกีฬาเฉลิมพระเกียรติ์ 80 พรรษา จ.นครราชสีมา</td></tr>
<tr><td>4</td><td>19-20 ตุลาคม</td><td>กีฬาสมโภชเชียงใหม่ 700 ปี</td></tr>
<tr><td>5</td><td>9-10 พฤศจิกายน</td><td>ราชมังคลาฯ หัวหมาก</td></tr>
<tr><td>6</td><td>14-15 ธันวาคม</td><td>บางแสน สตรีท เซอร์กิต จ.ชลบุรี</td></tr>
</tbody>
</table>
</td><td width="50%" valign="top">
<h4>Nitto 3K Big Thailand Racing Car 2013</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>8-10 มีนาคม</td><td>โบนันซ่า อินเตอร์เนชั่นแนล สปีด เวย์</td></tr>
<tr><td>2</td><td>3-5 พฤษภาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>3</td><td>5-7 กรกฎาคม</td><td>แก่งกระจาน เซอร์กิต จ.เพชรบุรี</td></tr>
<tr><td>4</td><td>6-8 กันยายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>5</td><td>1-3 พฤศจิกายน</td><td>โบนันซ่า อินเตอร์เนชั่นแนล สปีด เวย์</td></tr>
<tr><td>6</td><td>6-8 ธันวาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
</tbody>
</table>
</td></tr>
<tr><td width="50%" valign="top">
<h4>500 KM Marathon 2013 (500 กม. มาราธอน 2556)</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>20-21 เมษายน</td><td>สนามแก่งกระจาน เซอร์กิต</td></tr>
<tr><td>2</td><td>8-9 มิถุนายน</td><td>สนามแก่งกระจาน เซอร์กิต</td></tr>
<tr><td>3</td><td>23-24 พฤศจิกายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>4</td><td>28-29 ธันวาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
</tbody>
</table>
</td><td width="50%" valign="top">
<h4>OMP challenge 2013 by Vattana</h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr><th class="sc1">สนาม</th><th class="sc2">วันที่</th><th>เซอร์กิต</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>21 เมษายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>2</td><td>16 มิถุนายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>3</td><td>22 กันยายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>4</td><td>17 พฤศจิกายน</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td></tr>
<tr><td>5</td><td>22 ธันวาคม</td><td>พีระ อินเตอร์เนชั่นแนล เซอร์กิต (พัทยา)</td>
</tr>
</tbody>
</table>
</tr>
</table>
</div-->



