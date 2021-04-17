@extends('frontend.layouts.main')
@section('content')

    <style>
        #main{
            background: transparent;
            padding-top: 0px;
            margin-top: 0px;
        }
        td{
            font-size: 11px;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }
    </style>

<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile">
        @include('frontend.profile.menu')
        <div class="col-md-9">
            <div class="profile-content">
                <h4>MES INFORMATIONS</h4>
                <table class="table table-bordered table-striped" style="margin-top: 10px;" >

                    <tbody>
                    <tr><td style="font-size: 11px;width: 25%">Nom </td><td > {{$data->lastname}}</td></tr>

                    <tr><td style="font-size: 11px">Prénom(s) </td><td > {{$data->firstname}}</td></tr>

                    <tr><td style="font-size: 11px;width: 25%">Contact(s) </td><td > {{$data->phone}}  - {{$data->phone2}}</td></tr>
                    <tr><td style="font-size: 11px;width: 25%">E-mail </td><td > {{$data->email}}</td></tr>
                    <tr><td style="font-size: 11px;width: 25%">Fonction </td><td > {{$data->job}}</td></tr>
                    <tr><td style="font-size: 11px;width: 25%">Commune de residence </td><td > {{$data->commune}}  ({{$data->quartier_residence}} )</td></tr>
                    <tr><td style="font-size: 11px;width: 25%">Date et lieu de naissance </td><td > {{$data->birth_date}}  à {{$data->birth_place}}  ({{$data->commune_naissance}} )</td></tr>
                    <tr><td style="font-size: 11px;width: 25%">Genre </td><td > {{$data->gender}}  </td></tr>
                    <tr><td style="font-size: 11px;width: 25%">N° pièce </td><td > {{$data->identity_papers_id }}  {{$data->identity_papers_type }}   </td></tr>
                    <tr><td style="font-size: 11px;width: 25%">N° d'acte de naissance</td><td > {{$data->birth_certificate_number }}  </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

