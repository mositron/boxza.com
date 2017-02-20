<h3 class="fbimage-bar">เพจ <?php echo $this->ref[$this->c]?></h3>

<ul class="fbimage-list">
    <?php for($i=0;$i<count($this->image);$i++):?>
    <li>
    <a href="<?php echo _getfile($img=$this->image[$i]['img'])?>">
    <img src="<?php echo $img?>">
    <p><?php echo $this->ref[$this->image[$i]['fb']]?></p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/fbimage/ref/<?php echo $this->c?><?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/fbimage/ref/<?php echo $this->c?>/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>