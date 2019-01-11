$(document).ready(function(){

	// AJAX CHECK - PAGE SEND 
	$("#to_email").blur(function(){
		
		$("#msgbox").removeClass().addClass('messagebox').text('Verification en cours...').fadeIn("slow");
		
		$.post("verif.php" ,{ to_email:$(this).val() } ,function(data){
			$("#msgbox").fadeTo(200,0.1,function(){
				if (data == 1){
					$(this).html('Ce contact existe !').addClass('dispo').fadeTo(900,1);
				}else{
					$(this).html('ATTENTION : Ce contact n\'existe pas ! Si vous souhaitez ajouter ce contact <a href="add.php">cliquez-ici</a>').addClass('busy').fadeTo(900,1);
				}
			});
		});
	});

	// AJAX CHECK - PAGE SEND 
	$("#to_tel").blur(function(){
		
		$("#msgbox").removeClass().addClass('messagebox').text('Verification en cours...').fadeIn("slow");
		
		$.post("verif-tel.php" ,{ to_tel:$(this).val() } ,function(data){
			$("#msgbox").fadeTo(200,0.1,function(){
				if (data == 1){
					$(this).html('Ce contact existe !').addClass('dispo').fadeTo(900,1);
				}else{
					$(this).html('ATTENTION : Ce contact n\'existe pas ! Si vous souhaitez ajouter ce contact <a href="add.php">cliquez-ici</a>').addClass('busy').fadeTo(900,1);
				}
			});
		});
	});
	
	// PAGE SEND - Affichage du champ mail 
	$('#Tous_0').click(function(){
		$('#affiche_email').fadeOut();
	});
	
	$('#Tous_1').click(function(){
		$('#affiche_email').fadeIn();
	});
	
	$('#Tous_2').click(function(){
		$('#affiche_email').fadeOut();
	});

	// PAGE FORMULAIRE - FRONT AFFICHAGE DATE/FORMATION
	$('#non').click(function(){
		$('#lieuDateFormation').fadeOut();
	});
	
	$('#oui').click(function(){
		$('#lieuDateFormation').fadeIn();
	});
	

	// PAGE UPLOAD
	$(document).ready(function(){
		$('form input').change(function () {
			var file = this.files[0],
			fileName = file.name,
			fileSize = file.size;
			$('form p').html("<br><img src='img/csv.png'><br>" + fileName + "<br>" + file.size + " octets");
		});
	});
	
});

// PAGE EDIT
function confirme( identifiant ){ 
	var confirmation = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ; 
	if( confirmation ){ 
		document.location.href = "edit.php?action=delete&id="+identifiant ; 
	} 
} 

