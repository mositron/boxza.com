<style>
.ghelp{line-height:2em; padding:10px; margin:5px; border:#ccc; background:#fff; font-size:14px;}
.ghelp h4{margin:2px 0px; color:#000; font-size:16px; padding:2px 0px 5px; border-bottom:1px dashed #e0e0e0;}
.ghelp h4 small{font-weight:normal; font-style:normal; font-size:12px}
.gblock{background:#f9f9f9; text-shadow:1px 1px 0px #fff; padding:5px; border:1px solid #e0e0e0; margin:5px; border-radius:5px;}
.gcode{padding:5px; border:1px solid #f0f0f0; background:#fff; margin:1px 0px 0px 0px; border-radius:5px;}
.gcode pre{line-height:1.4em; font-size:13px;}
.gblock strong{font-weight:bold; color:#555;}
</style>
<div class="ghelp">
<h2>Glitter</h2>
<div class="gblock">
<h4>glitter/category <small>: หมวดหมู่ทั้งหมด</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/category</p>
<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : "...."
"method" : "glitter/category"
}
</pre>
</div>
</div>
<div class="gblock">
<h4>glitter/recommend <small>: กลิตเตอร์ที่แนะนำ</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/recommend</p>
<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : "...."
"method" : "glitter/recommend"
}
</pre>
</div>
</div>
<div class="gblock">
<h4>glitter/list <small>: กลิตเตอร์ทั้งหมด เรียงจากการอัพโหลดล่าสุด</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/list?category={ไอดี}&start={เริ่มจากลำดับที่}&limit={จำนวนต่อหน้า}</p>
<div class="gcode">
category={ไอดี} - รหัสของหมวดกลิตเตอร์ที่จะดึงมา หากต้องการแสดงทุกหมวดใส่ 0<br>
start={เริ่มจากลำดับที่} - ลำดับเริ่มต้นที่ทำการดึง  เริ่มต้นจาก 0  (ดึงจากล่าสุดมาแสดง)<br>
limit={จำนวนต่อหน้า} - จำนวนที่แสดงต่อ 1 หน้า ขั้นต่ำคือ 10
</div>
<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : "...."
"method" : "glitter/list?category={ไอดี}&start={เริ่มจากลำดับที่}&limit={จำนวนต่อหน้า}"
}
</pre>
</div>
</div>
<div class="gblock">
<h4>glitter/view <small>: รายละเอียดกลิตเตอร์</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/view/{ไอดี}</p>
<div class="gcode">
{ไอดี} - รหัสตัวเลขที่ได้จากพารามิเตอร์ _id
</div>

<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : "...."
"method" : "glitter/view/{ไอดี}"
}
</pre>
</div>

</div>
<div class="gblock">
<h4>glitter/download <small>: ส่งค่าดาวน์โหลดกลิตเตอร์ (แจ้งเพิ่มการดาวน์หลด)</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/download/{ไอดี}</p>
<div class="gcode">
{ไอดี} - รหัสตัวเลขที่ได้จากพารามิเตอร์ _id
</div>
<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : {
        "count" : "{จำนวนดาวน์โหลดล่าสุด}"
    }
"method" : "glitter/download/{ไอดี}"
}
</pre>
</div>
</div>
<div class="gblock">
<h4>glitter/share <small>: ส่งค่าแชร์กลิตเตอร์ (แจ้งเพิ่มการแชร์)</small></h4>
<p><strong>Request</strong>: http://m.boxza.com/json/glitter/share/{ไอดี}</p>
<div class="gcode">
{ไอดี} - รหัสตัวเลขที่ได้จากพารามิเตอร์ _id
</div>

<p><strong>Return</strong>:</p>
<div class="gcode">
<pre>
{
"status" : "OK" / "FAIL"
"data" : {
        "count" : "{จำนวนแชร์ล่าสุด}"
    }
"method" : "glitter/share/{ไอดี}"
}
</pre>
</div>
</div>

</div>