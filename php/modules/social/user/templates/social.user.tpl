<style>
<?php if(_::$profile['pf']['bg']['url']):?>
body{background:<?php echo !empty(_::$profile['pf']['bg']['col'])?'#'._::$profile['pf']['bg']['col'].' ':''?>url(http://s1.boxza.com/profile/<?php echo _::$profile['if']['fd'].'/'._::$profile['pf']['bg']['url']?>) <?php echo _::$profile['pf']['bg']['pos']?><?php echo _::$profile['pf']['bg']['fix']?' fixed':' fixed'?> <?php echo _::$profile['pf']['bg']['rep']?> !important;} 
table.tbservice,table.tbservice td{background-color:transparent !important;}
<?php if(_::$profile['pf']['bg']['alp']): $alpha=number_format(_::$profile['pf']['bg']['alp']/100,2);?>
.nav-ln{background-color:rgba(255,255,255,<?php echo $alpha?>) !important;}
.pf{ background-color:rgba(255,255,255,<?php echo $alpha?>) !important;border-color:rgba(0,0,0,0.1) !important;}
table.tbservice {background-color: rgba(255,255,255,<?php echo $alpha?>) !important;}
.line .ln,.ln .cm-r{border-color:rgba(240,240,240,<?php echo $alpha?>) !important;}
.ln .ct-s{border-color:rgba(240,240,240,<?php echo $alpha?>) !important;background-color:rgba(247,247,247,<?php echo $alpha?>) !important;}
.pf-fa{background-color:rgba(255,255,255,<?php echo $alpha?>) !important; border-color:rgba(230,230,230,<?php echo $alpha?>) !important;}
.ch-cap,.ln .dt a,.ln .cm-r{background-color:rgba(245,245,245,<?php echo $alpha?>) !important;}
.ch-list li a{border-color:rgba(248,248,248,<?php echo $alpha?>) !important;}
.ln .cm-c{background-color:rgba(243,248,249,<?php echo $alpha?>) !important; border-color:rgba(233,240,248,<?php echo $alpha?>) !important;}
.line .ln .av a{background-color:rgba(255,255,255,<?php echo $alpha?>) !important;}
.mn-global .fr {background: rgba(240,240,240,<?php echo $alpha?>) !important;}
.mn-global .fr li {border-bottom-color:rgba(200,202,203,<?php echo $alpha?>) !important;border-top-color:rgba(255,255,255,<?php echo $alpha?>) !important;;}
<?php endif?>
<?php endif?>
<?php if(_::$profile['pf']['hd']):?>
._pf-hd{background:url(http://s1.boxza.com/profile/<?php echo _::$profile['if']['fd']?>/<?php echo _::$profile['pf']['hd']?>) center top repeat;}
<?php endif?>
</style>
<div class="_pf-hd">
<?php if(_::$my&&_::$profile['_id']==_::$my['_id']&&_::$my['st']&&_::$my['st']>0):?>
<div class="chg-img" style="right:auto; left:5px;"><span class="button" onClick="_.box.load('/dialog/upload #upload_background');">เปลี่ยนรูปพื้นหลัง</span></div>
<div class="chg-img"><span class="button" onClick="_.box.load('/dialog/upload #upload_header');">เปลี่ยนรูปหน้าปก</span></div>
<?php endif?>


<div class="_pf-bdb"></div>
<div class="_pf-bd">
<div class="_pf-av">
<a href="/<?php echo _::$profile['link']?>" class="h" title="<?php echo _::$profile['name']?>"><img src="<?php echo _::$profile['img-n']?>" class="img-uid-my" alt="<?php echo _::$profile['name']?>"></a>

<?php if(_::$profile['_id']==_::$my['_id']):?>
<div class="chg-img"><span class="button" onClick="_.box.load('/dialog/upload #upload_avatar');">เปลี่ยนรูปโปรไฟล์</span></div>
<?php endif?>
</div>
<h2 class="_pf-na">
<div class="left"><a href="/<?php echo _::$profile['link']?>" class="h" title="<?php echo _::$profile['name']?>"><?php echo _::$profile['name']?></a></div>

<?php 
if(count($this->pf[1])):
?>
<div class="_pf-fd">
<ul><li><?php echo implode(', ',array_values($this->pf[1]))?></li></ul>
</div>
<?php endif?>

<div class="_pf-bt connect-<?php echo _::$profile['_id']?>">
<?php if(_::$my && _::$profile['_id']!=_::$my['_id']):?>
<?php if(in_array(_::$profile['_id'],(array)_::$my['ct']['fl'])):?>
<span class="button blue connect-btn" data-dropdown="#dropdown-profile-<?php echo _::$profile['_id']?>">ติดตามแล้ว <span class="caret"></span></span>
<?php else:?>
<span class="button blue connect-btn" data-dropdown="#dropdown-connect-<?php echo _::$profile['_id']?>">ติดต่อ <?php echo _::$profile['if']['fn']?> <span class="caret"></span></span>
<?php endif?>
<?php endif?>
</div>

<p class="clear"></p>
</h2>
<p class="clear"></p>
</div>
</div>
<div class="<?php echo _::$path[0]!='photos'?'left pf-l ':''?>pf-l-user">
<div>


<?php if(_::$my['am'] && intval(_::$my['am'])>=9):?>
<div style="padding:5px 5px; border:1px solid #FFF5D2; background:#FFFDEA; margin-bottom:5px;">
<h4 align="center">ข้อมูลสำหรับแอดมิน (lv. 9+)</h4>
<div style="padding:2px 5px">
ID: <?php echo _::$profile['_id']?> <?php if(_::$my['_id']==1):?><!--input type="button" class="button" value=" ใช้งานไอดีนี้ " onClick="_.box.confirm({title:'เข้าใช้งาน',detail:'ต้องการเข้าใช้ไอดีสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','hackbywut')}})"--><?php endif?><br>
อีเมล์: <?php echo _::$profile['em']?><br>
ซ่อนโพสจากทั้งหมด: <?php echo _::$profile['if']['ha']?'ใช่':'ไม่ใช่'?><br>
สิทธิ์ของผู้ดูแล: <?php echo intval(_::$profile['am'])?><br>
ยืนยันอีเมล์/เฟสบุ๊ค: <?php if(_::$profile['st']):?>ยืนยันสมัครสมาชิกแล้ว<?php else:?>ยังไม่ยืนยัน - <input type="button" class="button" value=" ยืนยันการสมัครสมาชิกให้บุคคลนี้ " onClick="_.box.confirm({title:'ยืนยันการสมัครสมาชิก',detail:'ต้องการยืนยันการสมัครสมาชิกให้บุคคลนี้หรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','setverify')}})"><?php endif?><br>
บ๊อก/พ้อย: <?php echo intval(_::$profile['cd']['p'])?> บ๊อก<br>
Facebook: <?php if(_::$profile['sc']['fb']['id']):?><a href="https://www.facebook.com/<?php echo _::$profile['sc']['fb']['id']?>" target="_blank"><?php echo _::$profile['sc']['fb']['id']?></a><?php else:?>-<?php endif?><br>
Twitter: <?php if(isset(_::$profile['sc']['tw']['id'])):?><a href="https://twitter.com/<?php echo _::$profile['sc']['tw']['name']?>" target="_blank"><?php echo _::$profile['sc']['tw']['name']?></a><?php else:?>-<?php endif?><br>
สมัครสมาชิกเมื่อ: <?php echo time::show(_::$profile['da'],'datetime')?><br>
ออนไลน์ล่าสุด: <?php echo time::show(_::$profile['du'],'datetime')?><br>
IP: 
<?php $ip=(is_array(_::$profile['ip'])?array_keys(_::$profile['ip']):array(_::$profile['ip']))?>
<?php foreach($ip as $v):?>
<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress=<?php echo $v?>" target="_blank"><?php echo $v?></a><br>
<?php endforeach?>
</div>
<div style="padding:5px; background:#FFF5D2">
<input type="button" class="button" value="เพื่อนแนะนำ" onClick="_.box.confirm({title:'ตั้งเป็นเพื่อนแนะนำ',detail:'คุณต้องการตั้งสมาชิกนี้เป็นเพื่อนแนะนำหรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','setrec')}})">
<input type="button" class="button" value="เพิ่มบ๊อก" onClick="_.box.load('/dialog/point/<?php echo _::$profile['_id']?> #add_point')">
<?php if(intval(_::$my['am'])>=9):?><input type="button" class="button" value=" แบนสมาชิก " onClick="if(confirm('ต้องการแบนสมาชิกนี้หรือไม่'))_.box.confirm({title:'แบนสมาชิก',detail:'คุณต้องการแบนสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','setban')}});"> <?php endif?>
<input type="button" class="button" value="ลบรูปโปรไฟล์" onClick="_.box.confirm({title:'ลบรูปภาพโปรไฟล์',detail:'คุณต้องการลบรูปภาพโปรไฟล์ของสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','resetavatar')}})">
<?php if(intval(_::$my['am'])>=9):?><input type="button" class="button" value="ซ่อนโพสทั้งหมด" onClick="_.box.confirm({title:'ซ่อนโพสทั้งหมดต่อสาธารณะชน',detail:'ต้องการซ่อนโพสทั้งหมดของบุคคลนี้ ไม่ให้สมาชิกคนอื่นที่ไม่ใช่เพื่อนเห็นหรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','sethideall')}});"> <?php endif?>
</div>
</div>
<?php endif?>

<ul class="tabs profile-about" style="margin-bottom:10px;">
<li<?php echo _::$path[0]=='about'?' class="active"':''?>><a href="/<?php echo _::$profile['link']?>" title="เกี่ยวกับ" class="h no-top">เกี่ยวกับ</a></li>
<li<?php echo _::$path[0]=='line'?' class="active"':''?>><a href="/<?php echo _::$profile['link']?>/line" title="ไลน์" class="h no-top">ไลน์</a></li>
<li<?php echo _::$path[0]=='photos'?' class="active"':''?>><a href="/<?php echo _::$profile['link']?>/photos" class="h no-top">รูปภาพ</a></li>
<?php if($this->open['fr']):?>
<!--li<?php echo _::$path[0]=='friends'?' class="active"':''?>><a href="/<?php echo _::$profile['link']?>/friends" class="h no-top">เพื่อน</a></li-->
<?php endif?>
<p class="clear"></p>
</ul>
<?php echo _::$content?>


</div>
</div>
<?php if(_::$path[0]!='photos'):?>
<div class="right pf-r">
<span class="ads-top"></span>
<div class="ads-box">

<?php echo $this->service?>
<div style="padding:5px 5px; margin:5px 0px 5px 0px; background-color:#f9f9f9; text-align:right; color:#999; font-size:11px">&copy; 2014 BoxZa, All Rights Reserved.</div>
</div>
</div>
<div class="clear"></div>
<?php endif?>
<script>
$('._pf-av,._pf-hd').hover(function(){$(this).find('.chg-img').css('display','inline-block');},function(){$(this).find('.chg-img').css('display','none');});
function insert_to_list(e,lid){
	if($(e).find('i').hasClass('yes'))
	{
		_.ajax.gourl('/line','listgroup',{'list':lid,'type':'del','uid':<?php echo _::$profile['_id']?>,'ref':'profile'});
		$(e).find('i').removeClass('yes');
	}
	else
	{
		_.ajax.gourl('/line','listgroup',{'list':lid,'type':'add','uid':<?php echo _::$profile['_id']?>,'ref':'profile'});
		$(e).find('i').addClass('yes');
	}
}
</script>

<?php if(_::$my):?>
<div id="dropdown-profile-<?php echo _::$profile['_id']?>" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
    <li style="padding:3px 3px 3px 10px; font-size:12px; font-weight:bold;">กลุ่มรายการ</li>
    <?php for($i=0;$i<count(_::$my['ct']['gp']);$i++):?>
    <?php if(in_array(_::$profile['_id'],(array)_::$my['ct']['gp'][$i]['u'])):?>
    <li><a href="javascript:;" class="ingroup" onClick="insert_to_list(this,<?php echo $i+1?>);"><i class="yes"></i><?php echo _::$my['ct']['gp'][$i]['n']?></a></li>
    <?php else:?>
    <li><a href="javascript:;" class="ingroup" onClick="insert_to_list(this,<?php echo $i+1?>);"><i></i><?php echo _::$my['ct']['gp'][$i]['n']?></a></li>
    <?php endif?>
    <?php endfor?>
        <li class="dropdown-divider"></li>
        <li><a href="javascript:;" onClick="_.chat.add(<?php echo _::$profile['_id']?>)">ส่งข้อความ</a></li>
        <li class="dropdown-divider"></li>
		<?php if(in_array(_::$profile['_id'],(array)_::$my['ct']['fl'])):?>
		<li><a href="javascript:;" onClick="_.friend.unfollow(<?php echo _::$profile['_id']?>)">ยกเลิกการติดตาม</a></li>
      <?php endif?>
    </ul>
</div>
<?php if(_::$my['_id']&& _::$my['_id']!=_::$profile['_id']):?>
<div id="dropdown-connect-<?php echo _::$profile['_id']?>" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
      <li><a href="javascript:;" onClick="_.friend.follow(<?php echo _::$profile['_id']?>)">เพิ่มการติดตาม</a></li>
      <li class="dropdown-divider"></li>
      <li><a href="javascript:;" onClick="_.box.confirm({'title':'ปิดกั้นการติดต่อ','detail':'คุณต้องการทำการปิดกันบุคคลนี้หรือไม่<br>เมื่อการปิดกั้นเสร็จเรียบร้อย คุณและเขาจะไม่สามารถมองเห็นโพสหรือความคิดเห็นกันได้อีก','click':function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','setblock');}});">ปิดกั้นบุคคลนี้</a></li>
	</ul>
</div>
<?php endif?>
<?php endif?>