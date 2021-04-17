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
            <h2>LISTE DES DEMANDES <span class="orange-text total-text total_count"></span></h2>
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

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <b>Statut</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-list-alt"></i>
                                            </span>
                                                    <div class="form-line" >
                                                        <select id="type" name="type"
                                                                class="form-control">
                                                         <option>--Tout--</option>

                                                        <option value="ATTENTE">ATTENTE</option>
                                                        <option value="EN TRAITEMENT">EN TRAITEMENT</option>
                                                        <option value="TRAITEE">TRAITEE</option>


                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        <table id="tableService"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbar"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.service.index.demande') }}"
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
                                                <th data-field="administred" data-sort="true">Nom & prénom(s) </th>
                                                <th data-field="service" data-sort="true">Service</th>
                                                <th data-field="quantite" data-sort="true">Qte</th>
                                                <th data-field="status" data-sort="true">Status</th>
                                                @if(auth()->user()->isSuperAdmin())
                                                <th data-field="mairie" data-sort="true">Mairie</th>
                                                @endif
                                                <th data-field="user" data-sort="true">Fait par </th>
                                                <th data-field="created" data-sort="true">Fait le</th>

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

    <input type="hidden" id="confirme" value="{{route('console.service.store.confirme')}}">

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
    <script src="{{ asset('js/console/service.js') }}"></script>
    <script>


    </script>
@endsection


