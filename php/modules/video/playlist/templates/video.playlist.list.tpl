<div style="padding:5px; text-align:right"><a href="/post" class="btn btn-info"><i class="icon-plus icon-white"></i> เพิ่มคลิปวิดีโอใหม่</a> <a href="/manage" class="btn"><i class="icon-folder-open"></i> จัดการคลิปวิดีโอ</a></div>


<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
<span class="divider">&raquo;</span>

<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>
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
</ul> 

<ul class="video">
<?php for($i=0;$i<count($this->video);$i++):?>
<?php $l='/'.$this->video[$i]['_id'].'-'.$this->video[$i]['l'].'.html';?>
<li>
<a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video[$i]['f']?>/<?php echo $this->video[$i]['n']?>"><span><?php echo video_duration($this->video[$i]['dr'])?></span></a>
<p><a href="<?php echo $l?>"><?php echo $this->video[$i]['t']?></a></p>
</li>
<?php endfor?>
</ul>