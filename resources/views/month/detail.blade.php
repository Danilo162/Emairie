@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{asset('select2/css/select2.css')}}" type="text/css">
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

    <div class="container-fluid">
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
                  <li role="presentation" class="">
                      <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-user-lock"></i> PERMISSIONS
                      </a>
                  </li>
                  <li role="presentation" class="">
                      <a href="#messages_with_icon_title" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-user-secret"></i> PERMISSIONS DELEGUEES
                      </a>
                  </li>
{{--                  <li role="presentation" class="">--}}
{{--                      <a href="#settings_with_icon_title" data-toggle="tab" aria-expanded="false">--}}
{{--                          <i class="fa fa-user-edit"></i> MODIFIER MON PROFIL--}}
{{--                      </a>--}}
{{--                  </li>--}}
{{--                  <li role="presentation" class="">--}}
{{--                      <a href="#settings_with_icon_title" data-toggle="tab" aria-expanded="false">--}}
{{--                          <i class="fa fa-user-plus"></i> MODIFIER MON MOT DE PASSE--}}
{{--                      </a>--}}
{{--                  </li>--}}
              </ul>
              <!-- Tab panes -->
              <div class="tab-content padding-10 " style="background: white">
                  <div role="tabpanel" class="tab-pane fade active in " id="home_with_icon_title">

                          <div class="row">
                              <div class="col-lg-6">
                          <b>Informations personnelles</b>
                              </div>
                              <div class="col-lg-6">
                                  <button type="button"
                                    class=" btn  btn-default btn-group-sm pull-left waves-effect m-r-20"
                                  data-toggle="modal" onclick="javascript:editModal()" >
                                      <i style="font-size: 14px" class="fa fa-user-edit green-text  fs-14"></i>
{{--                                      <i class="fa fa-user  fs-14"></i>--}}
                                      Modifier le profil
                                  </button>
                                  <button type="button"
                                   class=" btn  btn-default btn-group-sm pull-left waves-effect m-r-20"
                                  data-toggle="modal" onclick="javascript:passwordModal()" >
                                      <i style="font-size: 14px" class="fa fa-user-lock green-text  fs-14"></i>
{{--                                      <i class="fa fa-user-lock  fs-14"></i>--}}
                                      Modifier le mot de passe
                                  </button>
                              </div>
                          </div>
                      <div class="col-lg-12" id="infoList"></div>

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">

                      <b>Permissions : <span class="text-theme"></span> {{$data->role}}</b>

                      <div class="row">
                          <div class="col-lg-12">
                              <div class=" table_custom">

                                  <table id="table"
                                         class="table table-bordered table-hover table-responsive table-striped"
                                         data-toggle="table"
                                         data-toolbar="#toolbar"
                                         data-click-to-select="true"
                                         data-single-select="true"
                                         data-url="{{ route('console.permission.index').'?re_r='.$data->role_id }}"
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
                                          <th data-field="name" data-sort="true">Libellé</th>
                                          <th data-field="comment" data-sort="true">Commentaire</th>

                                      </tr>
                                      </thead>

                                  </table>
                              </div>
                          </div>

                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">

                      <div class=" table_custom">

                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="col-lg-6">
                                      <div id="toolbar">
                                          <b>Liste des permissions déléguées </b>
                                      </div>
                                      <table id="tableDelegues"
                                             class="table table-bordered table-hover table-responsive table-striped"
                                             data-toggle="table"
                                             data-toolbar="#toolbar"
                                             data-click-to-select="true"
                                             data-single-select="true"
                                             data-url="{{ route('console.permission.index.delegue').'?is_=1&ag_ia='.$data->id }}"
                                             data-side-pagination="server"
                                             data-show-copy-rows="true"
                                             data-pagination="true"
                                             data-trim-on-search="false"
                                             data-page-size="5"
                                             data-page-list="[5, 10, 20, 50, 100, 200]"
                                             data-search="true"
                                             data-show-print="true"
                                             data-show-pagination-switch="false"
                                      >
                                          <thead>
                                          <tr>
                                              <th data-formatter="formatName" data-field="id"  data-sort="true">Libellé</th>
                                              <th class="small" data-field="comment" data-sort="true">Commentaire</th>
                                              @can('Delegate Permission')
                                              <th data-field="id" data-align="center"
                                                  data-formatter="optionsFormatterRemove" data-width="50px">
                                              </th>
                                              @endcan
                                          </tr>
                                          </thead>

                                      </table>
                                  </div>
                                  <div class="col-lg-6" >
                                      @can('Delegate Permission')

                                      <div class="col-lg-12" style="background: #d3d3d32b">
                                          <div id="toolbarDelegue">
                                              <b>Permissions disponible : Déléguéer des permissions </b>
                                          </div>

                                          <table id="tableDeleguesDispo"
                                                 class="table table-bordered table-hover table-responsive table-striped"
                                                 data-toggle="table"
                                                 data-toolbar="#toolbarDelegue"
                                                 data-click-to-select="true"
                                                 data-single-select="true"
                                                 data-url="{{ route('console.permission.index.delegue').'?ag_ia='.$data->id }}"
                                                 data-side-pagination="server"
                                                 data-show-copy-rows="true"
                                                 data-pagination="true"
                                                 data-trim-on-search="false"
                                                 data-page-size="5"
                                                 data-page-list="[5, 10, 20, 50, 100, 200]"
                                                 data-search="true"
                                                 data-show-print="true"
                                                 data-show-pagination-switch="false"
                                          >
                                              <thead>
                                              <tr>

                                                  <th data-field="id" data-align="center"
                                                      data-formatter="optionsFormatterAdd" data-width="50px">
                                                  </th>

                                                  <th data-field="id" data-formatter="formatName" data-sort="true">Libellé</th>
                                                  <th class="small" data-field="comment" data-sort="true">Commentaire</th>
                                              </tr>
                                              </thead>

                                          </table>
                                      </div>
                                      @endcan
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
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class=""> MODIFICATION DU PROFIL</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreateAgent"
                          @submit.prevent="edit"
                          method="POST">
                        {{-- @csrf --}}
                        <input type="hidden" name="id" id="agent_id" value="{{$data->id}}">
                        <div class="col-lg-6">
                            <b>Nom</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_lastname !=='' }">
                                    <input value="{{$data->lastname}}" type="text" id="lastname" name="lastname"
                                           class="form-control">

                                </div>
                                <span v-if="e_lastname" class="invalid-feedback" role="alert">
                                  <strong style="color: red">@{{e_lastname}}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <b>Prénom(s)</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_firstname !=='' }">
                                    <input value="{{$data->firstname}}" type="text" id="firstname" name="firstname"
                                           class="form-control">

                                </div>
                                <span v-if="e_firstname" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_firstname}}</strong>
                                            </span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <b>Contact</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_phone !=='' }">
                                    <input value="{{$data->phone}}" type="text" id="phone" name="phone"
                                           class="form-control phone-number">

                                </div>
                                <span v-if="e_phone" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_phone}}</strong>
                                            </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <b>E-mail</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>

                                <div class="form-line" :class="{'focused error':e_email !=='' }">
                                    <input value="{{$data->email}}"  type="email" id="email" name="email"
                                           class="form-control">

                                </div>
                                <span v-if="e_email" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_email}}</strong>
                                                    </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <b>Photo</b>
                            <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-image"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_picture !=='' }">
                                    <input  type="file" id="picture" name="picture"
                                            class="form-control"
                                            placeholder="">

                                </div>
                                <span v-if="e_picture" class="invalid-feedback" role="alert">
                                                <strong style="color: red">@{{e_picture}}</strong>
                                            </span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <b>Fonction</b>
                            <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-user-check"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_job !=='' }">
                                    <input value="{{$data->job}}"  type="text" id="job" name="job"
                                           class="form-control">

                                </div>
                                <span v-if="e_job" class="invalid-feedback" role="alert">
                                                    <strong style="color: red">@{{e_job}}</strong>
                                        </span>

                            </div>
                        </div>

                          <input type="hidden" name="mairie" value="{{$data->mairie_id}}">


                        <div class="col-lg-6" id="imgdiv">
                            <img class="imgpreview" src="{{img_agent($data->picture)}}" alt="" style="height: 60px"/>
                        </div>
                        <div class="col-lg-8">
                            <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>
                            <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>

                        </div>


                            <div class="modal-footer">

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="passwordModal" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class=""> MODIFICATION DU MOT PASSE</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreatePass"
                          @submit.prevent="changePass"
                          method="POST">
                        {{-- @csrf --}}
                        <input type="hidden" name="id" id="agent_id" value="{{$data->id}}">
                        <div class="col-lg-12">
                            <b>Mot de passe actuel</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_mot_de_passe !=='' }">
                                    <input  type="password" id="mot_de_passe" name="mot_de_passe"
                                           class="form-control"
                                    >

                                </div>
                                <span v-if="e_mot_de_passe" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_mot_de_passe}}</strong>
                                            </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <b>Nouveau de passe</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_nouveau_mot_de_passe !=='' }">
                                    <input  type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe"
                                           class="form-control">

                                </div>
                                <span v-if="e_nouveau_mot_de_passe" class="invalid-feedback" role="alert">
                                                    <strong style="color: red">@{{e_nouveau_mot_de_passe}}</strong>
                                        </span>


                            </div>
                        </div>

                        <div class="col-lg-6">
                            <b>Confirmer le mot de passe</b>
                            <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                <div class="form-line" :class="{'focused error':e_confirmer_mot_de_passe !=='' }">
                                    <input  type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe"
                                           class="form-control ">


                                </div>
                                <span v-if="e_confirmer_mot_de_passe" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_confirmer_mot_de_passe}}</strong>
                                            </span>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>
                            <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>

                        </div>


                            <div class="modal-footer">

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="store_delegation" value="{{route('console.role.delegation_store')}}">
    <input type="hidden" id="destroy_delegation" value="{{route('console.role.delegation_destroy')}}">
    <input type="hidden" id="storeAgent" value="{{route('console.agent.store')}}">
    <input type="hidden" id="storeAgent" value="{{route('console.agent.store')}}">
    <input type="hidden" id="agent_info" value="{{route('console.agent.infos')}}">
    <input type="hidden" id="changepass" value="{{route('console.agent.changepass')}}">
    <input type="hidden" id="ag_t" value="{{$data->id}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            // $('#droit-delegue').select2({});

            $("#droit-delegue").select2({
                ajax: {
                    url: "{{route('console.permission.index.delegue')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            ro_r: {{$data->role_id}},
                            ag_ia: '{{$data->id}}',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Selectionner un  ',
                language: "fr",
                cache: false,
                // minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });


        });

        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }


            var $container = $(
                "<div class='row'>" +
                // "<div class='col-lg-2'><img alt='' style='height: 40px' src='" + pictureUrl + "' />&nbsp;</div>" +
                "<div class='col-lg-12'>&nbsp;" +
                "<div class='select2-result-repository__title'></div>" +
                "<div class='select2-result-repository__description'></div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.name);
            // $container.find(".select2-result-repository__description").html(is_disponible);
            return $container;
        }

        function formatRepoSelection(repo) {

            var comment = repo.comment ? repo.comment : "";
            $("#comment small").html(comment);
            if (comment) {
                $("#comment").css("display", "block");
            }

            return repo.name || repo.text;

        }

    </script>
    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/user_permission.js') }}"></script>

@endsection


