<ul>
<p id="sbutton" style="display:none;float:right">
<input type="button" value=" เพิ่มเข้าเนื้อหา " onClick="addfile();">
</p>
<p style="clear:both"></p>
</ul>
<div>
<?php for($i=0;$i<count($this->file);$i++):?>
<div style="float:left; padding:5px;">
<a href="javascript:;" onClick="selectf('<?php echo htmlentities($this->file[$i],ENT_QUOTES)?>','http://s3.boxza.com/people/<?php echo $this->people['fd'].'/'.$this->file[$i]?>')" style="display:block; cursor:pointer"><img src="http://s3.boxza.com/people/<?php echo $this->people['fd'].'/'.$this->file[$i]?>" class="img-t"></a>
<p align="center"><a href="javascript:;" onClick="deli('<?php echo $this->file[$i]?>')"><img src="http://s0.boxza.com/static/images/global/delete.gif"></a></p>
</div>
<?php endfor?>
<?php if(!count($this->file)):?>
<div style="padding:20px; text-align:center">- ยังไม่มีไฟล์ -</div>
<?php endif?>
</div>