<style>
.db-out{padding:0px 0px 5px 0px; border:1px solid #f0f0f0; margin:5px 10px 5px 5px; box-shadow:5px 5px 0px #f8f8f8}
.db-out h3{ margin:5px 5px 0px 5px; padding:5px; background:#0099D2; color:#fff;}
.db-out h3 a{color:#fff;}
.db-box{width:216px; float:left; margin:5px 0px 0px 5px;}
.db-box h4{padding:5px; background:#f0f0f0; color:#999;}
.db-box h4 small{font-size:12px; font-weight:normal}
.db-box ul li{border-top:1px dashed #f0f0f0; padding:2px 0px 2px 5px; list-style:inside circle;}
.db-box ul li.n{padding:20px 0px; text-align:center; border:1px solid #f6f6f6; list-style:none}
.db-box ul li a{width:190px; overflow:hidden;white-space:nowrap;text-overflow:ellipsis; display:inline-block; height:16px;}
</style>
<div class="db-out">
<h3>การใช้งานบริการล่าสุดภายใน BoxZa <small style="font-size:12px; font-weight:normal">(<a href="javascript:;" onClick="$('#dashboard').hide();$('.showdashboard').show();_.ajax.gourl('/<?php echo _::$profile['link']?>','setdashboard','')">ปิดหน้าต่างนี้</a>)</small></h3>
<div class="db-box">
<h4><a href="http://market.boxza.com/manage" target="_blank">ลงประกาศฟรี</a> <small>(<a href="http://market.boxza.com/post" target="_blank">เพิ่ม</a>)</small></h4>
<ul>
<?php for($i=0;$i<count($this->deal);$i++):?>
<li><a href="http://market.boxza.com/<?php echo $this->deal[$i]['_id'].'-'.$this->deal[$i]['l'].'.html'?>" target="_blank"><?php echo $this->deal[$i]['t']?></a></li>
<?php endfor?>
<?php if(!count($this->deal)):?>
<li class="n">ยังไม่มีประกาศของคุณ</li>
<?php endif?>
</ul>
</div>

<div class="db-box">
<h4><a href="http://video.boxza.com/manage" target="_blank">วิดีโอ</a> <small>(<a href="http://video.boxza.com/post" target="_blank">เพิ่ม</a>)</small></h4>
<ul>
<?php for($i=0;$i<count($this->video);$i++):?>
<li><a href="http://video.boxza.com/<?php echo $this->video[$i]['_id'].'-'.$this->video[$i]['l'].'.html'?>" target="_blank"><?php echo $this->video[$i]['t']?></a></li>
<?php endfor?>
<?php if(!count($this->video)):?>
<li class="n">ยังไม่มีวิดีโอของคุณ</li>
<?php endif?>
</ul>
</div>


<div class="db-box">
<h4><a href="http://video.boxza.com/manage/playlist" target="_blank">เพลย์ลิส</a></h4>
<ul>
<?php for($i=0;$i<count($this->playlist);$i++):?>
<li><a href="http://video.boxza.com/playlist/<?php echo $this->playlist[$i]['_id'].'-'.$this->playlist[$i]['l'].'.html'?>" target="_blank"><?php echo $this->playlist[$i]['t']?></a></li>
<?php endfor?>
<?php if(!count($this->playlist)):?>
<li class="n">ยังไม่มีเพลย์ลิสของคุณ</li>
<?php endif?>
</ul>
</div>


<div class="clear"></div>
</div>