@extends('frontend.layouts.main')
@section('content')

    <div class="main-content-section clearfix" >
        <div id="wide_page">
            <div id="content" class="clearfix">

                <section id="colormag_default_news_widget-2"
                         class="widget widget_default_news_colormag widget_featured_posts clearfix">
                    <h3 class="widget-title" style="border-bottom-color:##219b9c;"><span
                            style="background-color:#219b9c;">Demande d'acte de naissance</span>
                    </h3>

                    <div class="info">
						@if(Session::has('warning'))
							<div class="alert alert-warning">
							  {{Session::get('warning')}}
							</div>
						@endif

						@if(Session::has('success'))
							<div class="alert alert-success">
							  {{Session::get('success')}}
							</div>
						@endif
                    </div>

                    <div class="default-news" style="padding-left:15px;">
                        
                        <section id="colormag_default_news_widget-2" class="" style="margin-top: 0px;">


							<div id="multistepform">
							    <link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">

							    <!-- Main css -->
							    <link rel="stylesheet" href="{{asset('css/style_wizzard.css')}}">
							    <div class="main" style="">

							        <div class="container" style="width: 100%;">
							            <form method="POST" id="form-demande-naissance" class="signup-form" enctype="multipart/form-data" action="{{route('etatcivil.naissance')}}">

							            {!! csrf_field() !!}

							             <h3>INFORMATIONS SUR LA DEMARCHE</h3>
							                <fieldset>
							                    <h2>INFORMATIONS SUR LA DÉMARCHE</h2>
							                                                
							                   <div class="group card-name">
							                    	<p>
							                    		Bienvenue sur E-MAIRIE, plateforme numérique, destinée à effectuer vos démarches liées à la vie quotidienne, plus facilement et plus rapidement.
							                    	</p>
							                    	<p>		
													Pour faire vos demandes, il suffit de remplir les formulaires en ligne, qui seront traités directement par les services concernés.
													</p>
													<p>
													Par mail : infos@emairie.ci<br/>
													Par téléphone : 07 07 06 05 04 03
													</p>
							                    </div>                         

							                </fieldset>
							                <h3>
							                    INFORMATIONS PERSONNELLES
							                </h3>
							                <fieldset>
							                    <h2>Informations personnelles</h2>
							                                                
							                   <div class="group card-name">
							                        <label for="nom">Nom</label>
							                        <input type="text" class="input" name="user_nom" placeholder="Nom" required>
							                    </div>
							                    
							                    <div class="group card-name">
							                        <label for="name">Prénoms</label>
							                        <input type="text" class="input" name="user_prenoms" placeholder="Prénoms" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Date naissance</label>
							                        <input type="date" class="input" name="user_date_naissance" tplaceholder="22/02/1986" required>
							                    </div>
							                    
							                    <div class="group card-name">
							                        <label for="name">Lieu de naissance</label>
							                        <input type="text" class="input" name="user_lieu_naissance" placeholder="Lieu de naissance" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Pays de résidence</label>
							                        <input type="text" class="input" name="user_pays_residence" placeholder="Pays de résidence" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Ville/Commune</label>
							                        <input type="text" class="input" name="user_commune" placeholder="Ville/Commune" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Quartier</label>
							                        <input type="text" class="input" name="user_quartier" placeholder="Quartier" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Adresse postale</label>
							                        <input type="text" class="input" name="user_adresse_postale" placeholder="Adresse postale" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">E-mail</label>
							                        <input type="text" class="input" name="user_email" placeholder="E-mail" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Téléphone</label>
							                        <input type="text" class="input" name="user_telephone" placeholder="Téléphone" required>
							                    </div>
							                      

							                    <br class="clear"/>
							                </fieldset>

							                <h3>
							                    LA DEMANDE 
							                </h3>
							                <fieldset>
							                    <h2>LA DEMANDE </h2>
							                    
							                    <!--h2 style="margin-bottom: 10px;">LA PERSONNE CONCERNÉE PAR L'ACTE</h2-->
							                    <div class="group card-name">
							                        <label for="name">Nom</label>
							                        <input type="text" class="input" name="titulaire_nom" placeholder="Nom" required>
							                    </div>
							                    
							                    <div class="group card-name">
							                        <label for="name">Prénoms</label>
							                        <input type="text" class="input" name="titulaire_prenoms" placeholder="Prénoms" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Date naissance</label>
							                        <input type="date" class="input" name="titulaire_date_naissance" tplaceholder="22/02/1986" required>
							                    </div>
							                    
							                    <div class="group card-name">
							                        <label for="name">Lieu de naissance</label>
							                        <input type="text" class="input" name="titulaire_lieu_naissance" placeholder="Lieu de naissance" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Nom et prénoms du père</label>
							                        <input type="text" class="input" name="titulaire_nom_pere" placeholder="Nom et prénoms du père" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Nom et prénoms de la mère</label>
							                        <input type="text" class="input" name="titulaire_nom_mere" placeholder="Nom et prénoms de la mère" required>
							                    </div>


							                    <!--h2 style="margin-bottom: 10px;">LA DEMANDE</h2-->
							                    <div class="group card-name">
							                        <label for="name">N° de l'acte de naissance</label>
							                        <input type="text" class="input" name="numero_acte_naissance" placeholder="N° acte de naissance" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Nombre de copies</label>
							                        <input type="number" class="input" name="nombre_copies" placeholder="Nombre de copies" value="1" required>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Qualité du demandeur</label>
							                        <select name="qualite_demandeur" required>
							                            <option value="">Choisir</option>
							                            @foreach($qualites as $qualite)
							                            <option value="{{$qualite->qualite_id}}">{{$qualite->qualite_libelle}}</option>
							                            @endforeach
							                        </select>
							                    </div>

							                    <div class="group card-name">
							                        <label for="name">Motif de la demande</label>
							                        <input type="text" class="input" name="motif" placeholder="Motif de la demande" required>
							                    </div>


							                    <br style="clear: both;"/>
							                </fieldset>

							            </form>
							        </div>

							    </div>

							    <!-- JS -->
							    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
							    <script src="{{asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
							    <script src="{{asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
							    <script src="{{asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
							    <script src="{{asset('js/main.js')}}"></script>
							</div>


							</section>



                        <br style="clear: both;"/>
                      
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection