var site_url = "https://ethsun-institute.org/";
						
function getXMLHttpRequest(){
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}

function setCookie(name,value,days){
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}
 
 
 
function cookiesAccept(){	
	setCookie('mentorilib_okay_with_cookie_terms', 'Accept all Cookies',30);
}


function starExam(div, exam_id, test_id){
	var xhr = getXMLHttpRequest();	
	$(div).html('<span class="loader loader_large ptb10"></span>');
	var sec = 1;
						xhr.onreadystatechange = function(){
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
								window.location.href = site_url+'exam/'+exam_id;
							}
						}; 
						
						xhr.open("POST", site_url+"ajax/submit_chrono.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("test_id="+test_id+"&sec="+sec+"&id="+exam_id); 	
}



 function saveTestQcm(div, test_id, exam_id){
	var xhr = getXMLHttpRequest();
	
	$(div).html('<span class="loader loader_small ptb10"></span>');
	 var num_q = parseInt($("#nume_q_"+test_id).val());
		//alert('NOMBRE Q = '+num_q+' | TEST = '+test_id+ ' | EXAM = '+exam_id);
	
		var variables = '';
	
		for (i = 1; i <= num_q; i++){		
			let id_q = $("input[name='radio_q_"+test_id+"_"+i+"']").attr('data-question');
			let r =  $("input[name='radio_q_"+test_id+"_"+i+"']:checked").val();
							
			if(variables == '')
				variables = id_q+'|'+r;
			else
				variables += '©'+id_q+'|'+r;
		 
		}
			//alert(variables);
				if(variables != ''){											
						xhr.onreadystatechange = function(){
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						 if(response == 0){
								swal({
									type: 'success',
									title: 'Opération éffectuée avec succès.',
									html: ''
								  });								
							window.location.reload();	 
						 } else if(response == 3){
								swal({
									type: 'success',
									title: 'Félicitation, vous avez terminé l\'examen.',
									html: ''
								  });								
							window.location.href = site_url+'dashboard';
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner le code d\'accès.',
									html: 'Veuillez renseigner le code d\'accès.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<span class="fa fa-save"></span> Enregistrer');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/saveTest.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("variables="+variables+"&test_id="+test_id+"&exam_id="+exam_id); 
				} else{					
					$(div).html('<span class="fa fa-save"></span> Enregistrer');					
					 alert('Veuillez renseigner tous les champs.');
				}
    }




function saveTest(div, test_id, exam_id){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<span class="loader loader_small ptb10"></span>');
	 var num_q = parseInt($("#nume_q_"+test_id).val());
		//alert('NOMBRE Q = '+num_q+' | TEST = '+test_id+ ' | EXAM = '+exam_id);
	
	var variables = '';
	
	for (i = 1; i <= num_q; i++){		
		let id_q = $('#textarea_q_'+test_id+'_'+i).attr('data-question');
		let r = $('#textarea_q_'+test_id+'_'+i).val();
			
		if(variables == '')
			variables = id_q+'|'+r;
		else
			variables += '©'+id_q+'|'+r;
	 
	}
	//alert(variables);
	 
				if(variables != ''){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Opération éffectuée avec succès.',
									html: ''
								  });
								
								window.location.reload();
	 
						 }else if(response == 3){
								swal({
									type: 'success',
									title: 'Félicitation, vous avez terminé l\'examen.',
									html: ''
								  });
								
								window.location.href = site_url+'dashboard';
						 }else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner le code d\'accès.',
									html: 'Veuillez renseigner le code d\'accès.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<span class="fa fa-save"></span> Enregistrer');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/saveTest.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("variables="+variables+"&test_id="+test_id+"&exam_id="+exam_id); 
				} else{					
					$(div).html('<span class="fa fa-save"></span> Enregistrer');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}
















function goIntoGroup(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<span class="loader loader_small ptb10"></span>');
	 var code = $("#code_key_field").val();
	 
					if((code != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Opération éffectuée avec succès.',
									html: ''
								  });
								
								window.location.reload();
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner le code d\'accès.',
									html: 'Veuillez renseigner le code d\'accès.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Code non valide.',
									html: 'Code non valide.'
								   })
							else if(response == 4)
								swal({
									type: 'error',
									title: 'Vous faite deja parti de ce groupe.',
									html: 'Vous faite deja parti de ce groupe.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html(' &nbsp; &nbsp; Intégrer le groupe  &nbsp; &nbsp; ');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/goIntoGroup.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("code="+code); 
				} else{					
					$(div).html(' &nbsp; &nbsp; Intégrer le groupe  &nbsp; &nbsp; ');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}








function submitSeminaire(){
	var xhr = getXMLHttpRequest();	
	
	$("#btn_subscribe_seminaire").html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 var atelier = $("#atelier_formation").val();
	 var titre = $("#title_form").val();
	 var nom = $("#nom_prenom_form").val();
	 var email = $("#email_form").val();
	 var cel = $("#contact_form").val();
	 var fonction = $("#fonction_form").val();
	 var company = $("#company_form").val();
	 var paiement = $("#devis_paiment_form").val();
	 var msg = $("#message_form").val();
	 
					if((company != '') && (nom != '') && (email != '') && (atelier != '') && (cel != '') && (fonction != '') && (paiement != '') && (msg != '') && (titre != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Merci pour votre confiance ! Nous avons bien reçu votre inscription. Nous Vous contacterons dans les meilleurs délais.',
									html: ''
								  })	
									
										 titre = $("#title_form").val("");
										 nom = $("#nom_prenom_form").val("");
										 email = $("#email_form").val("");
										 cel = $("#contact_form").val("");
										 fonction = $("#fonction_form").val("");
										 company = $("#company_form").val("");
										 paiement = $("#devis_paiment_form").val("");
										 msg = $("#message_form").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$("#btn_subscribe_seminaire").html('ENVOYER');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitSeminaire.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&company="+company+"&nom="+nom+"&cel="+cel+"&atelier="+atelier+"&fonction="+fonction+"&paiement="+paiement+"&msg="+msg+"&titre="+titre); 
				} else{					
					$("#btn_subscribe_seminaire").html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}









function submitAtelier(){
	var xhr = getXMLHttpRequest();	
	
	$("#btn_subscribe_atelier").html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 var atelier = $("#atelier_formation").val();
	 var titre = $("#title_form").val();
	 var nom = $("#nom_prenom_form").val();
	 var email = $("#email_form").val();
	 var cel = $("#contact_form").val();
	 var fonction = $("#fonction_form").val();
	 var company = $("#company_form").val();
	 var paiement = $("#devis_paiment_form").val();
	 var msg = $("#message_form").val();
	 
					if((company != '') && (nom != '') && (email != '') && (atelier != '') && (cel != '') && (fonction != '') && (paiement != '') && (msg != '') && (titre != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Merci pour votre confiance ! Nous avons bien reçu votre inscription. Nous Vous contacterons dans les meilleurs délais.',
									html: ''
								  })	
									
										 titre = $("#title_form").val("");
										 nom = $("#nom_prenom_form").val("");
										 email = $("#email_form").val("");
										 cel = $("#contact_form").val("");
										 fonction = $("#fonction_form").val("");
										 company = $("#company_form").val("");
										 paiement = $("#devis_paiment_form").val("");
										 msg = $("#message_form").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$("#btn_subscribe_atelier").html('ENVOYER');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitAtelier.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&company="+company+"&nom="+nom+"&cel="+cel+"&atelier="+atelier+"&fonction="+fonction+"&paiement="+paiement+"&msg="+msg+"&titre="+titre); 
				} else{					
					$("#btn_subscribe_atelier").html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}



function pleaseWait(){
	
	swal({
		title: "EN ATTENTE D\'ACTIVATION",
		text: "<p style='font-size:20px;'>Retrouvez votre cours dans votre espace personnel en <b>48 heures ouvrées</b>.</p>\
		<p style='font-size:12px;'><a href='"+site_url+"contact'>Contactez-nous!</a></p>",
		html: true,
		type: 'warning'
	})	
}


function deleteQuestion(id){
		
		var xhr = getXMLHttpRequest();	
		swal({
			title: "SUPPRIMER UNE QUESTION",
			text: "<p style='font-size:16px;'>Voulez-vous réellement supprimer cette question ?</p>",
			showCancelButton: true,
			html: true,
			confirmButtonColor: "#13cf13",
			confirmButtonText: "SUPPRIMER",
			cancelButtonText: "ANNULER",
			cancelButtonColor:"#e64e02",
			closeOnConfirm: true,
			closeOnCancel: true
		},
					function(isConfirm){
					  if(isConfirm){
						  
							xhr.onreadystatechange = function(){
									if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
										//document.getElementById("sortie_delete").innerHTML = xhr.responseText;
										$("#ligne_q_"+id).slideToggle();
									}
							};
							
							xhr.open("POST", site_url+"ajax/deleteQuestion.php", true);
							xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhr.send("id="+id);
								
					  } else{
						// swal("Cancelled", "Your imaginary file is safe :)", "error");
					  }
			});	
}


