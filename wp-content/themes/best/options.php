<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

    // This gets the theme name from the stylesheet
    $themename = get_option( 'stylesheet' );
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}



/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }
    
    // Background Defaults
    $background_defaults = array(
        'color'      => '',
        'image'      => '',
        'repeat'     => 'repeat',
        'position'   => 'top center',
        'attachment' => 'scroll'
    );

    // The Options Array
    $options = array();

    $options[] = array( 'name'  => 'Layout Options',
                        'type'  => 'heading'
    );
    
    $options[] = array( 'name'  => 'Display Header Banner Area',
                        'desc'  => 'Select the checkbox to display the header banner area. You can use this space to display an advertisement, or type in text if desired. This space is unstyled so you will need to write your own HTML markup for any paragraphs, headings, et cetera.',
                        'id'    => 'best_display_header_banner_area',
                        'std'   => 0,
                        'type'  => 'checkbox'
    );

    $options[] = array( 'name'  => 'Header Banner Area',
                        'desc'  => 'Enter in your content for the header banner area.',
                        'id'    => 'best_header_banner_area',
                        'class' => 'hidden',
                        'type'  => 'textarea'
    );
    
    $options[] = array( 'name'  => 'Display Homepage Intro Text',
                        'desc'  => 'Select the checkbox to display the homepage intro text, which appears above the slider.',
                        'id'    => 'best_display_intro_text',
                        'std'   => 1,
                        'type'  => 'checkbox'
    );

    $options[] = array( 'name'  => 'Homepage Intro Text',
                        'desc'  => 'Enter a brief introduction about your site, which will display on the homepage above the slider. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
                        'id'    => 'best_intro_text',
                        'std'   => 'Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.',
                        'class' => 'hidden',
                        'type'  => 'textarea'
    );
    
    $options[] = array( 'name'  => 'Display Homepage Widget Row',
                        'desc'  => 'Select the checkbox to display the homepage widget row, which allows you to place three widgets in line below the slider.',
                        'id'    => 'best_display_homepage_widget_row',
                        'std'   => 1,
                        'type'  => 'checkbox'                
    );
    
    $options[] = array( 'name'  => 'Display Featured Content Bar',
                        'desc'  => 'Select the checkbox to display the featured content bar, which appears at the top of your inner pages throughout the site. This section is perfect for marketing and promotions purposes.',
                        'id'    => 'best_display_featured_bar',
                        'std'   => 0,
                        'type'  => 'checkbox'
    );

    $options[] = array( 'name'  => 'Featured Content Bar Text',
                        'desc'  => 'This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
                        'id'    => 'best_featured_bar',
                        'std'   => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
                        'class' => 'hidden',
                        'type'  => 'textarea'
    );

    $options[] = array( 'name'  => 'Blog Slider',
                        'desc'  => 'Select the checkbox to display the slider at the top of your blog page.',
                        'id'    => 'best_blog_slider',
                        'std'   => 0,
                        'type'  => 'checkbox'
    );
    
    $options[] = array( 'name'  => 'Blog Pagination Option',
                        'desc'  => 'Select the checkbox to display custom pagination with advanced features. Deselecting the checkbox will display standard WordPress pagination.',
                        'id'    => 'best_pagination_option',
                        'std'   => 1,
                        'type'  => 'checkbox'
    );

    $options[] = array( 'name'  => 'Display Twitter Integration',
                        'desc'  => 'Select the checkbox to display the Twitter integration above the footer.',
                        'id'    => 'best_display_twitter',
                        'std'   => 1,
                        'type'  => 'checkbox'
    );

    $options[] = array( 'name'  => 'Twitter Username',
                        'desc'  => 'Enter your Twitter username to have your latest tweet displayed above the footer.',
                        'id'    => 'best_twitter',
                        'std'   => 'BlogexThemes',
                        'class' => 'hidden mini',
                        'type'  => 'text'
    );
    
    $options[] = array( 'name'  => 'Display Footer Top',
                        'desc'  => 'Select the checkbox to display the top section of the footer, which contains widget areas.',
                        'id'    => 'best_display_footer_top',
                        'std'   => 1,
                        'type'  => 'checkbox'
    );
    
    $options[] = array( 'name'  => 'Display Footer Bottom',
                        'desc'  => 'Select the checkbox to display the bottom section of the footer, which contains a space for a tagline and a menu.',
                        'id'    => 'best_display_footer_bottom',
                        'std'   => 1,
                        'type'  => 'checkbox'
    );
    
    $options[] = array( 'name'  => 'Footer Bottom Tagline',
                        'desc'  => 'Enter a brief tagline about your site, which will display on the left side of the bottom section of the footer. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
                        'id'    => 'best_footer_bottom_tagline',
                        'std'   => '&copy; 2013 <a href="http://bloggingexperiment.com/" title="WordPress Themes 2013 - The Best WordPress Themes by BloggingExperiment.com">BloggingExperiment.com</a>',
                        'class' => 'hidden',
                        'type'  => 'textarea'
    );
    
    $options[] = array( 'name'  => 'Skin',
                        'type'  => 'heading'
    );
    
    $options[] = array( 'name'  => 'Site Heading Title',
                        'desc'  => 'Selecting this checkbox provides an option to upload an image for your site heading. Leaving it blank will automatically display the site name and description.',
                        'id'    => 'site_heading',
                        'std'   => 0,
                        'type'  => 'checkbox'
    );
    
    $options[] = array( 'name'  => 'Logo Uploader',
                        'id'    => 'site_heading_img',
                        'class' => 'hidden',
                        'type'  => 'upload'
    );
    
    $options[] = array( 'name'  => 'Site Background',
                        'desc'  => 'Select your background options for the theme.',
                        'id'    => 'best_background',
                        'std'   => $background_defaults,
                        'type'  => 'background'
    );
    
    $options[] = array( 'name'  => 'Main Link Color',
                        'desc'  => 'Select a main link color for the theme.',
                        'id'    => 'best_link_color_main',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Main Link Hover Color',
                        'desc'  => 'Select a main link hover color for the theme.',
                        'id'    => 'best_link_hover_color_main',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Footer Link Color',
                        'desc'  => 'Select a footer link color for the theme.',
                        'id'    => 'best_link_color_footer',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Footer Link Hover Color',
                        'desc'  => 'Select a footer link hover color for the theme.',
                        'id'    => 'best_link_hover_color_footer',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Featured Content Bar Background',
                        'desc'  => 'Select the background color and/or image for the featured content bar.',
                        'id'    => 'best_background_featured_content',
                        'std'   => $background_defaults,
                        'type'  => 'background'
    );
    
    $options[] = array( 'name'  => 'Featured Content Bar Text Color',
                        'desc'  => 'Select the text color for the featured content bar.',
                        'id'    => 'best_text_color_featured_content',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Featured Content Bar Link Color',
                        'desc'  => 'Select the link color for the featured content bar.',
                        'id'    => 'best_link_color_featured_content',
                        'std'   => '',
                        'type'  => 'color'
    );
    
    $options[] = array( 'name'  => 'Featured Content Bar Link Hover Color',
                        'desc'  => 'Select the link hover color for the featured content bar.',
                        'id'    => 'best_link_hover_color_featured_content',
                        'std'   => '',
                        'type'  => 'color'
    );

    return $options;
}



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

    if ($('#best_display_header_banner_area:checked').val() !== undefined) {
        $('#section-best_header_banner_area').show();
    }
    
    $('#best_display_header_banner_area').click(function() {
          $('#section-best_header_banner_area').fadeToggle(400);
    });

    if ($('#site_heading:checked').val() !== undefined) {
        $('#section-site_heading_img').show();
    }
    
    $('#site_heading').click(function() {
          $('#section-site_heading_img').fadeToggle(400);
    });

    if ($('#best_display_intro_text:checked').val() !== undefined) {
        $('#section-best_intro_text').show();
    }
    
    $('#best_display_intro_text').click(function() {
          $('#section-best_intro_text').fadeToggle(400);
    });
    
    if ($('#best_display_twitter:checked').val() !== undefined) {
        $('#section-best_twitter').show();
    }

    $('#best_display_twitter').click(function() {
          $('#section-best_twitter').fadeToggle(400);
    });

    if ($('#best_display_footer_bottom:checked').val() !== undefined) {
        $('#section-best_footer_bottom_tagline').show();
    }
    
    $('#best_display_footer_bottom').click(function() {
          $('#section-best_footer_bottom_tagline').fadeToggle(400);
    });
    
    if ($('#best_display_featured_bar:checked').val() !== undefined) {
        $('#section-best_featured_bar').show();
    }
    
    $('#best_display_featured_bar').click(function() {
          $('#section-best_featured_bar').fadeToggle(400);
    });

});
</script>

<?php } ?>