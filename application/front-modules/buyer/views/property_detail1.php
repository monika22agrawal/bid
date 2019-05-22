<link rel="stylesheet" href="<?php echo base_url().FRONT_THEME;?>css/jquery.countdown.css">
<section class="PropertyDetails gray-bg">
	<div class="propertyData sec-pad">
		<div class="container">
			<div class="property_header">
				<div class="property_header-container">
					<?php if(!empty($error)){?>
                     <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $error; ?>
                    </div>
                 	<script>
		              setTimeout(function() {
		              $('.alert-danger').fadeOut('slow');
		              }, 5000);
              		</script>
		                <?php } ?>  
		                 <?php if($this->session->flashdata('error') != null) : ?>  <!-- for Delete -->
		               
		                <div class="">
		                    <div class="alert alert-danger" id="success-alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                            <h4>  <i class="icon fa fa-check"></i>Alert</h4>
		                        <?php  echo $this->session->flashdata('error');?>
		                    </div>
		                </div><!-- /.box-body -->
		                 <script>
		              setTimeout(function() {
		              $('.alert-danger').fadeOut('slow');
		              }, 5000);
		              </script>
		              <?php endif; ?>
		                  <?php if($this->session->flashdata('success') != null) : ?>  <!-- for Delete -->
		               
		                <div class="">
		                    <div class="alert alert-success" id="success-alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                            <h4>  <i class="icon fa fa-check"></i>Alert</h4>
		                        <?php  echo $this->session->flashdata('success');?>
		                    </div>
		                </div><!-- /.box-body -->
		                 <script>
		              setTimeout(function() {
		              $('.alert-success').fadeOut('fast');
		              }, 5000);
		              </script>
             	 <?php endif; ?>
					<div id="show_error"></div>
					<div class="row">						
						<div class="col-lg-5 col-md-7">
							<div class="property_title property_main-item">
								<div class="property_meta">
									<?php if($details->propertyStatus == '1'){?>
					                	<span class="property_status newP">New</span>
					                <?php } else{ ?>
					                	<span class="property_status oldP">Old</span>
					                <?php } ?>
					            </div><!-- .property__meta -->
					            <h2 class="property_name"><?php echo ucwords($details->propertyName); ?></h2>
					            <span class="property_address">
					            	<i class="fa fa-map-marker property_address-icon"></i><?php echo $details->address; ?>
					            </span>
							</div>
						</div>
						<div class="col-lg-4 col-md-5 vcenter">
							<div class="property_price property_main-item">
								<h4 class="property_price-primary"><?php echo  '$'.number_format($details->purchaseAmount)."<br>"; ?></h4>
								<?php if($this->session->userdata('front_login') == true && $this->session->userdata('id') != ''){ 
									if($details->propertyStatus == '2'){?>
	              						<p class="property_price-secondary"><span>My Last Bid: </span><?php echo !empty($details->buyerBidAmount) ? '$'.$details->buyerBidAmount : '0'; ?></p>
	              				<?php } } ?>
	              				<ul class="property_details_ic list-inline">
	                                <li><i class="fa fa-object-group" aria-hidden="true"></i> <?php echo $details->area.' sqm'; ?> </li>
	                                <li><i class="fa fa-bed" aria-hidden="true"></i> <?php echo !empty($details->bedRoom) ? $details->bedRoom : 'NA'; ?></li>
	                                <li><i class="fa fa-bath" aria-hidden="true"></i> <?php echo !empty($details->bathRoom) ? $details->bathRoom : 'NA'; ?></li>
	                            </ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-12 vcenter">
							<div class="property_item">
							<?php if($this->session->userdata('front_login') == true){

								 		if($details->propertyStatus == '1'){ 

								 			if($details->isApproved == '3'){ ?>

												<a href="<?php echo base_url('buyer/propertyPayment/').$details->id.'/';?>" class="btn btn-theme">Add to Cart</a>

										<?php }elseif(($details->bankStatement == '')){ 
												if(strtotime(date('Y-m-d H:i:s')) <= strtotime($details->newPropEndDate)){ ?>

												<button type="button" class="btn btn-theme" data-toggle="modal" data-target="#myModalBS">Upload Document</button> 

												<?php } else{ ?> 

														<a href="javascript:void(0);" class="btn btn-theme">Document upload date has gone.</a>

												<?php } }elseif(!empty($details->bankStatement) && empty($details->proofOfFund) && empty($details->EOI)){ ?>
														<a href="<?php echo base_url('buyer/propertyFinalDocuments/').$details->id.'/';?>" class="btn btn-theme">Upload Fund Document</a>
														<!-- <a href="javascript:void(0);" class="btn btn-theme">Added into Cart</a> -->
														
													<?php } else{ ?> 

														<!-- <a href="javascript:void(0);" class="btn btn-theme">Document upload date has gone.</a> -->

												<?php } } else{ 
																
											if($details->propertyStatus == '2'){ 

												if($details->isApproved == '3'){?>

													<?php if(strtotime(date('Y-m-d H:i:s')) > strtotime($bidTime->endDateTime )){ ?>

														<span id="BidDone"><a href="javascript:void(0);" class="btn btn-theme">Auction is Completed</a></span>

													<?php } elseif(strtotime(date('Y-m-d H:i:s')) >= strtotime($bidTime->startDateTime )){?>
													
														 <a href="<?php echo base_url('buyer/propertyPayment/').$details->id.'/';?>" class="btn btn-theme">Bid Request</a> 

													<?php }else{ ?>

														<a href="javascript:void(0);" class="btn btn-theme">Auction is not start</a>

											<?php } } elseif($details->isApproved == '2'){ ?>

												<a href="javascript:void(0);" class="btn btn-theme">Bid Not Approved</a>

											<?php } elseif($details->isApproved == '1'){ 
												if(strtotime(date('Y-m-d H:i:s')) > strtotime($bidTime->endDateTime )){ ?>

													<span id="BidDone"><a href="javascript:void(0);" class="btn btn-theme">Auction is Completed</a></span>

											<?php } else{ ?> 

													<span id="BidApp"><a href="javascript:void(0);" onclick="applyBid();" class="btn btn-theme">Apply Bid</a></span>

											<?php } } else{
												if(strtotime(date('Y-m-d H:i:s')) > strtotime($bidTime->endDateTime )){ ?>
												<span id="BidDone"><a href="javascript:void(0);" class="btn btn-theme">Auction is Completed</a></span>
												
												<?php }else{ ?>
													<a href="javascript:void(0);" class="btn btn-theme">Wait For Approval</a>
												<?php } ?>
											<?php } }?>

										<?php  }  } else{ 

									if($details->propertyStatus == '1') { ?>
								
										<button type="button" class="btn btn-theme" data-toggle="modal" data-target="#myModal">Add to Cart</button> 

									<?php } else{ ?>

										<button type="button" class="btn btn-theme" data-toggle="modal" data-target="#myModal">Bid Request</button> 
										
								<?php } }?>
								<div class="showHide" id="bidInput">
									<form onsubmit="return addBid();" method="POST" action="javascript:void(0);">
										<input oninput="$('#bidAmt-err').html('');" id="bidAmt" value="" type="text" name="" onkeypress="return isNumberKey(event);" placeholder="Enter bidding amount">
										<label class="error" id="bidAmt-err"></label>
										<button type="submit" class="btn btn-theme" >Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>
	        	</div>
	        </div>
			<div class="propertyImg">
				<div class="propertyImage at-property-img">
					<div class="single-gallery-carousel-content-box owl-carousel">
						<?php if(!empty($images)) { 
								foreach ($images as $get) {                          
						   	?>
							<div class="item">
								<!-- <img src="<?php echo base_url().FRONT_THEME ;?>img/property/Details/3.jpg"> -->
								<img src="<?php echo $get->pImage;?>">
							</div>
						<?php } }?>	
					</div>
					<h5><?php echo ucwords($details->typeName); ?></h5>
				</div>
				<div class="mt-1">
					<div class="single-gallery-carousel-thumbnail-box owl-carousel">
						<?php if(!empty($images)) { 
								foreach ($images as $get) {                          
						    ?>
							<div class="item">
								<img src="<?php echo $get->pImage;?>">
							</div>
						<?php } }?>	
					</div>
				</div>
			</div>
			<!-- <div class="title-section">
				<div class="float-left">
				<h5 class="">Neque porro quisquam est, qui dolor</h5>
				<p><i class="fa fa-map-marker"></i>Neque porro quisquam est</p>
				</div>
				<span class="float-right">$150,000</span>
			</div> -->
		</div>
	</div>
	<div class="sec-pad">
	    <div class="container">
	    	<div class="prDetails">
	    		<div class="row">
	    			<div class="col-lg-8 col-md-12">  				
	    				<div class="property-content">
	    					<div class="property-section property-description">
	    						<!-- <div class="BidTime">
	    							
	    							<div class="PropertyAction float-right">
	    								<a href="#" class="btn btn-outline">Edit</a>
	    								<a href="#" class="btn btn-outline">Delete</a>
	    							</div>
	    						</div> -->
	    						<?php  if($details->propertyStatus == '2'){  ?>
	    						
								<h3>Remaining Date/Time for bidding</h3>
								<h6>Australian Eastern Time Zone (UTC+10:00)</h6>
    						<div class="BidTime">
    							<div class="time float-left">  
    								<?php if(strtotime(date('Y-m-d H:i:s')) >= strtotime($bidTime->startDateTime )){ ?>
    									<p id="sTime"></p>
    									<p><span><i class="fa fa-calendar"></i> End Time:</span>
    									<?php echo date('d M Y, H:i',strtotime($bidTime->endDateTime));?></p>
		    							<ul id="example">
											
										</ul>
									<?php }else{ ?>
									<p><span><i class="fa fa-calendar"></i> Start Time:</span>
    								<?php echo date('d M Y, H:i',strtotime($bidTime->startDateTime));?></p>
									<p><span><i class="fa fa-calendar"></i> End Time:</span>
    								<?php echo date('d M Y, H:i',strtotime($bidTime->endDateTime));?></p>
									<?php } ?>
    							</div>
    							<!-- <div class="PropertyAction float-right">
    								<a href="#" class="btn btn-outline">Edit</a>
    								<a href="#" class="btn btn-outline">Delete</a>
    							</div> -->
    						</div> 
    						<?php } ?>
								<h3>Description</h3>
								<p><?php echo $details->description; ?></p>
							</div>
							<div class="property-section property-overview">
								<h3>Details</h3>
								<ul class="columns-gap">
									<li><span>Property Type:</span> <?php echo ucwords($details->typeName); ?></li>
									<li><span>Sold:</span> <?php echo ($details->isSold == '1') ? 'Sold' : 'On Sale'; ?> </li>
									<li><span>Status:</span> <?php echo ($details->propertyStatus == '1') ? 'NEW' : 'Old'; ?></li>
									<li><span>Area:</span> <?php echo $details->area.' sqm'; ?></li>
									<li><span>Bedrooms:</span> <?php echo !empty($details->bedRoom) ? $details->bedRoom : 'NA'; ?></li>
									<li><span>Bathrooms:</span> <?php echo !empty($details->bathRoom) ? $details->bathRoom : 'NA'; ?></li>
									<li><span>Parkings:</span> <?php echo !empty($details->carParking) ? $details->carParking : 'NA'; ?></li>
									<li><span>Swimming Pools:</span> <?php echo !empty($details->swimmingPool) ? $details->swimmingPool : 'NA'; ?></li>
								</ul>
							</div>
							<div class="MoreDetails">
								<ul class="nav nav-tabs" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link active" data-toggle="tab" href="#Map" role="tab">Map</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" data-toggle="tab" href="#FloorPlan" role="tab">Floor Plan</a>
								  	</li>
								</ul>
								<div class="property-section floorplan-view">
									<div class="tab-content">
									  	<div class="tab-pane" id="FloorPlan" role="tabpanel">
										  	<div class="floorPlan">
								  				<div class="floorImg">
								  					<?php if(!empty($details->floorPlan)){?>
								  					<a class="thumbnail fancybox" rel="ligthbox" href="#">							                        
								                        <img class="img-responsive" alt="" src="<?php echo base_url().'upload/floorPlan/'.$details->floorPlan;?>" />
								                    </a>
								                    <?php }else { echo "Floor image is not available";} ?>
								  				</div>
										  	</div>
									  	</div>
									  	<div class="tab-pane active" id="Map" role="tabpanel">
									  		<div id="mapAddress" style="width: 100%; height: 300px;"></div> 
									  	</div> 
									</div>
								</div>
							</div>
							<?php if($this->session->userdata('front_login') == true){ ?>
							<div class="property-section shopping-cart">
								<h3>Shopping Cart</h3>
								<div class="doc">
									<h2 class="float-left">Inspection Report</h2>
									<a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'upload/inspectionReport/'.$details->inspectionReport; ?>')" class="btn btn-theme float-right">Download Document</a>
								</div>
								<div class="doc">
									<h2 class="float-left">Property Proof</h2>
									<a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'upload/propertyProof/'.$details->propertyProof; ?>')" class="btn btn-theme float-right">Download Document</a>
								</div>

								<?php 
							if($details->propertyStatus == '2'){ 
								if(!empty($details->evaluationReport)){ 

									if($details->ispay == 'succeeded'){ ?> 

										<div class="doc">
											<h2 class="float-left">Valuation Report</h2>
											<a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'upload/evaluationReport/'.$details->evaluationReport; ?>')" class="btn btn-theme float-right">Download Document</a>
										</div>

									<?php }else{ ?>
					
										<div class="doc">
											<h2 class="float-left">Valuation Report</h2>
											<!-- <a href="<?php echo base_url('buyer/orderPayment/');?>" class="btn btn-theme float-right">Download Document</a> -->
											<div class="panel-body">
								              	<form accept-charset="UTF-8" role="form" method="post" action="<?php echo site_url(); ?>stripePayment/payByCcToStripe">
								                
									              	<input type="hidden" class="form-control" name="pId" value="<?php echo $details->id; ?>">
									                  <script
									                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									                    data-key="pk_test_Uz92BTVITJfhyjTEiZrfIKNN"
									                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
									                    data-name="Stripe.com"
									                    data-description="test" 
									                    data-label="Please pay for download document"
									                    data-amount="<?php echo 100*100;?>">
									                  </script>
								              	</form>
			            					</div>
										</div>
									<?php } }else{ ?>
									<div class="doc">
										<h2 class="float-left">Valuation Report</h2>
										<a href="javascript:void(0);" class="btn btn-theme float-right">Document Not Upload</a>
									</div>
								<?php } } ?>
							</div>
							<?php } ?>
	    				</div>
	    			</div>
	    			<div class="col-lg-4 col-md-12">
	    				<div class="Sidebar">
	    					<?php if($details->propertyStatus == '1'){?>
		    					<h5>Seller Details</h5>
		    					<div class="UserBookInfo">
									<div class="userBook">
										  <div class="">
										  	<span><i class="fa fa-user"></i></span>
										  </div>
										  <div class="">									    
												<h2><a href="#"><?php echo ucwords($details->name); ?></a></h2>
												<p><i class="fa fa-envelope"></i><?php echo $details->email; ?></p>
										  </div>
									</div>
								</div>
							<?php }else{ ?>
								<h5>Highest bid on this property</h5>
			    				<div class="UserBookInfo">
									<div class="userBook">
										  <div class="">
										  	<span><i class="fa fa-user"></i></span>
										  </div>
										  <div class="">									    
												<!-- <h2><a href="#"><?php echo !empty($details->highestBidder) ? ucwords($details->highestBidder) : 'NA'; ?></a></h2> -->
												<!-- <p><i class="fa fa-envelope"></i>alversonkyler@gmail.com</p> -->
												<h4><?php echo !empty($details->highestBidAmt) ? '$'.$details->highestBidAmt : 'NA'; ?></h4>
										  </div>										 
									</div>
								</div>
							<?php } ?>
	    				</div>
	    				<div class="Sidebar">
	    					<h5>Recently Added Property</h5>
	    					<div class="SidebarProperty">
	    						<?php if(!empty($featuredProperty)){ foreach ($featuredProperty as $feature) { ?>
	    						<div class="pBlock">
	    							<a href="<?php echo base_url('buyer/viewProperty/').$feature['propertyId'];?>">
	    							<div class="Rimg"><img src="<?php echo $feature['pImage'];?>"></div>
	    							<h2><?php echo ucwords($feature['propertyName']); ?></h2>
	    							<p><?php echo $feature['purchaseAmount']; ?></p>
	    							</a>
	    						</div>
	    						<?php } }else{ echo "No feature Record"; }?>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </div>
