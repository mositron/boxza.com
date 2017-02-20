
<style>
.pf { min-height:100px !important}

.pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}

.pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
.pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}


</style>
<div style="position:relative; padding:10px;">

<table width="100%" cellpadding="5" cellspacing="0" border="0">
<tr><td class="colum">ชื่อ: </td><td><?php echo _::$profile['name']?></td></tr>
<?php if(!empty(_::$profile['if']['lk'])&&!is_numeric(_::$profile['if']['lk'])):?>
<td class="colum">ชื่ออ้างอิง: </td><td><a href="/<?php echo _::$profile['if']['lk']?>">@<?php echo _::$profile['if']['lk']?></a></td></tr>
<?php elseif(_::$my&&(_::$my['_id']==_::$profile['_id'])):?>
<td class="colum">ชื่ออ้างอิง: </td><td>-ยังไม่ได้กำหนด-</td></tr>
<?php endif?>
<tr><td class="colum">คะแนนโหวต: </td><td><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?> / <?php echo number_format(intval(_::$profile['pf']['vt']['a']))?></td></tr>
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
</table>
<div style="position: absolute;top: 2px;right: 2px;text-align: center;border: 1px solid #DDD;padding: 5px;border-radius: 5px; background-color:#fff;">
<p>คะแนนโหวต</p>
<span id="vresult" class="vresulf-<?php echo mb_strlen(intval(_::$profile['pf']['vt']['m']),'utf-8')?>"><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?></span>
<p><span class="v-plus show-tooltip-s" onClick="_.ajax.gourl('/<?php echo _::$profile['link']?>','vote','+')" title="โหวตเพิ่มคะแนน"><i></i></span><span class="v-minus show-tooltip-s" onClick="_.ajax.gourl('/<?php echo _::$profile['link']?>','vote','-')" title="โหวตลบคะแนน"><i></i></span></p>
</div>
</div>

