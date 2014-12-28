<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */

 function optionsframework_option_name() {

   $themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Background Defaults
	$page_background = array(
		'color' => '',
		'image' => '',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );

	$options      = array();
	$social_icons = array('fa fa-facebook'=>'facebook',
						  'fa fa-twitter'=>'twitter',
						  'fa fa-youtube'=>'youtube',
						  'fa fa-google-plus'=>'google plus',
						  'fa fa-flickr'=>'flickr',
						  'fa fa-linkedin'=>'linkedin',
						  'fa fa-pinterest'=>'pinterest',
						  'fa fa-tumblr'=>'tumblr',
						  'fa fa-digg'=>'digg',
						  'fa fa-rss'=>'rss',
						 
						  );
   // General
	$options[] = array(
		'name' => __('General Options', 'cordillera'),
		'type' => 'heading');

	
		
	$options[] = array(
		'name' => __('Favicon', 'cordillera'),
		'desc' => sprintf(__('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="%s" target="_blank">Favicon</a>', 'cordillera'),esc_url("http://en.wikipedia.org/wiki/Favicon")),
		'id' => 'favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Global Color', 'cordillera'),
		'id' => 'global_color',
		'std' => '#19cbcf',
		'type' => 'color');
	
	$options[] = array(
		'name' => __('404 Page Content', 'cordillera'),
		'id' => 'page_404_content',
		'std' => '<i class="fa fa-frown-o"></i>
		<p><strong>OOPS!</strong> Can\'t find the page.</p>',
		'type' => 'editor');
		
	$options[] = array(
		'name' => __('Custom CSS', 'cordillera'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'cordillera'),
		'id' => 'custom_css',
		'std' => '.top-banner-caption h1 {
	font-size: 8em;
}

.top-banner-caption h2 {
	font-size: 5em;
}

@media screen and (max-width: 1024px) {
	.top-banner-caption h1 {
		font-size: 6em;
	}
	.top-banner-caption h2 {
		font-size: 4em;
	}
}

@media screen and (max-width: 768px) {
	.top-banner-caption {
		margin-top: 100px;
	}
	.top-banner-caption h1 {
		font-size: 5em;
	}
	.top-banner-caption h2 {
		font-size: 3em;
	}
}

@media screen and (max-width: 640px) {
	.top-banner-caption h1 {
		font-size: 4em;
	}
	.top-banner-caption h2 {
		font-size: 2em;
	}
}
',
		'type' => 'textarea');

        // Home Page
	    $options[] = array(
		'name' => __('Home Page', 'cordillera'),
		'type' => 'heading');
		
		 $options[] = array(
		'name' => __('Enable Featured Homepage', 'cordillera'),
		'desc' => sprintf(__('Active featured homepage Layout. All sections in the homepage are <a href="%s">widget areas</a>.', 'cordillera'),admin_url("widgets.php")),
		'id' => 'enable_home_page',
		'std' => '0',
		'type' => 'checkbox');
		
		$options[] = array('name' => __('Banner', 'cordillera'),'id' => 'banner_title','type' => 'title');
		
		$options[] = array('name' => __('Image Banner', 'cordillera'),'id' => 'image_banner_group_start','type' => 'start_group','class'=>'group_close');
		
		$banner_image_background = array(
		'color' => '',
		'image' => get_template_directory_uri().'/images/banner.jpg',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );
		
		$options[] = array('name' => __('Background Image', 'cordillera'),'id' => 'banner_image', 'std' =>$banner_image_background  ,'desc'=>'','type' => 'background');
		$options[] = array('name' => __('Text', 'cordillera'),'id' => 'banner_text',	'std' => '<p style="text-align: center; color:#fff;">- WEB DEVELOPMENT - PHOTOGRAPHY - ICON DESIGN -</p>
<h1 style="text-align: center; color:#fff;">&#9733;<span class="highlight">CORDILLERA</span> THEME &#9733;</h1>
<h2 style="text-align: center; color:#fff;">Nice to Meet You</h2>','type' => 'editor');
		$options[] = array('name' => __('Content Padding', 'cordillera'),'id' => 'banner_content_padding', 'std' => '140px 0','type' => 'text');
		$options[] = array('name' => '','id' => 'image_banner_group_end','type' => 'end_group');
		
	
			
	    $options[] = array(
		"name" => __('Home Page Banner', 'cordillera'),
		"id" => "home_banner_type",
		"std" => "1",
		"type" => "select",
		"class" => "mini",
		"options" => array('0'=>__('No Banner', 'cordillera'),
						   '1'=>__('Image', 'cordillera')
           ) );
		
		 

		
		 $options[] = array(
		'name' => __('NOTE:', 'cordillera'),
		'desc' => sprintf(__('All sections in the homepage are widgets, so, go to Appearance-><a href="%s">Widgets</a> to set the sections content.', 'cordillera'),admin_url("widgets.php")),
		'type' => 'info');
		
		$options[] = array(
		'name' => __('Home Page Sections', 'cordillera'),
		'id' => 'home_page_sections',
		'std' => '{"section-widget-area-name":["Home Page Section One","Home Page Section Two","Home Page Section Three","Home Page Section Four","Home Page Section Five","Home Page Section Six"],"list-item-color":["","#eee","","","",""],"list-item-image":["","","","","",""],"list-item-repeat":["","","","","",""],"list-item-position":["","","","","",""],"list-item-attachment":["","","","","",""],"widget-area-padding":["50","50","50","50","50","50"],"widget-area-layout":["boxed","full","full","boxed","full","boxed"],"widget-area-column":["4","1","1","1","1","1"],"widget-area-column-item":{"home-page-section-one":["3","3","3","3"],"home-page-section-two":["12"],"home-page-section-three":["12"],"home-page-section-four":["12"],"home-page-section-five":["12"],"home-page-section-six":["12"]}}',
		'type' => 'widget-area');
		
		
		// HEADER
		 $options[] = array(
		'name' => __('Header', 'cordillera'),
		'type' => 'heading');
		 
		$options[] = array(
		'name' => __('Upload Logo', 'cordillera'),
		'id' => 'logo',
		'std' => '',
		'type' => 'upload');
		
		
		// FOOTER
	    $options[] = array(
		'name' => __('Footer', 'cordillera'),
		'type' => 'heading');
	
        $options[] = array(
		'name' => __('Enable Footer Widget Area', 'cordillera'),
		'desc' => '',
		'id' => 'enable_footer_widget_area',
		'std' => '0',
		'type' => 'checkbox');
		
		
		
		

		
		//END HOME PAGE SLIDER
		
	return $options;
}

