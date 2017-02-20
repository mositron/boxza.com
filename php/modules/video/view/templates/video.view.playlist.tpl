<div>
<div>
<table class="table" style="margin-bottom:0px;">
<thead>
<tr>
<th>ชื่อเพลย์ลิส</th>
<th></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->playlist);$i++):?>
<?php $l='/playlist/'.$this->playlist[$i]['_id'].'-'.$this->playlist[$i]['l'].'.html';?>
<tr>
<td><a href="<?php echo $l?>" target="_blank"><?php echo $this->playlist[$i]['t']?></a></td>
<td width="200" style="text-align:right">

<?php if(in_array(VIDEO_ID,(array)$this->playlist[$i]['v'])):?>
<span class="btn">มีวิดีโอนี้แล้ว</span> 
<?php else:?>
<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','addtoplaylist',<?php echo $this->playlist[$i]['_id']?>)" class="btn playlist-add-<?php echo $this->playlist[$i]['_id']?>"><i class="icon-plus show-tooltip-s" title="ลบ"></i> เพิ่มเข้าเพลย์ลิสนี้</a>
<?php endif?>
<a href="/manage/playlist/<?php echo $this->playlist[$i]['_id']?>" class="btn" target="_blank"><i class="icon-edit show-tooltip-s" title="แก้ไข"></i></a> 
</td>
</tr>
<?php endfor?>

<?php if(!count($this->playlist)):?>
<tr><td colspan="2" style="height:50px; text-align:center; vertical-align:middle">ยังไม่มีเพลย์ลิส <span style="font-size:12px"></span></td></tr>
<?php endif?>
<tr><td colspan="2" style="text-align:center">
<form onSubmit="_.ajax.gourl('<?php echo URL?>','newplaylist',this);return false;">
<input type="text" class="span4" name="title" style="margin-bottom:0px" required> <input type="submit" value="เพิ่มเพลย์ลิสใหม่" class="btn btn-info"> <a href="/manage/playlist" class="btn">จัดการเพลย์ลิส</a> 
 <input type="button" value="ปิด" class="btn" onClick="$('#getplaylist').html('')">
</form>
</td></tr>
</tbody>
</table>
</div>
</div>