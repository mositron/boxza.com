<style>
.o{text-align:center}
.o img{box-shadow:5px 5px 0px #eee; margin:5px; padding:5px; border:1px solid #ccc; background-color:#fff;}

</style>
<link href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" type="text/css">
<link href="http://s0.boxza.com/static/js/jquery/pirobox/css_pirobox/style_1/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/pirobox/js/pirobox_extended.js"></script>
<script>
$(document).ready(function() {
	$().piroBox_ext({
	piro_speed : 700,
		bg_alpha : 0.5,
		piro_scroll : true // pirobox always positioned at the center of the page
	});
	_.time.ago();
});
</script>
<div style="padding:5px; background:#fff;">

<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="อัลบั้มรูปภาพ"><i class="icon-home"></i> อัลบั้ม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/c-<?php echo $this->album['pt']['ty']?>"><?php echo _::$config['album'][$this->album['pt']['ty']]?></a></li>
	<span class="divider">&raquo;</span> 
   <li><?php echo $this->album['tt']?></li>
</ul>

<?php require(HANDLERS.'ads/ads.yengo.body3.php');?>

<h3 style="padding:5px; margin:5px 0px; text-align:center">อัลบั้ม <?php echo $this->album['tt']?> <small>( โดย <a href="http://boxza.com/<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a> <?php if(_::$my['_id']==$this->user['_id'] || _::$my['am']):?>, <a href="/update/<?php echo $this->album['_id']?>">แก้ไขอัลบั้มนี้</a> <?php endif?> )</small></h3>

<div>
<div style="float:left; width:520px; text-align:center;">

<div align="center"><div style="padding:5px; margin:5px auto; box-shadow:0px 0px 5px #ccc;width:auto; display:inline-block; line-height:0px; text-align:center"><a href="http://s1.boxza.com/line/<?php echo $this->album['pt']['cv']['f']?>/o.<?php echo $this->album['pt']['cv']['e']?>" rel="gallery"  class="pirobox_gall"><img src="http://s1.boxza.com/line/<?php echo $this->album['pt']['cv']['f']?>/m.<?php echo $this->album['pt']['cv']['e']?>"></a></div></div>
 <ul class="e-pt" id="getphotos">
<?php for($i=0;$i<count($this->photo);$i++):?>
<li>
<div>
<div class="i"><a href="http://s1.boxza.com/line/<?php echo $this->photo[$i]['pt']['f']?>/o.<?php echo $this->photo[$i]['pt']['e']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $this->photo[$i]['ms']?>"><img src="http://s1.boxza.com/line/<?php echo $this->photo[$i]['pt']['f']?>/s.<?php echo $this->photo[$i]['pt']['e']?>"></a></div>
</div>
</li>
<?php if($i%2==1):?><p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>  
</div>

<div style="float:right; width:445px; padding:50px 0px 0px; text-align:center;">
<p>ผลโหวต: <strong style="font-size:56px" id="voten"><?php echo number_format(intval($this->album['pt']['vt']))?></strong> คะแนน</p>
<div style="margin:10px 5px; text-align:center"><input type="button" class="btn btn-large btn-warning" style="width:400px" value="   โหวต   " onClick="_.ajax.gourl('<?php echo URL?>','vote')"></div>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s1.boxza.com/line/'.$this->album['pt']['cv']['f'].'/m.'.$this->album['pt']['cv']['e'])?>&description=<?php echo urlencode($this->album['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p class="clear"></p>
</div>

<div>
<table class="table tbservice">
<tr><td class="colum">ชื่ออัลบั้ม: </td><td><?php echo $this->album['tt']?></td></tr>
<tr><td class="colum">ประเภท: </td><td><?php echo _::$config['album'][$this->album['pt']['ty']]?></td></tr>
<tr><td class="colum">อัพโหลดโดย: </td><td><a href="http://boxza.com/<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a></td></tr>
<tr><td class="colum">สร้างเมื่อ: </td><td><?php echo time::show($this->album['da'],'datetime')?></td></tr>
<?php if($this->album['du']):?><tr><td class="colum">แก้ไขล่าสด: </td><td><?php echo time::show($this->album['du'],'datetime')?></td></tr><?php endif?>
<?php if($this->album['ms']):?><tr><td class="colum">อธิบายอัลบั้ม: </td><td><?php echo nl2br($this->album['ms'])?></td></tr><?php endif?>
</table>
</div>
<div style="padding:5px 5px 5px 30px; margin:10px 0px; text-align:left;border:1px solid #e5e5e5; background:#f6f6f6;">
<strong>เงื่อนไขการโหวต</strong><br>
- สามารถโหวตได้ครั้งละ +1 คะแนน<br>
- สามารถโหวตซ้ำได้ชั่วโมงละ 1 ครั้งต่อ 1 ip</div>

<div style="padding:5px; text-align:left; border:1px solid #e5e5e5; background:#fafafa; margin-bottom:10px;">
<h4 style="padding:3px 5px; background:#eee; margin-bottom:5px; text-shadow:1px 1px 0px #fff;">แสดงความคิดเห็น</h4>
<?php if(_::$my):?>
<div>
<img src="<?php echo _::$my['img']?>" style="float:left">
<div style="width:375px; float:right">
<form onSubmit="_.ajax.gourl('<?php echo URL?>','sendcommend',this);$('#ms').val('');return false">
<textarea class="tbox" style="width:370px; height:60px" name="ms" id="ms" placeholder="ข้อความของคุณ" required></textarea>
<input type="submit" value=" บันทึก " class="btn btn-primary"> <input type="reset" value=" ยกเลิก " class="btn">
</form>
</div>
<p class="clear"></p>
</div>
<?php else:?>
<div style="margin:30px 0px; text-align:center">กรุณาล็อคอินก่อนทำการแสดงความคิดเห็น</div>

<?php endif?>
</div>
<div class="ln" id="getcomment"><?php echo $this->comment?></div>


</div>
<p class="clear"></p>
</div>

</div>
