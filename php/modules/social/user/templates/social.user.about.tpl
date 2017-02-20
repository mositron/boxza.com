
<style>
.pf { min-height:100px !important}

.pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}

.pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
.pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}


</style>
<div>
<h3 style="margin:5px 10px 0px 10px;color: #0399BE;">เกี่ยวกับ <?php if(_::$my && _::$my['_id']==_::$profile['_id']):?> <span style="font-size:12px; font-weight:normal">(<a href="/settings/profile" class="h">แก้ไข</a>)</span><?php endif?></h3>

<div style="position:relative">

<table width="100%" class="tbservice" cellpadding="5" cellspacing="0" border="0">
<tr><td class="colum">ชื่อ: </td><td><?php echo _::$profile['name']?></td></tr>
<?php if(!empty(_::$profile['if']['lk'])&&!is_numeric(_::$profile['if']['lk'])):?>
<td class="colum">ชื่ออ้างอิง: </td><td><a href="/<?php echo _::$profile['if']['lk']?>">@<?php echo _::$profile['if']['lk']?></a></td></tr>
<?php elseif(_::$my&&(_::$my['_id']==_::$profile['_id'])):?>
<td class="colum">ชื่ออ้างอิง: </td><td>-ยังไม่ได้กำหนด- (<a href="/settings/url" class="h">คลิกที่นี่เพื่อกำหนดชื่ออ้างอิง</a>)</td></tr>
<?php endif?>
<tr><td class="colum">คะแนนโหวต: </td><td><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?> / <?php echo number_format(intval(_::$profile['pf']['vt']['a']))?> (คะแนนประจำเดือนนี้/คะแนนทั้งหมด)</td></tr>
<?php
if($this->pf[0]['gd']):
echo '<tr><td class="colum">เพศ: </td><td><span>'.$this->pf[0]['gd'].'</span></td></tr>';
endif;
if($this->pf[0]['rl']):
echo '<tr><td class="colum">สถานะความสัมพันธ์: </td><td><span>'.$this->pf[0]['rl'].'</span></td></tr>';
endif;
if($this->pf[0]['bd']):
echo '<tr><td class="colum">วันเกิด: </td><td><span>'.$this->pf[0]['bd'].'</span></td></tr>';
endif;
if($this->pf[0]['pr']):
echo '<tr><td class="colum">จังหวัด: </td><td><span>'.$this->pf[0]['pr'].'</span></td></tr>';
endif;
?>
<tr><td class="colum">ของขวัญ: </td><td>
<?php if($this->gift):?>
<div>
<?php $u=_::user();foreach($this->gift as $v):
$p=$u->profile($v['p']);
?>

<img src="http://s1.boxza.com/gift/64/<?php echo $v['gf']?>.png" class="show-tooltip-s" alt="" title="<strong><?php echo $v['n']?><strong><br>มอบโดย <?php echo $p['name']?>">
<?php endforeach?>
</div>
<?php endif?>
<?php if(_::$profile['_id']!=_::$my['_id']):?><input type="button" class="button" value=" ส่งของขวัญให้ <?php echo _::$profile['name']?>" onClick="!_.my?_.box.alert('กรุณาล็อคอิน'):_.box.load('/dialog/gift/<?php echo _::$profile['_id']?> #gift_send')"> <?php endif?>

<div style=" padding:5px; color:#c00"><strong>ของขวัญ</strong> จะหายไปทันทีเมื่อหมดอายุ</div>
</td></tr>
<tr><td colspan="2" align="center" style="background:#f0f0f0; text-align:center; font-weight:bold;">Friends Collection</td></tr>
<?php if(_::$profile['st']>=1):?>
<?php if(_::$profile['pet']): $u=_::user();?>
<?php if(_::$profile['pet']['own']): $own=$u->profile(_::$profile['pet']['own']);?>
<tr><td class="colum">เจ้าของ: </td><td><a href="/<?php echo $own['link']?>" class="h">
<img src="<?php echo $own['img']?>" style="width:24px; vertical-align:middle"> <?php echo $own['name']?></a></td></tr>
<?php endif?>
<?php if(_::$profile['pet']['col']&&count(_::$profile['pet']['col'])>0):?>
<tr><td class="colum">Collection: </td><td>
<?php if(_::$profile['_id']==_::$my['_id']):?>

