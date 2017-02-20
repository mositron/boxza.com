<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px;">
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
บริการข้อมูลกลิตเตอร์: 
<a href="http://feed.boxza.com/poem/rss" title="บริการข้อมูลกลิตเตอร์โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกลิตเตอร์โดย RSS Feed"></a>
<a href="http://feed.boxza.com/poem/json" title="บริการข้อมูลกลิตเตอร์โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกลิตเตอร์โดย JSON"></a>
<a href="http://feed.boxza.com/poem/json/change_callback_function_here" title="บริการข้อมูลกลิตเตอร์โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกลิตเตอร์โดย JSONP"></a>
</div>
</div>

<div class="gl-rec">
<h3>กลิตเตอร์แนะนำ</h3>
<ul>
<?php for($i=0;$i<count($this->rec);$i++):?>
<?php $l='/'.$this->rec[$i]['_id'].'.html';?>
<li>
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/poem/<?php echo $this->rec[$i]['fd']?>/t.<?php echo $this->rec[$i]['ty']?>">
</a>
<p><?php echo $this->rec[$i]['t']?></p>
</li>
<?php if($i%4==3):?><p  class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>
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

<div class="gl-new">
<h3>กลิตเตอร์มาใหม่</h3>
<ul>
<?php for($i=0;$i<count($this->last);$i++):?>
<?php $l='/'.$this->last[$i]['_id'].'.html';?>
<li>
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/poem/<?php echo $this->last[$i]['fd']?>/t.<?php echo $this->last[$i]['ty']?>">
</a>
<p><?php echo $this->last[$i]['t']?></p>
</li>
<?php if($i%4==3):?><p  class="clear"></p><?php endif?>
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