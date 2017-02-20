
<div class="no-box">
<p>ตัวเลขเบอร์มือถือของคุณมีความหมาย อยากรู้เพียงแค่กรอกเบอร์มือถือ</p>
<h3>ดูดวงของคุณจากเบอร์มือถือ</h3>
<div class="l1">ค้นหาเบอร์ <select class="tbox horo-sel" name="n0"><?php for($i=80;$i<=96;$i++):?><option value="0<?php echo $i?>">0<?php echo $i?></option><?php endfor?></select> -
<?php for($i=1;$i<=7;$i++):?><?php if($i==4):?> - <?php endif?><input type="text" class="tbox horo-no" name="n<?php echo $i?>" maxlength="1"> <?php endfor?> <input type="button" class="button" value="ดูผลทำนาย" onClick="horoshow()"></div>
<div class="l2">ผลรวมเบอร์โทรศัพท์ของคุณ <span class="horo-rs">0</span></div>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<?php for($j=1;$j<=6;$j++):?>
<h3 class="hd-c"><a href="/<?php echo $this->cate[$j]['l']?>" title="<?php echo $this->cate[$j]['tt']?>"><?php echo $this->cate[$j]['t']?></a></h3>
<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news[$j]);$i++): $v=$this->news[$j][$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
<?php endfor?>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div class="no-hot">
<h3>ผลรวมตัวเลขเด่น</h3>
<div style="margin:0px 10px">
<ul class="du thumbnails row-count-2">
<?php $i=0;foreach($this->mhit as $v):?>
<li class="n<?php echo (intval($i/2)%2)?> span6">
<i><a href="/phone/<?php echo $v['_id']?>.html"><?php echo $v['_id']?></a></i>
<p><a href="/phone/<?php echo $v['_id']?>.html"><?php echo mb_substr($v['d'],0,170,'utf-8')?>...</a></p>
<span></span>
</li>
<?php $i++;endforeach?>
</ul>
</div>
</div>
