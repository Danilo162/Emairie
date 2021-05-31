@extends('frontend.layouts.main')
@section('content')
<link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/perso.css')}}">

<ul class="breadcrumb no-border no-radius b-b b-light pull-in" style="padding: 5px 0px;margin:0px;margin-top:6px;"> 
    <li><a href="{{route('etatcivil')}}"><i class="fa fa-home"></i> Etat civil</a></li>
    <li class="active">Mes demandes</li> 
</ul> 

<div id="main" class="clearfix" style=" border-top-left-radius:10px; border-top-right-radius:10px;">
    <div class="row profile" style="padding-top: 0px;">

        @include('frontend.profile.menu')
        <div class="col-md-9">

            <div class="profile-content">

                <header class="panel-heading h4" style="border-bottom: 1px solid #eee;margin-bottom: 20px;"> DEMANDE D'ACTE DE MARIAGE</header> 

                @if(Session::has('warning'))
                    <div class="alert alert-warning">
                      {{Session::get('warning')}}
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success">
                      {{Session::get('success')}}
                    </div>
                @endif


		        <form method="POST" id="form-demande-naissance" class="signup-form" enctype="multipart/form-data" action="{{route('etatcivil.SaveDemandeActeMariage')}}">

		        {!! csrf_field() !!}

		        <div class="col-md-12" style="padding: 0px;">

	                <div class="col-md-6">
	                
                        <div class="group card-name">
                            <label for="name">Adresser la demande à</label>
                            <select name="mairie_id" class="input" style="margin-bottom: 10px;" required>
                                <option value="">Choisir</option>
                                @foreach($mairies as $mairie)
                                <option value="{{$mairie->id}}">{{$mairie->nom}}</option>
                                @endforeach
                            </select>
                        </div>

						<div class="group card-name">
	                        <label for="name">N° de l'acte de mariage</label>
	                        <input type="text" class="input" name="numero_acte" required>
	                    </div>

                        <div class="group card-name">
                            <label for="name">Nom du marié</label>
                            <input type="text" class="input" name="nom_marie" required>
                        </div>
                        
                        <div class="group card-name">
                            <label for="name">Prénoms du marié</label>
                            <input type="text" class="input" name="prenoms_marie" required>
                        </div>

                        <div class="group card-name">
                            <label for="name">Nom de la mariée</label>
                            <input type="text" class="input" name="nom_mariee" required>
                        </div>
                        
                        <div class="group card-name">
                            <label for="name">Prénoms de la mariée</label>
                            <input type="text" class="input" name="prenoms_mariee" required>
                        </div>

	                </div>
			        
	                <div class="col-md-6">
	                
                        <div class="group card-name">
                            <label for="name">Date du mariage</label>
                            <input type="date" class="input" name="date_mariage" style="padding: 0px 5px;" required>
                        </div>
                        
                        <div class="group card-name">
                            <label for="name">Lieu</label>
                            <input type="text" class="input" name="lieu_mariage" required>
                        </div>
	                    <div class="group card-name">
	                        <label for="name">Nombre de copies</label>
	                        <input type="number" class="input" name="nombre_copies" value="1" required>
	                    </div>

	                    <div class="group card-name">
	                        <label for="name">Qualité du demandeur</label>
	                        <select name="qualite_demandeur" style="margin-bottom: 10px;" required>
	                            <option value="">Choisir</option>
	                            @foreach($qualites as $qualite)
	                            <option value="{{$qualite->qualite_id}}">{{$qualite->qualite_libelle}}</option>
	                            @endforeach
	                        </select>
	                    </div>

	                    <div class="group card-name">
	                        <label for="name">Motif de la demande</label>
	                        <textarea class="input" name="motif" style="height:82px;" required></textarea>
	                    </div>

	                </div>

                </div>

				<div class="line line-lg pull-in"></div>
				
				<div class="col-md-12 ">
				
					<div class="actions pull-left"> 
						<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					</div>
					<div class="actions pull-right"> 
						<button type="submit" class="btn btn-success btn-sm">SOUMETTRE</button> 
					</div>
		        
		        </div>

		        </form>


            </div>
        </div>
    </div>
    </div>


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('select2/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
            $(".shorForm").on("click", function () {
                $(".showOrHide").slideToggle();
            })
        })
    </script>
@endsection

