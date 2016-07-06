jQuery( document ).ready( function( $ ) {
	/* Slick Nav*/
	jQuery('header nav').slicknav( {
	  allowParentLinks: false,
	  appendTo: '#mobile-nav',
	  removeClasses: true,
	  openedSymbol: '&#9660',
	   beforeClose: function( trigger ) {
	    $trigger = jQuery( trigger );
	    if ( ! $trigger.parent().hasClass( 'slicknav_parent' ) ) {
	      return;
	    }
	    $anchor = jQuery( trigger ).find( 'a' );
	    attr = $anchor.attr( 'href' );
	    if ( attr == '#' ) {
	      return;
	    } else {
	      window.location = attr;
	      return false;
	    }
	   },
	   nestedParentLinks: false
	} );
} );