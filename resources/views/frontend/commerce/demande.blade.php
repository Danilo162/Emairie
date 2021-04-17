@extends('frontend.layouts.main')
@section('content')

    <link rel="stylesheet" href="{{asset('frontend/jquery-steps/demo/css/jquery.steps.css')}}">
    <script src="{{asset('frontend/jquery-steps/lib/modernizr-2.6.2.min.js')}}"></script>
    <script src="{{asset('frontend/jquery-steps/lib/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('frontend/jquery-steps/lib/jquery.cookie-1.3.1.js')}}"></script>
    <script src="{{asset('frontend/jquery-steps/build/jquery.steps.js')}}"></script>



<div id="main" class="clearfix" style="margin-top:6px; border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="inner-wrap clearfix">
        <div id="secondary">
            <aside id="colormag_featured_posts_vertical_widget-11"
                   class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
                <div class="following-post">
                    <h3 class="widget-title" style="border-bottom: 2px solid  @if($data->type_organe_id==1) dodgerblue @else orange @endif;;">
                        <span style="background:  @if($data->type_organe_id==1) dodgerblue @else orange @endif;;">
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

                </div>

            </aside>
        </div>

        <div id="primary" class="">

            <form class="form-horizontal letter" id="frmCreate"
                  @submit.prevent="store"
                  method="POST">

                <div class="row bg-color-gris-effet-1 " style="padding: 10px;border-radius: 5px">
                    <div class="col-lg-3"><img src="{{asset('storage/'.$data->picture)}}" alt="" style="height: 80px"></div>
                    <div style="vertical-align: middle;padding: 25px 0 10px 0" class="col-lg-9">{{$data->nom}}</div>
                </div>


                <br>

                <div class="form-group row">
                    <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Demande</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{$service->name}}" readonly class="form-control form-control-sm" id="" >
                        <input type="hidden" value="{{$service->id}}" readonly name="demande"   class="form-control form-control-sm" id="" >
                    </div>
                </div>
                <div class="form-group row">
                  {{--  <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Mairie</label>--}}
                    <div class="col-sm-8">
                        <input type="hidden" value="{{$data->nom}}" readonly  class="form-control form-control-sm" id="" >
                        <input type="hidden" value="{{$data->id}}" readonly name="mairie" class="form-control form-control-sm" id="" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Votre nom complet</label>
                    <div class="col-sm-8">
                        <input style="background: white"  type="text" value="{{administred()?administred()->lastname:""}}" name="nom" class="form-control form-control-sm" id="" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Votre prénoms</label>
                    <div class="col-sm-8">
                        <input style="background: white"  type="text" value="{{administred()?administred()->firstname:""}}" name="prenom"  class="form-control form-control-sm" id="" >
                    </div>
                </div>
                <div class="form-group row" >
                    <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Numéro d'extrait</label>
                    <div class="col-sm-8">
                        <input style="background: white" required
                               type="text" value="{{administred()?administred()->birth_certificate_number:""}}"
                               name="numero_extrait"  class="form-control form-control-sm "  id="" >
                       {{-- <span v-if="e_numero" role="alert">
                                                        <strong style="color: red;font-size: 12px">@{{e_numero}}</strong>
                                                    </span>--}}
                    </div>
                </div>
                <div class="form-group row " >
                    <label for=""
                           class="col-sm-4 col-form-label col-form-label-sm">Quantité</label>
                    <div class="col-sm-4">
                        <input style="background: white" :class="{'alert alert-danger':e_quantite !=='' }"  required type="text" name="quantite" class="form-control  form-control-sm" id="" >

                        <span v-if="e_quantite" role="alert">
                                                        <strong style="color: red;font-size: 12px">@{{e_quantite}}</strong>
                                                    </span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary submitbtn">Enregistrer</button>
                    </div>
                </div>
            </form>
        {{--    <div id="content" class="clearfix">
                <div id="wizard">
                    <h2>Informations génerales</h2>
                    <section>
                        <p>

                            form
                        </p>
                    </section>

                    <h2>Second Step</h2>
                    <section>
                        <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque.
                            In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum
                            dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur.
                            In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam.
                            Donec non pulvinar urna. Aliquam id velit lacus.</p>
                    </section>

                    <h2>Third Step</h2>
                    <section>
                        <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo,
                            pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat.
                            Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris
                            venenatis.</p>
                    </section>

                    <h2>Forth Step</h2>
                    <section>
                        <p>Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor.
                            Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum purus, imperdiet varius est pellentesque vitae.
                            Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor.</p>
                    </section>
                </div>
            </div>--}}

        </div>

        </div>

    <input type="hidden" value="{{route('profile.demande')}}" id="profile">
    </div>
    <script>
        function frmCreateReset(frm){
            $("#"+frm)[0].reset();

            $(".imgpreview").attr("src","")
        }
        function btnsend_loader_show(btn){
            $("."+btn).attr("disabled", true);
            $("."+btn).html("Enregistrement en cours...");
        }
        function btnsend_loader_hide(btn){
            $("."+btn).attr("disabled", false);
            $("."+btn).html("Enregistrer");
        }
    </script>
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>
    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/demande.js') }}"></script>
    <script>
        $(function ()
        {




           /* $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                stepsOrientation: "vertical"
            });*/
        });
    </script>
@endsection

