<?php 

/**
	woocommerce plugin support
**/
if( in_array('woocommerce/woocommerce.php', get_option('active_plugins')) ){ //first check if plugin is installed


	$ABdevDND_shortcodes['recent_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Recent products', 'dnd-shortcodes'),
	);



	$ABdevDND_shortcodes['featured_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Featured products', 'dnd-shortcodes'),
	);



	$ABdevDND_shortcodes['products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'ids' => array(
				'description' => __('IDs', 'dnd-shortcodes'),
				'info' => __('coma separated list of product IDs', 'dnd-shortcodes'),
			),
			'skus' => array(
				'description' => __('SKUs', 'dnd-shortcodes'),
				'info' => __('coma separated list of product SKUs', 'dnd-shortcodes'),
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'info' => __('Show multiple products by IDs or SKUs. To find the Product ID, go to the Product > Edit screen and look in the URL for the postid=', 'dnd-shortcodes'),
		'description' => __('Products', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['product'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => __('ID', 'dnd-shortcodes'),
			),
			'sku' => array(
				'description' => __('SKU', 'dnd-shortcodes'),
			),
		),
		'info' => __('Show a single product by ID or SKU. To find the Product ID, go to the Product > Edit screen and look in the URL for the postid=', 'dnd-shortcodes'),
		'description' => __('Product', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['add_to_cart'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => __('ID', 'dnd-shortcodes'),
			),
			'sku' => array(
				'description' => __('SKU', 'dnd-shortcodes'),
			),
		),
		'info' => __('Show the price and add to cart button of a single product by ID.', 'dnd-shortcodes'),
		'description' => __('Add to cart', 'dnd-shortcodes'),
	);


	$ABdevDND_shortcodes['add_to_cart_url'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => __('ID', 'dnd-shortcodes'),
			),
			'sku' => array(
				'description' => __('SKU', 'dnd-shortcodes'),
			),
		),
		'info' => __('Echo the URL on the add to cart button of a single product by ID.', 'dnd-shortcodes'),
		'description' => __('Add to cart URL', 'dnd-shortcodes'),
	);



	$ABdevDND_shortcodes['product_page'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => __('ID', 'dnd-shortcodes'),
			),
			'sku' => array(
				'description' => __('SKU', 'dnd-shortcodes'),
			),
		),
		'info' => __('Show a full single product page by ID or SKU.', 'dnd-shortcodes'),
		'description' => __('Product page', 'dnd-shortcodes'),
	);


	$ABdevDND_shortcodes['product_category'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'category' => array(
				'description' => __('Category', 'dnd-shortcodes'),
				'info' => __('Go to: WooCommerce > Products > Categories to find the slug column.', 'dnd-shortcodes'),
			),
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'ASC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Product category', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['product_categories'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'number' => array(
				'description' => __('Number', 'dnd-shortcodes'),
				'info' => __('Used to display the number of products', 'dnd-shortcodes'),
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'ASC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
			'hide_empty' => array(
				'description' => __('Hide Empty', 'dnd-shortcodes'),
				'default' => '1',
				'type' => 'checkbox',
			),
			'ids' => array(
				'description' => __('IDs', 'dnd-shortcodes'),
				'info' => __('Set ids to a comma separated list of category ids to only show those.', 'dnd-shortcodes'),
			),
			'parent' => array(
				'description' => __('Parent', 'dnd-shortcodes'),
				'info' => __('Set to 0 to only display top level categories.', 'dnd-shortcodes'),
			),
		),
		'description' => __('Product Categories', 'dnd-shortcodes'),
	);


	$ABdevDND_shortcodes['sale_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Sale Products', 'dnd-shortcodes'),
	);


	$ABdevDND_shortcodes['best_selling_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
		),
		'description' => __('Best Selling Products', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['top_rated_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Top Rated Products', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['product_attribute'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => __( 'Order', 'dnd-shortcodes' ),
				'values' => array(
					'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
					'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
				),      
			),
			'attribute' => array(
				'description' => __('Attribute', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
			),
			'filter' => array(
				'description' => __('Filter', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
			),
		),
		'info' => __('List products with filter by an attribute', 'dnd-shortcodes'),
		'description' => __('Product Attribute', 'dnd-shortcodes'),
	);




	$ABdevDND_shortcodes['related_products'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => __('Per Page', 'dnd-shortcodes'),
				'info' => __('How many products to show', 'dnd-shortcodes'),
				'default' => '12',
			),
			'columns' => array(
				'description' => __('Columns', 'dnd-shortcodes'),
				'info' => __('Number of columns to show', 'dnd-shortcodes'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => __( 'Order by', 'dnd-shortcodes' ),
				'values' => array(
					'ID' =>  __( 'ID', 'dnd-shortcodes' ),
					'none' =>  __( 'none', 'dnd-shortcodes' ),
					'author' =>  __( 'author', 'dnd-shortcodes' ),
					'title' =>  __( 'title', 'dnd-shortcodes' ),
					'name' =>  __( 'name', 'dnd-shortcodes' ),
					'date' =>  __( 'date', 'dnd-shortcodes' ),
					'modified' =>  __( 'modified', 'dnd-shortcodes' ),
					'parent' =>  __( 'parent', 'dnd-shortcodes' ),
					'rand' =>  __( 'rand', 'dnd-shortcodes' ),
					'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
					'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
				),      
			),
		),
		'description' => __('Related Products', 'dnd-shortcodes'),
	);

}

