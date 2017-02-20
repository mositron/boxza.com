<style>
.forum-home-list li{width: 245px;margin: 5px 0px 0px;}
.forum-list-picpost li{width:350px;}
.forum-list-picpost li .r{width:210px;}
</style>

<div style="background:#fff;margin-top:5px">
<div class="left pf-l">
 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; margin:0px 0px 5px;">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
<h3 class="forum_cp"><a href="/image">รูปภาพ สาวน่ารัก สาวไทยน่ารัก สาวเซ็กส์ซี่ สาวไทยเซ็กส์ซี่ หนุ่มหล่อ เอเชีย อินเตอร์</a></h3>


<ul class="forum-list-picpost">
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<li>
<div class="l"><a href="<?PHP echo FORUM_URL?>topic/<?php echo $val['_id']?>"><?php if($val['s']):?><img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/t.jpg" alt="<?php echo $val['t']?>"><?php endif?></a></div>
<div class="r">
<p><a href="<?PHP echo FORUM_URL?>topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p>
<p>หมวด: <a href="/c-<?php echo $val['c']?>"><?php echo $this->cate[$val['c']]['t']?></a></p>
<p>โดย: <?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p>
<p>ชม: <?php echo number_format($val['do'])?></p>
<p>ตอบ: <?php echo number_format($val['cm']['c'])?></p>
<p>ล่าสุด: 
<?php if($val['cm']['d']):?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'date',true)?><br />
<?php else:?>
	<?php echo time::show($val['ds'],'date',true)?><br />
<?php endif?>
    </p>
</div>
<p class="clear"></p>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>


<div style="padding:5px; text-align:right; background:#f7f7f7; margin:2px 0px">
ดูกระทู้ที่เกี่ยวกับ PicPost ทั้งหมด <a href="/image">คลิกที่นี่</a>
</div>
</div>
<div class="right pf-r">
<div style="padding:5px; border:1px solid #ccc; background:#f9f9f9; text-shadow:1px 1px 0px #fff; line-height:1.8em">
<strong>PicPost</strong> - แบ่งปันรูปภาพ สาวน่ารัก สาวไทยน่ารัก สาวเซ็กส์ซี่ สาวไทยเซ็กส์ซี่ หนุ่มหล่อ เอเชีย อินเตอร์
</div>

<h3 class="forum_cp" style="margin:5px 0px 0px 0px"><i></i> หมวดต่างๆภายใน BoxZa PicPost</h3>

<ul class="forum-home-list">
<?php foreach($this->cate[411]['l'] as $s):?>
<li>
<span>
<a href="<?php echo $url.'c-'.$s?>"><img src="http://s0.boxza.com/static/images/forum/thumb/<?php echo $s?>.png" alt="<?php echo $this->cate[$s]['t']?>"></i></a>
</span>
<div>
<h4><a href="<?php echo $url.'c-'.$s?>"><?php echo $this->cate[$s]['t']?></a></h4>
<div><?php echo $this->cate[$s]['d']?></div>
<p>กระทู้: <?php echo number_format(intval($this->cate[$s]['tp']))?> | ตอบ: <?php echo number_format(intval($this->cate[$s]['rp']))?><br>อ่าน: <?php echo number_format(intval($this->cate[$s]['do']))?></p>
</div>
<p></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>


<h3 class="forum_cp" style="margin:5px 0px"><i></i> Follow US on Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/boxza.picpost" data-width="245" data-height="400" data-show-faces="true" data-border-color="#eee" data-stream="false" data-header="false" style="margin-bottom:5px;"></div>
</div>
<div class="clear"></div>
</div>






