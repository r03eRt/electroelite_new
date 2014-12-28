<?php
/* -----------------------------------------------------------------------------------

  Plugin Name: AB Tweet Scroller
  Plugin URI: http://www.ab-themes.com
  Description: Shortcode to display scrolling Twitter feed
  Version: 1.0.0
  Author: ab-themes
  Author URI: http://www.ab-themes.com

----------------------------------------------------------------------------------- */

define('ABTS_VERSION', '1.0.0');
define('ABTS_DIR', plugin_dir_url( __FILE__ ));

require_once("inc/options_page.php");
require_once("inc/functions.php");

if(!class_exists('TwitterOAuth')){
	require_once("inc/twitter/twitteroauth.php");
}

require_once("inc/shortcode.php");

function ABTS_enqueue_script() {
	wp_enqueue_style('abts_ab_tweet_scroller', ABTS_DIR.'css/ab-tweet-scroller.css', '', ABTS_VERSION);
	wp_enqueue_script('carouFredSel', ABTS_DIR.'js/jquery.carouFredSel-6.2.1.js', array('jquery'), '6.2.1', true);
	wp_enqueue_script('abts_ab_tweet_scroller', ABTS_DIR.'js/ab-tweet-scroller.js', array('jquery','carouFredSel'), ABTS_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'ABTS_enqueue_script' );