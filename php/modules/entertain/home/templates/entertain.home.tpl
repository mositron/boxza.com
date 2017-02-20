<article class="span8 col-content">
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

    <div class="feed-bar">
        <div class="pull-right"> บริการข้อมูลข่าวบันเทิง: <a href="http://feed.boxza.com/news-4/rss" title="บริการข้อมูลข่าวบันเทิงโดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลข่าวบันเทิงโดย RSS Feed"></a> <a href="http://feed.boxza.com/news-4/json" title="บริการข้อมูลข่าวบันเทิงโดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลข่าวบันเทิงโดย JSON"></a> <a href="http://feed.boxza.com/news-4/json/change_callback_function_here" title="บริการข้อมูลข่าวบันเทิงโดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลข่าวบันเทิงโดย JSONP"></a> </div>
    </div>
    <div class="ent-gossip" style="margin-bottom:5px">
        <div class="row-fluid">
            <div class="ent-gossip-left span6">
                <h3><a href="/gossip" target="_blank">ซุบซิบดารา</a></h3>
                <?php $v=$this->news[1][0];?>
                <a href="<?php echo link::news($v)?>" target="_blank"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/m.jpg" alt="<?php echo $v['t']?>" class="i">
                <p><?php echo $v['t']?>
                    <?php if($v['da']->sec>(time()-(3600*12))):?>
                    <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                    <?php endif?>
                </p>
                </a> </div>
            <div class="bcd ent-gossip-right span6">
                <ul class="thumbnails row-count-2">
                    <?php for($i=1;$i<min(5,count($this->news[1]));$i++): $v=$this->news[1][$i];?>
                    <li class="span6"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                        <p><?php echo $v['t']?>
                            <?php if($v['da']->sec>(time()-(3600*12))):?>
                            <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                            <?php endif?>
                        </p>
                        </a> </li>
                    <?php endfor?>
                </ul>
            </div>
        </div>
    </div>
    <?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
    <div class="ent-gossip-bottom">
        <div class="bcd row-fluid">
            <ul class="thumbnails row-count-4">
                <?php for($i=5;$i<count($this->news[1]);$i++): $v=$this->news[1][$i];?>
                <li class="span3"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
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
    
    <div class="ent-line"></div>
    <div class="ent-news">
        <h3><a href="/news" target="_blank"><i></i> ข่าวติดกระแส <small>ข่าวบันเทิง เพลง ละคร ภาพยนต์ ดารา นักแสดง นักร้อง</small></a></h3>
        <div class="bcd row-fluid">
            <ul class="thumbnails row-count-4">
                <?php for($i=0;$i<8;$i++): $v=$this->news[2][$i];?>
                <li class="span3"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
                <?php endfor?>
            </ul>
        </div>
    </div>
    
    <?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
    <div class="ent-news">
        <div class="bcd row-fluid">
            <ul class="thumbnails row-count-4">
                <?php for($i=8;$i<count($this->news[2]);$i++): $v=$this->news[2][$i];?>
                <li class="span3"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
                <?php endfor?>
            </ul>
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
    
    <div class="ent-line"></div>
    <div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
</article>
<aside class="span4 col-content">
    <div class="text-center"><!--nipa--></div>
    <div class="ent-photo">
        <h3><a href="/video" target="_blank"><span>คลิปดารา</span> <br>
            <small>วิดีโอ, คลิป, ภาพหลุด ภาพปาปารัสซี่</small></a></h3>
        <div class="row-fluid bcd">
            <div class="span12">
                <?php $v=$this->news[3][0];?>
                <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
                <p style="text-align:center;margin:2px 0px 0px"><?php echo $v['t']?>
                    <?php if($v['da']->sec>(time()-(3600*12))):?>
                    <img src="http://s0.boxza.com/static/images/global/new/new1.gif" alt="">
                    <?php endif?>
                </p>
                </a> </div>
            <ul class="thumbnails row-count-2">
                <?php for($i=1;$i<count($this->news[3]);$i++): $v=$this->news[3][$i];?>
                <li class="span6"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
                <?php endfor?>
            </ul>
        </div>
        
        <!-- BEGIN - BANNER : C -->
        <?php if($this->_banner['c']):?>
        <div style="overflow:hidden; margin:5px 0px; text-align:center;">
            <ul class="_banner _banner-once">
                <?php foreach($this->_banner['c'] as $_bn):?>
                <li><?php echo $_bn?></li>
                <?php endforeach?>
            </ul>
        </div>
        <?php endif?>
        <!-- END - BANNER : C --> 
        
    </div>
    <div class="col-side"> <?php echo $this->service?> </div>
