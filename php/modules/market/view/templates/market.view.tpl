
<article class="span8 col-content">
<style>
.tb tr td{ border-bottom:1px solid #f0f0f0;}
.tb tr.l1 td{background-color:#f8f8f8;}
.tb td,.tb th{background-color:#fff;}
.tb th{padding:5px; text-align:center;}
.tb .c{text-align:right; width:100px;}

.o{text-align:center}
.o img{box-shadow:5px 5px 0px #eee; margin:5px; padding:5px; border:1px solid #ccc; background-color:#fff;}

.li-relate li{border-bottom:1px solid #f0f0f0; text-align:left; line-height:1.3em; padding:5px;}
.li-relate li a.t{ display:inline-block; height:50px;overflow:hidden; float:left; width:150px; color:#666;}
.li-relate li a img{float:left; margin:0px 5px 0px 0px}
.li-relate li p{clear:both}
.li-own li{ margin:5px; width:215px; float:left;  text-align:left; line-height:1.3em; height:50px; overflow:hidden;}
.li-own li a.t{ display:block; height:50px;overflow:hidden; float:left; width:132px; color:#666;}
.li-own li a img{float:left; margin:0px 5px 0px 0px}
.li-own li p{clear:both}
</style>
 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
<ul class="breadcrumb">
<li><a href="/" title="ลงประกาศฟรี"><i class="icon-home"></i> ลงประกาศฟรี</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $purl?>">ทุกภูมิภาค</a></li>
   <li class="divider"></li>
   <li><a href="/z-1<?php echo $purl?>">กรุงเทพและปริมณฑล</a></li>
   <li><a href="/z-2<?php echo $purl?>">ภาคเหนือ</a></li>
   <li><a href="/z-3<?php echo $purl?>">ภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/z-4<?php echo $purl?>">ภาคตะวันตก</a></li>
   <li><a href="/z-5<?php echo $purl?>">ภาคตะวันออก</a></li>
   <li><a href="/z-6<?php echo $purl?>">ภาคกลาง</a></li>
   <li><a href="/z-7<?php echo $purl?>">ภาคใต้</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
<?php if($this->z):?>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <?php endif?>
 
 <?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <?php if($this->c):?>
	<?php if($this->acate[$this->c]['p']):?>
    <?php echo $this->acate[$this->acate[$this->c]['p']]['t']?>
    <?php $insub=$this->acate[$this->c]['p'];?>
   <?php else:?> 
    <?php echo $this->acate[$this->c]['t']?>
    <?php endif?>
<?php else:?>
สินค้าทุกประเภท
<?php endif?>
<b class="caret"></b></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>">สินค้าทุกประเภท</a></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="<?php echo $curl?>c-<?php echo $k?>"><?php echo $v['n']['t']?></a></li>
   <?php endforeach?>
</ul>
</li>

<?php if($this->c):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $insub?$this->acate[$this->c]['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $insub?$insub:$this->c?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
   <?php if(!$insub)$insub=$this->c;?>
 <?php for($i=0;$i<count($this->cate[$insub]['l']);$i++):?>
 <?php $j=$this->cate[$insub]['l'][$i];?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['_id']?>"><?php echo $j['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
 <span class="divider">&raquo;</span><li> รายละเอียด</li>
</ul> 

<?php require(HANDLERS.'ads/ads.yengo.body3.php');?>

<h3 style="padding:5px; margin:5px 0px"><?php echo $this->deal['t']?></h3>



<table cellpadding="5" cellspacing="1" border="0" align="center" class="tb" width="100%">
<tr><td class="c">หมวดสินค้า:</td><td><a href="/c-<?php echo $this->deal['c']?>"><b><?php echo $this->acate[$this->deal['c']]['t']?></b></a></td><td class="c">หมวดย่อย:</td><td><a href="/c-<?php echo $this->deal['cs']?>"><b><?php echo $this->acate[$this->deal['cs']]['t']?></b></a></td></tr>
<tr><td class="c">ต้องการ:</td><td><b style="color:#F00"><?php echo $this->type[$this->deal['ty']]?></b></td><td class="c">ราคาสินค้า:</td><td><?php if($this->deal['p']):?><b style="color:#F90"><?php echo number_format($this->deal['p'])?></b> บาท<?php else:?> ไม่ระบุ <?php endif?></td></tr>
<?php if($this->deal['b'] || $this->deal['v']):?><tr><td class="c">ยี่ห้อ:</td><td><?php echo $this->deal['b']?></td><td class="c">รุ่น:</td><td><?php echo $this->deal['v']?></td></tr><?php endif?>
<tr><td class="c">สภาพสินค้า:</td><td colspan="3"><?php echo $this->status[$this->deal['st']]?></td></tr>
<tr><td class="c">จังหวัด:</td><td colspan="3"><?php echo $this->province[$this->deal['pr']]['name_th']?></td></tr>
<?php if($this->deal['p1']||$this->deal['p2']||$this->deal['p3']||$this->deal['p4']):?>
<tr><td class="c">วิธีการชำระเงิน:</td><td colspan="3">
<?php if($this->deal['p1']):?> - เงินสด<?php endif?>
<?php if($this->deal['p2']):?> - บัตรเครดิต<?php endif?>
<?php if($this->deal['p3']):?> - ผ่อน<?php endif?>
<?php if($this->deal['p4']):?> - เช็ค/ธนาณัติ<?php endif?>
</td></tr>
<?php endif?>
<?php if($this->deal['s1']||$this->deal['s2']||$this->deal['s3']||$this->deal['s4']):?>
<tr><td class="c">วิธีรับ-ส่ง สินค้า:</td><td colspan="3">
<?php if($this->deal['s1']):?> - นัดเจอตามสะดวก<?php endif?>
<?php if($this->deal['s2']):?> - ทางพัสดุไปรษณีย์<?php endif?>
<?php if($this->deal['s3']):?> - รับสินค้าที่ร้าน<?php endif?>
<?php if($this->deal['s4']):?> - ส่งทางบริษัทขนส่ง<?php endif?>
</td></tr>
<?php endif?>
<tr><td class="c">ชื่อผู้ติดต่อ:</td><td colspan="3"><?php echo $this->deal['ct']?> ( <a href="http://boxza.com/<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a> ) <?php if(_::$my['_id']==$this->deal['u'] || intval(_::$my['am'])>5):?>- <a href="/update/<?php echo $this->deal['_id']?>">แก้ไขประกาศนี้</a>, <a href="javascript:;" onClick="_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบประกาศนี้หรือไม่',click:function(){_.ajax.gourl('/manage/','deldeal',<?php echo $this->deal['_id']?>);}});">ลบประกาศนี้</a><?php endif?></td></tr>

<?php if(_::$meta['google']):?>
<tr><td class="c">โดย:</td><td colspan="3"><a href="https://plus.google.com/<?php echo _::$meta['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo _::$meta['google']['name']?></a> (Google+)</td></tr>
<?php endif?>

<?php if($this->deal['ws']):?><tr><td class="c">เว็บไซต์:</td><td colspan="3"><a href="<?php echo (strpos($this->deal['ws'],'://')>-1)?$this->deal['ws']:'http://'.$this->deal['ws']?>" rel="nofollow"><?php echo $this->deal['ws']?></a></td></tr><?php endif?>
<?php if($this->deal['ph']):?><tr><td class="c">เบอร์โทรศัพท์:</td><td colspan="3"><?php echo $this->deal['ph']?></td></tr><?php endif?>
<?php if($this->deal['em']):?><tr><td class="c">อีเมล์:</td><td colspan="3"><?php echo $this->deal['em']?></td></tr><?php endif?>
</table>
<div style="padding:5px; margin:5px 5px 0px">ประกาศเมื่อ <?php echo time::show($this->deal['da'],'datetime')?> (อัพเดทล่าสุด: <?php echo time::show($this->deal['ds'],'datetime')?>)</div>
<div class="alert" style="margin:5px;">อย่าลืมบอกว่าพบเห็นประกาศนี้จาก <strong>market.boxza.com</strong>  นะคะ</div>

 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/deal/'.$this->deal['fd'].'/'.$this->deal['o1'])?>&description=<?php echo urlencode($this->deal['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>
    
    
<div style="padding:10px; line-height:1.8em; margin:5px; border:1px solid #f0f0f0;">
<h4>รายละเอียดเพิ่มเติม</h4>
<div style="line-height:1.6em;"><?php echo nl2br($this->deal['d'])?></div>

<div class="o">
<?php for($i=1;$i<=5;$i++):?>
<?php if($this->deal['o'.$i]):?>
<img src="http://s3.boxza.com/deal/<?php echo $this->deal['fd'].'/'.$this->deal['o'.$i]?>">
<?php endif?>
<?php endfor?>
</div>

 <!-- BEGIN - BANNER : F -->
<?php if($this->_banner['f']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['f'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : F -->

<?php if($this->deal['cm']):?>
<h4 style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://market.boxza.com/<?php echo $this->deal['_id']?>" data-num-posts="10" data-width="678"></div>
<?php endif?>

<?php if($this->own):?>
<h4 class="cp">ประกาศอื่นๆของ <?php echo $this->user['name']?><p></p></h4>
<ul class="li-own">
<?php for($i=0;$i<count($this->own);$i++):?>
<li>
<a href="/<?php echo $this->own[$i]['_id'].'-'.$this->own[$i]['l']?>.html"><img src="http://s3.boxza.com/deal/<?php echo $this->own[$i]['fd']?>/s.jpg"></a>
<a href="/<?php echo $this->own[$i]['_id'].'-'.$this->own[$i]['l']?>.html" class="t"><?php echo $this->own[$i]['t']?></a>
<p></p>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<?php endif?>

</div>
</div>
<aside class="span4 col-side">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false"></div>

<ul class="ncate">
<li style="float:none; margin:0px 0px 5px 5px">
<ul>
<?php $i=0;foreach($this->cate as $k=>$v):?>
<li class="l<?php echo $k?>"><a href="/c-<?php echo $k?>"><i></i> <?php echo $v['n']['t']?></a></li>
<?php $i++;endforeach?>
</ul>
</li>
</ul>

<?php if($this->relate):?>
<h4 class="cp">ประกาศอื่นๆที่ใกล้เคียง<p></p></h4>
<ul class="li-relate">
<?php for($i=0;$i<count($this->relate);$i++):?>
<li>
<a href="/<?php echo $this->relate[$i]['_id'].'-'.$this->relate[$i]['l']?>.html"><img src="http://s3.boxza.com/deal/<?php echo $this->relate[$i]['fd']?>/s.jpg"></a>
<a href="/<?php echo $this->relate[$i]['_id'].'-'.$this->relate[$i]['l']?>.html" class="t"><?php echo $this->relate[$i]['t']?></a>
<p></p>
</li>
<?php endfor?>
</ul>
<?php endif?>
</aside>
