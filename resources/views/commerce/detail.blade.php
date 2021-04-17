@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{asset('select2/css/select2.css')}}" type="text/css">
{{--    <link rel="stylesheet" href="{{asset('css/mapbox-gl.css')}}" type="text/css">--}}


    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        /*.bootstrap-table .fixed-table-toolbar .columns-right{*/
        /*      float: left !important;*/
        /*  }*/
        /*  .bootstrap-table .fixed-table-toolbar .search {*/
        /*      float: left !important;*/
        /*  }*/
        .padding-10 {
            padding: 10px !important;
        }
   .fs-14{
       font-size: 14px !important;
   }
        /*.input-group .form-line{*/
        /*    border-bottom: none;*/
        /*}*/
        /*.input-group .form-control{*/
        /*    border-bottom: 1px solid #ddd;*/
        /*}*/
    </style>

    <div class="container-fluid" id="contenaire">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card col-lg-12">
       <div class="body" style="background: #fefafa14">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                      <a href="#home_with_icon_title" data-toggle="tab" aria-expanded="true">
                          <i class="fa fa-user"></i> PROFIL
                      </a>
                  </li>
                  <li role="presentation" class=" col-white col-red">
                      <a href="#commerce_taxe" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-money-bill "></i> LISTE DE MES TAXES
                      </a>
                  </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content padding-10 " style="background: white">
                  <div role="tabpanel" class="tab-pane fade active in head_build bg-effet" id="home_with_icon_title">

                      <div class="row">
                        <div class="col-lg-10" style="margin-bottom: 0 !important;">
                          <h4 class="" style="text-transform: uppercase">
                              <span style="font-size:14px;">
                              Informations personnelles
                                  </span>
                           <span style="font-size: 18px" class="orange-text">
                           {{$data->raison_social}}
                           </span>
                          </h4>
                        </div>
                      </div>
                      <div class="col-lg-12" >
                          <br>
                          <table class="table table-bordered table-striped">
                          <tr>
                              <td colspan="1">
                                  <img style="width: 150px;border-radius: 5px"
                                  src="{{img_agent($data->picture)}}"
                                  alt="{{$data->raison_social}}"></td>
                              <td>
                                  <div class="row">
                                      <div class="col-lg-6" style="line-height: 50px">
                                          @if($taxeInfos) Taxe: {{$taxeInfos->amount}} ({{$taxeInfos->taxe}}) @endif
                                              <br>
                                              {{$data->type_commerce}}
                                      </div>

