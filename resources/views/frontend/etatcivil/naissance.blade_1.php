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


		/**/
		html {
		  background: radial-gradient(#FFF176, #F57F17);
		  min-height: 100%;
		  font-family: "Roboto", sans-serif;
		}

		.title {
		  text-transform: uppercase;
		  text-align: center;
		  margin-bottom: 10px;
		  color: #FF8F00;
		  font-weight: 300;
		  font-size: 24px;
		  letter-spacing: 1px;
		}

		.description {
		  text-align: center;
		  color: #666;
		  margin-bottom: 20px;
		}

		input[type=text],
		input[type=email] {
		  padding: 10px 20px;
		  border: 1px solid #999;
		  border-radius: 3px;
		  display: block;
		  width: 100%;
		  margin-bottom: 20px;
		  box-sizing: border-box;
		  outline: none;
		}
		input[type=text]:focus,
		input[type=email]:focus {
		  border-color: #FF6F00;
		}

		input[type=radio] {
		  margin-right: 10px;
		}

		label {
		  margin-bottom: 20px;
		  display: block;
		  font-size: 18px;
		  color: #666;
		  border-top: 1px solid #ddd;
		  border-bottom: 1px solid #ddd;
		  padding: 20px 0;
		  cursor: pointer;
		}
		label:first-child {
		  margin-bottom: 0;
		  border-bottom: none;
		}

		.button,
		.rerun-button {
		  padding: 10px 20px;
		  border-radius: 3px;
		  background: #FF6F00;
		  color: white;
		  text-transform: uppercase;
		  letter-spacing: 1px;
		  display: inline-block;
		  cursor: pointer;
		}
		.button:hover,
		.rerun-button:hover {
		  background: #e66400;
		}
		.button.rerun-button,
		.rerun-button.rerun-button {
		  border: 1px solid rgba(255, 255, 255, 0.6);
		  margin-bottom: 50px;
		  box-shadow: 0px 10px 15px -6px rgba(0, 0, 0, 0.2);
		  display: none;
		}

		.text-center {
		  text-align: center;
		}

		.modal-wrap {
		  max-width: 800px;
		  margin: 50px auto;
		  transition: transform 300ms ease-in-out;
		}

		.modal-header {
		  height: 25px;
		  background: white;
		  border-bottom: 1px solid #ccc;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		}
		.modal-header span {
		  display: block;
		  height: 12px;
		  width: 12px;
		  margin: 5px;
		  border-radius: 50%;
		  background: rgba(0, 0, 0, 0.2);
		}
		.modal-header span.is-active {
		  background: rgba(0, 0, 0, 0.4);
		  background: #FF8F00;
		}

		.modal-bodies {
		  position: relative;
		  perspective: 1000px;
		}

		.modal-body {
		  background: white;
		  padding: 40px 100px;
		  padding: 5px 15px;
		  box-shadow: 0px 50px 10px -30px rgba(0, 0, 0, 0.3);
		  margin-bottom: 50px;
		  position: absolute;
		  top: 0;
		  display: none;
		  box-sizing: border-box;
		  width: 100%;
		  transform-origin: top left;
		}
		.modal-body.is-showing {
		  display: block;
		}

		.animate-out {
		  -webkit-animation: out 600ms ease-in-out forwards;
		          animation: out 600ms ease-in-out forwards;
		}

		.animate-in {
		  -webkit-animation: in 500ms ease-in-out forwards;
		          animation: in 500ms ease-in-out forwards;
		  display: block;
		}

		.animate-up {
		  transform: translateY(-500px) rotate(30deg);
		}

		@-webkit-keyframes out {
		  0% {
		    transform: translateY(0px) rotate(0deg);
		  }
		  60% {
		    transform: rotate(60deg);
		  }
		  100% {
		    transform: translateY(800px) rotate(10deg);
		  }
		}

		@keyframes out {
		  0% {
		    transform: translateY(0px) rotate(0deg);
		  }
		  60% {
		    transform: rotate(60deg);
		  }
		  100% {
		    transform: translateY(800px) rotate(10deg);
		  }
		}
		@-webkit-keyframes in {
		  0% {
		    opacity: 0;
		    transform: rotateX(-90deg);
		  }
		  100% {
		    opacity: 1;
		    transform: rotateX(0deg);
		  }
		}
		@keyframes in {
		  0% {
		    opacity: 0;
		    transform: rotateX(-90deg);
		  }
		  100% {
		    opacity: 1;
		    transform: rotateX(0deg);
		  }
		}


		.input {border: 1px solid red;}

    </style>

    <script type="text/javascript">

    	$('.button').click(function(){
		  var $btn = $(this),
		      $step = $btn.parents('.modal-body'),
		      stepIndex = $step.index(),
		      $pag = $('.modal-header span').eq(stepIndex);

		  if(stepIndex === 0 || stepIndex === 1) { step1($step, $pag); }
		  else { step3($step, $pag); }
		  
		});


		function step1($step, $pag){
		console.log('step1');
		  // animate the step out
		  $step.addClass('animate-out');
		  
		  // animate the step in
		  setTimeout(function(){
		    $step.removeClass('animate-out is-showing')
		         .next().addClass('animate-in');
		    $pag.removeClass('is-active')
		          .next().addClass('is-active');
		  }, 600);
		  
		  // after the animation, adjust the classes
		  setTimeout(function(){
		    $step.next().removeClass('animate-in')
		          .addClass('is-showing');
		    
		  }, 1200);
		}


		function step3($step, $pag){
		console.log('3');

		  // animate the step out
		  $step.parents('.modal-wrap').addClass('animate-up');

		  setTimeout(function(){
		    $('.rerun-button').css('display', 'inline-block');
		  }, 300);
		}

		$('.rerun-button').click(function(){
		 $('.modal-wrap').removeClass('animate-up')
		                  .find('.modal-body')
		                  .first().addClass('is-showing')
		                  .siblings().removeClass('is-showing');

		  $('.modal-header span').first().addClass('is-active')
		                          .siblings().removeClass('is-active');
		 $(this).hide();
		});

    	function show_page(url){

    		location.href = url;

    	}

    </script>
    <div class="main-content-section clearfix" >
        <div id="wide_page">
            <div id="content" class="clearfix">

                <section id="colormag_default_news_widget-2"
                         class="widget widget_default_news_colormag widget_featured_posts clearfix">
                    <h3 class="widget-title" style="border-bottom-color:#206b4d;"><span
                            style="background-color:#206b4d;">Demande d'acte de naissance</span>
                    </h3>
                    <div class="default-news" style="padding-left:15px;height: 700px;">
                      	
						<section id="colormag_default_news_widget-2" class="">

						<div class="register-form" style="margin-top: 0px;">

							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
							<link rel="stylesheet" href="{{asset('css/register-form.css')}}">

							  <div class="wrapper" style="margin-top: 0px;">
								<div class="container"style="margin-top: 0px;">
									<article class="part card-details" style="border:1px solid #eee;margin-top: 0px;">
										<h1>
											Informations personnelles
										</h1>
										<form action="" if="cc-form" autocomplete="off">
											
											<!--div class="group card-number">
												<label for="first">N° acte de naissance</label>
												<input type="text" id="first" class="cc-num" type="text" maxlength="4" placeholder="&#9679;&#9679;&#9679;&#9679;">
												<input type="text" id="second" class="cc-num" type="text" maxlength="4" placeholder="&#9679;&#9679;&#9679;&#9679;">
												<input type="text" id="third" class="cc-num" type="text" maxlength="4" placeholder="&#9679;&#9679;&#9679;&#9679;">
											</div-->
											
											<div class="group" style="border: 1px solid red;padding-bottom: 0px;">
												<label for="first">N° acte de naissance</label>
												<input type="text" id="name" class="" type="text" maxlength="20" placeholder="N° acte de naissance">
											</div>
											<div class="group card-name" style="border: 1px solid red">
												<label for="name">Nom</label>
												<input type="text" class="input" placeholder="Nom">
											</div>
											
											<div class="group card-name">
												<label for="name">Prénoms</label>
												<input type="text" class="input" placeholder="Prénoms">
											</div>

											<div class="group card-name">
												<label for="name">Date naissance</label>
												<input type="date" class="input" tplaceholder="22/02/1986">
											</div>
											
											<div class="group card-name">
												<label for="name">Lieu de naissance</label>
												<input type="text" class="input" placeholder="Lieu de naissance">
											</div>

											<div class="group card-name">
												<label for="name">Nombre de copie</label>
												<input type="text" class="input" placeholder="">
											</div>

											<!--div class="group card-expiry">
												<div class="input-item expiry">
													<label for="expiry">Date naissance</label>
													<input type="text" class="year" id="expiry" placeholder="01">
													<input type="text" class="month" id="expiry" placeholder="02">
												</div>
												<div class="input-item csv">
													<label for="csv">&nbsp;</label>
													<input type="text" class="year" id="" placeholder="2017">
												</div>
											</div-->

											<div class="grup submit-group">
												<span class="arrow"></span>
												<input type="submit" class="submit" value="Continuer">
											</div>
										</form>
									</article>

									<div class="part bg" style="background: #">
										

									</div>

								</div>
							</div>

							<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

							<script src="{{asset('js/register-form.js')}}"></script>

						</div>

						</section>



						<br style="clear: both;"/>
                      
                    </div>
                </section>

			</div>
		</div>
	</div>

@endsection
