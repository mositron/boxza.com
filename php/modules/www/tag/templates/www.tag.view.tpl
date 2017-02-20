<div style="padding:10px 10px; background:#fff;">

<ul class="breadcrumb">
  <li><a href="/tag">ป้ายกำกับ</a> <span class="divider">/</span></li>
  <li class="active"><a href="/tag/<?php echo urlencode($this->tags['_id'])?>"><?php echo $this->tags['_id']?></a></li>
</ul>

<h2 style="padding:5px 5px 5px 10px; background:#f5f5f5; text-shadow:1px 1px 0px #fff; margin:0px;"><?php echo $this->tags['_id']?> <small>คำค้นยอดฮิต ( ป้ายกำกับ, Tags )</small></h2>

<div style="margin:0px 5px 5px;">
<table class="table" width="100%">
<tbody>
<?php for($i=0;$i<count($this->link);$i++):?>
<tr>
<td class="img"><?php if($this->link[$i]['i']):?><a href="<?php echo $this->link[$i]['l']?>" target="_blank"><img src="<?php echo $this->link[$i]['i']?>"></a><?php endif?></td>
<td style="text-align:left"><h3><a href="<?php echo $this->link[$i]['l']?>" target="_blank"><?php echo $this->link[$i]['t']?></a></h3>
<p><?php echo $this->link[$i]['d']?></p>
<?php if($this->link[$i]['tags']):?>
<ul class="tags-relate">
<li class="tags-label">ป้ายกำกับ:</li>
<?php foreach($this->link[$i]['tags'] as $v):?>
<li>#<a href="/tag/<?php echo urlencode($v)?>"><?php echo $v?></a></li>
<?php endforeach?>
</ul>
<?php endif?>
</td>
</tr>
<?php endfor?>
</tbody>
</table>

</div>
</div>


 <?php require(ROOT.'modules/www/system/www.system.footer.php')?>


<style>
.table th{text-align:center}
.table .img{width:50px; text-align:center;}
.table .img img{ max-width:100px; max-height:70px;}
</style>

