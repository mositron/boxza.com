
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<h3 class="ht"><i></i> <a href="/recent">สติกเกอร์มาใหม่</a> <small>(<a href="/recent">ทั้งหมด</a>)</small></h3>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->sticker);$i++):?>
    <li class="span6">
    <a href="/view/<?php echo $this->sticker[$i]['_id']?>" class="thumbnail" target="_blank">
    <img src="http://s3.boxza.com/sticker/cover/<?php echo $this->sticker[$i]['fd']?>/s.png">
    <div><?php echo $this->sticker[$i]['t']?></div>
    </a>
    </li>
    <?php endfor?>
</ul>