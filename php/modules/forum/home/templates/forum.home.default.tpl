<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="<?PHP echo FORUM_URL?>" title="รูป"><i class="icon-list"></i> รูป</a></li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="<?PHP echo FORUM_URL?>setting"><i class="icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul>

<div class="row-fluid">
<div class="span8">
 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; margin:0px 0px 5px;">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลกระทู้: 
<a href="http://feed.boxza.com/forum/rss" title="บริการข้อมูลกระทู้โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกระทู้โดย RSS Feed"></a>
<a href="http://feed.boxza.com/forum/json" title="บริการข้อมูลกระทู้โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกระทู้โดย JSON"></a>
<a href="http://feed.boxza.com/forum/json/change_callback_function_here" title="บริการข้อมูลกระทู้โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกระทู้โดย JSONP"></a>
</div>
</div>
<?php /*
<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
*/
?>
<div class="row-fluid">
<div class="span7 hidden-phone">
<h4 class="forum_cp">อัพเดทกระทู้ล่าสุด</h4>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum2">
<thead>
<tr><th>&nbsp;</th><th>หมวด</th><th>หัวข้อ</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic1 as $val):?>
<?php $url=($this->cate[$val['c']]['s']?'http://'.$this->cate[$val['c']]['s'].'.boxza.com/forum/':'/');?>
<?php $curl=$url.($this->cate[$val['c']]['sl']?$this->cate[$val['c']]['sl']:'c-'.$val['c']);?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="tcate"><p><a href="<?php echo $curl?>" target="_blank"><?php echo $this->cate[$val['c']]['t']?></a></p></td>
	<td class="ttitle ttitle2"><p><a href="<?php echo $url?>topic/<?php echo $val['_id']?>" target="_blank"><?php echo $val['t']?></a></p></td>
	</tr>
<?php $i++;endforeach?>
</tbody>
</table>
</div>
<div class="span5">
<div class="forum_rec"> 
<h4>กระทู้แนะนำ</h4>
<ul>
<?php $i=0;?>
<?php foreach($this->rec as $val):?>
<li><i class="l<?php echo $i%3?>"></i><a href="/topic/<?php echo $val['_id']?>" target="_blank"><?php echo $val['t']?></a></li>
<?php $i++;endforeach?>
</ul>
</div>

 </div>
 </div>
<script>
$('#mylasttab a').hover(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
  $(function () {
    $('#mylasttab a:first').tab('show');
  })
</script>

<!--iframe frameborder="0" width="100%" height="550" class="hidden-phone" src="http://s0.boxza.com/static/chat/?r=1&radio=0"></iframe-->

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


<?php if(count($this->cate)):?>
<?php $_i=0;foreach($this->cate as $k=>$v):?>
<?php if(!isset($v['l']) || !count($v['l'])) continue;?>
<?php if($v['s']) continue;?>
<?php $url=($v['s']?'http://'.$v['s'].'.boxza.com/forum/':'/');?>
<div class="forum-home">
<h3 class="l<?php echo $_i%2?>"><i class="icon-forum-<?php echo $k?>"></i><a href="<?php echo $url.($v['sl']?$v['sl']:'c-'.$k)?>"><?php echo $v['t']?></a> <small><?php echo $v['d']?></small></h3>
<ul class="forum-home-list row-count-2">
<?php $_j=0;foreach($v['l'] as $s):?>
<li class="span6">
<span>
<a href="<?php echo $url.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"><img src="http://s0.boxza.com/static/images/forum/thumb/<?php echo $s?>.png" alt="<?php echo $this->cate[$s]['t']?>"></i></a>
</span>
<div>
<h4><a href="<?php echo $url.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"><?php echo $this->cate[$s]['t']?></a></h4>
<div><?php echo $this->cate[$s]['d']?></div>
<p>กระทู้: <?php echo number_format(intval($this->cate[$s]['tp']))?> | ตอบ: <?php echo number_format(intval($this->cate[$s]['rp']))?> | อ่าน: <?php echo number_format(intval($this->cate[$s]['do']))?></p>
<p><?php if($this->cate[$s]['ls']):?>ล่าสุด: <?php echo time::show($this->cate[$s]['ls']['t'],'datetime',true)?><?php endif?></p>
</div>
<p></p>
</li>
<?php $_j++;endforeach?>
<p class="clear"></p>
</ul>
</div>
<?php $_i++;endforeach?>
<?php endif?>


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

</div>
<div class="span4">
<!--nipa-->

<h3 class="forum_cp" style="margin:0px 0px 5px">Follow US on Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="245" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:245px;overflow:hidden;margin-bottom:5px;"></div>

<?php echo $this->service?>

</div>
</div>