<?php
/*
Template Name: Full width
*/

get_header();

get_template_part('partials/header_menu'); 

?>
	<section class="page_main_section">
		<div class="container content_fullwidth">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
				<?php the_content();?>
			<?php endwhile; endif;?>

		</div>
	</section>

<?php get_footer();