function readCourse(id, div){
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	var xhr = getXMLHttpRequest();		
 
						xhr.onreadystatechange = function(){
						 if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
							//alert(response);
							//window.location.href = response;
							
							$(div).html('<i class="fa fa-book"></i> LIRE LE COURS');
							
							var win = window.open(response, '_blank');
							win.focus();
							
								
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/loadCourseUrl.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("id="+id); 	
}



function switchIcon(id){
	
	$('.ic_icones').html("+");
	
	if($('#pan_head_'+id).hasClass('collapsed'))
		$("#ic_icone_"+id).html('-');
	else
		$("#ic_icone_"+id).html('+');	
}



function download_doc(doc, formation){			
		var xhr = getXMLHttpRequest();		
		var nom = '';
		var num = '';
		
		$("#format_ion").val(formation);
		$("#formation_download").val(formation);
		$("#doc_download").val(doc);	
			
}


function setLanguage(lang){
					//alert(lang);
				
					var data = {language: lang}; 					
						$.ajax({ 
							type: 'POST',
							url: site_url+'ajax/addSessionLanguage.php', 
							data: data, 
							dataType: 'json', 
							timeout: 3000,
							success: function(data){	
							   window.location.reload();
							},
							error: function() {
							}
						});	
	
}

function buycourse(id){
		
		var xhr = getXMLHttpRequest();	
		swal({
			title: "ACHETER CETTE FORMATION",
			text: "<p style='font-size:16px;'>Voulez-vous réellement acheter cette formation ?</p>",
			showCancelButton: true,
			html: true,
			confirmButtonColor: "#13cf13",
			confirmButtonText: "ACHETER",
			cancelButtonText: "ANNULER",
			cancelButtonColor:"#e64e02",
			closeOnConfirm: true,
			closeOnCancel: true
		},
					function(isConfirm){
					  if(isConfirm){
						  
						xhr.onreadystatechange = function(){
						 if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
													
									
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Achat éffecté avec succès.',
									html: ''
								  })	
	 
						 } else if(response == 2)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 1)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
								   
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/buycourse.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("id="+id); 
						
												
					  } else{
						// swal("Cancelled", "Your imaginary file is safe :)", "error");
					  }
					});	
}



