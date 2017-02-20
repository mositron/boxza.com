<script type="text/javascript" src="http://s0.boxza.com/static/js/syntax/scripts/shCore.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/syntax/scripts/shBrushCSharp.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/syntax/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/syntax/scripts/shBrushPhp.js"></script>
<link type="text/css" rel="stylesheet" href="http://s0.boxza.com/static/js/syntax/styles/shCore.css"/>
<link type="text/css" rel="stylesheet" href="http://s0.boxza.com/static/js/syntax/styles/shThemeDefault.css"/>
<script type="text/javascript">
SyntaxHighlighter.config.clipboardSwf = 'http://s0.boxza.com/static/js/syntax/scripts/clipboard.swf';
SyntaxHighlighter.all();
</script>





<div style="padding:5px 5px 5px; line-height:1.6em">
<h2 style="padding:5px; margin:0px 0px 5px; border-bottom:1px solid #f0f0f0;">นักพัฒนา</h2>

<h4 style="padding:5px; border:1px solid #e9e9e9; background:#f9f9f9;">สำหรับติดเว็บบอร์ด หรือ ฟอรั่ม</h4>
<div style="padding:10px; border:1px solid #f0f0f0; line-height:2em">
1. สร้างไฟล์สำหรับรอรับการส่งข้อมูลรูปภาพกลับ ชื่อ <strong>return_image.html</strong> (อาจจะชื่ออื่นก็ได้) อยู่ในโฟลเดอร์เว็บบอร์ดของคุณ<br>
2. นำโค๊ดด้านล่างนี้ใส่ในไฟล์ที่สร้างขึ้น<br>
<pre class="brush: php;">
<?php echo htmlspecialchars('<html>
<head></head>
<body>
<script>
var s = unescape(document.location.search.substring(1));
var ig = /username_list|search/i;
var t=opener.document.getElementsByTagName(\'TEXTAREA\');
for(var i=0;i<t.length;i++)
{
	if(!t[i].name.match(ig))
	{
		t[i].value = t[i].value+s;
		opener.focus();
		window.close();
		break;
	}
}
</script>
</body>
</html>');?>
</pre>
3. ทำการอัพโหลดไฟล์ <strong>return_image.html</strong> ขึ้น server โดยสามารถไว้ path ไหนก็ได้แต่เป็น domain เดียวกับเว็บบอร์ด<br>
<div style="border:1px inset #ccc; padding:5px; background:#f9f9f9">เช่น โดเมนของเว็บบอร์ดคือ <strong>http://www.myforum.com/</strong><br>
อัพโหลด <strong>return_image.html</strong> ไว้ตำแหน่ง path นอกสุดของเว็บบอร์ด<br>
ก็จะได้ลิ้งค์ของไฟล์คือ <strong>http://www.myforum.com/return_image.html</strong>
</div>
4. เพิ่มโค๊ดด้านล่างนี้ภายในหน้าโพสเว็บบอร์ดของคุณ เพื่อเรียกใช้งานการอัพโหลดรูปภาพ<br>
<pre class="brush: php;">
<?php echo htmlspecialchars('<a href="javascript:;" onClick="window.open(\'http://image.boxza.com/upload?redirect_uri=\'+encodeURIComponent(\'http://www.myforum.com/return_image.html\')+\'&format=bbcode\', \'uploadimage\', \'resizable=yes,width=600,height=450\');return false;">อัพโหลดรูปภาพ</a>');?>
</pre>
- <strong>http://www.myforum.com/return_image.html</strong> คือตำแหน่งไฟล์ที่สร้างขึ้นจากข้อ 1.<br>
- <strong>format=bbcode</strong> คือสั่งส่งค่ากลับมาเป็น bbcode (หากต้องการให้ส่งกลับเป็น html ให้เปลี่ยนเป็น <strong>format=html</strong>)<br>
- ให้ทำตามข้อ 4. ในทุกๆหน้าที่ใช้สำหรับโพสหรือแก้ไขข้อความ ที่ต้องการให้มีระบบอัพโหลดรูปภาพ<br>
5. เสร็จเรียบร้อย<br><br>

<h4>หลักการทำงานของระบบ</h4>
- เมื่อผู้ใช้งานคลิก "อัพโหลดรูปภาพ" จากข้อ 4. ก็จะมี popup ให้อัพโหลดรูปภาพขึ้นมา <br>
- เมื่ออัพรูปภาพเสร็จระบบจะรีไดเร็คไปยัง http://www.myforum.com/return_image.html เพื่อส่งค่า bbcode ของรูปภาพไปให้<br>
- เมื่อ http://www.myforum.com/return_image.html ได้รับค่า bbcode ก็จะส่ง bbcode ไปยังกล่อง textarea ที่ใช้กรอกข้อความโพส<br><br>


<h4>เว็บตัวอย่างที่ใช้ระบบนี้</h4>
- <a href="http://forum.boxza.com/" target="_blank">http://forum.boxza.com/</a><br>
- <a href="http://football.boxza.com/forum/" target="_blank">http://www.teededball.com/forum</a><br>
</div>

<div style="padding:10px; background:#f9f9f9; font-size:14px; color:#000; border:1px solid #eee; margin:5px 0px">สอบถามเพิ่มเติมได้ที่ <a href="http://forum.boxza.com/topic/100" target="_blank">เว็บบอร์ดนักพัฒนา - กระทู้ระบบอัพโหลดรูปภาพ</a></div>
</div>