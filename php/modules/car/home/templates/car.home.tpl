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
<div class="layer-1">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span6">
					<h3>lll รถใหม่ป้ายแดง</h3>
				</div>
				<div class="span6 visible-desktop">
					<div class="feed-bar">
						<div class="pull-right">
						บริการข้อมูลราคารถใหม่: 
						<a href="http://feed.boxza.com/news-12/rss" title="บริการข้อมูลราคารถใหม่ โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลราคารถใหม่ โดย RSS Feed"></a>
						<a href="http://feed.boxza.com/news-12/json" title="บริการข้อมูลราคารถใหม่ โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลราคารถใหม่ โดย JSON"></a>
						<a href="http://feed.boxza.com/news-12/json/change_callback_function_here" title="บริการข้อมูลราคารถใหม่ โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลราคารถใหม่ โดย JSONP"></a>
						</div>
					</div>		
				</div>
			</div>

			<div class="wrap-hilight">
				<div class="clear" style="border-top: 7px solid #58595B;"></div>

				<div class="row-fluid visible-phone">
					<div class="span12">
						<h3><i class="icon i-new"></i> รถใหม่ มาแรง ปี 2014</h3>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span4">

						<?php for($i=0;$i<min(1,count($this->news_hilight));$i++): $v=$this->news_hilight[$i];?>
						<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
						<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
						<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
						</a>
						<?php endfor?>

					</div>
					<div class="span8">

						<div class="row-fluid hidden-phone">
							<div class="span12">
								<h3><i class="icon i-new"></i> รถใหม่ มาแรง ปี 2014</h3>
							</div>
						</div>

						<ul class="row-fluid">

						<?php for($i=min(1,count($this->news_hilight));$i<min(5,count($this->news_hilight));$i++): $v=$this->news_hilight[$i];?>
						<li class="span3">
						<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
						<i class="icon i-hot"></i>
						<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
						<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
						</a>
						</li>
						<?php endfor?>

						</ul>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span8 col-content">

		<?php require(HANDLERS.'boxza/ads.news.php');?>

		<ul class="row-fluid ul-ctn-hl hidden-phone">
		<?php for($i=min(5,count($this->news_hilight));$i<min(9,count($this->news_hilight));$i++): $v=$this->news_hilight[$i];?>
		<li class="span3">
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<i class="icon i-hot"></i>
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</li>
		<?php endfor?>
		</ul>

		<ul class="row-fluid ul-ctn-hl-t row-count-2">
			<?php for($i=min(9,count($this->news_hilight));$i<min(19,count($this->news_hilight));$i++): $v=$this->news_hilight[$i];?>
			<li class="span6"><a href="<?php echo link::news($v)?>" target="_blank"><p><span>lll</span> <?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p></a></li>
			<?php endfor?>
		</ul>

		<!-- BEGIN - BANNER : D -->
		<?php if($this->_banner['d']):?>
		<div style="overflow:hidden; margin:5px 0px 0px; text-align:center">
		<ul class="_banner _banner-once">
		<?php foreach($this->_banner['d'] as $_bn):?>
		<li><?php echo $_bn?></li>
		<?php endforeach?>
		</ul>
		</div>
		<?php endif?>
		<!-- END - BANNER : D -->

		<?php require(HANDLERS.'boxza/ads.forum.php');?>

		<div class="wrap-promotions">
		<h3 class="promotion"><i class="icon i-sale"></i>โปรโมชั่นรถใหม่ล่าสุด</h3>
		<ul class="row-fluid promotions row-count-2">
			<?php for($i=0;$i<count($this->news_promotions);$i++): $v=$this->news_promotions[$i];?>
			<li class="span6">
			<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
			<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
			<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
			</a>
			</li>
			<?php endfor?>
		</ul>
		</div>

		<h3 class="maintenance"><i class="icon i-maintenance"></i>การบำรุงรักษา เรื่องน่ารู้เกี่ยวกับรถยนต์</h3>
		<ul class="row-fluid maintenance-f row-count-2">
			<?php for($i=0;$i<count($this->news_maintenance);$i++): $v=$this->news_maintenance[$i];?>
			<li class="span6">
			<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
			<div>
			<?php if(in_array($i, array(0,1))):?>
			<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
			<?php endif?>
			<p><?php if(!in_array($i, array(0,1))):?><i class="icon i-maintenance-li-bullet"></i><?php endif?><span><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></span></p>
			</div>
			</a>
			</li>
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

		<h3 class="services"><i class="icon i-services"></i>ศูนย์บริการ โชว์รูมรถยนต์ทุกยี่ห้อ</h3>

		<ul class="row-fluid services row-count-4">

		<?php for($i=0;$i<count($this->news_services);$i++): $v=$this->news_services[$i];?>
		<li class="span3">
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</li>
		<?php endfor?>

		</ul>

		<!-- <div class="bcd row-fluid">
		<ul class="thumbnails row-count-4">
		<?php for($i=0;$i<min(20,count($this->news));$i++): $v=$this->news[$i];?>
		<li class="span3">
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</li>
		<?php endfor?>
		</ul>
		</div>

		<div class="bcd row-fluid">
		<ul class="thumbnails row-count-4">
		<?php for($i=min(20,count($this->news));$i<min(40,count($this->news));$i++):$v=$this->news[$i];?>
		<li class="span3">
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</li>
		<?php endfor?>
		</ul>
		</div>

		<div class="bcd row-fluid">
		<ul class="thumbnails row-count-4">
		<?php for($i=min(40,count($this->news));$i<count($this->news);$i++):$v=$this->news[$i];?>
		<li class="span3">
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</li>
		<?php endfor?>
		</ul>
		</div> -->

	</div>

	<aside class="span4 col-side">
	    <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>

