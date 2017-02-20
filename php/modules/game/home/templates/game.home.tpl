<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center"> <ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul> </div>
<?php endif?>
<!-- END - BANNER : B -->

<h3 class="hd-a" style="margin-bottom:5px">ข่าวเกมส์ <small>ข่าวเกม ข่าวเกมส์ ข่าวเกมส์ออนไลน์ ข่าวเกมส์PC ข่าวเกมส์ต่างๆมากมาย</small></h3>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<div>
<h3 class="hd-a">เกมส์ใหม่ <small>เกมใหม่ เกมส์มาใหม่ แนะนำเกมส์ใหม่</small></h3>
  <ul class="gh thumbnails row-count-3">
    <?php foreach($this->new as $k=>$v):?>
    <li class="span4"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
      <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
      <p>เกมส์<?php echo $v['t2']?></p>
    </li>
    <?php endforeach?>
  </ul>
</div>

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

<div>
<h3 class="hd-a">เกมส์แนะนำ <small>เกมแนะนำ เกมส์ยอดฮิต เกมส์น่าเล่น เกมส์สนุกๆ</small></h3>
  <ul class="gh thumbnails row-count-3">
    <?php $i=0;foreach($this->rec as $k=>$v):?>
    <li class="span4"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
      <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
      <p>เกมส์<?php echo $v['t2']?></p>
    </li>
    <?php $i++;endforeach?>
  </ul>
</div>


<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
    
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

<div style="padding-bottom: 5px; margin-top:8px;">
  <ul class="thumbnails row-count-2">
    <li class="bc1 span6">
      <h3 class="ha"><a href="/flash/c-27" title="เกมส์ทําอาหาร"><i class="c27"></i>เกมส์ทําอาหาร</a></h3>
      <ul class="gc thumbnails row-count-2">
        <?php foreach($this->c27 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
    <li class="bc2 span6">
      <h3 class="ha"><a href="/flash/c-95" title="เกมส์แต่งตัว"><i class="c95"></i>เกมส์แต่งตัว</a></h3>
      <ul class="gc thumbnails row-count-2">
        <?php foreach($this->c95 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
    <li class="bc1 span6">
      <h3 class="ha"><a href="/flash/c-5" title="เกมส์จับคู่"><i class="c5"></i>เกมส์จับคู่</a></h3>
      <ul class="gc row-count-2">
        <?php foreach($this->c5 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
    <li class="bc2 span6">
      <h3 class="ha"><a href="/flash/c-20" title="เกมส์ต่อสู้"><i class="c20"></i>เกมส์ต่อสู้</a></h3>
      <ul class="gc thumbnails row-count-2">
        <?php foreach($this->c20 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
    <li class="bc1 span6">
      <h3 class="ha"><a href="/flash/c-37" title="เกมส์ปลูกผัก"><i class="c37"></i>เกมส์ปลูกผัก</a></h3>
      <ul class="gc thumbnails row-count-2">
        <?php foreach($this->c37 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
    <li class="bc2 span6">
      <h3 class="ha"><a href="/flash/c-52" title="เกมส์รถแข่ง"><i class="c52"></i>เกมส์รถแข่ง</a></h3>
      <ul class="gc thumbnails row-count-2">
        <?php foreach($this->c52 as $k=>$v):?>
        <li class="span6"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
          <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
          <p>เกมส์<?php echo $v['t2']?></p>
        </li>
        <?php endforeach?>
      </ul>
    </li>
  </ul>
    <h3 class="ha"><a href="/flash/c-82" title="เกมส์เต้น"><i class="c82"></i>เกมส์เต้น</a></h3>
    <ul class="gc thumbnails row-count-4">
      <?php foreach($this->c82 as $k=>$v):?>
      <li class="span3"> <a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
        <p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
        <p>เกมส์<?php echo $v['t2']?></p>
      </li>
      <?php endforeach?>
    </ul>
</div>
<?php if($this->topic):?>
<h3 class="hb" style="margin:-5px 0px 0px">กระทู้เกมส์ล่าสุด</h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
  <thead>
    <tr>
      <th>&nbsp;</th>
      <th>หัวข้อ</th>
      <th>ผู้ตั้ง</th>
      <th>อ่าน</th>
      <th>ตอบ</th>
      <th>ล่าสุด</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0;?>
    <?php foreach($this->topic as $val):?>
    <tr class="l<?php echo $i%2?>">
      <td class="ticon"><i class="i0"></i></td>
      <td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
      <td class="tpost"><p>
          <?php $p=$this->user->profile($val['u']);?>
          <a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
      <td class="tview"><?php echo number_format($val['do'])?></td>
      <td class="treply"><?php echo number_format($val['cm']['c'])?></td>
      <td class="ttime"><p>
          <?php 
	if($val['cm']['d']):
	?>
          <?php echo time::show($val['cm']['d'][0]['t'],'datetime')?>
          <?php else:?>
          <?php echo time::show($val['ds'],'datetime')?>
          <?php endif?>
        </p></td>
    </tr>
    <?php $i++;endforeach?>
  </tbody>
</table>
<?php endif?>
<div style="margin: 5px 0px 0px 0px;background: #eee;padding: 2px 5px;"><h3>เกมส์ flash <small>เกมส์แฟลช</small></h3></div>
<ul class="nav-cate">
  <?php foreach($this->cate as $k=>$v): if($k>50)break;?>
  <li><a href="/flash/c-<?php echo $k?>" title="เกมส์<?php echo $v['t']?>">เกมส์<?php echo $v['t']?></a></li>
  <?php endforeach?>
  <p class="clear"></p>
</ul>
