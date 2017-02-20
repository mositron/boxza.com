<div class="span8 col-content">

<style>
.pl-content{line-height:1.6em;}
.pl-content p{ margin-bottom:0px;}
.n-list{padding:0px; margin:0px;}
.n-list li{height:24px; line-height:24px; white-space:nowrap; border-bottom:1px dashed #ccc; overflow:hidden; color:#777}
.n-list li a{color:#777;}
</style>
<div style="padding:0px 10px;">
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
<h1 style="margin-bottom:5px"><?php echo $this->about['t']?><?php if(_::$my['am']):?> <small style="font-size:12px">(<a href="/admin/<?php echo $this->about['_id']?>">แก้ไข</a>)</small><?php endif?></h1>
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div class="pl-content" style="margin-top:5px">
<?php echo $this->about['d']?>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
 
<div class="socialshare" style="margin-top:10px;">
<div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/BoxzaNetwork" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
<div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
<div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo URI?>"></div><!--g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone--></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-lang="th" data-hashtags="boxza" rel="nofollow">ทวีต</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<p></p>
</div>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<?php if(count($this->news)):?>
<h2 class="about-bar">ข่าว <?php echo $this->about['t']?> ล่าสุด</h2>
<div>

<div class="bcd bcd-hot row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
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
<?php endif?>

<?php if(count($this->forum)):?>
<h2 class="about-bar">กระทู้ <?php echo $this->about['t']?> ล่าสุด</h2>
<div>
<ul class="n-list">
<?php for($i=0;$i<count($this->forum);$i++): $v=$this->forum[$i];?>
<li>
<?php echo time::show($v['da'],'date')?> - <a href="http://forum.boxza.com/topic/<?php echo $v['_id']?>" target="_blank"><?php echo $v['t']?></a>
</li>
<?php endfor?>
</ul>
</div>
<?php endif?>


<?php if(count($this->ref)):?>
<div style="padding:10px;background:#f9f9f9; margin:10px 0px 0px; border-radius:5px;">
<h4 style="margin:0px;">ข้อมูลอ้างอิง</h4>
<?php if($this->ref['people']):?>
<div><strong>บุคคล</strong>: 
<?php foreach($this->ref['people'] as $v):$n=($v['n']?$v['n']:$v['nn'].' '.$v['fn'].' '.$v['ln'])?>
<a href="http://people.boxza.com/<?php echo $v['lk']?>" title="<?php echo $n?>" target="_blank"><?php echo $n?></a> 
<?php endforeach?>
</div>
<?php endif?>
<?php if($this->ref['tags']):?>
<div><strong>ป้ายกำกับ</strong>: 
<?php foreach($this->ref['tags'] as $v):?>
<a href="http://boxza.com/tag/<?php echo $v?>" title="<?php echo $v?>" target="_blank"><?php echo $v?></a> 
<?php endforeach?>
</div>
<?php endif?>
</div>
<?php endif?>



<div style="margin:10px 0px 0px; padding:5px; border-top:1px dashed #ddd;">
<?php if($this->user['google']):?>
<div style="float:left; width:50px;">
<a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a>
</div>
<div style="margin:0px 0px 0px 55px;">
โดย: <a href="https://plus.google.com/<?php echo $this->user['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo $this->user['google']['name']?></a><br>
แก้ไขล่าสุด: <?php echo time::show($this->about['du'],'datetime')?>
</div>
<?php else:?>
<div style="float:left; width:50px;">
<a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a>
</div>
<div style="margin:0px 0px 0px 55px;">
โดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
แก้ไขล่าสุด: <?php echo time::show($this->about['du'],'datetime')?>
</div>
<?php endif?>
<p class="clear"></p>
</div>


<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f9f9f9;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="10" data-width="710"></div>

</div>



</div>
<div class="span4 col-side">
<div class="text-center">
<img src="http://s3.boxza.com/about/<?php echo $this->about['fd']?>/t.jpg" alt="<?php echo $this->about['t']?>">
<h3><?php echo $this->about['t']?></h3>
</div>

    <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
    
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
    
    <?php echo $this->service?> </div>
</div>