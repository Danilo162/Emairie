+function ($) { "use strict";

  $(function(){

		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		
	    //Datatable
		var base_url = $("#eco_base_url").val();
		
		function performEvent(el, etype){
		  if (el.fireEvent) {
			el.fireEvent('on' + etype);
		  } else {
			var evObj = document.createEvent('Events');
			evObj.initEvent(etype, true, false);
			el.dispatchEvent(evObj);
		  }
		}

		////
		var dragSrcEl = '';
			
		function dragStart(e) {
			this.style.opacity = '0.4';
			dragSrcEl = this;
			e.dataTransfer.effectAllowed = 'move';
			e.dataTransfer.setData('text/html', this.innerHTML);
		};

		function dragEnter(e) {
			this.classList.add('over');
		  
		}

		function dragLeave(e) {
			e.stopPropagation();
			this.classList.remove('over');
		}

		function dragOver(e) {
			e.preventDefault();
			e.dataTransfer.dropEffect = 'move';
			return false;
		}

		function dragDrop(e) {
			
			var SrcEl_parent 		= dragSrcEl.parentElement.getAttribute('id');
			var current_parent 		= $(this).parent().attr('id');
			var tache_new_statut 	= $(this).parent().attr('data-statut');
			
			if (SrcEl_parent != current_parent) {
				// if (dragSrcEl != this) {
				  
				dragSrcEl.remove();

				var tache_id 			= dragSrcEl.getAttribute('data-tache_id');
				var tache_numero 		= dragSrcEl.getAttribute('data-tache_numero');
				var tache_title 		= dragSrcEl.getAttribute('data-tache_libelle');

				$(this).parent().append('<li class="todo_item draggable" draggable="true" data-tache_id="'+tache_id+'" data-numero="'+tache_numero+'" class="draggable">'+tache_title+'</li>');

				$.get(base_url + 'todo/changestatut/'+tache_id+'/'+tache_new_statut,function(){location.href=""});

			}else{
				
				dragSrcEl.innerHTML = this.innerHTML;
				this.innerHTML = e.dataTransfer.getData('text/html');
				
			}
		  
		  return false;
		  
		}
		

		function dragEnd(e) {
		  var listItens = document.querySelectorAll('.draggable');
		  [].forEach.call(listItens, function(item) {
			item.classList.remove('over');
		  });
		  this.style.opacity = '1';
		}

		function addEventsDragAndDrop(el) {
			el.addEventListener('dragstart', dragStart, false);
			el.addEventListener('dragenter', dragEnter, false);
			el.addEventListener('dragover', dragOver, false);
			el.addEventListener('dragleave', dragLeave, false);
			el.addEventListener('drop', dragDrop, false);
			el.addEventListener('dragend', dragEnd, false);
		}

		var listItens = document.querySelectorAll('.draggable');
		[].forEach.call(listItens, function(item) {
		  addEventsDragAndDrop(item);
		});
		
		
		
		//Added on 10022021
		/*document.querySelectorAll(".todo_item").forEach(function(element, index, array) {
		  let todo_item = element;
		  
		  element.addEventListener('contextmenu', event => {
				event.preventDefault();
				//Add contextual menu here
				new Contextual({
					isSticky: false,
					items: [
						{label: 'Détails', onClick: () => {}, shortcut: 'Ctrl+D'},
						{label: 'Mettre en cours', onClick: () => {}, shortcut: 'Ctrl+C'},
						{label: 'Mettre à terminé', onClick: () => {}, shortcut: 'Ctrl+T'},
						{type: 'seperator'},
						{label: 'Modifier', onClick: () => {alert("modifier")}, shortcut: 'Ctrl+M'},
						{label: 'Supprimer', onClick: () => {}, shortcut: 'Ctrl+S'}
					]
				});
			});
			
		});*/
		
		
		Array.from(document.getElementsByClassName("todo_item")).forEach(
			function(element, index, array) {
				
				var todo_item = element;
				var tache_id 			= todo_item.getAttribute('data-tache_id');
				var tache_numero 		= todo_item.getAttribute('data-tache_numero');
				var tache_title 		= todo_item.getAttribute('data-tache_libelle');
				var tache_statut_current= todo_item.getAttribute('data-tache_statut_current');

				var tache_new_statut = '';
				
			    todo_item.addEventListener('contextmenu', event => {
					
					event.preventDefault();
					
					//Add contextual menu here
					new Contextual({
						isSticky: false,
						items: [
							{label: 'Détails', onClick: () => {performEvent(todo_item, 'dblclick');}, icon: "fa-info", shortcut: ''},
							{
								label: 'Mettre à EN ATTENTE', 
								onClick: () => {
									
									$(todo_item).hide();//convert to jquery element by adding $(dom_element_name)
									
									$('#tasks1').append('<li class="todo_item draggable" draggable="true" data-tache_id="'+tache_id+'" data-numero="'+tache_numero+'" class="draggable">'+tache_title+'</li>');

									$.get(base_url + 'todo/changestatut/'+tache_id+'/EN ATTENTE', function(){location.href=""});
				
								},  
								icon: "fa-beer",
								shortcut: ''
							},
							{
								label: 'Mettre à EN COURS', 
								onClick: () => {
									
									$(todo_item).hide();//convert to jquery element by adding $(dom_element_name)
									
									$('#tasks2').append('<li class="todo_item draggable" draggable="true" data-tache_id="'+tache_id+'" data-numero="'+tache_numero+'" class="draggable">'+tache_title+'</li>');

									$.get(base_url + 'todo/changestatut/'+tache_id+'/EN COURS', function(){location.href=""});
				
								}, 
								icon: "fa-info", 
								shortcut: ''
							},
							{
								label: 'Mettre à TERMINÉ', 
								onClick: () => {
									
									//$.get(base_url + 'todo/changestatut/'+tache_id+'/TERMINE', function(){location.href=""});
									//alert('#tasks3');
									$.get(base_url + 'todo/changestatut/'+tache_id+'/TERMINE', function(e){
										if(e== 1){

											$(todo_item).hide();//convert to jquery element by adding $(dom_element_name)
											
											$('#tasks3').append('<li class="todo_item draggable" draggable="true" data-tache_id="'+tache_id+'" data-numero="'+tache_numero+'" class="draggable">'+tache_title+'</li>');

											location.href="";

										}else{
											notification('Veuillez téléverser les fichiers justificatifs avant de mettre le statut à TERMINE','warning');
										}
									});

				
								}, 
								icon: "fa-info", 
								shortcut: ''
							},
							{type: 'seperator'},
							// {label: 'Modifier', onClick: () => {notification("Modifier cette tâche","warning")}, icon: "edit", shortcut: ''},
							// {label: 'Supprimer', onClick: () => {notification("Supprimer cette tâche","warning")}, icon: "delete", shortcut: ''}
						]
					});
					
					
				});
				
			}
		);
		
		
		
		Array.from(document.getElementsByClassName("btnChangerStatutTache")).forEach(
			function(element, index, array) {
				
				var todo_item = element;
				var tache_id 			= todo_item.getAttribute('data-tache_id');
				var tache_numero 		= todo_item.getAttribute('data-tache_numero');
				var tache_title 		= todo_item.getAttribute('data-tache_libelle');
				var tache_statut_current= todo_item.getAttribute('data-tache_statut_current');

				var tache_new_statut = '';
				
			    todo_item.addEventListener('contextmenu', event => {
					
					event.preventDefault();
					
					//Add contextual menu here
					new Contextual({
						isSticky: false,
						items: [
							{
								label: 'Mettre à EN ATTENTE', 
								onClick: () => {
									
									$.get(base_url + 'todo/changestatut/'+tache_id+'/EN ATTENTE', function(e){location.href=""});
				
								},  
								icon: "fa-beer",
								shortcut: ''
							},
							{
								label: 'Mettre à EN COURS', 
								onClick: () => {
									
									$.get(base_url + 'todo/changestatut/'+tache_id+'/EN COURS', function(e){location.href=""});
				
								}, 
								icon: "fa-info", 
								shortcut: ''
							},
							{
								label: 'Mettre à TERMINÉ', 
								onClick: () => {
									
									$.get(base_url + 'todo/changestatut/'+tache_id+'/TERMINE', function(e){
										if(e== 1){
											location.href="";
										}else{
											notification('Veuillez téléverser les fichiers justificatifs avant de mettre le statut à TERMINE','warning');
										}
									});
				
								}, 
								icon: "fa-info", 
								shortcut: ''
							},
							{type: 'seperator'},
							// {label: 'Modifier', onClick: () => {notification("Modifier cette tâche","warning")}, icon: "edit", shortcut: ''},
							// {label: 'Supprimer', onClick: () => {notification("Supprimer cette tâche","warning")}, icon: "delete", shortcut: ''}
						]
					});
					
					
				});
				
			}
		);
		
		
		
		
		//Added on 26102020
		$('#btnChangerStatutTache').click(function(){
			
			var tache_id 			= $(this).attr('data-tache_id');
			
			new Contextual({
				isSticky: false,
				items: [
					{
						label: 'Mettre à EN ATTENTE', 
						onClick: () => {
							
							$.get(base_url + 'todo/changestatut/'+tache_id+'/EN ATTENTE', function(){location.href=""});
		
						},  
						icon: "fa-beer",
						shortcut: ''
					},
					{
						label: 'Mettre à EN COURS', 
						onClick: () => {
							
							$.get(base_url + 'todo/changestatut/'+tache_id+'/EN COURS', function(){location.href=""});
		
						}, 
						icon: "fa-info", 
						shortcut: ''
					},
					{
						label: 'Mettre à TERMINÉ', 
						onClick: () => {
							
							$.get(base_url + 'todo/changestatut/'+tache_id+'/TERMINE', function(e){
								if(e== 1){
									location.href="";
								}else{
									notification('Veuillez téléverser les fichiers justificatis avant de mettre le statut à TERMINE','warning');
								}
							});
							
						}, 
						icon: "fa-info", 
						shortcut: ''
					},
					{type: 'seperator'},
				]
			});
			
		});
		
		//Added on 26102021
		$('#btnChangerStatutTraitementCourrier').click(function(){
			
			var courrier_id 			= $(this).attr('data-courrier_id');
			
			new Contextual({
				isSticky: false,
				items: [
					{
						label: 'TRAITEMENT TERMINÉ', 
						onClick: () => {
							
							/*
							$.get(base_url + 'courrier/changestatut/'+courrier_id+'/TRAITE', function(e){
								
								location.href="";
								
							});*/

							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'courrier/setccourriertraite',
								data:{courrier_id:courrier_id},
								success: function(data){
									//alert(data);
									location.href="";
									
								},
								error: function(){
									// alert("Erreur lors de du chargement");
								}
							});
							
						}, 
						icon: "fa-info", 
						shortcut: ''
					},
					{type: 'seperator'},
				]
			});
			
		});
		
		
		//Added on 31032021
		$('#btnCreerDiligenceWithCourrier').click(function(){
			
			var courrier_id	= $(this).attr('data-courrier_id');
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'get',
				url: base_url + 'courrier/creerdiligenceaveccourrier/'+courrier_id,
				success: function(data){
					
					alert(data);
					
				},
				error: function(){
					// alert("Erreur lors de du chargement");
				}
			});
			
		});
		
		
		//	
		$('.todo_item').dblclick(function(){
			
			var tache_id  = $(this).attr('data-tache_id');
			var tache_numero  = $(this).attr('data-tache_numero');
			
			$('#dialogKrakPopup').krakPopup({
				title:"Tache N°"+tache_numero,
				url:base_url+'todo/tache_popup/'+tache_id,
				width:800,
				contentMinHeight:400,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:false,
					text:'OK',
					clickFn:function(){
						
					}
				},
				onFinish:function(){
					
					
					$('.datatable:not(".someClass")').each(function() {
			
						var oTable = $(this).dataTable({
						"bProcessing": false,
						"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
						"sPaginationType": "full_numbers",
						"language": {
							"url": base_url + "js/datatables/lang/French.json"
						},
						"lengthMenu": [[5, 5], [5, 5]],
						"bFilter" : false,   
						"bLengthChange": false,
						"order": [[ 0, "asc" ]],
						});
						
					});
					
					
					//validation du formulaire
					$('#btnSaveUser').click(function(){
						
						var tache_id 		= $('#tache_id').val();
						var user_id 		= $('#user_id').val();
						var role_id 		= $('#role_id').val();
						
						if(tache_id !='' && user_id !='' && role_id !='' ){
						
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'todo/setusertache',
								data: {user_id:user_id,tache_id:tache_id,role_id:role_id},
								success: function(user){
									
									$('#box_liste_utilisateurs_affectes').load(base_url + 'todo/getuserstache/'+tache_id, function(){
										
										//rafraichir la table datatable
										$('.datatable:not(".someClass")').each(function() {
			
											var oTable = $(this).dataTable({
											"bProcessing": false,
											"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
											"sPaginationType": "full_numbers",
											"language": {
												"url": base_url + "js/datatables/lang/French.json"
											},
											"lengthMenu": [[5, 5], [5, 5]],
											"bFilter" : false,   
											"bLengthChange": false,
											"order": [[ 2, "desc" ]],
											});
											
										});
										
										
										//actualiser la liste des utilisateurs restants
										$('#user_id').html('');
										
										$.ajax({
											headers:{'X-CSRF-TOKEN': csrf_token},
											type:'get',
											url: base_url + 'todo/get_users_restants/'+tache_id,
											success: function(users){
												
												$('#user_id').append('<option value="">Choisir</option>');
												
												// alert(users[0]);
												var n = users.length;
												if(n > 0){
													for(var i = 0; i < n ;i++){
														
														var user = users[i];
														$('#user_id').append('<option value="'+user.id+'">'+user.nom+' '+user.prenoms+'</option>');
														
													}
												}
												
												
											},
											error: function(){
												// alert("Erreur lors de du chargement");
											}
										});
										
										
									});
									
								},
								error: function(){
									notification("Erreur lors du traitement","error");
								}
							});
							
						}else{
							notification("Veuillez selectionner un utilisateur et son rôle","warning");
							
						}
						
					});
					
					
					//affichage form modif echeances
					$('#btn-prolonger').click(function(){
						$('#box_mofification_echeances_header').html('Mofification des échéances');
						$('#box_mofification_echeances').removeClass('hidden');
					});
					
					//MODIFICATION ECHEANCE
					$('#btnSaveNewDates').click(function(){
						
						var tache_id 		= $('#tache_id').val();
						var new_date_debut 	= $('#new_date_debut').val();
						var new_date_fin 	= $('#new_date_fin').val();
						var commentaire 	= $('#motif_modification_echeance').val();
						
						if(new_date_debut !='' && new_date_debut !='' && new_date_fin !='' ){
						
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'todo/updateecheance',
								data: {tache_id:tache_id,new_date_debut:new_date_debut,new_date_fin:new_date_fin,commentaire:commentaire},
								success: function(echeance){
									
									notification("Opération effectuée avec succès","success");
									
									$('#box_mofification_echeances').addClass('hidden');
									
									$('#date_debut_preview').text(echeance.tache_echeance_date_debut);
									$('#date_fin_preview').text(echeance.tache_echeance_date_fin);
									
								},
								error: function(){
									notification("Erreur lors du traitement","error");
								}
							});
							
						}else{
							notification("Veuillez renseigner le formulaire","warning");
							
						}
						
					});
					
					
				},
			});
			
			
		});
		
		//Added on 16032021
		
		$('#btnSaveUserTache').click(function(){
			
			var tache_id 		= $('#tache_id').val();
			var user_id 		= $('#user_id').val();
			var role_id 		= $('#role_id').val();
			
			
			if(tache_id !='' && user_id !='' && role_id !='' ){
			
				$.ajax({
					headers:{'X-CSRF-TOKEN': csrf_token},
					type:'post',
					url: base_url + 'todo/setusertache',
					data: {user_id:user_id,tache_id:tache_id,role_id:role_id},
					success: function(user){
						
						$('#box_liste_utilisateurs_affectes').load(base_url + 'todo/getuserstache/'+tache_id, function(){
							
							//rafraichir la table datatable
							$('.datatable:not(".someClass")').each(function() {

								var oTable = $(this).dataTable({
								"bProcessing": false,
								"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
								"sPaginationType": "full_numbers",
								"language": {
									"url": base_url + "js/datatables/lang/French.json"
								},
								"lengthMenu": [[5, 5], [5, 5]],
								"bFilter" : false,   
								"bLengthChange": false,
								"order": [[ 2, "desc" ]],
								});
								
							});
							
							
							//actualiser la liste des utilisateurs restants
							$('#user_id').html('');
							
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'get',
								url: base_url + 'todo/get_users_restants/'+tache_id,
								success: function(users){
									
									$('#user_id').append('<option value="">Choisir</option>');
									
									// alert(users[0]);
									var n = users.length;
									if(n > 0){
										for(var i = 0; i < n ;i++){
											
											var user = users[i];
											$('#user_id').append('<option value="'+user.id+'">'+user.nom+' '+user.prenoms+'</option>');
											
										}
									}
									
									
								},
								error: function(){
									// alert("Erreur lors de du chargement");
								}
							});
							
							
						});
						
					},
					error: function(){
						notification("Erreur lors du traitement","error");
					}
				});
				
			}else{
				notification("Veuillez selectionner un utilisateur et son rôle","warning");
				
			}
			
		});
					
		
		//btnSupprimerUserTache
		$('.btnSupprimerUserTache').click(function(){
			
			var user_tache_id = $(this).attr('data-user_tache_id');
			
			if(user_tache_id !=''){
			
				$.ajax({
					headers:{'X-CSRF-TOKEN': csrf_token},
					type:'post',
					url: base_url + 'todo/supprusertache',
					data: {user_tache_id:user_tache_id},
					success: function(user){
						
						location.href = "";
						
						$('#box_liste_utilisateurs_affectes').load(base_url + 'todo/getuserstache/'+tache_id, function(){
							
							//rafraichir la table datatable
							$('.datatable:not(".someClass")').each(function() {

								var oTable = $(this).dataTable({
								"bProcessing": false,
								"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
								"sPaginationType": "full_numbers",
								"language": {
									"url": base_url + "js/datatables/lang/French.json"
								},
								"lengthMenu": [[5, 5], [5, 5]],
								"bFilter" : false,   
								"bLengthChange": false,
								"order": [[ 2, "desc" ]],
								});
								
							});
							
						});
						
					},
					error: function(){
						notification("Erreur lors du traitement","error");
					}
				});
				
			}else{
				notification("Veuillez selectionner un utilisateur et son rôle","warning");
				
			}
			
		});
					
				
		
		
		//Added on 27042021::partager un courrier avec ses collaborateurs
		$('#btnPartagerCourrier').click(function(){
			
			var courrier_id  = $(this).attr('data-courrier_id');
			var courrier_numero  = $(this).attr('data-courrier_numero');
			
			$('#dialogKrakPopup').krakPopup({
				title:"Partage du courrier N°"+courrier_id,
				url:base_url+'courrier/partage_courrier/'+courrier_id,
				width:500,
				contentMinHeight:350,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:true,
					text:'Partager',
					clickFn:function(){
						
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'courrier/partage_courrier',
							data: $('#form_partage_courrier').serialize(),
							success: function(e){
								
								if(e==1){

									notification('Partage effectuée avec succès','success');

								}else if(e==2){

									notification('Veuillez cocher au moins un utilisateur','warning');

								}else{

									notification('Erreur lors du partage','warning');
									
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});

					}
				},
				onFinish:function(){
					
					$('.datatable:not(".someClass")').each(function() {
			
						var oTable = $(this).dataTable({
						"bProcessing": false,
						"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
						"sPaginationType": "full_numbers",
						"language": {
							"url": base_url + "js/datatables/lang/French.json"
						},
						"lengthMenu": [[20, 20], [20, 20]],
						"bFilter" : false,   
						"bLengthChange": false,
						"order": [[ 0, "asc" ]],
						});
						
					});
					
					
					
				},
			});
			
			
		});
		
		
		//Added on 27042021::partager un courrier avec ses collaborateurs
		$('#btnPartagerPlusieursCourriers').click(function(){
			
			var n = 0, tab_selected_courriers_ids = '';
			$('.checkbox_courrier_partage').each(function(){

				if($(this).is(":checked")){
	                tab_selected_courriers_ids = tab_selected_courriers_ids+$(this).attr('data-courrier_id')+',';
	                n = n+1;
	            }

			});

			if(n>0){

			$('#dialogKrakPopup').krakPopup({
				title:"Partage des courriers sélectionnés",
				url:base_url+'courrier/partage_courriers_multiple?n='+n+'&ids='+tab_selected_courriers_ids,
				width:500,
				contentMinHeight:350,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:true,
					text:'Partager les courriers',
					clickFn:function(){
						
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'courrier/partage_courriers_multiple',
							data: $('#form_partage_courriers_multiple').serialize(),
							success: function(e){
								
								if(e==1){

									notification('Partage effectuée avec succès','success');

								}else if(e==2){

									notification('Veuillez cocher au moins un utilisateur','warning');

								}else{

									notification('Erreur lors du partage','warning');
									
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});

					}
				},
				onFinish:function(){
					
					$('.datatable:not(".someClass")').each(function() {
			
						var oTable = $(this).dataTable({
						"bProcessing": false,
						"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
						"sPaginationType": "full_numbers",
						"language": {
							"url": base_url + "js/datatables/lang/French.json"
						},
						"lengthMenu": [[20, 20], [20, 20]],
						"bFilter" : false,   
						"bLengthChange": false,
						"order": [[ 0, "asc" ]],
						});
						
					});
					
					
					
				},
			});
			
			}else {
				notification('Veuillez cocher au moins un courrier','warning')
			}

		});
		
		
		
		
		//Added on 22042021
		$('#btnSendCommentaire').click(function(){
			
			var courrier_id	= $("#courrier_id").val();
			var message		= $('#status_message').val();

		  	SendCommentaire(courrier_id, message);
			
		});

		$("#status_message").on("keydown", function(e){
		  if(e.which == 13){

		  	//alert();
		  	var courrier_id	= $("#courrier_id").val();
			var message		= $('#status_message').val();

		  	SendCommentaire(courrier_id, message);

		    // your code
		    return false;


		  }
		});
		
		function SendCommentaire(courrier_id, message){
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'post',
				data:{courrier_id:courrier_id, message:message},
				url: base_url + 'courrier/savecommentaire',
				success: function(data){
					
					$('#status_message').val('');

					$('#chat_messages_list').load(base_url + 'courrier/commentaires/'+courrier_id);
					
				},
				error: function(){
					// alert("Erreur lors de du chargement");
				}
			});

		}
		/////
		
		
		
		$('.datatable:not(".someClass")').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
			"bFilter" : true,   
			"bLengthChange": true,
			"order": [[ 1, "desc" ]],
			});
			
		});
		
		
		$('#table_courriers').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[25, 50, 100, 500, 1000], [25, 50, 100, 500, 1000]],
			"bFilter" : true,   
			"bLengthChange": true,
			"order": [[ 1, "desc" ]],
			});
			
		});
		
		$('#table_taches').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
			"bFilter" : true,   
			"bLengthChange": true,
			"order": [[ 0, "desc" ]],
			});
			
		});
		
		
		$('#table_pointage_arrivee').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[100, 200], [100, 200]],
			"bFilter" : true,   
			"bLengthChange": true,
			"order": [[ 2, "asc" ]],
			});
			
		});
		
		
		$('#etablissements').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"bPaginate": false,
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[100, 500, 1000], [100, 500, 1000]],
			"bFilter" : true,   
			"bLengthChange": false,
			"order": [[ 0, "desc" ]],
			});
			
		});
		
		
		$('#equipes').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[10], [10]],
			"bFilter" : true,   
			"bLengthChange": false,
			"order": [[ 4, "desc" ]],
			});
			
		});
		
		
		$('#statistiques').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[20], [20]],
			"bFilter" : false,   
			"bLengthChange": false,
			"order": [[ 2, "desc" ]],
			});
			
		});

		$('#live_data').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"paging":   false,
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[20], [20]],
			"bFilter" : false,   
			"bLengthChange": false,
			"order": [[ 0, "desc" ]],
			});
			
		});

	  	

		$('#tableLieuxAutorises').dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[5,10,20], [5,10,20]],
			"order": [[ 0, "asc" ]],
			"bFilter" : true,               
			"bLengthChange": true
		});
	  
	  
		
		
	  //Appliquer les masques de saisie
		// $('.telephone').mask('99 99 99 99');
		
		$('select').select2({
			placeholder: "Choisir",
			allowClear: true
		}); 
	 
		
		
		
		//Changement de bureau
		$('#bureau_id').change(function(){
			
			var bureau_id = $(this).val();
			$('#percepteur_id').html('');
			
			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'get',
				url: base_url + 'perception/percepteurs_data/'+bureau_id,
				success: function(users){
					
					$('#percepteur_id').append('<option value=""></option>');
					
					var n = users.length;
					if(n > 0){
						for(var i = 0; i < n ;i++){
							
							var user = users[i];
							$('#percepteur_id').append('<option value="'+user.id+'">'+user.nom+' '+user.prenoms+'</option>');
							
						}
					}
					
					
				},
				error: function(){
					// alert("Erreur lors de du chargement");
				}
			});
			
			
			
		});
		
		
		
		
		$('#nature_piece').change(function(){
			
			if($(this).val() == 'AUTRE'){
				
				$('#numero_piece').removeAttr('required');
				$('#required_numero_piece').html('&nbsp;');
			}else{
				$('#numero_piece').attr('required',true);
				$('#required_numero_piece').html('*');
			}
			
		});
		
		
		
		$('#crtlBoxRecherche').click(function(){
			$('#boxRecherche').toggle();
		});
		
	  
		$('#checkbox_option_modifier_motdepasse').click(function(){
			if($('#checkbox_option_modifier_motdepasse').is(':checked')){
				$('#box_motdepasse').fadeIn();
			}else{
				$('#box_motdepasse').fadeOut();
			}
			
		});
		
		
		
		//Pointage 
		$('.btnSaveHeureArrivee').click(function(){
			
			var ceBouton = $(this);
			
			var pointage_id 	= $(this).attr('data-pointage_id');
			var user_id 		= $(this).attr('data-user_id');
			var heure_arrivee 	= $('#heure_arrivee_'+user_id).val();
			
			var type = 'arrivee';
			
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text: "Confirmation (Arrivée:"+heure_arrivee+') ?',
				type: "warning",
				buttons: [{addClass: 'btn btn-success ', text: 'Valider', onClick: function($noty) {
				   $noty.close();
						
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + '/pointeuse/pointage',
							data: {type:type, user_id:user_id, pointage_id:pointage_id, heure_arrivee:heure_arrivee},
							success: function(e){
								
								if(e == 1){
									
									ceBouton.hide();
									$('#heure_arrivee_'+user_id).attr('readonly','true').addClass('heure_verouillee');
									
								}else{
									
									notification("Erreur lors de l'enregistrement","error");
									
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});
						
				
					
				   }},
				   {addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
						$noty.close();
					
				   
				   }}]
			});
			
		});
		
		
		//Pointage 
		$('.btnSaveHeureDepart').click(function(){
			
			var ceBouton = $(this);
			var pointage_id 	= $(this).attr('data-pointage_id');
			var user_id 		= $(this).attr('data-user_id');
			var heure_depart 	= $('#heure_depart_'+user_id).val();
			
			var type = 'depart';
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text: 'Confirmation (Départ:'+heure_depart+') ?',
				type: "warning",
				buttons: [{addClass: 'btn btn-success ', text: 'Valider', onClick: function($noty) {
				   $noty.close();
						
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'pointeuse/pointage',
							data: {type:type, user_id:user_id, pointage_id:pointage_id, heure_depart:heure_depart},
							success: function(e){
								
								if(e == 1){
									
									ceBouton.hide();
									
									$('#heure_depart_'+user_id).attr('readonly','true').addClass('heure_verouillee');
									
								}else{
									
									notification("Erreur lors de l'enregistrement","error");
									
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});
						
				
					
				   }},
				   {addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
						$noty.close();
					
				   
				   }}]
			});
			
		});
		
	
		
		
		
		//Added on 26102020
		$('.btnSetAbsent').click(function(){
			
			var ceBouton = $(this);
			var user_id  = $(this).attr('data-user_id');
			
			$('#dialogKrakPopup').krakPopup({
				title:"Enregistrer une absence",
				url:base_url+'pointeuse/traiterabsence/'+user_id,
				width:500,
				contentMinHeight:200,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:false,
					text:'OK',
					clickFn:function(){
						
					}
				},
				onFinish:function(){
					
					//validation du formulaire
					$('#btnSaveAbsence').click(function(){
						
						var btnSaveAbsence = $(this);
						var user_id 		= $('#user_id').val();
						var type_absence 	= $('#type_absence').val();
						var motif_absence 	= $('#motif_absence').val();
						
						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'pointeuse/setabsent',
							data: {user_id:user_id,type_absence:type_absence,motif_absence:motif_absence},
							success: function(e){
								
								if(e == 1){
									
									btnSaveAbsence.hide();
									$('#infoBox').html('<div class="alert alert-success">ENREGISTREMENT EFFECTUÉE AVEC SUCCÈS</div>');
									ceBouton.removeClass('btnSetAbsent').html('<span class="label label-danger"><i class="fa fa-check-circle"></i> ABSENT CONFIRMÉ</span>');
									
								}else{
									
									notification("Erreur lors de l'enregistrement","error");
									
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});
						
					});
					
					
					
				},
			});
			
			
		});
		
	  
		//Added on 11032021
		$('#btnTraiterCourier').click(function(){
			
			var ceBouton = $(this);
			var courrier_id  = $(this).attr('data-courrier_id');
			
			$('#dialogKrakPopup').krakPopup({
				title:"Traitement d'un courrier imputé",
				url:base_url+'courrier/traitercourrier/'+courrier_id,
				width:850,
				contentMinHeight:450,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:false,
					text:'OK',
					clickFn:function(){
						
					}
				},
				onFinish:function(){
					
					//validation du formulaire
					
					
					
				},
			});
			
			
		});
		
	  
	  

		//AUTORISATIONS ET ACTIONS

		//btnSupprimerAction
		$('.btnSupprimerAction').click(function(){
			
			var action_id = $(this).attr('data-action_id');
			
			if(action_id !=''){
			
				$.ajax({
					headers:{'X-CSRF-TOKEN': csrf_token},
					type:'post',
					url: base_url + 'parametres/supprimer_action',
					data: {action_id:action_id},
					success: function(data){
						
						if(data == 1){
							location.href = "";
						}else{
							notification('Erreur lors de la suppression',"warning");
						}
						
					},
					error: function(){
						notification("Erreur lors du traitement","error");
					}
				});
				
			}else{
				notification("Veuillez selectionner une ligne","warning");
				
			}
			
		});
					
				
		//Added on 31032021
		$('.btn_toogle_autorisation').click(function(a){
			
			var autorisation_id	= $(this).attr('data-autorisation_id');
			

			$.ajax({
				headers:{'X-CSRF-TOKEN': csrf_token},
				type:'post',
				data:{autorisation_id:autorisation_id},
				url: base_url + 'parametres/toogle_autorisation',
				success: function(data){
					
					//location.href = '';

					//alert(data);
					
				},
				error: function(){
					// alert("Erreur lors de du chargement");
				}
			});
			
		});

		//



	  
		//NOTY
		function notification(text,type,callback){
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:text,
				type: type,
				buttons: [{addClass: 'btn btn-information ', text: 'OK', onClick: function($noty) {
				   $noty.close();
				  
				   }}]
			});
		}

		
		$('.telephone').mask('date');





	});
}(window.jQuery);