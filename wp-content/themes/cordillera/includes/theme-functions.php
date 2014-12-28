<?php

 	/*	
	*	get background 
	*	---------------------------------------------------------------------
	*/
function cordillera_get_background($args){
$background = "";
 if (is_array($args)) {

if(isset($args['repeat']) && $args['repeat'] !='' )
$background .= 'background-repeat:'.esc_attr($args['repeat']) .';';
if(isset($args['attachment']) && $args['attachment'] !='' )
$background .= 'background-attachment:'. esc_attr($args['attachment']).';';
if(isset($args['position']) && $args['position'] !='' )
$background .= 'background-position:'.esc_attr($args['position']).';';
if(isset($args['image']) && $args['image'] !='' )
$background .= 'background-image:url('.esc_url( $args['image'] ) .'); ';
if(isset($args['color']) && $args['color'] !='' )
$background .= "background-color:".esc_attr($args['color']).";";
 }
return $background;
}

/*	
*	get background 
*	---------------------------------------------------------------------
*/
	
 function cordillera_get_banner($type = 1){
	 global $allowedposttags ;
	 $html = "";
    $banner_image_background = array(
		'color' => '',
		'image' => get_template_directory_uri().'/images/banner.jpg',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );
	 switch( $type ){
		 case 1:
		 $banner_image = cordillera_get_background(cordillera_options_array("banner_image",$banner_image_background));

		 $banner_text  = cordillera_options_array("banner_text",'<p style="text-align: center; color:#fff;">- WEB DEVELOPMENT - PHOTOGRAPHY - ICON DESIGN -</p>
<h1 style="text-align: center; color:#fff;">&#9733;<span class="highlight">CORDILLERA</span> THEME &#9733;</h1>
<h2 style="text-align: center; color:#fff;">Nice to Meet You</h2>');
		 $banner_image_content_padding = cordillera_options_array('banner_content_padding','140px 0');
			$content_padding = "";
			if( $banner_image_content_padding ){
			$content_padding = "padding:".$banner_image_content_padding;	
				}
	
			
		 $html  = '<section class="top-banner top-banner-image" style="'.$banner_image.'"><div class="top-banner-caption" style="'.$content_padding.'">'.wp_kses( $banner_text, $allowedposttags  ).'</div></section>';
		 break;
		 }
		 return $html;
	 }

	
		
	// get breadcrumbs
 function cordillera_get_breadcrumb(){
   global $post,$wp_query ;
    $postid = isset($post->ID)?$post->ID:"";
	
   $show_breadcrumb = "";
   if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) { 
    $postid = $wp_query->get_queried_object_id();
   }
  
   if(isset($postid) && is_numeric($postid)){
    $show_breadcrumb = get_post_meta( $postid, '_cordillera_show_breadcrumb', true );
	}
	if($show_breadcrumb == 'yes' || $show_breadcrumb==""){

  echo '<div class="container">';
  if ( is_singular() ) {
	
  echo '<div class="breadcrumb-title">'.$post->post_title.'</div>';
  }
  echo '<div class="breadcrumb-nav">'; 
               breadcrumb_trail(array("before"=>"","show_browse"=>false,"separator"=>'<i class="fa fa-angle-double-right"></i>'));
      echo '</div>    
                <div class="clearfix"></div>            
            </div>';
           
	}
	   
	}
	
	
/*
*  page navigation
*
*/
function cordillera_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => '&laquo; ',
    'next_text' => ' &raquo;'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<div class="page_navi">'.paginate_links($pagination).'</div>'; 
	}else
	{
	
	return '<div class="page_navi">'.paginate_links($pagination).'</div>';
	}
}
   
    //// Custom comments list
   
   function cordillera_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   
   <li  <?php comment_class("comment"); ?> id="comment-<?php comment_ID() ;?>">
                                	<article class="comment-body">
                                    	<div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
                                        <div class="comment-box">
                                            <div class="comment-info"><?php printf(__('%s <span class="says">says:</span>','cordillera'), get_comment_author_link()) ;?> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','cordillera'), get_comment_date(), get_comment_time()) ;?></a>  <?php edit_comment_link(__('(Edit)','cordillera'),'  ','') ;?></div>

 <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','cordillera') ;?></em>
         <br />
      <?php endif; ?>
     <div class="comment-content"><?php comment_text() ;?>
      <div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
       </div>
    </div></article>

