<?php 
$txt=($this->isbkk?'':'อำเภอ').$this->place['n'].' ';
$txt.=($this->isbkk?'':'จังหวัด').$this->place['tt']['t2']['n'].' ';
$txt.='ประเทศไทย';
?>
<div><?php echo $txt?><br><?php echo $this->place['n']?> ประกอบด้วย <?php echo count($this->dist)?> ตำบล ได้แก่<br>
<?php for($i=0;$i<count($this->dist);$i++):?><?php echo $i>0?', ':''?><a href="/<?php echo $this->dist[$i]['tt']['t2']['lk']?>/<?php echo $this->dist[$i]['tt']['t3']['lk']?>/<?php echo $this->dist[$i]['lk']?>" title="<?php echo $this->dist[$i]['n'].($this->isbkk?'':' '.$this->dist[$i]['q'])?>"><?php echo $this->dist[$i]['n']?></a><?php endfor?>
</div>
 
<?php if($this->place['d']):?>
<div><?php echo $this->place['d']?></div>
<?php endif?>



<?php if(count($this->news)):?>
<h4>ข่าว<?php echo $this->place['n']?>ล่าสุด</h4>
<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
<?php endif?>


<?php if($this->place['loc']):?>
<h3 style="height: 34px;line-height: 34px;padding: 0px 10px;background: #f0f0f0;margin: 0px 0px 5px;"><a href="http://weather.boxza.com/" target="_blank">สภาพอากาศ</a> <small><?php echo $txt?></small></h3>
<div id="maps" style="height:300px;"></div>
<div>แผนที่ <?php echo $txt?></div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>
<script type="text/javascript">
$(window).load(
function(){
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(<?php echo $this->place['loc'][0]?>,<?php echo $this->place['loc'][1]?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('maps'),mapOptions);

  var weatherLayer = new google.maps.weather.WeatherLayer({
    temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
  });
  weatherLayer.setMap(map);

  var cloudLayer = new google.maps.weather.CloudLayer();
  cloudLayer.setMap(map);
});
</script>
<?php endif?>