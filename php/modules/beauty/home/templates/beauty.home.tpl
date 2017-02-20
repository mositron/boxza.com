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
<div class="beauty-update news-bottom-line">
	<h3 class="bbar-update"><i class="bbull bbull1"></i> UPDATE <small>อัพเดทเรื่องผู้หญิง แฟชั่น สุขภาพ ความงาม รีวิว</small></h3>
	<div class="row-fluid">
		<div class="span4">
			<ul class="thumbnails news-list news-update-left">
			<?php for($i=0;$i<4;$i++): $v=$this->update[$i];?>
			<?php if($i<1):?>
				<li>
					<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
						<div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
						<p><strong><?php echo $v['t']?> <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></strong></p>
					</a>
				</li>
				<?php else:?>
				<li class="news-left">
					<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
						<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
						<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
					</a>
				</li>
			<?php endif?>
			<?php endfor?>
			</ul>
		</div>
		<div class="span8">
			<div class="row-fluid">
				<div class="span6">
					<h3 class="bbar-issue"><span><i class="bbull bbull2"></i> HOT ISSUE</span></h3>
					<ul class="thumbnails news-list">
					<?php for($i=4;$i<6;$i++): $v=$this->update[$i];?>
						<li class="news-left">
							<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
								<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
								<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
							</a>
						</li>
					<?php endfor?>
					</ul>
				</div>
				<div class="span6">
					<?php require(HANDLERS.'ads/ads.adsense.body.php');?>
				</div>
			</div>
			<div>
				<h3 class="bbar-popular"><i class="bbull bbull3"></i> MOST POPULAR <small>กระแสล่าสุดมาแรง เรื่องฮิตที่ผู้หญิงไม่ควรพลาด</small></h3>
				<ul class="thumbnails news-list">
				<?php for($i=6;$i<10;$i++): $v=$this->update[$i];?>
					<li class="span3">
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
</div>
    
<div class="row-fluid news-bottom-line">
    <div class="span6">
        <h3 class="bbar-review"><a href="/review"><i class="bbull bbull5"></i> REVIEW <small>รีวิว</small></a></h3>
        <ul class="thumbnails news-list news-review">
        <?php for($i=0;$i<3;$i++): $v=$this->review[$i];?>
        <?php if($i<1):?>
            <li class="span6">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
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
        <ul class="thumbnails news-list row-count-2">
        <?php for($i=3;$i<count($this->review);$i++): $v=$this->review[$i];?>
            <li class="span6 news-left">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
        <?php endfor?>
        </ul>
    </div>
    <div class="span6">
        <h3 class="bbar-fashion"><a href="/fashion"><i class="bbull bbull6"></i> FASHION <small>แฟชั่น</small></a></h3>
        <ul class="thumbnails news-list news-fashion row-count-2">
        <?php for($i=0;$i<count($this->fashion);$i++): $v=$this->fashion[$i];?>
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



<div class="news-bottom-line">
    <h3 class="bbar-howto"><a href="/howto"><i class="bbull bbull7"></i> HOW TO <small>สาธิต วิธีทำ</small></a></h3>
    <div class="row-fluid news-howto">
    	<div class="span4">   
    		<ul class="thumbnails news-list">     	
				<?php $v=$this->howto[0];?>
                <li class="span12">
                    <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                        <div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
                        <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                    </a>
                </li>
             </ul>
         </div>
    	<div class="span8">
            <ul class="thumbnails news-list row-count-4">
                <?php for($i=1;$i<9;$i++): $v=$this->howto[$i];?>
                <li class="span3">
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

<div class="row-fluid news-bottom-line">
	<div class="span3">
        <div class="bcd bcd-hot">
            <h3 class="bbar-uknow"><a href="/news"><i class="bbull bbull8"></i> Did U Know?</a></h3>
            <ul class="thumbnails news-list news-uknow">
            <?php for($i=0;$i<count($this->uknow);$i++): $v=$this->uknow[$i];?>
                <li>
                    <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                        <div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
                        <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                    </a>
                </li>
            <?php endfor?>
            </ul>
        </div>
	</div>
    <div class="span6">
        <h3 class="bbar-health"><a href="/healthy"><i class="bbull bbull9"></i> HEALTHY <small>สุขภาพ</small></a></h3>
        <ul class="thumbnails news-list news-review">
        <?php for($i=0;$i<3;$i++): $v=$this->health[$i];?>
        <?php if($i<1):?>
            <li class="span6">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
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
        <ul class="thumbnails news-list row-count-2">
        <?php for($i=3;$i<count($this->health);$i++): $v=$this->health[$i];?>
            <li class="span6 news-left">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
        <?php endfor?>
        </ul>
    </div>
    <div class="span3">
		<h3 class="bbar-wedding"><a href="/wedding"><i class="bbull bbull10"></i> WEDDING</a></h3>
        <ul class="thumbnails news-list news-wedding">
        <?php for($i=0;$i<4;$i++): $v=$this->wedding[$i];?>
        <?php if($i<1):?>
            <li>
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                    <div class="crop"><img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>"></div>
                    <p><strong><?php echo $v['t']?> <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></strong></p>
                </a>
            </li>
            <?php else:?>
            <li class="news-left">
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
                    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
                </a>
            </li>
        <?php endif?>
        <?php endfor?>
        </ul>
 	</div>
</div>
