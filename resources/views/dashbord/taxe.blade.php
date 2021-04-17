@extends('layouts.main')

@section('content')

    <div class="container-fluid" id="dashboard">
        <div class="block-header">
            <h2>TABLEAU DE BORD DES TAXES </h2>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <b>Communes</b>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span>
                    <div class="form-line">
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
                    <div class="form-line">
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
                    <div class="form-line">
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
                                        <option @if(date("m-Y")== $month->month) selected @endif value="{{ $month->month }}">{{ $month->month }}</option>
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

        </div>
        <div >
           <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="row">
                    <div  class="row clearfix">
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="body" style='height: 500px'>
                                 <table  class="table table-striped table-warning table-bordered">
                                     <thead class="">
                                     <tr class="bg-theme-custom">
                                         <td>INTITULE</td> <td> Nombre</td> <td> Montant</td> <td> %</td>

                                     </tr>
                                     </thead>
                                     <tbody id="tbody">

                                     </tbody>
                                 </table>
                                        <div style='height: 300px' id="echart_bar_status" class="dashboard-flot-chart">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="body">
                                        <div style='height: 500px' id="echart_pie_taxe_somme" class="dashboard-flot-chart"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- #END# Browser Usage -->
                    </div></div>
            </div>
           </div>
        </div>
    </div>

    <input type="hidden" value="{{route('console.taxecommerce.statistique')}}" id="taxe_statistique">
    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('echartjslib/config.js') }}"></script>
    <script src="{{ asset('echartjslib/esl.js') }}"></script>
    <script src="{{ asset('js/console/dashbord_taxe.js') }}"></script>

@endsection
