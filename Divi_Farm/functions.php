<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'childtheme-style', get_stylesheet_directory_uri(). '/style.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
	if (function_exists('is_product') && is_product()) {}
        wp_enqueue_script('woocommerce-ajax-add-to-cart', get_stylesheet_directory_uri() . '/assets/ajax-add-to-cart.js', array('jquery'), '', true);
    
}
	

//======================================================================
// CUSTOM DASHBOARD
//======================================================================
// ADMIN FOOTER TEXT
function remove_footer_admin () {
    echo "Divi Child Theme";
} 

add_filter('admin_footer_text', 'remove_footer_admin');

function mjt_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mjt_add_woocommerce_support' );

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'add-ons', 'size' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );


    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );  
/*
* Change number of products per row to 3
*/ 
function mjt_diviecommerce_loop_columns() { 
	return 3;
	// 3 products per row
} 
add_filter('loop_shop_columns' , 'mjt_diviecommerce_loop_columns', 999);
											  

// Add "Add to Cart" buttons in Divi shop pages
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 20 );

/**
 * @snippet       Ajax Add Cart Quantity @ WooCommerce Shop
 */ 
 
add_filter( 'woocommerce_loop_add_to_cart_link', 'mjt_ajax_quantity_shop', 9999, 3 );
 
function mjt_ajax_quantity_shop( $html, $product, $args ) {
   if ( $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ) {
      $html = '<div class="abf_quantity">' . woocommerce_quantity_input( array(), $product, false ) . '</div>' .  $html;
   }
   return $html;
}
 
add_action( 'woocommerce_after_shop_loop', 'mjt_add_cart_loop_js' );
 
function mjt_add_cart_loop_js() {
   wc_enqueue_js( "
       $(document).on('change','.quantity .qty',function(){
          $(this).closest('li.product').find('a.ajax_add_to_cart').attr('data-quantity',$(this).val());
       });
   " );
}


function mjt_custom_order_product_load()
{
   if( isset($_POST['rdo_choosen_plan'])){
	   $choosen_plan = $_POST['rdo_choosen_plan'] ;
	   $choosen_box = $_POST['rdo_choosen_box'] ;
	   $type_of_meat = $_POST['rdo_type_of_meat'] ;
	   $cat =  $choosen_plan . ', ' . $choosen_box . ', ' .$type_of_meat ;
	   echo '<!---' .$cat .'-->' ; 
	  // setup query
		$args = array(
			'post_type' 	=> 'product',
			'post_status' 	=> 'publish',
			'tax_query' 	=> array(
				'relation'  => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'name',
					'terms'    => array( $type_of_meat ),
				),
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'name',
					'terms'    => array( 'Add-Ons' ),
				),
				
					 array(
						  'taxonomy' => 'product_cat',
						  'field'    => 'name',
						  'terms'    => array( $choosen_box  ),
					 ),
					 array(
						  'taxonomy' => 'product_cat',
						  'field'    => 'name',
						  'terms'    => array( $choosen_plan ),
					 ),
				
			),			
		);
		
		// query database
		$products = new WP_Query( $args );
		 echo '<!--- ';
		print_r($args); echo ' ---> ';
	  echo '<!--- ' . $products->found_posts . '<br/>--> '; 
		if ( $products->have_posts() ) : 
	   
			woocommerce_product_loop_start(); 
				while ( $products->have_posts() ) : $products->the_post();
					woocommerce_get_template_part( 'customorder', 'product' );
				endwhile; // end of the loop. 	 
			woocommerce_product_loop_end(); 
			else:
			do_action( 'woocommerce_no_products_found' );
		endif; 
		wp_reset_postdata();	     
   } else {
     echo get_bloginfo( 'title' );
   }
   exit();
}

// creating Ajax call for WordPress  
add_action('wp_ajax_nopriv_mjt_custom_order_product_load', 'mjt_custom_order_product_load');
add_action('wp_ajax_mjt_custom_order_product_load', 'mjt_custom_order_product_load'); 