function submitDownload(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 var nom = $("#nom_prenom_download").val();
	 var company = $("#company_download").val();
	 var cel = $("#cel_download").val();
	 var email = $("#email_download").val();
	 var formation = $("#formation_download").val();
	 var doc = $("#doc_download").val();
	 
	 
					if((company != '') && (nom != '') && (email != '') && (formation != '') && (cel != '') && (doc != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								/* swal({
									type: 'success',
									title: 'Document téléchargé avec succès. Nous vous l\'avons envoyé par mail à l\' adresse email renseignée.',
									html: ''
								  }); */
								$("#donwload_ressources").modal('hide');
								$('#myModal_recieved_ok').modal('show');									
								$("#nom_prenom_download").val("");
								$("#company_download").val("");
								$("#cel_download").val("");
								$("#email_download").val("");
								$("#formation_download").val("");
								$("#doc_download").val("");
								
								$("#snackbar").fadeOut();
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<i class="fa fa-download"></i> Télécharger');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submit_download.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&company="+company+"&nom="+nom+"&cel="+cel+"&formation="+formation+"&doc="+doc); 
				} else{					
					$(div).html('<i class="fa fa-download"></i> Télécharger');					
					 alert('Veuillez renseigner tous les champs.');
				}
}



function submitContact(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 var titre = $("#devis_title").val();
	 var nom = $("#devis_nom").val();
	 var email = $("#devis_email").val();
	 var cel = $("#devis_telephone").val();
	 var objet = $("#devis_objet").val();
	 var msg = $("#devis_msg").val();	 
	 
					if((titre != '') && (nom != '') && (email != '') && (objet != '') && (cel != '') && (msg != '')){											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Votre message nous a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.',
									html: ''
								  })
								  	 
										$("#devis_title").val("");
										$("#devis_nom").val("");
										$("#devis_email").val("");
										$("#devis_telephone").val("");
										$("#devis_objet").val("");
										$("#devis_msg").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitContact.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&titre="+titre+"&nom="+nom+"&cel="+cel+"&objet="+objet+"&msg="+msg); 
				} else{					
					$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');					
					 alert('Veuillez renseigner tous les champs.');
				}
}





function submitNewInstructor(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_small ptb10"></div> </center>');
	 var name = $("#instructor_name").val();
	 var phone = $("#instructor_phone").val();
	 var email = $("#instructor_email").val();
	 
					if((email != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Opération éffectuée avec succès.',
									html: ''
								  })
								  	 	 $("#instructor_name").val("");
										 $("#instructor_phone").val("");
										 $("#instructor_email").val("");
										 
							
							$('#form_send_new_instructor').unbind('submit').submit();
								
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitNewInstructor.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&name="+name+"&phone="+phone); 
				} else{					
					$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}




function submitNewsletter_modal_mobile(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<span style="margin-left:8px; margin-right:8px;" class="loader loader_medium ptb10"></span>');
	 var email = $("#email_newsletter_modal_mobile").val();
	 
					if((email != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Email enregistré avec succès',
									html: ''
								  });
								  
								document.cookie = "isThisPCAllreadyRegisteredNewsleteter=YesItHasBeenRegistered; expires=Fri, 19 Jun 2020 20:47:11 UTC";
								
								  	 
								$("#email_newsletter_modal_mobile").val("");
								$('#myModal_recieved').modal('hide');								
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner votre adresse email.',
									html: 'Veuillez renseigner votre adresse email.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html(' &nbsp; &nbsp; Envoyer  &nbsp; &nbsp; ');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitNewsletter_modal.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email); 
				} else{					
					$(div).html(' &nbsp; &nbsp; Envoyer  &nbsp; &nbsp; ');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}



function submitNewsletter_modal(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<span style="margin-left:8px; margin-right:8px;" class="loader loader_medium ptb10"></span>');
	 var email = $("#email_newsletter_modal").val();
	 
					if((email != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Email enregistré avec succès',
									html: ''
								  });
								  
								document.cookie = "isThisPCAllreadyRegisteredNewsleteter=YesItHasBeenRegistered; expires=Fri, 19 Jun 2020 20:47:11 UTC";
								
								  	 
								$("#email_newsletter_modal").val("");
								$('#myModal_recieved').modal('hide');								
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner votre adresse email.',
									html: 'Veuillez renseigner votre adresse email.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html(' &nbsp; &nbsp; Envoyer  &nbsp; &nbsp; ');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitNewsletter_modal.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email); 
				} else{					
					$(div).html(' &nbsp; &nbsp; Envoyer  &nbsp; &nbsp; ');					
					 alert('Veuillez renseigner tous les champs.');
				}	
}





