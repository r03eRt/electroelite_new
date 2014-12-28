<?php
/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 


if ( !class_exists( "Revelance_Redux_Framework_config" ) ) {
	class Revelance_Redux_Framework_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {
			$this->theme = wp_get_theme();
			$this->setArguments();
			$this->setSections();
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}


		/**
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 **/
		public function setArguments() {
			$theme = wp_get_theme(); // For use with some settings. Not necessary.
			$this->args = array(
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'revelance_options', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Revelance', 'redux-framework-demo' ),
	            'page'		 	 		=> __( 'Revelance Options', 'redux-framework-demo' ),
	            'google_api_key'   	 	=> '', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> true, // Enable basic customizer support
	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *
	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tab'            => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            'footer_credit'      	=> ' ', // Disable the footer credit of Redux. Please leave if you can help it.
	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            'allow_tracking'        => false, // REMOVE
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);
			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			$this->args['share_icons'][] = array(
			    'url' => 'http://themeforest.net/user/ABdev',
			    'title' => 'Visit us on TeamForest', 
			    'icon' => 'el-icon-leaf'
			    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);		
			$this->args['share_icons'][] = array(
			    'url' => 'http://twitter.com/ABdevelop',
			    'title' => 'Follow us on Twitter', 
			    'icon' => 'el-icon-twitter'
			);
		}


		/**
			Sections and fields declaration
		 **/
		public function setSections() {

			$this->sections[] = array(
				'title' => __('General', 'ABdev_revelance'),
				'icon' => 'el-icon-cogs',
				'fields' => array(
					array(
						'id'          => 'disable_responsiveness',
						'title'       => __('Disable Responsiveness', 'ABdev_revelance'),
						'desc'        => '',
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'favicon',
						'title'       => __('Favicon', 'ABdev_revelance'),
						'desc'        => '',
						'type'        => 'media',
					),
					array(
						'id'          => 'hide_comments',
						'title'       => __('Hide Comments', 'ABdev_revelance'),
						'desc'        => __('Check this to hide WordPress commenting system', 'ABdev_revelance'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'enable_preloader',
						'title'       => __('Use Preloader', 'ABdev_revelance'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'custom_css',
						'title'       => __('Custom CSS', 'ABdev_revelance'),
						'desc'        => __('Here you can place additional CSS or CSS to override theme\'s styles', 'ABdev_revelance'),
						'type'        => 'textarea',
						'validate' => 'css',
						'type' => 'ace_editor',
						'mode' => 'css',
			            'theme' => 'monokai',
					),
					array(
						'id'          => 'analytics_code',
						'title'       => __('Analytics Code', 'ABdev_revelance'),
						'desc'        => __('Here you can paste Google Analytics (or similar, html valid) code to be printed out on every page just before closing body tag', 'ABdev_revelance'),
						'type'        => 'textarea',
						'type' => 'ace_editor',
						'mode' => 'javascript',
			            'theme' => 'monokai',
					),
					array(
						'id'          => 'show_demo_style_selector',
						'title'       => __('Show Demo Style Selector', 'ABdev_revelance'),
						'desc'        => __('This is used for theme demo purpose', 'ABdev_revelance'),
						'type'        => 'checkbox',
					),
				)
			);


			$this->sections[] = array(
				'title' => __('Header', 'ABdev_revelance'),
				'icon' => 'el-icon-credit-card',
				'fields' => array(
					array(
						'id'          => 'header_logo',
						'title'       => __('Header Logo', 'ABdev_revelance'),
						'desc'        => __('Upload header logo', 'ABdev_revelance'),
						'type'        => 'media',
					),
					array(
						'id'          => 'inversed_header_logo',
						'title'       => __('Inversed Header Logo', 'ABdev_revelance'),
						'desc'        => __('Upload inversed header logo, to use over slider', 'ABdev_revelance'),
						'type'        => 'media',
					),
					array(
						'id'          => 'facebook',
						'title'       => __('Facebook URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'twitter',
						'title'       => __('Twitter URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'googleplus',
						'title'       => __('Googleplus URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'linkedin',
						'title'       => __('Linkedin URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'pinterest',
						'title'       => __('Pinterest URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'github',
						'title'       => __('Github URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'feed',
						'title'       => __('Feed URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'behance',
						'title'       => __('Behance URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'dribbble',
						'title'       => __('Dribbble URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'dropbox',
						'title'       => __('Dropbox URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'mail',
						'title'       => __('Mail URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'flickr',
						'title'       => __('Flickr URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'instagram',
						'title'       => __('Instagram URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'lastfm',
						'title'       => __('Lastfm URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'picasa',
						'title'       => __('Picasa URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'skype',
						'title'       => __('Skype URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'stumbleupon',
						'title'       => __('Stumbleupon URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'vimeo',
						'title'       => __('Vimeo URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'youtube',
						'title'       => __('YouTube URL', 'ABdev_revelance'),
						'type'        => 'text',
					),
				)
			);


			$this->sections[] = array(
				'title' => __('Icons', 'ABdev_jomelle'),
				'icon' => 'el-icon-picture',
				'fields' => array(
					array(
						'id'          => 'icon_font_info',
						'title'       => __("Complete theme's icons names list", 'ABdev_jomelle'),
						'desc'       => __('<br>Icon list with all icons and their names can be found <a href="'.get_bloginfo('template_directory').'/css/core_icons/demo.html" target="_blank">here</a>.', 'ABdev_jomelle'),
						'type'        => 'info',
						'style'        => 'info',
					),
				)
			);



			$this->sections[] = array(
				'title' => __('Sidebars', 'ABdev_revelance'),
				'icon' => 'el-icon-lines',
				'fields' => array(
					array(
						'id'          => 'sidebars',
						'title'       => 'Sidebars',
						'desc'        => __('Add as many custom sidebars as you need', 'ABdev_revelance'),
						'type' => 'multi_text',
					)
				)
			);




			$this->sections[] = array(
				'title' => __('Colors', 'ABdev_revelance'),
				'icon' => 'el-icon-brush',
				'fields' => array(
					array(
						'id'          => 'main_color',
						'title'       => __('Main Color', 'ABdev_revelance'),
						'default' => '#e42382',
						'type' => 'color',
						'validate' => 'color'
					),
					array(
						'id'          => 'dark_scheme',
						'title'       => __('Dark Scheme', 'ABdev_revelance'),
						'type'        => 'checkbox',
					),
					array(
						'id'=>'presets',
						'type' => 'image_select', 
						'presets' => true,
						'title' => __('Preset Colors', 'ABdev_revelance'),
						'default' 		=> 0,
						'desc'=> __('Load some of our preset colors', 'ABdev_revelance'),
						'options' => array(
							'1' => array('alt' => '#e42382', 'img' => IMAGES.'/presets/e42382.png', 'presets'=>array('main_color'=>"#e42382")),
							'2' => array('alt' => '#1bbc9b', 'img' => IMAGES.'/presets/1bbc9b.png', 'presets'=>array('main_color'=>"#1bbc9b")),
							'3' => array('alt' => '#9b58b5', 'img' => IMAGES.'/presets/9b58b5.png', 'presets'=>array('main_color'=>"#9b58b5")),
							'4' => array('alt' => '#93af49', 'img' => IMAGES.'/presets/93af49.png', 'presets'=>array('main_color'=>"#93af49")),
							'5' => array('alt' => '#3598db', 'img' => IMAGES.'/presets/3598db.png', 'presets'=>array('main_color'=>"#3598db")),
							'6' => array('alt' => '#e77e23', 'img' => IMAGES.'/presets/e77e23.png', 'presets'=>array('main_color'=>"#e77e23")),
							'7' => array('alt' => '#ffd800', 'img' => IMAGES.'/presets/ffd800.png', 'presets'=>array('main_color'=>"#ffd800")),
							'8' => array('alt' => '#c94646', 'img' => IMAGES.'/presets/c94646.png', 'presets'=>array('main_color'=>"#c94646")),
						),
					),
				)
			);

			$this->sections[] = array(
				'title' => __('Blog', 'ABdev_revelance'),
				'icon' => 'el-icon-pencil',
				'fields' => array(
					array(
						'id'          => 'content_after_category',
						'title'       => __('Additional Content After Category', 'ABdev_revelance'),
						'desc'        => __('Enter content to be shown at the bottom of blog category page, before footer.', 'ABdev_revelance'),
						'type'        => 'editor',
					),
					array(
						'id'          => 'content_after_single_post',
						'title'       => __('Additional Content After Single Post', 'ABdev_revelance'),
						'desc'        => __('Enter content to be shown at the bottom of single post page, before footer.', 'ABdev_revelance'),
						'type'        => 'editor',
					),


				)
			);


			$this->sections[] = array(
				'title' => __('Footer', 'ABdev_revelance'),
				'icon' => 'el-icon-credit-card',
				'fields' => array(
					array(
						'id'          => 'hide_back_to_top',
						'title'       => __('Hide Back to Top', 'ABdev_revelance'),
						'type'        => 'checkbox',
					),
					array(
						'id'          => 'punchline',
						'title'       => __('Footer Punchline', 'ABdev_revelance'),
						'type'        => 'text',
					),
					array(
						'id'          => 'copyright',
						'title'       => __('Copyright Notice', 'ABdev_revelance'),
						'desc'        => __('Enter copyright notice to be shown in footer<br>THEME SHARED ON WPLOCKER.COM', 'ABdev_revelance'),
						'type'        => 'text',
					),

				)
			);

 
		}	


	}
	new Revelance_Redux_Framework_config();
}

