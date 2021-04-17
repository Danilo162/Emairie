@extends('frontend.layouts.main')
@section('content')
{{--
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7/css/bootstrap.min.css')}}">
--}}
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script defer src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        .main{
         /*   margin-top:6px;*/
            border-top-left-radius:10px;
            border-top-right-radius:10px;background: url({{asset('images/bg.jpg')}}) no-repeat;
            background-size: cover;
            height: 350px;position: relative;
            padding-top: 0 !important;

        }

    </style>
    <div id="main" class="clearfix main"
         style="text-align: center">
        <div style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;
        height: 100%;z-index: 1;background: rgba(33,155,156,0.8);   border-radius: 10px;"></div>
<div style="text-align: center;width: 100%;padding: 40px;z-index: 2;position: relative">

    <div style="text-align: center;margin: 10px auto">
        <h3 style="text-align: center;font-weight: 900;color: white;font-size: 38px">Votre commune. Vos opportunités.</h3>

    </div>
    <div class="inner-wrap clearfix row" style="z-index: 2">
    <div class="primary col-lg-8">

        <form action="" style="padding: 10px;background: orange;color: white">
            <h5>Trouvez des <b>opportunités</b> </h5>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group ">
                    <select name="" id="" class="form-control">
                        <option value="">Type</option>
                    </select>
                        <small style="color: white;font-size: 10px">Annonce,Logement,Emploi...</small>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group ">
                    <select name="" id="" class="form-control">
                        <option value="">Secteur/Lieu</option>
                    </select>
                        <small style="color: white;font-size: 10px">Domaine d'activité </small>
                </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group ">
                    <input style="margin: 0" type="text" class="form-control" placeholder="Critère">
                        <small style="color: white;font-size: 10px">Saisissez vos mots clés</small>
                </div>
                </div>
                <div class="col-lg-3">
                   <button class="btn btn-primary btn-sm">RECHERCHER</button>
                </div>
            </div>
        </form>

    </div>
    <div class="secondary col-lg-4 bg-primary" style="background: #219b9c;color: white;text-align: left">

        <p> ANNONCE <b>A LA URNE</b> </p>
        <p>- Avis de décès : la grande famille Akossi et alliés ont ... <br>
            - Appartement à louer  : 3 à 4 pièces  ... <br>
        </p>

    </div>
    </div>

    </div>
</div>
<br>
<br>
<div class="row inner-wrap clearfix" style="height: 200px">
    <div class="col-lg-8">
        <section id="colormag_featured_posts_widget-2"
                 class="widget widget_featured_posts widget_featured_meta clearfix">
            <h3 class="widget-title" style="border-bottom-color:orange;"><span
                    style="background-color:orange;">Entreprises & Commerces</span>
                {{--   <a
                       href="" class="view-all-link">View All</a>--}}
            </h3>
            <div style="padding: 10px">
                <div class="row">
                    @foreach($commerces as $commerce)
                        <div class="col-lg-6">
                            <a href="{{route('entreprise.detail',["q"=>$commerce->id])}}">
                                <div  class="grid-commerce" style="background: url({{asset('storage/'.$commerce->picture)}});">
                                    <div class="listing-counter" >
                                        {{--  <span>7 </span>--}}
                                        {{$commerce->type}}</div>
                                    <div class="listing-info">
                                        <h3><a href="{{route('entreprise.detail',["q"=>$commerce->id])}}">{{$commerce->raison_social}}</a></h3>
                                        <div class="listing-term-desc"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-4">
        <div id='map' style='width: 100%; height: 100vh;'></div>
    </div>
</div>



<script >
    $(document).ready(function () {
        /*   $('#forfait').select2({});
           getTaxeInfos($("#commerce").val())*/

        var la = -11.56705030;
        console.log(la)

        var tab = [25.84993150,la];
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


    });

</script>

@endsection

