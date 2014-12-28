<?php 


/**
	ab-tweet-scroller plugin support
**/
if( in_array('ab-tweet-scroller/ab-tweet-scroller.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['ab_tweet_scroller'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'user' => array(
				'description' => __('User', 'dnd-shortcodes'),
				'info' => __('Displays different user than the one specified in API settings', 'dnd-shortcodes'),
			),
			'limit' => array(
				'description' => __('Limit', 'dnd-shortcodes'),
				'info' => __('Number of tweets to show', 'dnd-shortcodes'),
				'default' => 5,
			),
			'link_target' => array(
				'description' => __('External Link Target', 'dnd-shortcodes'),
				'default' => '_blank',
				'type' => 'select',
				'values' => array(
					'_blank' => __('Blank', 'dnd-shortcodes'),
					'_self' =>  __('Self', 'dnd-shortcodes'),
				),
			),
			'hide_image' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => __('Hide Image', 'dnd-shortcodes'),
			),
			'hide_reply' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => __('Hide Reply Link', 'dnd-shortcodes'),
			),
			'hide_retweet' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => __('Hide Retweet Link', 'dnd-shortcodes'),
			),
			'hide_favorite' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => __('Hide Favorite Link', 'dnd-shortcodes'),
			),
			'date_format' => array(
				'description' => __('Date Format', 'dnd-shortcodes'),
				'info' => __('Specifies date format to be used, or to hide the date. Possible values are human, hide or PHP date format string', 'dnd-shortcodes'),
				'default' => 'human',
			),
			'show_arrows' => array(
				'default' => '1',
				'type' => 'checkbox',
				'description' => __('Show Arrows', 'dnd-shortcodes'),
			),
			'fx' => array(
				'description' => __('Effect', 'dnd-shortcodes'),
				'default' => 'fade',
				'type' => 'select',
				'values' => array(
					'none' => __('none', 'dnd-shortcodes'),
					'scroll' =>  __('scroll', 'dnd-shortcodes'),
					'fade' =>  __('fade', 'dnd-shortcodes'),
					'crossfade' =>  __('crossfade', 'dnd-shortcodes'),
					'cover-fade' =>  __('cover-fade', 'dnd-shortcodes'),
					'uncover-fade' =>  __('uncover-fade', 'dnd-shortcodes'),
				),
			),
			'easing' => array(
				'description' => __('Easing', 'dnd-shortcodes'),
				'default' => 'swing',
				'type' => 'select',
				'values' => array(
					'linear' => __('linear', 'dnd-shortcodes'),
					'swing' =>  __('swing', 'dnd-shortcodes'),
					'cubic' =>  __('cubic', 'dnd-shortcodes'),
					'elastic' =>  __('elastic', 'dnd-shortcodes'),
				),
			),
			'duration' => array(
				'description' => __('Transition Duration', 'dnd-shortcodes'),
				'info' => __('Duration of transition in seconds', 'dnd-shortcodes'),
				'default' => '1000',
			),
			'pauseonhover' => array(
				'description' => __('Pause on Hover', 'dnd-shortcodes'),
				'default' => 'immediate',
				'type' => 'select',
				'values' => array(
					'false' => __('false', 'dnd-shortcodes'),
					'resume' =>  __('resume', 'dnd-shortcodes'),
					'immediate' =>  __('immediate', 'dnd-shortcodes'),
				),
			),
			'timeoutduration' => array(
				'description' => __('Transition Duration', 'dnd-shortcodes'),
				'info' => __('How long is each slide displayed, in seconds', 'dnd-shortcodes'),
				'default' => '5000',
			),
			'play' => array(
				'default' => '1',
				'type' => 'checkbox',
				'description' => __('Autoplay', 'dnd-shortcodes'),
			),
			'class' => array(
				'description' => __('Class', 'dnd-shortcodes'),
				'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
			),
		),
		'description' => __('AB Tweet Scroller', 'dnd-shortcodes'),
	);
}