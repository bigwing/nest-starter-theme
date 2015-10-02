jQuery ( document ).ready( function( $ ) {
  function unserialize( s ) {
    var r = {}, q, pp, i, p;
    if ( !s ) { return r; }
    q = s.split('?'); if ( q[1] ) { s = q[1]; }
    pp = s.split('&');
    for ( i in pp ) {
      if ( jQuery.isFunction(pp.hasOwnProperty) && !pp.hasOwnProperty(i) ) { continue; }
      p = pp[i].split('=');
      r[p[0]] = p[1];
    }
    return r;
  };

    /* Slick Nav*/
    jQuery('header nav').slicknav( {
      allowParentLinks: false,
      appendTo: '#mobile-nav',
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
    $('.menu').slicknav('open');

    /* Close alert boxes */
    $(".alert-error .close").click(function(){
        $(".alert-error").fadeOut("slow");return false;
    });
    $(".alert-warning .close").click(function(){
        $(".alert-warning").fadeOut("slow");return false;
    });
    $(".alert-info .close").click(function(){
        $(".alert-info").fadeOut("slow");return false;
    });
    $(".alert-success .close").click(function(){
        $(".alert-success").fadeOut("slow");return false;
    });


} ); //end