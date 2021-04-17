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
            <h2>LISTE DES ACTUALITES <span class="orange-text total-text total_count"></span></h2>
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
                                               data-url="{{ route('console.actualite.index') }}"
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
                                                "public/js/console/actualite.js" via la Méthode "store()"
                                                de VueJS. --}}

                                            <tr>
                                                <th data-field="appel" data-sort="true">Appel</th>
                                                <th data-field="resume" data-sort="true">Resumé</th>
                                                <th data-field="type" data-sort="true">Type actualité</th>
                                                <th data-field="source" data-sort="true">Source</th>
                                                <th data-field="id" data-formatter="imageFormatter" data-sort="true" class="img-thumbnail">Image</th>
                                                @if(auth()->user()->isSuperAdmin())
                                                <th data-field="mairie" data-sort="true">Mairie</th>
                                                @endif

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
                           <h4 class=""> FORMULAIRE D'ACTUALITE</h4>
                        </div>
                        <div class="modal-body">
                                <form id="frmCreate"
                                    @submit.prevent="store"
                                    method="POST">
                                    {{-- @csrf --}}
                                    <input type="hidden" name="id" id="actualite_id">
                                    <div class="col-lg-12">
                                        <b>Appel</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-newspaper"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_appel !=='' }">
                                                <input type="text" id="appel" name="appel"
                                                       class="form-control"
                                                      >

                                            </div>
                                            <span v-if="e_appel" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_appel}}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <b>Resumé</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-newspaper"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_resume !=='' }">
                                            <input type="text" id="resume" name="resume"
                                                class="form-control">
                                            <textarea name="resume" id="resume"  rows="3" class="form-control " ></textarea>

                                        </div>
                                            <span v-if="e_resume" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_resume}}</strong>
                                            </span>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <b>Description</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-newspaper-o"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_description !=='' }">
                                         {{--   <input type="text" id="phone" name="phone"
                                                class="form-control phone-number">--}}
                                            <textarea name="description"   class="form-control "  id="description" rows="5"></textarea>
                                        </div>
                                            <span v-if="e_description" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_description}}</strong>
                                            </span>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Source</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>

                                        <div class="form-line" >
                                            <input type="text" id="source" name="source"
                                                class="form-control">

                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>lien source</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>

                                        <div class="form-line" >
                                            <input type="text" id="source_link" name="source_link"
                                                class="form-control">

                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Photo</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-image"></i>
                                            </span>
                                            <div class="form-line" >
                                                <input  type="file" id="picture" name="picture"
                                                        class="form-control"
                                                        placeholder="">

                                            </div>
                                         {{--   <span v-if="e_picture" class="invalid-feedback" role="alert">
                                                <strong style="color: red">@{{e_picture}}</strong>
                                            </span>--}}
                                        </div>
                                    </div>


                                    @if(auth()->user()->isSuperAdmin())
                                    <div class="col-lg-6">
                                        <b>Mairie</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                        <div class="form-line" >

                                            <select id="mairie" name="mairie"
                                                    class="form-control">
                                                    <option>Sélectionner une mairie</option>
                                                    @foreach ($mairies as $mairie)
                                                        <option value="{{ $mairie->id }}">{{ $mairie->nom }}</option>
                                                    @endforeach
                                            </select>

                                        </div>
                                    {{--        <span v-if="e_mairie" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_mairie}}</strong>
                                                    </span>--}}
                                    </div>
                                    </div>
                                    @else
                                     <input type="hidden" name="mairie" value="{{mairies()->id}}">
                                    @endif


                                    <div class="col-lg-6">
                                        <b>Type d'actualité</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-user-secret orange-text"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_type !=='' }">

                                                <select id="type" name="type"
                                                        class="form-control">
                                                    <option>Sélectionner un type</option>
                                                    @if($types)
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                            <span v-if="e_type" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_type}}</strong>
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

    <input type="hidden" id="store" value="{{route('console.actualite.store')}}">
    <input type="hidden" id="edit" value="{{route('console.actualite.edit')}}">
    <input type="hidden" id="destroy" value="{{route('console.actualite.destroy')}}">
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
    <script src="{{ asset('js/console/actualite.js') }}"></script>
    <script>


    </script>
@endsection


