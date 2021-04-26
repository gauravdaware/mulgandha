<div class="carousel-inner">
								<!--Need to change-->
								<?php
								while($trows = mysqli_fetch_assoc($result_prod)){
								for($i=0;$i<3;$i++){
								?>
								<div class="item active">
								<?php
								}
								?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="uploads/products/<?php echo $trows['prod_image'];?>" alt="" />
													<h2>Rs.<?php echo $trows['prod_sp']; ?></h2>
													<p><?php echo ucwords($trows['prod_name']); ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<?php
									}
								}
								?>
				<!--<div class="item">-->
								
							</div>