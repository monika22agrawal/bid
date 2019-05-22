<link rel="stylesheet" href="<?php echo base_url().FRONT_THEME;?>css/jquery.countdown.css">
<section class="PropertyDetails gray-bg">
	<div class="propertyData sec-pad">
		<div class="container">
			<div class="property_header">
				<div class="property_header-container">
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
								<h4 class="property_price-primary"><?php echo '$'.$details->purchaseAmount; ?></h4>
	              				<!-- <span class="property_price-secondary">$4,824/sq.ft</span> -->
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
								 if($details->propertyStatus == '1'){ if($details->isApproved == ''){?>

									<a href="<?php echo base_url('buyer/propertyPayment/').$details->id.'/';?>" class="btn btn-theme">Add to Cart</a>

								<?php } }else{ 
									
									if($details->propertyStatus == '2' &&  $details->isApproved == ''){ ?>
									<?php if(date('Y-m-d H:i:s') >= $bidTime->startDateTime ){ ?>
										<a href="<?php echo base_url('buyer/propertyPayment/').$details->id.'/';?>" class="btn btn-theme">Bid Request</a>

								<?php }else{ ?>

									<a href="javascript:void(0);" class="btn btn-theme">Wait For Bid Start Time</a>

									<?php } }else{ ?>

									<a href="javascript:void(0);" class="btn btn-theme">Wait For Approval</a>

								<?php } }  } else{ 
									if($details->propertyStatus == '1'){
								?>
									<button type="button" class="btn btn-theme" data-toggle="modal" data-target="#myModal">Add to Cart</button> 
								<?php } else{ ?>
									<button type="button" class="btn btn-theme" data-toggle="modal" data-target="#myModal">Bid Request</button> 
								<?php } }?>
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
	    						
								<h3>Remaining Date/Time for biding</h3>
    						<div class="BidTime">
    							<div class="time float-left">  
    								<?php if(date('Y-m-d H:i:s') >= $bidTime->startDateTime ){ ?>
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
									<li><span>Sold:</span> No </li>
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
								                    <?php }else { echo "No image";} ?>
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
									<a href="#" onclick="window.open('<?php echo base_url().'upload/inspectionReport/'.$details->inspectionReport; ?>')" class="btn btn-theme float-right">Download Document</a>
								</div>
								<div class="doc">
									<h2 class="float-left">Property Proof</h2>
									<a href="#" onclick="window.open('<?php echo base_url().'upload/propertyProof/'.$details->propertyProof; ?>')" class="btn btn-theme float-right">Download Document</a>
								</div>
							</div>
							<?php } ?>
	    				</div>
	    			</div>
	    			<div class="col-lg-4 col-md-12">
	    				<div class="Sidebar">
	    					<?php if($details->propertyStatus == '1'){?>
		    					<h5>Agent Details</h5>
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
												<h2><a href="#">Alverson Kyler</a></h2>
												<p><i class="fa fa-envelope"></i>alversonkyler@gmail.com</p>
												<h4>$2,568,000</h4>
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
	    							<a href="#">
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
<script type="text/javascript">
	
	//var startDate = "<?php echo date('M d, Y H:i:s',strtotime($bidTime->startDateTime));?>";
	var endDate = "<?php echo date('M d, Y H:i:s',strtotime($bidTime->endDateTime));?>";

	// Set the date we're counting down to
	var countDownDate = new Date(endDate).getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

	// Get todays date and time
	var now = new Date().getTime();
	// Find the distance between now an the count down date
	var distance = countDownDate - now;

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
		document.getElementById("example").innerHTML = "EXPIRED";
		}
	}, 1000);

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
