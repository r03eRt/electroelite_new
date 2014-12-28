<?php 

function ab_tweet_scroller_shortcode($atts){
	$options = get_option('abts_settings');
	$user = (isset($options['abts_consumer_screen_name'])) ? $options['abts_consumer_screen_name'] : '';
	$consumerkey = (isset($options['abts_consumer_key'])) ? $options['abts_consumer_key'] : '';
	$consumersecret = (isset($options['abts_consumer_secret'])) ? $options['abts_consumer_secret'] : '';
	$accesstoken = (isset($options['abts_access_token'])) ? $options['abts_access_token'] : '';
	$accesstokensecret = (isset($options['abts_access_token_secret'])) ? $options['abts_access_token_secret'] : '';
	$expiration = (isset($options['abts_expiration']) && $options['abts_expiration']>=5) ? $options['abts_expiration'] : 5;

	extract( shortcode_atts( array(
		'user'				=> $user,
		'limit' 			=> '5',
		'link_target' 		=> '_blank', // _blank or _self
		'hide_image' 		=> '0',
		'hide_reply' 		=> '0',
		'hide_retweet' 		=> '0',
		'hide_favorite' 	=> '0',
		'date_format' 		=> 'human', // human, hide or PHP date format
		'show_arrows'		=> '1',
		'fx' 				=> 'fade',   //Possible values: "none", "scroll", "fade", "crossfade",  "cover-fade" or "uncover-fade".
		'easing' 			=> 'swing',   //jQuery defaults: "linear" and "swing", built in: "cubic" and "elastic".
		'duration' 			=> '1000',
		'pauseonhover' 		=> 'immediate',
		'timeoutduration'	=> '5000',
		'play' 				=> '1',
		'class' 			=> '',
	), $atts));

	if($user!='' && $consumerkey!='' && $consumersecret!='' && $accesstoken!='' && $accesstokensecret){

		$transient_name = 'abts_'.$user;

		$tweets = get_transient( $transient_name );

		if(!$tweets){
			$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $user . "&count=" . $limit);
			set_transient( $transient_name, $tweets, 60*$expiration );
		}

		$play = ($play) ? 'true' : 'false'; 
	 	
		$return = '<div class="ab-tweet-scroller '.$class.'" data-fx="'.$fx.'" data-play="'.$play.'" data-easing="'.$easing.'" data-duration="'.$duration.'" data-pauseonhover="'.$pauseonhover.'" data-timeoutduration="'.$timeoutduration.'">';
			$return .= '<ul class="ab-tweet-scroller-inner">';

			 	foreach ($tweets as $tweet) {
						$return.='<li class="ab-tweet-item">';

							$return .= (!$hide_image) ? '<a class="ab-tweet-image" href="https://twitter.com/'.$user.'" target="'.$link_target.'"><img src="'.$tweet->user->profile_image_url_https.'" class="imgalign"></a>' : '';
							
							$date_out = '';
							if($date_format!='hide'){
								if($date_format=='human'){
									$date_out = __("about", 'ab-tweet-scroller').' '.human_time_diff( strtotime($tweet->created_at), current_time('timestamp') ) .' '. __("ago", 'ab-tweet-scroller');
								}
								else{
									$date_out = date($date_format, strtotime($tweet->created_at));
								}
							}

							$return .= ($date_out!='') ? '<a class="ab-tweet-date" href="https://twitter.com/'.$user.'" target="'.$link_target.'">'.$date_out.'</a>' : '';
							
							$return .= '<div class="ab-tweet-text">'.ab_make_links_clickable($tweet->text, $link_target).'</div>';

							$links_out = '';
							$links_out .= (!$hide_reply) ? '<a class="ab-tweet-links-reply" target="'.$link_target.'" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet->id_str.'">'.__("Reply", 'ab-tweet-scroller').'</a>' : '';
							$links_out .= (!$hide_retweet) ? '<a class="ab-tweet-links-retweet" target="'.$link_target.'" href="https://twitter.com/intent/retweet?tweet_id='.$tweet->id_str.'">'.__("Retweet", 'ab-tweet-scroller').'</a>' : '';
							$links_out .= (!$hide_favorite) ? '<a class="ab-tweet-links-favorite" target="'.$link_target.'" href="https://twitter.com/intent/favorite?tweet_id='.$tweet->id_str.'">'.__("Favorite", 'ab-tweet-scroller').'</a>' : '';
							
							$return .= ($links_out != '') ? '<div class="ab-tweet-links">'.$links_out.'</div>' : '';
						
						$return .= '</li>';
			 	}

				$return .= '</ul>';
				$return  .= ($show_arrows && count($tweets)>1) ? '<div class="ab-tweet-navigation"><a href="#" class="ab-tweet-prev">&lt;</a> <a href="#" class="ab-tweet-next">&gt;</a></div>' : '';
			$return .= '</div>';
	}
	else{
		$return = __('Twitter API data not entered in Settings/AB Tweet Scroller', 'ab-tweet-scroller');
	}

    return $return;
}

add_shortcode( 'ab_tweet_scroller' , 'ab_tweet_scroller_shortcode' );