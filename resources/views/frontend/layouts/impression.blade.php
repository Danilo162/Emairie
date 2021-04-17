<!DOCTYPE html>
<html lang="fr">
    <head>
      {{--  <link rel="stylesheet" href="{{ ltrim(asset('css/bootstrap.min.css'), '/') }}">--}}
{{--        <link rel="stylesheet" href="{{ ltrim(elixir('bootstrap/app.css'), '/') }}">--}}
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 80px 25px 70px 50px;
            }

            footer {
                position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                text-align: center;
                line-height: 35px;
            }
     .font-Arial{
         font-family: "Arial";
     }
     .font-Newtimes{
         font-family: "Times New Roman";
     }
            .b{
                font-weight: 600;
           }
            .align-left{
                text-align: center;
            }
            .table-user-information > tbody > tr {
                border-top: .01px solid rgba(221, 221, 221, 0.6);
            }
            .table-user-information > tbody > tr:first-child {
                border-top: 0;

            }
            .table-user-information > tbody > tr {
                /*background: #fff;*/
                background: #fff;
            }
            .table-user-information > tbody > tr:nth-child(odd) {

                background: #eae6e0;
            }
            .table-user-information > tbody > tr > td {
                border-top: 0;
            }
            .c-orange{
                color: orange;
            }
            .c-blue-light{
                color: #16aaff;
            } .c-blue{
                color: #16aaff;
            }
            .b-blue-light{
                background: #16aaff;
                color: white;
            }
            .col8{
                display: inline-block;
                float: left;
                width: 66.66667%;
            }.col4{
                display: inline-block;
                float: left;
                width: 33.333333%;
            }
            .row{
                display: inline-block;
            }
            body{
                font-size: 12px;
            }

            /* Profile Content */
            .profile-content {
                padding: 20px;
                background: #fff;
                min-height: 460px;
            }
            .td-title{
                font-size: 12px;
                font-weight: 600;
                width: 40%
            }
            .td-title_{
                font-size: 13px;
                font-weight: 600;

            }

            .td-title {
                font-size: 12px;
                font-weight: 600;
                width: 40%;
            }
            .bg-grey-tr{
                background-color: #d6d8db;
                padding: 8px;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }
            table {
                border-collapse: collapse;
            }
            .table-secondary, .table-secondary > td, .table-secondary > th {
                background-color: #d6d8db;
            }
            .txt-align-center {
                text-align: center;
            }
            table-bordered thead td, .table-bordered thead th {
                border-bottom-width: 2px;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
                border-bottom-width: 2px;
            }
            .table-secondary tbody + tbody, .table-secondary td, .table-secondary th, .table-secondary thead th {
                border-color: #b3b7bb;
                border-bottom-color: rgb(179, 183, 187);
            }
            .table-secondary, .table-secondary > td, .table-secondary > th {
                background-color: #d6d8db;
            }
            .table-bordered td, .table-bordered th {
                border: 1px solid #dee2e6;
                border-top-color: rgb(222, 226, 230);
                border-right-color: rgb(222, 226, 230);
                border-bottom-color: rgb(222, 226, 230);
                border-bottom-style: solid;
                border-bottom-width: 1px;
                border-left-color: rgb(222, 226, 230);
            }
            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            th {
                text-align: inherit;
            }
            .table-bordered td, .table-bordered th {
                border: 1px solid #dee2e6;
            }
            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            .td-title {
                font-size: 12px;
                font-weight: 600;
                width: 40%;
            }
            .txt-upper{
                text-transform: uppercase;
            }
        </style>
    </head>
    <body style="background: white">
        @yield('content')
    </body>
</html>
