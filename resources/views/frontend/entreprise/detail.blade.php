@extends('frontend.layouts.main')
@section('content')
<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="inner-wrap clearfix">
        <div id="primary">
            <div id="content" class="clearfix">
                <div class="twPc-div">
                    <a class="twPc-bg twPc-block"></a>

                    <div>

                        <a title="Mert S. Kaplan" href="https://twitter.com/mertskaplan" class="twPc-avatarLink">
                            <img alt="Mert S. Kaplan" src="https://mertskaplan.com/wp-content/plugins/msk-twprofilecard/img/mertskaplan.jpg" class="twPc-avatarImg">
                        </a>

                        <div class="twPc-divUser">
                            <div class="twPc-divName">
                                <a href="https://twitter.com/mertskaplan">Mert S. Kaplan</a>
                            </div>
                            <span>
				<a href="https://twitter.com/mertskaplan">@<span>mertskaplan</span></a>
			</span>
                        </div>

                        <div class="twPc-divStats">
                            <ul class="twPc-Arrange">
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="https://twitter.com/mertskaplan" title="9.840 Tweet">
                                        <span class="twPc-StatLabel twPc-block">Tweets</span>
                                        <span class="twPc-StatValue">9.840</span>
                                    </a>
                                </li>
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="https://twitter.com/mertskaplan/following" title="885 Following">
                                        <span class="twPc-StatLabel twPc-block">Following</span>
                                        <span class="twPc-StatValue">885</span>
                                    </a>
                                </li>
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="https://twitter.com/mertskaplan/followers" title="1.810 Followers">
                                        <span class="twPc-StatLabel twPc-block">Followers</span>
                                        <span class="twPc-StatValue">1.810</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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

