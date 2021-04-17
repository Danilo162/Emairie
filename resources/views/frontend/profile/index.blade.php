@extends('frontend.layouts.main')
@section('content')
    <style>
        #main{
            background: transparent;
            padding-top: 0px;
            margin-top: 0px;
        }
        .
    </style>
<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile">
        @include('frontend.profile.menu')
        <div class="col-md-9">
            <div class="profile-content">
                Some user related content goes here...
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

