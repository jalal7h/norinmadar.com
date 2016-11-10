<?

# jalal7h@gmail.com
# 2015/10/17
# Version 1.2.2

# $list = array(
# 	'width' => '360px',
#	'height' => '360px',
#	'x,y' => '36.444444,59.000000',
#	'disable_marker' => true,
# );
# echo google_maps($list);

function google_maps($list){
	# 
	# fix variable
	$input_id = "google_maps".rand(100000,999999);
	$xy = explode(",", $list['x,y']);
	$x = $xy[0];
	$y = $xy[1];
	#
	# generate the content
	$c.= '
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<div id="map"style="width: '.$list['width'].'; height: '.$list['height'].'; direction:ltr;" ></div>
	<script type="text/javascript">
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		var map;
		var iconimage = "/map_icon.png";
		var iconshadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
		var myOptions = {
			zoom: 14,
			center: new google.maps.LatLng( '.$x.' , '.$y.' ),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: true
		};
		//
		//
		var map = new google.maps.Map(document.getElementById("map"), myOptions);
		// global infowindow object
		var globalInfowindow = new google.maps.InfoWindow();
		function cleardirs()
		{
			if(directionsDisplay)
			directionsDisplay.setMap(null);
			div = document.getElementById(\'directions_div\');
			if(div)
				div.innerHTML = "";
		}
		//
		// point the place
		var marker, old_marker;
		'.($list['disable_marker']!=true?'
		google.maps.event.addListener(map, \'click\', function(event){
			if(old_marker){
				old_marker.setMap(null);
			}
			marker = new google.maps.Marker({position: event.latLng, map: map});
			old_marker = marker;
			// console.log( event.latLng.lat() + " , " + event.latLng.lng() );
			$("#'.$input_id.'").val( event.latLng.lat() + "," + event.latLng.lng() );
		});
		':'').'
		old_marker = new google.maps.Marker({position: {lat: '.$x.', lng: '.$y.'}, map: map});
	</script>
	<input type="hidden" name="google_maps[]" id="'.$input_id.'" value="'.$x.','.$y.'" />';

	return $c;
}




