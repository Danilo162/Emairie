@extends('frontend.layouts.main')
@section('content')

   <div class="inner-wrap clearfix">
        <div id="primary">
            <div id="content" class="clearfix">
                <div class="twPc-div" style="background: url({{asset('storage/'.$data->picture)}});background-size: cover;position: relative">
                    <a class="twPc-bg twPc-block"></a>
                    <div>

                        <a title="{{$data->nom}}" href="" class="twPc-avatarLink">
                            <img style="position: relative;z-index: 9999" alt="{{$data->nom}}" src="{{asset('storage/'.$data->picture)}}" class="twPc-avatarImg">
                        </a>

                        <div class="twPc-divUser profil_mairie_text" style="">
                            <div class="twPc-divName">
                                <a href="">{{$data->nom}}</a>
                            </div>
                            <span>
				<a href=""><span>({{$data->commune}})</span></a>
			</span>
                        </div>
                        <div class="twPc-divStats" style="background: rgba(211,211,211,0.15)">
                            <ul class="twPc-Arrange">
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="" title="9.840 Tweet">
                                        <span class="twPc-StatLabel twPc-block">Contact</span>
                                        <span class="twPc-StatValue">{{$data->phone}}</span>
                                    </a>
                                </li>
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="" title="885 Following">
                                        <span class="twPc-StatLabel twPc-block">E-Mail</span>
                                        <span class="twPc-StatValue">{{$data->email}}</span>
                                    </a>
                                </li>
                                <li class="twPc-ArrangeSizeFit">
                                    <a href="" title="{{$data->localisation}}">
                                        <span class="twPc-StatLabel twPc-block">Localisation</span>
                                        <span class="twPc-StatValue">{{$data->localisation}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>



                      {{--  <div class="row">
                            @foreach($allServices as $allser)
                            <div class="col-lg-4">
                                <a href="{{route('mairie.service',["q"=>$allser->id,"target"=>$data->id])}}" class="card-5"

                                   style="width: 100% !important;
                            background: dodgerblue;border-radius:10px ;color: white;border: 5px solid rgba(255,255,255,0.38)">
                                    {{$allser->name}}
                                    --}}{{--   <div class="col-lg-4">
                                           <img width="130" height="90"
                                                src="{{asset('storage/'.$allser->picture)}}">
                                       </div>--}}{{--
                                    --}}{{--    <div class="col-lg-8">{{$allser->name}}</div>--}}{{--
                                </a>
                            </div>
                            @endforeach
                        </div>--}}
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h3 class="widget-title" style="border-bottom: 2px solid @if($data->type_organe_id==1) dodgerblue @else orange @endif;"><span style="background: @if($data->type_organe_id==1) dodgerblue @else orange @endif;">Nos Services</span></h3>
                <div class="following-post">
                        <div class="row">

                            <div class="col-lg-12">

                                <table style="font-size: 11px;" class="table responsive-table layout">
                                    <tbody>
                                    @foreach($allServices as $allser)
                                    <tr>
                                        <td>{{$allser->name}}</td>
                                        <td style="width: 150px">
       <a class="btn_" href="{{route('mairie.service',["q"=>$allser->id,"target"=>$data->id])}}"> Faire une demande <i class="fa fa-arrow-right"> </i>  </a>
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



        <div id="secondary">
            <aside id="colormag_featured_posts_vertical_widget-11"
                   class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                <div class="following-post">
                <h3 class="widget-title" style="border-bottom: 2px solid @if($data->type_organe_id==1) dodgerblue @else orange @endif;">
                    <span style="background: @if($data->type_organe_id==1) dodgerblue @else orange @endif;">
                        @if($data->type_organe_id==1)  Nos mairies @else  Nos ministères @endif
                       </span></h3>
                @foreach($others as $ne)
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
            </aside>


        </div>
        </div>

@endsection

