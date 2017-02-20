<div class="row-fluid news-box-1">
    <div class="span8">
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
        
        
        <div class="bcd news-list-1">
            <h3><i class="i1"></i> ไฮไลท์ อัพเดทข่าว เอเชียนเกมส์ 2014</h3>
            <div class="row-fluid">
                <div class="span6">
                    <ul class="thumbnails news-border">
                    <?php for($i=0;$i<3;$i++): $v=$this->news[$i];?>
                    <?php if($i<1):?>
                        <li>
                            <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
                                <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
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
                <div class="span6">
                    <ul class="thumbnails row-count-2">
                    <?php for($i=3;$i<9;$i++): $v=$this->news[$i];?>
                        <li class="span6">
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
        <?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
    </div>
    <div class="span4">
    	<div class="bcd news-list-2">
            <h3><i class="i1" title="เกาะติดข่าวเอเชียนเกมส์"></i> เกาะติดข่าวเอเชียนเกมส์</h3>
            <ul class="thumbnails">
                <?php for($i=9;$i<20;$i++): $v=$this->news[$i];?>
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


<div class="bcd news-box-2 row-fluid">
<h3><i class="i1"></i> ข่าวเอเชียนเกมส์ล่าสุด</h3>
<ul class="thumbnails row-count-4">
<?php for($i=20;$i<count($this->news);$i++): $v=$this->news[$i];?>
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

<div class="row-fluid">
    <div class="bcd bcd-hot span6">
    <h3><i class="i1"></i> โปรแกรมการแข่งขันกีฬาเอเชียนเกมส์ 2014 </h3>
    <ul class="thumbnails row-count-3">
    <?php for($i=0;$i<count($this->news_rc);$i++): $v=$this->news_rc[$i];?>
    <li class="span4">
    <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
    </a>
    </li>
    <?php endfor?>
    </ul>
    </div>
    
    <div class="bcd bcd-all span6">
    <h3><i class="i1"></i> คลิปวีดีโอการแข่งขันกีฬาเอเชียนเกมส์ 2014</h3>
    <ul class="thumbnails row-count-3">
    <?php for($i=0;$i<count($this->news_cl);$i++): $v=$this->news_cl[$i];?>
    <li class="span4">
    <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
    <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
    <p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
    </a>
    </li>
    <?php endfor?>
    </ul>
    </div>
</div>
