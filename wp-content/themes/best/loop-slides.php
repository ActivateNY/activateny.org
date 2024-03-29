<?php
/* =============================================================
 * loop-slides.php
 * =============================================================
 * Loop for homepage slides
 * ============================================================= */
?>

<?php 
    $args = array( 'post_type' => 'slide' );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
    
    $meta = get_post_custom( $post->ID );
?>

    <li>
    
        <?php
            // If the slide has an associated URL, wrap image in an anchor element
            if ( $meta['response_slide_url'][0] ) :
        ?>
        
            <a href="<?php echo $meta['response_slide_url'][0]; ?>" title="<?php the_title_attribute(); ?>">
                <?php get_template_part( 'featured', 'image' ); ?>
            </a>
            
        <?php 
            else : 
                // Else, display image without being wrapped in anchor element
                get_template_part( 'featured', 'image' );    
            endif;
        ?>
        
        <div class="flex-caption">
        
            <?php
                // If the slide has an associated URL, turn heading into a link
                if ( $meta['response_slide_url'][0] ) :
            ?>
            
                <h2><a href="<?php echo $meta['response_slide_url'][0]; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                
            <?php else : // Else, display as normal heading ?>
            
                <h2><?php the_title(); ?></h2>
            
            <?php endif; ?>
          
            <?php the_content(); ?>
        </div>
    </li>

<?php endwhile; else : ?>

    <li>
        <p class="hero-p" style="padding: 40px;">Setup your slides in the admin area by using the "Slide" custom post type, we'll take care of the rest!</p>
    </li>

<?php endif; ?>