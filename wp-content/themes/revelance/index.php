<?php 

get_header();

get_template_part('partials/header_menu'); 

global $revelance_options;

$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id"); 
$read_more= __('Read More','ABdev_revelance');

global $ABdev_revelance_title_bar_title;

$ABdev_revelance_title_bar_title  = __('Blog','ABdev_revelance');

if(is_category()){
	$thisCat = get_category(get_query_var('cat'), false);
	$ABdev_revelance_title_bar_title = $thisCat -> name;
}
elseif(is_author()){
	$curauth = get_userdata(get_query_var('author'));
	$ABdev_revelance_title_bar_title = __('Posts by','ABdev_revelance') . ' ' . $curauth -> display_name;
}
elseif(is_tag()){
	$ABdev_revelance_title_bar_title = __('Posts Taged','ABdev_revelance').' '.get_query_var('tag');
}
elseif(is_month()){
	$month = '01-'.substr(get_query_var('m'), 4, 2).'-'.substr(get_query_var('m'), 0, 4);
	$ABdev_revelance_title_bar_title = __('Posts on ','ABdev_revelance').' '.date('M Y',strtotime($month));
}

get_template_part('partials/teaser_bar'); 

?>
	
	<section class="page_main_section">
		<div class="container">

			<h1 class="main_title"><span><?php echo $ABdev_revelance_title_bar_title;?></span></h1>


			<?php if(isset($cat_data['sidebar_position']) && ($cat_data['sidebar_position'] == 'masonry' || $cat_data['sidebar_position'] == 'masonry3')): 
				$i = 0;
			?>
				<?php 

				$column = array();
				$column[1]=$column[2]=$column[3]=$column[4]='';

				if (have_posts()) :  while (have_posts()) : the_post();
				 
					$i++;

					$column[$i] .= '<div class="blog_category_index_'.$cat_data['sidebar_position'].' '. implode(' ', get_post_class('grid_post, post_content')) .'">';
					
					$custom = get_post_custom();
					
						if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
							$column[$i].= '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
							$column[$i].= '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
							$column[$i].= '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
						}
						else{
							$column[$i].=get_the_post_thumbnail();
						}
			
						$column[$i] .= '<div class="post_main_inner_wrapper">
									<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
									<div class="grid_content">
										'.get_the_content('').'
									</div>
									<div class="post-readmore">
										<a href="'. get_permalink().'" class="more-link">'. __('Read More','ABdev_revelance').'</a>
									</div>
								</div>
							</div>';

						$i = (($cat_data['sidebar_position']=='masonry' && $i==4) || ($cat_data['sidebar_position']=='masonry3' && $i==3)) ? 0 : $i;
				endwhile; ?>

				<?php if($cat_data['sidebar_position']=='masonry3'): ?>
					<div id="grid_posts" class="clearfix row">
						<div class="span4"><?php echo $column[1]?></div>
						<div class="span4"><?php echo $column[2]?></div>
						<div class="span4"><?php echo $column[3]?></div>
					</div>

				<?php else:?>
					<div id="grid_posts" class="clearfix row">
						<div class="span3"><?php echo $column[1]?></div>
						<div class="span3"><?php echo $column[2]?></div>
						<div class="span3"><?php echo $column[3]?></div>
						<div class="span3"><?php echo $column[4]?></div>
					</div>

				<?php endif; ?>

				<?php else: ?>
					<p><?php _e('No posts were found. Sorry!', 'ABdev_revelance'); ?></p>
				<?php endif; ?>
				<?php get_template_part( 'partials/pagination' );?>
				</div>



		<?php else: ?>

			<div class="row">

				<div class="blog_category_index <?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='none')?'span12':'span8';?> <?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='left')?'content_with_left_sidebar':'content_with_right_sidebar';?>">
					<?php if (have_posts()) :  while (have_posts()) : the_post();?>
						<?php $custom = get_post_custom();?>
							<div <?php post_class('post_wrapper clearfix');?>>
								<div class="post_content">
									<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

									<div class="post_meta">
										<span class="post_date"><i class="entypo-clock"></i><?php echo get_the_date();?></span>
										<span class="post_tags"><i class="entypo-folder"></i><?php the_tags();?></span>
										<span class="post_author"><i class="entypo-user"></i><?php the_author();?></span>
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
									<?php the_content($read_more);?>
								</div>
							</div>
							
						
					<?php endwhile; 
					else: ?>
						<p><?php _e('No posts were found. Sorry!', 'ABdev_revelance');?></p>
					<?php endif;?>
					
					
				</div><!-- end span8 main-content -->
				
				<?php if (!isset($cat_data['sidebar_position']) || (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position'] != 'none')):?>
					<aside class="span4 sidebar <?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='left')?'sidebar_left':'sidebar_right';?>">
						<?php 
						if(isset($cat_data['sidebar']) && $cat_data['sidebar']!=''){
							$selected_sidebar=$cat_data['sidebar'];
						}
						else{
							$selected_sidebar=__( 'Primary Sidebar', 'ABdev_revelance');
						}
						dynamic_sidebar($selected_sidebar);
						?>
					</aside><!-- end span4 sidebar -->
				<?php endif;?>

			</div><!-- end row -->

			
		<?php get_template_part( 'partials/pagination' ); ?>

	<?php endif; ?>

		</div>
	</section>


	<?php 
	if(isset($revelance_options['content_after_category']) && $revelance_options['content_after_category']!=''){
		echo do_shortcode($revelance_options['content_after_category']);
	}
	?>


<?php get_footer();