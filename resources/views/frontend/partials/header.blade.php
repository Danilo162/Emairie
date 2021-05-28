<?php
?>
    <!DOCTYPE html>
<html lang="en-US">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
  {{--  <title>Mairie d'ATTECOUBE</title>--}}

    <title>{{ config('app.name', "MyEmairie") }} - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css"/--> 

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css"/> 

    
    <link rel="stylesheet" href="{{asset('frontend/css/605fd6d743e672381fdb174b3c1cda56.css')}} " data-minify="1" />

    <script type='text/javascript'>
        function ctSetCookie(c_name, value, def_value) {
            document.cookie = c_name + '=' + escape(value) + '; path=/';
        }
        ctSetCookie('ct_checkjs', 'c189eb9a0fdbd8b351fde11addd847ff6b80973389b95ec6f0235214021e7566', '0');
    </script>
    <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />


    <script type="text/javascript" data-cfasync="false">
        var mi_version = '7.10.4';
        var mi_track_user = true;
        var mi_no_track_reason = '';

        var disableStr = 'ga-disable-UA-148726606-1';

        /* Function to detect opted out users */
        function __gaTrackerIsOptedOut() {
            return document.cookie.indexOf(disableStr + '=true') > -1;
        }

        /* Disable tracking if the opt-out cookie exists. */
        if (__gaTrackerIsOptedOut()) {
            window[disableStr] = true;
        }

        /* Opt-out function */
        function __gaTrackerOptout() {
            document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
            window[disableStr] = true;
        }

        if (mi_track_user) {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../www.google-analytics.com/analytics.js', '__gaTracker');

            __gaTracker('create', 'UA-148726606-1', 'auto');
            __gaTracker('set', 'forceSSL', true);
            __gaTracker('require', 'displayfeatures');
            __gaTracker('send', 'pageview');
        } else {
            console.log("");
            (function() {
                /* https://developers.google.com/analytics/devguides/collection/analyticsjs/ */
                var noopfn = function() {
                    return null;
                };
                var noopnullfn = function() {
                    return null;
                };
                var Tracker = function() {
                    return null;
                };
                var p = Tracker.prototype;
                p.get = noopfn;
                p.set = noopfn;
                p.send = noopfn;
                var __gaTracker = function() {
                    var len = arguments.length;
                    if (len === 0) {
                        return;
                    }
                    var f = arguments[len - 1];
                    if (typeof f !== 'object' || f === null || typeof f.hitCallback !== 'function') {
                        console.log('Not running function __gaTracker(' + arguments[0] + " ....) because you are not being tracked. " + mi_no_track_reason);
                        return;
                    }
                    try {
                        f.hitCallback();
                    } catch (ex) {

                    }
                };
                __gaTracker.create = function() {
                    return new Tracker();
                };
                __gaTracker.getByName = noopnullfn;
                __gaTracker.getAll = function() {
                    return [];
                };
                __gaTracker.remove = noopfn;
                window['__gaTracker'] = __gaTracker;
            })();
        }
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline!important;
            border: none!important;
            box-shadow: none!important;
            height: 1em!important;
            width: 1em!important;
            margin: 0 .07em!important;
            vertical-align: -0.1em!important;
            background: none!important;
            padding: 0!important
        }
    </style>
    <link rel='stylesheet' id='colormag_googlefonts-css' href='http://fonts.googleapis.com/css?family=Open+Sans&amp;ver=3fd96bfa118f0bf45300b51b00513765' type='text/css' media='all' />
    <script type='text/javascript'>
    </script>

    <script type='text/javascript' src='https://demo.themegrill.com/colormag-pro/wp-content/themes/colormag-pro/js/html5shiv.min.js?ver=3fd96bfa118f0bf45300b51b00513765'></script>

    <link rel='https://api.w.org/' href='https://demo.themegrill.com/colormag-pro/wp-json/' />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://demo.themegrill.com/colormag-pro/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://demo.themegrill.com/colormag-pro/wp-includes/wlwmanifest.xml" />


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">

    <style type="text/css">
        .colormag-button,
        blockquote,
        button,
        input[type=reset],
        input[type=button],
        input[type=submit] {
            background-color: #219b9c
        }

        a,
        #masthead .main-small-navigation li:hover>.sub-toggle i,
        #masthead .main-small-navigation li.current-page-ancestor>.sub-toggle i,
        #masthead .main-small-navigation li.current-menu-ancestor>.sub-toggle i,
        #masthead .main-small-navigation li.current-page-item>.sub-toggle i,
        #masthead .main-small-navigation li.current-menu-item>.sub-toggle i,
        #masthead.colormag-header-classic #site-navigation .fa.search-top:hover,
        #masthead.colormag-header-classic #site-navigation.main-small-navigation .random-post a:hover .fa-random,
        #masthead.colormag-header-classic #site-navigation.main-navigation .random-post a:hover .fa-random,
        #masthead.colormag-header-classic .breaking-news .newsticker a:hover,
        .dark-skin #masthead.colormag-header-classic #site-navigation.main-navigation .home-icon:hover .fa {
            color: #219b9c
        }

        #site-navigation {
            border-top: 4px solid #219b9c
        }

        .home-icon.front_page_on,
        .main-navigation a:hover,
        .main-navigation ul li ul li a:hover,
        .main-navigation ul li ul li:hover>a,
        .main-navigation ul li.current-menu-ancestor>a,
        .main-navigation ul li.current-menu-item ul li a:hover,
        .main-navigation ul li.current-menu-item>a,
        .main-navigation ul li.current_page_ancestor>a,
        .main-navigation ul li.current_page_item>a,
        .main-navigation ul li:hover>a,
        .main-small-navigation li a:hover,
        .site-header .menu-toggle:hover,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover>a,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor>a,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item>a,
        #masthead.colormag-header-clean #site-navigation .menu-toggle:hover,
        #masthead.colormag-header-clean #site-navigation.main-small-navigation .menu-toggle,
        #masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle,
        #masthead .main-small-navigation li:hover>a,
        #masthead .main-small-navigation li.current-page-ancestor>a,
        #masthead .main-small-navigation li.current-menu-ancestor>a,
        #masthead .main-small-navigation li.current-page-item>a,
        #masthead .main-small-navigation li.current-menu-item>a,
        #masthead.colormag-header-classic #site-navigation .menu-toggle:hover,
        .main-navigation ul li.focus>a,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.focus>a {
            background-color: #219b9c
        }

        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor,
        #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item,
        #masthead.colormag-header-classic #site-navigation .menu-toggle:hover,
        #masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle,
        #masthead.colormag-header-classic .main-navigation ul>li:hover>a,
        #masthead.colormag-header-classic .main-navigation ul>li.current-menu-item>a,
        #masthead.colormag-header-classic .main-navigation ul>li.current-menu-ancestor>a,
        #masthead.colormag-header-classic .main-navigation ul li.focus>a {
            border-color: #219b9c
        }

        #masthead.colormag-header-classic .main-navigation .home-icon a:hover .fa {
            color: #219b9c
        }

        .main-small-navigation .current-menu-item>a,
        .main-small-navigation .current_page_item>a,
        #masthead.colormag-header-clean .main-small-navigation li:hover>a,
        #masthead.colormag-header-clean .main-small-navigation li.current-page-ancestor>a,
        #masthead.colormag-header-clean .main-small-navigation li.current-menu-ancestor>a,
        #masthead.colormag-header-clean .main-small-navigation li.current-page-item>a,
        #masthead.colormag-header-clean .main-small-navigation li.current-menu-item>a {
            background: #219b9c
        }

        #main .breaking-news-latest,
        .fa.search-top:hover {
            background-color: #219b9c
        }

        .byline a:hover,
        .comments a:hover,
        .edit-link a:hover,
        .posted-on a:hover,
        .social-links i.fa:hover,
        .tag-links a:hover,
        #masthead.colormag-header-clean .social-links li:hover i.fa,
        #masthead.colormag-header-classic .social-links li:hover i.fa,
        #masthead.colormag-header-clean .breaking-news .newsticker a:hover {
            color: #219b9c
        }

        .widget_featured_posts .article-content .above-entry-meta .cat-links a,
        .widget_call_to_action .btn--primary,
        .colormag-footer--classic .footer-widgets-area .widget-title span::before,
        .colormag-footer--classic-bordered .footer-widgets-area .widget-title span::before {
            background-color: #219b9c
        }

        .widget_featured_posts .article-content .entry-title a:hover {
            color: #219b9c
        }

        .widget_featured_posts .widget-title {
            border-bottom: 2px solid #219b9c
        }

        .widget_featured_posts .widget-title span,
        .widget_featured_slider .slide-content .above-entry-meta .cat-links a {
            background-color: #219b9c
        }

        .widget_featured_slider .slide-content .below-entry-meta .byline a:hover,
        .widget_featured_slider .slide-content .below-entry-meta .comments a:hover,
        .widget_featured_slider .slide-content .below-entry-meta .posted-on a:hover,
        .widget_featured_slider .slide-content .entry-title a:hover {
            color: #219b9c
        }

        .widget_highlighted_posts .article-content .above-entry-meta .cat-links a {
            background-color: #219b9c
        }

        .widget_block_picture_news.widget_featured_posts .article-content .entry-title a:hover,
        .widget_highlighted_posts .article-content .below-entry-meta .byline a:hover,
        .widget_highlighted_posts .article-content .below-entry-meta .comments a:hover,
        .widget_highlighted_posts .article-content .below-entry-meta .posted-on a:hover,
        .widget_highlighted_posts .article-content .entry-title a:hover {
            color: #219b9c
        }

        .category-slide-next,
        .category-slide-prev,
        .slide-next,
        .slide-prev,
        .tabbed-widget ul li {
            background-color: #219b9c
        }

        i.fa-arrow-up,
        i.fa-arrow-down {
            color: #219b9c
        }

        #secondary .widget-title {
            border-bottom: 2px solid #219b9c
        }

        #content .wp-pagenavi .current,
        #content .wp-pagenavi a:hover,
        #secondary .widget-title span {
            background-color: #219b9c
        }

        #site-title a {
            color: #219b9c
        }

        .page-header .page-title {
            border-bottom: 2px solid;
        }

        #content .post .article-content .above-entry-meta .cat-links a,
        .page-header .page-title span {
            background-color: #219b9c
        }

        #content .post .article-content .entry-title a:hover,
        .entry-meta .byline i,
        .entry-meta .cat-links i,
        .entry-meta a,
        .post .entry-title a:hover,
        .search .entry-title a:hover {
            color: #219b9c
        }

        .entry-meta .post-format i {
            background-color: #219b9c
        }

        .entry-meta .comments-link a:hover,
        .entry-meta .edit-link a:hover,
        .entry-meta .posted-on a:hover,
        .entry-meta .tag-links a:hover,
        .single #content .tags a:hover {
            color: #219b9c
        }

        .format-link .entry-content a,
        .more-link {
            background-color: #219b9c
        }

        .count,
        .next a:hover,
        .previous a:hover,
        .related-posts-main-title .fa,
        .single-related-posts .article-content .entry-title a:hover {
            color: #219b9c
        }

        .pagination a span:hover {
            color: #219b9c;
            border-color: #219b9c
        }

        .pagination span {
            background-color: #219b9c
        }

        #content .comments-area a.comment-edit-link:hover,
        #content .comments-area a.comment-permalink:hover,
        #content .comments-area article header cite a:hover,
        .comments-area .comment-author-link a:hover {
            color: #219b9c
        }

        .comments-area .comment-author-link span {
            background-color: #219b9c
        }

        .comment .comment-reply-link:hover,
        .nav-next a,
        .nav-previous a {
            color: #219b9c
        }

        .footer-widgets-area .widget-title {
            border-bottom: 2px solid #219b9c
        }

        .footer-widgets-area .widget-title span {
            background-color: #219b9c
        }

        #colophon .footer-menu ul li a:hover,
        .footer-widgets-area a:hover,
        a#scroll-up i {
            color: #219b9c
        }

        .advertisement_above_footer .widget-title {
            border-bottom: 2px solid #219b9c
        }

        .advertisement_above_footer .widget-title span {
            background-color: #219b9c
        }

        .sub-toggle {
            background: #219b9c
        }

        .main-small-navigation li.current-menu-item>.sub-toggle i {
            color: #219b9c
        }

        .error {
            background: #219b9c
        }

        .num-404 {
            color: #219b9c
        }

        #primary .widget-title {
            border-bottom: 2px solid #219b9c
        }

        #primary .widget-title span {
            background-color: #219b9c
        }

        .related-posts-wrapper-flyout .entry-title a:hover {
            color: #219b9c
        }

        .related-posts-wrapper.style-three .article-content .entry-title a:hover:before {
            background: #219b9c
        }

        .human-diff-time .human-diff-time-display:hover {
            color: #219b9c
        }

        .widget_slider_area .widget-title,
        .widget_beside_slider .widget-title {
            border-bottom: 2px solid#219b9c
        }

        .widget_slider_area .widget-title span,
        .widget_beside_slider .widget-title span {
            background-color: #219b9c
        }

        .top-full-width-sidebar .widget-title {
            border-bottom: 2px solid #219b9c
        }

        .top-full-width-sidebar .widget-title span {
            background-color: #219b9c
        }

        #colophon .tg-upper-footer-widgets .widget {
            background-color: #2c2e34
        }

        #colophon {
            background-position: center center
        }

        #colophon {
            background-size: auto
        }

        #colophon {
            background-attachment: scroll
        }

        #colophon {
            background-repeat: repeat
        }


        .bg-color-gris-effet-1 {
            background: url(data:image/png;base64,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);
        }

        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .form-control:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
        }
        .form-control::-moz-placeholder {
            color: #999;
            opacity: 1;
        }
        .form-control:-ms-input-placeholder {
            color: #999;
        }
        .form-control::-webkit-input-placeholder {
            color: #999;
        }
        .form-control::-ms-expand {
            background-color: transparent;
            border: 0;
        }
        .form-control[disabled],
        .form-control[readonly],
        fieldset[disabled] .form-control {
            background-color: #eee;
            opacity: 1;
        }
        .form-control[disabled],
        fieldset[disabled] .form-control {
            cursor: not-allowed;
        }
        textarea.form-control {
            height: auto;
        }
        input[type="search"] {
            -webkit-appearance: none;
        }
        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            input[type="date"].form-control,
            input[type="time"].form-control,
            input[type="datetime-local"].form-control,
            input[type="month"].form-control {
                line-height: 34px;
            }
            input[type="date"].input-sm,
            input[type="time"].input-sm,
            input[type="datetime-local"].input-sm,
            input[type="month"].input-sm,
            .input-group-sm input[type="date"],
            .input-group-sm input[type="time"],
            .input-group-sm input[type="datetime-local"],
            .input-group-sm input[type="month"] {
                line-height: 30px;
            }
            input[type="date"].input-lg,
            input[type="time"].input-lg,
            input[type="datetime-local"].input-lg,
            input[type="month"].input-lg,
            .input-group-lg input[type="date"],
            .input-group-lg input[type="time"],
            .input-group-lg input[type="datetime-local"],
            .input-group-lg input[type="month"] {
                line-height: 46px;
            }
        }
        .form-group {
            margin-bottom: 15px;
        }
        .radio,
        .checkbox {
            position: relative;
            display: block;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .radio label,
        .checkbox label {
            min-height: 20px;
            padding-left: 20px;
            margin-bottom: 0;
            font-weight: normal;
            cursor: pointer;
        }
        .radio input[type="radio"],
        .radio-inline input[type="radio"],
        .checkbox input[type="checkbox"],
        .checkbox-inline input[type="checkbox"] {
            position: absolute;
            margin-top: 4px \9;
            margin-left: -20px;
        }
        .radio + .radio,
        .checkbox + .checkbox {
            margin-top: -5px;
        }
    </style>
    <noscript>
        <style id="rocket-lazyload-nojs-css">
            .rll-youtube-player,
            [data-lazy-src] {
                display: none!important
            }

            body{
                background-color:#ebebeb!important;
            }

            ul.menu li a{
                color:black;
            }
        </style>
    </noscript>


    <script src=" {{asset('frontend/js/functions.js')}}"></script>
    <!-- Css for animation animate -->
    <link rel="stylesheet" type="text/css" href=" {{asset('frontend/css/animate.css')}}" />
    <!-- begin sweet alert -->
    <script src=" {{asset('frontend/sweetalert/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href=" {{asset('frontend/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="  {{asset('frontend/sweetalert/facebook.css')}}">
    <!-- end sweet alert -->

    <link rel="stylesheet" href="  {{asset('frontend/upload-and-crop-image/croppie.css')}}" />
    <link href="{{asset('frontend/stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href=" {{asset('frontend/css/bootstrap-3-grid.css')}}" />
    <link rel="stylesheet" type="text/css" href=" {{asset('frontend/css/lakota.css')}}" />

</head>

<body data-rsssl=1 class="home blog wp-custom-logo everest-forms-no-js" style="">
<div style="width:100%; height:8px; margin-top:-10px;">
    <span style="width:15%;  height:100%; background-color:#1e4c59; float:left; "></span>
    <span style="width:5%;  height:100%; background-color:#20878e;float:left; "></span>
    <span style="width:10%;  height:100%; background-color:#2bafb3;float:left; "></span>
    <span style="width:5%;  height:100%; background-color:#278489;float:left; "></span>
    <span style="width:65%;  height:100%; background-color:#ff9128;float:left; "></span>
</div>
<input type="hidden" id="device" value="{{montant_simbole()}}">
<div id="page" class="hfeed site" style=""> <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    <header id="masthead" class="site-header clearfix">
        <div id="header-text-nav-container" class="clearfix" style="background-color:transparent;">
            <div class="news-bar" style="border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                <div class="inner-wrap clearfix" >
                    <div class="date-in-header"> {{date("d-m-Y H:i")}}</div>
                    <div class="breaking-news"> <strong class="breaking-news-latest"> FLASH NEWS : </strong>
                        <ul class="newsticker">
                            <li> <a href="{{url('/')}}" title="Krish Gerry Wins Pommel Horse Gold">STOP CORONAVIRUS A ATTECOUBE/ BILAN DES ACTIVITES DANS LA COMMUNE</a></li>
                            <li> <a href="{{url('/')}}" title="Comet, Set To Strike The Earth">CONSEIL MUNICIPAL 2020/ PREMIERE SESSION</a></li>
                            <li> <a href="{{url('/')}}" title="Winter fashion news">STOPCORONAVIRUS A ATTECOUBE/ INSTALLATION DES COMMERCANTS DANS LE NOUVEAU MARCHE</a></li>
                        </ul>
                    </div>
                    <div class="social-links clearfix">
                        <ul>


                            @if(auth()->check())
                                @if(auth()->user()->role_id==5)
                                    <li>  <a href="{{route('profile')}}" style="padding: 0px">
                                        @else
                                            <a href="{{route('console.home')}}" style="padding: 0px">
                                        @endif
                                                {{truncate(auth()->user()->name,25)}}   <img style="height: 30px;border-radius: 50%" src="{{auth()->user()->picture?asset('storage/'.auth()->user()->picture):asset("images/avatar.png")}}" alt="">
                                            </a>
                                        </a>
                                    </li>
                                            @else
                                    <li><a href="{{route('login')}}" ><i class="fa fa-lock"></i> Me connecter</a></li>
                                            @endif


                        </ul>
                    </div>
                </div>
            </div>
            <div class="inner-wrap">
                <div id="header-text-nav-wrap" class="clearfix">
                    <div id="header-left-section">
                        <div id="header-logo-image">
                            <a href="{{url('/')}}" class="custom-logo-link" rel="home" itemprop="url">
                                <img width="350" height="" src="{{asset('frontend/img/logo_attecoube.png')}}" class="custom-logo" alt="" itemprop="logo" /></a>
                        </div>
                        <div id="header-text" class="screen-reader-text">
                            <h1 id="site-title"> <a href="{{url('/')}}" title="" rel="home"></a></h1>
                            <p id="site-description"> </p>
                        </div>
                    </div>
                    <div id="header-right-section">
                        <div id="header-right-sidebar" class="clearfix">
                            <aside id="colormag_728x90_advertisement_widget-4" class="widget widget_728x90_advertisement clearfix">
                                <div class="">
                                    <div class="advertisement-content">
                                        <a href="{{url('/')}}" class="single_ad_728x90" style="float:left;" target="_blank" rel="nofollow">
                                            <img src="{{asset('frontend/img/green-number-new.png')}}"  alt=""> </a>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <nav id="site-navigation" class="main-navigation clearfix" style="border-radius:10px;">
                <div class="inner-wrap clearfix">
                    <div class="home-icon front_page_on"> <a href="{{url('/')}}" title=""><i class="fa fa-home"></i></a></div>
                    <div class="search-random-icons-container" style="background-color:white;">
                        <div class="top-search-wrap">

                             <i class="fa fa-search search-top"></i>

                            <div class="search-form-top">
                                <form action="{{url("/")}}" class="search-form searchform clearfix" method="get">
                                    <div class="search-wrap">
                                        <input type="text" placeholder="Search" class="s field" name="s">
                                        <button class="search-icon" type="submit"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="menu-toggle"  style="background-color:#219b9c;"></p>

                    <div class="menu-primary-container">
                        <ul id="menu-primary" class="menu" style="margin:0px;">
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="">MA COMMUNE</a></li>
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="">INFOS UTILES</a></li>
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="">JE VEUX...</a></li>
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="{{route('commerce.lists')}}">ENTREPRISES & COMMERCES</a></li>
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="">PROJETS & MARCHES</a></li>
                            <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-120 menu-item-category-33"><a href="">ANNONCES & OPPOURTUNITES</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
