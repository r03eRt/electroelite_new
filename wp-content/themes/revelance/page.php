<?php
get_header();

get_template_part('partials/header_menu'); 

?>

	<section class="page_main_section">
		<div class="container">

			<div class="row">

				<div class="span8 content content_with_right_sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
						<?php the_content();?>
					<?php endwhile; endif;?>
				</div><!-- end span8 main-content -->
				
				<aside class="span4 sidebar sidebar_right">
					<?php get_sidebar(); ?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();