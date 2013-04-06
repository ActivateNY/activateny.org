<?php

function theme_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'custom-style', 
    get_bloginfo('stylesheet_directory') . '/css/custom-style.css', 
    array(), 
    '20130406', 
    'all' );

  // enqueing:
  wp_enqueue_style( 'custom-style' );
}
add_action('wp_enqueue_scripts', 'theme_styles');

?>