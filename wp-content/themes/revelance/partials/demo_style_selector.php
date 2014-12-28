<style type="text/css">
#picker{
	top:200px;
	left:-189px;
	position:fixed;
	width:189px;
	z-index:10000;
}
.picker-heading{
	-webkit-border-radius:0px 3px 3px 0px;
	border-radius:0px 3px 3px 0px;
	color:#ffffff;
	background:#2b2b2b;
	padding:10px 11px 10px 20px;
	margin-right:-40px;
	font-size:14px;
	font-weight:bold;
	cursor:pointer;
	-webkit-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.2);
	box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.2);
	position:relative;
	z-index:1;
}
.picker-options{
	background:#373737;
	-webkit-border-radius:0px 0px 3px 0px;
	border-radius:0px 0px 3px 0px;
	color:#ffffff;
	-webkit-box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.2);
	box-shadow:0px 0px 5px 0px rgba(0, 0, 0, 0.2);
	position:relative;
	z-index:0;
}
.picker-section{
	padding:10px 0px 10px 6px;
	margin-bottom:5px;
}
.picker-section.last{
	border:none;
	margin-left:4px;
	padding-right:4px;
}
.picker-section ul{
	list-style:none;
	margin-left:0px;
	padding-left:0px;
}
.picker-section li{
	float:left;
	margin:4px;
}
.message{
	color:#cccccc;
	font-size:11px;
	line-height:19px;
}

@media only screen and (max-width:979px){
	#picker{
		top:250px;
	}
}

@media only screen and (max-width:767px){
	#picker{
		display:none;
	}
}

.ABdev_change_style_select{
	display: block;
	width: 30px;
	height: 30px;
	overflow: hidden;
}

