@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{asset('select2/css/select2.css')}}" type="text/css">
    <style>
        .padding-10 {
            padding: 10px !important;
        }
   .fs-14{
       font-size: 14px !important;
   }
    </style>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card col-lg-12">
       <div class="body" style="background: #fefafa14">
           <div class="block-header head_build bg-effet">
               <h2> <span class="fa-1x">Mairie</span>

               </h2>
           </div>
           <br>
           <br>
           <div class="block-header head_build bg-effet">
               <h2> <span class="fa-1x"> Mes informations</span>

               </h2>
           </div>
           <br>

          </div>

                </div>
            </div>
        </div>
    </div>



    <input type="hidden" id="store_delegation" value="{{route('console.role.delegation_store')}}">
    <input type="hidden" id="destroy_delegation" value="{{route('console.role.delegation_destroy')}}">
    <input type="hidden" id="storeAgent" value="{{route('console.agent.store')}}">
    <input type="hidden" id="storeAgent" value="{{route('console.agent.store')}}">
    <input type="hidden" id="agent_info" value="{{route('console.agent.infos')}}">
    <input type="hidden" id="changepass" value="{{route('console.agent.changepass')}}">


    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            // $('#droit-delegue').select2({});

            $("#droit-delegue").select2({
                ajax: {
                    url: "{{route('console.permission.index.delegue')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Selectionner un  ',
                language: "fr",
                cache: false,
                // minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });


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
            // $container.find(".select2-result-repository__description").html(is_disponible);
            return $container;
        }

        function formatRepoSelection(repo) {

            var comment = repo.comment ? repo.comment : "";
            $("#comment small").html(comment);
            if (comment) {
                $("#comment").css("display", "block");
            }

            return repo.name || repo.text;

        }

    </script>
    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/user_permission.js') }}"></script>

@endsection


