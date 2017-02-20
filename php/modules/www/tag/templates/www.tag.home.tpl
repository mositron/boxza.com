<div style="padding:10px 10px; background:#fff;">


<h2 style="padding:5px 5px 5px 10px; background:#f5f5f5; text-shadow:1px 1px 0px #fff; margin:5px 0px;"> <small>คำค้นยอดฮิต ( ป้ายกำกับ, Tags )</small></h2>


<ul class="tags">
<?php foreach($this->tags as $v):?>
<li><a href="/tag/<?php echo urlencode($v['_id'])?>" class="a<?php echo $v['size']?> c<?php echo rand(1,18)?>"><?php echo $v['_id']?></a></li>
<?php endforeach?>
</ul>
</div>


 <?php require(ROOT.'modules/www/system/www.system.footer.php')?>


<style type="text/css">
._ct{background:#fff;}
</style>