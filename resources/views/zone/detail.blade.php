@extends('layouts.main')
@section('content')
    <style>

        .padding-10 {
            padding: 10px !important;
        }
   .fs-14{
       font-size: 14px !important;
   }

    </style>

    <div class="container-fluid" id="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card col-lg-12">
       <div class="body" style="background: #fefafa14">


           <div class=" table_custom">
               <div class="block-header head_build bg-effet">
                   <h2> <span class="fa-1x"> ZONE</span> : <b>{{$data->name}}</b>
{{--                       <span class="orange-text total-text total_count_commerce"></span>--}}
                   </h2>
               </div>
               <div class="row">
                   <div class="col-lg-12">
                       <div class="col-lg-6" >

                           <div id="toolbar">
                               <b>LISTE DES COMMERCES</b>
                               @can('Affecter Zone')
                               <a class="btn btn-secondary  btn-sm  m-b-15 pull-right" onclick="javascript:commerceModal()">
                                    Ajouter <i class="fa fa-plus-circle"></i>
                               </a>
                               <br>
                               <br>
                               @endcan
                           </div>
                               <br>


                           <table id="tableCommerceSelect"
                                  class="table table-bordered table-hover table-responsive table-striped"
                                  data-toggle="table"
                                  data-toolbar="#toolbar"
                                  data-click-to-select="true"
                                  data-single-select="true"
                                  data-url="{{ route('console.commerce.index').'?zone='.$data->id }}"
                                  data-side-pagination="server"
                                  data-show-copy-rows="true"
                                  data-pagination="true"
                                  data-trim-on-search="false"
                                  data-show-refresh="true"
                                  data-page-size="5"
                                  data-page-list="[5, 10, 20, 50, 100, 200]"
                                  data-search="true"
                                  data-show-print="true"
                                  data-show-pagination-switch="false"
                           >
                               <thead>
                               <tr>
                                   <th  class="small" data-field="raison_social"  data-sort="true">Raison sociale</th>
                                   <th class="small" data-field="type_commerce" data-sort="true">Type de commerce</th>
                                   <th  data-field="id" data-formatter="imageFormatter"  data-sort="true">Image</th>
                                   @can('Affecter Zone')
                                       <th data-field="id" data-align="center"
                                           data-formatter="optionsFormatterRemove" data-width="50px">
                                       </th>
                                   @endcan
                               </tr>
                               </thead>

                           </table>
                       </div>
                       <div class="col-lg-6" style="background: #f9f5f5;padding: 8px" >
                               <div class="col-lg-12" >
                                   <div id="toolbarAgentSelected">
                                       <b>LISTE DES AGENTS </b>


                                   <a class="btn btn-secondary  btn-sm  m-b-15 pull-right"  onclick="javascript:agentModal()">
                                       Ajouter  <i class="fa fa-plus-circle"></i>
                                   </a>
                                   <br>
                                   <br>
                                   </div>
                                   <br>

                                   <table id="tableAgentSelected"
                                          class="table table-bordered table-hover table-responsive table-striped"
                                          data-toggle="table"
                                          data-toolbar="#toolbarAgentSelected"
                                          data-click-to-select="true"
                                          data-single-select="true"
                                          data-url="{{ route('console.zone.agent').'?zone='.$data->id }}"
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

                                           <th class="small" data-field="name"  data-sort="true">Agents</th>
                                           <th  data-field="phone" data-sort="true">Contact</th>
                                           <th  data-field="id" data-formatter="imageFormatter"  data-sort="true">Image</th>
                                           @can('Affecter Zone')
                                           <th data-field="id" data-align="center"
                                               data-formatter="optionsFormatterRemoveAgents" data-width="50px">
                                           </th>
                                           @endcan
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

                @can('Affecter Zone')
                    <div class="modal fade" id="defaultModal" tabindex="-1" aria-labelledby="defaultModal" aria-hidden="true" role="dialog">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div id="toolbarCommerceDispo">
                                    <h4 class=""> LISTE DES COMMERCES NON AFFECTES</h4>
                                </div>
                                <div class="modal-body">
                                    <form >
                                        {{-- @csrf --}}
                                        {{--                            <input type="hidden" name="id" id="agent_id" value="{{$data->id}}">--}}

                                        <table id="tableCommerceDispo"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbarCommerceDispo"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.commerce.no_attach')."?zone=".$data->id}}"
                                               data-side-pagination="server"
                                               data-show-copy-rows="true"
                                               data-pagination="true"
                                               data-trim-on-search="false"
                                               data-page-size="5"
                                               data-page-list="[ 20, 50, 100, 300, 500]"
                                               data-search="true"
                                               data-show-print="true"
                                               data-show-pagination-switch="false"
                                        >
                                            <thead>
                                            <tr>
                                                <th data-field="raison_social"  data-sort="true">Commerce</th>
                                                <th  data-field="type" data-sort="true">Type de commerce</th>
                                                <th class="small" data-field="commune" data-sort="true">Commune</th>
                                                <th  data-field="id" data-formatter="imageFormatter"  data-sort="true">Image</th>
                                                <th data-field="id" data-align="center"
                                                    data-formatter="optionsFormatterAdd" data-width="50px">
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>

                                        {{--                            <div class="col-lg-8">--}}
                                        {{--                                <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>--}}
                                        {{--                                <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>--}}

                                        {{--                            </div>--}}

                                        {{--                            <div class="modal-footer">--}}

                                        {{--                            </div>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="defaultModalAgent"  aria-labelledby="defaultModalAgent" aria-hidden="true"  tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div id="toolbarAgentDispo">
                                    <h4 class=""> LISTE DES AGENTS</h4>
                                </div>
                                <div class="modal-body">
                                    <form >
                                        {{-- @csrf --}}
                                        {{--                            <input type="hidden" name="id" id="agent_id" value="{{$data->id}}">--}}

                                        <table id="tableAgentDispo"
                                               class="table table-bordered table-hover table-responsive table-striped"
                                               data-toggle="table"
                                               data-toolbar="#toolbarAgentDispo"
                                               data-click-to-select="true"
                                               data-single-select="true"
                                               data-url="{{ route('console.agent.no.attach')."?zone=".$data->id}}"
                                               data-side-pagination="server"
                                               data-show-copy-rows="true"
                                               data-pagination="true"
                                               data-trim-on-search="false"
                                               data-page-size="5"
                                               data-page-list="[ 20, 50, 100, 300, 500]"
                                               data-search="true"
                                               data-show-print="true"
                                               data-show-pagination-switch="false"
                                        >
                                            <thead>
                                            <tr>
                                                <th class="small" data-field="name"  data-sort="true">Nom & prénom(s)</th>
                                                <th class="small"  data-field="phone" data-sort="true">Contact</th>
                                                <th class="small" data-field="commune" data-sort="true">Commune</th>
                                                <th  data-field="id" data-formatter="imageFormatter"  data-sort="true">Image</th>
                                                <th data-field="id" data-align="center"
                                                    data-formatter="optionsFormatterAddAgent" data-width="50px">
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>

                                        {{--                            <div class="col-lg-8">--}}
                                        {{--                                <button type="button" data-dismiss="modal" class="btn btn-link waves-effect">Fermer</button>--}}
                                        {{--                                <button type="submit" class="btn btn-primary waves-effect submitbtn">Enregistrer</button>--}}

                                        {{--                            </div>--}}

                                        {{--                            <div class="modal-footer">--}}

                                        {{--                            </div>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

    </div>


    <input type="hidden" id="attach_agent_to_zone" value="{{route('console.zone.attach.agent')}}">
    <input type="hidden" id="dettach_agent_to_zone" value="{{route('console.zone.detattach.agent')}}">

    <input type="hidden" id="dettach_tozone" value="{{route('console.zone.detattach')}}">
    <input type="hidden" id="attache_zone" value="{{route('console.zone.attach')}}">
    <input type="hidden" id="zone" value="{{$data->id}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>
    <script src="{{asset('js/scripts/sticky.compile.js') }}"></script>
    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            var totalCommerceSelected = $('#tableCommerceSelect').bootstrapTable('getData').length;

            // document.getElementById("TextBoxContainer").rows.length;
            $(".total_count_commerce").html(totalCommerceSelected)
            // $('#droit-delegue').select2({});

            {{--$("#commerce").select2({--}}
            {{--    ajax: {--}}
            {{--        url: "{{route('console.commerce.search')}}",--}}
            {{--        dataType: 'json',--}}
            {{--        delay: 250,--}}
            {{--        data: function (params) {--}}
            {{--            return {--}}
            {{--                q: params.term, // search term--}}
            {{--                page: params.page,--}}
            {{--                --}}{{--ro_r: {{$data->role_id}},--}}
            {{--                --}}{{--ag_ia: '{{$data->id}}',--}}
            {{--                _token: $('meta[name="csrf-token"]').attr('content')--}}
            {{--            };--}}
            {{--        },--}}
            {{--        processResults: function (data, params) {--}}
            {{--            params.page = params.page || 1;--}}
            {{--            return {--}}
            {{--                results: data.items,--}}
            {{--                pagination: {--}}
            {{--                    more: (params.page * 30) < data.total_count--}}
            {{--                }--}}
            {{--            };--}}
            {{--        },--}}
            {{--        cache: true--}}
            {{--    },--}}
            {{--    placeholder: '',--}}
            {{--    language: "fr",--}}
            {{--    cache: false,--}}
            {{--width: "100%",--}}
            {{--    // minimumInputLength: 1,--}}
            {{--    templateResult: formatRepo,--}}
            {{--    templateSelection: formatRepoSelection--}}
            {{--});--}}


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
             $container.find(".select2-result-repository__description").html(repo.type_commerce);
            return $container;
        }

        function formatRepoSelection(repo) {

            var name = repo.name ? repo.name : "";
            // $("#comment small").html(comment);
            // if (comment) {
            //     $("#comment").css("display", "block");
            // }

            return repo.name || repo.text;

        }

    </script>
    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/zone.js') }}"></script>

@endsection


