<script>
function cdel(i){_.box.confirm({title:'ลบกลิตเตอร์',detail:'คุณต้องการลบกลิตเตอร์นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delpoem',i)}});}
</script>
<style>
.gl-rec li span{display:block; margin:5px 0px; text-align:center;}
.gl-rec li p.p2{background:#fff;text-indent: 0px;text-align: center;}
</style>
<ul class="breadcrumb">
  <li><a href="/" title="กลอน"><i class="icon-home"></i> กลอน</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการกลิตเตอร์ของคุณ</a></li>
</ul>
<div class="gl-rec">

<ul>
<?php for($i=0;$i<count($this->poem);$i++):?>
<?php $l='/'.$this->poem[$i]['_id'].'.html';?>
<li>
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/poem/<?php echo $this->poem[$i]['fd']?>/t.<?php echo $this->poem[$i]['ty']?>">
</a>
<p><?php echo $this->poem[$i]['t']?></p>
<p class="p2"><?php echo time::show($this->poem[$i]['da'],'datetime')?></p>

<span><a href="/update/<?php echo $this->poem[$i]['_id']?>" class="btn"><i class="icon-wrench"></i> แก้ไข</a> <a href="javascript:;" onClick="cdel(<?php echo $this->poem[$i]['_id']?>)" class="btn"><i class="icon-remove"></i> ลบ</a></span>
</li>
<?php if($i%4==3):?><p  class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>



<div style="text-align:center"><?php echo $this->pager?></div>
