@extends('layouts.main')
@section('content')
    <style>
        .btn-group, .btn-group-vertical {
            box-shadow: none !important;
        }
    </style>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img  src="http://localhost/DigitMairie/public/images/user.png" alt="">
                <div>
                    <h4>Nom et prénom: </h4>
                    <p>Fonction:</p>
                    <p>Role: </p>

                    <div class="panel-group" id="accordion_3" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-success">
                            <div class="panel-heading" role="tab" id="headingOne_3">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion_3" href="#collapseOne_3" aria-expanded="true" aria-controls="collapseOne_3">
                                        <i class="fa fa-lock">   </i> Liste des permissions disponibles
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_3">
                                <div class="panel-body">
                                    <table id="table"
                                           class="table table-bordered table-hover table-primary table-striped"
                                           data-toggle="table"
                                           data-toolbar="#toolbar"
                                           data-click-to-select="true"
                                           data-single-select="true"
                                           data-url="{{ route('console.role.index') }}"
                                           data-side-pagination="server"
                                           data-show-copy-rows="true"
                                           data-pagination="true"
                                           data-trim-on-search="false"
                                           data-page-size="5"
                                           data-page-list="[5, 10, 20, 50, 100, 200]"
                                           data-search="true"
                                           data-show-refresh="false"
                                           data-filter-control="true"

                                           data-show-pagination-switch="false"
                                    >
                                        <thead>
                                        <tr>
                                            <th data-field="name" data-sort="true">Libellé</th>
                                            <th data-field="comment" data-sort="true">Commentaire</th>

                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
{{--                <div class="card no-shadow">--}}
                    <div class="body">
                        <div class="clearfix m-b-20">
                            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                <div class="panel-group" id="accordion_2" role="tablist"
                                     aria-multiselectable="true">
                                    <div class="panel panel-success">
                                        <div class="panel-heading" role="tab" id="headingOne_2">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                                    <i class="fa fa-lock-open"></i> Permissions déléguées
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                            <div class="panel-body">
                                                <table id="tableDelegue"
                                                       class="table table-bordered table-hover table-primary table-striped"
                                                       data-toggle="table"
                                                       data-toolbar="#toolbar"
                                                       data-click-to-select="true"
                                                       data-single-select="true"
                                                       data-url="{{ route('console.role.index') }}"
                                                       data-side-pagination="server"
                                                       data-show-copy-rows="true"
                                                       data-pagination="true"
                                                       data-trim-on-search="false"
                                                       data-page-size="5"
                                                       data-page-list="[5, 10, 20, 50, 100, 200]"
                                                       data-search="true"
                                                       data-show-refresh="false"
                                                       data-filter-control="true"

                                                       data-show-pagination-switch="false"
                                                >
                                                    <thead>
                                                    <tr>
                                                        <th data-field="name" data-sort="true">Libellé</th>
                                                        <th data-field="comment" data-sort="true">Commentaire</th>

                                                    </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="panel panel-success">--}}
{{--                                        <div class="panel-heading" role="tab" id="headingTwo_2">--}}
{{--                                            <h4 class="panel-title">--}}
{{--                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapseTwo_2" aria-expanded="false"--}}
{{--                                                   aria-controls="collapseTwo_2">--}}
{{--                                                    <i class="fa fa-user-lock"></i>  Permissions attribuées--}}
{{--                                                </a>--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                        <div id="collapseTwo_2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_2">--}}
{{--                                            <div class="panel-body">--}}
{{--                                                <table id="tableNormal"--}}
{{--                                                       class="table table-bordered table-hover table-primary table-striped"--}}
{{--                                                       data-toggle="table"--}}
{{--                                                       data-toolbar="#toolbar"--}}
{{--                                                       data-click-to-select="true"--}}
{{--                                                       data-single-select="true"--}}
{{--                                                       data-url="{{ route('console.role.index') }}"--}}
{{--                                                       data-side-pagination="server"--}}
{{--                                                       data-show-copy-rows="true"--}}
{{--                                                       data-pagination="true"--}}
{{--                                                       data-trim-on-search="false"--}}
{{--                                                       data-page-size="5"--}}
{{--                                                       data-page-list="[5, 10, 20, 50, 100, 200]"--}}
{{--                                                       data-search="true"--}}
{{--                                                       data-show-refresh="false"--}}
{{--                                                       data-filter-control="true"--}}

{{--                                                       data-show-pagination-switch="false"--}}
{{--                                                >--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th data-field="name" data-sort="true">Libellé</th>--}}
{{--                                                        <th data-field="comment" data-sort="true">Commentaire</th>--}}

{{--                                                    </tr>--}}
{{--                                                    </thead>--}}

{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                            </div>

                        </div>

                    </div>
{{--                </div>--}}
            </div>
            <!-- #END# Default Example -->
        </div>
    </div>
    <input type="hidden" id="store" value="{{route('console.role.assign-permission')}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>

    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
{{--    <script src="{{ asset('js/scripts/sticky.compile.js') }}"></script>--}}
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>

{{--    <script src="{{ asset('js/console/role_permission.js') }}"></script>--}}

@endsection


