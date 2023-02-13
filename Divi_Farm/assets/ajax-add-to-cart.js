jQuery(document).ready(function($) {
    $('.submit_order').on('click', function(e){ 
    e.preventDefault();
    $thisbutton = $(this),
		$loader = $('.loader'),
                $form = $thisbutton.closest('form.cart'),
                id = $thisbutton.val(),
				idd = $('.rdo_choosen_box').attr('data-val'),
				meattype = $('.rdo_type_of_meat').attr('data-val')
                product_qty = $form.find('input[name=quantity]').val() || 1,
                product_id = $form.find('input[name=product_id]').val() || idd,
                variation_id = $form.find('input[name=variation_id]').val() || 0;
    var data = {
            action: 'mjt_woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
			meattype: meattype,
        };
    $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $loader.removeClass('loader').addClass('gifloading');
            },
            complete: function (response) {
               /* $loader.addClass('loader').removeClass('gifloading'); */
            }, 
            success: function (response) { 
                if (response.error & response.product_url) {
					$loader.addClass('loader').removeClass('gifloading');
					alert('There is somthing Error, Please strat over step 2');
                    /* window.location = response.product_url; */
                    return;
                } else { 
					window.location = 'https://demo.tirmizi.net/45/cart/';
                    /* $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]); */
                } 
            }, 
        }); 
     }); 
});

