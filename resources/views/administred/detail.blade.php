@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{asset('select2/css/select2.css')}}" type="text/css">
{{--    <link rel="stylesheet" href="{{asset('css/mapbox-gl.css')}}" type="text/css">--}}

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
                           {{$data->lastname}}  {{$data->firstname}}
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
                                  alt="{{$data->lastname}}"></td>
                              <td>

                              </td>
                          </tr>
                          <tr>
                              <td style="width: 150px">N° d'extrait de naissance</td>
                              <td><b>{{$data->birth_certificate_number}}</b></td>
                          </tr>
                              <tr>
                              <td >Nom</td>
                              <td><b>{{$data->lastname}}</b></td>
                          </tr>
                          <tr>
                              <td>Prénoms</td>
                              <td><b>{{$data->firstname}}</b></td>
                          </tr>

                           <tr>
                              <td>Date et lieu de naissance</td>
                              <td><b>{{$data->birth_date}} à {{$data->birth_place}} </b></td>
                          </tr>
                           <tr>
                              <td>Commune de residence</td>
                              <td><b>{{$data->commune}} </b></td>
                          </tr>
                              <tr>
                              <td>Quartier</td>
                              <td><b>{{$data->quartier_residence}} </b></td>
                          </tr>

                          <tr>
                              <td>Contact 1</td>
                              <td>{{$data->phone}}</td>
                          </tr>
                              <tr>
                              <td>Contact 2</td>
                              <td>{{$data->phone2}}</td>
                          </tr>
                              <tr>
                              <td>Email</td>
                              <td>{{$data->email}}</td>
                          </tr>
                            <tr>
                              <td>Fonction </td>
                              <td>{{$data->job}}</td>
                          </tr>
                           <tr>
                              <td>Commune </td>
                              <td>{{$data->commune}}</td>
                          </tr>
                              <tr>
                                  <td>Pièce d'identité</td>
                                  <td><b>{{$data->identity_papers_id}} ({{$data->identity_papers_type}})</b>


                                      <br>
                                      @if($data->fichier_piece)
                                      <img style="width:140px;border-radius: 5px"
                                           src="{{img_agent("administreds/".$data->id."/piece_recto.png")}}"
                                           alt="{{$data->lastname}}">
                                          <img style="width: 140px;border-radius: 5px"
                                           src="{{img_agent("administreds/".$data->id."/piece_verso.png")}}"
                                           alt="{{$data->lastname}}">
                                   @endif
                                  </td>
                              </tr>

                              <tr>
                                  <td>Signature</td>
                                  <td>
                                      @if($data->signature)
                                          <img style="width: 120px;border-radius: 5px"
                                               src="{{img_agent($data->signature)}}"
                                               alt="{{$data->lastname}}">
                                      @endif
                                  </td>
                              </tr>


                          </table>
                          <br>
                          <br>

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


@endsection


