@extends('layouts.main')

@section('content')

        <div class="container-fluid">
            <div class="block-header">
                <h2>TABLEAU DE BORD ADMINISTRATEUR FONCTIONNEL</h2>
            </div>
            <div id="dashboard">
                <dashboard-component></dashboard-component>
            </div>
        </div>

        @stack('scripts')
        <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>
        <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
        {{--        <script src="{{ asset('echartjslib/echarts.js') }}"></script>--}}
        <script src="{{ asset('echartjslib/config.js') }}"></script>
        <script src="{{ asset('echartjslib/esl.js') }}"></script>
        <script src="{{ asset('js/console/dashbord_fonctionel.js') }}"></script>

@endsection
