
<style>


.blogs{padding:5px;}
.blogs li{height:30px; line-height:0px; border-top:1px solid #fff; border-bottom:1px solid #f0f0f0; background:#fff; position:relative}
.blogs li.l1{background:#fbfbfb;}
.blogs li a img{width:26px; height:26px; vertical-align:middle; margin:2px 5px 2px 2px;}
.blogs li a{display:block; color:#333;padding:0px 5px 0px 0px;}
.blogs li a:hover{text-decoration:none; background:#f9f9f9;}
.blogs li .t{position: absolute;right: 5px;top: 5px;border-radius: 5px;display: inline-block;background: whiteSmoke;padding: 0px 5px;height: 20px;line-height: 20px;font-size: 10px;width: 150px;text-align: center;text-shadow: 1px 1px 0px white;}


.blogs .pt-next {left: 10px;bottom: 5px;height: 30px;line-height: 30px;text-align: center;border: 1px solid #E5E5E5;background-color: whiteSmoke;text-shadow: 1px 1px 0px white;margin: 10px 0px 0px 0px;}
.blogs .pt-next a {display: block;height: 30px;line-height: 30px;}
</style>
<div>
<h3 style="padding: 5px 10px;background: #F6F6F6;color: #0399BE;margin: 5px 5px 10px 5px;">Blogs - บทความ</h3>
<ul class="blogs" id="getblogs"><?php echo $this->getblogs?></ul>
<div class="clear"></div>
</div>