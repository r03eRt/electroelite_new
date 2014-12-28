<?php
get_header();

get_template_part('partials/header_menu'); 

global $revelance_options;

?>
	<section class="page_main_section">
		<div class="container">

			<h1 class="main_title"><span>FROM THE BLOG</span></h1>

			<div class="row">

				<div class="span8 content_with_right_sidebar">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); 
						$custom = get_post_custom(); 
						?>
						<div class="post_content">
								<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

								<div class="post_meta">
									<span class="post_date"><i class="entypo-clock"></i><?php the_date();?></span>
									<span class="post_tags"><i class="entypo-folder"></i><?php the_tags();?></span>
									<span class="post_author"><i class="entypo-user"></i>By <?php the_author();?></span>
								</div>

								<?php

								if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
									echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
								}
								elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
									echo '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
								}
								elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
									echo '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
								}
								else{
									the_post_thumbnail();
								}
								?>
								<?php the_content();?>

								<?php wp_link_pages('before=<div id="inner_post_pagination" class="clearfix">&after=</div>&link_before=<span>&link_after=</span>'); ?>
								
						</div>
							
						
					<?php endwhile; 
					else: ?>
						<p><?php _e('No posts were found. Sorry!', 'ABdev_revelance'); ?></p>
					<?php endif; ?>
					
					<?php 
					if( isset($revelance_options['hide_comments']) && $revelance_options['hide_comments'] != '1'):?>
						<section id="comments_section" class="section_border_top">
							<?php comments_template('/partials/comments.php'); ?> 
						</section>
					<?php endif; ?>

				</div><!-- end span8 main-content -->
				
				<aside class="span4 sidebar sidebar_right">
					<?php 
					if(isset($custom['custom_sidebar'][0]) && $custom['custom_sidebar'][0]!=''){
						$selected_sidebar=$custom['custom_sidebar'][0];
					}
					else{
						$selected_sidebar=__( 'Primary Sidebar', 'ABdev_revelance');
					}
					dynamic_sidebar($selected_sidebar);
					?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

	<?php 
	if(isset($revelance_options['content_after_single_post']) && $revelance_options['content_after_single_post']!=''){
		echo do_shortcode($revelance_options['content_after_single_post']);
	}
	?>


<?php get_footer();