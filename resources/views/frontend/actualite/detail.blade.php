@extends('frontend.layouts.main')
@section('content')
<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="inner-wrap clearfix">
        <div id="primary">
            <div id="content" class="clearfix">
                <article id="post-106" class="post-106 post type-post status-publish format-standard has-post-thumbnail hentry category-internet category-research">
                    <div class="featured-image">
                        <header class="entry-header">
                            <h1 class="entry-title"> {{$data->appel}}</h1></header>
                        <a href="{{url('/')}}" class="image-popup">
                            <img width="800" height="445" src="{{asset('storage/'.$data->picture)}}"
                         class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image"
                                 alt="" srcset="{{asset('storage/'.$data->picture)}} 800w, {{asset('storage/'.$data->picture)}} 300w, {{asset('storage/'.$data->picture)}} 768w" sizes="(max-width: 800px) 100vw, 800px" /></a>
                    </div>
                    <div class="article-content clearfix">
                        <div class="above-entry-meta" style="display:none;">
                            <span class="cat-links"><a href="" style="background:#000000" rel="category tag">{{$data->type}}</a>&nbsp;
                              {{--  <a href="<?= url('/');?>colormag-pro/category/research/" style="background:#03799e" rel="category tag"></a>&nbsp;--}}
                            </span>

                        </div>

                        <div class="below-entry-meta "> <span class="posted-on">
                                <a href="" title="11:15" rel="bookmark">
                                    <i class="fa fa-calendar-o"></i>
                                    <time class="entry-date published" datetime="2015-06-23T11:15:16+00:00">{{$data->created_at}}</time>
                                  {{--  <time class="updated" datetime="2016-02-12T10:37:09+00:00">February 12, 2016</time>--}}
                                </a></span> <span class="byline">
                                <span class="author vcard" itemprop="name"><i class="fa fa-user"></i>
                                    <a class="url fn n" href="<?= url('/');?>colormag-pro/author/bishal/"
                                       title="TG-Demo Team">Ecrit Par {{$data->mairie}}</a>
                                </span>
                            </span>
                           {{-- <span class="post-views"><i class="fa fa-eye"></i>
                                <span class="total-views">Lu : 561 fois</span>
                            </span>--}}
                        </div>
                        <div class="entry-content clearfix">
                            <p>
                               {{$data->resume}}
                            </p>
                            <p>
                               {{$data->description}}
                            </p>
                        </div>
                    </div>
                </article>
            </div>

        </div>
        <div id="secondary">

            <aside id="colormag_featured_posts_vertical_widget-11"
                   class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                <h3 class="widget-title" style="border-bottom-color:#ff3a3a;"><span style="background-color:#ff3a3a;">A lire</span>
                    {{--   <a
                           href="" class="view-all-link">View All</a>--}}
                </h3>

                <div class="following-post">

                    @foreach($others as $ne)
                        <div class="single-article clearfix ">
                            <figure>
                                <a href=""
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
                            <div class="article-content">
                                <div class="above-entry-meta"><span class="cat-links"><a
                                            href="" style="background:#006b1e"
                                            rel="category tag">{{$ne->type}}</a>

                                </span></div>
                                <h3 class="entry-title"><a href=""
                                                           title="Coeffe, Good For Health?">{{$ne->appel}}</a>
                                </h3>
                                <div class="below-entry-meta "><span class="posted-on"><a
                                            href="{{route('actualite.detail',["q"=>$ne->id])}}" title="11:00"
                                            rel="bookmark"><i class="fa fa-calendar-o"></i> <time
                                                class="entry-date published" datetime="{{$ne->created_at}}">{{$ne->created_at}}</time><time
                                                class="updated"
                                                datetime="{{$ne->created_at}}">{{$ne->created_at}}</time></a></span>
                                    <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a
                                                class="url fn n" href=""
                                                title="TG-Demo Team">{{$ne->mairie}}</a></span></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </aside>


        </div>


    </div>
</div>
@endsection

