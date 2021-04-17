@extends('frontend.layouts.main')
@section('content')

    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
    <style>
        #main{
            background: transparent;
            padding-top: 0px;
            margin-top: 0px;
        }
        td,th{
            font-size: 11px;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }
        select.form-control {
            height: auto !important;
            padding: .6rem .8rem calc(.6rem + 1px) .8rem !important;
        }
        .form-control {
            padding: .6rem .8rem !important;
            border: 2px solid #ced4da !important;
            transition: none !important;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
.btn-warning{
    background: orange !important;
}.btn-info{
    background: dodgerblue !important;
}.btn-success{
    background: mediumseagreen !important;
}
    </style>

<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile">
        @include('frontend.profile.menu')
        <div class="col-md-9">
            <div class="profile-content">
                <h4>LISTE DE MES DEMANDES</h4>

                    <button
                            type="button" class="btn btn-success btn-sm shorForm">
                        <i class="fa fa-plus"></i>Nouvelle demande</button>
                <br>
                <div class="col-lg-8 showOrHide" style="display: none">
                    <form style="background: rgba(211,211,211,0.24);padding: 10px" class="form-horizontal " action="{{route('mairie.service')}}"

                          method="GET">
                        <div class="form-group row">
                            <label for=""
                                   class="col-sm-4 col-form-label ">Mairie</label>
                            <div class="col-sm-8">
                                <select style="width: 100%" required name="q" id="q" class="form-control select2">
                                    <option value=""></option>
                                    @foreach($mairies as $mairie)
                                    <option value="{{$mairie->id}}">{{$mairie->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for=""
                                   class="col-sm-4 col-form-label ">Service</label>
                            <div class="col-sm-8">
                                <select style="width: 100%" required name="target" id="" class="form-control select2">
                                    <option value=""></option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <button style="background: dodgerblue" type="submit" class="btn btn-primary submitbtn">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>

                <br>
                <div class="col-lg-12 showOrHide">
                    <table class="table layout responsive-table" style="margin-top: 10px;" >
                        <thead>
                        <tr>
                            <th>Service</th>
                            <th>Mairie</th>
                            <th>Etat</th>
                            <th>Fait le </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($datas as $data)
                            <tr>
                                <td style="font-size: 11px;width: 25%"> {{$data->service}}  {{$data->quantite?" (".$data->quantite.")":""}}</td>
                                <td > {{$data->mairie}}</td>
                                <td > <?=demande_etat($data->status)?> </td>
                                <td > {{$data->created}}</td>
                                <td > <?=dowloand_file($data->status,$data->administred_id,$data->id)?> </td>

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

