<?php 
global $revelance_options;
?>
	<footer id="abdev_main_footer">
		<div class="container">
			
			<?php if(isset($revelance_options['hide_back_to_top']) && $revelance_options['hide_back_to_top']!=1): ?>
				<a href="#" id="abdev_back_to_top" title="<?php _e('Back to top', 'ABdev_revelance'); ?>"><i class="entypo-arrow-up7"></i></a>
			<?php endif; ?>

			<?php if(isset($revelance_options['punchline']) && $revelance_options['punchline']!=''): ?>
				<div id="footer_punchline">
					<?php echo do_shortcode($revelance_options['punchline']); ?>	 
				</div>
			<?php endif; ?>
			
			<?php if(isset($revelance_options['copyright']) && $revelance_options['copyright']!=''): ?>
				<div id="footer_copyright">
					<?php echo do_shortcode($revelance_options['copyright']); ?>	 
				</div>
			<?php endif; ?>

		</div>
	</footer>



	<?php echo (isset($revelance_options['analytics_code'])) ? $revelance_options['analytics_code'] : ''; ?>

	<?php 
	if(isset($revelance_options['show_demo_style_selector']) && $revelance_options['show_demo_style_selector']==1){
		get_template_part('partials/demo_style_selector');
	}
	?>

	<?php wp_footer(); ?>
	
</body>
</html>