
<?php 
if(is_array($this->album['cm']['d'])):
$user=_::user();
for($i=count($this->album['cm']['d'])-1;$i>=0;$i--):
	$c=$this->album['cm']['d'][$i];
	if(!$c['u']=$user->profile($c['u']))continue;
?>
<div class="cm-s cm-s-<?php echo $c['i']?>" uid="<?php echo $c['u']['_id']?>">
<div class="av" av="<?php echo $c['u']['_id']?>"><a href="http://boxza.com/<?php echo $c['u']['link']?>" class="h" title="<?php echo $c['u']['name']?>"><img src="<?php echo $c['u']['himg']?>" class="img-uid-<?php echo $c['u']['_id']?>"></a></div>
<div class="cm-d">
<div class="cm-r">
<span class="ago" datetime="<?php echo $c['t']->sec?>"> <?php echo time::ago($c['t'])?> ที่ผ่านมา</span>
<span class="cm-u"><a href="/<?php echo $c['u']['link']?>" class="h"><?php echo $c['u']['name']?></a></span>
<div class="clear"></div>
</div>
<div class="cm-dt"><?php echo $c['m']?></div>
</div>
<p class="clear"></p>
</div>
<?php 
endfor;
endif;
?>