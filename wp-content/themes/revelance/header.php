<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
	global $revelance_options;
?>
<title><?php bloginfo('name'); wp_title(' - ',true); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo (isset($revelance_options['favicon']['url']) && $revelance_options['favicon']['url'] != '') ? $revelance_options['favicon']['url'] : TEMPPATH.'/images/favicon.png';?>" />
		
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php 
$classes='';

if(isset($revelance_options['enable_preloader']) && $revelance_options['enable_preloader']==1){
	$classes = 'preloader';
}

if ( is_singular() ){
	wp_enqueue_script( "comment-reply" );
}
wp_head();
?>
</head>

<body <?php body_class($classes); ?>>




