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
    <div class="container-fluid" id="contenaire">
        <div class="block-header">
            <h2 style="text-transform: uppercase">LISTE DES {{$type->name}}s <span class="orange-text total-text total_count"></span></h2>
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
                                               data-url="{{ route('console.mairie.index')."?type_organe=".$type->id}}"
                                               {{-- data-ajax="ajaxRequest"--}}
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
                                                "Libellé, Localisation, Téléphone, Image, E-mail, Commune,
                                                Job". CHACUN de ces "thead" aura son "tbody" appelé
                                                dynamiquement via l'attribut "data-field" qui récupère toutes
                                                les données du FORMULAIRE HTML ci-dessous dans le "BOOTSTRAP
                                                MODAL" via son "ID", "frmCreate", le contenu des données de
                                                l'ID dans "public/js/console/mairie.js" via la Méthode
                                                "store()" de  VueJS. --}}
                                            <tr>
                                                <th data-field="nom" data-sort="true">Libellé</th>
                                                <th data-field="localisation" data-sort="true">Localisation</th>
                                                <th data-field="phone" data-sort="true">Téléphone</th>

                                                <th data-field="email" data-sort="true">E-mail</th>
                                                <th data-field="id" data-formatter="imageFormatter" data-sort="true" class="img-thumbnail">Image</th>
                                                <th data-field="commune" data-sort="true">Commune</th>

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
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                                <form id="frmCreate"
                                    @submit.prevent="store"
                                    method="POST">
                                    {{-- @csrf --}}
                                    <input type="hidden" name="type_organe" value="{{$type->id}}">
                                    <input type="hidden" name="id" id="mairie_id">
                                    <div class="col-lg-12">
                                        <b>Libellé</b>
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_name !=='' }">
                                            <input type="text" id="name" name="name"
                                                class="form-control"
                                                placeholder="">
                                            <span v-if="e_name" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_name}}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    </div>
{{--                                    <div class="col-lg-6">--}}
{{--                                        <b>Latitude</b>--}}
{{--                                        <div class="input-group">--}}
{{--                                              <span class="input-group-addon">--}}
{{--                                                <i class="fa fa-map-marker"></i>--}}
{{--                                            </span>--}}
{{--                                            <div class="form-line" :class="{'focused error':e_latitude !=='' }">--}}
{{--                                                <input type="text" id="latitude" name="latitude"--}}
{{--                                                       class="form-control"--}}
{{--                                                       placeholder="Localisation">--}}
{{--                                                <span v-if="e_localisation" class="invalid-feedback" role="alert">--}}
{{--                                                        <strong style="color: red">@{{e_localisation}}</strong>--}}
{{--                                            </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <b>Longitude</b>--}}
{{--                                        <div class="input-group">--}}
{{--                                              <span class="input-group-addon">--}}
{{--                                                <i class="fa fa-building"></i>--}}
{{--                                            </span>--}}
{{--                                            <div class="form-line" :class="{'focused error':e_longitude !=='' }">--}}
{{--                                                <input type="text" id="longitude" name="longitude"--}}
{{--                                                       class="form-control"--}}
{{--                                                       placeholder="Localisation">--}}
{{--                                                <span v-if="e_localisation" class="invalid-feedback" role="alert">--}}
{{--                                                        <strong style="color: red">@{{e_localisation}}</strong>--}}
{{--                                            </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-lg-12">
                                        <b>Localisation</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_localisation !=='' }">
                                                <input type="text" id="localisation" name="localisation"
                                                       class="form-control">
                                                <span v-if="e_localisation" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_localisation}}</strong>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Contact</b>
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_phone !=='' }">
                                            <input type="text"  id="phone" name="phone"
                                                class="form-control phone-number"
                                                >
                                            <span v-if="e_phone" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_phone}}</strong>
                                            </span>
                                        </div>
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
                                                class="form-control email-adress">
                                            <span v-if="e_email" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_email}}</strong>
                                                    </span>
                                        </div>
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
                                            <span v-if="e_picture" class="invalid-feedback" role="alert">
                                                <strong style="color: red">@{{e_picture}}</strong>
                                            </span>
                                        </div>
                                   </div>
                                    </div>

                                    <div class="col-lg-6" id="imgdiv">
                                        <img class="imgpreview" alt="" style="height: 60px"/>
                                    </div>

                                    <div class="col-lg-12">
                                        <b>Commune</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_commune !=='' }">

                                            <select id="commune" name="commune"
                                                    class="form-control">
                                                    <option>Sélectionner une commune</option>
                                                    @foreach ($communes as $commune)
                                                        <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                                    @endforeach
                                            </select>
                                            <span v-if="e_commune" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_commune}}</strong>
                                                    </span>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="col-lg-8">
                                        <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>
                                        <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>

                                    </div>
                                </form>
                        </div>
                        <div class="modal-footer">
{{--                            <button type="button" class="btn btn-link waves-effect"></button>--}}
{{--                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"></button>--}}
                        </div>
                    </div>
                </div>
            </div>



    <input type="hidden" id="store" value="{{route('console.mairie.store')}}">
    <input type="hidden" id="edit" value="{{route('console.mairie.edit')}}">
    <input type="hidden" id="destroy" value="{{route('console.mairie.destroy')}}">
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
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('js/console/mairie.js') }}"></script>
    <script>


    </script>
@endsection


