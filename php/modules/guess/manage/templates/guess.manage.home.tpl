
<style>
.tab__id{width:80px;}
.tab_view{width:80px;}
</style>

<div>
<ul class="nav nav-tabs">
<li class="active"><a href="/manage/" class="h"> เกมส์ของฉัน</a></li>
<li><a href="/manage/new"><i class="icon-plus"></i> สร้างเกมใหม่</a></li>
<li><a href="http://tech.boxza.com/tips/6011" target="_blank"><i class="icon-question-sign"></i> วิธีสร้างเกมทายใจ</a></li>
</ul>

<div style="padding:5px; margin-bottom:5px;">
<div id="getapp"><?php echo $this->getapp?></div>
</div>
</div>

<script>
function adel(i){_.box.confirm({title:'ลบเกม',detail:'คุณต้องการลบเกมนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delapp',i);}});}
</script>


