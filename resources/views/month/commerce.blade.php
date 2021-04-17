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
    <div class="container-fluid" id="container">
        <div class="block-header">
            <h2>LISTE DES COMMERCES <span class="orange-text total-text total_count"></span></h2>
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
                                                <b>Communes</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-building"></i>


                                            </span>
                                                    <div class="form-line" >
                                                        <select id="commune" name="commune"
                                                                class="form-control">
                                                        @if(count($communes)!=0)
                                                            @if(count($communes)>1)
                                                                <option>--Tout--</option>
                                                            @foreach ($communes as $commune)
                                                                <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                                            @endforeach
                                                            @else
                                                                <option selected value="{{ $communes[0]->id }}">{{ $communes[0]->name }}</option>
                                                            @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>Mairies</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                                    <div class="form-line" >
                                                        <select id="mairie" name="mairie"
                                                                class="form-control">
                                                            @if(count($mairies)!=0)
                                                            @if(count($mairies)>1)
                                                                <option>--Tout--</option>
                                                                @foreach ($mairies as $mairie)
                                                                    <option value="{{ $mairie->id }}">{{ $mairie->nom }}</option>
                                                                @endforeach
                                                            @else
                                                                <option selected value="{{ $mairies[0]->id }}">{{ $mairies[0]->nom }}</option>
                                                            @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <b>Zones</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                                    <div class="form-line" >
                                                        <select id="zone" name="zone"
                                                                class="form-control">

                                                            @if(count($zones)!=0)
                                                            @if(count($zones)>1)
                                                                <option>--Tout--</option>
                                                                @foreach ($zones as $zone)
                                                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option selected value="{{ $zones[0]->id }}">{{ $zones[0]->name }}</option>
                                                            @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>Type de commerce</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-list-alt"></i>
                                            </span>
                                                    <div class="form-line">
                                                        <select id="type_commerce" name="type_commerce"
                                                                class="form-control">

                                                            @if(count($typecommerces)!=0)
                                                                @if(count($typecommerces)>1)
                                                                    <option>--Tout--</option>
                                                                    @foreach ($typecommerces as $typecommerce)
                                                                        <option value="{{ $typecommerce->id }}">{{ $typecommerce->name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option selected value="{{ $typecommerce[0]->id }}">{{ $typecommerce[0]->name }}</option>
                                                                @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>Type Taxe</b>
                                                <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-th-list"></i>
                                            </span>
                                                    <div class="form-line">
                                                        <select id="type_taxe" name="type_taxe"
                                                                class="form-control">
                                                            @if(count($typeTaxes)!=0)
                                                                @if(count($typeTaxes)>1)
                                                                    <option>--Tout--</option>
                                                                    @foreach ($typeTaxes as $typeTaxe)
                                                                        <option value="{{ $typeTaxe->id }}">{{ $typeTaxe->name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option selected value="{{ $typeTaxe[0]->id }}">{{ $typeTaxe[0]->name }}</option>
                                                                @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>Mois</b>
                                                <div class="input-group">
                   <span class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                    </span>
                                                    <div class="form-line">
                                                        <select id="month" name="month"
                                                                class="form-control">
                                                            @if(count($months)!=0)
                                                                @if(count($months)>1)
                                                                    <option>--Tout--</option>
                                                                    @foreach ($months as $month)
                                                                        <option @if($month_select && $month_select==$month || date("m-Y")== $month->month ) selected @endif value="{{ $month->month }}">{{ $month->month }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option selected value="{{ $months[0]->month }}">{{ $months[0]->month }}</option>
                                                                @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>L'année</b>
                                                <div class="input-group">
                   <span class="input-group-addon">
                   <i class="fa fa-calendar-alt"></i>
                    </span>
                                                    <div class="form-line">
                                                        <select id="year" name="year"
                                                                class="form-control">
                                                            @if(count($years)!=0)
                                                                @if(count($years)>1)
                                                                    <option>--Tout--</option>
                                                                    @foreach ($years as $year)
                                                                        <option @if(date("Y")== $year->year) selected @endif value="{{ $year->year }}">{{ $year->year }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option selected value="{{ $years[0]->year }}">{{ $years[0]->year }}</option>
                                                                @endif
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <b>ETAT PAIEMENT</b>
                                                <div class="input-group">
                   <span class="input-group-addon">
                   <i class="fa fa-calendar-alt"></i>
                    </span>
                                                    <div class="form-line">
                                                        <select id="etat_paided" name="etat_paided"
                                                                class="form-control">
                                                                    <option></option>
                                                                        <option  value="PAYE">PAYE</option>
                                                                        <option  value="NON_PAYE">NON_PAYE</option>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div id="toolbar">--}}


{{--                                              <button type="button" onclick="javascript:frmCreateReset('frmCreate')" style="margin-top: 11px" class="btn btn-primary pull-left waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Ajouter</button>--}}
{{--                                        </div>--}}
                                        <table id="table"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbar"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.taxecommerce.index') }}"
                                               data-side-pagination="server"
                                               data-show-copy-rows="true"
                                               data-pagination="true"
                                               data-trim-on-search="false"
                                               data-page-size="20"
                                               data-page-list="[ 100, 200,500,1000,3000]"
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

                                            <tr>
                                                <th class="small" data-cell-style="cellStyle" data-field="id" data-formatter="identifierFormatter" data-sort="true">N°</th>
                                                <th class="small" data-cell-style="cellStyle"  data-field="raison_social" data-sort="true">Raison sociale</th>
                                                <th class="small" data-cell-style="cellStyle"  data-field="taxe" data-sort="true">Type de taxe</th>
                                                <th class="small" data-cell-style="cellStyle"  data-field="administred" data-sort="true">Propritaire</th>
                                                <th class="small" data-cell-style="cellStyle"  data-field="zone" data-sort="true">Zone</th>
                                                <th class="small" data-cell-style="cellStyle"  data-field="month" data-sort="true">Mois</th>
                                                <th class="small" data-cell-style="cellStyle" data-field="amount_prev" data-sort="true">Montant prévu</th>
                                                <th class="small" data-cell-style="cellStyle" data-field="amount_paided" data-sort="true">Montant payé</th>
                                                @if(auth()->user()->isSuperAdmin())
                                                <th class="small" data-cell-style="cellStyle"  data-field="commune" data-sort="true">Commune</th>
                                                    <th class="small" data-cell-style="cellStyle"  data-field="mairie" data-sort="true">Mairie</th>
                                                @endif

                                                <th data-field="id" data-cell-style="cellStyle" data-align="center"
                                                    data-formatter="optionsFormatterReplay" data-width="50">Relance
                                                </th>
                                                <th data-field="id" data-cell-style="cellStyle" data-align="center"
                                                    data-formatter="optionsFormatterDetail" data-width="50">Actions
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


<input type="hidden" id="relance_to_sms" value="{{route('console.taxecommerce.relance_to_sms')}}">

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

    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/month_commerce.js') }}"></script>
    <script>


    </script>
@endsection


