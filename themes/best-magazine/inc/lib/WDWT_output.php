<?php

/// include functions_class

require_once( 'WDWT_admin_view.php' );

//// set classes objects

$wdwt_admin_elements = new WDWT_admin_view();

/**
 * displays single parameter in admin control panel
 *
 *
 *
 * @param $option['type'] : button, checkbox, checkboxes, checkbox_open
 *                          picker, radio, 
 *                          select, selects, select_typography,  
 *                          text, textarea, text_slider, textarea_slider, text_preview, 
 *                          upload_single, upload_multiple
 *
 *
 *
 *
 *
 */



function WDWT_field_callback( $option, $context = 'option', $opt_val ='', $meta = array() ) {
	/*echo "fieldbegin";*/
	global $wdwt_admin_elements;
  
  if(isset($option['mod']) && $option['mod']){
    $context = 'mod';
  }
	$fieldtype = $option['type'];

	switch($fieldtype){
    case 'button' : { 
      echo $wdwt_admin_elements->button($option, $context, $opt_val, $meta);
      break;
    }
    case 'color' : {
      echo $wdwt_admin_elements->color($option, $context, $opt_val, $meta);
    break;
    }
    case 'colors' : {
      echo $wdwt_admin_elements->colors($option, $context, $opt_val, $meta);
      break;
    }
  	case 'checkbox' : {
  	  echo $wdwt_admin_elements->checkbox($option, $context, $opt_val, $meta);
  		break;
  	}
    case 'checkbox_open' : { 
      echo $wdwt_admin_elements->checkbox_open($option, $context, $opt_val, $meta);
      break;
    }
    case 'text' : {
      echo $wdwt_admin_elements->input($option, $context, $opt_val, $meta);
      break;
    }  
    case 'layout' : {
      echo $wdwt_admin_elements->radio_images($option, $context, $opt_val, $meta);
      break;
    }
    case 'layout_open' : {
      echo $wdwt_admin_elements->radio_images_open($option, $context, $opt_val, $meta);
      break;
    }
    case 'number' : {
      echo $wdwt_admin_elements->number($option, $context, $opt_val, $meta);
      break;
    }
  	case 'radio' : {
  	  echo $wdwt_admin_elements->radio($option, $context, $opt_val, $meta);
  		break;
  	}
    case 'radio_open' : {
      echo $wdwt_admin_elements->radio_open($option, $context, $opt_val, $meta);
      break;
    }
  	case 'select' : {
  		echo $wdwt_admin_elements->select($option, $context, $opt_val, $meta);
  		break;
  	}
    case 'select_open' : { 
      echo $wdwt_admin_elements->select_open($option, $context, $opt_val, $meta);
      break;
    }
    case 'select_theme' : { 
      echo $wdwt_admin_elements->select_theme($option, $context, $opt_val, $meta);
      break;
    }
    case 'select_style' : { 
      echo $wdwt_admin_elements->select_style($option, $context, $opt_val, $meta);
      break;
    }
    case 'textarea' : { 
  		echo $wdwt_admin_elements->textarea($option, $context, $opt_val, $meta);
  		break;
  	}
    case 'text_preview' : { 
        echo $wdwt_admin_elements->text_preview($option, $context, $opt_val, $meta);
      break;
    }
    case 'text_slider' : { 
      /*this element is shown with slider*/
      return false;
      break;
    }
    case 'textarea_slider' : { 
      /*this element is shown with slider*/
      return false;
      break;
    }
  	case 'upload_single' : { 
  		echo $wdwt_admin_elements->upload_single($option, $context, $opt_val, $meta);
  		break;
  	}
    case 'upload_multiple' : { 
      echo $wdwt_admin_elements->upload_multiple($option, $context, $opt_val, $meta);
      break;
    }
    default : {
      echo __("Such element type does not exist!", "best-magazine");
    }    
	 
	
  }
	// Output the setting description
	if(isset($option['description']) && $option['description'] != '' ){ ?>
	 <span class="description"><?php echo esc_html($option['description']); ?></span>
	<?php 
  }
  /*echo "fieldend";*/
}


function WDWT_sections_callback( $section_passed ) {
  global $WDWT_tabs;


  $WDWT_tabs = WDWT_get_tabs();
  foreach ( $WDWT_tabs as $tabname => $tab ) {
    $tabsections = $tab['sections'];
    foreach ( $tabsections as $sectionname => $section ) {
      if ( 'WDWT_' . $sectionname . '_section' == $section_passed['id'] ) { ?>
        <p><?php echo esc_html($section['description']); ?></p>
      <?php
      }
    }
  }
}