</section>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH_tbuOQjByUQDu3fwDnBzXtVVEyQK9Ao&callback=initialize"
  type="text/javascript"></script> 

<div class="modal fade" id="myModalBS">
    <div class="modal-dialog">
      	<div class="modal-content">      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          	<h4 class="modal-title">Upload Bank Statement</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>        
	        <!-- Modal body -->
	        <div class="modal-body">
	          
	          	<form method="post" enctype="multipart/form-data" action="<?php echo base_url('buyer/uploadDocument/');?>">
					<input type="hidden" name="sellerId" value="<?php echo $details->sellerId; ?>">
					<input type="hidden" name="propertyId" value="<?php echo $details->id; ?>">
					
					<div id="firstDiv">
                		<div class="row">
	                		<div class="col-md-12 col-sm-12">
	                			<div class="section">Upload bank statement</div>
			                    <div class="inner-wrap fileinput">
			                        <input onchange="$('#bsImg').html('');" id='imageName' type="file" value="" name="bankStatement" />
			                        <label class="error" id="bsImg"></label>
			                    </div>					                    
	                		</div>
                		</div>
                		<div class="form-wizard-buttons">
                            <button type="submit" id="btnnxt" class="btn btn-theme">Upload</button>	                           
                        </div>
                	</div>
				</form>
	        </div>	        
	        <!-- Modal footer -->
	        <!-- <div class="modal-footer">
	          	<a href="<?php echo base_url('login');?>" class="btn btn-secondary">OK</a>
	          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        </div>   -->      
      	</div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      	<div class="modal-content">      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          	<h4 class="modal-title">Login First</h4>
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        
	        <!-- Modal body -->
	        <div class="modal-body">
	          Please login first for booking property.
	        </div>
	        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          	<a href="<?php echo base_url('login');?>" class="btn btn-secondary">OK</a>
	          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        </div>        
      	</div>
    </div>
