

<div><?php echo $this->place['n']?> ประกอบด้วย <?php echo count($this->amp)?> อำเภอ ได้แก่<br>
<?php for($i=0;$i<count($this->amp);$i++):?><?php echo $i>0?', ':''?><a href="/<?php echo $this->amp[$i]['tt']['t2']['lk']?>/<?php echo $this->amp[$i]['lk']?>" title="<?php echo $this->amp[$i]['n'].($this->isbkk?'':' '.$this->amp[$i]['q'])?>"><?php echo $this->amp[$i]['n']?></a><?php endfor?>
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


<h3 style="height: 34px;line-height: 34px;padding: 0px 10px;background: #f0f0f0;margin: 0px 0px 5px;"><a href="http://weather.boxza.com/place/<?php echo $this->weather['_id']?>" target="_blank">สภาพอากาศ<?php echo $this->weather['name']?></a> <?php echo $this->weather['en']?'('.$this->weather['en'].')':''?></h3>
<?php if($this->weather['loc']):?>
<div id="maps" style="height:300px;"></div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>
<script type="text/javascript">
$(window).load(
function(){
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(<?php echo $this->weather['loc'][0]?>,<?php echo $this->weather['loc'][1]?>),
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
<div style="padding:5px 10px">อุณหภูมิ: <strong><?php echo $this->weather['today']['t1']?></strong> (ข้อมูลจากกรมอุตุนิยมวิทยา)</div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<?php if($this->weather['list']):?>
<h4 style="height: 30px;line-height: 30px;padding: 0px 10px;background: #f0f0f0;margin: 0px;"><a href="http://weather.boxza.com/place/<?php echo $this->weather['_id']?>" target="_blank">พยากรณ์อากาศ<?php echo $this->weather['name']?></a> <?php echo $this->weather['en']?'('.$this->weather['en'].')':''?> วันนี้, พรุ่งนี้ และภายใน 2 วันของหน้า</h4>

<table class="table tbweather" width="100%">
<thead>
<tr>
<th>วัน</th>
<th>เช้า</th>
<th>กลางวัน</th>
<th>เย็น</th>
<th>กลางคืน</th>
<th>อุณหภูมิเฉลี่ย</th>
<th>สภาพอากาศ</th>
</tr>
</thead>
<tbody>
<?php $i=0;foreach($this->weather['list'] as $v):?>
<tr>
<td><?php echo time::show($v['dt'],'date')?></td>
<td><?php echo $v['temp']['morn']?> &deg;C</td>
<td><?php echo $v['temp']['day']?> &deg;C</td>
<td><?php echo $v['temp']['eve']?> &deg;C</td>
<td><?php echo $v['temp']['night']?> &deg;C</td>
<td><?php echo $v['temp']['min']?> - <?php echo $v['temp']['max']?> &deg;C</td>
<td><i class="icn-wt icn-wt<?php echo $v['icon']?>" title="<?php echo $v['weather']['main']?> - <?php echo $v['weather']['description']?>"></i></td>
</tr>
<?php if($i>=3)break;$i++;endforeach?>
</tbody>
</table>
<?php endif?>


