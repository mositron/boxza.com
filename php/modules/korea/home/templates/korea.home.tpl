<div class="news-box-1">
    <div>
    <?php /*
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
        <?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
        */ ?>
        
        <div class="bcd news-list-1">
            <h3><i class="i1"></i> ข่าวบันเทิงเกาหลี <small>อัพเดทข่าวบันเทิง ซุบซิบ ปาปารีซซี่ ดารา นักร้อง</small></h3>
            <div class="row-fluid news-list-0">
            	<div class="span8">
            		<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
            	</div>
                <div class="span4">
                	<ul class="thumbnails">
						<?php for($i=5;$i<8;$i++): $v=$this->news1[$i];?>
                        <li class="news-left">
                            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                                <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                            </a>
                        </li>
                    <?php endfor?>
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <ul class="thumbnails news-border">
                    <?php for($i=0;$i<5;$i++): $v=$this->news1[$i];?>
                    <?php if($i<1):?>
                        <li class="span12">
                            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>">
                                <p><strong><?php echo $v['t']?> <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></strong></p>
                            </a>
                        </li>
                        <?php else:?>
                        <li class="span6 news-left">
                            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                                <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                            </a>
                        </li>
                    <?php endif?>
                    <?php endfor?>
                    </ul>
                </div>
                <div class="span6">
                    <ul class="thumbnails row-count-2">
                    <?php for($i=8;$i<14;$i++): $v=$this->news1[$i];?>
                        <li class="span6">
                            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                                <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                            </a>
                        </li>
                    <?php endfor?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
    	<div class="bcd news-list-2">
            <h3><i class="i1"></i> ข่าวบันเทิงเกาหลีติดกระแสฮิต</h3>
            <ul class="thumbnails row-count-4">
                <?php for($i=14;$i<count($this->news1);$i++): $v=$this->news1[$i];?>
                <li class="span3 news-left">
                    <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                        <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                        <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                    </a>
                </li>
            <?php endfor?>
            </ul>
        </div>
    </div>
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

 <div class="row-fluid news-box-2">
    <div class="bcd span6 news-list-3">
        <h3><i class="i1"></i> ซีรีย์เกาหลีมาใหม่ ซีรีย์เกาหลีแนะนำ</h3>
        <ul class="thumbnails row-count-2">
			<?php for($i=0;$i<2;$i++): $v=$this->news2[$i];?>
            <li class="span6">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endfor?>
        </ul>
        <ul class="thumbnails row-count-3">
			<?php for($i=2;$i<5;$i++): $v=$this->news2[$i];?>
            <li class="span4">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endfor?>
        </ul>
        <ul class="thumbnails row-count-2">
			<?php for($i=5;$i<count($this->news2);$i++): $v=$this->news2[$i];?>
            <li class="span6 news-left">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endfor?>
        </ul>
    </div>
    
    <div class="bcd span6 news-list-4">
        <h3><i class="i1"></i> วีดีโอ คลิป MV เกาหลีมาใหม่ </h3>
        <ul class="thumbnails l1">
			<?php for($i=0;$i<min(3,count($this->news3));$i++): $v=$this->news3[$i];?>
            <?php if($i<1):?>
            <li class="span6">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php else:?>
            <li class="span6 news-left">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endif?>
            <?php endfor?>
        </ul>
        <ul class="thumbnails row-count-2">
			<?php for($i=3;$i<5;$i++): $v=$this->news3[$i];?>
            <li class="span6">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endfor?>
        </ul>
        <ul class="thumbnails row-count-3">
			<?php for($i=5;$i<count($this->news3);$i++): $v=$this->news3[$i];?>
            <li class="span4">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
            <?php endfor?>
        </ul>
    </div>
</div>
    

<div class="bcd news-box-3 row-fluid">
    <h3><i class="i1"></i> รวมอัลบั้มภาพ ดารา/นักร้อง/วงดนตรี เกาหลี</h3>
    <ul class="thumbnails row-count-4">
		<?php for($i=0;$i<count($this->news4);$i++): $v=$this->news4[$i];?>
        <li class="span3 news-left">
            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
            </a>
        </li>
        <?php endfor?>
    </ul>
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

<div class="row-fluid news-box-4">
    <div class="bcd span8 news-list-5">
        <h3><i class="i1"></i> ประวัติ ดารา/นักร้อง/วงดนตรี เกาหลี</h3>
        <ul class="thumbnails row-count-4">
		<?php foreach($this->people as $v):
        $hot=($v['n']?$v['n'].' ('.trim($v['nn'].' '.$v['fn'].' '.$v['ln']).')':trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
        $hname=($v['n']?$v['n']:trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
        ?>
            <li class="span3">
                <a href="http://people.boxza.com/<?php echo $v['lk']?>" title="ประวัติ <?php echo $hot?>" target="_blank" class="thumbnail text-center i1">
                    <img src="http://s3.boxza.com/people/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $hot?>">
                    <p><?php echo $hname?></p>
                </a>
            </li>
        <?php endforeach?>
        </ul>
    </div>
    
    <div class="bcd span4 news-list-6">
        <h3><i class="i1"></i> เนื้อเพลง เพลงเกาหลี</h3>
        <ul class="thumbnails">
			<?php for($i=0;$i<count($this->news5);$i++): $v=$this->news5[$i];?>
            <li>
            <?php if($i<1):?>
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            <?php else:?>
                <a href="<?php echo link::news($v)?>" target="_blank" class="i1">
                    <p class="text-left"><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            <?php endif?>
            </li>
            <?php endfor?>
        </ul>
    </div>
</div>
