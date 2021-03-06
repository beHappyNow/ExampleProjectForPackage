@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {!! Form::open(array('route' => 'geocode_reverse', 'class' => 'form')) !!}
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('Address') !!}
                        {!! Form::text('lat', null,
                            array(  'required',
                                    'class'=>'form-control',
                                    'placeholder'=>'latitude')) !!}
                        {!! Form::text('lng', null,
                            array(  'required',
                                    'class'=>'form-control',
                                    'placeholder'=>'longitude')) !!}
                        <br/>

                        <select name="language" id="language">
                            <option value="en" selected="selected">English</option>
                            <option value="de">Deutsch</option>
                            <option value="ru">Русский</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::submit('Get info',
                        array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
                <br/>
                <br/>
                <br/>
                @if(isset($resp) && count($resp->results))
                    <h2>{{$resp->results[0]->formatted_address}}</h2>
                @elseif( isset($resp) && ($resp->status === "ZERO_RESULTS" || $resp->status === "INVALID_REQUEST"))
                    <h3>Вы ввели некорректные координаты</h3>
                @elseif( isset($resp) && $resp->status === "OVER_QUERY_LIMIT")
                    <h3>Вы превысили квоту по запросам.</h3>
                @elseif( isset($resp) && $resp->status === "REQUEST_DENIED")
                    <h3>Запрос был отклонен</h3>
                @else
                    <h3>К примеру</h3>
                    <h4>Latitude: 15.3925078 </h4>
                    <h4>Longitude: 73.799542 </h4>
                @endif

            </div>
            <div class="col-md-6">
                <div id="map"></div>
                <script type="text/javascript">

                    var map;
                    function initMap() {
                        @if(isset($resp) && count($resp->results))
                            var myLatLng = {lat: {{$resp->results[0]->geometry->location->lat}}  , lng: {{$resp->results[0]->geometry->location->lng}} };
                        @elseif(isset($coords))
                            var myLatLng = {lat: {{$coords->lat}} , lng: {{$coords->lng}} };
                        @else
                            var myLatLng = {lat: 47.8589992 , lng: 35.1049608 };
                        @endif
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: myLatLng,
                            zoom: 10
                        });
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: 'test'
                        });
                    }

                </script>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCec2CwLYjWoT3CqGDm5xjbMKfaaWLSfDc&callback=initMap" async="" defer=""></script>
        </div>
    </div>
@endsection