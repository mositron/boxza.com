
<article class="span8 col-content">
<ul class="breadcrumb">
    <li><a href="/" title="สติกเกอร์"><i class="icon-home"></i> สติกเกอร์</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/cate-<?php echo $this->app['c']?>" title="สติกเกอร์<?php echo $this->cate[$this->app['c']]['t']?>"><?php echo $this->cate[$this->app['c']]['t']?></a></li>
    <span class="divider">&raquo;</span>
    <li><?php echo $this->app['t']?></li>
    <?php if(_::$my['_id']==1):?><li class="pull-right"><a href="/manage/<?php echo $this->app['_id']?>">แก้ไข</a></li><?php endif?>
</ul>

<div>
<?php if($this->app['img']):?><img src="http://s3.boxza.com/sticker/cover/<?php echo $this->app['fd']?>/s.png" style="float:left; margin:0px 15px 3px 10px; width:100px; height:100px;"><?php endif?>
<h1><?php echo $this->app['t']?></h1>
</div>

<div align="center" style="margin-top:10px"> 
  <div>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FBoxzaNetwork&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowtransparency="true"></iframe>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B8%2599-%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%2587%25E0%25B9%2580%25E0%25B8%2581%25E0%25B8%2587-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%259C%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B9%2581%25E0%25B8%259F%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2588%25E0%25B8%2599%2F786402811370068&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe>
 	<div style="display:inline-block; width:83px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
	<div style="display:inline-block; width:83px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/101529563615466592393" data-rel="publisher"></div></div>
	</div>
<script type="text/javascript">
  window.___gcfg = {lang: 'th'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

<div style="text-align:center">
<span class='st_sharethis_vcount' displayText='ShareThis'></span>
<span class='st_facebook_vcount' displayText='Facebook'></span>
<span class='st_twitter_vcount' displayText='Tweet'></span>
<span class='st_linkedin_vcount' displayText='LinkedIn'></span>
<span class='st_pinterest_vcount' displayText='Pinterest'></span>
<span class='st_email_vcount' displayText='Email'></span>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>


<ul class="thumbnails row-count-4">
<?php if($this->icon):$i=0;?>
<?php foreach($this->icon as $icon):?>
<li class="span3 text-center">
<div><img src="http://s3.boxza.com/sticker/icon/<?php echo $icon['fd']?>/<?php echo $icon['gif']?$icon['gif']:$icon['png']?>"></div>
</li>
<?php endforeach?>
<?php endif?>
</ul>


<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<div style="padding:10px 0px 0px 5px">
  <h4>ความคิดเห็น</h4>
  <div class="fb-comments" data-href="http://sticker.boxza.com/view/<?php echo $this->app['_id']?>" data-num-posts="3" data-width="620"></div>
</div>



</article>
<aside class="span4 col-side">
  <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
<?php echo $this->service?>
</aside>





