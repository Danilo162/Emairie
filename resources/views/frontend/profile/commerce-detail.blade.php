@extends('frontend.layouts.main')
@section('content')
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script defer src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/perso.css')}}">

<ul class="breadcrumb no-border no-radius b-b b-light pull-in" style="padding: 5px 0px;margin:0px;margin-top:6px;"> 
    <li><a href="{{route('etatcivil')}}"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active">Commerces</li> 
</ul> 

<div id="main" class="clearfix" style=" border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile" style="padding-top: 0px;">

        @include('frontend.profile.menu')
        <div class="col-md-9">

            <div class="profile-content">

                <!--header class="panel-heading h4" style="border-bottom: 1px solid #eee;margin-bottom: 20px;"> DÉTAILS D'UNE DEMANDE</header--> 

            <div style="background: url({{ $data->picture?asset('storage/'.$data->picture):asset('images/baa.jpg')}}) no-repeat;
                height: 300px;background-size: cover"></div>
                <h4>{{$data->raison_social}}</h4>
                <table class="table table-bordered table-striped" style="margin-top: 10px;" >

                    <tbody>
                    <tr><td style="font-size: 11px;width: 25%">Raison sociale </td><td > {{$data->raison_social}}</td></tr>

                    <tr><td style="font-size: 11px">Contact </td><td > {{$data->phone}}</td></tr>
                    <tr><td style="font-size: 11px">Email </td><td > {{$data->email}}</td></tr>
                    <tr><td style="font-size: 11px">Commune </td><td > {{$data->commune}}</td></tr>
                    <tr><td style="font-size: 11px">Quartier </td><td > {{$data->quartier}}</td></tr>
                    <tr><td style="font-size: 11px">Description </td><td > {{$data->description}}</td></tr>
                    <tr><td style="font-size: 11px">Type </td><td > {{$data->type_commerce}}</td></tr>
                    <tr><td style="font-size: 11px">Zone </td><td > {{$data->zone}}</td></tr>
                    <tr><td style="font-size: 11px">Detail localisation </td><td > {{$data->detail_localisation}}</td></tr>

                    </tbody>
                </table>
                <br>

                <div id='map' style='width: 100%; height: 350px;'></div>
            </div>
        </div>
    </div>
    </div>


    <script >
        $(document).ready(function () {
         /*   $('#forfait').select2({});
            getTaxeInfos($("#commerce").val())*/

            var la = '{{$data->latitude}}';
            console.log(la)
                @if($data->latitude)
            var tab = [{{$data->longitude}},{{$data->latitude}}];
            mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuaWxvMTYxIiwiYSI6ImNrNGJ0eXNjbTBkYmQza3BiaGV4bmt1cHYifQ.PpnCmI4X16kM6hc40Fv_yQ';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
                center: tab, // starting position [lng, lat]
                zoom: 11 // starting zoom
            });
            var marker = new mapboxgl.Marker()
                .setLngLat(tab)
                .addTo(map);
            map.addControl(new mapboxgl.NavigationControl());
            // your code that shows the map div
            $('#map').show();

// detect the map's new width and height and resize it
            map.resize();
            @endif

        });

    </script>
@endsection

