<script>
function cdel(i){_.box.confirm({title:'ลบกลิตเตอร์',detail:'คุณต้องการลบกลิตเตอร์นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delglitter',i)}});}
</script>
<style>
.gl-rec li span{display:block; margin:5px 0px; text-align:center;}
.gl-rec li p.p2{background:#fff;text-indent: 0px;text-align: center;}
</style>
<ul class="breadcrumb">
  <li><a href="/" title="กลิตเตอร์"><i class="icon-home"></i> กลิตเตอร์</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการกลิตเตอร์ของคุณ</a></li>
</ul>
<div class="gl-rec">

<ul>
<?php for($i=0;$i<count($this->glitter);$i++):?>
<?php $l='/'.$this->glitter[$i]['_id'].'.html';?>
<li>
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/glitter/<?php echo $this->glitter[$i]['fd']?>/t.<?php echo $this->glitter[$i]['ty']?>">
</a>
<p><?php echo $this->glitter[$i]['t']?></p>
<p class="p2"><?php echo time::show($this->glitter[$i]['da'],'datetime')?></p>

<span><a href="/update/<?php echo $this->glitter[$i]['_id']?>" class="btn"><i class="icon-wrench"></i> แก้ไข</a> <a href="javascript:;" onClick="cdel(<?php echo $this->glitter[$i]['_id']?>)" class="btn"><i class="icon-remove"></i> ลบ</a></span>
</li>
<?php if($i%4==3):?><p  class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>



<div style="text-align:center"><?php echo $this->pager?></div>
