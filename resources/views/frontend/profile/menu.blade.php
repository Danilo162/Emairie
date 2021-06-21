<style type="text/css">
    <!--
        
    .profile-usermenu ul li a {
        margin-left: -2px;
        padding: 5px;
        width: 100%;
        display: inline-block;

      }
      -->
</style>

<div class="col-md-3">
    <div class="profile-sidebar">
        <h4 style="padding: 10px;font-weight: bold;">Mon espace perso</h4>
        @auth 
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic" style="text-align: center">
            <img src="{{auth()->user()->picture?asset('storage/'.auth()->user()->picture):asset("images/avatar.png")}}" class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{auth()->user()->name}}
            </div>
            <div class="profile-usertitle-job">
                {{administred()?administred()->job:""}}
            </div>
            <div>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->

        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="">
                    <a href="{{route('profile.detail')}}">
                        <i class="fa fa-user"></i>
                       Mes informations
                    </a>
                </li>
                <li>
                    <a href="{{route('profile.commerce')}}">
                        <i class="fa fa-envelope"></i>
                        Commerces
                    </a>
                </li>
                <li class="active">
                    <a href="{{route('etatcivil')}}">
                        <i class="fa fa-home"></i>
                       Nouvelle démarche
                    </a>
                </li>
                <!--li>
                    <a href="{{route('profile.demande')}}" >
                        <i class="fa fa-list"></i>
                        Demandes </a>
                </li-->
                <li>
                    <a href="{{route('etatcivil.mesdemandes')}}" >
                    <i class="fa fa-list"></i>
                    Mes demandes </a>
                </li>

            </ul>
        </div>
        <!-- END MENU -->

        @else


        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active">
                    <a href="{{route('profile.login')}}">
                        <i class="fa fa-user"></i>
                       Se connecter
                    </a>
                </li>
                <li>
                    <a href="{{route('profile.register')}}">
                        <i class="fa fa-envelope"></i>
                        Créer un compte
                    </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->


        @endauth
    </div>
</div>