<?php
        }
		
	
add_action( 'optionsframework_sidebar','cordillera_options_panel_sidebar' );

/**
 * cordillera admin sidebar
 */
function cordillera_options_panel_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="postbox">
	    		<h3><?php esc_attr_e( 'Quick Links', 'cordillera' ); ?></h3>
      			<div class="inside"> 
		          <ul>
                   <li><a href="<?php echo esc_url( 'http://www.mageewp.com/cordillera-theme.html' ); ?>" target="_blank"><?php _e('About Cordillera','cordillera');?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/themes/' ); ?>" target="_blank"><?php _e('MageeWP Themes','cordillera');?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/documents/tutorials' ); ?>" target="_blank"><?php _e('Tutorials','cordillera');?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/documents/faq/' ); ?>" target="_blank"><?php _e('FAQ','cordillera');?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/knowledges/' ); ?>" target="_blank"><?php _e('Knowledge','cordillera');?></a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/forums/cordillera-theme/' ); ?>" target="_blank"><?php _e('Support Forums','cordillera');?></a></li>
                  </ul>
      			</div>
	    	</div>
	  	</div>
	</div>
    <div class="clear"></div>
<?php
} 
 
 function cordillera_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( ' Page %s ', 'cordillera' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'cordillera_wp_title', 10, 2 );


  function cordillera_title( $title ) {
  if ( $title == '' ) {
  return 'Untitled';
  } else {
  return $title;
  }
  }
  add_filter( 'the_title', 'cordillera_title' );


 function cordillera_favicon()
	{
	    $url =  cordillera_options_array('favicon');
	
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}
 add_action( 'wp_head', 'cordillera_favicon' );
	
/**
 * Cordillera widget area generator
 */

