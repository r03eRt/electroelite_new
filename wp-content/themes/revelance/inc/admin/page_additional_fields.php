<?php  
$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;

$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

if ( ! function_exists( 'ABdev_showhide_metabox_script_enqueuer' ) ){
function ABdev_showhide_metabox_script_enqueuer() {
	global $current_screen;
	if('page' != $current_screen->id){
		return;
	}

	echo <<<HTML
		<script type="text/javascript">
		jQuery(document).ready( function($) {
			if($('#page_template').val() == 'page-front-page-revolution.php' || $('#page_template').val() == 'page-front-page-revolution-small.php' ) {
				$('#front-page-metabox-options').show();
			} else {
				$('#front-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-front-page-revolution.php' || $(this).val() == 'page-front-page-revolution-small.php') {
					$('#front-page-metabox-options').show();
				} else {
					$('#front-page-metabox-options').hide();
				}
			}); 

			if($('#page_template').val() == 'page-portfolio.php') {
				$('#portfolio-page-metabox-options').show();
			} else {
				$('#portfolio-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-portfolio.php') {
					$('#portfolio-page-metabox-options').show();
				} else {
					$('#portfolio-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'default' || $('#page_template').val() == 'page-left-sidebar.php') {
				$('#sidebar-page-metabox-options').show();
			} else {
				$('#sidebar-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'default' || $(this).val() == 'page-left-sidebar.php') {
					$('#sidebar-page-metabox-options').show();
				} else {
					$('#sidebar-page-metabox-options').hide();
				}
			});                 
			
		});    
		</script>
HTML;
}
}
add_action('admin_head', 'ABdev_showhide_metabox_script_enqueuer');

if ( ! function_exists( 'ABdevFW_add_meta_box' ) ){
	function ABdevFW_add_meta_box(){  
		add_meta_box( 'front-page-metabox-options', __('Frontpage options', 'ABdev_revelance' ), 'ABdevFW_construct_frontpage_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'portfolio-page-metabox-options', __('Display categories', 'ABdev_revelance' ), 'ABdevFW_construct_portfolio_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'sidebar-page-metabox-options', __('Select Sidebar', 'ABdev_revelance' ), 'ABdevFW_construct_sidebar_meta_box', 'page', 'normal', 'high' );  
	}
}
add_action( 'add_meta_boxes', 'ABdevFW_add_meta_box' );  



if ( ! function_exists( 'ABdevFW_construct_sidebar_meta_box' ) ){
	function ABdevFW_construct_sidebar_meta_box( $post ){ 
		global $revelance_options;
		$revelance_user_sidebars = isset($revelance_options['sidebars'])?$revelance_options['sidebars'] : '';
		$values = get_post_custom( $post->ID );
		$custom_sidebar = (isset($values['custom_sidebar'][0])) ? $values['custom_sidebar'][0] : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<select name="custom_sidebar" id="custom_sidebar">  
					<option value=""><?php _e('Default', 'ABdev_revelance') ?></option> ';
				<?php foreach ($revelance_user_sidebars as $sidebar) {
					echo '<option value="'.$sidebar.'" '. selected( $custom_sidebar, $sidebar, false ) . '>' . $sidebar . '</option> ';
				}
				?>
			</select>  
		</p>
		<?php
	}
}

if ( ! function_exists( 'ABdevFW_save_sidebar_meta_box' ) ){
	function ABdevFW_save_sidebar_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['custom_sidebar'] ) || !wp_verify_nonce( $_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['custom_sidebar'] ) ){
			update_post_meta( $post_id, 'custom_sidebar', wp_kses( $_POST['custom_sidebar'] ,'') );  
		}
	}
}
if ($template_file == 'page.php' || $template_file == 'page-left-sidebar.php'){
	add_action( 'save_post', 'ABdevFW_save_sidebar_meta_box' );  
}



