<ul class="breadcrumb">
<li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['tt']['t1']['lk']?>" title="<?php echo $this->place['tt']['t1']['n']?>"><?php echo $this->place['tt']['t1']['n']?></a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['tt']['t2']['lk']?>" title="<?php echo $this->place['tt']['t2']['n']?> จังหวัด<?php echo $this->place['tt']['t2']['n']?> <?php echo $this->place['tt']['t1']['n']?>"><?php echo $this->place['tt']['t2']['n']?></a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['tt']['t2']['lk']?>/<?php echo $this->place['tt']['t3']['lk']?>" title="<?php echo $this->place['tt']['t3']['lk']?> <?php echo $this->place['tt']['t2']['n']?> จังหวัด<?php echo $this->place['tt']['t2']['n']?> <?php echo $this->place['tt']['t1']['n']?>"><?php echo $this->place['tt']['t3']['n']?></a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['tt']['t2']['lk']?>/<?php echo $this->place['tt']['t3']['lk']?>/<?php echo $this->place['tt']['t4']['lk']?>" title="<?php echo $this->place['tt']['t4']['n']?> <?php echo $this->place['tt']['t3']['lk']?> <?php echo $this->place['tt']['t2']['n']?> จังหวัด<?php echo $this->place['tt']['t2']['n']?> <?php echo $this->place['tt']['t1']['n']?>"><?php echo $this->place['tt']['t4']['n']?></a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['lk']?>" title="<?php echo $this->place['n']?> <?php echo $this->place['ne']?>"><?php echo $this->place['n']?></a></li>
</ul>



<div class="row-fluid">
<div class="span4">
<div class="ab">
<div class="text-center">
<img src="http://s3.boxza.com/place/<?php echo $this->place['fd']?>/t.jpg" alt="<?php echo $this->place['n']?>">
</div>
</div>


<?php if(count($this->near)>0):?>
<table width="100%" class="table table-condensed table-hover">
<caption>สถานที่ใกล้กับ<?php echo $this->place['n']?></caption>
<thead>
<tbody>
<?php foreach($this->near as $v):?>
<tr>
<td><i class="icon-th-list"></i></td>
<td><a href="<?php echo '/'.$v['lk']?>" target="_blank"><?php echo $v['n']?></a></td>
<td class="text-center"></td>
</tr>
<?php endforeach?>
</tbody>
</table>
<?php endif?>

</div>
<div class="span8">
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
<h3><?php echo $this->place['n']?><?php if(_::$my['am']):?> <small>(<a href="/admin/<?php echo $this->place['_id']?>">แก้ไข</a>)</small><?php endif?></h3>


<div>
<strong><?php echo $this->place['n']?></strong>: สถานที่ประเภท <?php echo $this->cate[$this->place['c']]['t']?><br>

<div>ที่อยู่:
<?php if($this->place['addr']):?>
<?php echo nl2br($this->place['addr'])?>
<?php else:?>
<?php if($this->place['tt']):$bkk=($this->place['tt']['t2']['n']=='กรุงเทพมหานคร');?> 
<?php if($this->place['tt']['t4']):?><?php echo ($bkk?'':'ตำบล').$this->place['tt']['t4']['n']?> <?php endif?>
<?php if($this->place['tt']['t3']):?><?php echo ($bkk?'':'อำเภอ').$this->place['tt']['t3']['n']?> <?php endif?>
<?php if($this->place['tt']['t2']):?><?php echo ($bkk?'':'จังหวัด').$this->place['tt']['t2']['n']?> <?php endif?>
<?php endif?>
<?php echo $this->place['zip']?>
<?php endif?>
</div>
<?php if($this->place['op']):?><div>เวลาเปิด/ปิด: <?php echo nl2br($this->place['op'])?></div><?php endif?>
<?php if($this->place['ph']):?><div>เบอร์โทรศัพท์: <?php echo nl2br($this->place['ph'])?></div><?php endif?>
</div>
 
<?php if($this->place['d']):?>
<div><?php echo $this->place['d']?></div>
<?php endif?>

<?php if($this->place['loc'][0]):?>
<h4 style="height: 28px;line-height: 28px;padding: 0px 10px;background: #f0f0f0;margin: 0px 0px 5px;">สภาพอากาศที่<?php echo $this->place['n']?> <small>อุณหภูมิที่<?php echo $this->place['n']?></small></h4>
<div id="maps" style="height:300px;"></div>
<div>แผนที่<?php echo $this->place['n']?></div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>

 <div style="border:1px solid #ccc; border-radius:3px; padding:10px; margin-top:10px;">
      <h4>คำนวนการเดินทาง <small>วิธีเดินทางไปยัง <?php echo $this->place['n']?> จากตำแหน่งที่คุณอยู่บนแผนที่</small></h4>
       <label for="insertaddress">ใส่ชื่อสถานที่ที่คุณอยู่ ณ ปัจจุบัน:</label> <input type="text" class="tbox show-tooltip-e" id="insertaddress" style="font-size:16px; width:300px;" name="q" value="" title="<div style='text-align:left;color:#fff'>สามารถใช้ ชื่อสถานที่, ซอย, ถนน, ตำบล, อำเภอ, รหัสไปรษณีย์ ในการค้นหา</div>"> <input type="button" onClick="codeAddress(false)" class="btn" value=" ค้นหา "><br>
       <div id="showlocation"></div>
      หรือ <input type="button" class="btn btn-success" onClick="_map.getcurposition()" value="คลิกที่นี่ เพื่อค้นหาแบบอัตโนมัติ">
      <hr class="ln" />
      <h3>วิธีการเดินทางไปยัง <?php echo $this->place['n']?>  <span id="showfb"></span> <span id="showurl"></span></h3>
      <div id="mapresult" class="qlist"><i style="text-align:center; display:block">- รอยืนยันข้อมูล -</i></div>