</aside>
<div class="clear"></div>
<div class="ent-line"></div>
<div class="row-fluid">
    <div class="ent-hollywood span6">
        <h3><a href="/hollywood" target="_blank"><i></i> <span>Hollywood</span> Zone ฮอลลีวู้ด</a></h3>
        <div class="bcd ent-inter row-fluid">
            <?php $v=$this->news[5][0];?>
            <div class="l0"> <a href="<?php echo link::news($v)?>" target="_blank"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
                <p><?php echo $v['t']?>
                    <?php if($v['da']->sec>(time()-(3600*12))):?>
                    <img src="http://s0.boxza.com/static/images/global/new/new1.gif" alt="">
                    <?php endif?>
                </p>
                </a> </div>
            <ul class="thumbnails row-count-3">
                <?php for($i=1;$i<count($this->news[5]);$i++): $v=$this->news[5][$i];?>
                <li class="span4"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
                <?php endfor?>
            </ul>
        </div>
    </div>
    <div class="ent-hollywood span6">
        <h3><a href="/asian" target="_blank"><i></i> <span>Asian</span> Zone ข่าวบันเทิงเอเชีย</a></h3>
        <div class="bcd ent-inter row-fluid">
            <?php $v=$this->news[6][0];?>
            <div class="l0"> <a href="<?php echo link::news($v)?>" target="_blank"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
                <p><?php echo $v['t']?>
                    <?php if($v['da']->sec>(time()-(3600*12))):?>
                    <img src="http://s0.boxza.com/static/images/global/new/new1.gif" alt="">
                    <?php endif?>
                </p>
                </a> </div>
            <ul class="thumbnails row-count-3">
                <?php for($i=1;$i<count($this->news[6]);$i++): $v=$this->news[6][$i];?>
                <li class="span4"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                    <p><?php echo $v['t']?>
                        <?php if($v['da']->sec>(time()-(3600*12))):?>
                        <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                        <?php endif?>
                    </p>
                    </a> </li>
                <?php endfor?>
            </ul>
        </div>
    </div>
</div>    
<div class="ent-line"></div>
<div class="ent-drama">
    <h3><a href="/drama" target="_blank"><i></i> เรื่องย่อละคร <small>ละครช่อง3 ละครช่อง5 ละครช่อง7 ละครช่อง9 ละครช่องThaiPBS</small></a></h3>
    <div class="row-fluid">
        <ul class="thumbnails row-count-4">
            <?php for($i=0;$i<count($this->news[7]);$i++): $v=$this->news[7][$i];?>
            <li class="span3"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
                <p><?php echo $v['t']?>
                    <?php if($v['da']->sec>(time()-(3600*12))):?>
                    <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                    <?php endif?>
                </p>
                </a> </li>
            <?php endfor?>
        </ul>
    </div>
</div>

