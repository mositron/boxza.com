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
.nav-cate{margin:5px 8px;}
.nav-cate li{margin: 0px;width: 24.95%;float: left;border-bottom: 1px dashed #ddd;}
.nav-cate li a{padding:2px 0px 2px 5px;}
.nav-cate p{clear:both; margin:0px;}
</style>
<h3 class="ht"><i></i> <a href="/hit">หมวดเกมทายใจ</a></h3>
<ul class="nav nav-cate">
<?php foreach($this->cate as $k=>$v):?>
<li><a href="/cate-<?php echo $k?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<p></p>
</ul>
<!--div style="padding:10px; border:1px solid #ccc; background:#f8f8f8; border-radius:5px; margin-bottom:5px;">
กิจกรรมสร้าง<a href="http://guess.boxza.com" target="_blank"><strong>เกมทายใจ</strong></a> แจกบ๊อกฟรี<br>
เพียงแค่.. สร้างเกมทายใจโดนๆของคุณเอง เกมไหนมีผู้เล่นเกิน 1,000 ครั้ง/เกม รับฟรีทันที <strong style="font-size:16px; color:#f00">1,000 บ๊อก</strong>..  ที่ <a href="http://guess.boxza.com" target="_blank">เกมทายใจ</a>
</div-->

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<h3 class="ht"><i></i> <a href="/hit">เกมส์ทายใจยอดฮิต</a></h3>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->profile($this->app[$i]['u']);?>
    <li class="span6">
    <a href="/game/<?php echo $this->app[$i]['_id']?>" class="thumbnail" target="_blank">
    <img src="http://s3.boxza.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg">
    <div><?php echo $this->app[$i]['t']?></div>
    <p class="do">เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    <p class="de"><?php echo $this->app[$i]['d']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>
<h3 class="ht"><i></i> <a href="/recent">เกมส์ทายใจมาใหม่</a> <small>(<a href="/recent">ทั้งหมด</a>)</small></h3>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->appn);$i++):$u=$this->user->profile($this->appn[$i]['u'])?>
    <li class="span6">
    <a href="/game/<?php echo $this->appn[$i]['_id']?>" class="thumbnail" target="_blank">
    <img src="http://s3.boxza.com/guess/<?php echo $this->appn[$i]['fd']?>/s.jpg">
    <div><?php echo $this->appn[$i]['t']?></div>
    <p class="do">เล่น: <?php echo number_format(intval($this->appn[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    <p class="de"><?php echo $this->appn[$i]['d']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>