function cordillera_widget_area_generator($args = array(),$echo = true){
	
	$column            = isset($_POST['column'])?$_POST['column']:1;
	$num               = isset($_POST['num'])?$_POST['num']:0;
	$areaname          = isset($_POST['areaname'])?$_POST['areaname']:0;
	$column_items      = array();
	for($i=0; $i<$column; $i++){
		$column_items[] = 12/$column; 
		}
	$defaults = array("areaname" => $areaname,
							 "color" => '',
							 "image" => '',
							 "repeat" => '',
							 "position" => '',
							 "attachment" => '',
							 "layout" => '',
							 "column" => $column,
							 "columns" => $column_items,
							 "num"     => $num,
							 "padding" => 50
							 );

	$args = wp_parse_args( $args, $defaults );
	$sanitize_areaname = sanitize_title($args['areaname']);

	       $image_show = $args['image']==''?'':'<img src="'.$args['image'].'"><a class="remove-image">'.__("Remove","cordillera").'</a>';
		   if($args['image']==''){
			   $button = '<input type="button" value="Upload" class="upload-button button" id="upload-list-item-image-'.$args['num'].'">';
		   }else{
			   $button = '<input type="button" value="Remove" class="remove-file  button" id="upload-list-item-image-'.$args['num'].'">';
			   }
		   
		   
	// Background Color
	            $output  = '<div class="list-item section">';
				$output .= '<div class="section-widget-area-name"><span class="widget-area-name">'.$args['areaname'].'</span><span><a href="javascript:;" class="edit-section">'.__("Edit","cordillera").'</a> | <a href="javascript:;" data-href="javascript:;" data-toggle="confirmation" class="remove-section ">'.__("Remove","cordillera").'</a></span></div>';
				$output .= '<input type="hidden" name="widget-area[section-widget-area-name][]" class="section-widget-area-name-item" id="section-widget-area-name-'.$args['num'].'" value="'.$args['areaname'].'" />';
				$output .= '<input type="hidden" class="section-widget-sanitize-areaname" value="'.$sanitize_areaname.'" />';
				
				$output .= '<div class="section-widget-area-wrapper">';
				$output .= '<div class="section section-color section-widget-area-background" id="section-widget-area-background-'.$args['num'].'"><label>'. __("Background","cordillera").':</label>
  <div class="wp-picker-container"><span class="wp-picker-input-wrap">
    <input type="text" value="'.$args['color'].'" class="of-color of-background-color wp-color-picker" id="list-item-color-'.$args['num'].'"  name="widget-area[list-item-color][]" style="display: none;">
    <input type="button" class="button button-small hidden wp-picker-clear" value="Clear">
    </span>
    <div class="wp-picker-holder">
      <div class="iris-picker iris-mozilla iris-border" style="display: none; width: 255px; height: 202.125px; padding-bottom: 23.2209px;">
        <div class="iris-picker-inner">
          <div class="iris-square" style="width: 182.125px; height: 182.125px;"><a href="#" class="iris-square-value ui-draggable" style="left: 0px; top: 182.133px;"><span class="iris-square-handle ui-slider-handle"></span></a>
            <div class="iris-square-inner iris-square-horiz" style="background-image: -moz-linear-gradient(left center , rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255));"></div>
            <div class="iris-square-inner iris-square-vert" style="background-image: -moz-linear-gradient(center top , transparent, rgb(0, 0, 0));"></div>
          </div>
          <div class="iris-slider iris-strip" style="width: 28.2px; height: 205.346px; background-image: -moz-linear-gradient(center top , rgb(0, 0, 0), rgb(0, 0, 0));">
            <div class="iris-slider-offset ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="bottom: 0%;"></a></div>
          </div>
        </div>
        <div class="iris-palette-container"><a tabindex="0" class="iris-palette" style="background-color: rgb(0, 0, 0); width: 19.5784px; height: 19.5784px; margin-left: 0px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(255, 255, 255); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(221, 51, 51); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(221, 153, 51); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(238, 238, 34); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(129, 215, 66); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(30, 115, 190); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a><a tabindex="0" class="iris-palette" style="background-color: rgb(130, 36, 227); width: 19.5784px; height: 19.5784px; margin-left: 3.6425px;"></a></div>
      </div>
    </div>
  </div>
  <input type="text" placeholder="'. __("No file chosen","cordillera").'" value="'.$args['image'].'" name="widget-area[list-item-image][]" class="upload" id="list-item-image-'.$args['num'].'">
  '.$button.'
  <div id="list-item-image-'.$args['num'].'-image" class="screenshot">'.$image_show.'</div>
  <div class="of-background-properties">
    <select id="list-item-repeat-'.$args['num'].'" name="widget-area[list-item-repeat][]" class="of-background of-background-repeat">
      <option '.($args['repeat'] == 'no-repeat'?'selected="selected"':'').' value="no-repeat">No Repeat</option>
      <option '.($args['repeat'] == 'repeat-x'?'selected="selected"':'').' value="repeat-x">Repeat Horizontally</option>
      <option '.($args['repeat'] == 'repeat-y'?'selected="selected"':'').' value="repeat-y">Repeat Vertically</option>
      <option '.($args['repeat'] == 'repeat'?'selected="selected"':'').' value="repeat">Repeat All</option>
    </select>
    <select id="list-item-position-'.$args['num'].'" name="widget-area[list-item-position][]" class="of-background of-background-position">
      <option '.($args['position'] == 'top left'?'selected="selected"':'').' value="top left">Top Left</option>
      <option '.($args['position'] == 'top center'?'selected="selected"':'').' value="top center">Top Center</option>
      <option '.($args['position'] == 'top right'?'selected="selected"':'').' value="top right">Top Right</option>
      <option '.($args['position'] == 'center left'?'selected="selected"':'').' value="center left">Middle Left</option>
      <option '.($args['position'] == 'center center'?'selected="selected"':'').' value="center center">Middle Center</option>
      <option '.($args['position'] == 'center right'?'selected="selected"':'').' value="center right">Middle Right</option>
      <option '.($args['position'] == 'bottom left'?'selected="selected"':'').' value="bottom left">Bottom Left</option>
      <option '.($args['position'] == 'bottom center'?'selected="selected"':'').' value="bottom center">Bottom Center</option>
      <option '.($args['position'] == 'bottom right'?'selected="selected"':'').' value="bottom right">Bottom Right</option>
    </select>
    <select id="list-item-attachment-'.$args['num'].'" name="widget-area[list-item-attachment][]" class="of-background of-background-attachment">
      <option  '.($args['attachment'] == 'scroll'?'selected="selected"':'').'value="scroll">Scroll Normally</option>
      <option '.($args['attachment'] == 'fixed'?'selected="selected"':'').' value="fixed">Fixed in Place</option>
    </select>
  </div>
</div>';

				
				/////widget secton layout
		$output .= '<div id="section-widget-area-layout-'.$args['num'].'" class="section section-layout">';
		$output .= '<label> '.__("Layout","cordillera").' :</label><select name="widget-area[widget-area-layout][]" id="widget-area-layout-'.$args['num'].'">
			    	<option '.($args['layout'] == 'boxed'?'selected="selected"':'').' value="boxed">'.__("boxed","cordillera").'</option>
				    <option '.($args['layout'] == 'full'?'selected="selected"':'').' value="full">'.__("full width","cordillera").'</option></select>';
				
		$output .= '</div>';
		
		$output .= '<div id="section-widget-area-padding-'.$args['num'].'" class="section section-padding">';
		$output .= '<label> '.__("Padding top & bottom","cordillera").' :</label>';
		$output .= '<input style=" width:50%;" type="text" value="'.$args['padding'].'" name="widget-area[widget-area-padding][]" id="widget-area-padding-'.$args['num'].'"> px';
		$output .= '</div>';
		
				/////widget secton column
		$output .= '<div id="section-widget-area-column-'.$args['num'].'" class="section section-column">';
		$output .= '<label> '.__("Column","cordillera").' :</label><select class="widget-area-column" name="widget-area[widget-area-column][]" id="widget-area-column-'.$args['num'].'">
			        <option value="1">'.__("choose column","cordillera").'</option>';
					for($j=1;$j<=4;$j++){
						$selected   = "";
						$column_n   = __("columns","cordillera");
						if($j == $args['column']){$selected = " selected='selected' ";}
						if($j == 1){$column_n = __("column","cordillera");}
						
			    	    $output .= '<option value="'.$j.'" '.$selected.'>'.$j.' '.$column_n.'</option>';
				   
					}
					
		$output .= '</select>';
				/////widget secton column items
		$output .= '<div class="widget-secton-column">';
				if(count($args['columns']) > 1){
					$j = 1 ;
					foreach($args['columns'] as $c){
						
			        $output .= '<label> '.sprintf(__("Column %s width","cordillera"),$j).' :</label><select class="widget-area-column-item" name="widget-area[widget-area-column-item]['.$sanitize_areaname.'][]" id="widget-area-column-item-'.$j.'">';
			        
					for($k=1;$k<=12;$k++){
					$selected   = "";
					if($c == $k){$selected = ' selected="selected" ';}
			    	$output .= '<option value="'.$k.'" '.$selected.'>'.$k.'/12</option>';
				   
					}
					
		$output .= '</select>';
		$j++;
					  }
					}
		$output .= '</div>';
				/////
		$output .= '</div>';
				//				
		$output .= '</div>';
		$output .= '</div>';
				if($echo == true){
				    echo $output ;
				    exit(0);
				}else{
					return $output ;
					}
	
	}
    add_action('wp_ajax_cordillera_widget_area_generator', 'cordillera_widget_area_generator');
	add_action('wp_ajax_nopriv_cordillera_widget_area_generator', 'cordillera_widget_area_generator');