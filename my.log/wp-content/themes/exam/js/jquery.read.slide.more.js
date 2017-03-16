/**
 * Read Slide More
 *
 * Straight to the point plugin as an alternative for read more link
 * This plugin will act as an accordion containing the rest of the content.
 *
 * @param1 Integer 			- Number of Elements to be shown
 * @param1 Object
 * @option rows				- Integer 	- Number of paragraphs to be shown (default: 2)
 * @option moreHTML			- String	- The caption to be used for the link to show the read more link (default: 'Read More...')
 * @option lessHTML			- String	- The caption to be used for the link to show the read more link when the content is collapsed (default: 'Read Less...')
 * @option containerClass	- String	- The class to be added to the content container (default: '')
 * @option buttonClass		- String	- The class to be added to the read more button (default: '')
 *
 * Usage:
 
$(selector).titanSlideMore();

$(selector).titanSlideMore(4); // Set the rows to 4 elements only

$(selector).titanSlideMore({
	elements	: 5,
	moreHTML	: 'Read More',
	lessHTML	: 'Read Less',
	containerClass	: '',
	buttonClass	: ''
});
	
 *
 * IMPORTANT NOTES:
 * When you will use this plugin, make sure that the content is the only thing inside the selected element
 *
 * UPDATES:
 * The plugin is now responsive.
 * Now supports contents with ol, ul, h2, h3, div
 * added h1, h4, h5 to supported elements
 *
 * Added condition that will only activate the plugin if the number of elements is greater than the number of elemnts to be shown
 *
 * Multiple Titan Read Slide More will now work in 1 page
 *
 * @author	RaeveN
 * @version 2.13.69
 */
(function($) {
	$.fn.titanSlideMore = function(param) {
		if( !(param instanceof Object) )
			param = { elements : param };
		
		var defaults = {
			elements	: 2,
			paragraphs	: 0, // legacy support
			moreHTML	: 'Read More',
			lessHTML	: 'Read Less',
			containerClass	: '',
			buttonClass	: ''
		}
		var options = $.extend(defaults, param);
		var elem = $(this);
		var height = get_new_height();
		var elemrm;
		
		// Legacy support
		if(options.paragraphs)
			options.elements = options.paragraphs;
		// End legacy support
		
		function get_new_height() {
			var height = 0;
			for(y=0; y<options.elements; y++) {
				height += parseFloat(elem.find('> p,> ol,> ul,> h1,> h2,> h3,> h4,> h5,> div').eq(y).outerHeight(true));
			}
			return height;
		}
		
		function detectIE() {
			var ua = window.navigator.userAgent;
			var msie = ua.indexOf('MSIE ');
			var trident = ua.indexOf('Trident/');

			if (msie > 0) {
				// IE 10 or older => return version number
				return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
			}

			// other browser
			return false;
		}
		
		// Added condition for this to work if the elements is greater than the requested number of elements
		if( elem.find('> p,> ol,> ul,> h1,> h2,> h3,> h4,> h5,> div').length > options.elements) {
			if( detectIE() > 8 || detectIE() == false ) {
				$( window ).on('resize', function() {
					height = get_new_height();
					elemrm.css('height', height+'px');
				});
			}

			$( window ).load(function() {
				height = get_new_height();
				elem.after('<a href="#" class="titan-slide-more '+ options.buttonClass +'">'+ options.moreHTML +'</a>');	
				elem.next('.titan-slide-more').on('click', function() {
					var obj = $(this).prev('.titan-slide-more-content');
					if( obj.hasClass('short') ) {
						obj.removeClass('short').animate({'height':elem.height()+'px'});
						$(this).toggleClass('active').html(options.lessHTML);
					}
					else {

						obj.addClass('short').animate({'height':height+'px'});
						$(this).toggleClass('active').html(options.moreHTML);
					}
					return false;
				});				
				elem.wrap('<div class="titan-slide-more-content short '+options.containerClass+'" data-shortheight="'+height+'" style="overflow: hidden; height: '+height+'px;"></div>');
				
				elemrm = elem.parent('.titan-slide-more-content');
			
				elem.parent('.titan-slide-more-content').css('height', height+'px').data('shortheight', height);
			});
		}
	};
})(jQuery);