
<?php require(ROOT.'modules/www/system/www.system.header.php')?>

	<hgroup class="head-logo">
    	<h1><a href="/" title="อัลบั้มรูปภาพ">อัลบั้มรูปภาพ</a></h1>
        <h2>อัลบั้มรูปภาพ โหวตอัลบั้ม หนุ่มหล่อ สาวสวย คนน่ารัก รูปภาพประทับใจ</h2>
        <!-- BEGIN - BANNER : A -->
        <?php if($this->_banner['a']):?>
        <div>
            <ul class="_banner _banner-once">
                <?php foreach($this->_banner['a'] as $v):?>
                <li><?php echo $v?></li>
                <?php endforeach?>
            </ul>
        </div>
        <?php endif?>
        <!-- END - BANNER : A -->
    </hgroup>
  
<div class="_ct _ct-<?php echo MODULE?>">
<div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <div class="nav-collapse">
          <ul class="nav">
				<li><a href="http://album.boxza.com/" title="อัลบั้มรูปภาพ"><i class="ic1"></i> อัลบั้มรูปภาพ</a></li>
          </ul>
          <ul class="nav pull-right">
            <li><a href="javascript:;" rel="nofollow" onClick="<?php echo _::$my?(_::$my['st']&&_::$my['st']>0?'_.box.open(\'#photos_newalbum\')':'_.box.alert(\'กรุณายืนยันการสมัครผ่านอีเมล์ของท่าน\')'):'_.box.alert(\'กรุณาล็อคอินก่อนใช้งานส่วนนี้\')'?>"><i class="ic3"></i>  เพิ่มอิลบั้มใหม่</a></li>
            <li><a href="/manage" rel="nofollow"><i class="ic4"></i>  จัดการอัลบั้มของคุณ</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>
  
<?php if(_::$my):?>
<div id="photos_newalbum" class="gbox" style="width:500px">
<form onSubmit="_.ajax.gourl('/manage','newalbum',this);_.box.close();return false;">
<div class="gbox_header">สร้างอัลบั้มรูปภาพ</div>
<div class="gbox_content" style="text-align:left;">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">ชื่ออัลบั้ม</td><td align="left"><input type="text" name="title" class="tbox" style="width:200px"></td></tr>
<tr>
<td class="colum">ประเภทอัลบั้ม</td>
<td>
<select name="category" class="tbox" required><option value="">เลือกประเภท</option>
<?php foreach(_::$config['album'] as $k=>$v):?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php endforeach?>
</select>
<br>* หากเลือกผิดหมวด เจ้าหน้าที่จะทำการ<strong>ลบทันที</strong>โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</td>
</tr>
<tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</form>
</div>
<?php endif?>

<ul class="ncate n-icon">
<?php $i=0;foreach($this->cate as $k=>$v):?>
<?php echo $i%4==0?'<li><ul>':''?>
<li class="l<?php echo $k?> i<?php echo $i%4?>"><a href="/c-<?php echo $k?>"><i></i> <?php echo $v?></a></li>
<?php echo $i%4==3?'</ul></li>':''?>
<?php $i++;endforeach?>
<?php echo $i%4!=0?'</ul></li>':''?>
<p class="clear"></p>
</ul>


<div class="_ct-in">
  
<?php echo _::$content?>

<?php require(ROOT.'modules/www/system/www.system.footer.php')?>

</div></div>