function submitNewsletter(div){

	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 var titre = $("#title_newsletter").val();
	 var nom = $("#nom_newsletter").val();
	 var email = $("#email_newsletter").val();
	 
					if((email != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Email enregistré avec succès',
									html: ''
								  })
								  	 
								$("#email_newsletter").val("");
								
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
							
							$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitNewsletter.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("email="+email+"&titre="+titre+"&nom="+nom); 
				} else{					
					$(div).html('<i class="fa fa-long-arrow-right"></i> Envoyer');					
					 alert('Veuillez renseigner tous les champs.');
				}
	
}







function submitTraining(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	 var devis_title = $("#devis_title").val();
	 var devis_nom  = $("#devis_nom").val();
	 var devis_ville = $("#devis_ville").val();
	 var devis_pays = $("#devis_pays").val();
	 var devis_email = $("#devis_email").val();
	 var devis_fonction  = $("#devis_fonction").val();
	 var devis_company = $("#devis_company").val();
	 var devis_telephone = $("#devis_telephone").val();
	 var devis_formations = $("#devis_formations").val();
	 var devis_nombre = $("#devis_nombre").val();
	 var devis_lang  = $("#devis_lang").val();
	 var devis_msg  = $("#devis_msg").val();
	 var devis_paiment = $("#devis_paiment").val();
	 
	 
					if((devis_title != '') && (devis_nom != '') && (devis_ville != '') && (devis_pays != '') && (devis_email != '')   && (devis_fonction  != '') && (devis_company  != '') && (devis_telephone  != '') && (devis_formations  != '') && (devis_nombre  != '') && (devis_lang  != '') && (devis_msg  != '') && (devis_paiment  != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'votre inscription à bien été enregistrée nous vous contacterons dans les meilleurs délais.',
									html: ''
								  })
								  	 
								$("#devis_title").val("");
								$("#devis_nom").val("");
								$("#devis_ville").val("");
								$("#devis_pays").val("");
								$("#devis_email").val("");
								$("#devis_fonction").val("");
								$("#devis_company").val("");
								$("#devis_telephone").val("");
								$("#devis_formations").val("");
								$("#devis_nombre").val("");
								$("#devis_lang").val("");
								$("#devis_msg").val("");
								$("#devis_paiment").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
								   
							
							$(div).html('ENVOYER');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitTraining.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment); 
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}





