<div> 
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
    
    <ul class="breadcrumb">
        <li><a href="/" title="เอเชียนเกมส์ 2014"><i class="icon-home"></i> เอเชียนเกมส์</a></li>
        <span class="divider">&raquo;</span>
        <li><a href="/<?php echo $this->cate[$this->c]['l']?>" title="ข่าว<?php echo $this->cate[$this->c]['t']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
        <span class="divider">&raquo;</span>
        <li> <?php echo $this->news['t']?></li>
    </ul>
    <div>
        <h1 class="news-h1"><a href="<?php echo URL?>"><?php echo $this->news['t']?></a><?php if(_::$my['am']):?><span> ( ดู: <?php echo number_format(intval($this->news['do']))?> ครั้ง, <a href="http://news.boxza.com/admin/<?php echo $this->news['_id']?>">แก้ไข</a> )</span><?php endif?></h1>
        <div class="_share">
                <div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
                <div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
                <div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
            </div>
			<script>$(function(){_.share({title:'<?php echo $this->news['t']?>',url:'<?php echo URI?>',img:'<?php echo _::$meta['image']?>'});});</script>
            
        <div class="news-detail"><?php echo $this->news['sm']?>
		<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
        <?php echo preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$this->news['d']);?>
		<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
        </div>
        <div style="padding:5px">
            <strong>คลิกติดตาม ‘บ๊อกซ่าออนไลน์’ ผ่านช่องทางโซเชียลมีเดีย</strong><br>
            Facebook: <a href="https://www.facebook.com/BoxzaNetwork" target="_blank">https://www.facebook.com/BoxzaNetwork</a><br>
            Google+: <a href="https://plus.google.com/+BoxzaOnline" target="_blank">https://plus.google.com/+BoxzaOnline</a><br>
            Twitter : <a href="https://twitter.com/boxza_new" target="_blank">https://twitter.com/boxza_new</a>
        </div>
         <div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
        <?php if($this->news['tags']):?>
        <ul class="tags-relate">
            <li class="tags-label">ป้ายกำกับ:</li>
            <?php foreach($this->news['tags'] as $v):?>
            <li>#<a href="http://boxza.com/tag/<?php echo urlencode($v)?>" target="_blank"><?php echo $v?></a></li>
            <?php endforeach?>
        </ul>
        <?php endif?>
        <div class="_share bottom">
            <div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
            <div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
            <div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
        </div>
   		<div class="socialshare">
            <div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/BoxzaNetwork" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
            <div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
            <div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo URI?>"></div></div>
            <div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
            <div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-lang="th" data-hashtags="boxza" rel="nofollow">ทวีต</a></div>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <p></p>
        </div>
        
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
        
        <div style="margin:10px 0px 0px; padding:5px; border-top:1px dashed #ddd;">
            <?php if($this->user['google']):?>
            <div style="float:left; width:50px;"> <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
            <div style="margin:0px 0px 0px 55px;"> โดย: <a href="https://plus.google.com/<?php echo $this->user['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo $this->user['google']['name']?></a><br>
                เมื่อ: <?php echo time::show($this->news['ds'],'datetime')?> </div>
            <?php else:?>
            <div style="float:left; width:50px;"> <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
            <div style="margin:0px 0px 0px 55px;"> เขียนโดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
                เมื่อ: <?php echo time::show($this->news['ds'],'datetime')?> </div>
            <?php endif?>
            <p class="clear"></p>
        </div>
        <?php if($this->byuser):?>
        <div class="news-byuser">
            <h4>ข่าวอื่นๆของ <?php echo $this->user['name']?></h4>
            <ul class="row row-fluid">
                <?php for($i=0;$i<count($this->byuser);$i++):?>
                <li class="span5<?php echo $i%2==1?' offset1':''?>"><a href="<?php echo link::news($this->byuser[$i])?>" target="_blank"><?php echo $this->byuser[$i]['t']?></a></li>
                <?php endfor?>
                <p class="clear"></p>
            </ul>
        </div>
        <?php endif?>
        <div class="bcd row-fluid">
            <h3 style="background: #f8f8f8;padding: 5px 5px 5px 10px;font-size: 13px;"><i class="l<?php echo $this->c?>"></i> ข่าวที่ใกล้เคียง</h3>
            <ul class="thumbnails">
                <?php for($i=0;$i<count($this->relate);$i++):?>
                <li class="span2"> <a href="<?php echo link::news($this->relate[$i])?>" target="_blank" class="thumbnail"> <img src="http://s3.boxza.com/news/<?php echo $this->relate[$i]['fd']?>/s.jpg" alt="<?php echo $this->relate[$i]['t']?>" class="i">
                    <p><?php echo $this->relate[$i]['t']?></p>
                    </a> </li>
                <?php endfor?>
                <p class="clear"></p>
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
        
        <h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f9f9f9;">แสดงความคิดเห็นด้วย Facebook</h4>
        <div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="10" data-width="628"></div>
    </div>
</div>