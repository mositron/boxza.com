<style>
.gsc-input input{box-shadow:none !important;}
.search-h1 {
height: 36px;
margin: 0px 0px 5px;
padding: 0px 10px;
line-height: 36px;
font-size: 18px;
}
.cse .gsc-control-cse, .gsc-control-cse{padding:0px;}
</style>
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->


<h1 class="search-h1">ค้นหาข้อมูล</h1>


<script>
(function() {
var cx = '005271380156275684242:smohuf4bdps';
var gcse = document.createElement('script');
gcse.type = 'text/javascript';
gcse.async = true;
gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	'//www.google.com/cse/cse.js?cx=' + cx;
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(gcse, s);
})();
</script>


<gcse:search></gcse:search>