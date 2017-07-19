jQuery(document).ready(function ($) {
    $('.at-customizer').on( 'click', function( evt ){
        evt.preventDefault();
        section = $(this).data('section');
        if ( section ) {
            wp.customize.section( section ).focus();
        }
    });
});