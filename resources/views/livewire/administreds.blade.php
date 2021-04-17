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
            <th scope="col" class="text-center">Nom et prénoms</th>
            <th scope="col" class="text-center">Téléphone</th>
            <th scope="col" class="text-center">Image</th>
            <th scope="col" class="text-center">Fonction</th>
            <th scope="col" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($administredsList as $administred)
            <tr>
                <td class="text-center">{{ $administred->firstname }}  {{ $administred->lastname }}</td>
                <td class="text-center">{{ $administred->phone }}</td>
                <td class="text-center"><img src="{{ asset('/storage/'.$administred->picture) }}" height="40px" width="30px" alt="" title=""></td>
                <td class="text-center">{{ $administred->job }}</td>
                <td class="text-center" with="20%">
                    <button type="button" class="text-center btn btn-primary" data-toggle="modal" data-target="#showModal"><i class="far fa-eye"></i></button>
                    <button type="button" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $administred->id }})" class="btn btn-success text-center"><i class="fas fa-edit"></i></button>
                    @if($confirming===$administred->id)
                      <button type="button" wire:click="destroy({{ $administred->id }})" class="text-center bg-red-800 text-white w-5 hover:bg-red-600 rounded border">Supprimer ?</button>
                    @else
                      <button type="button" wire:click="confirmDelete({{ $administred->id }})" class="btn btn-danger text-center"><i class="far fa-trash-alt"></i></button>
                    @endif
                </td>
                <!-- <div class="text-center">Aucun résultat pour le moment</div> -->
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="">
      {{ $administredsList->links() }}
    </div>
  </div>

  <!-- Create Administred Modal -->
  <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Enregistrer un nouvel administré</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
          <div class="modal-body">
                <form enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput1">Prénoms:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">accessible</i>
                            </span>
                            <div class="form-line">
                                <input type="text" wire:model="prenoms" id="exampleFormControlInput1" class="form-control" placeholder="Tous vos prénoms">
                            </div>
                            <div>
                              @error('prenoms') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput2">Nom:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment_ind</i>
                            </span>
                            <div class="form-line">
                                <input type="text" wire:model="nom" id="exampleFormControlInput2" class="form-control" placeholder="Nom de famille">
                            </div>
                            <div>
                              @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <label for="exampleFormControlInput3">Numéro de Téléphone officiel:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">phone_iphone</i>
                              </span>
                              <div class="form-line">
                                  <input type="text" class="form-control" wire:model="numero" id="exampleFormControlInput3" placeholder="Numéro de téléphone">
                              </div>
                              <div>
                                @error('numero') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlInput4">Autre Numéro de Téléphone:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model="numero2" id="exampleFormControlInput4" placeholder="Autre numéro de téléphone">
                                </div>
                                <div>
                                  @error('numero2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                  </div>
                <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput5">Adresse E-mail:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control email" wire:model="email" id="exampleFormControlInput5" placeholder="E-mail">
                            </div>
                            <div>
                              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleFormControlInput6">Date de Naissance:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons"></i>
                              </span>
                              <div class="form-line">
                                  <input type="date" class="form-control" wire:model="date" placeholder="Entrer la date ici">
                              </div>
                              <div>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput7">Lieu de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="lieu" id="exampleFormControlInput7" placeholder="Entrer le lieu">
                            </div>
                            <div>
                              @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="">Commune de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                              <select class="form-control" wire:model="commune" id="" >
                                  <option>Sélectionner</option>
                                  @foreach ($communeList as $commune)
                                    <option value="{{ $commune->name }}">{{ $commune->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div>
                              @error('commune') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput9">Adresse:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="adresse" id="exampleFormControlInput9" placeholder="Résidence, quartier, ...">
                            </div>
                            <div>
                              @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput10">Fonction:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">work</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="fonction" id="exampleFormControlInput10" placeholder="Votre fonction">
                            </div>
                            <div>
                              @error('fonction') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput11">Type de Pièce d'Identité:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="identite" id="exampleFormControlInput11" placeholder="Type de pièce">
                            </div>
                            <div>
                              @error('identite') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput12">Numéro de la Pièce d'identité:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">perm_identity</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="piece" id="exampleFormControlInput12" placeholder="Numero de la pièce">
                            </div>
                            <div>
                              @error('piece') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput13">Numéro de l'extrait de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">book</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="extrait" id="exampleFormControlInput13" placeholder="">
                            </div>
                            <div>
                              @error('extrait') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput14">Sexe:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">accessibility</i>
                            </span>
                            <div class="form-line">
                              <select class="form-control" id="exampleFormControlInput14" wire:model="sexe" >
                                <option>Sélectionner</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Féminin">Féminin</option>
                              </select>
                            </div>
                            <div>
                              @error('sexe') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">Image:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons"></i>
                            </span>
                            <div class="form-line">
                                <input type="file" class="form-control" wire:model="image" id="" placeholder="">
                            </div>
                            <div>
                              @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                <h5 class="modal-title" id="updateModalLabel">Modifier les données de cet administré</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
          <div class="modal-body">
                <form enctype="multipart/form-data">
                  <input type="hidden" wire:model="selected_id">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput1">Prénoms:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">accessible</i>
                            </span>
                            <div class="form-line">
                                <input type="text" wire:model="prenoms" id="exampleFormControlInput1" class="form-control" placeholder="Tous vos prénoms">
                            </div>
                            <div>
                              @error('prenoms') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput2">Nom:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment_ind</i>
                            </span>
                            <div class="form-line">
                                <input type="text" wire:model="nom" id="exampleFormControlInput2" class="form-control" placeholder="Nom de famille">
                            </div>
                            <div>
                              @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <label for="exampleFormControlInput3">Numéro de Téléphone officiel:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">phone_iphone</i>
                              </span>
                              <div class="form-line">
                                  <input type="text" class="form-control" wire:model="numero" id="exampleFormControlInput3" placeholder="Numéro de téléphone">
                              </div>
                              <div>
                                @error('numero') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlInput4">Autre Numéro de Téléphone:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model="numero2" id="exampleFormControlInput4" placeholder="Autre numéro de téléphone">
                                </div>
                                <div>
                                  @error('numero2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput5">Adresse E-mail:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control email" wire:model="email" id="exampleFormControlInput5" placeholder="E-mail">
                            </div>
                            <div>
                              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleFormControlInput6">Date de Naissance:</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons"></i>
                              </span>
                              <div class="form-line">
                                  <input type="text" class="form-control date-fr floating-label" wire:model="date" placeholder="Entrer la date ici">
                              </div>
                              <div>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput7">Lieu de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="lieu" id="exampleFormControlInput7" placeholder="Entrer le lieu">
                            </div>
                            <div>
                              @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput8">Commune de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                              <select class="form-control" wire:model="commune" id="exampleFormControlInput8" >
                                  <option>Sélectionner</option>
                                  @foreach ($communeList as $commune)
                                    <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div>
                              @error('commune') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput9">Adresse:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="adresse" id="exampleFormControlInput9" placeholder="Résidence, quartier, ...">
                            </div>
                            <div>
                              @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput10">Fonction:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">work</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="fonction" id="exampleFormControlInput10" placeholder="Votre fonction">
                            </div>
                            <div>
                              @error('fonction') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput11">Type de Pièce d'Identité:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="identite" id="exampleFormControlInput11" placeholder="Type de pièce">
                            </div>
                            <div>
                              @error('identite') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput12">Numéro de la Pièce d'identité:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">perm_identity</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="piece" id="exampleFormControlInput12" placeholder="Numero de la pièce">
                            </div>
                            <div>
                              @error('piece') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleFormControlInput13">Numéro de l'extrait de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">book</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" wire:model="extrait" id="exampleFormControlInput13" placeholder="">
                            </div>
                            <div>
                              @error('extrait') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleFormControlInput14">Sexe:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">accessibility</i>
                            </span>
                            <div class="form-line">
                              <select class="form-control" id="exampleFormControlInput14" wire:model="sexe" >
                                <option>Sélectionner</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Féminin">Féminin</option>
                              </select>
                            </div>
                            <div>
                              @error('sexe') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">Image:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons"></i>
                            </span>
                            <div class="form-line">
                                <input type="file" class="form-control" wire:model="image" id="" placeholder="">
                            </div>
                            <div>
                              @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="">Mairie:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line">
                              <select class="form-control" wire:model="mairie" id="" >
                                  <option>Sélectionner</option>
                                  @foreach ($mairieList as $mairie)
                                    <option value="{{ $mairie->nom }}">{{ $mairie->nom }}</option>
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
                <h5 class="modal-title" id="showModalLabel">Détails de l'Administré</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
        <div class="modal-body">
          <div class="container emp-profile">
					  <div class="row">
              @foreach ($administreds as $administred)
                <div class="col-md-3 text-left">
                  <div class="profile-img">
                    <img class="roundedImage" width="200px" height="200px" src="{{ asset('/storage/'.$administred->picture) }}" alt=""/>
                    <!-- <div class="custom-file btn btn-primary">
                      <input type=file name="file" id="file" class="custom-file-input">
                    </div> -->
                  </div>
                </div>

						  <div class="col-md-8">
							  <div class="profile-head">
                      <h1 style="color: rgb(84, 142, 250)">
											  {{$administred->firstname}} {{$administred->lastname}}
										  </h1>
										  <h6>
											  {{$administred->job}}
										  </h6>
										  <p class="proile-rating"> <span style="font-weight: bold"> Date et Lieu de Naissance :</span> <span>{{ \Carbon\Carbon::createFromTimestamp(strtotime($administred->birth_date))->format('d-m-Y') }} à {{$administred->birth_place}}</span></p>
                  
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home_with_icon_title" data-toggle="tab">
                                <i class="material-icons">face</i> INFORMATIONS PERSONNELLES
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile_with_icon_title" data-toggle="tab">
                                <i class="material-icons">toc</i> SERVICE/COMMERCE
                            </a>
                        </li>
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
                                  <td style="font-weight: bold" width="500px">Prénoms</td>
                                  <td  width="300px">{{$administred->firstname}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Nom de Famille</td>
                                  <td  width="300px">{{$administred->lastname}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Fonction</td>
                                  <td  width="300px">{{$administred->job}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Adresse électronique (E-mail)</td>
                                  <td  width="300px">{{$administred->email}}</td>
                                </tr> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Numéro de Téléphone</td>
                                  <td  width="300px">{{$administred->phone}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Autre de Téléphone</td>
                                  <td  width="300px">{{$administred->phone2}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Date de Naissance</td>
                                  <td  width="300px">{{ \Carbon\Carbon::createFromTimestamp(strtotime($administred->birth_date))->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Lieu de Naissance</td>
                                  <td  width="300px">{{$administred->birth_place}}</td>
                                </tr> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Mairie</td>
                                  <td width="300px">{{$administred->mairie->nom}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Commune de Naissance</td>
                                  <td  width="300px">{{$administred->birth_commune_id}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Résidence/Quartier</td>
                                  <td  width="300px">{{$administred->residence_commune_id}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Sexe</td>
                                  <td  width="300px">{{$administred->gender}}</td>
                                </tr> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Type de Pièce d'Identité</td>
                                  <td  width="300px">{{$administred->identity_papers_type}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Numéro de la Pièce d'Identité</td>
                                  <td  width="300px">{{$administred->identity_papers_id}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Numéro de l'Extrait de Naissance</td>
                                  <td  width="300px">{{$administred->birth_certificate_number}}</td>
                                </tr> 
                              </table>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                            <b></b>
                            <p>
                              <table class="table table-hover table-bordered"> 
                                <tr>
                                  <td style="font-weight: bold" width="500px">Nom de la mairie</td>
                                  <td width="300px">{{$administred->mairie->nom}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Localisation</td>
                                  <td width="300px">{{$administred->mairie->localisation}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Téléphone</td>
                                  <td width="300px">{{$administred->mairie->phone}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Adresse E-mail</td>
                                  <td width="300px">{{$administred->mairie->email}}</td>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold" width="500px">Status</td>
                                  <td width="300px">{{$administred->mairie->status}}</td>
                                </tr>
                              </table>
                            </p>
                        </div>
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