function WDWT_admin_options_page_tabs() {
	$page = WDWT_SLUG;
	$current = wdwt_get_current_tab();
	$tabs = wdwt_get_tabs();
	$links = array();


	foreach( $tabs as $tab ) {
  	
    $tabname = $tab['name'];
  	if($tabname == 'featured_plugins' || $tabname == 'licensing'){
    	$tabtitle = $tab['title'];
  		if ( $tabname == $current ) {
  			$links[] = "<li><a class='nav-tab nav-tab-active' href='?page=".WDWT_SLUG."&tab=".$tabname."'>".esc_html($tabtitle)."</a></li>";
  		} 
  		else {
  			$links[] = "<li><a class='nav-tab' href='?page=".WDWT_SLUG."&tab=".$tabname."'>".esc_html($tabtitle)."</a></li>";
  		}
    }
	}

	echo '<div id="icon-themes" class="icon32"><br /></div>';
	echo '<div class="wdwt_nav-tab-wrapper"><ul>';
		foreach ( $links as $link )
			echo $link;
	echo '</ul></div>';
  echo isset($tabs[$current]['description']) ? $tabs[$current]['description'] : '';
}

function wdwt_section_descr($wdwt_tab='general') {
  switch($wdwt_tab){
    case 'seo':{
      $tab = '1';
      $text = __('This section allows you to add meta keywords, metatags, titles. ', "best-magazine");
    break;
    }
    case 'layout_editor':{
      $tab = '2';
      $text = __('This section allows you to make changes in default layout of the theme.', "best-magazine");
    break;
    }
    case 'general':{
      $tab = '3';
      $text = __('This section allows you to make changes in your site and customize it in accordance to personal preferences.', "best-magazine");
    break;
    }
    case 'homepage':{
      $tab = '4';
      $text = __('This section allows you to make changes in post styles and customize your homepage appearance. ', "best-magazine");
    break;
    }
    case 'integration':{
      $tab = '5';
      $text = __('This section allows you to add integration codes in various areas of the site.', "best-magazine");
    break;
    }
    case 'color_control':{
      $tab = '6';
      $text = __('This section allows you customizing certain color features in the theme. ', "best-magazine");
    break;
    }
    case 'typography':{
      $tab = '7';
      $text = __('This section allows you to change the font styles.', "best-magazine");
    break;
    }
    case 'slider':{
      $tab = '8';
      $text = __('This section allows you customize the slider. ', "best-magazine");
    break;
    }
    case 'install_sample_data':{
      $tab = '9';
      $text = __('This section allows to add sample data.', "best-magazine");
    break;
    }/*
    case 'featured_plugins':{
      $tab = '10';
      $text = __('This section displays plugins, which will help to increase the theme functionality', "best-magazine");
    break;
    }*/
    case 'lightbox':{
      $tab = '11';
      $text = __('This section allows you customize the lightbox. ', "best-magazine");
    break;
    }
    case 'themes_updates':{
      $tab = '12';
      $text = __('Available updates for the theme.', "best-magazine");
      break;
    }
    default :{
      $tab = '';
      $text = '';
    } 
  }
  $text = 
  '<span class="user_manual">
            
        <span style="float:left;">
          <a href="'.WDWT_HOMEPAGE.'/wordpress-themes-guide-step-1.html" target="_blank" class="user_title">'. __("User Manual.", "best-magazine").'</a>
          <br /><span style="font-size:1.2em;">'.esc_html($text) .'</span>
          <a href="'.WDWT_HOMEPAGE.'/wordpress-theme-options/3-'.$tab.'.html" target="_blank" class="user_more">' . __('More', "best-magazine"). '... </a>
        </span>'
                    .( wdwt_pro_banner()).
    '</span>';
  return $text;
}



function wdwt_pro_banner(){
  $text = 
    '<span style="font-size:16px; float:left;" class="wdwt_pro_banner_panel">
    <a href="'. WDWT_HOMEPAGE .'/wordpress-themes/'.WDWT_SLUG.'.html" target="_blank" style="color:red; text-decoration:none;">
      <img src="'.WDWT_IMG_INC .'pro.png" border="0" alt="" width="215">
    </a>
    </span>';
    return $text;
}

?>