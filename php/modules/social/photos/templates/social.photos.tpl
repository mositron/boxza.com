
<style>
.pf { min-height:100px !important}
.photos{margin:0px 0px 0px 0px; position:relative}
.photos > li{width:210px; text-align:center; border:1px solid #e5e5e5; border-radius:3px; box-shadow:0px 0px 3px #eee; position:absolute}
.photos > li:hover{border:1px solid #ccc; box-shadow:0px 0px 5px #ddd;}
.photos > li > div {width:200px; margin:5px; position:relative}

.pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}

.pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
.pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}

.photos .i img{border-top-left-radius: 3px;border-top-right-radius: 3px;}


.photos .av img{width: 22px;height: 22px;margin: 2px;float: left;/*border-radius: 11px;*/}
.photos .av{width:26px; height:26px; }
.photos .av a{display: block;width: 26px;height: 26px;/*border-radius: 13px;*/}
.photos .d{ padding:3px 3px 5px 3px; background-color:#f6f6f6; margin:3px 0px 3px 0px;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px; text-shadow:1px 1px 0px #fff;}
.photos .d h4{float:left; margin:5px 0px 0px 5px; color:#0399BE;width: 160px;overflow: hidden;white-space:nowrap; text-overflow: ellipsis; }

.photos .c .av{margin-left:3px}
.photos .c > div{ height:30px; line-height:30px; overflow:hidden;width:200px; border-bottom:1px solid #ececec; border-top: 1px solid#fff; background-color:#f8f8f8; text-align:left}
.photos .c p{ margin:0px 0px 0px 35px; width:160px; overflow:hidden; white-space:nowrap; text-overflow: ellipsis; }

.myalbum > li{margin:5px 0px 5px 10px}

.myalbum ul li{float:left; margin:5px 5px 10px 5px;line-height:0px;}
.myalbum ul li a{display:block;border:1px solid #ddd; padding:5px; box-shadow:5px 5px 0px #f0f0f0; }
.myalbum ul li a:hover{box-shadow:5px 5px 0px #ddd;}
.myalbum h4{background:#F3F8F9; padding:0px; margin:0px 10px 0px 0px; text-shadow:1px 1px 0px #fff;}
.myalbum h4 .button{float:right}
.myalbum h4 a{float:left; margin:8px 0px 5px 10px;}
</style>
<div>
<?php if(isset($this->myalbum)):?>
<h3 style="padding: 5px 10px;background: #F6F6F6;color: #0399BE;margin: 5px 5px 10px 5px;">รูปภาพของคุณ</h3>
<ul class="myalbum"><?php echo $this->myalbum?></ul>
<?php endif?>

<h3 style="padding: 5px 10px;background: #F6F6F6;color: #0399BE;margin: 5px 5px 10px 5px;">รูปภาพของเพื่อน</h3>
<ul class="photos" id="getphotos"><?php echo $this->getphotos?></ul>
<div class="clear"></div>
</div>