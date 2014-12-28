<?php
/*
Template Name: 404 page
*/

get_header();

get_template_part('partials/header_menu'); 

?>

	<section class="container page_main_section" id="page404">
		<p class="big_404">W-P-L-O-C-K-E-R-.-C-O-M<?php _e('404', 'ABdev_revelance') ?></p>
		<h2><?php _e('Oops, the Page You are Looking for can not be Found', 'ABdev_revelance') ?></h2>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<?php the_content();?>
		<?php endwhile; endif;?>
	</section>

<?php get_footer();