<?php $j=0;foreach(_::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
<p><a href="/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a> - ค่าตัว <?php echo $co['pet']['price']?> บ๊อก (<a href="javascript:;" onClick="_.box.confirm({title:'ขายคืนให้ BoxZa',detail:'คุณสามารถขายคืนได้ในราคา 30% จากราคาล่าสุดเท่านั้น ต้องการดำเนินการต่อหรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','sellpet',<?php echo $co['_id']?>);}})">ขายคืน</a>)</p>
<?php endif;endforeach;?>

<?php else:?>

<?php $j=0;foreach(_::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
<?php echo $j>0?', ':''?><a href="/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a>
<?php $j++;endif;endforeach;?>

<?php endif?>
</td></tr>


<?php endif?>
<?php endif?>
<tr><td class="colum">ค่าตัว: </td><td><strong><?php echo number_format(max(_::$profile['pet']['price'],10))?></strong> บ๊อก</td></tr>
<?php if(_::$profile['_id']!=_::$my['_id']):?>
<tr><td></td><td><input type="button" class="button blue" value=" ซื้อ <?php echo _::$profile['name']?> " onClick="_.box.confirm({title:'ซื้อเป็น Collection',detail:'คุณต้องการซื้อบุคคลนี้ในราคา <?php echo number_format(max(_::$profile['pet']['price'],10))?> บ๊อกหรือไม่<div style=\'padding:5px;border:1px solid #e0e0e0;margin:5px 0px\'><strong>กติกา</strong><br>- ทุกการซื้อ 1 ครั้ง มูลค่าคนที่ถูกซื้อจะเพิ่มไป 40%<br>- หากมีคนมาซื้อต่อคุณ คุณจะได้กำไร 10% จากราคาที่เคยซื้อไว้<br>- คนที่ถูกซื้อจะได้ประมาณ 7% ของราคาที่ถูกซื้อ<br><br>หากไม่พอใจ สามารถขายคืนเข้า Boxza ได้ บ๊อกคืน 30% ของราคาล่าสุด<br><br>ขอให้สนุกกับ Friend\’s Collection ของ Boxza นะครับ</div>',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','buypet');}})"></td></tr>
<?php endif?>
<?php else:?>
<tr><td class="colum">ค่าตัว: </td><td>- ไม่สามารถตีราคาได้ เรื่องจากบุคคลนี้ยังไม่ยืนยันการสมัครสมาชิก - </td></tr>
<?php endif?>
<tr><td class="colum">แนะนำตัว: </td><td><?php echo !empty(_::$profile['pf']['if'])?nl2br(_::$profile['pf']['if']):'-'?></td></tr>
<tr><td class="colum">เว็บไซต์: </td><td>
<?php 
if(count(_::$profile['pf']['ws'])):
for($i=0;$i<count(_::$profile['pf']['ws']);$i++):
?>
<a href="<?php echo _::$profile['pf']['ws'][$i]?>" rel="nofollow" target="_blank"><?php echo _::$profile['pf']['ws'][$i]?></a><br>
<?php 
endfor;
else:
echo '-';
endif;
?>
</td></tr>
<tr><td class="colum">โปรไฟล์ลิ้งค์: </td><td><a href="http://boxza.com/<?php echo _::$profile['link']?>">http://boxza.com/<?php echo _::$profile['link']?></a></td></tr>
</table>
<div style="position: absolute;top: 2px;right: 2px;text-align: center;border: 1px solid #DDD;padding: 5px;border-radius: 5px; background-color:#fff;">
<p>คะแนนโหวต</p>
<span id="vresult" class="vresulf-<?php echo mb_strlen(intval(_::$profile['pf']['vt']['m']),'utf-8')?>"><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?></span>
<p><span class="v-plus show-tooltip-s" onClick="_.ajax.gourl('/<?php echo _::$profile['link']?>','vote','+')" title="โหวตเพิ่มคะแนน"><i></i></span><span class="v-minus show-tooltip-s" onClick="_.ajax.gourl('/<?php echo _::$profile['link']?>','vote','-')" title="โหวตลบคะแนน"><i></i></span></p>
</div>
</div>

<h3 style="margin:5px 10px 5px 10px;color: #0399BE;">ไลน์ล่าสุด </h3>
<?php if($this->open['ln']):?>
<?php if(_::$my['st']||_::$my['_id']==_::$profile['_id']):?>
<div class="_post">
<div>
<form id="spost" onSubmit="return false">
<input type="hidden" name="profile" value="<?php echo _::$profile['_id']?>">
<div>
<div class="av ps-a" av="<?php echo _::$my['_id']?>"><a href="/<?php echo _::$my['link']?>" class="h" title="<?php echo _::$my['name']?>"><img src="<?php echo _::$my['img']?>" class="img-uid-<?php echo _::$my['_id']?>"></a></div>
<div class="post-wrap"><span class="emo emo-1" data-dropdown="#dropdown-chat-emo"></span><textarea name="msg" id="post-msg" tabindex="" onClick="_.post.expand('')">แบ่งปันเรื่องราวกับ  <?php echo _::$profile['name']?></textarea></div>
<a href="javascript:;" onClick="_.post.expand('pin')" class="ln-icon-exp ln-icon-nav ln-icon-pin show-tooltip-s" title="เพิ่มตำแหน่ง"></a>
<a href="javascript:;" onClick="_.post.expand('link')" class="ln-icon-exp ln-icon-nav ln-icon-link show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"></a>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-exp ln-icon-nav ln-icon-photo show-tooltip-s" title="เพิ่มรูปภาพ"></a>
<?php endif?>
<p class="clear"></p>
</div>
<div class="post-bar">
<input type="button" class="button blue" id="post-bt" value=" โพสต์ " onClick="_.post.send($('#spost')[0]);">

<a href="javascript:;" onClick="_.post.expand('pin')" class="ln-icon-nav ln-icon-pin show-tooltip-s" title="เพิ่มตำแหน่ง"></a>
<a href="javascript:;" onClick="_.post.expand('link')" class="ln-icon-nav ln-icon-link show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"></a>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-nav ln-icon-photo show-tooltip-s" title="เพิ่มรูปภาพ"></a>
<?php endif?>
<div style="float:left">
<span data-dropdown="#dropdown-to" class="button" style="vertical-align:top">ถึง</span>
<div id="lto">
<span class="lto-0"><p></p><input type="hidden" name="to" value="0"> สาธารณะ <i onClick="_.post.delto(this)"></i></span>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="lalink"><div><input type="text" class="tbox" id="addlink" style="width:490px"><input type="button" value=" เพิ่ม " class="button" onClick="_.ajax.gourl('/line','getvar','link',$('#addlink').val())"></div></div>
<div id="llink"></div>
<div id="lloc"></div>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<div id="lphoto"></div>
<?php endif?>
</form>
</div>
</div>

<div id="dropdown-to" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
   <li><div class="find-people-panel"><span><input type="text" name="q"  placeholder="ค้นหาเพื่อน" class="find-people tbox" style="width:100%;" data-friend="2" data-func="insert_to_post"></span></div></li>
   <li class="dropdown-divider"></li>
  <li><a href="javascript:;" onClick="_.post.group(this,'0')">สาธารณะ</a></li>
   <li><a href="javascript:;" onClick="_.post.group(this,'-1')">เฉพาะเพื่อน</a></li>
    </ul>
</div>
<?php else:?>
<div class="_post" style="padding:10px; text-align:center">ไม่สามารถโพสบนไลน์ของ <?php echo _::$profile['name']?> ได้ เนื่องจากคุณยังไม่ยืนยันการสมัครสมาชิก</div>
<?php endif?>
<?php endif?>
<div class="line" id="_line" data-profile="<?php echo _::$profile['_id']?>">
<?php echo $this->line?>
</div>
<p class="clear"></p>
</div>