</div>
<?php  if($details->propertyStatus == '2'){  ?>
	<script type="text/javascript">

		//var startDate = "<?php //echo date('M d, Y H:i:s',strtotime($bidTime->startDateTime));?>";
		var endDate = "<?php echo strtotime($bidTime->endDateTime);?>";

		// Set the date we're counting down to
		var countDownDate = endDate;
                
                //console.log('JS utc '+now_utc);
		// Update the count down every 1 second
		var x = setInterval(function() {
                var y = new Date();
                   
                //var now_utc = y.toUTCString();
                
		var newDate = Math.floor(y.getTime());
                //var UTCstring = (new Date()).toUTCString();
		//alert(newDate);
		// Get todays date and time
		//var now = (now_utc.getTime())/1000;
                //console.log('utc js--'+y+' utc PHP -----'+'<?php //echo date("M d, Y H:i:s P"); ?>'+'----'+newDate+'------'+countDownDate);
		
		// Find the distance between now an the count down date
		var distance = countDownDate*parseInt(1000) - newDate;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		var html='<li><span class="days">'+days+'</span><p class="days_text">Days</p></li><li class="seperator">:</li><li><span class="hours">'+hours+'</span><p class="hours_text">Hours</p></li><li class="seperator">:</li><li><span class="minutes">'+minutes+'</span><p class="minutes_text">Minutes</p></li><li class="seperator">:</li><li><span class="seconds">'+seconds+'</span><p class="seconds_text">Seconds</p></li>';
		// Display the result in the element with id="demo"
		document.getElementById("example").innerHTML = html;

			// If the count down is finished, write some text
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("example").innerHTML = "";
				$('#sTime').html('<span><i class="fa fa-calendar"></i> Start Time:</span><?php echo date("d M Y, H:i",strtotime($bidTime->startDateTime));?>');
			}
		}, 1000);	


		function isNumberKey(evt) {

			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode > 31 && charCode !=46 && (charCode < 48 || charCode > 57)) {			
				return false;
			}		
			return true;
		}

		function addBid(){


			var BASE_URL = "<?php echo base_url();?>";
			var err = 0;
			var amtPur = '<?php echo $details->purchaseAmount;?>';
			var amt = parseFloat(amtPur);
			var pId = '<?php echo $details->id;?>';
			var endDate = "<?php echo $bidTime->endDateTime;?>";
			var startDate = "<?php echo $bidTime->startDateTime;?>";
			
			var bidAmt = parseFloat($('#bidAmt').val());

			if(bidAmt ==''){
	            err=1;                
	            $('#bidAmt-err').html("Please enter bid amount.");
	            
	        }else if(bidAmt <= amt){
	        	err=1;
	        	$('#bidAmt-err').html("Bidding should be greater <br>than property bid amount.");
	        }else if(isNaN(bidAmt)){
	        	err=1;
	        	$('#bidAmt-err').html("Please enter bid amount.");
	        }else{                
	            $('#bidAmt-err').html(""); 
	        }

			if(err){
				return false;
			}else{

				$.ajax({ 
		            url: '<?php echo base_url();?>buyer/applyBidding',
		            data: {bidAmt:bidAmt,pId:pId,startDate:startDate,endDate:endDate},
		            type: 'post',
		            success: function(data){
		            	if(data == 'AS'){
		            		$('#bidInput').hide();
		            		var messages = '<div class="alert alert-success">Your bidding has been applied successfully.</div>';
		                    $("#show_error").html(messages);
		                    setTimeout(function(){
		                        $('.alert-success').fadeOut('slow');
		                    }, 5000);
		                    window.location = BASE_URL + "buyer/viewProperty/" +pId;
		            	}else if(data == 'BU'){
		            		$('#bidInput').hide();
		            		var messages = '<div class="alert alert-success">Your bidding has been updated successfully.</div>';
		                    $("#show_error").html(messages);
		                    setTimeout(function(){
		                        $('.alert-success').fadeOut('slow');
		                    }, 5000);
		                    window.location = BASE_URL + "buyer/viewProperty/" +pId;
		            	}else if(data == 'AB'){
		            		$('#bidAmt-err').html("Bidding should be greater."); 
		            	}else if(data == 'BD'){
		            		$('#bidInput').hide();
		            		$('#BidApp').hide(); 
		            		$('#BidDone').show();
		            	}
		            }
		        });
			}			
		}

		function applyBid(){
			$('#bidInput').show();
		}
	</script>
