<?php if(_::$profile['pf']['bg']['url']):?>
<style>
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
</style>
<?php endif?>
<div class="_pf-hd">
<?php if(_::$profile['pf']['hd']):?><img src="http://s1.boxza.com/profile/<?php echo _::$profile['if']['fd']?>/<?php echo _::$profile['pf']['hd']?>"><?php endif?>

<div class="_pf-bdb"></div>
<div class="_pf-bd">
<div class="_pf-av">
<a href="/<?php echo _::$profile['link']?>" class="h" title="<?php echo _::$profile['name']?>"><img src="<?php echo _::$profile['img-n']?>" class="img-uid-my" alt="<?php echo _::$profile['name']?>"></a>
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

<p class="clear"></p>
</h2>
<p class="clear"></p>
</div>
</div>
<div class="pf-l pf-l-user">
<div>

<?php if($this->open['al']):?>

    <div data-role="navbar" data-theme="a" data-iconpos="left">
        <ul>
            <li><a href="/<?php echo _::$profile['link']?>" title="เกี่ยวกับ"<?php echo _::$path[0]=='about'?' class="ui-btn-active"':''?> data-icon="star">เกี่ยวกับ</a></li>
            <li><a href="/<?php echo _::$profile['link']?>/line" title="ไลน์"<?php echo _::$path[0]=='line'?' class="ui-btn-active"':''?> data-icon="star">ไลน์</a></li>
<?php if($this->open['pt']):?>
            <li><a href="/<?php echo _::$profile['link']?>/photos" title="รูปภาพ"<?php echo _::$path[0]=='photos'?' class="ui-btn-active"':''?> data-icon="star">รูปภาพ</a></li>
<?php endif?>
<?php if($this->open['fr']):?>
            <li><a href="/<?php echo _::$profile['link']?>/friends" title="เพื่อน"<?php echo _::$path[0]=='friends'?' class="ui-btn-active"':''?> data-icon="star">เพื่อน</a></li>
<?php endif?>
        </ul>
    </div><!-- /navbar -->

<?php echo _::$content?>
<?php else:?>
<div style="padding:100px 0px; text-align:center; margin:50px; box-shadow:3px 3px 0px #f9f9f9; border:1px solid #f0f0f0; font-size:14px">ไม่สามารถเข้าถึงข้อมูลของ <?php echo _::$profile['name']?> ได้</div>
<?php endif?>

</div>
</div>