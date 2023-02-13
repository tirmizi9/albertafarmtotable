<h2 class="fs-title">SELECT YOUR SOURCE OF PROTIEN </h2>
			<p class="fs-subtitle step-subtitle"><b>Choose from grass fed beef, bison, elk, or yak, humanely raised pork, goat or lamb.</b></p>
			<div class="col-3 col-sm-3 col-md-3 cols_type_of_meat">
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/b2.jpg" width="120">
					<label class="rad-label">
					<?php $enable__disable1 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable1 != 'enabled'){ 
						$enable_disable1='disabled';
						$avl1 = 'Not Available now';
						}else{$enable_disable1 ='checked';  
							$avl1 = '&nbsp;&nbsp;&nbsp;';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Beef" data-val="beef" <?php echo $enable_disable1 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Beef</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Beef"><i><?php echo $avl1 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-3 col-sm-3 col-md-3 cols_type_of_meat">
			   <div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/p2.jpg" width="120">
					<label class="rad-label">
					<?php $enable__disable2 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable2 != 'enabled'){ 
						$enable_disable2='Disabled';
						$avl2 = 'Call Us for more information';
						}else{$enable_disable2 ='';  
							$avl2 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Pork" data-val="pork" <?php echo $enable_disable2 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Pork</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Pork"><i><?php echo $avl2 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-3 col-sm-3 col-md-3 cols_type_of_meat">
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/g2.jpg" width="120"> 
					<label class="rad-label">
					<?php $enable__disable3 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable3 != 'enabled'){ 
						$enable_disable3='Disabled';
						$avl3 = 'Call Us for more information';
						}else{$enable_disable3 ='';  
							$avl3 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Goat" data-val="goat" <?php echo $enable_disable3 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Goat</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Goat"><i><?php echo $avl3 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-3 col-sm-3 col-md-3 cols_type_of_meat">
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/m1.jpg" width="120"> 
					<label class="rad-label">
					<?php $enable__disable4 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable4 != 'enabled'){ 
						$enable_disable4='Disabled';
						$avl4 = 'Call Us for more information';
						}else{$enable_disable4 ='';  
							$avl4 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Mutton" data-val="mutton" <?php echo $enable_disable4 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Mutton</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Mutton"><i><?php echo $avl4 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-4 col-sm-4 col-md-4 cols_type_of_meat top-buffer"> 
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Bison.jpg" width="120"> 
					<label class="rad-label">
					<?php $enable__disable5 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable5 != 'enabled'){ 
						$enable_disable5='Disabled';
						$avl5 = 'Call Us for more information';
						}else{$enable_disable5 ='';  
							$avl5 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Bison" data-val="bison" <?php echo $enable_disable5 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Bison</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Bison"><i><?php echo $avl5 ;?></i></button>								
				   </div>				
			   </div>
			</div>
			<div class="col-4 col-sm-4 col-md-4 cols_type_of_meat top-buffer">
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Venison.jpg" width="120"> 
					<label class="rad-label">
					<?php $enable__disable6 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable6 != 'enabled'){ 
						$enable_disable6='Disabled';
						$avl6 = 'Call Us for more information';
						}else{$enable_disable6 ='';  
							$avl6 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Venison" data-val="venison" <?php echo $enable_disable6 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Venison</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Venison"><i><?php echo $avl6 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-4 col-sm-4 col-md-4 cols_type_of_meat top-buffer">
				<div class="mjt_cols">
				   <div class="mjt_inner">
					<h3 class="fs-subtitle m-subtitle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/yak.jpg" width="120"> 
					<label class="rad-label">
					<?php $enable__disable7 =  get_field('enable__disable', 'product_cat_id'); 
					if($enable__disable7 != 'enabled'){ 
						$enable_disable7='Disabled';
						$avl7 = 'Call Us for more information';
						}else{$enable_disable7 ='';  
							$avl7 = '';
						}
					?>
					<input type="radio" class="rad-input" name="rdo_type_of_meat" data-name="rdo_type_of_meat" value="Yak" data-val="yak" <?php echo $enable_disable7 ;?>>
					<div class="rad-design"></div>					
					</label><br/>Yak</h3><button type="button" class="btn btn_callme" data-toggle="modal" data-target="#callme" data-meat="Yak"><i><?php echo $avl7 ;?></i></button>										
				   </div>				
			   </div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row_button">
				<input type="hidden" name="hide_type_of_meat" class="n_rdo_type_of_meat" value="Beef">	
				<input type="button" name="next" class="next action-button" value="Next, Choose your Plan" data-step="choosen_plan"//>
			</div> 
			