{{--                                      <div class="col-lg-3">--}}
{{--                                          @if($taxeInfos) {{$taxeInfos->amount}} ({{$taxeInfos->taxe}} | @endif--}}
{{--                                      </div>--}}
                                      @can("Changer fortfait taxe commerce")
                                      <div class="col-lg-4">
                                          <div class="panel panel-primary">
                                              <div class="panel-heading" role="tab" id="headingThree_1">
                                                  <h4 class="panel-title">
                                                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false"
                                                         aria-controls="collapseThree_1">
                                                              Gerer le forfait taxe <i class="fa fa-arrow-down"></i>
                                                      </a>
                                                  </h4>
                                              </div>
                                              <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1">
                                                  <div class="panel-body">
                                                      <form action="" id="frmChangeForfait"
                                                            @submit.prevent="store_forfait"
                                                            method="POST" >
                                                      <select required id="forfait" name="forfait"
                                                              class="form-control">
                                                          <option>-- SELECT ---</option>
                                                          @foreach($allForfaits as $allForfait)
                                                          <option @if($taxeInfos && $taxeInfos->id==$allForfait->id) selected @endif value="{{$allForfait->id}}">{{$allForfait->taxe}} - {{$allForfait->amount}} XOF</option>
{{--                                                          @foreach ($communes as $commune)--}}
{{--                                                              <option value="{{ $commune->id }}">{{ $commune->name }}</option>--}}
{{--                                                          @endforeach--}}
                                                          @endforeach
                                                      </select>
                                                      <br>
                                                      <br>

                                                          <button type="submit" class="btn btn-primary waves-effect submitbtn">Valider</button>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      @endcan
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 150px">Raison sociale</td>
                              <td><b>{{$data->raison_social}}</b></td>
                          </tr>
                          <tr>
                              <td>Propriétaire</td>
                              <td><b>{{$data->administred}}</b></td>
                          </tr>

                          <tr>
                              <td>Type de commerce</td>
                              <td>{{$data->type_commerce}}</td>
                          </tr>
                              <tr>
                              <td>Zone</td>
                              <td>{{$data->zone}}</td>
                          </tr>
                            <tr>
                              <td>Quartier </td>
                              <td>{{$data->quartier}}</td>
                          </tr>
                           <tr>
                              <td>Commune </td>
                              <td>{{$data->commune}}</td>
                          </tr>
                              <tr>
                                  <td>Description </td>
                                  <td>{{$data->description}}</td>
                              </tr>
                              @if($data->register_user)
                              <tr class="bg-secondary">
                                  <td>Enregistré par  </td>
                                  <td>{{$data->register_user}} | {{d_format($data->created_at)}}</td>
                              </tr>
                              @endif

                          </table>
                          <br>
                          <br>

                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="" style="height: 200px" id="echart_pie_taxe_commerce"></div>
                              </div>
                              <div class="col-lg-6">
                                  <div id='map' style='width: 100%; height: 200px;'></div>
                              </div>
                          </div>

                      </div>

                  </div>
                  <div role="tabpanel" class="tab-pane fade " id="commerce_taxe">

                   <div class="head_build bg-effet">
                      <h4>   <b>LISTE DE MES TAXES : <span class="text-theme"></span></b></h4>
                   </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <div class=" table_custom">

                                  <table id="table"
                                         class="table table-bordered table-hover table-responsive table-striped"
                                         data-toggle="table"
                                         data-toolbar="#toolbar"
                                         data-click-to-select="true"
                                         data-single-select="true"
                                         data-url="{{ route('console.taxecommerce.index').'?commerce='.$data->id}}"
                                         data-side-pagination="server"
                                         data-show-copy-rows="true"
                                         data-pagination="true"
                                         data-trim-on-search="false"
                                         data-page-size="5"
                                         data-page-list="[5, 10, 20, 50, 100, 200]"
                                         data-search="true"
                                         data-show-print="true"
                                         data-show-refresh="true"

                                         data-show-pagination-switch="false"
                                  >
                                      <thead>
                                      <tr>
                                          <th class="small" data-cell-style="cellStyle" data-field="taxe" data-sort="true">Taxe</th>
                                          <th class="small" data-cell-style="cellStyle" data-field="month" data-sort="true">Mois</th>
                                          <th class="small" data-cell-style="cellStyle" data-field="amount_prev" data-sort="true">Montant prevu ($)</th>
                                          <th class="small" data-cell-style="cellStyle" data-field="amount_paided" data-sort="true">Montant payé ($)</th>
                                          <th class="small" data-cell-style="cellStyle" data-field="date_paided"  data-sort="true">Date payé ($)</th>
                                          <th class="small" data-cell-style="cellStyle" data-field="user_paided" data-sort="true">payé par </th>
{{--                                          <th data-field="comment" data-sort="true">Commentaire</th>--}}

                                      </tr>
                                      </thead>

                                  </table>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>

                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="relance_to_sms" value="{{route('console.taxecommerce.relance_to_sms')}}">
    <input type="hidden" id="choose_forfait" value="{{route('console.commerce.choose.forfait')}}">
    <input type="hidden" id="taxe_statistique" value="{{route('console.taxecommerce.statistique')}}">
    <input type="hidden" id="commerce" value="{{$data->id}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('select2/js/select2.full.min.js')}}"></script>

    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"  type="text/javascript"></script>

    <script src="{{ asset('echartjslib/config.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('echartjslib/esl.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('js/console/commerce_detail.js') }}"  type="text/javascript"></script>
{{--    <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>--}}
{{--    <script src='{{asset('js/mapbox-gl.js')}}' type="text/javascript" ></script>--}}
    <script >
        $(document).ready(function () {
             $('#forfait').select2({});
            getTaxeInfos($("#commerce").val())

            var la = '{{$data->latitude}}';
             console.log(la)
            @if($data->latitude)
            var tab = [{{$data->longitude}},{{$data->latitude}}];
            mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuaWxvMTYxIiwiYSI6ImNrNGJ0eXNjbTBkYmQza3BiaGV4bmt1cHYifQ.PpnCmI4X16kM6hc40Fv_yQ';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
                center: tab, // starting position [lng, lat]
                zoom: 16 // starting zoom
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


