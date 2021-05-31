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

            <div class="profile-content">

                <header class="panel-heading h4" style="border-bottom: 1px solid #eee;margin-bottom: 20px;"> DÉTAILS D'UNE DEMANDE</header> 

                <table class="table table-bordered table-striped" style="margin-top: 10px;" >

                    <tbody>
                    <tr><td style="width: 25%">N° acte </td><td > {{$demande->numero_acte}}</td></tr>
                    <tr><td>Type </td><td > {{$demande->name}}</td></tr>
                    <tr><td>Nombre copies </td><td > {{$demande->nombre_copies}}</td></tr>
                    <tr><td>Mairie </td><td > {{$demande->nom}}</td></tr>

                    @if($demande->service_id == 1)
                    <tr><td>Date naissance </td><td > {{$demande->titulaire_date_naissance}}</td></tr>
                    <tr><td>Lieu naissance </td><td > {{$demande->titulaire_lieu_naissance}}</td></tr>
                    <tr><td>Nom du père </td><td > {{$demande->titulaire_nom_pere}}</td></tr>
                    <tr><td>Nom de la mère </td><td > {{$demande->titulaire_nom_mere}}</td></tr>
                    @elseif($demande->service_id == 100)
                    <tr><td>Nom du marié </td><td > {{$demande->nom_marie}}</td></tr>
                    <tr><td>Nom du marié </td><td > {{$demande->nom_marie}}</td></tr>
                    <tr><td>Nom de la mariée </td><td > {{$demande->nom_mariee}}</td></tr>
                    <tr><td>Prénoms de la mariée </td><td > {{$demande->prenoms_mariee}}</td></tr>
                    @endif
                    <tr><td>Date demande</td><td > {{$demande->date_creation}}</td></tr>
                    <tr><td>Statut</td><td > <span class="label label-{{strtolower(str_replace(' ','',$demande->statut))}} ">{{$demande->statut}}</span></td></tr>

                    </tbody>
                </table>
                <br>

            </div>
        </div>
    </div>
    </div>


@endsection

