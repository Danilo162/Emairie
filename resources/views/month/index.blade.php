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
    <div class="container-fluid" >
        <div class="block-header">
            <h2>LISTE DES MOIS  <span class="orange-text total-text total_count"></span></h2>
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
                                                <b>Année</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-calendar-alt"></i>

                                            </span>
                                                    <div class="form-line" >
                                                        <select id="year" name="year"
                                                                class="form-control">
                                                            @if(count($years)!=0)
                                                                @if(count($years)>1)
                                                                    <option>--Tout--</option>
                                                                    @foreach ($years as $year)
                                                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option selected value="{{ $years[0]->year }}">{{ $years[0]->year }}</option>
                                                                @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <a href="{{route('console.taxecommerce.detail')}}"  style="margin-top: 11px;cursor: pointer" class="btn btn-secondary pull-left waves-effect m-r-20"
                                  >Voir plus <i class="fa fa-arrow-alt-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div id="toolbar">
                                            <button type="button" onclick="javascript:frmCreateReset('frmCreate')" style="margin-top: 11px" class="btn btn-primary pull-left waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Ajouter</button>
                                        </div>
                                        <table id="table"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbar"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.month.index') }}"
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
                                                <th data-cell-style="cellStyle" data-field="month" data-sort="true">Mois</th>
                                                <th data-cell-style="cellStyle" class="align-center" data-field="total_prev" data-sort="true">Nombre prevu</th>
                                                <th data-cell-style="cellStyle" class="align-center" data-field="total_paided" data-sort="true">Nombre Payé</th>
                                                <th data-cell-style="cellStyle"  class="align-right" data-field="total_amount_prev" data-sort="true">Montant prevu</th>
                                                <th data-cell-style="cellStyle" class="align-right" style="text-align: right"  data-field="total_amount_paided" data-sort="true">Montant payé <small></small> </th>
{{--                                                <th data-cell-style="cellStyle" class="align-right" style="text-align: right;width: 80px"--}}
{{--                                                    data-field="id"  data-formatter="optionsFormatterDetail" data-sort="true">Commerces<small></small> </th>--}}
{{--                                                @if(auth()->user()->isSuperAdmin())--}}
{{--                                                <th data-field="mairie" data-sort="true">Mairie</th>--}}
{{--                                                @endif--}}

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
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                           <h4 class=""> FORMULAIRE DE MOIS</h4>
                        </div>
                        <div class="modal-body">
                                <form id="frmCreate"
                                    @submit.prevent="store"
                                    method="POST">
                                    {{-- @csrf --}}
                                    <input type="hidden" name="id" id="month_id">

                                    <div class="col-lg-12">
                                        <b>Mois</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-calendar-alt"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_mois !=='' }">
                                            <select id="mois" name="mois"
                                                    class="form-control">

                                                    @foreach (getMonthBetween(intval(date("Y"))) as $month)
                                                        <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach
                                            </select>

                                        </div>
                                            <span v-if="e_mois" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_mois}}</strong>
                                                    </span>
                                    </div>

                                     <input type="hidden" name="mairie" value="{{mairies()->id}}">


                                    <div class="col-lg-12">
                                        <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>
                                        <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>

                                    </div>
                                    </div>

                        <div class="modal-footer">

                        </div>
                                </form>
                    </div>
                </div>
                </div>
            </div>

    <input type="hidden" id="store" value="{{route('console.month.store')}}">
    <input type="hidden" id="detail" value="{{route('console.taxecommerce.detail')}}">
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
    <script src="{{ asset('js/console/month.js') }}"></script>
    <script>

    </script>
@endsection


