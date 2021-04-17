@extends('layouts.main')
@section('content')
    @php
    $mairie = "";
   if(Request()->has('mairie'))
       {
     $mairie = Request()->get('mairie');
       }
   else{
       if((auth()->user()->isSuperAdmin())){
           $mairie = 0;
       }else{
       $mairie = mairies()->id;
       }
   }

    @endphp
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background: white">
                <div class="card" style="box-shadow: none !important;">
                    <div class="header">
                        <h2>
                            LISTE DES THEMES
{{--                            <small>--}}
{{--                                Taken by Google's Material Design Color page which link is--}}
{{--                                <a href="https://material.google.com/style/color.html#color-color-palette" target="_blank" title="Google's Material Design Color">material.google.com/style/color.html#color-color-palette</a>--}}
{{--                            </small>--}}
                        </h2>

                    </div>
                    <div class="body">
                        <div class="clearfix row">
                            @foreach($themes as $theme)
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                                <div style="margin-bottom: 2px" class="demo-color-box bg-{{$theme->name}}">
                                    <div class="color-name">{{ucfirst($theme->name)}}</div>
{{--                                    <div class="color-code">#F44336</div>--}}

                                </div>
                                <button @click="store('{{$theme->name}}')" class="btn btn-sm btn-default">Choisir</button>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <input type="hidden" id="store" value="{{route('console.theme.store')}}">
    <input type="hidden" id="mairie" value="{{$mairie}}">

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

    <script src="{{ asset('js/console/theme.js') }}"></script>
    <script>


    </script>
@endsection


