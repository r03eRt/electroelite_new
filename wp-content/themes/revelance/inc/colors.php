<?php 

if ( ! function_exists( 'ABdev_colors_css_hex2rgb' ) ){
	function ABdev_colors_css_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); 
	} 
}

if ( ! function_exists( 'ABdev_colors_css_adjustBrightness' ) ){
	function ABdev_colors_css_adjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r_hex.$g_hex.$b_hex;
	}
}



if(isset($revelance_options['dark_scheme']) && $revelance_options['dark_scheme'] == 1){
	$custom_css.= '
		body{color: #676767;background:#222222;}
		h1, h2, h3, h4, h5, h6{color: #676767;}
		.dnd_section_dd header h3,.main_title span {color: #676767;}
		.dnd_section_dd header h3:before,.main_title:before{border-color:#676767;}
		#abdev_main_header{background:#111;}
		nav > ul > li a{color:#676767;}
		nav > ul ul{background: #333;border: none;}
		nav > ul ul ul{border: none;}
		nav > ul ul li:hover{background: #222;}
		nav .menu_social{border-color:#676767;}
		.dnd_service_box.dnd_service_box_round_aside h3,.dnd_service_box.dnd_service_box_aside_small h3{color:#676767;}
		input[type="text"], input[type="password"], input[type="email"], textarea {color:#222;background:#676767;border: 2px solid #919191;}
		::-webkit-input-placeholder {color: #222;}
		:-moz-placeholder {color: #222;}
		::-moz-placeholder {color: #222;}
		:-ms-input-placeholder {color: #222;}
		.dnd_service_box.dnd_service_box_round_stroke:hover .dnd_icon_boxed {box-shadow: 0 0 0 5px #222 inset;}
		.dnd_team_member_modal{background:#222;}
		.dnd_team_member_modal h4, .dnd_team_member_modal .dnd_team_member_position{color:#676767;}
		aside .widget h3{color:#676767;}
		.post_meta i{color:#676767;}
		.widget > ul li a{color:#676767;}
		.more-link {color: #676767;border: 1px solid #676767;}
		.post_wrapper {border-bottom: 1px solid #333;}
		#blog_pagination .page-numbers {color: #676767;border: 1px solid #676767;}
		#inner_post_pagination a span{color: #676767;border: 1px solid #676767;}
		#comments_section,.comment-text,#respond{border-color:#333;}
		#respond .comment-reply-title{color:#676767;}
		.dnd-accordion .ui-accordion-header{background:#333;border-color:#333;color:#676767;}
		.dnd-accordion .ui-accordion-content{border-color:#333;}
		.dnd-tabs .ui-tabs-nav li a{background:#333;color:#676767;}
		.dnd-tabs .ui-tabs-nav li,.dnd-tabs .ui-tabs-nav li:last-child,.dnd-tabs .dnd-tabs-wrapper{border-color:#333 !important;}
		.dnd-tabs .ui-tabs-nav li.ui-tabs-active:after{display:none;}
		.dnd-tabs .ui-tabs-nav li.ui-tabs-active a{color:#fff;}
		.dnd-tabs-style2 .ui-tabs-nav li.ui-tabs-active:before{display:none;}
		.dnd-button_light {border: 1px solid #676767;color: #676767 !important;}
		.dnd_meter{background:#333 !important;}
		.dnd_progress_bar_balloon .dnd_meter .dnd_meter_percentage span{background:#333;color:#999;}
		.dnd_progress_bar_balloon .dnd_meter .dnd_meter_percentage span:after {border-top-color:#333;}
		.dnd-callout_box{background:#333;color:#676767;}
		.dnd-callout_box_title{color:#676767;}
	';

}


if(isset($revelance_options['main_color']) && $revelance_options['main_color'] != ''){ /*e42382*/
	$main_color = $revelance_options['main_color'];
	$custom_css.= '
		.dnd_section_dd header h3:after{color: '.$main_color.';}
		.dnd_section_dd.pattern_overlayed a,.dnd_section_dd.color_overlayed a{color: '.$main_color.';}
		.dnd_blockquote p small{color: '.$main_color.';}
		.dnd_team_member .dnd_team_member_position{color: '.$main_color.';}
		.dnd_team_member .dnd_team_member_social_under a:hover i{color: '.$main_color.';}
		.dnd_pricing-table-1.dnd_popular-plan .dnd_pricebox_name{background: '.$main_color.';}
		.dnd_pricing-table-2.dnd_popular-plan .dnd_pricebox_name{background: '.$main_color.';}
		.dnd_pricing-table-2.dnd_popular-plan .dnd_pricebox_feature:last-of-type{border-bottom: 4px solid '.$main_color.';}
		.dnd_service_box .dnd_icon_boxed{background: '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_stroke:hover .dnd_icon_boxed{border: 1px solid '.$main_color.';background: '.$main_color.';}
		.dnd_service_box.dnd_service_box_round_aside h3:hover{color: '.$main_color.';}
		.dnd_service_box.dnd_service_box_aside_small h3:hover{color: '.$main_color.';}
		.dnd_service_box.dnd_service_box_aside_small .dnd_icon_boxed i{color: '.$main_color.';}
		.dnd_service_box_square .dnd_icon_boxed {background:none;}
		.dnd_service_box_square:hover .dnd_icon_boxed i{color: '.$main_color.';}
		.dnd-button_green{background: '.$main_color.';border: 1px solid '.$main_color.';}
		.dnd-button_dark:hover{background: '.$main_color.';border: 1px solid '.$main_color.';}
		.dnd-button_light:hover{border: 1px solid '.$main_color.';color: '.$main_color.' !important;}
		.main_title:after{color: '.$main_color.';}
		.color_highlight{color: '.$main_color.';}
		.dnd_dropcap{background: '.$main_color.';}
		.section_color_background{background: '.$main_color.';}
		.leading_line:after{background: '.$main_color.';}
		#abdev_main_header.menu_over_slider .menu_social:hover{color: '.$main_color.';border-color: '.$main_color.';}
		nav > ul > li a:hover{color: '.$main_color.';}
		nav .menu_social:hover{color: '.$main_color.';border-color: '.$main_color.';}
		nav > ul > .current-menu-item > a,nav > ul > .current-post-ancestor > a,nav > ul > .current-menu-ancestor > a{color: '.$main_color.';}
		#abdev_main_header.menu_over_slider nav > ul > li a:hover{color: '.$main_color.';}
		.tp-bullets.simplebullets.round .bullet:hover,.tp-bullets.simplebullets.round .bullet.selected{background-color:'.$main_color.';}
		.tp-caption.revelance-button:hover{border-color: '.$main_color.';background: '.$main_color.';}
		.dnd-toggle .ui-accordion-header {border: 1px solid '.$main_color.';background: '.$main_color.';}
		.dnd-toggle .ui-accordion-content {border: 1px solid '.$main_color.';}
		.dnd-tabs .ui-tabs-nav li a:hover{color:'.$main_color.';}
		.dnd-tabs .ui-tabs-nav li.ui-tabs-active:before{background: '.$main_color.';border-left: 1px solid '.$main_color.';border-right: 1px solid '.$main_color.';}
		.dnd-tabs-style2 .ui-tabs-nav li{border-top: 1px solid '.$main_color.';border-left: 1px solid '.$main_color.';border-right: 1px solid '.$main_color.';background: '.$main_color.';}
		.dnd-tabs-style2 .ui-tabs-nav li:hover a{color:#505050;}
		.dnd-tabs-style2 .ui-tabs-nav li.ui-tabs-active:before{background: #fff;border-top: 1px solid '.$main_color.';border-left: 1px solid '.$main_color.';border-right: 1px solid '.$main_color.';}
		.dnd-tabs-style2 .ui-tabs-nav li:last-child{border-right: 1px solid '.$main_color.';}
		.dnd-tabs-style2 .dnd-tabs-wrapper{border: 1px solid '.$main_color.';}
		.latest_news_shortcode_content h5{color: '.$main_color.';}
		.latest_news_shortcode_content h5 a{color: '.$main_color.';}
		.ABdev_overlayed .ABdev_overlay { background:'.$main_color.';}
		.ABdev_overlayed .ABdev_overlay p a:hover{color: '.$main_color.';}
		.dnd-callout_box{border-left: 6px solid '.$main_color.';}
		.dnd-callout_box_no_button{border-top: 6px solid '.$main_color.';}
		.ABt_testimonials_slide .testimonial_big .source,.ABt_testimonials_slide .testimonial_big .source a{color: '.$main_color.';}
		.dnd_meter .dnd_meter_percentage {background: '.$main_color.' !important;}
		.dnd_stats_excerpt .dnd_stats_number,.dnd_stats_excerpt .dnd_stats_number_sign{color: '.$main_color.';}
		.dnd_stats_excerpt i {color: '.$main_color.';}
		.dnd_stats_excerpt_style_color{background: '.$main_color.';}
		.dnd_stats_excerpt_style_color .dnd_stats_number, .dnd_stats_excerpt_style_color .dnd_stats_number_sign{color:#fff;}
		.more-link:hover{background: '.$main_color.';border: 1px solid '.$main_color.';}
		.comment .reply a:hover,.comment .edit-link a:hover{color: '.$main_color.';}
		#single_post_pagination .prev a,#single_post_pagination .next a{color: #fff;background: '.$main_color.';}
		#blog_pagination .page-numbers:hover{background: '.$main_color.';color: #fff;border-color: '.$main_color.';}
		#blog_pagination .page-numbers.current{background: '.$main_color.';color: #fff;border-color: '.$main_color.';}
		#inner_post_pagination span{border-color: '.$main_color.';background: '.$main_color.';color: #fff;}
		#inner_post_pagination a:hover span{color: #fff;background: '.$main_color.';border-color: '.$main_color.';}
		.wpcf7-submit{background: '.$main_color.' !important;}
		#abdev_contact_form_submit:hover{background: '.$main_color.' !important;}
		aside .widget a:hover{color: '.$main_color.';}
		.tagcloud a:hover{background: '.$main_color.';border: 1px solid '.$main_color.';color: #fff !important;}
		.ab-tweet-navigation a{background: '.$main_color.';color: #fff !important;}
		.portfolio_item h4 a:hover,.portfolio_item:hover h4 a{color: '.$main_color.';}
		#filters li:hover a,#filters li a.selected{background: '.$main_color.';color: #fff;border: 1px solid '.$main_color.';}
		#page404 .big_404{color: '.$main_color.';}
		#abdev_back_to_top:hover{background-color: '.$main_color.';border-color: '.$main_color.';}
		.dnd_section_dd header h3:after{color: '.$main_color.';}
		';
}


if(isset($revelance_options['main_color']) && $revelance_options['main_color'] != ''){ /*e42382*/
	$main_color = $revelance_options['main_color'];
	$responsive_custom_css= '
		@media only screen and (max-width: 767px) {
			#abdev_main_header nav a:hover,
			#abdev_main_header nav .current-menu-item > a{
				color: '.$main_color.';
			}
		}
	';
}
