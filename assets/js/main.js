
(function($) {

	var	$window = $(window),
		$body = $('body');

	// Breakpoints.
		breakpoints({
			xlarge:  [ '1281px',  '1680px' ],
			large:   [ '981px',   '1280px' ],
			medium:  [ '737px',   '980px'  ],
			small:   [ null,      '736px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Dropdowns.
		$('#nav > ul').dropotron({
			mode: 'fade',
			noOpenerFade: true,
			hoverDelay: 150,
			hideDelay: 350
		});

	// Nav.

		// Title Bar.
			$(
				'<div id="titleBar">' +
					'<a href="#navPanel" class="toggle"></a>' +
				'</div>'
			)
				.appendTo($body);

		// Panel.
			$(
				'<div id="navPanel">' +
					'<nav>' +
						$('#nav').navList() +
					'</nav>' +
				'</div>'
			)
				.appendTo($body)
				.panel({
					delay: 500,
					hideOnClick: true,
					hideOnSwipe: true,
					resetScroll: true,
					resetForms: true,
					side: 'left',
					target: $body,
					visibleClass: 'navPanel-visible'
				});

})(jQuery);

$('#submitModificarPerfil').click(function() {
	var form = new FormData($('#formularioModificarPerfil')[0]);
	$.ajax({
		url: 'sesion.php',
		type: 'POST',
		data: form,
		processData: false,
		contentType: false,
		success: function(res) {
			$('#respuesta').html(res);
		}
	});
});

$('#submitLogin').click(function() {
	var form = new FormData($('#formularioLogin')[0]);
	$.ajax({
		url: 'sesion.php',
		type: 'POST',
		data: form,
		processData: false,
		contentType: false,
		success: function(res) {
			$('#respuesta').html(res);
		}
	});
});

$('#submitRegister').click(function() {
	var form = new FormData($('#formularioRegister')[0]);
	$.ajax({
		url: 'sesion.php',
		type: 'POST',
		data: form,
		processData: false,
		contentType: false,
		success: function(res) {
			$('#respuesta').html(res);
		}
	});
});