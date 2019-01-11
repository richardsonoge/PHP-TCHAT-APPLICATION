$(document).ready(function(){
	$('[data-confirm]').on('click', function(e){
		e.preventDefault(); //Annuler l'action par défaut

		//Récupérer la valeur de l'attribut href
		var href = $(this).attr('href');

		//Récupérer la valeur de l'attribut data-confirm
		var message = $(this).data('confirm');

		//Afficher la popup SweetAlert
		swal({
			title: "Êtes-vous sûr?",
			text: message, //Utiliser la valeur de data-confirm comme text
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Annuler",
			confirmButtonText: "Oui",
			confirmButtonColor: "#DD6B55"
		}, function(isConfirm){
			if(isConfirm) {
				//Si l'utilisateur clique sur Oui,
				//Il faudra le rediriger l'utilisateur vers la page
				//de suppression
				window.location.href = href;
			}
		});
	});

    var url = 'ajax/search.php';

	$('#searchbox').on('keyup', function(){
		var query = $(this).val();

		if (query.length > 0) {
			$.ajax({
	  			type: 'POST',
	  			url: url,
	  			data: {
	  				query: query
	  			},
	  			beforeSend: function(){
	  				$("#spinner").show();
	  			},
	  			success: function(data){
	  				$("#spinner").hide();
	  				$("#display-results").html(data).show();
	  			}
	  		});
		} else{
			$("#display-results").hide();
		}
	});
});