@extends('layouts.main')
@section('content')

    <div class="container-fluid">
    {{--        <div class="block-header">--}}
    {{--            <h2> <i class="fa fa-lock-open"></i> LISTE DES PERMISSIONS  <span class="orange-text total-text total_count"></span></h2>--}}
    {{--        </div>--}}
    {{--        <input type="checkbox" id="md_checkbox_29" class="filled-in chk-col-teal" checked />--}}
    {{--        <label for="md_checkbox_29">TEAL</label>--}}
    <!-- Color Pickers -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="block-header">
                                <div class="col-lg-12">
                                    <h4
                                         class="">Rôle : <span  data-toggle="tooltip" data-placement="bottom" title="{{$role->comment}}" class="orange-text">{{$role->name}}</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="checkbox" id="select-all" value="all"
                                                   class="filled-in  chk-col-orange" />
                                            <label for="select-all" class="orange-text">Tout sélectionner / Déselectionner</label>
                                        </div>
                                      <div class="divider">&nbsp;</div>
                                    </div>
                                    <form id="frmCreate"
                                          @submit.prevent="store"
                                          method="POST">
                                        <input type="hidden" name="role_id" value="{{$role->id}}">

                                    <div class="row">
                                        <div class="col-lg-12 demo-checkbox">
                                        @foreach($permissions as $permission)
                                                    <input
                                                           id="permission{{$permission->id}}" type="checkbox"
                                                           {{($role->hasPermission($permission)) ? 'checked':''}}
                                                    name="permission_id[]" class="filled-in chk-col-teal form-check-input"
                                                    value="{{$permission->id}}" />
                                                    <label data-toggle="tooltip" data-placement="bottom" title="{{$permission->comment}}"
                                                           for="permission{{$permission->id}}">{{$permission->name}}</label>
                                        @endforeach
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
    </div>
    <input type="hidden" id="store" value="{{route('console.role.assign-permission')}}">

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>



{{--    <script src="{{ asset('js/scripts/sticky.compile.js') }}"></script>--}}
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>

    <script src="{{ asset('js/console/role_permission.js') }}"></script>

@endsection