function submitChristmas(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	  
	 var formation = $("#atelier_formation").val();	 
	 var title = $("#title_form").val();
	 var name  = $("#nom_prenom_form").val();
	 var email = $("#email_form").val();
	 var cel = $("#contact_form").val();	 
	 var fonction = $("#fonction_form").val();
	 var company  = $("#company_form").val();	 
	 var paiement = $("#devis_paiment_form").val();
	 var message = $("#message_form").val();
	 
	 
					if((formation != '') && (title != '') && (name != '') && (email  != '') && (cel  != '') && (fonction  != '') && (company  != '') && (paiement  != '') && (message  != '') ){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								/* swal({
									type: 'success',
									title: '',
									html: 'Votre inscription à bien été enregistrée nous vous contacterons dans les meilleurs délais.'
								  })*/
								 
							/* $("#atelier_formation").val("");	 
							 $("#title_form").val("");
							 $("#nom_prenom_form").val("");
							 $("#email_form").val("");
							 $("#contact_form").val("");	 
							 $("#fonction_form").val("");
							 $("#company_form").val("");	 
							 $("#devis_paiment_form").val("");
							 $("#message_form").val("");*/
								
							$('#submit_subscribe_merry_christmas').unbind('submit').submit();
							
	 
						 } else if(response == 1){
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else if(response == 2){
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else if(response == 3){
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else{
								alert(response);
								/*swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })*/
							
							  $(div).html('ENVOYER');	
							}
							
							
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitChristmas.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("formation="+formation+"&title="+title+"&name="+name+"&email="+email+"&cel="+cel+"&fonction="+fonction+"&company="+company+"&paiement="+paiement+"&message="+message);
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}











function submitBlended(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	 var devis_title = $("#devis_title").val();
	 var devis_nom  = $("#devis_nom").val();
	 var devis_ville = $("#devis_ville").val();
	 var devis_pays = $("#devis_pays").val();
	 var devis_email = $("#devis_email").val();
	 var devis_fonction  = $("#devis_fonction").val();
	 var devis_company = $("#devis_company").val();
	 var devis_telephone = $("#devis_telephone").val();
	 var devis_formations = $("#devis_formations").val();
	 var devis_nombre = $("#devis_nombre").val();
	 var devis_lang  = $("#devis_lang").val();
	 var devis_msg  = $("#devis_msg").val();
	 var devis_paiment = $("#devis_paiment").val();
	 
	 
					if((devis_title != '') && (devis_nom != '') && (devis_ville != '') && (devis_pays != '') && (devis_email != '')   && (devis_fonction  != '') && (devis_company  != '') && (devis_telephone  != '') && (devis_formations  != '') && (devis_nombre  != '') && (devis_lang  != '') && (devis_msg  != '') && (devis_paiment  != '')){
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								/* swal({
									type: 'success',
									title: 'votre inscription à bien été enregistrée nous vous contacterons dans les meilleurs délais.',
									html: ''
								  })
								  
								  */
								  	 
								/* $("#devis_title").val("");
								$("#devis_nom").val("");
								$("#devis_ville").val("");
								$("#devis_pays").val("");
								$("#devis_email").val("");
								$("#devis_fonction").val("");
								$("#devis_company").val("");
								$("#devis_telephone").val("");
								$("#devis_formations").val("");
								$("#devis_nombre").val("");
								$("#devis_lang").val("");
								$("#devis_msg").val("");
								$("#devis_paiment").val(""); */
								
								$('#form_send_blended').unbind('submit').submit();
								
	 
						 } else if(response == 1){
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else if(response == 2){
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else if(response == 3){
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							
							  $(div).html('ENVOYER');	
							}
							else{
								alert(response);
								/*swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })*/
							
							  $(div).html('ENVOYER');	
							}
							
							
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitBlended.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment); 
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}


function deleteAlert(id){
	
		var xhr = getXMLHttpRequest();	
		swal({
			title: "CETTE ACTION EST IRREVERSIBLE",
			text: "<p style='font-size:16px;'>Voulez-vous réellement supprimer cette alerte ?</p>",
			showCancelButton: true,
			html: true,
			confirmButtonColor: "#13cf13",
			confirmButtonText: "SUPPRIMER",
			cancelButtonText: "ANNULER",
			cancelButtonColor:"#e64e02",
			closeOnConfirm: true,
			closeOnCancel: true
		},
					function(isConfirm){
					  if(isConfirm){
						  
						xhr.onreadystatechange = function(){
						 if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							$("#line_alerte_"+id).fadeOut();
							
								swal({
									type: 'success',
									title: 'Alerte supprimée avec success.',
									html: ''
								  })
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/deleteAlert.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("id="+id); 
						
												
					  } else{
						// swal("Cancelled", "Your imaginary file is safe :)", "error");
					  }
					});	
}


function submitAlert(div){
		
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	
	var alerte = $("#editFiliere").val();
	
			if(alerte != ''){		
								
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						 if(response == 'nada')
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 'vide')
								swal({
									type: 'error',
									title: 'Veuillez sélectionner un domaine d\'étude.',
									html: 'Veuillez sélectionner un domaine d\'étude.'
								   })
							else{
							  
							  window.location.reload();
	 
							}
								   
							
							$(div).html('Ajouter');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitAlert.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("alerte="+alerte); 
		
			} else{					
				$(div).html('Ajouter');					
				alert('Veuillez renseigner tous les champs.');
			}
	
}







function submitDevisBusiness(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	 var devis_title = $("#devis_title").val();
	 var devis_nom  = $("#devis_nom").val();
	 var devis_ville = $("#devis_ville").val();
	 var devis_pays = $("#devis_pays").val();
	 var devis_email = $("#devis_email").val();
	 var devis_fonction  = $("#devis_fonction").val();
	 var devis_company = $("#devis_company").val();
	 var devis_telephone = $("#devis_telephone").val();
	 var devis_formations = $("#devis_formations").val();
	 var devis_nombre = $("#devis_nombre").val();
	 var devis_lang  = $("#devis_lang").val();
	 var devis_msg  = $("#devis_msg").val();
	 var devis_paiment = $("#devis_paiment").val();
	 
	 
					if((devis_title != '') && (devis_nom != '') && (devis_ville != '') && (devis_pays != '') && (devis_email != '')   && (devis_fonction  != '') && (devis_company  != '') && (devis_telephone  != '') && (devis_formations  != '') && (devis_nombre  != '') && (devis_lang  != '') && (devis_msg  != '') && (devis_paiment  != '')){

					//alert("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment);
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Votre demande a été envoyé avec success. Nous Vous transmettrons dans les meilleurs délais le devis détaillé de votre formation.',
									html: ''
								  })
								  	 
								$("#devis_title").val("");
								$("#devis_nom").val("");
								$("#devis_ville").val("");
								$("#devis_pays").val("");
								$("#devis_email").val("");
								$("#devis_fonction").val("");
								$("#devis_company").val("");
								$("#devis_telephone").val("");
								$("#devis_formations").val("");
								$("#devis_nombre").val("");
								$("#devis_lang").val("");
								$("#devis_msg").val("");
								$("#devis_paiment").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
								   
							
							$(div).html('ENVOYER');	
						 }
						};  
				
						xhr.open("POST", site_url+"ajax/submitDevisBusiness.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment); 
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}





function submitDevis(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	 var devis_title = $("#devis_title").val();
	 var devis_nom  = $("#devis_nom").val();
	 var devis_ville = $("#devis_ville").val();
	 var devis_pays = $("#devis_pays").val();
	 var devis_email = $("#devis_email").val();
	 var devis_fonction  = $("#devis_fonction").val();
	 var devis_company = $("#devis_company").val();
	 var devis_telephone = $("#devis_telephone").val();
	 var devis_formations = $("#devis_formations").val();
	 var devis_nombre = $("#devis_nombre").val();
	 var devis_lang  = $("#devis_lang").val();
	 var devis_msg  = $("#devis_msg").val();
	 var devis_paiment = $("#devis_paiment").val();
	 
	 
					if((devis_title != '') && (devis_nom != '') && (devis_ville != '') && (devis_pays != '') && (devis_email != '')   && (devis_fonction  != '') && (devis_company  != '') && (devis_telephone  != '') && (devis_formations  != '') && (devis_nombre  != '') && (devis_lang  != '') && (devis_msg  != '') && (devis_paiment  != '')){

					//alert("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment);
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Votre demande a été envoyé avec success. Nous Vous transmettrons dans les meilleurs délais le devis détaillé de votre formation.',
									html: ''
								  })
								  	 
								$("#devis_title").val("");
								$("#devis_nom").val("");
								$("#devis_ville").val("");
								$("#devis_pays").val("");
								$("#devis_email").val("");
								$("#devis_fonction").val("");
								$("#devis_company").val("");
								$("#devis_telephone").val("");
								$("#devis_formations").val("");
								$("#devis_nombre").val("");
								$("#devis_lang").val("");
								$("#devis_msg").val("");
								$("#devis_paiment").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
								   
							
							$(div).html('ENVOYER');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitDevis.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment); 
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}

