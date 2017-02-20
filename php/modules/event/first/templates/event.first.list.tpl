<div class="navbar">
  <div class="navbar-inner" style="padding-top:3px;">
    <ul class="nav">
      <li><a href="/first"><i class="icon-home"></i> กิจกรรม</a></li>
    	<li class="divider-vertical"></li>
      <li class="active"><a href="/first/list"><i class="icon-list"></i> รูปภาพทั้งหมด</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="/first/apply"><i class="icon-plus-sign"></i> ลงทะเบียนร่วมกิจกรรม</a></li>
  </ul>
  </div>
</div>


<div class="box-view" title="ร่วมสนุกกับกิจกรรม Boxza แค่เปิดกล่องก็สนุก"><a href="/first"></a></div>

<ul class="nav nav-tabs">
  <li><a href="/">หน้าแรก</a></li>
  <li class="active"><a href="/first/list">ผู้เข้าประกวดทั้งหมด</a></li>
</ul>
<ul class="event-photo">
<?php for($i=0;$i<count($this->last);$i++):?>
<li<?php echo $this->last[$i]['pf']?' class="event-photo-top"':''?>>
<div>
<a href="/first/<?php echo $this->last[$i]['_id']?>"><img src="http://s3.boxza.com/event/first/<?php echo $this->last[$i]['fd']?>/<?php echo $this->last[$i]['n']?>.t.<?php echo $this->last[$i]['ty']?>" alt="<?php echo $this->last[$i]['t']?>"></a>
<p><?php echo $this->last[$i]['t']?></p>
</div>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>


<div><?php echo $this->pager?></div>