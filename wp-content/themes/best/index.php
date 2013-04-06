<?php
/* =============================================================
 * index.php
 * =============================================================
 * Default page template for the theme
 * ============================================================= */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div class="row">
            <div class="span8">
                <div id="main_content" role="main">

                    <?php if ( of_get_option( 'best_blog_slider' ) ) : ?>

                    <div class="row">
                        <div class="span8">
                            <div class="flexslider">
                                <ul class="slides">
                        
                                    <?php get_template_part( 'loop', 'slides' ); ?>
                            
                                </ul><!-- end .slides -->
                            </div><!-- end .flexslider -->
                            <hr class="hr-row-divider">
                        </div><!-- end .span8 -->
                    </div><!-- end .row -->

                    <?php endif; ?>
                
                    <?php get_template_part( 'loop', 'main' ); ?>
                    
                    <?php
                        if ( of_get_option( 'best_pagination_option' ) ) :
                            // Add custom pagination
                            if ( function_exists( 'pagenavi' ) ) { pagenavi(); };
                        else :
                            echo '<p class="hero-p">';
                            posts_nav_link(' &#183; ', 'previous page', 'next page');
                            echo '</p><hr class="hr-row-divider">';
                        endif;
                    ?>
                    
                </div><!-- end #main_content -->
            </div><!-- end .span8 -->
                    
            <?php get_sidebar( 'main' ); ?>
            
        </div><!-- end .row -->

<?php get_footer(); ?>