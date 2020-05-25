<?php 
/**
 * Template Name: Member Area
 *
 * Member Area Page Template.
 *
 * @author Jenny Johannessen
 * @since 1.0.0
 */

get_header(); 
?>


<main id="site-content" role="main">

<?php 
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        the_title( '<h1>', '</h1>' ); 
        the_content();
    endwhile; 
else: 
    _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
endif; 
?>
    
</main>


<?php
    get_footer();

?>

