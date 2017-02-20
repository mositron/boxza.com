<h3 class="fbimage-bar">ภาพฮิต 24ชมล่าสุด</h3>

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