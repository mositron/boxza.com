<style>
.nav-zone > li{ }
.nav-zone li li a{font-size:12px;}
.nav-zone li{ position:relative; min-height:24px;}
.nav-zone li strong{font-size:12px; display:block; text-align:center; padding:3px 0px; margin:0px 0px 5px 0px; background:#f8f8f8;}
.nav-zone li li{list-style: inside circle; margin:0px 0px 0px 6px;}
.nav-zone li .badge{position:absolute; right:5px;}



</style>
<div>
<ul class="ncate thumbnails row-count-4">
<?php $i=0;foreach($this->cate as $k=>$v):?>
<?php echo $i%6==0?'<li class="span3"><ul class="nav">':''?>
<li class="l<?php echo $k?>"><a href="/c-<?php echo $k?>"><i></i> <?php echo $v['n']['t']?></a></li>
<?php echo $i%6==5?'</ul></li>':''?>
<?php $i++;endforeach?>
</ul>
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

<div style="margin:5px 0px 10px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<h3 class="hh"><i></i> ประกาศแนะนำ</h3>
<ul class="item thumbnails row-count-6">
<?php for($i=0;$i<count($this->rec);$i++):?>
<?php $l='/'.$this->rec[$i]['_id'].'-'.$this->rec[$i]['l'].'.html';?>
<li class="span2">
<div>
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/deal/<?php echo $this->rec[$i]['fd']?>/m.jpg" alt="<?php echo $this->rec[$i]['t']?>"></a>
<span><?php echo $this->rec[$i]['p']?'ราคา <i>'.number_format($this->rec[$i]['p']).'</i> บาท':'ไม่ระบุราคา'?></span>
<p><a href="<?php echo $l?>"><?php echo $this->rec[$i]['t']?></a></p>
<i class="ty"><?php echo $this->type[$this->rec[$i]['ty']]?></i> -  <?php echo $this->acate[$this->rec[$i]['c']]['t']?> &raquo; <?php echo $this->acate[$this->rec[$i]['cs']]['t']?> - <?php echo $this->province[$this->rec[$i]['pr']]['name_th']?>
</div>
</li>
<?php endfor?>
</ul>
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

<h3 class="hn"><i></i> อัพเดทประกาศล่าสุด</h3>
<ul class="item thumbnails row-count-6">
<?php for($i=0;$i<count($this->last);$i++):?>
<?php $l='/'.$this->last[$i]['_id'].'-'.$this->last[$i]['l'].'.html';?>
<li class="span2">
<div>
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/deal/<?php echo $this->last[$i]['fd']?>/m.jpg" alt="<?php echo $this->last[$i]['t']?>"></a>
<span><?php echo $this->last[$i]['p']?'ราคา <i>'.number_format($this->last[$i]['p']).'</i> บาท':'ไม่ระบุราคา'?></span>
<p><a href="<?php echo $l?>"><?php echo $this->last[$i]['t']?></a></p>
<i class="ty"><?php echo $this->type[$this->last[$i]['ty']]?></i> -  <?php echo $this->acate[$this->last[$i]['c']]['t']?> &raquo; <?php echo $this->acate[$this->last[$i]['cs']]['t']?> - <?php echo $this->province[$this->last[$i]['pr']]['name_th']?>
</div>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php endfor?>
</ul>
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
<h3 class="hz"><i></i> แบ่งตามภูมิภาค</h3>
<div style="padding:0px 10px 10px;">
<ul class="nav-zone thumbnails row-count-6">
<?php foreach($this->pc as $k=>$n):?>
<li class="span2">
<strong><a href="/z-<?php echo $k?>"title="<?php echo $this->zone[$k]['n']?>"><?php echo $this->zone[$k]['n']?></a></strong>
<ul>
<?php 
foreach($n as $v):?>
<li><a href="/p-<?php echo $v['_id']?>"><?php echo $v['t']?></a><?php if($v['c']):?> <span class="badge"><?php echo number_format($v['c'])?></span><?php endif?></li>
<?php endforeach?>
<li><a href="/z-<?php echo $k?>" title="<?php echo $this->zone[$k]['n']?>ทั้งหมด ">ทั้งหมด</a></li>
</ul>
</li>
<?php endforeach?>
</ul>
</div>

</div>
