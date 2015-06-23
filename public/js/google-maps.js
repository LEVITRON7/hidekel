$( document ).ready(function() {
	if($('#map_canvas').length){
	var marker;
	var map;
	var currentlocation = {latitude: 21.168, longitude: -86.85};
    //Se carga todo maps con las opciones
    var myLatlng = new google.maps.LatLng(currentlocation.latitude,currentlocation.longitude);

    var mapOptions = {
        center: myLatlng,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map($("#map_canvas")[0], mapOptions)
    //map = new google.maps.Map($("#map_canvas2")[0], mapOptions)
    debugger;
/************** Se crear el marker para la ubicacion del evento**********/
	marker = new google.maps.Marker({
	    position: myLatlng,
	    draggable:true,
	    map : map,
	    animation: google.maps.Animation.DROP
	})
	marker.setMap(map);

    google.maps.event.addListener(marker,'dragend', function(a){
        console.log(a)
        var evento = {
            latitude: a.latLng.A,
            longitude: a.latLng.F
        };
        $('#location_latitude').val(evento.latitude)
        $('#location_longitude').val(evento.longitude)
        map.setCenter(marker.getPosition());
        console.log(evento)	        
    })
    /*Para poder desplegar el mapa dentro del model*/
	//google.maps.event.trigger(map, 'resize');

	$('#location_cancel').on('click',function(){
		$('#location_latitude').val('');
		$('#location_longitude').val('');
	});
 
	/*F*/
	$('#myModal').on('shown.bs.modal', function (){ 
		google.maps.event.trigger(map, 'resize',{})
		CenterMapToMarker(marker)

	})

	if(($('#location_latitude').length) && $('#location_longitude').length) {
		//debugger
		var location_latitude = $('#location_latitude').val();
		var location_longitude = $('#location_longitude').val();
		if((location_latitude!='')&&(location_longitude!='')){
			var latlng = new google.maps.LatLng(location_latitude , location_longitude);
			marker.setPosition(latlng);
		}
	};

	function getLocation(){
    	if (navigator.geolocation) {
        	navigator.geolocation.getCurrentPosition(SetPositionToMarker)
    	} else {
        	alert("Geolocation is not supported by this browser.")
        	$('#location-browser').append("Geolocation is not supported by this browser.")
    	}
	}

	function SetPositionToMarker(position) {
	    $('#location-browser').append("Latitude: " + position.coords.latitude + 
	    "<br>Longitude: " + position.coords.longitude)
	    	currentlocation = {	latitude: position.coords.latitude,
	    						longitude: position.coords.longitude
	    					};
			console.log(currentlocation);
	    	ChangeLocationOfMarker(currentlocation,marker);
	    	//LocationMarkerToMap();
	    	
	}

	function LocationMarkerToMap() {
		if ($('#location_latitude').val() !== undefined || $('#location_longitude').val()!==undefined) {
 			var position = { latitude: $('#location_latitude').val(), longitude: $('#location_longitude').val()};
 			//console.log(position);
 			ChangeLocationOfMarker(position,marker)
		};
	}
	function ChangeLocationOfMarker(position, marker){
		var latlng;
		console.log(position);
		if (position.latitude != null) {
			latlng = new google.maps.LatLng(position.latitude , position.longitude);
			console.log(latlng);
		}else{
			latlng = new google.maps.LatLng(currentlocation.latitude , currentlocation.longitude);
		}
		console.log('latlng of ChangeLocationOfMarker: ' + latlng);
		marker.setPosition(latlng);
		console.log(map)
		map.setCenter(latlng);
	 	map.panTo(marker.getPosition());
	}

	function CenterMapToMarker(marker) {
	    map.setCenter(marker.getPosition());
	}
    	var element = LocationContainString(location.pathname,['show']);
    	//console.log('element' + element + location.pathname);
    	if (element == 'show') {
    		marker.setDraggable(false);
    		console.log('ddradasds')
    	};

	function LocationContainString(string, contain){
	    var a = '';
	    contain.forEach(function(element){
	        if(string.indexOf(element)!==-1){
	            a = element;
	        }
	    })
	    return a;
	}
   	getLocation();
    	console.log('google-maps.js is loaded');
	}else{
		console.log('google-maps.js is not loaded');
	}
});