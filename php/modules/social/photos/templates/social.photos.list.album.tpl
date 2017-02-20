<?php for($i=0;$i<count($this->album);$i++):?>
<li>
<div><a href="/photos/album-<?php echo $this->album[$i]['_id']?>" class="h"><?php if($this->album[$i]['pt']['tmp']):?><img src="<?php echo $this->album[$i]['pt']['tmp']?>"><?php endif?></a></div>
<h4><a href="/photos/album-<?php echo $this->album[$i]['_id']?>" class="h"><?php echo $this->album[$i]['tt']?></a><?php if($this->album[$i]['pt']['c']):?> <small style="font-size:12px; font-weight:normal;">(<?php echo $this->album[$i]['pt']['c']?>)</small><?php endif?></h4>
</li>
<?php endfor?>

<p class="clear"></p>
