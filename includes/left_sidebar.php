				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
								$cres=get_categories();
								while($crow=mysqli_fetch_assoc($cres))
								{
							?>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $crow['category_name'];?>">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											<?php echo $crow['category_name'];?>
										</a>
									</h4>
								</div>
								<div id="<?php echo $crow['category_name'];?>" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
										<?php
											$csres=get_subcategories($crow['category_id']);
											while($csrow=mysqli_fetch_assoc($csres))
											{
										?>
											<li><a href="products.php?sid=<?php echo base64_encode($csrow['sub_category_id']);?>"><?php echo $csrow['sub_category_name'];?></a></li>
										<?php
											}
										?>										
										</ul>
									</div>
								</div>
							</div>
							<?php
								}
							?>
							
						</div><!--/category-products-->
					
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div>
								 <!--<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>-->
								 <form method="post" action="">
								 <input style="width:80px" type="text" name = "min" placeholder="MIN PRICE">
								 <input style="width:80px;margin-left:10px" type="text" name = "min" placeholder="MAX PRICE">
								 <input style="margin-left:10px;border:none;background-color:#fe980f;color:white;padding:3px;" type="submit" name="search" value="SEARCH">
								 </form>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>