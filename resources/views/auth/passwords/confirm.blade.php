<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Changer votre Mot de Passe | DigiTaxCollect</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('../../favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('../../plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('../../plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('../../plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('../../css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>DIGITAXCOLLECT</b></a>
            <small>Admin ADVANTECH - Espace Membre</small>
        </div>
        <div class="card">
            <div class="body">

                <form id="sign_in" method="POST" action="{{ route('password.confirm') }}">
					       @csrf

                    <div class="msg">S'il vous plaît, renseignez votre Mot de Passe avant de continuer:</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        <div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-xs-8 p-t-5">

                          </div>
                          <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">Valider</button>
                          </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ route('register') }}">S'inscrire</a>
                        </div>
                        <div class="col-xs-6 align-right">
              							@if (Route::has('password.request'))
              								<a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
              							@endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('../../plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('../../plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('../../plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{asset('../../plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('../../js/admin.js')}}"></script>
    <script src="{{asset('../../js/pages/examples/sign-in.js')}}"></script>
</body>

</html>