if ( ! function_exists( 'ABdevFW_construct_portfolio_meta_box' ) ){
	function ABdevFW_construct_portfolio_meta_box( $post ){ 
		$tax_terms = get_terms('portfolio-category');
		if(is_array($tax_terms)){
			foreach ($tax_terms as $tax_term) {
				$slugs[] = $tax_term->slug;
			}
			$values = get_post_custom( $post->ID ); 
			$categories = isset( $values['categories'] ) ? esc_attr( $values['categories'][0] ) : '';
			$categories = explode(',',$categories);
			if(empty($categories[0])){
				$categories=$slugs;
			}
			wp_nonce_field( 'my_meta_box_portfolio_nonce', 'meta_box_portfolio_nonce' );
			?>  
			<p>
				<?php
				foreach ($tax_terms as $tax_term) {
					echo '<label for="categories['.$tax_term->slug.']"><input type="checkbox" id="categories['.$tax_term->slug.']" name="categories['.$tax_term->slug.']" value="'.$tax_term->slug.'" '; 
					if(in_array($tax_term->slug , $categories)){
						echo 'checked';
					}
					echo'> '.$tax_term->name .' ('.$tax_term->count.')</label><br>';
				}
				?>
			</p><?php
		}
		else{
			_e('Portfolio plugin must be installed and at least one portfolio category created', 'ABdev_revelance');
		}
	}
}

if ( ! function_exists( 'ABdevFW_save_portfolio_meta_box' ) ){
	function ABdevFW_save_portfolio_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['categories'] ) || !wp_verify_nonce( $_POST['meta_box_portfolio_nonce'], 'my_meta_box_portfolio_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['categories'] ) ){
			$categories=implode(',',$_POST['categories']);
			update_post_meta( $post_id, 'categories', wp_kses( $categories ,'') );  
		}
	}
}
if ($template_file == 'page-portfolio.php'){
	add_action( 'save_post', 'ABdevFW_save_portfolio_meta_box' );  
}





if ( ! function_exists( 'ABdevFW_construct_frontpage_meta_box' ) ){
	function ABdevFW_construct_frontpage_meta_box( $post ){  
		$values = get_post_custom( $post->ID );  
		$revslider_alias = isset( $values['revslider_alias'] ) ? esc_attr( $values['revslider_alias'][0] ) : ''; 
		
		// We'll use this nonce field later on when saving.  
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>  
		
		<div id='revslider_options'>
			<h4><?php _e('Revolution Slider Options', 'ABdev_revelance' ); ?></h4>
			<?php 
			if(class_exists('RevSlider')){
				$slider = new RevSlider();
				$arrSliders = $slider->getArrSlidersShort();
						
				if(empty($arrSliders)){
					_e('No sliders found, Please create a slider', 'ABdev_revelance');
				}
				else{
					$select = UniteFunctionsRev::getHTMLSelect($arrSliders,$revslider_alias,'name="revslider_alias" id="revslider_alias"',true);
					?>
					<p>
					<label for="revslider_alias"><?php _e('Choose Slider', 'ABdev_revelance' ); ?></label> 
					<?php echo $select; ?>
					</p>
					<?php
				}
			}
			else{
				_e('Slider Revolution plugin not installed', 'ABdev_revelance');
			}
				?>
		</div>
		<?php
	}
}
if ( ! function_exists( 'ABdevFW_save_frontpage_meta_box' ) ){
	function ABdevFW_save_frontpage_meta_box( $post_id ){  
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		// if our nonce isn't there, or we can't verify it, bail 
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) {
			return; 
		}
		// if our current user can't edit this post, bail  
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		// now we can actually save the data  
		
		if( isset( $_POST['revslider_alias'] ) )  {
			update_post_meta( $post_id, 'revslider_alias', esc_attr( $_POST['revslider_alias'] ) ); 
		}
	}
}
if ($template_file == 'page-front-page-revolution.php' || $template_file == 'page-front-page-revolution-small.php'){
	add_action( 'save_post', 'ABdevFW_save_frontpage_meta_box' );  
}
