@extends('frontend.layouts.main')
@section('content')
    <script src="{{asset('js/jssor.slider-28.1.0.min.js')}}"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
                {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Orientation: 2,
                    $NoDrag: true
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .jssora061 {display:block;position:absolute;cursor:pointer;}
        .jssora061 .a {fill:none;stroke:#fff;stroke-width:360;stroke-linecap:round;}
        .jssora061:hover {opacity:.8;}
        .jssora061.jssora061dn {opacity:.5;}
        .jssora061.jssora061ds {opacity:.3;pointer-events:none;}
    </style>

    <div class="inner-wrap clearfix">
        <div class="front-page-top-section clearfix">
            <div class="widget_slider_area">

                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:630px;
                height:310px;overflow:hidden;visibility:hidden;">
                    <!-- Loading Screen -->
                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;
                    height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{asset('barner/img/spin.svg')}}" />
                    </div>
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:630px;height:310px;overflow:hidden;">
                        @foreach($barners as $banner)
                        <div>
                            <img style="height: 100%" data-u="image" src="{{asset('storage/'.$banner->picture)}}" />
                            <div u="thumb">{{$banner->appel}}
                            </div>
                        </div>
                        @endforeach

                    </div><a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">image gallery</a>
                    <!-- Thumbnail Navigator -->
                    <div u="thumbnavigator" style="position:absolute;bottom:0px;left:0px;width:980px;height:50px;color:#FFF;overflow:hidden;cursor:default;background-color:rgba(0,0,0,.5);">
                        <div u="slides">
                            <div u="prototype" style="position:absolute;top:0;left:0;width:980px;height:50px;">
                                <div u="thumbnailtemplate" style="position:absolute;top:0;left:0;width:100%;height:100%;font-family:arial,helvetica,verdana;font-weight:normal;line-height:50px;font-size:16px;padding-left:10px;box-sizing:border-box;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Arrow Navigator -->
                    <div data-u="arrowleft" class="jssora061" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <path class="a" d="M11949,1919L5964.9,7771.7c-127.9,125.5-127.9,329.1,0,454.9L11949,14079"></path>
                        </svg>
                    </div>
                    <div data-u="arrowright" class="jssora061" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <path class="a" d="M5869,1919l5984.1,5852.7c127.9,125.5,127.9,329.1,0,454.9L5869,14079"></path>
                        </svg>
                    </div>
                </div>




                {{--   <section style="max-height:305px;" id="colormag_featured_posts_slider_widget-2"
                            class="widget widget_featured_slider widget_featured_meta clearfix">
                       <div class="widget_featured_slider_inner_wrap clearfix " style="max-height:305px;">
                           <div class="bx-wrapper" style="max-width: 100%;">
                               <div class="bx-viewport" aria-live="polite"
                                    style="width: 100%; overflow: hidden; position: relative; height: 305px;">
                                   <div id="category_slider_colormag_featured_posts_slider_widget-2"
                                        style="max-height: 305px; width: 2215%; position: relative; transition-duration: 0s; transform: translate3d(-630px, 0px, 0px); visibility: visible; height: auto;"
                                        class="widget_slider_area_rotate" data-mode="horizontal" data-speed="1500"
                                        data-pause="5000" data-auto="true" data-hover="false">
                                      --}}{{-- <div class="single-slide displayblock "
                                            style="max-height: 305px; float: left; list-style: none; position: relative; width: 630px;"
                                            aria-hidden="true">
                                           <figure class="slider-featured-image" style="max-height:305px;">
                                               <a href="http://mairie.advantech-sa.com/"
                                                  title="Advance way to navigate"><img width="800" height="445"
                                                                                       src="http://mairie.advantech-sa.com/img_blog/point_marche.jpg"
                                                                                       class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image"
                                                                                       alt="" title=""
                                                                                       srcset="http://mairie.advantech-sa.com/img_blog/point_marche.jpg 800w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 300w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 768w"
                                                                                       sizes="(max-width: 800px) 100vw, 800px"></a>
                                           </figure>
                                           <div class="slide-content" style="max-height:305px;">
                                               <div class="above-entry-meta" style="display:none;"><span class="cat-links"><a
                                                           href="http://mairie.advantech-sa.com/"
                                                           style="background:#000000" rel="category tag">Internet</a>&nbsp;<a
                                                           href="http://mairie.advantech-sa.com/"
                                                           style="background:#03799e" rel="category tag">Research</a>&nbsp;</span>
                                               </div>
                                               <h3 class="entry-title"><a href="http://mairie.advantech-sa.com/"
                                                                          title="Advance way to navigate">STOPCORONAVIRUS A
                                                       ATTECOUBE/ INSTALLATION DES COMMERCANTS DANS LE NOUVEAU MARCHE</a>
                                               </h3>
                                               <div class="below-entry-meta "><span class="posted-on"><a
                                                           href="http://mairie.advantech-sa.com/" title="11:15"
                                                           rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                               class="entry-date published"
                                                               datetime="2015-06-23T11:15:16+00:00">23 Avril 2020 à 07:57:01</time><time
                                                               class="updated" datetime="2016-02-12T10:37:09+00:00">23 Avril 2020 à 07:57:01</time></a></span>
                                                   <span class="byline"><span class="author vcard"><i
                                                               class="fa fa-user"></i><a class="url fn n"
                                                                                         href="http://mairie.advantech-sa.com/"
                                                                                         title="TG-Demo Team">Ecrit Par Mairie</a></span></span>
                                               </div>
                                           </div>
                                       </div>--}}{{--
                                       <div class="single-slide displayblock " style="max-height:305px;">
                                           <figure class="slider-featured-image" style="max-height:305px;">
                                               <a href="<?= url('/');?>" title=""><img width="800" height="445" src="{{asset('frontend/img_blog/point_covid.jpg')}}" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="" title="" srcset=" {{asset('frontend/img_blog/point_covid.jpg')}} 800w, {{asset('frontend/img_blog/point_covid.jpg')}} 300w, {{asset('frontend/img_blog/point_covid.jpg')}} 768w" sizes="(max-width: 800px) 100vw, 800px" /></a>
                                           </figure>
                                           <div class="slide-content" style="max-height:305px;">
                                               <div class="above-entry-meta" style="display:none"><span class="cat-links"><a href="{{url('/')}}" style="background:#03799e" rel="category tag">Research</a>&nbsp;<a href="{{url('/')}}" style="background:#26b59d" rel="category tag">Weather</a>&nbsp;</span></div>
                                               <h3 class="entry-title"> <a href="{{url('/')}}" title="Snow Forecast &#038; Snow Reports">STOP CORONAVIRUS A ATTECOUBE/ BILAN DES ACTIVITES DANS LA COMMUNE</a></h3>
                                               <div class="below-entry-meta "> <span class="posted-on"><a href="{{url('/')}}" title="06:05" rel="bookmark"><i class="fa fa-calendar-o"></i> <time class="entry-date published" datetime="2015-06-24T06:05:32+00:00">23 Avril 2020 à 08:06:14</time><time class="updated" datetime="2016-02-12T10:15:39+00:00">February 12, 2016</time></a></span> <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="{{url('/')}}" title="TG-Demo Team">Ecrit Par Mairie </a></span></span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="single-slide displaynone " style="max-height:305px;">
                                           <figure class="slider-featured-image" style="max-height:305px;">
                                               <a href="{{url('/')}}" title="Advance way to navigate"><img width="800" height="445" src="{{url('/')}}img_blog/point_marche.jpg" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="" title="" srcset="{{url('/')}}img_blog/point_marche.jpg 800w, {{url('/')}}img_blog/point_marche.jpg 300w, {{url('/')}}img_blog/point_marche.jpg 768w" sizes="(max-width: 800px) 100vw, 800px" /></a>
                                           </figure>
                                           <div class="slide-content" style="max-height:305px;">
                                               <div class="above-entry-meta" style="display:none;"><span class="cat-links"><a href="{{url('/')}}" style="background:#000000" rel="category tag">Internet</a>&nbsp;<a href="{{url('/')}}" style="background:#03799e" rel="category tag">Research</a>&nbsp;</span></div>
                                               <h3 class="entry-title"> <a href="{{url('/')}}" title="Advance way to navigate">STOPCORONAVIRUS A ATTECOUBE/ INSTALLATION DES COMMERCANTS DANS LE NOUVEAU MARCHE</a></h3>
                                               <div class="below-entry-meta "> <span class="posted-on"><a href="{{url('/')}}" title="11:15" rel="bookmark"><i class="fa fa-calendar-o"></i> <time class="entry-date published" datetime="2015-06-23T11:15:16+00:00">23 Avril 2020 à 07:57:01</time><time class="updated" datetime="2016-02-12T10:37:09+00:00">23 Avril 2020 à 07:57:01</time></a></span> <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="{{url('/')}}" title="TG-Demo Team">Ecrit Par Mairie</a></span></span>
                                               </div>
                                           </div>
                                       </div>
                                   --}}{{--    <div class="single-slide displaynone "
                                            style="max-height: 305px; float: left; list-style: none; position: relative; width: 630px;"
                                            aria-hidden="true">
                                           <figure class="slider-featured-image" style="max-height:305px;">
                                               <a href="http://mairie.advantech-sa.com/"
                                                  title="Advance way to navigate"><img width="800" height="445"
                                                                                       src="http://mairie.advantech-sa.com/img_blog/point_marche.jpg"
                                                                                       class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image"
                                                                                       alt="" title=""
                                                                                       srcset="http://mairie.advantech-sa.com/img_blog/point_marche.jpg 800w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 300w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 768w"
                                                                                       sizes="(max-width: 800px) 100vw, 800px"></a>
                                           </figure>
                                           <div class="slide-content" style="max-height:305px;">
                                               <div class="above-entry-meta" style="display:none;"><span class="cat-links"><a
                                                           href="http://mairie.advantech-sa.com/"
                                                           style="background:#000000" rel="category tag">Internet</a>&nbsp;<a
                                                           href="http://mairie.advantech-sa.com/"
                                                           style="background:#03799e" rel="category tag">Research</a>&nbsp;</span>
                                               </div>
                                               <h3 class="entry-title"><a href="http://mairie.advantech-sa.com/"
                                                                          title="Advance way to navigate">STOPCORONAVIRUS A
                                                       ATTECOUBE/ INSTALLATION DES COMMERCANTS DANS LE NOUVEAU MARCHE</a>
                                               </h3>
                                               <div class="below-entry-meta "><span class="posted-on"><a
                                                           href="http://mairie.advantech-sa.com/" title="11:15"
                                                           rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                               class="entry-date published"
                                                               datetime="2015-06-23T11:15:16+00:00">23 Avril 2020 à 07:57:01</time><time
                                                               class="updated" datetime="2016-02-12T10:37:09+00:00">23 Avril 2020 à 07:57:01</time></a></span>
                                                   <span class="byline"><span class="author vcard"><i
                                                               class="fa fa-user"></i><a class="url fn n"
                                                                                         href="http://mairie.advantech-sa.com/"
                                                                                         title="TG-Demo Team">Ecrit Par Mairie</a></span></span>
                                               </div>
                                           </div>
                                       </div>--}}{{--
                                       --}}{{--<div class="single-slide displayblock  bx-clone"
                                            style="max-height: 305px; float: left; list-style: none; position: relative; width: 630px;"
                                            aria-hidden="true">
                                           <figure class="slider-featured-image" style="max-height:305px;">
                                               <a href="http://mairie.advantech-sa.com/" title=""><img width="800"
                                                                                                       height="445"
                                                                                                       src="http://mairie.advantech-sa.com/img_blog/point_covid.jpg"
                                                                                                       class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image"
                                                                                                       alt="" title=""
                                                                                                       srcset="http://mairie.advantech-sa.com/img_blog/point_covid.jpg 800w, http://mairie.advantech-sa.com/img_blog/point_covid.jpg 300w, http://mairie.advantech-sa.com/img_blog/point_covid.jpg 768w"
                                                                                                       sizes="(max-width: 800px) 100vw, 800px"></a>
                                           </figure>
                                           <div class="slide-content" style="max-height:305px;">
                                               <div class="above-entry-meta" style="display:none"><span
                                                       class="cat-links"><a href="http://mairie.advantech-sa.com/"
                                                                            style="background:#03799e" rel="category tag">Research</a>&nbsp;<a
                                                           href="http://mairie.advantech-sa.com/"
                                                           style="background:#26b59d" rel="category tag">Weather</a>&nbsp;</span>
                                               </div>
                                               <h3 class="entry-title"><a href="http://mairie.advantech-sa.com/"
                                                                          title="Snow Forecast &amp; Snow Reports">STOP
                                                       CORONAVIRUS A ATTECOUBE/ BILAN DES ACTIVITES DANS LA COMMUNE</a>
                                               </h3>
                                               <div class="below-entry-meta "><span class="posted-on"><a
                                                           href="http://mairie.advantech-sa.com/" title="06:05"
                                                           rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                               class="entry-date published"
                                                               datetime="2015-06-24T06:05:32+00:00">23 Avril 2020 à 08:06:14</time><time
                                                               class="updated" datetime="2016-02-12T10:15:39+00:00">February 12, 2016</time></a></span>
                                                   <span class="byline"><span class="author vcard"><i
                                                               class="fa fa-user"></i><a class="url fn n"
                                                                                         href="http://mairie.advantech-sa.com/"
                                                                                         title="TG-Demo Team">Ecrit Par Mairie </a></span></span>
                                               </div>
                                           </div>
                                       </div>--}}{{--
                                   </div>
                               </div>
                               <div class="bx-controls bx-has-controls-direction">
                                   <div class="bx-controls-direction"><a class="bx-prev" href="">
                                           <div class="category-slide-prev"><i class="fa fa-angle-left"></i></div>
                                       </a><a class="bx-next" href="">
                                           <div class="category-slide-next"><i class="fa fa-angle-right"></i></div>
                                       </a></div>
                               </div>
                           </div>
                       </div>
                   </section>--}}
                <a style="float:left; width:50%;" href=""><img style="width:100%;"
                                                               src="http://mairie.advantech-sa.com/img/sabonner.png"></a>
                <a style="float:left; width:50%;" href="{{ route('etatcivil') }}"><img style="width:100%;"
                                                               src="http://mairie.advantech-sa.com/img/askact.png"></a>
            </div>



            {{--   <div class="widget_slider_area">
                   <section style="max-height:305px;" id="colormag_featured_posts_slider_widget-2"
                            class="widget widget_featured_slider widget_featured_meta clearfix">
                       <div class="widget_featured_slider_inner_wrap clearfix " style="max-height:305px;">
                           <div id="category_slider_colormag_featured_posts_slider_widget-2" style="max-height:305px;"
                                class="widget_slider_area_rotate" data-mode="horizontal" data-speed="1500"
                                data-pause="5000" data-auto="true" data-hover="false" style="max-height:305px;">

                               @foreach($barners as $banner)
                                   <div class="single-slide  displayblock" style="max-height:305px;">
                                       <figure class="slider-featured-image" style="max-height:305px;">
                                           <a href="" title="">
                                               <img width="800" height="445" src="{{asset('storage/'.$banner->picture)}}"
                                                    class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image"
                                                    alt="" title=""
                                                    srcset=" {{asset('storage/'.$banner->picture)}} {{asset('storage/'.$banner->picture)}} 800w, {{asset('storage/'.$banner->picture)}} 300w, {{asset('storage/'.$banner->picture)}} 768w"
                                                    sizes="(max-width: 800px) 100vw, 800px"/></a>
                                       </figure>
                                       <div class="slide-content" style="max-height:305px;">
                                           <div class="above-entry-meta" style="display:none"><span class="cat-links"><a
                                                       href="index.html" style="background:#03799e" rel="category tag">Research</a>&nbsp;<a
                                                       href="index.html" style="background:#26b59d"
                                                       rel="category tag">{{$banner->type}}</a>&nbsp;</span></div>
                                           <h3 class="entry-title"><a href="index.html"
                                                                      title="Snow Forecast &#038; Snow Reports">{{$banner->appel}}</a>
                                           </h3>
                                           <div class="below-entry-meta "> <span class="posted-on"><a href="index.html"
                                                                                                      title="06:05"
                                                                                                      rel="bookmark"><i
                                                           class="fa fa-calendar-o"></i> <time class="entry-date published"
                                                                                               datetime="{{$banner->created_at}}">
                                               </time>
                                               <time class="updated"
                                                     datetime="2016-02-12T10:15:39+00:00">February 12, 2016</time>
                                           </a></span> <span class="byline"><span class="author vcard">
                                               <i class="fa fa-user">
                                               </i><a class="url fn n" href="index.html" title="TG-Demo Team">
                                                   {{$banner->mairie}} </a></span></span>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                               --}}{{--     <div class="single-slide displaynone " style="max-height:305px;">
                                        <figure class="slider-featured-image" style="max-height:305px;">
                                            <a href="index.html" title="Advance way to navigate"><img width="800" height="445" src=" {{asset('frontend/img_blog/point_marche.jpg')}}" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="" title="" srcset="http://mairie.advantech-sa.com/img_blog/point_marche.jpg 800w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 300w, http://mairie.advantech-sa.com/img_blog/point_marche.jpg 768w" sizes="(max-width: 800px) 100vw, 800px" /></a>
                                        </figure>
                                        <div class="slide-content" style="max-height:305px;">
                                            <div class="above-entry-meta" style="display:none;"><span class="cat-links"><a href="index.html" style="background:#000000" rel="category tag">Internet</a>&nbsp;<a href="index.html" style="background:#03799e" rel="category tag">Research</a>&nbsp;</span></div>
                                            <h3 class="entry-title"> <a href="index.html" title="Advance way to navigate">STOPCORONAVIRUS A ATTECOUBE/ INSTALLATION DES COMMERCANTS DANS LE NOUVEAU MARCHE</a></h3>
                                            <div class="below-entry-meta "> <span class="posted-on"><a href="index.html" title="11:15" rel="bookmark"><i class="fa fa-calendar-o"></i> <time class="entry-date published" datetime="2015-06-23T11:15:16+00:00">23 Avril 2020 à 07:57:01</time><time class="updated" datetime="2016-02-12T10:37:09+00:00">23 Avril 2020 à 07:57:01</time></a></span> <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="index.html" title="TG-Demo Team">Ecrit Par Mairie</a></span></span>
                                            </div>
                                        </div>
                                    </div>--}}{{--
                           </div>
                       </div>
                   </section>
                   <a style="float:left; width:50%;" href="#"><img style="width:100%;"
                                                                   src=" {{asset('frontend/img/sabonner.png')}}"></a>
                   <a style="float:left; width:50%;" href="#"><img style="width:100%;"
                                                                   src=" {{asset('frontend/img/askact.png')}}"></a>
               </div>--}}
            <div class="widget_beside_slider">
                <section id="colormag_highlighted_posts_widget-2"
                         class="widget widget_highlighted_posts widget_featured_meta">
                    <div class="widget_highlighted_post_area">
                        <div class="col-md-6 col-xs-12 clearfix" style="padding:0px!important; ">
                            @foreach($two as $tw)
                            <div class="single-article clearfix" style="margin:0px!important;">
                                <figure class="highlights-featured-image">
                                    <a href="{{route('actualite.detail',["q"=>$tw->id])}}" title="">
                                        <img width="392" height="272" style="height: 166px;width: 250px" src="{{asset('storage/'.$tw->picture)}}"
                                                                       class="attachment-colormag-highlighted-post size-colormag-highlighted-post wp-post-image"
                                                                       alt="" title=""
                                                                       srcset="{{asset('storage/'.$tw->picture)}} 392w, {{asset('storage/'.$tw->picture)}} 130w"
                                                                       sizes="(max-width: 392px) 100vw, 392px"/></a>
                                </figure>
                                <div class="article-content">
                                    <div class="above-entry-meta"><span class="cat-links">
                                            <a href="{{route('actualite.detail',["q"=>$tw->id])}}"
                                                                                             style="background:#32e3ff"
                                                                                             rel="category tag">{{$tw->type}}</a>&nbsp;</span>
                                    </div>
                                    <h3 class="entry-title"><a href="{{route('actualite.detail',["q"=>$tw->id])}}" title="Fat Tire Bike Race in Orland">
                                            {{$tw->appel}}
                                        </a></h3>
                                    <div class="below-entry-meta ">
                                        <span class="posted-on">
                                            <a href=""
                                                                                              title="07:15"
                                                                                              rel="bookmark"><i
                                                    class="fa fa-calendar-o"></i> <time class="entry-date published"
                                                                                        datetime="{{$tw->created_at}}">{{$tw->created_at}}</time><time
                                                    class="updated"
                                                    datetime="{{$tw->created_at}}">{{$tw->created_at}}</time></a></span>
                                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                    class="url fn n" href="{{route('actualite.detail',["q"=>$tw->id])}}" title=" Ecrit Par Mairie "> {{$tw->mairie}} </a></span></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          {{--  <div class="single-article clearfix" style="margin:0px!important;">
                                <figure class="highlights-featured-image">
                                    <a href="index.html" title=""><img width="392" height="272"
                                                                       src="img_blog/COVI(1).jpg"
                                                                       class="attachment-colormag-highlighted-post size-colormag-highlighted-post wp-post-image"
                                                                       alt="" title=""
                                                                       srcset="http://mairie.advantech-sa.com/img_blog/COVI(1).jpg 392w, http://mairie.advantech-sa.com/img_blog/COVI(1).jpg 130w"
                                                                       sizes="(max-width: 392px) 100vw, 392px"/></a>
                                </figure>
                                <div class="article-content">
                                    <div class="above-entry-meta" style="display:none;"><span class="cat-links"><a
                                                href="index.html" style="background:#efb837"
                                                rel="category tag">Meeting</a>&nbsp;<a href="index.html"
                                                                                       style="background:#32e3ff"
                                                                                       rel="category tag">Technology</a>&nbsp;</span>
                                    </div>
                                    <h3 class="entry-title"><a href="index.html" title="WHAT IS GirlTalkHQ?">DON DE MME
                                            ASSETOU GON COULIBALY</a></h3>
                                    <div class="below-entry-meta "><span class="posted-on"><a href="index.html"
                                                                                              title="07:00"
                                                                                              rel="bookmark"><i
                                                    class="fa fa-calendar-o"></i> <time class="entry-date published"
                                                                                        datetime="2015-06-24T07:00:36+00:00">08 Avril 2020 à 21:48:35</time><time
                                                    class="updated" datetime="2016-02-11T12:46:44+00:00">February 11, 2016</time></a></span>
                                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                    class="url fn n" href="index.html" title="TG-Demo Team">Ecrit Par Mairie</a></span></span>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                        <aside id="colormag_breaking_news_widget-3"
                               class="col-md-6 col-xs-12 widget widget_breaking_news_colormag widget_featured_posts clearfix"
                               style="margin:0px!important;">

                            <img src="{{asset('frontend/img/aaaauuu.png')}}" style="width:100%;">
                            <div class="breaking_news_widget_inner_wrap"
                                 style="height:250px!important; margin:0px!important"><i style="display:none;"
                                              class="fa fa-arrow-up"
                                  id="breaking-news-widget-prev_colormag_breaking_news_widget-3"></i>
                                <ul id="breaking-news-widget_colormag_breaking_news_widget-3"
                                    class="breaking-news-widget-slide" data-direction="up" data-duration="4000"
                                    data-rowheight="100" data-maxrows="3"
                                    style="box-shadow:none!important; padding:5px; height:200px!important; margin:0px!important">

                                    <li class="single-article clearfix"
                                        style="background-color:#f1f1f1; border-top-right-radius:20px; margin-top:0px;">
                                        <div class="tabbed-images">
                                            <h2>12</h2>
                                            <p style="text-align:center; margin-top:-23px;">OCT.</p>
                                        </div>
                                        <div style="margin-top:9px;">
                                            <h3 class="entry-title"><a href="index.html"
                                                                       title="Krish Gerry Wins Pommel Horse Gold">Dégâts
                                                    des eaux : </a></h3>
                                            <div class="below-entry-meta "><span class="posted-on"
                                                                                 style="font-size:10px;"><a
                                                        href="index.html" title="10:11" rel="bookmark"><i
                                                            class="fa fa-map-marker"></i> <time
                                                            class="entry-date published"
                                                            datetime="2015-06-24T10:11:04+00:00">ATTECOUBE, Marché</time></a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-article clearfix"
                                        style="background-color:#f1f1f1; border-top-right-radius:20px; margin-top:-5px;">
                                        <div class="tabbed-images">
                                            <h2>11</h2>
                                            <p style="text-align:center; margin-top:-23px;">OCT.</p>
                                        </div>
                                        <div style="margin-top:9px;">
                                            <h3 class="entry-title"><a href="index.html" title="">Alerte Coronavirus :
                                                    📱 140 </a></h3>
                                            <div class="below-entry-meta "><span class="posted-on"
                                                                                 style="font-size:10px;"><a
                                                        href="index.html" title="10:11" rel="bookmark"><i
                                                            class="fa fa-map-marker"></i> <time
                                                            class="entry-date published"
                                                            datetime="2015-06-24T10:11:04+00:00"> ATTECOUBE, Mairie</time></a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-article clearfix"
                                        style="background-color:#f1f1f1; border-top-right-radius:20px; margin-top:-5px;">
                                        <div class="tabbed-images">
                                            <h2>10</h2>
                                            <p style="text-align:center; margin-top:-23px;">OCT.</p>
                                        </div>
                                        <div style="margin-top:9px;">
                                            <h3 class="entry-title"><a href="index.html" title="">Réseau de microbes
                                                    démantelés </a></h3>
                                            <div class="below-entry-meta "><span class="posted-on"
                                                                                 style="font-size:10px;"><a
                                                        href="index.html" title="10:11" rel="bookmark"><i
                                                            class="fa fa-map-marker"></i> <time
                                                            class="entry-date published"
                                                            datetime="2015-06-24T10:11:04+00:00">ATTECOUBE</time></a></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <i style="display:none;" class="fa fa-arrow-down"
                                   id="breaking-news-widget-next_colormag_breaking_news_widget-3"></i></div>
                          {{--  <a style="width:100%;" href="javascript:;">--}}
                              {{--  <img style="width:100%;"  src="{{asset('frontend/img/catre-alerte.png')}}"></a>
--}}
                        </aside>

                    </div>
                </section>
            </div>


        </div>
    </div>
    <div class="main-content-section clearfix" >
        <div id="primary">
            <div id="content" class="clearfix">
                <section id="colormag_default_news_widget-2"
                         class="widget widget_default_news_colormag widget_featured_posts clearfix">
                    <h3 class="widget-title" style="border-bottom-color:#206b4d;"><span
                            style="background-color:#206b4d;">Actualités</span>
                     {{--   <a
                            href="" class="view-all-link">View All</a>--}}
                    </h3>
                    <div class="default-news">
                        @foreach($news as $new)
                        <div class="single-article clearfix ">
                            <figure>
                                <a href=""
                                   title="Rafting accident near Silver leaves">
                                    <img width="390" height="205"
                                     src="{{asset('storage/'.$new->picture)}}"
                                    class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                    alt="{{$new->appel}}"
                                    title="{{$new->appel}}"/>
                                </a>
                            </figure>
                            <div class="article-content">
                                <div class="above-entry-meta"><span class="cat-links"><a
                                            href="" style="background:#206b4d"
                                            rel="category tag">{{$new->type}}</a></span></div>
                                <h3 class="entry-title"><a
                                        href=""
                                        title="{{$new->appel}}">{{$new->appel}}</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href=""
                                            title="09:55" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="{{$new->created_at}}">{{$new->created_at}}</time><time
                                                class="updated"
                                                datetime="{{$new->created_at}}">{{$new->created_at}}</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href=""
                                                title="TG-Demo Team">{{$new->mairie}}</a></span></span>
                                </div>
                                <div class="entry-content">
                                    <p>{{truncate($new->resume,250)}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                      {{--  <div class="single-article clearfix ">
                            <figure>
                                <a href="colormag-pro/2015/06/24/cycling-on-mountain/index.html"
                                   title="Cycling on Mountain"><img width="390" height="205"
                                                                    src="../demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/bicycling-390x205.jpg"
                                                                    class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                                                    alt="Cycling on Mountain"
                                                                    title="Cycling on Mountain"/></a>
                            </figure>
                            <div class="article-content">
                                <div class="above-entry-meta"><span class="cat-links"><a
                                            href="colormag-pro/category/adventure/index.html" style="background:#206b4d"
                                            rel="category tag">Adventure</a>&nbsp;<a
                                            href="colormag-pro/category/travel/index.html" style="background:#13306b"
                                            rel="category tag">Travel</a>&nbsp;</span></div>
                                <h3 class="entry-title"><a href="colormag-pro/2015/06/24/cycling-on-mountain/index.html"
                                                           title="Cycling on Mountain">Cycling on Mountain</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/24/cycling-on-mountain/index.html" title="09:50"
                                            rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-24T09:50:24+00:00">June 24, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-11T10:02:30+00:00">February 11, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                                <div class="entry-content">
                                    <p>Suspendisse potenti. Nullam interdum tortor vitae felis scelerisque, at pharetra
                                        ex dapibus. Cras condimentum nibh viverra felis feugiat, a ullamcorper</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure>
                                <a href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                   title="One of the most awesome Tourist destination"><img width="390" height="205"
                                                                                            src="../demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/nepal-390x205.jpg"
                                                                                            class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                                                                            alt="One of the most awesome Tourist destination"
                                                                                            title="One of the most awesome Tourist destination"/></a>
                            </figure>
                            <div class="article-content">
                                <div class="above-entry-meta"><span class="cat-links"><a
                                            href="colormag-pro/category/adventure/index.html" style="background:#206b4d"
                                            rel="category tag">Adventure</a>&nbsp;<a
                                            href="colormag-pro/category/tourism/index.html" style="background:#314fd6"
                                            rel="category tag">Tourism</a>&nbsp;<a
                                            href="colormag-pro/category/travel/index.html" style="background:#13306b"
                                            rel="category tag">Travel</a>&nbsp;</span></div>
                                <h3 class="entry-title"><a
                                        href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                        title="One of the most awesome Tourist destination">One of the most awesome
                                        Tourist destination</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                            title="07:05" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-24T07:05:10+00:00">June 24, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-11T11:57:58+00:00">February 11, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                                <div class="entry-content">
                                    <p>Suspendisse in metus sagittis, dictum turpis et, vulputate mauris. Integer
                                        suscipit, diam ac sollicitudin maximus, lorem ipsum varius felis, vel</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure>
                                <a href="colormag-pro/2015/06/24/de-spain-preparations/index.html"
                                   title="De Spain preparations"><img width="390" height="205"
                                                                      src="../demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/utah-390x205.jpg"
                                                                      class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                                                      alt="De Spain preparations"
                                                                      title="De Spain preparations"/></a>
                            </figure>
                            <div class="article-content">
                                <div class="above-entry-meta"><span class="cat-links"><a
                                            href="colormag-pro/category/adventure/index.html" style="background:#206b4d"
                                            rel="category tag">Adventure</a>&nbsp;<a
                                            href="colormag-pro/category/cycling/index.html" style="background:#ffc423"
                                            rel="category tag">Cycling</a>&nbsp;<a
                                            href="colormag-pro/category/sports/index.html" style="background:#3a6fff"
                                            rel="category tag">Sports</a>&nbsp;</span></div>
                                <h3 class="entry-title"><a
                                        href="colormag-pro/2015/06/24/de-spain-preparations/index.html"
                                        title="De Spain preparations">De Spain preparations</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/24/de-spain-preparations/index.html"
                                            title="07:00" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-24T07:00:27+00:00">June 24, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-12T10:12:10+00:00">February 12, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                                <div class="entry-content">
                                    <p>Cras bibendum, mi in imperdiet tempor, lorem urna aliquam turpis, ac aliquet
                                        libero mauris nec diam. Mauris est mauris, dapibus</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </section>
                <section id="colormag_featured_posts_widget-2"
                         class="widget widget_featured_posts widget_featured_meta clearfix">
                    <h3 class="widget-title" style="border-bottom-color:orange;"><span
                            style="background-color:orange;">Entreprises & Commerces</span>
                     {{--   <a
                            href="" class="view-all-link">View All</a>--}}
                    </h3>
                   <div style="padding: 10px">
                       <div class="row">
                           @foreach($commerces as $commerce)
                           <div class="col-lg-6">
                               <a href="{{route('entreprise.detail',["q"=>$commerce->id])}}">
                               <div  class="grid-commerce" style="background: url({{asset('storage/'.$commerce->picture)}});">
                                   <div class="listing-counter" >
                                     {{--  <span>7 </span>--}}
                                       {{$commerce->type}}</div>
                                   <div class="listing-info">
                                       <h3><a href="{{route('entreprise.detail',["q"=>$commerce->id])}}">{{$commerce->raison_social}}</a></h3>
                                       <div class="listing-term-desc"></div>
                                   </div>
                               </div>
                               </a>
                           </div>
                           @endforeach

                       </div>
                   </div>
                </section>


          {{--      <div class="tg-one-half">
                    <section id="colormag_featured_posts_vertical_widget-3"
                             class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                        <h3 class="widget-title" style="border-bottom-color:#c92ec6;"><span
                                style="background-color:#c92ec6;">Mode et beauté</span><a
                                href="" class="view-all-link">View All</a></h3>
                        <div class="first-post">
                            <div class="single-article clearfix ">
                                <figure>
                                    <a href="colormag-pro/2015/06/24/winter-fashion-news/index.html"
                                       title="Winter fashion news">
                                        <img width="390" height="205"
                                        src="https://news.abidjan.net/photos/photos/IMG_8977(10).JPG"
                                        class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                        alt="Winter fashion news"
                                        title="Winter fashion news"/>
                                    </a>
                                </figure>
                                <div class="article-content">
                                    <div class="above-entry-meta"><span class="cat-links"><a
                                                href="colormag-pro/category/fashion/index.html"
                                                style="background:#c92ec6" rel="category tag">Fashion</a>&nbsp;<a
                                                href="colormag-pro/category/outfit/index.html"
                                                style="background:#8a21d1" rel="category tag">Outfit</a>&nbsp;</span>
                                    </div>
                                    <h3 class="entry-title"><a
                                            href="colormag-pro/2015/06/24/winter-fashion-news/index.html"
                                            title="Winter fashion news">Winter fashion news</a></h3>
                                    <div class="below-entry-meta "><span class="posted-on"><a
                                                href="colormag-pro/2015/06/24/winter-fashion-news/index.html"
                                                title="10:01" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                    class="entry-date published" datetime="2015-06-24T10:01:47+00:00">June 24, 2015</time><time
                                                    class="updated" datetime="2016-02-11T14:23:32+00:00">February 11, 2016</time></a></span>
                                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                    class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                    title="TG-Demo Team">TG-Demo Team</a></span></span>
                                    </div>
                                    <div class="entry-content">
                                        <p>Nullam a dui erat. Nunc elementum leo id arcu varius, eget ultricies ante
                                            interdum. Ut eleifend eros in quam molestie,</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
                <div class="tg-one-half tg-one-half-last">
                    <section id="colormag_featured_posts_vertical_widget-4"
                             class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                        <h3 class="widget-title" style="border-bottom-color:#81d742;"><span
                                style="background-color:#81d742;">Politics </span><a
                                href="colormag-pro/category/politics/index.html" class="view-all-link">View All</a></h3>
                        <div class="first-post">
                            <div class="single-article clearfix ">
                                <figure>
                                    <a href="colormag-pro/2015/06/24/political-discussion-meetup/index.html"
                                       title="Political Discussion Meetup"><img width="390" height="205"
                                                                                src="https://news.abidjan.net/photos/photos/IMG_8977(10).JPG"
                                                                                class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                                                                alt="Political Discussion Meetup"
                                                                                title="Political Discussion Meetup"/></a>
                                </figure>
                                <div class="article-content">
                                    <div class="above-entry-meta"><span class="cat-links"><a
                                                href="colormag-pro/category/government/index.html"
                                                style="background:#919191" rel="category tag">Government</a>&nbsp;<a
                                                href="colormag-pro/category/meeting/index.html"
                                                style="background:#efb837" rel="category tag">Meeting</a>&nbsp;<a
                                                href="colormag-pro/category/politics/index.html"
                                                style="background:#81d742" rel="category tag">Politics</a>&nbsp;</span>
                                    </div>
                                    <h3 class="entry-title"><a
                                            href="colormag-pro/2015/06/24/political-discussion-meetup/index.html"
                                            title="Political Discussion Meetup">Political Discussion Meetup</a></h3>
                                    <div class="below-entry-meta "><span class="posted-on"><a
                                                href="colormag-pro/2015/06/24/political-discussion-meetup/index.html"
                                                title="09:25" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                    class="entry-date published" datetime="2015-06-24T09:25:29+00:00">June 24, 2015</time><time
                                                    class="updated" datetime="2016-02-11T14:20:39+00:00">February 11, 2016</time></a></span>
                                        <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                    class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                    title="TG-Demo Team">TG-Demo Team</a></span></span>
                                    </div>
                                    <div class="entry-content">
                                        <p>Curabitur laoreet hendrerit ante, condimentum eleifend massa bibendum id.
                                            Vestibulum vel quam quis leo consectetur condimentum</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
                <div class="clearfix"></div>
                <section id="colormag_728x90_advertisement_widget-3"
                         class="widget widget_728x90_advertisement clearfix">
                    <div class="advertisement_728x90">
                        <div class="advertisement-content">
                            <a href="" class="single_ad_728x90" target="_blank" rel="nofollow">
                                <img src="{{asset('frontend/img/color-mag-large-advetise.png')}}" width="728" height="90" alt=""> </a>
                        </div>
                    </div>
                </section>--}}
            </div>
        </div>
        <div id="secondary">

            <aside id="colormag_300x250_advertisement_widget-3" class="widget widget_300x250_advertisement clearfix">
                <div class="advertisement_300x250">
                    <div class="advertisement-content">
                        <a href="" class="single_ad_300x250" target="_blank"
                           rel="nofollow"> <img src="{{asset('frontend/img/color-mag-medium-advetise.png')}}" width="300" height="250" alt="">
                        </a>
                    </div>
                </div>
            </aside>
            <aside id="colormag_featured_posts_vertical_widget-11"
                   class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                <br>
                <div class="following-post">
                    <h3 class="widget-title" style="border-bottom: 2px solid dodgerblue;"><span style="background: dodgerblue;">Nos mairies</span></h3>
                    @foreach($mairies as $ne)
                        <div class="single-article clearfix ">
                            <figure>
                                <a href="{{route('mairie.detail',["q"=>$ne->id])}}"
                                   title="Coeffe, Good For Health?">
                                    <img width="130" height="90"
                                         src="{{asset('storage/'.$ne->picture)}}"
                                         class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                         alt="Coeffe, Good For Health?"
                                         title="Coeffe, Good For Health?"
                                         srcset="{{asset('storage/'.$ne->picture)}} 130w,
                                                                      {{asset('storage/'.$ne->picture)}} 392w"
                                         sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content" style="display: inline;vertical-align: middle">
                                {{-- <div class="above-entry-meta"><span class="cat-links"><a
                                             href="{{route('actualite.detail',["q"=>$ne->id])}}" style="background:#006b1e"
                                             rel="category tag">{{$ne->type}}</a>

                                     </span></div>--}}
                                <h3 class="entry-title"><a href="{{route('mairie.detail',["q"=>$ne->id])}}"
                                                           title="Coeffe, Good For Health?">{{$ne->nom}}</a>
                                </h3>
                                {{--     <div class="below-entry-meta "><span class="posted-on"><a
                                                 href="{{route('actualite.detail',["q"=>$tw->id])}}" title="11:00"
                                                 rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                     class="entry-date published" datetime="2015-06-23T11:00:29+00:00">{{$ne->created_at}}</time><time
                                                     class="updated"
                                                     datetime="2016-02-12T10:23:21+00:00">{{$ne->created_at}}</time></a></span>
                                         <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                     class="url fn n" href="{{route('actualite.detail',["q"=>$tw->id])}}"
                                                     title="TG-Demo Team">{{$ne->mairie}}</a></span></span>
                                     </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="following-post">
                    <h3 class="widget-title" style="border-bottom: 2px solid orangered;"><span style="background: orangered;">Nos Ministères</span></h3>
                    @foreach($ministeres as $mi)
                        <div class="single-article clearfix ">
                            <figure>
                                <a href="{{route('mairie.detail',["q"=>$mi->id])}}"
                                   title="Coeffe, Good For Health?">
                                    <img width="130" height="90"
                                         src="{{asset('storage/'.$mi->picture)}}"
                                         class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                         alt="Coeffe, Good For Health?"
                                         title="Coeffe, Good For Health?"
                                         srcset="{{asset('storage/'.$mi->picture)}} 130w,
                                                                      {{asset('storage/'.$mi->picture)}} 392w"
                                         sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content" style="display: inline;vertical-align: middle">
                                {{-- <div class="above-entry-meta"><span class="cat-links"><a
                                             href="{{route('actualite.detail',["q"=>$ne->id])}}" style="background:#006b1e"
                                             rel="category tag">{{$ne->type}}</a>

                                     </span></div>--}}
                                <h3 class="entry-title"><a href="{{route('mairie.detail',["q"=>$mi->id])}}"
                                                           title="Coeffe, Good For Health?">{{$mi->nom}}</a>
                                </h3>
                                {{--     <div class="below-entry-meta "><span class="posted-on"><a
                                                 href="{{route('actualite.detail',["q"=>$tw->id])}}" title="11:00"
                                                 rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                     class="entry-date published" datetime="2015-06-23T11:00:29+00:00">{{$ne->created_at}}</time><time
                                                     class="updated"
                                                     datetime="2016-02-12T10:23:21+00:00">{{$ne->created_at}}</time></a></span>
                                         <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                     class="url fn n" href="{{route('actualite.detail',["q"=>$tw->id])}}"
                                                     title="TG-Demo Team">{{$ne->mairie}}</a></span></span>
                                     </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <br>
                <h3 class="widget-title" style="border-bottom-color:#ff3a3a;"><span style="background-color:#ff3a3a;">A lire</span>
                 {{--   <a
                        href="" class="view-all-link">View All</a>--}}
                </h3>
                <div class="first-post">
                    @foreach($one as $oe)
                    <div class="single-article clearfix ">
                        <figure>
                            <a href="{{route('actualite.detail',$oe->id)}}"
                               title="{{$oe->appel}}">
                                <img width="390" height="205"
                                        src="{{asset('storage/'.$oe->picture)}}"
                                        class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image"
                                        alt="{{$oe->appel}}"
                                        title="{{$oe->appel}}"/></a>
                        </figure>
                        <div class="article-content">
                            <div class="above-entry-meta"><span class="cat-links"><a
                                        href="{{route('actualite.detail',$oe->id)}}" style="background:#ff3a3a"
                                        rel="category tag">{{$oe->type}}</a>&nbsp;</span></div>
                            <h3 class="entry-title"><a
                                    href="{{route('actualite.detail',$oe->id)}}"
                                    title="Running Found To Be Good For Health">{{$oe->appel}}</a>
                            </h3>
                            <div class="below-entry-meta "><span class="posted-on"><a
                                        href="{{route('actualite.detail',$oe->id)}}"
                                        title="11:10" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                            class="entry-date published" datetime="2015-06-23T11:10:36+00:00">{{$oe->created_at}}</time><time
                                            class="updated"
                                            datetime="{{$oe->created_at}}">{{$oe->created_at}}</time></a></span>
                                <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                            class="url fn n" href="{{$oe->created_at}}"
                                            title="TG-Demo Team">{{$oe->mairie}}</a></span></span>
                            </div>
                            <div class="entry-content">
                                <p>{{$oe->appel}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </aside>

            <aside id="colormag_125x125_advertisement_widget-3" class="widget widget_125x125_advertisement clearfix">
                <div class="advertisement_125x125">
                    <div class="advertisement-title">
                        <h3 class="widget-title"><span>Our Sponsors</span></h3></div>
                    <div class="advertisement-content">
                        <a href="" class="single_ad_125x125" target="_blank" rel="nofollow"> <img
                                src="data:image/png;base64,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"
                                width="125" height="125" alt=""> </a><img
                            src="data:image/jpeg;base64,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"
                            width="125" height="125" alt=""><img
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Coat_of_arms_of_Kinshasa.svg/1200px-Coat_of_arms_of_Kinshasa.svg.png"
                            width="125" height="125" alt="">
                        <a href="" class="single_ad_125x125" target="_blank" rel="nofollow"> <img
                                src="https://media-exp1.licdn.com/dms/image/C510BAQEWxQQa3vW-DQ/company-logo_200_200/0/1519881743230?e=2159024400&v=beta&t=JkLehuBFsbGbhjqJ3POmIoy8wqaoNtsZYQF2nsvTnS0"
                                width="125" height="125" alt=""> </a>
                    </div>
                </div>
            </aside>
            <aside id="colormag_random_post_widget-4"
                   class="widget widget_random_post_colormag widget_featured_posts clearfix">
              {{--  <div class="random-posts-widget">
                    <h3 class="widget-title"><span>Random Picks</span></h3>
                    <div class="random_posts_widget_inner_wrap">
                        <div class="single-article clearfix ">
                            <div class="article-content">
                                <h3 class="entry-title"><a href="colormag-pro/2015/06/22/hello-world/index.html"
                                                           title="Hello world!">Hello world!</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/22/hello-world/index.html" title="10:24"
                                            rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published updated"
                                                datetime="2015-06-22T10:24:04+00:00">June 22, 2015</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/demothemegrill/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure class="random-images">
                                <a href="colormag-pro/2015/06/23/aloe-veras-benefits/index.html"
                                   title="Aloe Vera&#8217;s Benefits"><img width="130" height="90"
                                                                           src="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg"
                                                                           class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                                                           alt="Aloe Vera&#8217;s Benefits"
                                                                           title="Aloe Vera&#8217;s Benefits"
                                                                           srcset="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 130w, https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 392w"
                                                                           sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content">
                                <h3 class="entry-title"><a href="colormag-pro/2015/06/23/aloe-veras-benefits/index.html"
                                                           title="Aloe Vera&#8217;s Benefits">Aloe Vera&#8217;s
                                        Benefits</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/23/aloe-veras-benefits/index.html" title="10:40"
                                            rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-23T10:40:38+00:00">June 23, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-11T11:49:08+00:00">February 11, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure class="random-images">
                                <a href="colormag-pro/2015/06/23/coeffe-good-for-health/index.html"
                                   title="Coeffe, Good For Health?"><img width="130" height="90"
                                                                         src="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg"
                                                                         class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                                                         alt="Coeffe, Good For Health?"
                                                                         title="Coeffe, Good For Health?"
                                                                         srcset="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 130w,
                                                                          https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 392w"
                                                                         sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content">
                                <h3 class="entry-title"><a
                                        href="colormag-pro/2015/06/23/coeffe-good-for-health/index.html"
                                        title="Coeffe, Good For Health?">Coeffe, Good For Health?</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/23/coeffe-good-for-health/index.html"
                                            title="11:00" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-23T11:00:29+00:00">June 23, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-12T10:23:21+00:00">February 12, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure class="random-images">
                                <a href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                   title="One of the most awesome Tourist destination"><img width="130" height="90"
                                                                                            src="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg"
                                                                                            class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                                                                            alt="One of the most awesome Tourist destination"
                                                                                            title="One of the most awesome Tourist destination"
                                                                                            srcset="https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 130w, https://news.abidjan.net/photos/photos/Cloture-16jours-activisme-MSFFE-0025.jpg 392w"
                                                                                            sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content">
                                <h3 class="entry-title"><a
                                        href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                        title="One of the most awesome Tourist destination">One of the most awesome
                                        Tourist destination</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/24/one-of-the-most-awesome-tourist-destination/index.html"
                                            title="07:05" rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-24T07:05:10+00:00">June 24, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-11T11:57:58+00:00">February 11, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-article clearfix ">
                            <figure class="random-images">
                                <a href="colormag-pro/2015/06/24/protest-in-isreal/index.html"
                                   title="Protest In Isreal"><img width="130" height="90"
                                                                  src="../demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/protest-130x90.jpg"
                                                                  class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image"
                                                                  alt="Protest In Isreal" title="Protest In Isreal"
                                                                  srcset="https://demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/protest-130x90.jpg 130w, https://demo.themegrill.com/colormag-pro/wp-content/uploads/sites/24/2015/06/protest-392x272.jpg 392w"
                                                                  sizes="(max-width: 130px) 100vw, 130px"/></a>
                            </figure>
                            <div class="article-content">
                                <h3 class="entry-title"><a href="colormag-pro/2015/06/24/protest-in-isreal/index.html"
                                                           title="Protest In Isreal">Protest In Isreal</a></h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="colormag-pro/2015/06/24/protest-in-isreal/index.html" title="08:00"
                                            rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="2015-06-24T08:00:11+00:00">June 24, 2015</time><time
                                                class="updated"
                                                datetime="2016-02-12T10:16:27+00:00">February 12, 2016</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href="colormag-pro/author/bishal/index.html"
                                                title="TG-Demo Team">TG-Demo Team</a></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </aside>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>
@endsection
