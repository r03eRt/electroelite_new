<?php 
	global $revelance_options;
?>
<header id="abdev_main_header" class="clearfix">
	<div class="container">
		<div id="logo">
			<a href="<?php echo home_url(); ?>">
				<img id="main_logo" src="<?php echo (isset($revelance_options['header_logo']['url']) && $revelance_options['header_logo']['url'] != '') ? $revelance_options['header_logo']['url'] : TEMPPATH.'/images/logo.png';?>" alt="<?php bloginfo('name');?>">
				<img id="inversed_logo" src="<?php echo (isset($revelance_options['inversed_header_logo']['url']) && $revelance_options['inversed_header_logo']['url'] != '') ? $revelance_options['inversed_header_logo']['url'] : TEMPPATH.'/images/logo_inversed.png';?>" alt="<?php bloginfo('name');?>">
			</a>
		</div>
		<nav>
			<?php
			if(isset($revelance_options['facebook']) && $revelance_options['facebook']!=''){
				echo'<a class="menu_social menu_social_facebook" href="'.$revelance_options['facebook'].'" target="_blank" title="'.__('Follow us on Facebook', 'dnd-shortcodes').'"><i class="entypo-facebook"></i></a>';
			}
			if(isset($revelance_options['twitter']) && $revelance_options['twitter']!=''){
				echo'<a class="menu_social menu_social_twitter" href="'.$revelance_options['twitter'].'" target="_blank" title="'.__('Follow us on Twitter', 'dnd-shortcodes').'"><i class="entypo-twitter"></i></a>';
			}
			if(isset($revelance_options['googleplus']) && $revelance_options['googleplus']!=''){
				echo'<a class="menu_social menu_social_googleplus" href="'.$revelance_options['googleplus'].'" target="_blank" title="'.__('Follow us on Google+', 'dnd-shortcodes').'"><i class="entypo-googleplus"></i></a>';
			}
			if(isset($revelance_options['linkedin']) && $revelance_options['linkedin']!=''){
				echo'<a class="menu_social menu_social_linkedin" href="'.$revelance_options['linkedin'].'" target="_blank" title="'.__('Follow us on Linkedin', 'dnd-shortcodes').'"><i class="entypo-linkedin"></i></a>';
			}
			if(isset($revelance_options['pinterest']) && $revelance_options['pinterest']!=''){
				echo'<a class="menu_social menu_social_pinterest" href="'.$revelance_options['pinterest'].'" target="_blank" title="'.__('Follow us on Pinterest', 'dnd-shortcodes').'"><i class="entypo-pinterest"></i></a>';
			}
			if(isset($revelance_options['github']) && $revelance_options['github']!=''){
				echo'<a class="menu_social menu_social_github" href="'.$revelance_options['github'].'" target="_blank" title="'.__('Follow us on Github', 'dnd-shortcodes').'"><i class="entypo-github"></i></a>';
			}
			if(isset($revelance_options['feed']) && $revelance_options['feed']!=''){
				echo'<a class="menu_social menu_social_feed" href="'.$revelance_options['feed'].'" target="_blank" title="'.__('Our RSS feed', 'dnd-shortcodes').'"><i class="entypo-rss"></i></a>';
			}
			if(isset($revelance_options['behance']) && $revelance_options['behance']!=''){
				echo'<a class="menu_social menu_social_behance" href="'.$revelance_options['behance'].'" target="_blank" title="'.__('Our Behance Profile', 'dnd-shortcodes').'"><i class="entypo-behance"></i></a>';
			}
			if(isset($revelance_options['dribbble']) && $revelance_options['dribbble']!=''){
				echo'<a class="menu_social menu_social_dribbble" href="'.$revelance_options['dribbble'].'" target="_blank" title="'.__('Our Dribbble Profile', 'dnd-shortcodes').'"><i class="entypo-dribbble"></i></a>';
			}
			if(isset($revelance_options['dropbox']) && $revelance_options['dropbox']!=''){
				echo'<a class="menu_social menu_social_dropbox" href="'.$revelance_options['dropbox'].'" target="_blank" title="'.__('Our Dropbox Files', 'dnd-shortcodes').'"><i class="entypo-dropbox"></i></a>';
			}
			if(isset($revelance_options['mail']) && $revelance_options['mail']!=''){
				echo'<a class="menu_social menu_social_emailalt" href="mailto:'.$revelance_options['mail'].'" target="_blank" title="'.__('Send Us Email', 'dnd-shortcodes').'"><i class="entypo-mail"></i></a>';
			}
			if(isset($revelance_options['flickr']) && $revelance_options['flickr']!=''){
				echo'<a class="menu_social menu_social_flickr" href="'.$revelance_options['flickr'].'" target="_blank" title="'.__('Our Flickr Profile', 'dnd-shortcodes').'"><i class="entypo-flickr"></i></a>';
			}
			if(isset($revelance_options['instagram']) && $revelance_options['instagram']!=''){
				echo'<a class="menu_social menu_social_instagram" href="'.$revelance_options['instagram'].'" target="_blank" title="'.__('Our Instagram Profile', 'dnd-shortcodes').'"><i class="entypo-instagram"></i></a>';
			}
			if(isset($revelance_options['lastfm']) && $revelance_options['lastfm']!=''){
				echo'<a class="menu_social menu_social_lastfm" href="'.$revelance_options['lastfm'].'" target="_blank" title="'.__('Our last.fm Profile', 'dnd-shortcodes').'"><i class="entypo-lastfm"></i></a>';
			}
			if(isset($revelance_options['picasa']) && $revelance_options['picasa']!=''){
				echo'<a class="menu_social menu_social_picasa" href="'.$revelance_options['picasa'].'" target="_blank" title="'.__('Our Picasa Profile', 'dnd-shortcodes').'"><i class="entypo-picasa"></i></a>';
			}
			if(isset($revelance_options['skype']) && $revelance_options['skype']!=''){
				echo'<a class="menu_social menu_social_skype" href="'.$revelance_options['skype'].'" target="_blank" title="'.__('Our Skype Profile', 'dnd-shortcodes').'"><i class="entypo-skype"></i></a>';
			}
			if(isset($revelance_options['stumbleupon']) && $revelance_options['stumbleupon']!=''){
				echo'<a class="menu_social menu_social_stumbleupon" href="'.$revelance_options['stumbleupon'].'" target="_blank" title="'.__('Our StumbleUpon Profile', 'dnd-shortcodes').'"><i class="entypo-stumbleupon"></i></a>';
			}
			if(isset($revelance_options['vimeo']) && $revelance_options['vimeo']!=''){
				echo'<a class="menu_social menu_social_vimeo" href="'.$revelance_options['vimeo'].'" target="_blank" title="'.__('Our Vimeo Profile', 'dnd-shortcodes').'"><i class="entypo-vimeo"></i></a>';
			}
			if(isset($revelance_options['youtube']) && $revelance_options['youtube']!=''){
				echo'<a class="menu_social menu_social_youtube" href="'.$revelance_options['youtube'].'" target="_blank" title="'.__('Our YouTube Profile', 'dnd-shortcodes').'"><i class="entypo-video"></i></a>';
			}

			wp_nav_menu( array( 'theme_location' => 'header-menu','container' => false,'menu_id' => 'main_menu','menu_class' => '','walker'=> new revelance_walker_nav_menu, 'fallback_cb' => false ) );?>
		</nav>
		<div id="ABdev_menu_toggle"><i class="entypo-list2"></i></div>
	</div>
</header>