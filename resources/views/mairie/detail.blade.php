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
                           {{$data->nom}}
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
                                  alt="{{$data->nom}}"></td>
                              <td>

                              </td>
                          </tr>
                          <tr>
                              <td style="width: 150px">Localisation</td>
                              <td><b>{{$data->localisation}}</b></td>
                          </tr>
                              <tr>
                              <td >Contact</td>
                              <td><b>{{$data->phone}}</b></td>
                          </tr>
                          <tr>
                              <td>E-mail</td>
                              <td><b>{{$data->email}}</b></td>
                          </tr>
                          <tr>
                              <td>Services</td>
                              <td>
                                  <form id="frmCreateService"
                                        @submit.prevent="storeService"
                                        method="POST">
                                      <input type="hidden" name="mairie" value="{{$data->id}}">
                                  <div class="demo-checkbox">
                            {{--          {{dd($allServices)}}--}}
                                      <div class="row">
                                          @foreach($allServices as $allservice)
                                          <div class="col-lg-6">
                                              <input value="{{$allservice->id}}" style="line-height: 25px;vertical-align: middle" type="checkbox" name="service[]" id="basic_checkbox_{{$allservice->id}}" class="filled-in" @if($allservice->mairie_id != null) checked @endif />
                                              <label for="basic_checkbox_{{$allservice->id}}">{{$allservice->name}}
                                                  <img style="height: 50px" src="{{asset('storage/'.$allservice->picture)}}" alt="">
                                              </label>
                                          </div>
                                          @endforeach
                                      </div>

                                  </div>
                                      <br>
                                      <div class="col-lg-8">
                                          <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>

                                      </div>
                                  </form>
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


    <input type="hidden" id="storeService" value="{{route('console.store.service')}}">
    <input type="hidden" id="mairie" value="{{$data->id}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>

    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('js/console/mairie.js') }}"></script>

@endsection


