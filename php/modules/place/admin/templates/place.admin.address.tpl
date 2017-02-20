<ul class="breadcrumb">
  <li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการสถานที่</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขสถานที่
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">ดึงข้อมูลสถานที่อัตโนมัติ</h2>




<?php
/*
echo $this->place['n'];
if($this->place['tt']):
if($this->place['tt']['t4'])echo ' '.$this->place['tt']['t4']['n'];
if($this->place['tt']['t3'])echo ' '.$this->place['tt']['t3']['n'];
if($this->place['tt']['t2'])echo ' '.$this->place['tt']['t2']['n'];
endif;
*/
?>
<div>รอดึงข้อมูลถัดไป.. <span id="next"><?php echo $this->place['n']?> (<?php echo $this->place['_id']?>: <?php echo $this->place['address']?>)</span></div>
<div id="print_r"></div>
<div id="map_canvas" style="height:400px;"></div>

<link href="http://code.google.com/apis/maps/documentation/javascript/examples/standard.css" rel="stylesheet" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>
<script type="text/javascript">
var geocoder;
var map,_id,marker;
function initialize() 
{
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(90, 111);
	var myOptions = {
		zoom: 12,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	marker = new google.maps.Marker({map: map,position: latlng});
}


function startmap(id,addr)
{
	_id=id;
	geocoder.geocode( { 'address': addr}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			showAddress(results[0]);
			marker.setPosition(results[0].geometry.location);
//			var marker = new google.maps.Marker({map: map,position: results[0].geometry.location});
		} 
		else 
		{
			setTimeout(function(){window.location.href='<?php echo URL?>';},10000);
			//alert("Geocode was not successful for the following reason: " + status);
		}
	});
}
function showAddress(results)
{
	getloc=new Object();
	var a={},c='';
	if (results) 
	{
		var l=results.address_components;
		for(var i=0;i<l.length;i++)
		{
			a[l[i].types[0]]=l[i];
		}
		var b=results.geometry.location;
		//b=b.split(',')
		c+='ผลลัพธ์: '+b.lat()+','+b.lng()+'<br>';
		c+=JSON.stringify(a);
		
	}
	_.ajax.gourl('<?php echo URL?>','setlatlng',{'_id':_id,'loc':[b.lat(),b.lng()]})
	$('#print_r').html(c);
}

$(function(){
initialize();
setTimeout(function(){startmap(<?php echo $this->place['_id']?>,'<?php echo $this->place['address']?>');},5000);
});
</script>