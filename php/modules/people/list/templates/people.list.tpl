<h3 style="margin-bottom:5px"><?php echo $this->cate[$this->c]?></h3>
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div style="margin-top:5px">
<ul class="thumbnails row-count-4">
<?php foreach($this->people as $v):

$hot=($v['n']?$v['n'].' ('.trim($v['nn'].' '.$v['fn'].' '.$v['ln']).')':trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
$hname=($v['n']?$v['n']:trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
?>
<li class="span3">
<a href="<?php echo $v['lk']?>" title="<?php echo $hot?>">
<img src="http://s3.boxza.com/people/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $hot?>">
<p><?php echo $hname?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<?php echo $this->pager?>