<?php
/*
 * Template Name: Custom Order Form
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	elegant_description();
	elegant_keywords();
	elegant_canonical();

	/**
	 * Fires in the head, before {@see wp_head()} is called. This action can be used to
	 * insert elements into the beginning of the head before any styles or scripts.
	 *
	 * @since 1.0
	 */
	do_action( 'et_head_meta' );

	$template_directory_uri = get_template_directory_uri();
?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/form.css">

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap.min.css">
	
	<style>
	.container{ padding-top: 25px !important;}
	.order_template_logo_container{
		margin: 0 auto 20px;
		text-align: center;
	}
	/* .product-type-variable{ display:none; } */
	.order_template_logo_container a img{ max-height: 80px !important; }
	.top-buffer { margin-top:20px; }  
		.woo_products_resul ul.products li.product{ width: 30.05% ; } 
		.modal-open .modal{ background: rgba(0,0,0,0.5); }
		.modal-body { float: left; }
		.modal-body p label, .modal-body p label span, .modal-body p label span input, .modal-body p label span textarea{ 
		   float: left; 
			width: 100% ;
		} 
		.modal-body p .wpcf7-submit{ 
			background-color: #0d3692;
			border-width: 1px!important;
			border-color: #0d3692;
			border-radius: 4px;
			font-weight: normal;
			font-style: normal;
			text-transform: none;
			text-decoration: none;
			color: #fff;
			padding: 8px 16px; 
		} 
		.modal-title {			
			color: #0d3692;
			font-weight: 600;
			text-align: center;
		}
	</style>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	wp_body_open();


$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content" class="order_page_container">

	<div class="container">
	<?php
				$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && '' != $user_logo
					? $user_logo
					: $template_directory_uri . '/images/logo.png';
			?>
			<div class="col-12 col-sm-12 col-md-12">
				<div class="logo_container align-center order_template_logo_container">
					<span class="logo_helper"></span>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" data-height-percentage="<?php echo esc_attr( et_get_option( 'logo_height', '54' ) ); ?>" height="120"/>
					</a>
				</div>
			</div>
		<!-- multistep form -->
		<form id="msform" class="container-sm cart">
		  <!-- progressbar -->
		  <ul id="progressbar">
			<li class="active">Select types of meat </li>
			<li>Choose Cut Size</li>
			<li>Select your plan</li>
			<li>Personal Details</li>
		  </ul>
		  <!-- fieldsets -->
		  <fieldset class="row row_type_of_meat">
				<?php get_template_part('order-temp/step','one');?>
		  </fieldset>
		  
		  <!--fieldset 2--->
		  <fieldset class="row">
				<?php get_template_part('order-temp/step','two');?>
		  </fieldset>
		  
		<!--fieldset 3--->
		  <fieldset class="row">
				<?php get_template_part('order-temp/step','three');?>
		  </fieldset>
		<!--fieldset 4--->
		  <fieldset class="row">
				<?php get_template_part('order-temp/step','four');?>
		  </fieldset>
		  <input type="hidden" name="hidden_type_of_meat" class="rdo_type_of_meat" value="Beef">
		   <input type="hidden" name="hidden_choosen_plan" class="rdo_choosen_plan" value="Big Box" data-val="big_box_plan"/>
		  <input type="hidden" name="hidden_choosen_box" class="rdo_choosen_box" value="1/2 Size" data-val="pid"/>	  
		  
		</form>   
	
			
	</div>
<div class="loader"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/loading-loading-screen.gif" title="Loading"></div>
  <!-- Modal -->
  <div class="modal fade" id="callme" role="dialog" style="display: none;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Call Us for more information</h4>
		   <h5></h5>
        </div>
        <div class="modal-body">
          
		  <?php echo do_shortcode('[contact-form-7 id="fid" title="Contact form"]');?>
        </div>
        <div class="modal-footer">
        <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
      
    </div>
  </div>			
