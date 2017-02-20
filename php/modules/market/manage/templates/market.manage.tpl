<div class="span8">
<style>
.table .i{width:75px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; width:400px; overflow:hidden; float:left;white-space:nowrap; text-overflow:ellipsis;}
.table .d .p{margin:5px 0px 0px 0px}
.table .d .p i{font-size:14px; font-weight:bold; color:#F90;}
.table .d span{float:right}
.table .d p{clear:both}
.table .a{ width:70px}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบประกาศนี้หรือไม่',click:function(){_.ajax.gourl('/manage','deldeal',i)}});}
function cdig(i){_.ajax.gourl('/manage','digdeal',i)}
//http://www.facebook.com/dialog/pagetab?app_id=<?php echo _::$config['social']['facebook']['appid']?>&next=<?php echo urlencode(URI)?>'

function addtab(){FB.ui({method: 'pagetab'},function(r){if(r!=null&&r.tabs_added!=null){$.each(r.tabs_added,function(p){_.ajax.gourl('/manage','addtab',p);});}});}
</script>
<ul class="breadcrumb">
  <li><a href="/" title="ลงประกาศฟรี"><i class="icon-home"></i> ลงประกาศฟรี</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการประกาศของคุณ</a></li>
</ul>

<div style="padding:5px; border:1px solid #ff0000; margin:0px 5px 10px 5px; color:#dd0000; background:#FFF4F8; margin-bottom:5px; text-align:center;">ห้ามตั้งสินค้าซ้ำ หรือใช้รูปภาพซ้ำ หากตรวจพบจะทำการลบแอคเค้าท์ผู้ตั้งประกาศนั้นทันที (สินค้าทั้งหมดจะโดนลบด้วย)</div>

<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th class="a"></th></tr>
<?php for($i=0;$i<count($this->deal);$i++):?>
<?php $l='/'.$this->deal[$i]['_id'].'-'.$this->deal[$i]['l'].'.html';?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>"><img src="http://s3.boxza.com/deal/<?php echo $this->deal[$i]['fd']?>/s.jpg" width="75" height="50"></a></td>
<!--td class="t"><?php echo $this->type[$this->deal[$i]['ty']]?></td-->
<td class="d">
<strong><a href="<?php echo $l?>"><?php echo $this->deal[$i]['t']?></a></strong>
<span class="p"><?php echo $this->deal[$i]['p']?'<i>'.number_format($this->deal[$i]['p']).'</i> บาท':'ไม่ระบุราคา'?></span>
<p></p>
<div><?php echo $this->acate[$this->deal[$i]['c']]['t']?> &raquo; <?php echo $this->acate[$this->deal[$i]['cs']]['t']?> , <?php echo $this->province[$this->deal[$i]['pr']]['name_th']?>
<span><?php echo time::show($this->deal[$i]['ds'],'datetime',true)?></span>
<p></p>
</div>
</td>
<td class="a">
<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/update/<?php echo $this->deal[$i]['_id']?>"><i class="icon-wrench"></i> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdig(<?php echo $this->deal[$i]['_id']?>)"><i class="icon-arrow-up"></i> ดันประกาศ</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->deal[$i]['_id']?>)"><i class="icon-remove"></i> ลบ</a></li>
  </ul>
</div>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="3" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div class="tbpage"><?php echo $this->pager?></div>
</div>
<div class="span4">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false"></div>
<?php echo $this->service?>
</div>