function submitDevisWorkshop(div){
	
	var xhr = getXMLHttpRequest();
	
	$(div).html('<center style=""><div class="loader loader_medium ptb10"></div> </center>');
	 
	 var devis_title = $("#devis_title").val();
	 var devis_nom  = $("#devis_nom").val();
	 var devis_ville = $("#devis_ville").val();
	 var devis_pays = $("#devis_pays").val();
	 var devis_email = $("#devis_email").val();
	 var devis_fonction  = $("#devis_fonction").val();
	 var devis_company = $("#devis_company").val();
	 var devis_telephone = $("#devis_telephone").val();
	 var devis_formations = $("#devis_formations").val();
	 var devis_nombre = $("#devis_nombre").val();
	 var devis_lang  = $("#devis_lang").val();
	 var devis_msg  = $("#devis_msg").val();
	 var devis_paiment = $("#devis_paiment").val();
	 
	 
					if((devis_title != '') && (devis_nom != '') && (devis_ville != '') && (devis_pays != '') && (devis_email != '')   && (devis_fonction  != '') && (devis_company  != '') && (devis_telephone  != '') && (devis_formations  != '') && (devis_nombre  != '') && (devis_lang  != '') && (devis_msg  != '') && (devis_paiment  != '')){

					//alert("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment);
											
						xhr.onreadystatechange = function(){
						 if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){
							var response = xhr.responseText;
							//$('#outs_submit').html(xhr.responseText);
							
						  if(response == 0){
								swal({
									type: 'success',
									title: 'Votre demande a été envoyé avec success. Nous Vous transmettrons dans les meilleurs délais le devis détaillé de votre formation.',
									html: ''
								  })
								  	 
								$("#devis_title").val("");
								$("#devis_nom").val("");
								$("#devis_ville").val("");
								$("#devis_pays").val("");
								$("#devis_email").val("");
								$("#devis_fonction").val("");
								$("#devis_company").val("");
								$("#devis_telephone").val("");
								$("#devis_formations").val("");
								$("#devis_nombre").val("");
								$("#devis_lang").val("");
								$("#devis_msg").val("");
								$("#devis_paiment").val("");
	 
						 } else if(response == 1)
								swal({
									type: 'error',
									title: 'Aucun formulaire transmis.',
									html: 'Aucun formulaire transmis.'
								   })
							else if(response == 2)
								swal({
									type: 'error',
									title: 'Veuillez renseigner tous les champs de texte.',
									html: 'Veuillez renseigner tous les champs de texte.'
								   })
							else if(response == 3)
								swal({
									type: 'error',
									title: 'Email non valide. Veuillez renseignez une adresse mail valide.',
									html: 'Email non valide. Veuillez renseignez une adresse mail valide.'
								   })
							else
								swal({
									type: 'error',
									title: ''+response+'',
									html: ''+response+''
								   })
								   
							
							$(div).html('ENVOYER');	
						 }
						}; 
				
						xhr.open("POST", site_url+"ajax/submitDevisWorkshop.php", true);
						xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhr.send("devis_title="+devis_title+"&devis_nom="+devis_nom+"&devis_ville="+devis_ville+"&devis_pays="+devis_pays+"&devis_email="+devis_email+"&devis_fonction="+devis_fonction+"&devis_company="+devis_company+"&devis_telephone="+devis_telephone+"&devis_formations="+devis_formations+"&devis_nombre="+devis_nombre+"&devis_lang="+devis_lang+"&devis_msg="+devis_msg+"&devis_paiment="+devis_paiment); 
				} else{					
					$(div).html('ENVOYER');					
					 alert('Veuillez renseigner tous les champs.');
				}
}