function mjt_about_us_page_animation(){
	?>
	<script type="text/javascript">
	
	jQuery(document).ready(function() {
		
	var hellos = ["What My Family Is Eating", "That My Money Stays In Alberta.", "That I Am Getting A Fair Price.", "That My Way of Life Is Protected.", "Where My Meat Comes From.", "That Alberta Farmers.", "Are Treated Fairly.", "That Livestock Are Raised.", "In Open Prairie Not In Pens.", "That I Have A Right To Choose."];
		var index = 0;     
		var getvalue = hellos[0] ; 		
		jQuery("#hellos").text(getvalue)   ;           

		(function animate() {                         
		  jQuery("#hellos").fadeOut(2000, function() {     
			index = (index + 1) % hellos.length;  
			  var getvalue2 = hellos[index] ;
			jQuery("#hellos").html('').append(getvalue2);         
		  }).fadeIn(2500, animate);                  
		})();
	}); 
	</script>
	<?php 
}

add_action('wp_footer','mjt_about_us_page_animation');

/* Add to cart Ajax*/ 

add_action('wp_ajax_mjt_woocommerce_ajax_add_to_cart', 'mjt_woocommerce_ajax_add_to_cart'); 
add_action('wp_ajax_nopriv_mjt_woocommerce_ajax_add_to_cart', 'mjt_woocommerce_ajax_add_to_cart');          
function mjt_woocommerce_ajax_add_to_cart() {
	$_SESSION['meat_type'] =	'';
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id); 
	 $_SESSION['meat_type'] = $_POST['meattype'] ;
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 
        do_action('woocommerce_ajax_added_to_cart', $product_id);
           
            WC_AJAX :: get_refreshed_fragments(); 
		
            } else { 
                $data = array( 
                    'error' => true,
                    'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
                echo wp_send_json($data);
            }
            wp_die();
 }

function mjt_register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}
// add_action('init', 'mjt_register_my_session');

/**
 * Remove Product Link at page "Place an Order"
 */
add_action('init','mjt_remove_product_url');
 
function mjt_remove_product_url_init(){
	if(is_page('place-an-order')) {
		
	}
}
 
function mjt_remove_product_url() {
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}

/**
 *  Show product short description @ WooCommerce Loop
 */ 
// add_action( 'woocommerce_after_shop_loop_item_title', 'mjt_shop_product_short_description', 35, 2 );
 
function mjt_shop_product_short_description() {
	if(is_page('place-an-order')) {} 
	echo '<div class="p_excerpt"><button type="button" class="collapsible">Read More:</button><div class="collaps_content">' ;
     the_excerpt();	
	echo '</div></div>';
} 

/**
 * @snippet       Display All Single Variations Shortcode 
 */
add_shortcode( 'single_variations', 'mjt_single_variations_shortcode' );
 
function mjt_single_variations_shortcode() {   
   $query = new WP_Query( array(
      'post_type' => array('product_variation', 'product'),
      'post_status' => 'publish',
      'posts_per_page' => 24,
      'paged' => absint( empty( $_GET['product-page'] ) ? 1 : $_GET['product-page'] ),
   ));
   if ( $query->have_posts() ) {
      ob_start();
      wc_setup_loop(
         array(
            'name' => 'single_variations',
            'is_shortcode' => true,
            'is_search' => false,
            'is_paginated' => true,
            'total' => $query->found_posts,
            'total_pages' => $query->max_num_pages,
            'per_page' => $query->get( 'posts_per_page' ),
            'current_page' => max( 1, $query->get( 'paged', 1 ) ),
         )
      );
      woocommerce_pagination();
	   echo '<div class="woocommerce woo_products_result">';
      woocommerce_product_loop_start();
      while ( $query->have_posts() ) {
         $query->the_post();
         wc_get_template_part( 'content', 'product' );
      }
      woocommerce_product_loop_end();
	    echo '</div>'; 
      woocommerce_pagination();
      wp_reset_postdata();
      wc_reset_loop();
      return ob_get_clean();
   }
   return;
}