<!--nipa-->

	    <h3 class="brand-new-hit-car">ยี่ห้อรถใหม่ยอดนิยม</h3>

	    <ul class="row-fluid ul-brand-new-hit-car row-count-4">
	    	<li class="span3"><a href="http://www.autocar.in.th/honda"><img src="http://s3.boxza.com/racing/brand/honda.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/toyota"><img src="http://s3.boxza.com/racing/brand/toyota.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/mitsubishi"><img src="http://s3.boxza.com/racing/brand/mitsubishi.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/mazda"><img src="http://s3.boxza.com/racing/brand/mazda.png"></a></li>

	    	<li class="span3"><a href="http://www.autocar.in.th/nissan"><img src="http://s3.boxza.com/racing/brand/nissan.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/isuzu"><img src="http://s3.boxza.com/racing/brand/isuzu.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/chevrolet"><img src="http://s3.boxza.com/racing/brand/chevrolet.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/suzuki"><img src="http://s3.boxza.com/racing/brand/suzuki.png"></a></li>

	    	<li class="span3"><a href="http://www.autocar.in.th/ford"><img src="http://s3.boxza.com/racing/brand/ford.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/bmw"><img src="http://s3.boxza.com/racing/brand/bmw.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/mercedes-benz"><img src="http://s3.boxza.com/racing/brand/mercedes-benz.png"></a></li>
	    	<li class="span3"><a href="http://www.autocar.in.th/hyundai"><img src="http://s3.boxza.com/racing/brand/hyundai.png"></a></li>
	    </ul>

		<img src="http://s0.boxza.com/static/images/car/ex-2.jpg" alt="example 2/3">

	    <h3 class="barnd-new-car-all"><i class="icon i-fire"></i>รถใหม่ยอดนิยมทุกรุ่น ทุกยี่ห้อ</h3>
		<ul class="row-fluid ul-barnd-new-car-all row-count-1">
		<?php for($i=min(19,count($this->news_hilight));$i<min(24,count($this->news_hilight));$i++): $v=$this->news_hilight[$i];?>
		<li class="span12">
		<div>
		<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
		<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
		<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
		</a>
		</div>
		</li>
		<?php endfor?>
		</ul>


	    <ul>
	    	<li></li>
	    </ul>

	    <img src="http://s0.boxza.com/static/images/car/ex-3.jpg" alt="example 3/3">
	    
	    <!-- BEGIN - BANNER : C -->
	    <?php //if($this->_banner['c']):?>
	    <!-- <div style="overflow:hidden; margin:5px 0px; text-align:center">
	        <ul class="_banner _banner-once">
	            <?php// foreach($this->_banner['c'] as $_bn):?>
	            <li><?php echo $_bn?></li>
	            <?php// endforeach?>
	        </ul>
	    </div> -->
	    <?php //endif?>
	    <!-- END - BANNER : C -->
	    
	   <?php //echo $this->service?> 
	</aside>
</div>