<div class="ent-line"></div>
<div class="ent-movie row-fluid">
    <div class="ent-movie-left span8">
        <div class="ent-movie-office span4">
            <h3>5 อันดับหนังทำเงิน</h3>
            <ul>
                <?php for($i=0;$i<count($this->news['box']);$i++):?>
                <?php $l='http://movie.boxza.com/'.$this->news['box'][$i]['_id'].'-'.$this->news['box'][$i]['l'].'.html';?>
                <li class="i<?php echo $i%2?>"> <a href="<?php echo $l?>" target="_blank"><i><?php echo $i+1?></i> <strong><?php echo $this->news['box'][$i]['t']?></strong> <?php echo $this->news['box'][$i]['t2']?></a> </li>
                <?php endfor?>
            </ul>
        </div>
        <div class="ent-movie-news span8">
            <h3><a href="/movie" target="_blank"><i></i> Movie Zone ข่าวภาพยนตร์</a></h3>
            <div class="row-fluid">
                <ul class="thumbnails row-count-2">
                    <?php for($i=0;$i<count($this->news['movie']);$i++): $v=$this->news['movie'][$i];?>
                    <li class="span6"> <a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                        <p><?php echo $v['t']?>
                            <?php if($v['da']->sec>(time()-(3600*12))):?>
                            <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt="">
                            <?php endif?>
                        </p>
                        </a> </li>
                    <?php endfor?>
                </ul>
            </div>
        </div>
        <div class="ent-movie-show span12">
            <h3><a href="http://movie.boxza.com/z-now-showing" target="_blank"><i></i> หนังน่าดู หนังกำลังเข้าฉาย</a></h3>
            <div class="row-fluid">
                <ul class="thumbnails row-count-3">
                    <?php for($i=0;$i<count($this->news['show']);$i++):?>
                    <?php $l='http://movie.boxza.com/'.$this->news['show'][$i]['_id'].'-'.$this->news['show'][$i]['l'].'.html';?>
                    <li class="span4"> <a href="<?php echo $l?>" target="_blank" class="thumbnail"><img src="http://s3.boxza.com/movie/<?php echo $this->news['show'][$i]['fd']?>/m.jpg" alt="<?php echo $this->news['show'][$i]['t']?> <?php echo $this->news['show'][$i]['t2']?>"></a>
                        <p class="t"><a href="<?php echo $l?>" target="_blank"><?php echo $this->news['show'][$i]['t']?></a></p>
                        <p class="t2"><?php echo $this->news['show'][$i]['t2']?></p>
                        <p class="tm">เข้าฉาย: <?php echo $this->news['show'][$i]['tm']?time::show($this->news['show'][$i]['tm'],'date'):'เร็วๆนี้'?></p>
                        <div>ประเภท:
                            <?php for($j=0;$j<count($this->news['show'][$i]['c']);$j++):?>
                            <?php echo $j?', ':''?><?php echo $this->mcate[$this->news['show'][$i]['c'][$j]]?>
                            <?php endfor?>
                        </div>
                    </li>
                    <?php endfor?>
                </ul>
            </div>
        </div>
    </div>
    <div class="ent-movie-right span4">
        <h3><a href="http://movie.boxza.com/z-coming-soon" target="_blank"><i></i> หนังโปรแกมหน้า</a></h3>
        <p class="l"></p>
        <div class="row-fluid">
            <ul class="thumbnails">
                <?php for($i=0;$i<count($this->news['soon']);$i++):?>
                <?php $l='http://movie.boxza.com/'.$this->news['soon'][$i]['_id'].'-'.$this->news['soon'][$i]['l'].'.html';?>
                <li class="span12"> <a href="<?php echo $l?>" target="_blank"><img src="http://s3.boxza.com/movie/<?php echo $this->news['soon'][$i]['fd']?>/m.jpg" alt="<?php echo $this->news['soon'][$i]['t']?> <?php echo $this->news['soon'][$i]['t2']?>"></a>
                    <p class="t"><a href="<?php echo $l?>" target="_blank"><?php echo $this->news['soon'][$i]['t']?></a></p>
                    <p class="t2"><?php echo $this->news['soon'][$i]['t2']?></p>
                    <p class="tm">เข้าฉาย: <?php echo $this->news['soon'][$i]['tm']?time::show($this->news['soon'][$i]['tm'],'date'):'เร็วๆนี้'?></p>
                    <div>ประเภท:
                        <?php for($j=0;$j<count($this->news['soon'][$i]['c']);$j++):?>
                        <?php echo $j?', ':''?><?php echo $this->mcate[$this->news['soon'][$i]['c'][$j]]?>
                        <?php endfor?>
                    </div>
                </li>
                <?php endfor?>
            </ul>
        </div>
    </div>
</div>
<div class="ent-line"></div>
<div class="ent-star-photo">
    <h3><a href="/forum/star-photo" target="_blank"><i></i> รูปภาพดารา</a></h3>
    <div class="row-fluid">
        <ul class="forum-list-picpost thumbnails row-count-3">
            <?php $i=0;?>
            <?php foreach($this->topic as $val):?>
            <li class="span4">
                <div class="l"><a href="/forum/topic/<?php echo $val['_id']?>">
                    <?php if($val['s']):?>
                    <img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/t.jpg" alt="<?php echo $val['t']?>">
                    <?php endif?>
                    </a></div>
                <div class="r">
                    <p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p>
                    <p>โดย:
                        <?php $p=$this->user->profile($val['u']);?>
                        <a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p>
                    <p>ชม: <?php echo number_format($val['do'])?></p>
                    <p>ตอบ: <?php echo number_format($val['cm']['c'])?></p>
                    <p>ล่าสุด:
                        <?php if($val['cm']['d']):?>
                        <?php echo time::show($val['cm']['d'][0]['t'],'date',true)?><br />
                        <?php else:?>
                        <?php echo time::show($val['ds'],'date',true)?><br />
                        <?php endif?>
                    </p>
                </div>
            </li>
            <?php $i++;endforeach?>
        </ul>
    </div>
</div>
