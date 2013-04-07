<?php

function theme_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'custom-style', 
    get_bloginfo('stylesheet_directory') . '/css/custom-style.css', 
    array(), 
    '20130406a', 
    'all' );
  wp_register_style( 'custom-header', 
    'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,700italic,400italic,700', 
    array(), 
    '20130406a', 
    'all' );

  // enqueing:
  wp_enqueue_style( 'custom-style' );
  wp_enqueue_style( 'custom-header' );
}
add_action('wp_enqueue_scripts', 'theme_styles', 18);

?>