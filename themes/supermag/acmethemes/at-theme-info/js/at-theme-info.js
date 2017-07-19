jQuery(document).ready(function ($) {

    /* If there are required actions, add an icon with the number of required actions in the About at-theme-info page -> Actions recommended tab */
    var at_theme_info_count_actions_recommended = at_theme_info_object.count_actions_recommended;

    if ( (typeof at_theme_info_count_actions_recommended !== 'undefined') && (at_theme_info_count_actions_recommended != '0') ) {
        jQuery('li.at-theme-info-w-red-tab a').append('<span class="at-theme-info-actions-count">' + at_theme_info_count_actions_recommended + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".at-theme-info-recommended-action-button,.reset-all").click(function() {

        var id = jQuery(this).attr('id'),
            action = jQuery(this).attr('data-action');

        jQuery.ajax({
            type      : "GET",
            data      : {
                action: 'at_theme_info_update_recommended_action',
                id: id,
                todo: action
            },
            dataType  : "html",
            url       : at_theme_info_object.ajaxurl,
            beforeSend: function (data, settings) {
                jQuery('.at-theme-info-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + at_theme_info_object.template_directory + '/acmethemes/at-theme-info/images/ajax-loader.gif" /></div>');
            },
            success   : function (data) {
                location.reload();
                jQuery("#temp_load").remove();
                /* Remove loading gif */
            },
            error     : function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

    /*faq*/
    jQuery(".faq .faq-title").click(function(e) {

        //Close all <div> but the <div> right after the clicked <a>
        $(e.target).next('div').siblings('div').slideUp();

        //Toggle open/close on the <div> after the <h3>, opening it if not open.
        $(e.target).next('div').slideToggle();
    });

    /*image size options*/
    jQuery(".acme-set-image").click(function() {

        var acme_set_image = jQuery(this);

        jQuery.ajax({
            type      : "GET",
            data      : {
                action: 'acme_demo_setup_before_import'
            },
            url       : at_theme_info_object.ajaxurl,
            beforeSend: function (data, settings) {
                jQuery('.acme-set-image').append('<div id="temp_load" style="text-align:center"><img src="' + at_theme_info_object.template_directory + '/acmethemes/at-theme-info/images/ajax-loader.gif" /></div>');
            },
            success   : function (data) {
                jQuery("#temp_load").remove();
                acme_set_image.remove();
                /* Remove loading gif */
            },
            error     : function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

});