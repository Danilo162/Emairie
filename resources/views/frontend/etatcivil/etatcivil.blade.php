@extends('frontend.layouts.main')
@section('content')
    <style type="text/css">
    	
    	span.image-illustrative img {
		    max-width: 40px;
		    max-height: 40px;
		}

		.label-radio {
		    text-align: center;
		    width: 74px;
		    height: 74px;
		    padding: 3px;
		    margin-bottom: 10px;
		    z-index: 20;
		    display: block;
		    float: left;
		    cursor: pointer;
		    color: #333;
		    line-height: 15px;
		    -moz-border-radius: 6px;
		    -webkit-border-radius: 6px;
		    border-radius: 6px;
		    font-size: 8.604pt;
		    position: relative;
		    top: 0px;
		    left: 0px;
		}

		label {
	    	display: inline;
		}

		label {
		    display: block;
		    margin-bottom: 5px;
		}
		label, input, button, select, textarea {
		    font-size: 9pt;
		    font-weight: normal;
		    line-height: 15px;
		}
		label, select, button, input[type="button"], input[type="reset"], input[type="submit"], input[type="radio"], input[type="checkbox"] {
		    cursor: pointer;
		}

		.dalle-radio_Demarches {
		    background-color: #ddf0fa;
		    -moz-box-shadow: 0px 0px 0px 1px rgba(98,98,98,0.2),0px 0px 0px 0px rgba(255,255,255,0.9) inset,0px 2px 2px rgba(0,0,0,0.15);
		    -webkit-box-shadow: 0px 0px 0px 1px rgb(98 98 98 / 20%), 0px 0px 0px 0px rgb(255 255 255 / 90%) inset, 0px 2px 2px rgb(0 0 0 / 15%);
		    box-shadow: 0px 0px 0px 1px rgb(98 98 98 / 20%), 0px 0px 0px 0px rgb(255 255 255 / 90%) inset, 0px 2px 2px rgb(0 0 0 / 15%);
		    text-align: center;
		    -moz-border-radius: 6px;
		    -webkit-border-radius: 6px;
		    border-radius: 6px;
		}
		.dalle {
		    float: left;
		    margin-left: 8px;
		    width: 90px;
		    height: 90px;
		    list-style: none;
		    -webkit-border-radius: 6px;
		    -moz-border-radius: 6px;
		    border-radius: 6px;
		    margin-bottom: 8px;
		}
		.containerprincipal {
		    width: 992px;
		    background: #fff;
		    margin-left: auto;
		    margin-right: auto;
		    padding-left: 4px;
		    padding-right: 4px;
		    position: relative;
		    font-family: 'Arial',sans-serif;
		    letter-spacing: normal;
		    color: #000;
		}

		h2 {
		    text-transform: uppercase;
		    color: #003a81;
		    margin: 0 0 5px 0;
		    text-shadow: 2px 2px 0 #cee4ff;
		}
		h2 {
		    font-size: 20.25pt;
		}
		h1, h2, h3 {
		    line-height: 30px;
		}
		h1, h2, h3, h4, h5, h6 {
		    margin: 7.5px 0;
		    font-family: 'Cuprum',sans-serif;
		    font-weight: normal;
		    line-height: 15px;
		    color: inherit;
		    text-rendering: optimizelegibility;
		}

    </style>

    <script type="text/javascript">
    	function show_page(url){

    		location.href = url;

    	}

    </script>
    <div class="main-content-section clearfix" >
        <div id="primary">
            <div id="content" class="clearfix">

                <section id="colormag_default_news_widget-2"
                         class="widget widget_default_news_colormag widget_featured_posts clearfix">
                    <h3 class="widget-title" style="border-bottom-color:#206b4d;"><span
                            style="background-color:#206b4d;">Services de l'état civil</span>
                    </h3>
                    <div class="default-news" style="padding:15px;">
                      	
						<section id="secActuFocus" class="span-sectionfocus hidden-phone">
						            
							<!--h2 id="hFocusActuTitre">Bienvenue</h2-->
							<p>Bienvenue sur E-MAIRIE, plateforme numérique, destinée à effectuer vos démarches liées à la vie quotidienne, plus facilement et plus rapidement.</p>

							<p>Pour faire vos demandes, il suffit de remplir les formulaires&nbsp;en ligne, qui seront traités directement par les services concernés.</p>

							<p>Par mail&nbsp;:&nbsp;<a href="mailto:infos@emairie.ci">infos@emairie.ci</a><br>
							Par téléphone : 07 07 06 05 04 03</p>

							<p>&nbsp;</p>

						</section>

                      	<section id="secDemandeFocus" class="span-sectiondemarche">
						    <!--démarches-->
						         
						    <h2 id="hDemandesFocusTitre">Démarches</h2>
						    <div class="row">

							    <div id="div_demarche_naissance" onclick="show_page('etatcivil/naissance')" class="dalle dalle-radio_Demarches" style="display: flex;">
							        <label for="ac_demarche-1" class="label-radio" title="Naissance : demande d'acte" style="overflow-wrap: break-word;">
								        <span class="image-illustrative">
								        	<img src="images/demande.png" alt=" Naissance : demande d'acte">
								        </span>
								        Naissance : demande...
								    </label>
							    </div>
							    
							    <div id="div_demarche_mariage" onclick="show_page('etatcivil/mariage')" class="dalle dalle-radio_Demarches" style="display: flex;">
							        <label for="ac_demarche-2" class="label-radio" title="Mariage : demande d'acte" style="overflow-wrap: break-word;">
							        	<span class="image-illustrative">
							                <img src="images/demande.png" alt=" Mariage : demande d'acte">
							            </span>
							            Mariage : demande... 
							        </label>
							    </div>
							   
							    <div id="div_demarche_deces" onclick="show_page('etatcivil/deces')" class="dalle dalle-radio_Demarches" style="display: flex;">
							        <label for="ac_demarche-3" class="label-radio" title="Décès : demande d'acte" style="overflow-wrap: break-word;">
								        <span class="image-illustrative">
							                <img src="images/demande.png" alt=" Décès : demande d'acte">
							            </span>
							            Décès : demande... 
							        </label>
							    </div>

						        <div class="dalle dalle-vide dalle-vide_Demarches visible-desktop" style="display: flex;"></div>
						        <div class="dalle dalle-vide dalle-vide_Demarches visible-desktop" style="display: flex;"></div>
						        <div class="dalle dalle-vide dalle-vide_Demarches visible-tablet" style="display: flex;"></div>
						        <div class="dalle dalle-vide dalle-vide_Demarches visible-tablet" style="display: flex;"></div>

						    </div>

						    <!--div class="row">
						        <div class="span-sectionprincipaleetroite">
						            <a id="lnkFaireNouvelleDemarcheDepuisDemarcheFocus" class="lien-accueil-public" href="Demande/ChoixTypeDemandeCache.html">Toutes les démarches</a>
						        </div>
						    </div-->        

						</section>

                      
                    </div>
                </section>

			</div>
		</div>
	</div>

@endsection
