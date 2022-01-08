
<script>

    let infoObj = []; 
    let map ; 
    let titles = [];
    let markers = [];

    function myMap3() {
        var mapCanvas = document.getElementById("map3");
        var mapOptions = {
            center: new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'),
            zoom: 14,
            mapTypeId: "roadmap",
        };
        map = new google.maps.Map(mapCanvas, mapOptions);

        var circle = new google.maps.Circle({
            center:new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'), 
            radius: parseInt('{{ $event->area}}'), 
            fillColor: "#0000FF", 
            fillOpacity: 0.3, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        @foreach($event->cawaders as $cader) 
            titles.push({
                'id' : '{{ $cader->user_id }}',
                'lat' : '{{ $cader->latitude}}',
                'lng' : '{{ $cader->longitude}}',
                'name' : '{{ $cader->user->name}}',
                'photo' : '@if ($cader->user && $cader->user->photo) {{ str_replace("public/public","public",asset($cader->user->photo->getUrl("thumb"))) }} @endif'
            });
        @endforeach
        
        for(var i = 0; i < parseInt('{{ $event->cawaders()->get()->count() }}') ; i++){ 
            var contentString = '<img style="padding:8px" src="' + titles[i].photo + '"> <h5>' + titles[i].name + '</h5> '; 

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(titles[i].lat, titles[i].lng), 
                map:map,
                title:titles[i].id, 
            });

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200,
            });

            marker.addListener("click", function(){
                closeOtherInfo();
                infowindow.open(map,marker);
                infoObj[0] = infowindow;
            }); 
            markers.push(marker);
        }
    }
    google.maps.event.addDomListener(window, 'load', myMap3); 
    function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

        for (var i = 0; i < arraytosearch.length; i++) {

            if (arraytosearch[i][key] == valuetosearch) {
                return i;
            }
        }
        return null;
    } 

    function zoomInMap(cader_id){
        
        $.post('{{ route('admin.events.partials.zoominmap') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id}, function(data){  
            var pt = new google.maps.LatLng(data['lat'], data['lng']);
            map.setCenter(pt);
            map.setZoom(18);
        });
    }
    function closeOtherInfo(){
        if(infoObj.length > 0){
            infoObj[0].set('marker',null);
            infoObj[0].close();
            infoObj[0].length = 0; 
        }
    }
    function addmarker(lat,lng,title = ''){
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
            circles[i].setMap(null);
        }

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat,lng), 
            map,
            title: title,
        });
        markers.push(marker);
        
        var circle = new google.maps.Circle({
            center:new google.maps.LatLng(lat,lng), 
            radius: parseInt($('#area').val()), 
            fillColor: "#0000FF", 
            fillOpacity: 0.2, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        circles.push(circle);
    }
</script>

<script>
    var channel = pusher.subscribe('stream-location');

    channel.bind('App\\Events\\ChangeLocation',function(obj){ 
        
        var index = functiontofindIndexByKeyValue(markers, "title", obj['user_id']);
        
        markers[index].setPosition(new google.maps.LatLng(obj['latitude'], obj['longitude']))
        if(obj['alert_out_of_zone'] == 1){
            var title = 'خارج نطاق الفعالية';
            var message = 'الكادر ' + obj['name'];
            showFrontendAlert('warning', title, message); 
        }
    });
    function cader_attendance(cader_id){
        $('#attendance_modal').modal('show') 
        $.post('{{ route('admin.events.partials.attendance_cader') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){ 
            $('#attendance_modal .modal-body').html(null);
            $('#attendance_modal .modal-body').html(data);
        });
    } 
    function cader_break(cader_id){
        $('#cader_break_modal').modal('show') 
        $.post('{{ route('admin.events.partials.cader_break') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){
            $('#cader_break_modal .modal-body').html(null);
            $('#cader_break_modal .modal-body').html(data);
        });
    } 
</script>