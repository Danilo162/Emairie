@extends('layouts.main')
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2> <i class="fa fa-user-secret"></i> LISTE DES ROLES  <span class="orange-text total-text total_count"></span></h2>
        </div>
        <!-- Color Pickers -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix" data-sticky-container>
                            <div class="col-lg-8">
                                {{-- <button class="btn btn-success rel">Reload</button>--}}
                                <div class="body">
                                    <div class="col-lg-12 table_custom">

                                        <table id="table"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbar"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.role.index') }}"
                                               {{--                                                   data-ajax="ajaxRequest"--}}
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
                                                {{-- Nous affichons dans la Vue, la "Table" avec ses "Thead
                                                (th)", "Libellé, Commentaire". CHACUN de ces "thead" aura son
                                                "tbody" appelé dynamiquement via l'attribut "data-field" qui
                                                récupère toutes les données du FORMULAIRE HTML ci-dessous dans
                                                le "BOOTSTRAP MODAL" via son "ID", "frmCreate", le contenu
                                                des données de l'ID dans  "public/js/console/agent.js" via
                                                la Méthode "store()" de VueJS. --}}
                                            <tr>
                                                <th data-field="name" data-sort="true">Libellé</th>
                                                <th data-field="comment" data-sort="true">Commentaire</th>

                                                <th data-field="id" data-align="center"
                                                    data-formatter="optionsFormatter" data-width="120px">Actions
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4" data-sticky data-margin-top="100">

                                <form id="frmCreate"
                                      @submit.prevent="store"
                                      method="POST">
                                    {{-- @csrf --}}
                                    <input type="hidden" name="id" id="id">
                                    <div class="input-group">
                                        <label for="">Libellé</label>
                                        <div class="form-line" :class="{'focused error':e_name !=='' }">
                                            <input type="text" id="name" name="name"
                                                   class="form-control"
                                                   placeholder="Nom du rôle">

                                        </div>
                                        <span v-if="e_name" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_name}}</strong>
                                                    </span>
                                    </div>
                                    <div class="input-group">
                                        <label for="commentaire">Commentaire</label>
                                        <div class="form-line">
                                            <textarea class="form-control" placeholder="Donner plus de précision" name="commentaire" id="commentaire"  rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary waves-effect">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="store" value="{{route('console.role.store')}}">
    <input type="hidden" id="destroy" value="{{route('console.role.destroy')}}">
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

    <script src="{{ asset('js/console/role.js') }}"></script>
    <script>


    </script>
@endsection


