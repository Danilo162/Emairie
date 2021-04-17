@extends('layouts.main')
@section('content')
    <style type="text/css">
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image td, .table-image th {
            vertical-align: middle;
        }

        .search-form .form-group {
            float: left !important;
            transition: all 0.35s, border-radius 0s;
            width: 32px;
            height: 32px;
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
            border-radius: 25px;
            border: 1px solid #ccc;
        }
        .search-form .form-group input.form-control {
            padding-right: 35px;
            border: 0 none;
            background: transparent;
            box-shadow: none;
            display:block;
        }
        .search-form .form-group input.form-control::-webkit-input-placeholder {
            display: none;
        }
        .search-form .form-group input.form-control:-moz-placeholder {
            /* Firefox 18- */
            display: none;
        }
        .search-form .form-group input.form-control::-moz-placeholder {
            /* Firefox 19+ */
            display: none;
        }
        .search-form .form-group input.form-control:-ms-input-placeholder {
            display: none;
        }
        .search-form .form-group:hover,
        .search-form .form-group.hover {
            width: 100%;
            border-radius: 4px 25px 25px 4px;
        }
        .search-form .form-group span.form-control-feedback {
            position: absolute;
            top: -1px;
            left: -2px;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            color: #3596e0;
            left: initial;
            font-size: 14px;
        }

        .roundedImage{
            overflow:hidden;
            -webkit-border-radius:50px;
            -moz-border-radius:50px;
            border-radius:50px;
            width: 200px;
            height 200px;
        }
    </style>
 @livewireStyles
    <div class="container-fluid">
        <div class="block-header">
            <h2>GESTION DES COMMERCES</h2>
        </div>
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        @livewire('commerce')
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Body Copy -->
    </div>

@livewireScripts
<script type="text/javascript">
    window.livewire.on('userStore', () => {
        $('#createModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('.date-fr').bootstrapMaterialDatePicker({
                weekStart : 0,
                time: false,
                lang: 'fr',
                cancelText : 'ANNULER',
				nowButton : true,
				switchOnClick : true});
</script>
@endsection

