@include('frontend.partials.header')
<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="top-full-width-sidebar inner-wrap clearfix"></div>
    <div>
        @yield('content')
    </div>
</div>
@include('frontend.partials.footer')

