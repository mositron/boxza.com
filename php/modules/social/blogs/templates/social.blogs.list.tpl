

<?php for($i=0;$i<count($this->blog);$i++):?>
<?php $u=$this->user->profile($this->blog[$i]['u']);?>
<li class="ln-<?php echo $this->blog[$i]['_id']?> l<?php echo $i%2?>" data-line="<?php echo $this->blog[$i]['_id']?>" data-share="<?php echo $this->blog[$i]['sh']['f']?$this->blog[$i]['sh']['f']:$this->blog[$i]['_id']?>" data-like="<?php echo in_array(_::$my['_id'],(array)$this->blog[$i]['lk']['u'])?' like':''?>" data-w="<?php echo $this->blog[$i]['pt']['w']?>" data-h="<?php echo $this->blog[$i]['pt']['h']?>" data-lk="<?php echo $this->blog[$i]['lk']['c']?>" data-ss="<?php echo $this->blog[$i]['sh']['c']?>">
<a href="/<?php echo $u['link']?>/line/<?php echo $this->blog[$i]['_id']?>" class="h" title="<?php echo $this->blog[$i]['tt']?>">
<img src="<?php echo $u['img']?>" alt="<?php echo $u['name']?>">
<?php echo $this->blog[$i]['tt']?> -- <?php echo time::show($this->blog[$i]['da'],'date')?></a>


<div class="t">
<span><?php echo intval($this->blog[$i]['lk']['c'])?> โดน</span>, 
<span><?php echo intval($this->blog[$i]['sh']['c'])?> แบ่งปัน</span>, 
<span><?php echo intval($this->blog[$i]['cm']['c'])?> ความเห็น</span>
</div>
</li>
<?php endfor?>



<?php if($this->next):?>
<div class="pt-next"><a href="javascript:;" onClick="_.ajax.gourl('/blogs','moreblogs',<?php echo $this->next?>); $(this).parent().remove();">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>
