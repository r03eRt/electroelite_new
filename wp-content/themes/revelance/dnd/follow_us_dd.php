<?php

/*********** Shortcode: Follow us links ************************************************************/

$ABdevDND_shortcodes['follow_us_dd'] = array(
	'attributes' => array(
		'twitter' => array(
			'description' => __('Twitter URL', 'dnd-shortcodes'),
		),
		'linkedin' => array(
			'description' => __('Linkedin URL', 'dnd-shortcodes'),
		),
		'facebook' => array(
			'description' => __('Facebook URL', 'dnd-shortcodes'),
		),
		'googleplus' => array(
			'description' => __('Google+ URL', 'dnd-shortcodes'),
		),
		'dribbble' => array(
			'description' => __('Dribbble URL', 'dnd-shortcodes'),
		),
		'skype' => array(
			'description' => __('Skype URL', 'dnd-shortcodes'),
		),
		'youtube' => array(
			'description' => __('YouTube URL', 'dnd-shortcodes'),
		),
		'vimeo' => array(
			'description' => __('Vimeo URL', 'dnd-shortcodes'),
		),
		'pinterest' => array(
			'description' => __('Pinterest URL', 'dnd-shortcodes'),
		),
		'github' => array(
			'description' => __('Github URL', 'dnd-shortcodes'),
		),
		'feed' => array(
			'description' => __('Feed URL', 'dnd-shortcodes'),
		),
		'behance' => array(
			'description' => __('Behance URL', 'dnd-shortcodes'),
		),
		'dropbox' => array(
			'description' => __('Dropbox URL', 'dnd-shortcodes'),
		),
		'flickr' => array(
			'description' => __('Flickr URL', 'dnd-shortcodes'),
		),
		'instagram' => array(
			'description' => __('Instagram URL', 'dnd-shortcodes'),
		),
		'lastfm' => array(
			'description' => __('Lastfm URL', 'dnd-shortcodes'),
		),
		'picasa' => array(
			'description' => __('Picasa URL', 'dnd-shortcodes'),
		),
		'stumbleupon' => array(
			'description' => __('Stumbleupon URL', 'dnd-shortcodes'),
		),
		'mail' => array(
			'description' => __('Mail Address', 'dnd-shortcodes'),
		),
	),
	'description' => __('Follow us Profile Links', 'dnd-shortcodes'),
	'info' => __('Shortcode will display Social networks icons with link to entered URLs', 'dnd-shortcodes' )
);
function ABdevDND_follow_us_dd_shortcode( $attributes ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('follow_us_dd'), $attributes));
	
	$return='<div class="dnd_follow_us">';

	if($facebook!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_facebook dnd_tooltip" data-gravity="s" href="'.$facebook.'" target="_blank" title="'.__('Follow us on Facebook', 'dnd-shortcodes').'"><i class="entypo-facebook"></i></a>';
	if($twitter!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_twitter dnd_tooltip" data-gravity="s" href="'.$twitter.'" target="_blank" title="'.__('Follow us on Twitter', 'dnd-shortcodes').'"><i class="entypo-twitter"></i></a>';
	if($googleplus!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_googleplus dnd_tooltip" data-gravity="s" href="'.$googleplus.'" target="_blank" title="'.__('Follow us on Google+', 'dnd-shortcodes').'"><i class="entypo-googleplus"></i></a>';
	if($linkedin!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_linkedin dnd_tooltip" data-gravity="s" href="'.$linkedin.'" target="_blank" title="'.__('Follow us on Linkedin', 'dnd-shortcodes').'"><i class="entypo-linkedin"></i></a>';
	if($pinterest!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_pinterest dnd_tooltip" data-gravity="s" href="'.$pinterest.'" target="_blank" title="'.__('Follow us on Pinterest', 'dnd-shortcodes').'"><i class="entypo-pinterest"></i></a>';
	if($youtube!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_youtube dnd_tooltip" data-gravity="s" href="'.$youtube.'" target="_blank" title="'.__('Our YouTube Profile', 'dnd-shortcodes').'"><i class="entypo-video"></i></a>';
	if($vimeo!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_vimeo dnd_tooltip" data-gravity="s" href="'.$vimeo.'" target="_blank" title="'.__('Our Vimeo Profile', 'dnd-shortcodes').'"><i class="entypo-vimeo"></i></a>';
	if($github!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_github dnd_tooltip" data-gravity="s" href="'.$github.'" target="_blank" title="'.__('Follow us on Github', 'dnd-shortcodes').'"><i class="entypo-github"></i></a>';
	if($feed!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_feed dnd_tooltip" data-gravity="s" href="'.$feed.'" target="_blank" title="'.__('Our RSS feed', 'dnd-shortcodes').'"><i class="entypo-rss"></i></a>';
	if($behance!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_behance dnd_tooltip" data-gravity="s" href="'.$behance.'" target="_blank" title="'.__('Our Behance Profile', 'dnd-shortcodes').'"><i class="entypo-behance"></i></a>';
	if($dribbble!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_dribbble dnd_tooltip" data-gravity="s" href="'.$dribbble.'" target="_blank" title="'.__('Our Dribbble Profile', 'dnd-shortcodes').'"><i class="entypo-dribbble"></i></a>';
	if($dropbox!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_dropbox dnd_tooltip" data-gravity="s" href="'.$dropbox.'" target="_blank" title="'.__('Our Dropbox Files', 'dnd-shortcodes').'"><i class="entypo-dropbox"></i></a>';
	if($mail!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_emailalt dnd_tooltip" data-gravity="s" href="mailto:'.$mail.'" target="_blank" title="'.__('Send Us Email', 'dnd-shortcodes').'"><i class="entypo-mail"></i></a>';
	if($flickr!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_flickr dnd_tooltip" data-gravity="s" href="'.$flickr.'" target="_blank" title="'.__('Our Flickr Profile', 'dnd-shortcodes').'"><i class="entypo-flickr"></i></a>';
	if($instagram!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_instagram dnd_tooltip" data-gravity="s" href="'.$instagram.'" target="_blank" title="'.__('Our Instagram Profile', 'dnd-shortcodes').'"><i class="entypo-instagram"></i></a>';
	if($lastfm!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_lastfm dnd_tooltip" data-gravity="s" href="'.$lastfm.'" target="_blank" title="'.__('Our last.fm Profile', 'dnd-shortcodes').'"><i class="entypo-lastfm"></i></a>';
	if($picasa!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_picasa dnd_tooltip" data-gravity="s" href="'.$picasa.'" target="_blank" title="'.__('Our Picasa Profile', 'dnd-shortcodes').'"><i class="entypo-picasa"></i></a>';
	if($skype!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_skype dnd_tooltip" data-gravity="s" href="'.$skype.'" target="_blank" title="'.__('Our Skype Profile', 'dnd-shortcodes').'"><i class="entypo-skype"></i></a>';
	if($stumbleupon!='')
		$return.='<a class="dnd_socialicon dnd_socialicon_stumbleupon dnd_tooltip" data-gravity="s" href="'.$stumbleupon.'" target="_blank" title="'.__('Our StumbleUpon Profile', 'dnd-shortcodes').'"><i class="entypo-stumbleupon"></i></a>';
	$return.='</div>';
    return $return;
}
