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
                                            <input type="hidden" id="etat_taxe">
{{--                                            <div class="col-lg-3">--}}
{{--                                                <b>Etat paiement taxe</b>--}}
{{--                                                <div class="input-group">--}}
{{--                                              <span class="input-group-addon">--}}
{{--                                                <i class="fa fa-money-bill-alt"></i>--}}
{{--                                            </span>--}}
{{--                                                    <div class="form-line" >--}}
{{--                                                        <select id="etat_taxe" name="etat_taxe"--}}
{{--                                                                class="form-control">--}}
{{--                                                            <option  value="">--Tout--</option>--}}
{{--                                                            <option  value="AJOUR">A JOUR</option>--}}
{{--                                                            <option  value="EN RETARD">EN RETARD</option>--}}
{{--                                                        </select>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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
                                               data-url="{{ route('console.commerce.index') }}"
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
                                                <th class="small" data-field="id" data-formatter="identifierFormatter" data-sort="true">N°</th>
                                                <th class="small"  data-field="raison_social" data-sort="true">Raison sociale</th>
                                                <th class="small"  data-field="type_commerce" data-sort="true">Type</th>
                                                <th class="small"  data-field="administred" data-sort="true">Propritaire</th>
                                                <th class="small"  data-field="zone" data-sort="true">Zone</th>
                                                <th class="small"  data-field="quartier" data-sort="true">Quartier</th>
                                                @if(auth()->user()->isSuperAdmin())
                                                <th class="small"  data-field="commune" data-sort="true">Commune</th>
                                                    <th class="small"  data-field="mairie" data-sort="true">Mairie</th>
                                                @endif
                                                <th  data-field="id" data-formatter="imageFormatter"  data-sort="true" class="img-thumbnail small">Image</th>

                                                <th data-field="id" data-align="center"
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

<!-- Modal Dialogs ======================================================================== -->
            <!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                           <h4 class=""> FORMULAIRE DE COMMERCE</h4>
                        </div>
                        <div class="modal-body">
                                <form id="frmCreate"
                                    @submit.prevent="store"
                                    method="POST">
                                     @csrf
                                    <input type="hidden" name="id" id="agent_id">
                                    <div class="col-lg-6">
                                        <b>Raison sociale</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <div class="form-line" :class="{'focused error':e_raison_social !=='' }">
                                                <input type="text" id="raison_social" name="raison_social"
                                                       class="form-control"
                                                      >

                                            </div>
                                            <span v-if="e_raison_social" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_raison_social}}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Administré</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_administred !=='' }">
                                            <input type="text" id="administred" name="administred"
                                                class="form-control">


                                            <select required id="administred" name="administred"
                                                    class="form-control">
                                                <option>Sélectionner un administré</option>
                                                @foreach ($administreds as $administred)
                                                    <option value="{{ $administred->id }}">{{ $administred->lastname }} {{ $administred->firstname }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                            <span v-if="e_administred" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_administred}}</strong>
                                            </span>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Type de commerce</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_type !=='' }">
                                            <input type="text" id="type" name="type"
                                                class="form-control">


                                            <select required id="type" name="type"
                                                    class="form-control">
                                                <option>Sélectionner </option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                            <span v-if="e_type" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_type}</strong>
                                            </span>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Communes</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_commune !=='' }">
                                            <input type="text" id="commune" name="commune"
                                                class="form-control">


                                            <select required id="commune_" name="commune"
                                                    class="form-control">
                                                <option>Sélectionner une commune</option>
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
                                            <span v-if="e_administred" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_administred}}</strong>
                                            </span>
                                    </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <b>Description</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-description"></i>
                                            </span>
                                        <div class="form-line" :class="{'focused error':e_description !=='' }">
                                            <input type="text" id="description" name="description"
                                                class="form-control description-number">

                                        </div>
                                            <span v-if="e_description" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_description}}</strong>
                                            </span>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <b>Quartier</b>
                                        <div class="input-group">
                                         <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>

                                        <div class="form-line" :class="{'focused error':e_quartier !=='' }">
                                            <input type="text" id="quartier" name="quartier"
                                                class="form-control">

                                        </div>
                                            <span v-if="e_quartier" class="invalid-feedback" role="alert">
                                                        <strong style="color: red">@{{e_quartier}}</strong>
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
                                        <b>Detail de localisation</b>
                                        <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-user-check"></i>
                                            </span>
                                    <div class="form-line" :class="{'focused error':e_detail_localisation !=='' }">
                                        <input type="text" id="detail_localisation" name="detail_localisation"
                                            class="form-control">

                                    </div>
                                            <span v-if="e_detail_localisation" class="invalid-feedback" role="alert">
                                                    <strong style="color: red">@{{e_detail_localisation}}</strong>
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
                                    </div>

                        <div class="modal-footer">

                        </div>
                                </form>
                    </div>
                </div>
                </div>


    <input type="hidden" id="store" value="{{route('console.commerce.store')}}">
    <input type="hidden" id="edit" value="{{route('console.commerce.edit')}}">
    <input type="hidden" id="destroy" value="{{route('console.commerce.destroy')}}">
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
    <script src="{{ asset('js/console/commerce.js') }}"></script>
    <script>


    </script>
@endsection


