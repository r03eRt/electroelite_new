<?php
// Usage: [portfolio category="" count=""]
function ABp_portfolio_shortcode($atts, $content){
	extract(shortcode_atts(array( 
		'category' 		=> '',
		'count' 		=> '8',
	), $atts));


	$cat = ($category!='') ? '&portfolio-category='.$category : '';

	$query='post_type=portfolio&posts_per_page='.$count.$cat;

	$post = new WP_Query( $query );
	$out = $error = '';
	if ($post->have_posts()){
		while ($post->have_posts()){
			$post->the_post();
			$slugs=$in_category='';		
			$terms = get_the_terms( get_the_ID() , 'portfolio-category' );
			foreach ( $terms as $term ) {
				if(is_object($term)){
					$slugs.=' '.$term->slug;
					$filter_slugs[$term->slug] = $term->name;
					$in_category[] = $term->name;
				}
			}

			$in_category = implode(', ', $in_category);

			$thumbnail_id = get_post_thumbnail_id(get_the_ID());
			$thumbnail_object = get_post($thumbnail_id);
			$thumbnail_src=$thumbnail_object->guid;

			$custom = get_post_custom(get_the_ID());
			$effect = (isset($custom["ABp_portfolio_effect"][0])) ? $custom["ABp_portfolio_effect"][0] : 'sadie'; 

			$out .= '<div class="portfolio_item portfolio_item_4' . $slugs . '">
				<figure class="effect-'.$effect.'">
					' . get_the_post_thumbnail() . '
					<figcaption>
						<h4>' . get_the_title() . '</h4>
						<p>'.$in_category.'</p>
						<a href="' . get_permalink() . '"></a>
					</figcaption>			
				</figure>
			</div>
			';
		}
	}
	wp_reset_postdata();
	$filter_out='<li><a href="#filter" data-option-value="*" class="selected">All</a></li>';
	foreach($filter_slugs as $slug => $name){
		$filter_out.='<li><a href="#filter" data-option-value=".'.$slug.'">'.$name.'</a></li>';
	}

	return '
		<ul id="filters" class="portfolio_filter option-set clearfix" data-option-key="filter">'.$filter_out.'</ul>
		<div id="abdev_latest_portfolio" class="clearfix ab_latest_portfolio">
			' . $out . '
		</div>';

}
add_shortcode( 'portfolio', 'ABp_portfolio_shortcode');


function ABp_scripts() {
	wp_enqueue_style('ABp_portfolio_shortcode', plugins_url().'/abdev-portfolio/css/portfolio_shortcode.css');
}
add_action( 'wp_enqueue_scripts', 'ABp_scripts' );

