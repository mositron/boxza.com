<style>
._hd li.notify{padding:0px}
.tbservice td,.tbservice th{text-align:center;}
.tbservice td.tab_name{text-align:left}
.tbservice td.tab_welcome{text-align:left}
</style>

<div class="hero-unit" style="margin:10px 0px;">
  <h1>สร้างห้องแชทฟรี</h1>
  <p>แชท พูดคุย สนทนา หาเพื่อน ดูกล้อง ส่องเว็บแคม</p>
  <p>บริการใหม่จาก BoxZa.com ให้คุณเป็นเจ้าของห้องแชทฟรีๆ พร้อมทั้งสามารถนำห้องแชทไปติดเว็บของคุณเองได้ด้วย ที่สำคัญ..ฟรี!</p>
  <p>
    <a href="/manage" class="btn btn-info btn-large">ไปยังหน้าจัดการห้องแชทของคุณ</a>
  </p>
</div>

<iframe frameborder="0" width="100%" height="500" id="bz_chat" src="http://s0.boxza.com/static/chat/?f=1&r=<?php echo $_GET['r']?$_GET['r']:'1'?>&rnd=<?php echo rand(1,999)?>"></iframe>
<div style="padding:10px; border:1px solid #f0f0f0; border-radius:5px; margin:0px 0px 10px;">
<h4>ห้องยอดนิยม <small> (<a href="/list">ดูห้องแชททั้งหมด</a>)</small></h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table tbservice">
<thead>
<tr class="text-center">
<th>ชื่อห้อง</th>
<th></th>
<th>สร้างโดย</th>
<th>ออนไลน์</th>
</tr>
</thead>
<tbody>   
<?php for($i=0;$i<count($this->chat);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<td class="tab_name"><a href="/<?php echo $this->chat[$i]['l']?$this->chat[$i]['l']:'room/'.$this->chat[$i]['_id']?>" target="_blank"><?php echo $this->chat[$i]['n']?></a></td>
<td class="tab_welcome"><?php echo $this->chat[$i]['w']?></p></td>
<td class="tab_published"><?php $u=$this->user->profile($this->chat[$i]['u']);?><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td>
<td class="tab_id"><?php echo $this->chat[$i]['cu']?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>

<div style="padding:10px; border:1px solid #f0f0f0; border-radius:5px; margin:0px 0px 10px;">
<h4>ห้องแชทใหม่ <small> (<a href="/list">ดูห้องแชททั้งหมด</a>)</small></h4>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table tbservice">
<thead>
<tr class="text-center">
<th>ชื่อห้อง</th>
<th></th>
<th>สร้างโดย</th>
<th>ออนไลน์</th>
</tr>
</thead>
<tbody>   
<?php for($i=0;$i<count($this->nchat);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<td class="tab_name"><a href="/<?php echo $this->nchat[$i]['l']?$this->nchat[$i]['l']:'room/'.$this->nchat[$i]['_id']?>" target="_blank"><?php echo $this->nchat[$i]['n']?></a></td>
<td class="tab_welcome"><?php echo $this->nchat[$i]['w']?></p></td>
<td class="tab_published"><?php $u=$this->user->profile($this->nchat[$i]['u']);?><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td>
<td class="tab_id"><?php echo $this->nchat[$i]['cu']?$this->nchat[$i]['cu']:'-'?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>



