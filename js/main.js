(function( $ ) {
	
	var ww = document.body.clientWidth;
	
	//Remove class .responsive-menu from desktop
	if ( ww >= 768 ) {
		$( '.genesis-nav-menu' ).removeClass( 'responsive-menu' );
	}

	//Respacing WooCommerce products on home page
	$( '.home-adverts-container .home-advert:first' ).addClass( 'first-advert' );
	$( 'ul.products li:nth-child(3n)' ).addClass( 'third' );
	$( '.archive ul.products li:nth-child(2n)' ).addClass( 'second' );

	//Globally add 'from' in front and after the price
	$( '.price .amount' ).before( '<i>from </i>' );
	$( '.price .amount' ).after( '<i> pps</i>' );
	
	//Add button under description on archive
	$( '.archive.woocommerce .term-description' )
	.append( '<p><a href="http://acetravel.co.za/contact-ace-travel" class="enquire">Contact us with your enquiry</a></p>' );
	
	
	//Adding back to top button
	$( '.site-container' ).prepend( '<a href="#top" class="backToTop"></a>' );
	$( '.site-container' ).attr( 'id', 'top' );
	
	$( '.backToTop' ).on( 'click touchstart', function(e) {
 		e.preventDefault();
 		$( 'html,body' ).animate( {scrollTop:0}, 'slow' );
 		return false;
 	});
	
	$( document ).scroll( function() {
    	var y = $( this ).scrollTop();
		if ( y > 800 ) {
        	$( '.backToTop').fadeIn();
		} else {
			$( '.backToTop' ).fadeOut();
		}
	});


	//Change text on empty request page
	$( '.ywraq-wrapper > p:first' )
	.html( '<br>You have not selected any holiday package/s for your quote request.<br><br>Browse through the packages and offers, choose one or many options for your next dream holiday. The list of options will appear here, followed by a form to submit your details for your quote request.' );
	
	//Change text on empty product cat page
	$( 'p.woocommerce-info' )
	.replaceWith( '<p class="woocommerce-info"><a href="http://acetravel.co.za/contact-ace-travel">Contact Ace Travel</a> and let us know what you have in mind for this destination. We can tailor make your dream holiday, specifically to your needs.</p>' );

	
})( jQuery );
