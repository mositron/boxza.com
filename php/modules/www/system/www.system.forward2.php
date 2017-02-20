<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
<title>BoxZa Engine - Error!</title>	
<style>
*{ margin: 0; padding: 0; }
body{ font-family:tahoma; font-size:11px; background:#EAE1CE; color: #666666;  }
.clear{ clear: both; }
a{color:#666; text-decoration:none}
#outter{text-align:center;padding:80px 0px 0px 0px; }
#inner{border-top:1px solid #C7AE7A;border-bottom:1px solid #C7AE7A; background:#FFFFFF; text-align:center; padding:50px 0px}
#content{ width:700px; margin:0px auto; text-align:left}
#header{text-align:left; width:700px; margin:0px auto; height:70px;position:relative;}
#error{font-weight:bold; text-align:center; color:#AE8D4A}
#detail{padding:50px; margin:5px; border:1px solid #EEEEEE; background:#FFFFFF; text-align:center; font-size:14px}
#detail strong{color:#89703A}
.border{background:#D7C59F; height:10px; overflow:hidden}
#report{margin:10px; text-align:center}
</style>
</head>
<body>
<div id="outter">
<div id="header"></div>
<div class="border"></div>
<div id="inner">
<div id="content">
<div style="padding:5px 5px;">
<h1 id="error">BoxZa Engine - เกิดข้อผิดพลาด!</h1>
<div id="detail">
เกิดข้อผิดพลาดจากการทำงาน เนื่องจากความผิดพลาดบางประการ<br>
กรุณารอซักครู่ และทดลองใหม่อีกครั้ง...<br><br>
<div style="padding:5px; border:1px solid #ddd; background:#f6f6f6; text-align:center">Error Code: <?php echo _::$my?'#'._::$my['_id'].'/'._::$my['st']:'@'?>!<?php echo $_COOKIE[_::$config['block']]?></div>


<script type="text/javascript"> __th_page="forward";</script>
<script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script>
<noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript>

</div>
</div>
<div align="center"></div>
</div></div>
<div class="border"></div>
</div>
</body>
</html>
<?php exit;?>
