@extends('layouts.main')
@section('content')

<style>
  .bootstrap-table .fixed-table-toolbar .columns-right{
        float: left !important;
    }

    .bootstrap-table .fixed-table-toolbar .search {
        float: left !important;
    }
</style>
    <div class="container-fluid">
        <div class="block-header">
            <h2>LISTE DES AGENTS <span class="orange-text total-text total_count"></span></h2>
        </div>
        <!-- Color Pickers -->

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix" data-sticky-container>
                            <div class="col-lg-12">
                                <div class="body">
                                    <div class="col-lg-12 table_custom">
                                        <div id="toolbar">
                                            <button type="button" onclick="javascript:frmCreateReset('frmCreate')" style="margin-top: 11px" class="btn btn-primary pull-left waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Ajouter</button>
                                        </div>
                                        <table id="table"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbar"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.agent.index') }}"
                                               data-side-pagination="server"
                                               data-show-copy-rows="true"
                                               data-pagination="true"
                                               data-trim-on-search="false"
                                               data-page-size="5"
                                               data-page-list="[5, 10, 20, 50, 100, 200]"
                                               data-search="true"
                                               data-show-print="true"
                                               data-show-fullscreen="true"
                                               data-show-toggle="true"
                                               data-show-refresh="true"
                                               data-filter-control="true"
                                               data-show-export="true"

                                               data-show-pagination-switch="false"
                                        >
                                            <thead>
                                            {{-- Nous affichons dans la Vue, la "Table" avec ses "Thead (th)",
                                                "Prénoms, Nom, Téléphone, E-mail, Mairie, Image, Job". CHACUN
                                                de ces "thead" aura son "tbody" appelé dynamiquement via
                                                l'attribut "data-field" qui récupère toutes les données du
                                                FORMULAIRE HTML ci-dessous dans le "BOOTSTRAP MODAL" via son
                                                "ID", "frmCreate", le contenu des données de l'ID dans
                                                "public/js/console/agent.js" via la Méthode "store()"
                                                de VueJS. --}}

                                            <tr>
                                                <th data-field="lastname" data-sort="true">Nom</th>
                                                <th data-field="firstname" data-sort="true">Prénoms</th>
                                                <th data-field="phone" data-sort="true">Téléphone</th>
                                                <th data-field="email" data-sort="true">E-mail</th>
                                                <th data-field="id" data-formatter="imageFormatter" data-sort="true" class="img-thumbnail">Image</th>
                                                @if(auth()->user()->isSuperAdmin())
                                                <th data-field="mairie" data-sort="true">Mairie</th>
                                                @endif
                                                <th data-field="job" data-sort="true">Job</th>
                                                <th data-field="role" data-sort="true">Rôle</th>

                                                <th data-field="id" data-align="center"
                                                    data-formatter="optionsFormatter" data-width="120px">Actions
                                                </th>
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

<!-- Modal Dialogs ======================================================================== -->
            <!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                           <h4 class=""> FORMULAIRE DE COMPTE</h4>
                        </div>
                        <div class="modal-body">
                                <form id="frmCreate"
                                    @submit.prevent="store"
                                    method="POST">
                                    {{-- @csrf --}}
                                    <input type="hidden" name="id" id="agent_id">
                                    <div class="col-lg-6">
                                        <b>Nom</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_lastname !=='' }">
                                                <input type="text" id="lastname" name="lastname"
                                                       class="form-control"
                                                      >

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
                                            <input type="text" id="firstname" name="firstname"
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
                                            <input type="text" id="phone" name="phone"
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
                                            <input type="email" id="email" name="email"
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
                                        <input type="text" id="job" name="job"
                                            class="form-control">

                                    </div>
                                            <span v-if="e_job" class="invalid-feedback" role="alert">
                                                    <strong style="color: red">@{{e_job}}</strong>
                                        </span>

                                </div>
                             </div>
                                    @if(auth()->user()->isSuperAdmin())
                                    <div class="col-lg-6">
                                        <b>Mairie</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_mairie !=='' }">

                                            <select id="mairie" name="mairie"
                                                    class="form-control">
                                                    <option>Sélectionner une mairie</option>
                                                    @foreach ($mairies as $mairie)
                                                        <option value="{{ $mairie->id }}">{{ $mairie->nom }}</option>
                                                    @endforeach
                                            </select>

                                        </div>
                                            <span v-if="e_mairie" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_mairie}}</strong>
                                                    </span>
                                    </div>
                                    </div>
                                    @else
                                     <input type="hidden" name="mairie" value="{{mairies()->id}}">
                                    @endif


                                    <div class="col-lg-6">
                                        <b>Rôle</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-user-secret orange-text"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_role !=='' }">

                                                <select id="role" name="role"
                                                        class="form-control">
                                                    <option>Sélectionner un rôle</option>
                                                    @if($roles)
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                            <span v-if="e_role" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_role}}</strong>
                                                    </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="imgdiv">
                                        <img class="imgpreview" alt="" style="height: 60px"/>
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

    <input type="hidden" id="store" value="{{route('console.agent.store')}}">
    <input type="hidden" id="edit" value="{{route('console.agent.edit')}}">
    <input type="hidden" id="destroy" value="{{route('console.agent.destroy')}}">
    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>


    <script src="{{ asset('js/scripts/sticky.compile.js') }}"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/agent.js') }}"></script>
    <script>


    </script>
@endsection


