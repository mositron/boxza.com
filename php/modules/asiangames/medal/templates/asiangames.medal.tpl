
<ul class="breadcrumb">
    <li><a href="/" title="เอเชียนเกมส์ 2014"><i class="icon-home"></i> เอเชียนเกมส์</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/medal" title="สรุปเหรียญเอเชียนเกมส์">สรุปเหรียญเอเชียนเกมส์</a></li>
    <?php if(_::$my&&_::$my['am']):?>
    <li class="pull-right"><a href="/admin/medal" title="แก้ไขสรุปเหรียญเอเชียนเกมส์">แก้ไข</a></li>
    <?php endif?>
</ul>
<div>
    <h1 class="news-h1"><a href="/medal" title="สรุปเหรียญเอเชียนเกมส์">สรุปเหรียญเอเชียนเกมส์</a><?php if(_::$my['am']):?><span> (<a href="/admin/medal">แก้ไข</a> )</span><?php endif?></h1>
    <?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
    
    <div class="_share">
        <div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
        <div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
        <div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
    </div>
    <script>$(function(){_.share({title:'สรุปเหรียญเอเชียนเกมส์',url:'<?php echo URI?>',img:'<?php echo _::$meta['image']?>'});});</script>
            
    <div class="news-detail"><?php echo $this->medal?></div>
    <?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
    <div style="padding:5px">
        <strong>คลิกติดตาม ‘บ๊อกซ่าออนไลน์’ ผ่านช่องทางโซเชียลมีเดีย</strong><br>
        Facebook: <a href="https://www.facebook.com/BoxzaNetwork" target="_blank">https://www.facebook.com/BoxzaNetwork</a><br>
        Google+: <a href="https://plus.google.com/+BoxzaOnline" target="_blank">https://plus.google.com/+BoxzaOnline</a><br>
        Twitter : <a href="https://twitter.com/boxza_new" target="_blank">https://twitter.com/boxza_new</a>
    </div>
     <div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
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