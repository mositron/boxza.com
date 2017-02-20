<style>
.table .v{width:100px;}
.table .p{width:200px; text-align:right}

</style>
<div style="padding:5px; text-align:right"><a href="/post" class="btn btn-info"><i class="icon-plus icon-white"></i> เพิ่มคลิปวิดีโอใหม่</a> <a href="/manage" class="btn"><i class="icon-folder-open"></i> จัดการคลิปวิดีโอ</a></div>

<ul class="breadcrumb">
<li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
<span class="divider">&raquo;</span>
 
<?php $curl = '/';?>

<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <?php if($this->c1):?>
    <?php echo $this->cate[$this->c1]['n']['t']?>
<?php else:?>
วิดีโอทุกหมวด
<?php endif?>
<b class="caret"></b></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>">วิดีโอทุกหมวด</a></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="<?php echo $curl?>c-<?php echo $k?>"><?php echo $v['n']['t']?></a></li>
   <?php endforeach?>
</ul>
</li>

<?php if($this->c1):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c2?$this->cate[$this->c1]['l'][$this->c2]['n']['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $this->c1?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
   <?php if(is_array($this->cate[$this->c1]['l'])):?>
 <?php foreach($this->cate[$this->c1]['l'] as $j):?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['n']['_id']?>"><?php echo $j['n']['t']?></a></li>
   <?php endforeach?>
   <?php endif?>
  </ul>
 </li>
<?php if(($c2=$this->cate[$this->c1]['l'][$this->c2]) && (count($c2['l']))):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c3?$c2['l'][$this->c3]['n']['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $this->c2?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
 <?php foreach($c2['l'] as $j):?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['n']['_id']?>"><?php echo $j['n']['t']?></a></li>
   <?php endforeach?>
  </ul>
 </li>
 <?php endif?>
 <?php endif?>
 
 <span class="divider">&raquo;</span><li> รายละเอียด</li>
</ul> 
<h3 style="padding:5px; margin:5px 0px"><?php echo $this->playlist['t']?></h3>

<div style="background-color:#f8f8f8; padding:5px; margin-bottom:5px;">

<h5 class="left" style="margin: 5px 0px 0px 10px;">แนะนำโดย <a href="http://boxza.com/<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a></h5>

<?php if(count($this->video)):?>
<p style="float:right">
<a href="/view/<?php echo $this->video[0]['_id']?>?playlist=<?php echo $this->playlist['_id']?>" class="btn btn-info"><i class="icon-facetime-video icon-white"></i> เริ่มเล่นวิดีโอทั้งหมด</a>
</p>
<?php endif?>

<p class="clear"></p>
<div style="line-height:1.6em;"><?php echo nl2br($this->playlist['d'])?></div>
</div>
<table class="table">
<tbody>
<?php for($i=0;$i<count($this->video);$i++):?>
<tr><td class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video[$i]['f']?>/<?php echo $this->video[$i]['n']?>"></td><td>
<h5><?php echo $this->video[$i]['t']?></h5>
<p>ความยาววิดีโอ: <?php echo video_duration($this->video[$i]['dr'])?>, ดู <?php echo number_format(intval($this->video[$i]['do']))?> ครั้ง</p>
</td><td class="p">
<a href="/view/<?php echo $this->video[$i]['_id']?>?playlist=<?php echo $this->playlist['_id']?>" class="btn"><i class="icon-facetime-video"></i> เริ่มเล่นเพลย์ลิสจากวิดีโอนี้</a>
</td></tr>
<?php endfor?>
</tbody>
</table>
 <div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode(_::$meta['image'])?>&description=<?php echo urlencode($this->playlist['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>
    
    
<div style="padding:10px; line-height:1.8em; margin:5px; border:1px solid #f0f0f0;">
<h4 style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://video.boxza.com/playlist/<?php echo $this->playlist['_id']?>" data-num-posts="10" data-width="678"></div>

</div>