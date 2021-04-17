<div>
    <div class="row">
      <div class="col-md-3 text-left">
            <div class="form-group has-feedback">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                Ajouter
              </button>
            </div>
      </div>
  
      <div class="col-md-5">
          <form class="search-form">
              <div class="form-group has-feedback">
                  <label for="query" class="sr-only">Search</label>
                  <input type="text" wire:model="query" id="query" class="form-control" placeholder="Rechercher ...">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
          </form>
      </div>
      <!--<div class="row">
        <div class="text-right col-md-3">
          <label for="per_option">Trier par:</label>
          <select wire:model.lazy="perOption" id="per_option" class="custum-select w-auto">
              <option value="sexe">Sexe</option>
              <option value="quartier">Quartier</option>
              <option value="commune">Commune</option>
              <option value="fonction">Fonction</option>
          </select>
        </div>  -->
        <div class="text-right col-md-4">
            <!-- <select wire:model="perPage" id="per_page" class="custum-select w-auto"> -->
              <label for="">Voir:</label>
            <select wire:model.lazy="perPage" id="per_page" class="custum-select w-auto">
                @for($i = 5; $i <= 25; $i += 5)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <label for="per_page">par page</label>
        </div>
      <!-- </div> -->
    </div>
  
    <div class="row">
      <div class="col-12">
        @if (session()->has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
        @endif
  
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center">Libellé</th>
              <th scope="col" class="text-center">Administré</th>
              <th scope="col" class="text-center">Raison social</th>
              <th scope="col" class="text-center">Mairie</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($commerceList as $commerce)
              <tr>
                  <td class="text-center">{{ $commerce->identifier }}</td>
                  <td class="text-center">{{ $commerce->administred->firstname }} {{ $commerce->administred->lastname }}</td>
                  <td class="text-center">{{ $commerce->raison_social }}</td>
                  <td class="text-center">{{ $commerce->mairie->nom }}</td>
                  <td class="text-center" with="20%">
                      <button type="button" class="text-center btn btn-primary" data-toggle="modal" data-target="#showModal"><i class="far fa-eye"></i></button>
                      <button type="button" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $commerce->id }})" class="btn btn-success text-center"><i class="fas fa-edit"></i></button>
                      @if($confirming===$commerce->id)
                        <button type="button" wire:click="destroy({{ $commerce->id }})" class="text-center bg-red-800 text-white w-5 hover:bg-red-600 rounded border">Supprimer ?</button>
                      @else
                        <button type="button" wire:click="confirmDelete({{ $commerce->id }})" class="btn btn-danger text-center"><i class="far fa-trash-alt"></i></button>
                      @endif
                  </td>
                  <!-- <div class="text-center">Aucun résultat pour le moment</div> -->
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="">
        {{ $commerceList->links() }}
      </div>
    </div>
  
    <!-- Create Administred Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Enregistrer un nouvel commerce</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true close-btn">×</span>
                  </button>
              </div>
            <div class="modal-body">
                  <form enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="">Nom:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">comment_bank</i>
                              </span>
                              <div class="form-line">
                                  <input type="text" wire:model="nom" id="" class="form-control" placeholder="Nom du commerce">
                              </div>
                              <div>
                                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <label for="">Administré:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">dashboard</i>
                              </span>
                              <div class="form-line">
                                <select class="form-control" wire:model="admin" id="" >
                                    <option>Choisir</option>
                                    @foreach ($administredsList as $administred)
                                      <option value="{{ $administred->id }}">{{ $administred->firstname }} {{ $administred->lastname }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div>
                                @error('admin') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <label for="">Raison social:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">flaky</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model="raison" id="exampleFormControlInput3" placeholder="Indiquer la raison">
                                </div>
                                <div>
                                  @error('raison') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlInput8">Mairie:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">toc</i>
                                </span>
                                <div class="form-line">
                                  <select class="form-control" wire:model="mairie" id="" >
                                      <option>Sélectionner</option>
                                      @foreach ($mairieList as $mairie)
                                        <option value="{{ $mairie->id }}">{{ $mairie->nom }}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div>
                                  @error('mairie') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <label for="">Description:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">horizontal_split</i>
                              </span>
                              <div class="form-line">
                                <textarea class="form-control" wire:model="description" id="" placeholder="Votre description ici..." rows="3"></textarea>
                              </div>
                              <div>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-danger d-line close-btn" wire:click.prevent="cancel" data-dismiss="modal">Annuler</button>
                      <button class="btn btn-primary d-line" wire:click.prevent="store">Valider</button>
                      <button class="btn btn-success d-line" wire:loading wire:target="store">
                        En cours d'enregistrement ...
                      </button>  
                    </div>          
                  </form>
            </div>
            <div class="modal-footer">
  
            </div>
          </div>
    </div>
  </div>
  
    <!-- Update Administred Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="updateModalLabel">Modifier les données de ce commerce</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true close-btn">×</span>
                  </button>
              </div>
            <div class="modal-body">
                  <form enctype="multipart/form-data">
                    <input type="hidden" wire:model="selected_id">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="">Nom:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">accessible</i>
                              </span>
                              <div class="form-line">
                                  <input type="text" wire:model="nom" id="" class="form-control" placeholder="Nom du commerce">
                              </div>
                              <div>
                                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <label for="">Administré:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">map</i>
                              </span>
                              <div class="form-line">
                                <select class="form-control" wire:model="admin" id="" >
                                    <option>Choisir</option>
                                    @foreach ($administredsList as $administred)
                                      <option value="{{ $administred->id }}">{{ $administred->firstname }} {{ $administred->lastname }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div>
                                @error('admin') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <label for="">Raison social:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone_iphone</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model="raison" id="exampleFormControlInput3" placeholder="Indiquer la raison">
                                </div>
                                <div>
                                  @error('raison') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <label for="">Description:</label>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="material-icons">phone</i>
                                  </span>
                                  <div class="form-line">
                                    <textarea class="form-control" wire:model="description" id="" placeholder="Votre description ici..." rows="3"></textarea>
                                  </div>
                                  <div>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          <label for="exampleFormControlInput8">Mairie:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">map</i>
                                </span>
                                <div class="form-line">
                                  <select class="form-control" wire:model="mairie" id="" >
                                      <option>Sélectionner</option>
                                      @foreach ($mairieList as $mairie)
                                        <option value="{{ $mairie->id }}">{{ $mairie->nom }}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div>
                                  @error('mairie') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-danger d-line close-btn" wire:click.prevent="cancel" data-dismiss="modal">Annuler</button>
                      <button class="btn btn-primary d-line" wire:click.prevent="update">Modifier</button>
                      <button class="btn btn-success d-line" wire:loading wire:target="update">
                        Modification en cours ...
                      </button> 
                    </div>
              </div>
              <div class="modal-footer">
  
              </div>
          </div>
      </div>
    </div>

    <!-- Show Administred Modal -->
  <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Détails du commerce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
        <div class="modal-body">
          <div class="container emp-profile">
					  <div class="row">
              @foreach ($commerces as $commerce)
                <div class="col-md-3 text-left">
                </div>

						  <div class="col-md-8">
							  <div class="profile-head">
                      <h1 style="color: rgb(84, 142, 250)">
											  
										  </h1>
										  <h6>
											  
										  </h6>
                      <p class="proile-rating"> <span style="font-weight: bold"> </span> <span>
                        
                      </span></p>
                  
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home_with_icon_title" data-toggle="tab">
                                <i class="material-icons">business</i> INFORMATIONS DU COMMERCE
                            </a>
                        </li>
                        <!--<li role="presentation">
                            <a href="#profile_with_icon_title" data-toggle="tab">
                                <i class="material-icons">toc</i> SERVICE/COMMERCE
                            </a>
                        </li> -->
                        <!-- <li role="presentation">
                            <a href="#messages_with_icon_title" data-toggle="tab">
                                <i class="material-icons">email</i> MESSAGES
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#settings_with_icon_title" data-toggle="tab">
                                <i class="material-icons">settings</i> SETTINGS
                            </a>
                        </li> -->
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                            <b></b>
                            <p>
                              <table class="table table-hover table-bordered"> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Nom du commerce</td>
                                  <td  width="300px">{{$commerce->identifier}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Administré</td>
                                  <td  width="300px">{{$commerce->administred->firstname}} {{$commerce->administred->lastname}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Raison social</td>
                                  <td  width="300px">{{$commerce->raison_social}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Description</td>
                                  <td  width="300px">{{$commerce->description}}</td>
                                </tr> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Mairie</td>
                                  <td  width="300px">{{$commerce->mairie->nom}}</td>
                                </tr> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Status</td>
                                  <td  width="300px">{{$commerce->status}}</td>
                                </tr>
                              </table>
                            </p>
                        </div>
                        <!-- <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                            <b>Profile Content</b>
                            <p>
                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                sadipscing mel.
                            </p>
                        </div> -->
                      </div>
                    @endforeach
                  </div>
					      </div>

              </div>
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-warning d-line close-btn" data-dismiss="modal">Annuler</button>
          </div>
        </div>
      </div>
  </div>
  
  
  </div>
  