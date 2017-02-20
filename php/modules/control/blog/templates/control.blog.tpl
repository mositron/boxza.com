<style>
.col-w{padding:5px 0px; padding-left:10px;border-bottom: 1px dashed #ddd;}
.col-w strong{display:block; text-indent:5px;}
.col-w small{font-weight:normal;}
.col-w input,.col-w select{margin-bottom:0px !important;}
.table thead th{text-align:center !important;}
.table .label-success a{color:#fff !important;}
</style>
<form method="post" action="<?php echo URL?>">
<div>
<div class="col-w">
<strong>หัวข้อ <small> * บังตับกรอก</small></strong>
<input type="text" class="span12" name="t" value="<?php echo $this->post['t']?>" required>
</div>
<div class="col-w">
<strong>หมวด <small> * บังตับเลือก</small></strong>
<select name="c" required>
<option value="">เลือกหมวด</option>
<?php foreach($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->post['c']==$k?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select> *
</div>
<div class="col-w">
<strong>คีย์เวิร์ด <small>- คำที่ใช้แทรกลงในเนื้อหา</small></strong>
<input type="text" class="span12" name="kw" value="<?php echo $this->post['kw']?>">
</div>
<div class="col-w">
<strong>ลิ้งค์ของคีย์เวิร์ด</strong>
<input type="text" class="span12" name="kl" value="<?php echo $this->post['kl']?>">
</div>
<div class="col-w">
<strong>เนื้อหา <small>- แทรก {KEYWORD} เพื่อแปลงคำที่ต้องการเน้นลงในเนื้อหา - บังคับกรอกอย่างน้อย 500 ตัวอักษร</small></strong>
<textarea class="span12" name="d" rows="20" required><?php echo $this->post['d']?></textarea>
</div>
<div class="col-w">
<strong>Tags <small>- หากมีหลายคำ ใช้ , คั่น </small></strong>
<input type="text" class="span12" name="k" value="<?php echo $this->post['k']?>" required>
</div>
<div class="col-w" align="center"><input type="submit" value=" เริ่มทำงาน" class="btn btn-primary"></div>
</div>
</form>
<h3>การใช้งานล่าสุด <small>(<a href="/blog/recent">ทั้งหมด</a>)</small></h3>
<div style="margin:5px 0px 50px;">
<table width="100%" class="table table-striped table-bordered">
<thead><tr><th>เวลา</th><th>Keyword</th><th>Title</th><th>Status</th><th>By</th></tr></thead>
<tbody>
<?php for($i=0;$i<count($this->lastseo);$i++):?>
<tr>
<td align="center"><?php echo $ls=time::show($this->lastseo[$i]['da'],'datetime',1)?></td>
<td align="center"><?php echo $this->lastseo[$i]['kw']?></td>
<td><?php echo $this->lastseo[$i]['t']?></td>
<td>
<?php if($this->lastseo[$i]['st']):?>
<span class="label label-success"><a href="<?php echo $this->lastseo[$i]['l']?>" target="_blank">สำเร็จ</a></span>
<?php else:?>
<span class="label label-important"><?php echo $this->lastseo[$i]['l']?></span>
<?php endif?>
</td>
<td align="center"><?php $u=$this->user->profile($this->lastseo[$i]['u']);?> <a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>

