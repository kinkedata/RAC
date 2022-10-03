$(document)
	.ready(
		function(){

			console.log('*** LOADING RAC JS ***');

			var _footerHeight = $('footer').height();


			//Mapa
			function buscaTienda(address){

				var _uri = './ajax/tiendas.php?direccion=' + address;

				$("#mapa").googleMap();

				$.get(_uri)
					.success(
						function(data)
						{
							console.log(data);

							var _count = 0;

							$('.display-map .text').empty();

							$.each(data.tiendas,
								function(index, value){

									var _image = (_count == 0) ? './img/marcador-1.png' : './img/marcador-2b.png';

									if(_count == 0){

										$('.display-map .text').append('<span>Tu tienda mas cercana es: '+ value.direccion +'</span>');

									}

									$("#mapa")
										.addMarker(
										{
											coords: [value.data.lat, value.data.lng],
											icon: _image,
											title: value.titulo, // Title
      										text:  value.direccion
								    	});

								    _count++;

								})

						});

			}

			$('#buscatienda a')
				.click(
					function(e){

						e.preventDefault();

						var _address = $(this).parent().find('input').val();

						if(_address != ''){

							buscaTienda(_address);

						}else{

							//Todo: hacer notificacion para validacion de direccion.

						}


					}
				);

			$('.mapa-container .mapa-control')
				.click(
					function()
					{

						$(this).parent().find('.display-map').fadeToggle();

					});


			buscaTienda('C.P. 21460');


			$("#mapa")
				.googleMap(
				{
		      		zoom   : 5,
		      		coords : [24, -102.391966],
		      		type   : "ROADMAP"
		    	});


			//Sliders
			$('.banner-anuncio .slider').lightSlider({
				item: 1,
				controls: true,
			});

			$('#marcas .slider').lightSlider({
				item: 5,
				controls: false,
			});

			$('.productos-relacionados .slider-productos').lightSlider({
				items: 3
			});

			//Footer
			$('#esconder-footer')
				.click(
					function(e)
					{
						e.preventDefault();

						var _height = '';

						if($('footer').hasClass('collapsed')){

							_height = _footerHeight;

						}else{

							_height = '45px';

						}

						$('footer .row')
							.animate({
								height: _height
							}, 250, function(){

								$('footer').toggleClass('collapsed');

							});


					});

		}//ready
	);
