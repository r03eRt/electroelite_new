<?php 

add_action( 'admin_menu', 'abts_add_admin_menu' );
add_action( 'admin_init', 'abts_settings_init' );

function abts_add_admin_menu() { 
	add_options_page( __( 'AB Tweet Scroller', 'ab-tweet-scroller' ), __( 'AB Tweet Scroller', 'ab-tweet-scroller' ), 'manage_options', 'ab_tweet_scroller', 'ab_tweet_scroller_options_page' );
}

function abts_settings_exist() { 
	if( false == get_option( 'abts_settings' ) ) { 
		add_option( 'abts_settings' );
	}
}

function abts_settings_init() { 
	register_setting( 'abts_options_page', 'abts_settings' );
	add_settings_section(
		'abts_api_data', 
		__( 'API Data', 'ab-tweet-scroller' ), 
		'abts_api_data_section_render', 
		'abts_options_page'
	);
	add_settings_field( 
		'abts_consumer_screen_name', 
		__( "Consumer Screen Name", 'ab-tweet-scroller' ), 
		'abts_consumer_screen_name_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
	add_settings_field( 
		'abts_consumer_key', 
		__( "Consumer Key", 'ab-tweet-scroller' ), 
		'abts_consumer_key_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
	add_settings_field( 
		'abts_consumer_secret', 
		__( "Consumer Secret", 'ab-tweet-scroller' ), 
		'abts_consumer_secret_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
	add_settings_field( 
		'abts_access_token', 
		__( "Access Token", 'ab-tweet-scroller' ), 
		'abts_access_token_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
	add_settings_field( 
		'abts_access_token_secret', 
		__( "Access Token Secret", 'ab-tweet-scroller' ), 
		'abts_access_token_secret_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
	add_settings_field( 
		'abts_expiration', 
		__( "Expiration", 'ab-tweet-scroller' ), 
		'abts_expiration_render', 
		'abts_options_page', 
		'abts_api_data' 
	);
}


function abts_api_data_section_render() { 
	_e('Here you can enter Twitter API data needed by plugin. All needed data can be found on <a href="https://dev.twitter.com/apps" target="_blank">Twitter API</a> site.', 'ab-tweet-scroller' );
}

function abts_consumer_screen_name_render() { 
	$options = get_option( 'abts_settings' );
	$abts_consumer_screen_name = (isset($options['abts_consumer_screen_name'])) ? $options['abts_consumer_screen_name'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_consumer_screen_name]' value='<?php echo $abts_consumer_screen_name; ?>'>
	<?php
}

function abts_consumer_key_render() { 
	$options = get_option( 'abts_settings' );
	$abts_consumer_key = (isset($options['abts_consumer_key'])) ? $options['abts_consumer_key'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_consumer_key]' value='<?php echo $abts_consumer_key; ?>'>
	<?php
}

function abts_consumer_secret_render() { 
	$options = get_option( 'abts_settings' );
	$abts_consumer_secret = (isset($options['abts_consumer_secret'])) ? $options['abts_consumer_secret'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_consumer_secret]' value='<?php echo $abts_consumer_secret; ?>'>
	<?php
}

function abts_access_token_render() { 
	$options = get_option( 'abts_settings' );
	$abts_access_token = (isset($options['abts_access_token'])) ? $options['abts_access_token'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_access_token]' value='<?php echo $abts_access_token; ?>'>
	<?php
}

function abts_access_token_secret_render() { 
	$options = get_option( 'abts_settings' );
	$abts_access_token_secret = (isset($options['abts_access_token_secret'])) ? $options['abts_access_token_secret'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_access_token_secret]' value='<?php echo $abts_access_token_secret; ?>'>
	<?php
}

function abts_expiration_render() { 
	$options = get_option( 'abts_settings' );
	$abts_expiration = (isset($options['abts_expiration'])) ? $options['abts_expiration'] : '';
	?>
	<input type='text' class="regular-text ltr" name='abts_settings[abts_expiration]' value='<?php echo $abts_expiration; ?>'>
	<p class="description"><?php _e( 'Refresh interval in minutes, minimum is 5 minutes.', 'ab-tweet-scroller' ) ?></p>
	<?php
}



function ab_tweet_scroller_options_page() { 
	?>
	<div class="wrap">
		<h2><?php _e( 'AB Tweet Scroller', 'ab-tweet-scroller' ) ?></h2>
		<form action='options.php' method='post'>
			<?php
			settings_fields( 'abts_options_page' );
			do_settings_sections( 'abts_options_page' );
			submit_button();
			?>
			
			<h3>Shortcode Info</h3>
			<?php _e('To display tweets use following shortcode:', 'ab-tweet-scroller' ); ?>
			<b>[ab_tweet_scroller]][/ab_tweet_scroller]</b>
			<br><br>
			<?php _e('Example of shortcode to display last 3 tweets without profile image:', 'ab-tweet-scroller' ); ?>
			<b>[ab_tweet_scroller limit='3' hide_image='1'][/ab_tweet_scroller]</b>
			<br>
			<h4><?php _e('Full attributes list', 'ab-tweet-scroller' ); ?></h4>

			<table class="abts-attributes-table">
				<tr>
					<th><?php _e('Attribute', 'ab-tweet-scroller'); ?></th>
					<th><?php _e('Possible values', 'ab-tweet-scroller'); ?></th>
					<th><?php _e('Default', 'ab-tweet-scroller'); ?></th>
					<th><?php _e('Info', 'ab-tweet-scroller'); ?></th>
				</tr>
				<tr>
					<td>user</td>
					<td><?php _e('', 'ab-tweet-scroller'); ?></td>
					<td><?php _e('', 'ab-tweet-scroller'); ?></td>
					<td><?php _e('Displays different user than the one specified in API settings', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>limit</td>
					<td><?php _e('positive integer', 'ab-tweet-scroller'); ?></td>
					<td>5</td>
					<td><?php _e('Number of tweets to show', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>link_target</td>
					<td>_blank, _self</td>
					<td>_blank</td>
					<td><?php _e('Where external link should be opened', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>hide_image</td>
					<td>0, 1, false, true</td>
					<td>0</td>
					<td><?php _e('Hides profile image', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>hide_reply</td>
					<td>0, 1, false, true</td>
					<td>0</td>
					<td><?php _e('Hides Reply link', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>hide_retweet</td>
					<td>0, 1, false, true</td>
					<td>0</td>
					<td><?php _e('Hides Retweet link', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>hide_favorite</td>
					<td>0, 1, false, true</td>
					<td>0</td>
					<td><?php _e('Hides Favorite link', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>date_format</td>
					<td><?php _e('human, hide or PHP date format', 'ab-tweet-scroller'); ?></td>
					<td>human</td>
					<td><?php _e('Specifies date format to be used, or to hide the date', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>show_arrows</td>
					<td>0, 1, false, true</td>
					<td>1</td>
					<td><?php _e('Show or hide arrows', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>fx</td>
					<td>none, scroll, fade, crossfade,  cover-fade, uncover-fade</td>
					<td>fade</td>
					<td><?php _e('Transition effect', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>easing</td>
					<td>linear, swing, cubic, elastic</td>
					<td>swing</td>
					<td><?php _e('Transition effect easing function', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>duration</td>
					<td><?php _e('positive integer', 'ab-tweet-scroller'); ?></td>
					<td>1000</td>
					<td><?php _e('Duration of transition in seconds', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>pauseonhover</td>
					<td>false, resume, immediate</td>
					<td>immediate</td>
					<td><?php _e('Determines whether the timeout between transitions should be paused "onMouseOver" (only applies when the carousel scrolls automatically).', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>timeoutduration</td>
					<td><?php _e('positive integer', 'ab-tweet-scroller'); ?></td>
					<td>5000</td>
					<td><?php _e('How long is each slide displayed, in seconds', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>play</td>
					<td>0, 1, false, true</td>
					<td>1</td>
					<td><?php _e('Auto play slider', 'ab-tweet-scroller'); ?></td>
				</tr>
				<tr>
					<td>class</td>
					<td><?php _e('', 'ab-tweet-scroller'); ?></td>
					<td><?php _e('', 'ab-tweet-scroller'); ?></td>
					<td><?php _e('Custom class for additional styling', 'ab-tweet-scroller'); ?></td>
				</tr>
			</table>

			<style>
			.abts-attributes-table{
				border-collapse: collapse;
				width: 100%;
			}
			.abts-attributes-table th,
			.abts-attributes-table td{
				padding: 3px 10px;
			}
			.abts-attributes-table th{
				text-align: left;
			}
			.abts-attributes-table tr:nth-child(2n){
				background: #fff;
			}
			</style>
		</form>
	</div>
	<?php
}
