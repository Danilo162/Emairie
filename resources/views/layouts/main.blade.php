
@include('partials.header')
<section class="content" id="content">
    <div id="progress_bar_content" class="progress" style="height: 15px;display: none">
        <div id="progress_bar" class="progress-bar  progress-bar-success" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="100" style="width: 75%;height: 15px;line-height: 15px">

        </div>
    </div>
    @yield('content');
</section>
@include('partials.footer')

