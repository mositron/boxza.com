<script>
function cdel(i){_.box.confirm({title:'ลบคลิปวิดีโอ',detail:'คุณต้องการลบวิดีโอนี้หรือไม่',click:function(){_.ajax.gourl('/manage','delvideo',i)}});}</script>
<ul class="breadcrumb">
  <li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage/playlist">จัดการคลิปวิดีโอ</a></li>
</ul>

<ul class="video">
<?php for($i=0;$i<count($this->video);$i++):?>
<?php $l='/'.$this->video[$i]['_id'].'-'.$this->video[$i]['l'].'.html';?>
<li>
<a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video[$i]['f']?>/<?php echo $this->video[$i]['n']?>"><span><?php echo video_duration($this->video[$i]['dr'])?></span></a>
<p><a href="<?php echo $l?>"><?php echo $this->video[$i]['t']?></a></p>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/update/<?php echo $this->video[$i]['_id']?>"><i class="icon-wrench"></i> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->video[$i]['_id']?>)"><i class="icon-remove"></i> ลบ</a></li>
  </ul>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>


<?php if(!$this->count):?>
<div style="padding:50px; text-align:center; font-size:18px; border:1px solid #eee; background-color:#f9f9f9;">
ไม่มีข้อมูล
</div>
<?php endif?>

<div class="tbpage"><?php echo $this->pager?></div>