</div>          





<style type="text/css">
.route label{margin-left:5px}
.qlist a{display:block; height:18px; line-height:18px;}
.qlist a:hover{ background:#09F; color:#FFF}
.route h3{color:#F90; text-align:center}
.route h4{ padding:2px 10px;}
#showlocation{display:none; margin:5px 0px; border:1px solid #ccc; background:#f7f7f7; border-radius:10px; padding:5px;}
#mapresult > div{border:1px solid #ddd; border-radius:5px; margin:2px 0px; padding:5px 15px;}
#mapresult div.l1{background-color:#f9f9f9;}
#showurl{font-size:12px; font-weight:normal}
</style>
<div class="clear"></div>

<script type="text/javascript">
var _map={};
_map.rshow=function(a){
	if(!_map.rroute)
	{
		_map.rroute=new google.maps.DirectionsRenderer({directions:a,map:_map.map});
	}
	else
	{
		_map.rroute.setOptions({directions:a,map:_map.map});
	};
	var z='';
	_map.latlng=a.routes[0].legs[0].start_location.lat()+','+a.routes[0].legs[0].start_location.lng()+'';
	for(var i=0;i<a.routes[0].legs[0].steps.length;i++)
	{
		var b=a.routes[0].legs[0].steps[i];
		z+='<div class="l'+(i%2)+'">';
		z+=(i+1)+') '+b.instructions+(i<a.routes[0].legs[0].steps.length-1?'<br>':'');
		z+='ระยะทาง: '+b.distance.text+' - ใช้เวลา: '+b.duration.text+'';
		z+='</div>';
	};
	$('#mapresult').html(z);
}
_map.cal=function(to){_map.dserv.route({origin:to,destination:new google.maps.LatLng(<?php echo $this->place['loc'][0]?>,<?php echo $this->place['loc'][1]?>),travelMode:google.maps.DirectionsTravelMode.DRIVING},_map.rshow);}
_map.getcurposition=function(){if(navigator.geolocation) {navigator.geolocation.getCurrentPosition(function(position){_map.cal(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));});}}


var map;

function codeAddress(next)
{
	_map.geocoder.geocode({'address': $('#insertaddress').val()}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			_map.map.setCenter(results[0].geometry.location);
			showAddress(results[0]);
			if(_map.mcenter)
			{
				_map.mcenter.setMap(null);
				_map.mcenter=false;
			}
			_map.mcenter = new google.maps.Marker({map: _map.map,position: results[0].geometry.location});
			if(next)_map.cal(results[0].geometry.location);
		} 
		else 
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

function showAddress(results)
{
	getloc=new Object();
	var a='';
	if (results) 
	{
		var l=results.address_components;
		for(var i=0;i<l.length;i++)
		{
			switch(l[i].types[0])
			{
				case 'point_of_interest':
				case 'locality':
				case 'administrative_area_level_3':
				case 'administrative_area_level_1':
				case 'postal_code':
					a+=l[i].long_name+' , ';
			}
		}
		var b=results.geometry.location;
		a+='พิกัด: '+b.lat()+','+b.lng()+' ';
	}
	a+='<input type="button" value=" คำนวนการเดินทางจากตำแหน่งนี้ ไปยัง <?php echo $this->place['n']?> " size="50" class="btn btn-success" onclick="_map.cal(new google.maps.LatLng('+b.lat()+','+b.lng()+'));">';
	$('#showlocation').css({'display':'block'}).html(a);
}


$(function(){
	
	
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(<?php echo $this->place['loc'][0]?>,<?php echo $this->place['loc'][1]?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  _map.map = new google.maps.Map(document.getElementById('maps'),mapOptions);

  var weatherLayer = new google.maps.weather.WeatherLayer({
    temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
  });
  weatherLayer.setMap(_map.map);

  var cloudLayer = new google.maps.weather.CloudLayer();
  cloudLayer.setMap(_map.map);
  
	
	
	_map.marker = new google.maps.Marker({ map: _map.map,draggable: false});
	_map.marker.setPosition(mapOptions.center);
	_map.dserv=new google.maps.DirectionsService();
	_map.rroute=false;
	_map.geocoder = new google.maps.Geocoder();
	
	
});
</script>


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
</div>

</div>