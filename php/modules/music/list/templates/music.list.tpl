
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


<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="เพลง"><i class="icon-home"></i> เพลง</a></li>
<span class="divider">&raquo;</span>
<li><a href="/list" title="เพลงใหม่ เนื้อเพลงใหม่"><i class="icon-list"></i> เพลงใหม่</a></li>
<?php if($this->q):?>
<span class="divider">&raquo;</span>
<li><a href="/list/q-<?php echo urlencode($this->q)?>" title="ค้นหาเพลงหรือเนื้อเพลง ด้วยคำว่า <?php echo $this->q?>">ค้นหาเพลงหรือเนื้อเพลง ด้วยคำว่า <?php echo $this->q?></a></li>
<?php elseif($this->sn):?>
<span class="divider">&raquo;</span>
<li><a href="/list/sn-<?php echo $this->sn?>" title="เพลง เนื้อเพลง ชื่อเพลงขึ้นต้นด้วย <?php echo $this->sn?>">เพลง เนื้อเพลง ชื่อเพลงขึ้นต้นด้วย <?php echo $this->sn?></a></li>
<?php elseif($this->ar):?>
<span class="divider">&raquo;</span>
<li><a href="/list/ar-<?php echo $this->ar?>" title="เพลง เนื้อเพลง ศิลปินขึ้นต้นด้วย <?php echo $this->ar?>">เพลง เนื้อเพลง ศิลปินขึ้นต้นด้วย <?php echo $this->ar?></a></li>
<?php endif?>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<table class="table table-striped table-hover song" width="100%">
<thead>
<tr>
<th></th>
<th>เพลง <small>เนื้อเพลง</small></th>
<th>อัลบั้ม</th>
<th>ศิลปิน</th>
<th>เพิ่มเมื่อ</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->music);$i++):?>
<tr>
<td class="i"><img src="http://s0.boxza.com/static/images/music/play-<?php echo $this->music[$i]['yt']?'':'n'?>yt.gif" alt=""></td>
<td><a href="/lyric/<?php echo $this->music[$i]['_id']?>" target="_blank" title="เพลง เนื้อเพลง <?php echo $this->music[$i]['sn']?> <?php echo $this->music[$i]['ar']?>"><strong><?php echo $this->music[$i]['sn']?></strong></a></td>
<td class="div"><div><?php echo $this->music[$i]['al']?></div></td>
<td class="div"><div><?php echo $this->music[$i]['ar']?></div></td>
<td class="tm"><?php echo time::show($this->music[$i]['da'],'date')?></td>
</tr>
<?php if($i=20):?>
<tr><td colspan="5"><?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?></td></tr>
<?php endif?>
<?php endfor?>
</tbody>
</table>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div style="text-align:center"><?php echo $this->pager?></div>
