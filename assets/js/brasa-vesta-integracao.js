	jQuery( document ).ready(function() {
		jQuery( "#tabs" ).tabs({
		  active: 3
		});
    jQuery(".form-lote").on('submit', function(e){
    // validation code here
      e.preventDefault();
			jQuery(this).children('input').css('border-color','#bbb')
			ajax_lote(jQuery(this));
  });

	function ajax_lote(elemento){
		jQuery(elemento).fadeOut();
		jQuery('.ajax-loader').fadeIn().css("display","block");;
		jQuery('#resultado').html( "Executando ação...");
		var formData = jQuery( elemento ).serializeArray();
		// console.log('Formdata: ');
		// console.log(formData);
		// console.log('---------------------');
		var dados=new Object();
		formulario=elemento;
		for (var i = 0, len = formData.length; i < len; i++) {
			var key= formData[i]['name'];
			var value= formData[i]['value'];
			dados[key] = formData[i]['value'];
		}			//
		dados.action = dados['acao'];
		dados._ajax_nonce = my_ajax_obj.nonce;
		console.log(dados);

		jQuery.post(my_ajax_obj.ajax_url,dados, function(response) {
			if (jQuery.trim(response) == "OK") {
				jQuery('#resultado').html( "OK.");



				// dados.action = 'lista_user';

				/*jQuery.post(my_ajax_obj.ajax_url,dados, function(response) {
					var opcoes=response;
					console.log(formulario);
					jQuery("select").each(function( index ) {
	  				jQuery(this).html(opcoes);
					});
				});*/

				jQuery('.ajax-loader').fadeOut();
				jQuery(formulario).children('input').each(function(){
					if (jQuery(this).attr('type') != 'hidden' && jQuery(this).attr('type') != 'submit') {
						jQuery(this).val('');
					}
				});
				jQuery(elemento).css('border-color','#bbb');
				if ( dados.action == "cria_user" ) {
					jQuery( '#hidden-user' ).attr( 'value', dados['user'] );
					jQuery( '#hidden-banco' ).attr( 'value', dados['user'] );
					jQuery( '#form-lote-user' ).fadeOut();
					jQuery( '#form-lote-web' ).fadeIn();
				} else if( dados.action == "cria_web" ) {
					jQuery( '#form-lote-web' ).fadeOut();
					jQuery( '#form-lote-banco' ).fadeIn();
				} else {
					jQuery( '#form-lote-banco' ).fadeOut();
				}

			}
			else if (jQuery.trim(response) in dados) {
				var elemento = jQuery("input[name='"+jQuery.trim(response)+"']");
				var campo = jQuery(elemento).attr('placeholder')
				jQuery(elemento).css('border-color','red');
				jQuery('#resultado').html( "Problema!!<br>Preencha o campo "+campo);
				jQuery(formulario).fadeIn();
				jQuery('.ajax-loader').fadeOut();
				console.log('aqui');

			}
			else{
				console.log('ali');
				jQuery(elemento).css('border-color','#bbb');
				jQuery('#resultado').html("");
				jQuery('#resultado').html( "Problema !!!<br>"+response);
				jQuery(formulario).fadeIn();
				jQuery('.ajax-loader').fadeOut();
			}
		});
	}

});
