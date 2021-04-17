@extends('frontend.layouts.main')
@section('content')

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
    </style>

<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile">
        @include('frontend.profile.menu')
        <div class="col-md-9">
            <div class="profile-content">
                <h4>LISTE DE MES COMMERCES</h4>
                <table class="table layout responsive-table" style="margin-top: 10px;" >
                    <thead>
                    <tr>
                        <th>Raison sociale</th>
                        <th>Type</th>
                        <th>Zone</th>
                        <th>Quartier</th>
                        <th>Commune</th>
                        <th>Image</th>
                        <th>Etat</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($datas as $data)
                    <tr>
                        <td style="font-size: 11px;width: 25%">{{$data->raison_social}} </td>
                        <td > {{$data->type_commerce}}</td>
                        <td > {{$data->zone}}</td>
                        <td > {{$data->quartier}}</td>
                        <td > {{$data->commune}}</td>
                        <td ><img src="{{asset('storage/'.$data->picture)}}" style="height: 25px" alt=""></td>
                        <td @if( $data->total_prev & intval($data->total_prev)>intval($data->total_paided)) style="background: red;color: white"
                            @elseif($data->total_prev & intval($data->total_prev)==intval($data->total_paided)) style="background: lightseagreen;color: white" @else   @endif >&nbsp;</td>

                        <td style="text-align: center">
                            <a href='{{route('entreprise.detail')."?q=".$data->id}}' class='btn  waves-effect btn-sm no-shadow' title='Detail'  type='button'>
                                <i class="fa fa-2x fa-arrow-alt-circle-right " style="color: dodgerblue"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