</div>

	<?php wp_footer(); ?>	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/jquery.easing.min.js"></script>
			
		<script type="text/javascript">
		<?if(isset($_GET['meat_type'])){
			$meat_type= $_GET['meat_type'] ;
			if($meat_typ!='beef'){ ?>
			var meattye = '<?php echo $meat_type ; ?>';
			
			jQuery("input[name=rdo_type_of_meat][data-val=" + meattye + "]").prop('checked', true);
			jQuery('.rdo_type_of_meat').val(meattye);
			<?php }
		}?> 
			//jQuery time
			var current_fs, next_fs, previous_fs; //fieldsets
			var left, opacity, scale; //fieldset properties which we will animate
			var animating; //flag to prevent quick multi-click glitches
			var steps = [];
			jQuery(".next").click(function(){
				var dtstep = jQuery(this).attr('data-step');
				var dtstepval = jQuery('.n_rdo_'+dtstep).val();
				if(animating) return false;
				animating = true;
				
				current_fs = jQuery(this).parent().parent();
				next_fs = jQuery(this).parent().parent().next();
				
				//activate next step on progressbar using the index of next_fs
				jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");
				
				//show the next fieldset
				next_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale current_fs down to 80%
						scale = 1 - (1 - now) * 0.2;
						//2. bring next_fs from the right(50%)
						left = (now * 50)+"%";
						//3. increase opacity of next_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({
					'transform': 'scale('+scale+')',
					'position': 'absolute'
				  });
						next_fs.css({'left': left, 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
				if('size_of_meat'==dtstep){
					var plan = jQuery('.rdo_choosen_plan').attr('data-val');
					var plannum ;
					if(plan == 'big_box_plan'){ 
						plannum = 6;
					}else{
						plannum = 12;
					}
					func_total_price_convert_installment(plannum) ;
				}
				
			});

			jQuery(".previous").click(function(){
				if(animating) return false;
				animating = true;
					var dtstep = jQuery(this).attr('data-step');
					
				current_fs = jQuery(this).parent().parent();
				previous_fs = jQuery(this).parent().parent().prev();
				
				//de-activate current step on progressbar
				jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				previous_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale previous_fs from 80% to 100%
						scale = 0.8 + (1 - now) * 0.2;
						//2. take current_fs to the right(50%) - from 0%
						left = ((1-now) * 50)+"%";
						//3. increase opacity of previous_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({'left': left});
						previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity, 'position': 'relative'});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
							
			});
			jQuery(function(){
				jQuery('input[type=radio]').change(function() {  
					var dtclss = jQuery(this).attr('data-name');
					var dtval = jQuery(this).val();
					var dtvall = jQuery(this).attr('data-val');
					jQuery(".n_"+dtclss).val(dtval);
					jQuery("."+dtclss).val(dtval);
					jQuery("."+dtclss).attr('data-val', dtvall);
					
					
				});
			}); 
			
			/*collapsible */
			var coll = document.getElementsByClassName("collapsible");
			var i;

			for (i = 0; i < coll.length; i++) {
			  coll[i].addEventListener("click", function() {
				this.classList.toggle("cactive");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
				  content.style.display = "none";
				} else {
				  content.style.display = "block";
				}
			  });
			}
			jQuery(".btn_select_deal").click(function(){
				var choosen_plan = jQuery(".rdo_choosen_plan").val(); 
				var choosen_box = jQuery(".rdo_choosen_box").val(); 
				var type_of_meat = jQuery(".rdo_type_of_meat").val(); 
				$loader = jQuery('.loader');
				 jQuery.ajax({  
					type: 'POST',  
					url: '<?php echo admin_url('admin-ajax.php');?>',  
					data: { action : 'mjt_custom_order_product_load', rdo_choosen_plan : choosen_plan, rdo_choosen_box : choosen_box, rdo_type_of_meat : type_of_meat  },
					beforeSend: function (textStatus) {
									$loader.removeClass('loader').addClass('gifloading');
						},
					complete: function (textStatus) {
						//jQuery( '.woo_products_result' ).html('');
							
						},					
					success: function(textStatus){ 
						jQuery( '.woo_products_result' ).html('');
						$loader.addClass('loader').removeClass('gifloading'); 
					   jQuery( '.woo_products_result' ).html( textStatus ); 
					},  
					error: function(MLHttpRequest, textStatus, errorThrown){
						$loader.addClass('loader').removeClass('gifloading'); 						
						/*alert(errorThrown);  */
					}  
				  }); 
			}); 
			function func_total_price_convert_installment(plannum){
				var strng = '';
				jQuery('.b_cost').each(function(i, obj) {					
					var cb = jQuery(this).attr('data-bcost');
					var inst = cb / plannum ;
					 jQuery(this).html('').html(inst);
					
				});
				 
			} 
			
			jQuery(document).ready(function(){
			   jQuery(".btn_callme").click(function(){
				   jQuery('body').addClass('modal-open');
				   jQuery("#callme").addClass('in');
				   jQuery("#callme").slideDown(800);
				   var meattpye = jQuery(this).attr('data-meat');
				   jQuery('#call_subject').val("Query for " + meattpye );
			  }); 
			 jQuery(".close").click(function(){
				   jQuery('body').removeClass('modal-open');
				   jQuery("#callme").removeClass('in');
				   jQuery("#callme").fadeOut(500); 
				  jQuery('#call_subject').val("");
			  }); 
			});
		</script>

</body>
</html>
