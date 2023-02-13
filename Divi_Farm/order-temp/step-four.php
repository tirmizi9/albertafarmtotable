<h2 class="fs-title">Select Addons</h2>
<p class="fs-subtitle step-subtitle"><b>Use these addons to customize parts of your order. We will reach out to confirm flavours and quantity when we have received your order. </b></p>
<div class="woocommerce woo_products_result">
	<ul class="products columns-4">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12,
			'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => 'add-ons',
					),
				),
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'customorder', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul>
</div>			
			<div class="col-12 col-sm-12 col-md-12 row_button">
				<input type="button" name="previous" class="previous action-button" value="Previous" data-step="four"/>
				<input type="button" name="cart" class="submit_order action-button" value="Cart" data-step="four"/>
			    <!--- 
				<input type="submit" name="submit" class="submit action-button" value="Cart" data-step="four"/>
				<a class="action-button select_addons" title="Cart" href="https://demo.tirmizi.net/45/cart/"/ style="padding: 12px 24px;">Cart </a>
				-->
				
			</div>
			