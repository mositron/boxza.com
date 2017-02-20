<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/boxza.user.css?v=1.4.0">
<script type="text/javascript" src="http://s0.boxza.com/static/js/boxza.user.js?v=1.4.0"></script>
<style>
<?php if(_::$profile['pf']['bg']['url']):?>
body{background:<?php echo !empty(_::$profile['pf']['bg']['col'])?'#'._::$profile['pf']['bg']['col'].' ':''?>url(http://s1.boxza.com/profile/<?php echo _::$profile['if']['fd'].'/'._::$profile['pf']['bg']['url']?>) <?php echo _::$profile['pf']['bg']['pos']?><?php echo _::$profile['pf']['bg']['fix']?' fixed':' fixed'?> <?php echo _::$profile['pf']['bg']['rep']?> !important;} 
table.tbservice,table.tbservice td{background-color:transparent !important;}
<?php if(_::$profile['pf']['bg']['alp']): $alpha=number_format(_::$profile['pf']['bg']['alp']/100,2);?>
._ct{background-color:rgba(255,255,255,<?php echo $alpha?>) !important;}
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
        <div class="_pf-av"> <a href="/user/<?php echo _::$profile['link']?>" class="h" title="<?php echo _::$profile['name']?>"><img src="<?php echo _::$profile['img-n']?>" class="img-uid-my" alt="<?php echo _::$profile['name']?>"></a>
            <?php if(_::$profile['_id']==_::$my['_id']):?>
            <div class="chg-img"><span class="button" onClick="_.box.load('/dialog/upload #upload_avatar');">เปลี่ยนรูปโปรไฟล์</span></div>
            <?php endif?>
        </div>
        <h2 class="_pf-na">
            <div class="left"><a href="/user/<?php echo _::$profile['link']?>" class="h" title="<?php echo _::$profile['name']?>"><?php echo _::$profile['name']?></a></div>
            <?php if(count($this->pf[1])):?><div class="_pf-fd"><?php echo implode(', ',array_values($this->pf[1]))?></li></div><?php endif?>
            <p class="clear"></p>
        </h2>
        <p class="clear"></p>
    </div>
</div>
<div class="row-fluid">
    <div class="span8" style="padding-bottom:50px">
        <?php if(_::$my['am'] && intval(_::$my['am'])>=9):?>
        <div style="padding:5px 5px; border:1px solid #FFF5D2; background:#FFFDEA; margin-bottom:5px;">
            <h4 align="center">ข้อมูลสำหรับแอดมิน (lv. 9+)</h4>
            <div style="padding:2px 5px"> ID: <?php echo _::$profile['_id']?>
                <br>
                อีเมล์: <?php echo _::$profile['em']?><br>
                สิทธิ์ของผู้ดูแล: <?php echo intval(_::$profile['am'])?><br>
                ยืนยันอีเมล์/เฟสบุ๊ค:
                <?php if(_::$profile['st']):?>
                ยืนยันสมัครสมาชิกแล้ว
                <?php else:?>
                ยังไม่ยืนยัน -
                <input type="button" class="button" value=" ยืนยันการสมัครสมาชิกให้บุคคลนี้ " onClick="_.box.confirm({title:'ยืนยันการสมัครสมาชิก',detail:'ต้องการยืนยันการสมัครสมาชิกให้บุคคลนี้หรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','setverify')}})">
                <?php endif?>
                <br>
                IP:
                <?php $ip=(is_array(_::$profile['ip'])?array_keys(_::$profile['ip']):array(_::$profile['ip']))?>
                <?php foreach($ip as $v):?>
                <a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress=<?php echo $v?>" target="_blank"><?php echo $v?></a><br>
                <?php endforeach?>
            </div>
            <div style="padding:5px; background:#FFF5D2">
                <input type="button" class="button" value="เพื่อนแนะนำ" onClick="_.box.confirm({title:'ตั้งเป็นเพื่อนแนะนำ',detail:'คุณต้องการตั้งสมาชิกนี้เป็นเพื่อนแนะนำหรือไม่',click:function(){_.ajax.gourl('/user/<?php echo _::$profile['link']?>','setrec')}})">
                <input type="button" class="button" value="เพิ่มบ๊อก" onClick="_.box.load('/dialog/point/<?php echo _::$profile['_id']?> #add_point')">
                <?php if(intval(_::$my['am'])>=9):?>
                <input type="button" class="button" value=" แบนสมาชิก " onClick="if(confirm('ต้องการแบนสมาชิกนี้หรือไม่'))_.box.confirm({title:'แบนสมาชิก',detail:'คุณต้องการแบนสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('/user/<?php echo _::$profile['link']?>','setban')}});">
                <?php endif?>
                <input type="button" class="button" value="ลบรูปโปรไฟล์" onClick="_.box.confirm({title:'ลบรูปภาพโปรไฟล์',detail:'คุณต้องการลบรูปภาพโปรไฟล์ของสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('/user/<?php echo _::$profile['link']?>','resetavatar')}})">
                <?php if(intval(_::$my['am'])>=9):?>
                <input type="button" class="button" value="ซ่อนโพสทั้งหมด" onClick="_.box.confirm({title:'ซ่อนโพสทั้งหมดต่อสาธารณะชน',detail:'ต้องการซ่อนโพสทั้งหมดของบุคคลนี้ ไม่ให้สมาชิกคนอื่นที่ไม่ใช่เพื่อนเห็นหรือไม่',click:function(){_.ajax.gourl('/user/<?php echo _::$profile['link']?>','sethideall')}});">
                <?php endif?>
            </div>
        </div>
        <?php endif?>
        <style>
    .pf { min-height:100px !important}
    
    .pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}
    
    .pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
    .pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}
    </style>
        <div>
            <h3 style="margin:5px 10px 0px 10px;color: #0399BE;">เกี่ยวกับ
                <?php if(_::$my && _::$my['_id']==_::$profile['_id']):?>
                <span style="font-size:12px; font-weight:normal">(<a href="/settings/profile" class="h">แก้ไข</a>)</span>
                <?php endif?>
            </h3>
            <div style="position:relative">
                <table width="100%" class="tbservice" cellpadding="5" cellspacing="0" border="0">
                    <tr>
                        <td class="colum">ชื่อ: </td>
                        <td><?php echo _::$profile['name']?></td>
                    </tr>
                    <?php if(!empty(_::$profile['if']['lk'])&&!is_numeric(_::$profile['if']['lk'])):?>
                    
                        <td class="colum">ชื่ออ้างอิง: </td>
                        <td><a href="/user/<?php echo _::$profile['if']['lk']?>">@<?php echo _::$profile['if']['lk']?></a></td>
                    </tr>
                    <?php elseif(_::$my&&(_::$my['_id']==_::$profile['_id'])):?>
                        <td class="colum">ชื่ออ้างอิง: </td>
                        <td>-ยังไม่ได้กำหนด- (<a href="/settings/url" class="h">คลิกที่นี่เพื่อกำหนดชื่ออ้างอิง</a>)</td>
                    </tr>
                    <?php endif?>
                    <tr>
                        <td class="colum">คะแนนโหวต: </td>
                        <td><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?> / <?php echo number_format(intval(_::$profile['pf']['vt']['a']))?> (คะแนนประจำเดือนนี้/คะแนนทั้งหมด)</td>
                    </tr>
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
                    <tr>
                        <td class="colum">ของขวัญ: </td>
                        <td><?php if($this->gift):?>
                            <div>
                                <?php $u=_::user();foreach($this->gift as $v):
    $p=$u->profile($v['p']);
    ?>
                                <img src="http://s1.boxza.com/gift/64/<?php echo $v['gf']?>.png" class="show-tooltip-s" alt="" title="<strong><?php echo $v['n']?><strong><br>มอบโดย <?php echo $p['name']?>">
                                <?php endforeach?>
                            </div>
                            <?php endif?>
                            <?php if(_::$profile['_id']!=_::$my['_id']):?>
                            <input type="button" class="button" value=" ส่งของขวัญให้ <?php echo _::$profile['name']?>" onClick="!_.my?_.box.alert('กรุณาล็อคอิน'):_.box.load('/dialog/gift/<?php echo _::$profile['_id']?> #gift_send')">
                            <?php endif?>
                            <div style=" padding:5px; color:#c00"><strong>ของขวัญ</strong> จะหายไปทันทีเมื่อหมดอายุ</div></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="background:#f0f0f0; text-align:center; font-weight:bold;">Friends Collection</td>
                    </tr>
                    <?php if(_::$profile['st']>=1):?>
                    <?php if(_::$profile['pet']): $u=_::user();?>
                    <?php if(_::$profile['pet']['own']): $own=$u->profile(_::$profile['pet']['own']);?>
                    <tr>
                        <td class="colum">เจ้าของ: </td>
                        <td><a href="/user/<?php echo $own['link']?>" class="h"> <img src="<?php echo $own['img']?>" style="width:24px; vertical-align:middle"> <?php echo $own['name']?></a></td>
                    </tr>
                    <?php endif?>
                    <?php if(_::$profile['pet']['col']&&count(_::$profile['pet']['col'])>0):?>
                    <tr>
                        <td class="colum">Collection: </td>
                        <td><?php if(_::$profile['_id']==_::$my['_id']):?>
                            <?php $j=0;foreach(_::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
                            <p><a href="/user/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a> - ค่าตัว <?php echo $co['pet']['price']?> บ๊อก (<a href="javascript:;" onClick="_.box.confirm({title:'ขายคืนให้ BoxZa',detail:'คุณสามารถขายคืนได้ในราคา 30% จากราคาล่าสุดเท่านั้น ต้องการดำเนินการต่อหรือไม่',click:function(){_.ajax.gourl('/<?php echo _::$profile['link']?>','sellpet',<?php echo $co['_id']?>);}})">ขายคืน</a>)</p>
                            <?php endif;endforeach;?>
                            <?php else:?>
                            <?php $j=0;foreach(_::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
                            <?php echo $j>0?', ':''?><a href="/user/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a>
                            <?php $j++;endif;endforeach;?>
                            <?php endif?></td>
                    </tr>
                    <?php endif?>
                    <?php endif?>
                    <tr>
                        <td class="colum">ค่าตัว: </td>
                        <td><strong><?php echo number_format(max(_::$profile['pet']['price'],10))?></strong> บ๊อก</td>
                    </tr>
                    <?php if(_::$profile['_id']!=_::$my['_id']):?>
                    <tr>
                        <td></td>
                        <td><input type="button" class="button blue" value=" ซื้อ <?php echo _::$profile['name']?> " onClick="_.box.confirm({title:'ซื้อเป็น Collection',detail:'คุณต้องการซื้อบุคคลนี้ในราคา <?php echo number_format(max(_::$profile['pet']['price'],10))?> บ๊อกหรือไม่<div style=\'padding:5px;border:1px solid #e0e0e0;margin:5px 0px\'><strong>กติกา</strong><br>- ทุกการซื้อ 1 ครั้ง มูลค่าคนที่ถูกซื้อจะเพิ่มไป 40%<br>- หากมีคนมาซื้อต่อคุณ คุณจะได้กำไร 10% จากราคาที่เคยซื้อไว้<br>- คนที่ถูกซื้อจะได้ประมาณ 7% ของราคาที่ถูกซื้อ<br><br>หากไม่พอใจ สามารถขายคืนเข้า Boxza ได้ บ๊อกคืน 30% ของราคาล่าสุด<br><br>ขอให้สนุกกับ Friend\’s Collection ของ Boxza นะครับ</div>',click:function(){_.ajax.gourl('/user/<?php echo _::$profile['link']?>','buypet');}})"></td>
                    </tr>
                    <?php endif?>
                    <?php else:?>
                    <tr>
                        <td class="colum">ค่าตัว: </td>
                        <td>- ไม่สามารถตีราคาได้ เรื่องจากบุคคลนี้ยังไม่ยืนยันการสมัครสมาชิก - </td>
                    </tr>
                    <?php endif?>
                    <tr>
                        <td class="colum">แนะนำตัว: </td>
                        <td><?php echo !empty(_::$profile['pf']['if'])?nl2br(_::$profile['pf']['if']):'-'?></td>
                    </tr>
                    <tr>
                        <td class="colum">โปรไฟล์ลิ้งค์: </td>
                        <td><a href="http://boxza.com/user/<?php echo _::$profile['link']?>">http://boxza.com/user/<?php echo _::$profile['link']?></a></td>
                    </tr>
                    <tr>
                        <td class="colum">บ๊อก/เครดิต: </td>
                        <td><?php echo number_format(intval(_::$profile['cd']['p']))?> บ๊อก</td>
                    </tr>
                    <tr>
                        <td class="colum">บั๊ก/คะแนน: </td>
                        <td><?php echo number_format(intval(_::$profile['if']['ch']['sc']))?> บั๊ก</td>
                    </tr>
                    <tr>
                        <td class="colum">สัตว์เลี้ยงในห้องแชท: </td>
                        <td><?php if(is_array(_::$profile['if']['ch']['inv'])):?>
                        <?php foreach(_::$profile['if']['ch']['inv'] as $v):?><img src="http://s0.boxza.com/static/chat/rank/<?php echo $v?>.gif"> <?php endforeach?>
                        <?php else:?>
                        -
                        <?php endif?>
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                        <td class="colum">Facebook: </td>
                        <td> <?php if(_::$profile['sc']['fb']['id']):?><a href="https://www.facebook.com/<?php echo _::$profile['sc']['fb']['id']?>" target="_blank"><?php echo _::$profile['sc']['fb']['id']?></a><?php else:?>-<?php endif?></td>
                    </tr>
                    <tr>
                        <td class="colum">Twitter: </td>
                        <td> <?php if(isset(_::$profile['sc']['tw']['id'])):?><a href="https://twitter.com/<?php echo _::$profile['sc']['tw']['name']?>" target="_blank"><?php echo _::$profile['sc']['tw']['name']?></a><?php else:?>-<?php endif?></td>
                    </tr>
                    <tr>
                        <td class="colum">Google+: </td>
                        <td> <?php if(isset(_::$profile['sc']['gg']['id'])):?><a href="https://plus.google.com/<?php echo _::$profile['sc']['gg']['id']?>" target="_blank"><?php echo _::$profile['sc']['gg']['name']?></a><?php else:?>-<?php endif?></td>
                    </tr>
                    <tr>
                        <td class="colum">สมัครสมาชิกเมื่อ: </td>
                        <td><?php echo time::show(_::$profile['da'],'datetime')?></td>
                    </tr>
                    <tr>
                        <td class="colum">ออนไลน์ล่าสุด: </td>
                        <td><?php echo time::show(_::$profile['du'],'datetime')?></td>
                    </tr>
                </table>
                <div style="position: absolute;top: 2px;right: 2px;text-align: center;border: 1px solid #DDD;padding: 5px;border-radius: 5px; background-color:#fff;">
                    <p>คะแนนโหวต</p>
                    <span id="vresult" class="vresulf-<?php echo mb_strlen(intval(_::$profile['pf']['vt']['m']),'utf-8')?>"><?php echo number_format(intval(_::$profile['pf']['vt']['m']))?></span>
                    <p><span class="v-plus show-tooltip-s" onClick="_.ajax.gourl('<?php echo URL?>','vote','+')" title="โหวตเพิ่มคะแนน"><i></i></span><span class="v-minus show-tooltip-s" onClick="_.ajax.gourl('<?php echo URL?>','vote','-')" title="โหวตลบคะแนน"><i></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div style="margin:5px 0px"> <?php echo $this->service?>
            <div style="padding:5px 5px; margin:5px 0px 5px 0px; background-color:#f9f9f9; text-align:right; color:#999; font-size:11px">&copy; 2014 BoxZa, All Rights Reserved.</div>
        </div>
    </div>
</div>
<script>
$('._pf-av,._pf-hd').hover(function(){$(this).find('.chg-img').css('display','inline-block');},function(){$(this).find('.chg-img').css('display','none');});
</script> 
