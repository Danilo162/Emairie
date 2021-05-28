<?php ?>

<div class="col-md-3">
    <div class="profile-sidebar">
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
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->

        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
           {{--     <li class="active">
                    <a href="{{route('profile')}}">
                        <i class="fa fa-home"></i>
                       Accueil
                    </a>
                </li>--}}
                <li class="active">
                    <a href="{{route('profile.detail')}}">
                        <i class="fa fa-user"></i>
                       Information générale
                    </a>
                </li>
                <li>
                    <a href="{{route('profile.commerce')}}">
                        <i class="fa fa-envelope"></i>
                        Commerce(s)
                    </a>
                </li>
                <li>
                    <a href="{{route('etatcivil.mesdemandes')}}" >
                        <i class="fa fa-list"></i>
                        Demandes état civil </a>
                </li>

            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>