.ABdev_style_green{background: #e42382;}
.ABdev_style_yellow{background: #ffd800;}
.ABdev_style_blue{background: #3598db;}
.ABdev_style_greendark{background: #1bbc9b;}
.ABdev_style_purple{background: #9b58b5;}
.ABdev_style_orange{background: #e77e23;}
</style>

<style type="text/css" id="demo_picker_styles">
</style>


<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#picker').delay(800).animate({'left' :'0px'}, 600, 'easeOutExpo').delay(2000).animate({'left' :'-189px'}, 600, 'easeOutExpo');

			$(".picker-heading").click(function(){
				var pos = $('#picker').position();
				if(pos.left == 0)
					$('#picker').animate({'left' :'-189px'}, 600, 'easeOutExpo');
				else
					$('#picker').animate({'left' :'0px'}, 600, 'easeOutExpo');
			});

			$('.ABdev_change_style_select').click(function(e){
				e.preventDefault();
				var style = $(this).data('style');
				var css = '.dnd_section_dd header h3:after{color: '+style+';}.dnd_section_dd.pattern_overlayed a,.dnd_section_dd.color_overlayed a{color: '+style+';}.dnd_blockquote p small{color: '+style+';}.dnd_team_member .dnd_team_member_position{color: '+style+';}.dnd_team_member .dnd_team_member_social_under a:hover i{color: '+style+';}.dnd_pricing-table-1.dnd_popular-plan .dnd_pricebox_name{background: '+style+';}.dnd_pricing-table-2.dnd_popular-plan .dnd_pricebox_name{background: '+style+';}.dnd_pricing-table-2.dnd_popular-plan .dnd_pricebox_feature:last-of-type{border-bottom: 4px solid '+style+';}.dnd_service_box .dnd_icon_boxed{background: '+style+';}.dnd_service_box.dnd_service_box_round_stroke:hover .dnd_icon_boxed{border: 1px solid '+style+';background: '+style+';}.dnd_service_box.dnd_service_box_round_aside h3:hover{color: '+style+';}.dnd_service_box.dnd_service_box_aside_small h3:hover{color: '+style+';}.dnd_service_box.dnd_service_box_aside_small .dnd_icon_boxed i{color: '+style+';}.dnd_service_box_square .dnd_icon_boxed {background:none;}.dnd_service_box_square:hover .dnd_icon_boxed i{color: '+style+';}.dnd-button_green{background: '+style+';border: 1px solid '+style+';}.dnd-button_dark:hover{background: '+style+';border: 1px solid '+style+';}.dnd-button_light:hover{border: 1px solid '+style+';color: '+style+' !important;}.main_title:after{color: '+style+';}.color_highlight{color: '+style+';}.dnd_dropcap{background: '+style+';}.section_color_background{background: '+style+';}.leading_line:after{background: '+style+';}#abdev_main_header.menu_over_slider .menu_social:hover{color: '+style+';border-color: '+style+';}nav > ul > li a:hover{color: '+style+';}nav .menu_social:hover{color: '+style+';border-color: '+style+';}nav > ul > .current-menu-item > a,nav > ul > .current-post-ancestor > a,nav > ul > .current-menu-ancestor > a{color: '+style+';}#abdev_main_header.menu_over_slider nav > ul > li a:hover{color: '+style+';}.tp-bullets.simplebullets.round .bullet:hover,.tp-bullets.simplebullets.round .bullet.selected{background-color:'+style+';}.tp-caption.revelance-button:hover{border-color: '+style+';background: '+style+';}.dnd-toggle .ui-accordion-header {border: 1px solid '+style+';background: '+style+';}.dnd-toggle .ui-accordion-content {border: 1px solid '+style+';}.dnd-tabs .ui-tabs-nav li a:hover{color:'+style+';}.dnd-tabs .ui-tabs-nav li.ui-tabs-active:before{background: '+style+';border-left: 1px solid '+style+';border-right: 1px solid '+style+';}.dnd-tabs-style2 .ui-tabs-nav li{border-top: 1px solid '+style+';border-left: 1px solid '+style+';border-right: 1px solid '+style+';background: '+style+';}.dnd-tabs-style2 .ui-tabs-nav li:hover a{color:#505050;}.dnd-tabs-style2 .ui-tabs-nav li.ui-tabs-active:before{background: #fff;border-top: 1px solid '+style+';border-left: 1px solid '+style+';border-right: 1px solid '+style+';}.dnd-tabs-style2 .ui-tabs-nav li:last-child{border-right: 1px solid '+style+';}.dnd-tabs-style2 .dnd-tabs-wrapper{border: 1px solid '+style+';}.latest_news_shortcode_content h5{color: '+style+';}.latest_news_shortcode_content h5 a{color: '+style+';}.ABdev_overlayed .ABdev_overlay { background:'+style+';}.ABdev_overlayed .ABdev_overlay p a:hover{color: '+style+';}.dnd-callout_box{border-left: 6px solid '+style+';}.dnd-callout_box_no_button{border-top: 6px solid '+style+';}.ABt_testimonials_slide .testimonial_big .source,.ABt_testimonials_slide .testimonial_big .source a{color: '+style+';}.dnd_meter .dnd_meter_percentage {background: '+style+' !important;}.dnd_stats_excerpt .dnd_stats_number,.dnd_stats_excerpt .dnd_stats_number_sign{color: '+style+';}.dnd_stats_excerpt i {color: '+style+';}.dnd_stats_excerpt_style_color{background: '+style+';}.dnd_stats_excerpt_style_color .dnd_stats_number, .dnd_stats_excerpt_style_color .dnd_stats_number_sign{color:#fff;}.more-link:hover{background: '+style+';border: 1px solid '+style+';}.comment .reply a:hover,.comment .edit-link a:hover{color: '+style+';}#single_post_pagination .prev a,#single_post_pagination .next a{color: #fff;background: '+style+';}#blog_pagination .page-numbers:hover{background: '+style+';color: #fff;border-color: '+style+';}#blog_pagination .page-numbers.current{background: '+style+';color: #fff;border-color: '+style+';}#inner_post_pagination span{border-color: '+style+';background: '+style+';color: #fff;}#inner_post_pagination a:hover span{color: #fff;background: '+style+';border-color: '+style+';}.wpcf7-submit{background: '+style+' !important;}#abdev_contact_form_submit:hover{background: '+style+' !important;}aside .widget a:hover{color: '+style+';}.tagcloud a:hover{background: '+style+';border: 1px solid '+style+';color: #fff !important;}.ab-tweet-navigation a{background: '+style+';color: #fff !important;}.portfolio_item h4 a:hover,.portfolio_item:hover h4 a{color: '+style+';}#filters li:hover a,#filters li a.selected{background: '+style+';color: #fff;border: 1px solid '+style+';}#page404 .big_404{color: '+style+';}#abdev_back_to_top:hover{background-color: '+style+';border-color: '+style+';}.dnd_section_dd header h3:after{color: '+style+';}';
				$('#demo_picker_styles').html(css);
			});
		});
</script>


<div id="picker" style="left: -189px;">
	<div class="picker-heading">
		<?php _e('Select Style', 'ABdev_revelance'); ?> <i class="entypo-cog color_highlight" style="float:right;font-size:18px;"></i>
	</div>
	<div class="picker-options">
		<div class="picker-section clearfix">
			<ul>
				<li><a href="#" class="ABdev_change_style_select" style="background: #e42382;" data-style="#e42382" title="#e42382"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #9b58b5;" data-style="#9b58b5" title="#9b58b5"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #93af49;" data-style="#93af49" title="#93af49"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #3598db;" data-style="#3598db" title="#3598db"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #e77e23;" data-style="#e77e23" title="#e77e23"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #ffd800;" data-style="#ffd800" title="#ffd800"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #c94646;" data-style="#c94646" title="#c94646"></a></li>
				<li><a href="#" class="ABdev_change_style_select" style="background: #1bbc9b;" data-style="#1bbc9b" title="#1bbc9b"></a></li>
			</ul>
		</div>
		<div class="picker-section message last clearfix">
			<?php _e('These are just predefined colors. Unlimited color combinations are possible via theme options color pickers', 'ABdev_revelance'); ?>
		</div>
	</div>
</div>