<?php } ?>

<script type="text/javascript">

	function initialize() {
	   var latlng = new google.maps.LatLng('<?php echo $details->latitude;?>','<?php echo $details->longitude;?>');
	    var map = new google.maps.Map(document.getElementById('mapAddress'), {
	      center: latlng,
	      zoom: 13
	    });
	    var marker = new google.maps.Marker({
	      map: map,
	      position: latlng,
	      draggable: false,
	      anchorPoint: new google.maps.Point(0, -29)
	   });
	    var infowindow = new google.maps.InfoWindow();   
	    google.maps.event.addListener(marker, 'click', function() {
	     var iwContent = '<div id="iw_container">' +
	      '<div class="iw_title"><b>Location</b> : <?php echo $details->address;?></div></div>';
	      // including content to the infowindow
	      infowindow.setContent(iwContent);
	      // opening the infowindow in the current map and at the current marker location
	      infowindow.open(map, marker);
	    });
	}
	google.maps.event.addDomListener(window, 'load', initialize);

</script>

<script type="text/javascript">
	
	$('input[type="file"]').change(function(e){
    	var fileName = e.target.files[0].name; 
		$("#imageName").val(fileName);	        	
    });  

	$('#btnnxt').click(function(e){

	    var err = 0;
	    var base_url = "<?php echo base_url();?>";
	    /*var propStatus = "<?php echo $propData->propertyStatus;?>";   */
	    var imgName = $('#imageName').val(); 
	   
  		if(imgName == ''){
    		err=1;   
    		$('#bsImg').html("Please upload bank statement.");
    	}else{                
            $('#bsImg').html(""); 
       	}      	    
	   
	    if(err){
	        return false;
	    }else{
	    	
	    }
	});

</script>