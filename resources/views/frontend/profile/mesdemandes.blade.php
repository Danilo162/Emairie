@extends('frontend.layouts.main')
@section('content')

<link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/perso.css')}}">

<ul class="breadcrumb no-border no-radius b-b b-light pull-in" style="padding: 5px 0px;margin:0px;margin-top:6px;"> 
    <li><a href="{{route('etatcivil')}}"><i class="fa fa-home"></i> Etat civil</a></li>
    <li class="active">Mes demandes</li> 
</ul> 

<div id="main" class="clearfix" style=" border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile" style="padding-top: 0px;">

        @include('frontend.profile.menu')
        <div class="col-md-9">

            <div class="profile-content" style="padding-top: 0px;">

                <header class="panel-heading h4" style="border-bottom: 1px solid #eee;margin-bottom: 20px;"> LISTE DE MES DEMANDES</header> 

                @if(Session::has('warning'))
                    <div class="alert alert-warning">
                      {{Session::get('warning')}}
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success">
                      {{Session::get('message')}}
                    </div>
                @endif


                <header class="panel-heading h4">
                    <div class="actions pull-left" style="padding:0px;"> 
                        <a class="btn btn-sm btn-warning" href="{{route('etatcivil')}}" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouvelle démarche</a>
                    </div>
                </header> 
                <!--header class="panel-heading h4">
                    <div class="actions pull-right" style="padding:0px;"> 
                        <a class="btn btn-sm btn-warning" href="{{route('etatcivil')}}" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouvelle démarche</a>
                    </div>
                </header--> 
                    
                <!--h4>LISTE DE MES DEMANDES</h4-->

                <div class="col-lg-12 showOrHide">
                    <table class="table layout responsive-table" style="margin-top: 10px;" >
                        <thead>
                        <tr>
                            <th></th>
                            <th>Numéro acte</th>
                            <th>Type demande</th>
                            <th>Nombre copies </th>
                            <th>Mairie</th>
                            <th>Date demande</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($mesdemandes as $data)
                            <tr>
                                <td> <a href="{{route('etatcivil.demande.detail',$data->demande_id)}}"><i class="fa fa-cogs text-info" title="Afficher les détails"></i></a></td>
                                <td> {{$data->numero_acte}}</td>
                                <td> {{$data->name}}</td>
                                <td> {{$data->nombre_copies}} </td>
                                <td> {{$data->nom}}</td>
                                <td> {{$data->date_creation}} </td>
                                <td><span class="label label-{{strtolower(str_replace(' ','',$data->statut))}} ">{{$data->statut}}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('select2/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
            $(".shorForm").on("click", function () {
                $(".showOrHide").slideToggle();
            })
        })
    </script>
@endsection

