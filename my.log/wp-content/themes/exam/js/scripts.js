/**
 * the semi-colon before the function invocation is a safety
 * net against concatenated scripts and/or other plugins
 * that are not closed properly.

 * undefined is used here as the undefined global
 * variable in ECMAScript 3 and is mutable (i.e. it can
 * be changed by someone else). undefined isn't really
 * being passed in so we can ensure that its value is
 * truly undefined. In ES5, undefined can no longer be
 * modified.

 * window and document are passed through as local
 * variables rather than as globals, because this (slightly)
 * quickens the resolution process and can be more
 * efficiently minified (especially when both are
 * regularly referenced in our plugin).
 */

;(function(window, document, $, undefined) {

	'use strict';

	var $inps = '#enter-zip';
	var $locs = 'Nowhereville, XXX';
	var $emps = '';

	$( '.read-review' ).click( function()
		{
			var $ids = $(this).attr('href');

			console.log(  $ids );

			$.fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				nextEffect	: 'fade',
				prevEffect	: 'fade',
				helpers 	: {
					media : {}
				},
				href: $ids,
			});
		}
	);

	$( '.lawyer-category_content' ).click( function()
		{
			$.fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				nextEffect	: 'fade',
				prevEffect	: 'fade',
				helpers 	: {
					media : {}
				},
				href: '#category_load',
			});
		}
	);
	

	$('.fancy-video').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		width		: 853,
		height		: 480,
		scrolling   : 'no',
		helpers 	: {
			media : {}
		}
	});

	// Banner cycle
	if ($('#banner-slide').length) {
		$('#banner-slide').cycle({
			fx				: 'fade',
			speed			: 800,
			slideResize		: 0,
			timeout 		: 6000,
			cleartypeNoBg 	: true
		});
	}

	// SEO email button
	$('#btn-email').on('click', function() {
		_gaq.push(['_trackEvent', 'Email', 'Click', 'Header']);
	});
    
     /* Slick */
	$('.banner-slide').slick({
		dots: true,
		infinite: true,
		autoplay: true,
		draggable: false,
		autoplaySpeed: 4000
	});
    
    $('.services-slideshow').slick({
		dots: false,
		infinite: true,
		autoplay: true,
		draggable: false,
		autoplaySpeed: 4000
	});

	/**
	 * find : lawyer
	**/

	function find_handler ( $input, $str ) 
	{
		var $data=$str;
		if( $data !='' ) {
			$( $input ).html( $locs + '<span class="input-find">' + $data + '</span>' );	
			$( $input ).show();	
		} else {
			$( $input ).hide();
		}
	}

	$( $inps ).keyup( function()
		{
			var $val = $(this).val();
			find_handler( '#input1-div', $val );
		}
	);

	$( $inps ).click( function()
		{
			$(this).val( $emps );
		}
	);

	$( '.select-lawyer' ).click( function()
		{
			if( $('#input2-div').is(':visible') ) {
				$('#input2-div').hide();
			} else {
				$('#input2-div').show();
			}		
		}
	);

	$( '.input2-div .category-items' ).click( function() 
		{
			var $txts = $(this).text();
			$( '.select-lawyer' ).text( $txts );
		}
	);

})(window, document, jQuery);