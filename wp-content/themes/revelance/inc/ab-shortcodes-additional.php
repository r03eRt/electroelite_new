<?php 

// ***************** 3rd party shortcode support ***************************************


// *************** ab-testimonials plugin support ********************

if( in_array('ab-testimonials/ab-testimonials.php', get_option('active_plugins')) ){
	$ABdev_shortcodes['AB_testimonials'] = array(
		'name' => 'AB_testimonials',
		'type' => 'single',
		'third_party' => 1, 
		'atts' => array(
			'category' => array(
				'desc' => __( 'Testimonial Category', 'ABdev_revelance' ),
			),
			'count' => array(
				'desc' => __( 'Number of Testimonials to Show', 'ABdev_revelance' ),
				'default' => '8',
			),
			'show_arrows' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Show Navigation Arrows', 'ABdev_revelance' ),
			),
			'timeoutduration' => array(
				'desc' => __( 'Delay', 'ABdev_revelance' ),
				'default' => '5000',
			),
			'duration' => array(
				'desc' => __( 'Animation Duration', 'ABdev_revelance' ),
				'default' => '1000',
			),
			'style' => array(
				'desc' => __( 'Style', 'ABdev_revelance' ),
				'default' => '1',
				'values' => array(
					'1' =>  __( 'Big without image', 'ABdev_revelance' ),
					'2' => __( 'Small with image', 'ABdev_revelance' ),
				),
			),
			'fx' => array(
				'desc' => __( 'Transition Effect', 'ABdev_revelance' ),
				'default' => 'crossfade',
				'values' => array(
					'none' =>  __( 'None', 'ABdev_revelance' ),
					'fade' =>  __( 'Fade', 'ABdev_revelance' ),
					'crossfade' =>  __( 'Crossfade', 'ABdev_revelance' ),
					'cover-fade' =>  __( 'Cover Fade', 'ABdev_revelance' ),
				),
			),
			'easing' => array(
				'desc' => __( 'Easing Effect', 'ABdev_revelance' ),
				'default' => 'quadratic',
				'values' => array(
					'linear' =>  __( 'Linear', 'ABdev_revelance' ),
					'swing' =>  __( 'Swing', 'ABdev_revelance' ),
					'quadratic' =>  __( 'Quadratic', 'ABdev_revelance' ),
					'cubic' =>  __( 'Cubic', 'ABdev_revelance' ),
					'elastic' =>  __( 'Elastic', 'ABdev_revelance' ),
				),
			),
			'direction' => array(
				'desc' => __( 'Slide Direction', 'ABdev_revelance' ),
				'default' => 'left',
				'values' => array(
					'left' =>  __( 'Left', 'ABdev_revelance' ),
					'right' =>  __( 'Right', 'ABdev_revelance' ),
				),
			),
			'play' => array(
				'default' => '0',
				'type' => 'checkbox',
				'desc' => __( 'Autoplay', 'ABdev_revelance' ),
			),
			'pauseOnHover' => array(
				'desc' => __( 'Pause on Hover', 'ABdev_revelance' ),
				'default' => 'immediate',
				'values' => array(
					'false' =>  __( 'No', 'ABdev_revelance' ),
					'resume' =>  __( 'Resume', 'ABdev_revelance' ),
					'immediate' =>  __( 'Immediate', 'ABdev_revelance' ),
				),
			),
			'class' => array(
				'default' => '',
				'desc' => __( 'Class', 'ABdev_revelance' ),
			),
		),
		'desc' => __( 'AB Testimonial Slider', 'ABdev_revelance' )
	);
}