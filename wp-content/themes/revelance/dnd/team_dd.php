<?php

/*********** Shortcode: Team ************************************************************/
$ABdevDND_shortcodes['team_dd'] = array(
	'attributes' => array(
		'style' => array(
			'description' => __('Style', 'dnd-shortcodes'),
			'default' => 'style_1',
			'type' => 'select',
			'values' => array(
				'style_1' =>  __('Style 1', 'dnd-shortcodes'),
				'style_2' => __('Style 2', 'dnd-shortcodes'),
			),
		),
		'name' => array(
			'description' => __('Name', 'dnd-shortcodes'),
		),
		'position' => array(
			'description' => __('Position', 'dnd-shortcodes'),
		),
		'image' => array(
			'type' => 'image',
			'description' => __('Image URL', 'dnd-shortcodes'),
		),
		'link' => array(
			'description' => __('Profile URL', 'dnd-shortcodes'),
			'info' => __('Link to about page', 'dnd-shortcodes'),
		),
		'modal' => array(
			'type' => 'checkbox',
			'description' => __('Use Modal Instead Link', 'dnd-shortcodes'),
			'info' => __('Modal window will appear on click instead of following a link. Use content to add modal window content', 'dnd-shortcodes'),
		),
		'mail' => array(
			'description' => __('E-mail address', 'dnd-shortcodes'),
		),
		'facebook' => array(
			'description' => __('Facebook URL', 'dnd-shortcodes'),
		),
		'twitter' => array(
			'description' => __('Twitter URL', 'dnd-shortcodes'),
		),
		'linkedin' => array(
			'description' => __('Linkedin URL', 'dnd-shortcodes'),
		),
		'googleplus' => array(
			'description' => __('Google+ URL', 'dnd-shortcodes'),
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
		'dribbble' => array(
			'description' => __('Dribbble URL', 'dnd-shortcodes'),
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
			'description' => __('Last.fm URL', 'dnd-shortcodes'),
		),
		'picasa' => array(
			'description' => __('Picasa URL', 'dnd-shortcodes'),
		),
		'skype' => array(
			'description' => __('Skype URL', 'dnd-shortcodes'),
		),
		'stumbleupon' => array(
			'description' => __('StumbleUpon URL', 'dnd-shortcodes'),
		),
		'vimeo' => array(
			'description' => __('Vimeo URL', 'dnd-shortcodes'),
		),
		'social_target' => array(
			'description' => __('Social Link Target', 'dnd-shortcodes'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  __('Self', 'dnd-shortcodes'),
				'_blank' => __('Blank', 'dnd-shortcodes'),
			),
		),
		'social_under' => array(
			'type' => 'checkbox',
			'description' => __('Social icons under position', 'dnd-shortcodes'),
			'info' => __('If enabled social icons will appear under position instead on image overlay.', 'dnd-shortcodes'),
		),
	),
	'content' => '',
	'description' => __('Team Member', 'dnd-shortcodes' )
);
function ABdevDND_team_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('team_dd'), $attributes));

	$return = '
		<div class="dnd_team_member dnd_team_member_'.$style.'">';

	$social_links = '';
	if($twitter!='') $social_links .= '<a href="'.$twitter.'" target="'.$social_target.'"><i class="entypo-twitter"></i></a>';
	if($linkedin!='') $social_links .= '<a href="'.$linkedin.'" target="'.$social_target.'"><i class="entypo-linkedin"></i></a>';
	if($facebook!='') $social_links .= '<a href="'.$facebook.'" target="'.$social_target.'"><i class="entypo-facebook"></i></a>';
	if($googleplus!='') $social_links.='<a href="'.$googleplus.'" target="'.$social_target.'"><i class="entypo-googleplus"></i></a>';
	if($dribbble!='') $social_links.='<a href="'.$dribbble.'" target="'.$social_target.'"><i class="entypo-dribbble"></i></a>';
	if($skype!='') $social_links.='<a href="'.$skype.'" target="'.$social_target.'"><i class="entypo-skype"></i></a>';
	if($vimeo!='') $social_links.='<a href="'.$vimeo.'" target="'.$social_target.'"><i class="entypo-vimeo"></i></a>';
	if($pinterest!='') $social_links.='<a href="'.$pinterest.'" target="'.$social_target.'"><i class="entypo-pinterest"></i></a>';
	if($github!='') $social_links.='<a href="'.$github.'" target="'.$social_target.'"><i class="entypo-github"></i></a>';
	if($feed!='') $social_links.='<a href="'.$feed.'" target="'.$social_target.'"><i class="entypo-rss"></i></a>';
	if($behance!='') $social_links.='<a href="'.$behance.'" target="'.$social_target.'"><i class="entypo-behance"></i></a>';
	if($dropbox!='') $social_links.='<a href="'.$dropbox.'" target="'.$social_target.'"><i class="entypo-dropbox"></i></a>';
	if($flickr!='') $social_links.='<a href="'.$flickr.'" target="'.$social_target.'"><i class="entypo-flickr"></i></a>';
	if($instagram!='') $social_links.='<a href="'.$instagram.'" target="'.$social_target.'"><i class="entypo-instagram"></i></a>';
	if($lastfm!='') $social_links.='<a href="'.$lastfm.'" target="'.$social_target.'"><i class="entypo-lastfm"></i></a>';
	if($picasa!='') $social_links.='<a href="'.$picasa.'" target="'.$social_target.'"><i class="entypo-picasa"></i></a>';
	if($stumbleupon!='') $social_links.='<a href="'.$stumbleupon.'" target="'.$social_target.'"><i class="entypo-stumbleupon"></i></a>';
	if($mail!='') $social_links .= '<a href="mailto:'.$mail.'"><i class="entypo-mail"></i></a>';
	
	if($style == 'style_1'){
		if(($social_links!='' && $social_under!=1) || $link!=''){
			$return .= '<div class="dnd_overlayed">
				<img src="'.$image.'" alt="'.$name.'">
				<div class="dnd_overlay">
					<p>';
						if($social_under==1 || $social_links==''){
							if ($modal==1){
								$return .='<a class="dnd_team_member_link dnd_team_member_modal_link" href="'.$link.'"><i class="entypo-plus"></i></a>';
							}else{
								$return .='<a href="'.$link.'"><i class="entypo-link"></i></a>';
							}
						}
						else{	
							$return .= $social_links;
						}
					$return .= '</p>
				</div>
			</div>';
		}
		else{
			$return.= '<img src="'.$image.'" alt="'.$name.'">';
		}
		$return .= '<a class="dnd_team_member_link'.(($modal==1)?' dnd_team_member_modal_link':'').'" href="'.$link.'">
			<span class="dnd_team_member_name">'.$name.'</span>
			<span class="dnd_team_member_position">'.$position.'</span>
		</a>';

		if($modal == 1){
			$return .= '
				<div class="dnd_team_member_modal">
					<h4 class="dnd_team_member_name">'.$name.'</h4>
					<p class="dnd_team_member_position">'.$position.'</p>
					<div class="dnd_container">
						<div class="dnd_column_dd_span6">
							<img src="'.$image.'" alt="'.$name.'">
						</div>
						<div class="dnd_column_dd_span6">
							'.do_shortcode($content).'
						</div>
					</div>
					<div class="dnd_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '
				<p>'.$content.'</p>
			';
		}

		if($social_under==1){
			$return .= '<div class="dnd_team_member_social_under">'.$social_links.'</div>';
		}
	}

	else{
		if(($social_links!='' && $social_under!=1) || $link!=''){
			$return .= '<div class="dnd_overlayed">
				<img src="'.$image.'" alt="'.$name.'">
				<div class="dnd_overlay">
					<p>';
						if($social_under==1 || $social_links==''){
							if ($modal==1){
								$return .='<a class="dnd_team_member_link dnd_team_member_modal_link" href="'.$link.'"><i class="entypo-plus"></i></a>';
							}else{
								$return .='<a href="'.$link.'"><i class="entypo-link"></i></a>';
							}
						}
						else{	
							$return .= $social_links;
						}
					$return .= '</p>';
					$return .= '<div class="dnd_overlay_memeber">
									<a class="dnd_team_member_link'.(($modal==1)?' dnd_team_member_modal_link':'').'" href="'.$link.'">
										<span class="dnd_team_member_name">'.$name.'</span>
										<span class="dnd_team_member_position">'.$position.'</span>
									</a>
								</div>';
					$return .= '
				</div>
			</div>';
		}
		else{
			$return.= '<img src="'.$image.'" alt="'.$name.'">';
		}

		if($modal == 1){
			$return .= '
				<div class="dnd_team_member_modal">
					<h4 class="dnd_team_member_name">'.$name.'</h4>
					<p class="dnd_team_member_position">'.$position.'</p>
					<div class="dnd_container">
						<div class="dnd_column_dd_span6">
							<img src="'.$image.'" alt="'.$name.'">
						</div>
						<div class="dnd_column_dd_span6">
							'.do_shortcode($content).'
						</div>
					</div>
					<div class="dnd_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '
				<p>'.$content.'</p>
			';
		}

		if($social_under==1){
			$return .= '<div class="dnd_team_member_social_under">'.$social_links.'</div>';
		}
	}

		$return .= '</div>';

	return $return;
}



