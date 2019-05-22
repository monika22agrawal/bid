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
					            <h2 id="hpPN" class="property_name"><?php echo ucwords($details->propertyName); ?></h2>
					            <span id="newAddress" class="property_address"><i class="fa fa-map-marker property_address-icon"></i><?php echo $details->address; ?></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-5 vcenter">
							<div class="property_price property_main-item">
								<h4 id="hpPA" class="property_price-primary"><?php echo '$'.$details->purchaseAmount; ?></h4>
	              				<!-- <span class="property_price-secondary">$4,824/sq.ft</span> -->
	              				<ul class="property_details_ic list-inline">
	                                <li id="hpArea"><i class="fa fa-object-group" aria-hidden="true"></i> <?php echo $details->area.' m<sup>2</sup>'; ?> </li>
	                                <li id="hpBR"><i class="fa fa-bed" aria-hidden="true"></i> <?php echo !empty($details->bedRoom) ? $details->bedRoom : 'NA'; ?></li>
	                                <li id="hpBathR"><i class="fa fa-bath" aria-hidden="true"></i> <?php echo !empty($details->bathRoom) ? $details->bathRoom : 'NA'; ?></li>
	                            </ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-12 vcenter">
							<?php if($details->isBooked == '1'){ ?>
							<div class="property_item">
								<a onclick="$('#updateImages').slideToggle();" href="javascript:void(0);" class="property_link">
					                <i class="fa fa-edit property_icon" aria-hidden="true"></i>  
					                <span class="property_item-desc">Edit</span>
					            </a>
					            <!-- <a href="#" class="property_link">
					                <i class="fa fa-trash property_icon"></i>
					                <span class="property_item-desc">Delete</span>
				              	</a> -->
							</div>
							<?php } ?>
						</div>
					</div>
	        	</div>
	        </div>
	        <div id="updateImages" class="showHide">
		        <div class="updateSliderImg">
					<?php $countImg = count($images); if(!empty($images)){ 
						foreach ($images as $k => $get){                          
				    ?>
						<div id="dImg<?php echo $get->id; ?>" class="item">
							<img src="<?php echo $get->pImage;?>" id="pImg<?php echo $k; ?>">
							<div class="itemOverlay"></div>
							<div class="inplabelBlock">
								<label class="inplabel">Browse<input type="file" id="imgMy<?php echo $get->id; ?>" name="pImage" onchange="PropertyImages('<?php echo $get->id; ?>'); document.getElementById('pImg'+<?php echo $k;?>).src = window.URL.createObjectURL(this.files[0])" style="display: none;"></label>
								<label class="inplabel"  onclick="deletePropertyImages('<?php echo $get->id; ?>'); ">Delete</label>
							</div>
						</div>
					<?php } } ?>
					<div id="dImg<?php echo $get->id; ?>" class="item AddImg">
							<div class="inplabelBlock ImgAdd">

							<label class="inplabel">
								Add New
								<input type="file" id="newImgMy" name="pImage" onchange="addMorePropImg()">
							</label>

							</div>
						</div>
					<a id="showLink" href="<?php echo base_url('seller/viewProperty/').$details->id;?>"></a>	
		        </div>
	        </div>

			<div class="propertyImg">
				<div class="propertyImage at-property-img">
					<div class="single-gallery-carousel-content-box owl-carousel">
						<?php if(!empty($images)) { 
								foreach ($images as $get) {                          
						   	?>
							<div class="item">
								<!--<img src="<?php //echo base_url().FRONT_THEME ;?>img/property/Details/3.jpg">-->
								<img src="<?php echo $get->pImage;?>">
							</div>
						<?php } }?>	
					</div>
					<h5 id='imgNewpropType'><?php echo ucwords($details->typeName); ?></h5>
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
	    						<div id="viewDes">
	    							<?php if($details->isBooked == '1'){ ?>
									<div class="property_item">
										<a onclick="$('#viewDes').hide();$('#updateDes').show();" href="javascript:void(0);" class="property_link sm-icon">
							                <i class="fa fa-edit property_icon" aria-hidden="true"></i> 
							            </a>
									</div>
									<?php } ?>
		    						<?php if($details->propertyStatus == '2'){?>
			    						<h3>Start and end biding Date/Time</h3>
			    						<h6>Australian Eastern Time Zone (UTC+10:00)</h6>
			    						<div class="BidTime">
			    							<div class="time float-left">
			    							<p id="newSTime"><span><i class="fa fa-calendar"></i> Start Time:</span> <?php echo date('d M Y, H:i',strtotime($bidTime->startDateTime)); ?></p>
			    							<p id="newETime"><span><i class="fa fa-calendar"></i> End Time:</span> <?php echo date('d M Y, H:i',strtotime($bidTime->endDateTime)); ?></p>
			    							</div>
			    							<!-- <div class="PropertyAction float-right">
			    								<a href="#" class="btn btn-outline">Edit</a>
			    								<a href="#" class="btn btn-outline">Delete</a>
			    							</div> -->
		    							</div>  
									<?php } ?>
								
									<h3>Description</h3>
									<p id="newDes"><?php echo $details->description; ?></p>
								</div>
								<div id="updateDes" class="showHide  CSForm form-style-10 form-style-cs">
									<h3>Update Bid Time & Description</h3>
									<h6>Australian Eastern Time Zone (UTC+10:00)</h6>
									<form onsubmit="return updateDescription();" method="POST" action="javascript:void(0);">
										<div class="row">
											<?php if($details->propertyStatus == '2'){?>
											<div class='custom_proptions col-md-6 col-sm-12'>
											    <div class="inner-wrap">
											    	<div class="section">Start Date and Time</div>
											        <div class='input-group date' id='datetimepicker6'>
											            <input oninput="$('#sDate-err').html('');" type='text' name="startDateTime" value="<?php echo date('m/d/Y H:i A',strtotime($bidTime->startDateTime));?>" placeholder="Enter start date & time" title="Please enter start date & time." id="start-date" class="form-control" />
											            <span class="input-group-addon">
											                <span class="glyphicon glyphicon-calendar"></span>
											            </span>
											        </div>
											        <label class="error" id="sDate-err"></label>
											    </div>
											</div>
											<div class='custom_proptions col-md-6 col-sm-12'>
											    <div class="inner-wrap">
											    	<div class="section">End Date and Time</div>
											        <div class='input-group date' id='datetimepicker7'>
											            <input oninput="$('#eDate-err').html('');" type='text' name="endDateTime" value="<?php echo date('m/d/Y H:i A',strtotime($bidTime->endDateTime));?>" placeholder="Enter end date & time" title="Please enter end date & time." id="end-date" class="form-control" />
											            <span class="input-group-addon">
											                <span class="glyphicon glyphicon-calendar"></span>
											            </span>
											        </div>
											         <label class="error" id="eDate-err"></label>
											    </div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
					                			<div class="section">Description</div>
							                    <div class="inner-wrap">
							                        <textarea class="form-control" onkeyup="$('#des-err').html('');" name="description" title="Please enter description." id="description"><?php echo $details->description; ?></textarea>
							                        <label class="error" id="des-err"></label>
							                    </div>
					                		</div>
				                		</div>
				                		<div class="button-section mt-4 text-center">
					                     	<a id="secondClick" href="javascript:void(0);" onclick="$('#viewDes').show();$('#updateDes').hide();" class="btn btn-theme prev-btn">Cancel</a>
					                     	<button type="submit" class="btn btn-theme" >Update</button>
					                    </div>
				                	</form>
								</div>
							</div>
							<div class="property-section property-overview">
								
								<div id="viewDetail">
									<?php if($details->isBooked == '1'){ ?>
									<div class="property_item">
										<a  onclick="$('#viewDetail').hide();$('#updateVal').show();" href="javascript:void(0);" class="property_link sm-icon">
							                <i class="fa fa-edit property_icon" aria-hidden="true"></i>
							            </a>
									</div>
									<?php }?>
									<h3>Details</h3>
									<ul class="columns-gap">            	
										<!-- <li><span>Year built:</span> 2017</li> -->
										<li id='newpropType'><span>Property Type:</span> <?php echo ucwords($details->typeName); ?></li>
										<li><span>Sold:</span> <?php echo ($details->isSold == '1') ? 'Sold' : 'On Sale'; ?> </li>
										<!-- <li><span>Contract:</span> Sale </li> -->
										<li><span>Status:</span> <?php echo ($details->propertyStatus == '1') ? 'NEW' : 'Old'; ?></li>
										<li id='newArea'><span>Area:</span> <?php echo $details->area.' m<sup>2</sup>'; ?></li>
										<!-- <li><span>Lot dimensions:</span> 20x30x40 ft</li> -->
										<!-- <li><span>Lot area:</span> <?php echo $details->area.' sqm'; ?></li> -->
										<li id='newbedVal'><span>Bedrooms:</span> <?php echo !empty($details->bedRoom) ? $details->bedRoom : 'NA'; ?></li>
										<li id='newbathVal'><span>Bathrooms:</span> <?php echo !empty($details->bathRoom) ? $details->bathRoom : 'NA'; ?></li>
										<li id='newparkVal'><span>Car Parkings:</span> <?php echo !empty($details->carParking) ? $details->carParking : 'NA'; ?></li>
										<li id='newpoolVal'><span>Swimming Pools:</span> <?php echo !empty($details->swimmingPool) ? $details->swimmingPool : 'NA'; ?></li>
									</ul>
								</div>
							
								<div id="updateVal" class="showHide CSForm form-style-10 form-style-cs">
									<h3>Update Detail</h3>
									<form onsubmit="return updateRecord();"  method="POST" action="javascript:void(0);">
								  		<div id="step-1">
						                	<div class="row">
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Property Name</div>
								                    <div class="inner-wrap">
								                        <input class="form-control" oninput="$('#propName-err').html('');" type="text" name="propertyName" value="<?php echo $details->propertyName; ?>" title="Please enter property name." placeholder="Enter property name" id="property-name" id="property-name"/>
								                    	<label class="error" id="propName-err"></label>
								                    </div>
						                		</div>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Purchase Amount</div>
								                    <div class="inner-wrap">
								                        <input class="form-control" oninput="$('#purchsAmt-err').html('');" type="text" name="purchaseAmount" value="<?php echo $details->purchaseAmount; ?>" title="Please enter purchase amount." onkeypress="return isNumberKey(event);" placeholder="Enter purchase amount" id="purchase-amt"/>
								                        <label class="error" id="purchsAmt-err"></label>
								                    </div>
						                		</div>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Property Address</div>
								                    <div class="inner-wrap">
								                        <input class="form-control" oninput="$('#address-err').html('');" type="text" id="address" name="address" value="<?php echo $details->address; ?>" title="Please select property address." id="address" placeholder="Property address"/>
								                    	<label class="error" id="address-err"></label>
								                    </div>
						                		</div>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Property Type</div>
								                    <div class="inner-wrap">	
														<select onchange="$('#propType-err').html('');" class="selectcs" name="propertytypeId" title="Please select property type." id="property-type">
															<option value="">Select Property type</option>
															<?php foreach($pType as $pType):  ?>
																<option id="<?php echo $pType->id; ?>" value="<?php echo $pType->id; ?>" <?php if($pType->id == $details->propertytypeId){ echo "selected='selected'";}?>><?php echo ucwords($pType->typeName); ?></option>
															<?php endforeach;?>
														</select>
								                    	
								                    	<label class="error" id="propType-err"></label>
								                    </div>
						                		</div>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Area (In m<sup>2</sup>)</div>
								                    <div class="inner-wrap">
								                        <input class="form-control" oninput="$('#area-err').html('');" type="text" name="area" onkeypress="return isNumberKey(event);" value="<?php echo $details->area; ?>" title="Please enter area." placeholder="Enter area" id="area"/>
							    						
							    						<label class="error" id="area-err"></label>
								                    </div>
						                		</div>
						                		<?php $Bedroom = array('1','2','3','4','5');?>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Bedroom</div>
								                    <div class="inner-wrap">
								                        <select id="bedVal" class="selectcs" name="bedRoom" title="Please select bedRoom.">
								    						<option value="">Select Value</option>
								    						<?php  foreach($Bedroom as $value): ?>
								                            	<option value="<?php echo $value; ?>" <?php if($value == $details->bedRoom){ echo "selected='selected'";}?>><?php echo $value; ?></option>
								                            <?php endforeach;?>	
							    						</select>
								                    </div>
						                		</div>

						                		<?php $Bathroom = array('1','2','3','4','5');?>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Bathroom</div>
								                    <div class="inner-wrap">
								                        <select id="bathVal" class="selectcs" name="bathRoom" title="Please select bathroom.">
								    						<option value="">Select Value</option>
								    						<?php foreach($Bathroom as $val):?>
								                            	<option value="<?php echo $val; ?>" <?php if($val == $details->bathRoom){ echo "selected='selected'";}?>><?php echo $val; ?></option>
								                            <?php endforeach;?>	
							    						</select>
								                    </div>
						                		</div>

						                		<?php $Parking = array('1','2','3','4','5');?>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Car Parking</div>
								                    <div class="inner-wrap">
								                        <select id="parkVal" class="selectcs" name="carParking" title="Please select car parking.">
								    						<option value="">Select Value</option>
								    						<?php  foreach($Parking as $parking):?>
								                            	<option value="<?php echo $parking; ?>" <?php if($parking == $details->carParking){ echo "selected='selected'";}?>><?php echo $parking; ?></option>
								                            <?php endforeach;?>	
							    						</select>
								                    </div>
						                		</div>

						                		<?php $Pool = array('1','2','3','4','5');?>
						                		<div class="col-md-6 col-sm-12">
						                			<div class="section">Swimming Pool</div>
								                    <div class="inner-wrap">
								                        <select id="poolVal" class="selectcs" name="swimmingPool" title="Please select swimmingPool.">
								    						<option value="">Select Value</option>
								    						<?php  foreach($Pool as $pool):?>
								                            	<option value="<?php echo $pool; ?>" <?php if($pool == $details->swimmingPool){ echo "selected='selected'";}?>><?php echo $pool; ?></option>
								                            <?php endforeach;?>	
							    						</select>
								                    </div>
						                		</div>
						                	</div>
						                </div>
						                <div class="button-section mt-4 text-center">
					                     	<a id="firstClick" href="javascript:void(0);" onclick="$('#viewDetail').show();$('#updateVal').hide();" class="btn btn-theme prev-btn">Cancel</a>
					                     	<button type="submit" class="btn btn-theme" >Update</button>
					                    </div>
						            </form>
								</div>
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
									  		<?php if($details->isBooked == '1'){ ?>
									  		<div class="property_item">
												<a onclick="$('#viewImg').hide();$('#updateImg').show();" href="javascript:void(0);" class="property_link sm-icon">
									                <i class="fa fa-edit property_icon" aria-hidden="true"></i>
									            </a>
											</div>
											<?php } ?>
										  	<div id="viewImg" class="floorPlan">
								  				<div class="floorImg">
								  					<?php if(!empty($details->floorPlan)) {?>
								  					<a class="thumbnail fancybox" rel="ligthbox" href="javascript:void(0);">
								                        <!-- <img class="img-responsive" alt="" src="img/floorplan/1.png" /> -->
								                        <img id="showImg" class="img-responsive" alt="" src="<?php echo base_url().'upload/floorPlan/'.$details->floorPlan;?>" />
								                    </a>
								                    <?php } else{ ?> 
								                    	 <img id="showDImg" class="img-responsive" alt="" src=""/>
								                    <?php }?>
								  				</div>
										  	</div>
										  	<div id="updateImg" class="showHide  CSForm form-style-10 form-style-cs">
										  		<form onsubmit="return updateFPImg();"  method="POST" action="javascript:void(0);" enctype="multipart/form-data">
										  			<h4>Update Floor Plan Image</h4>
										  			<div class="col-md-12 col-sm-12">
							                			<div class="section">Floor Plan</div>
									                    <div class="inner-wrap fileinput">
									                        <input class="form-control" accept="image/*" onchange="readURL(this);$('#floorPlan-err').html('');" type="file" id="floorPlan" name="floorPlan" title="Please upload floor plan image." value=""/>	
									                    </div>
									                    <label class="error" id="floorPlan-err"></label>
							                		</div>
							                		<div class="button-section mt-4 text-center">
								                     	<a id="thirdClick" href="javascript:void(0);" onclick="$('#viewImg').show();$('#updateImg').hide();" class="btn btn-theme prev-btn">Cancel</a>
								                     	<button type="submit" class="btn btn-theme" >Update</button>
								                    </div>
										  		</form>
										  	</div>
									  	</div>
									  	<div class="tab-pane active" id="Map" role="tabpanel">
									  		<div id="mapAddress" style="width: 100%; height: 300px;"></div> 
									  	</div> 
									</div>
								</div>
							</div>
							<div class="property-section shopping-cart">
								<h3>Shopping Cart</h3>
								<div class="doc">
									<h2 class="float-left">Inspection Report</h2>
									<a href="#" onclick="window.open('<?php echo base_url().'upload/inspectionReport/'.$details->inspectionReport; ?>')" class="btn btn-theme float-right">View Document</a>
								</div>
								<div class="doc">
									<h2 class="float-left">Property Proof</h2>
									<a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'upload/propertyProof/'.$details->propertyProof; ?>')" class="btn btn-theme float-right">View Document</a>
								</div>
								<?php if($details->propertyStatus == '2'){ 
									if(!empty($details->evaluationReport)){?>
								<div class="doc">
									<h2 class="float-left">Valuation Report</h2>
									<a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'upload/evaluationReport/'.$details->evaluationReport; ?>')" class="btn btn-theme float-right">View Document</a>
								</div>
								<?php }else{ ?>
									<div class="doc">
									<h2 class="float-left">Valuation Report</h2>
									<a href="javascript:void(0);" class="btn btn-theme float-right">Document Not Upload</a>
								</div>
								<?php } } ?>
							</div>
	    				</div>
	    			</div>
	    			<div class="col-lg-4 col-md-12">
	    				<div class="Sidebar">
	    					<?php if($details->propertyStatus == '2'){?>
		    					<h5>Highest bid on this property</h5>
			    				<div class="UserBookInfo">
									<div class="userBook">
										<div class="">
										  	<span><i class="fa fa-user"></i></span>
										</div>
										<div class="">									    
											<h2><a href="javascript:void(0);"><?php echo !empty($details->highestBidder) ? ucwords($details->highestBidder) : 'NA'; ?></a></h2>
											<!-- <p><i class="fa fa-envelope"></i>alversonkyler@gmail.com</p> -->
											<h4><?php echo !empty($details->highestBidAmt) ? '$'.$details->highestBidAmt : 'NA'; ?></h4>
										</div>
									</div>
									<?php if(!empty($allBidders)){  ?>
									<div class="text-right text-link">
										<a href="javascript:void();" data-toggle="modal" data-target="#bidUser">View More</a>
									</div>
									<?php } ?>
								</div>
							<?php } else{ ?>
		    					<h5>Sold To</h5>
		    					<div class="UserBookInfo">
									<div class="userBook">
										  <div class="">
										  	<span><i class="fa fa-user"></i></span>
										  </div>
										  <div class="">									    
												<h2><a href="javascript:void(0);"><?php echo !empty($details->soldToName) ? ucwords($details->soldToName) : 'NA'; ?></a></h2>
												<p><i class="fa fa-envelope"></i><?php echo !empty($details->soldToEmail) ? $details->soldToEmail : 'NA'; ?></p>
										  </div>
									</div>
								</div>
							<?php } ?>
	    				</div>
	    				<div class="Sidebar">
	    					<h5>Recently Added Property</h5>
	    					<div class="SidebarProperty">
	    						<?php if(!empty($recentProperty)){ foreach ($recentProperty as $recent) { ?>
	    						<div class="pBlock">
	    							<a href="<?php echo base_url('seller/viewProperty/').$recent['propertyId'];?>">
	    							<div class="Rimg"><img src="<?php echo $recent['pImage'];?>"></div>
	    							<h2><?php echo ucwords($recent['propertyName']); ?></h2>
	    							<p><?php echo $recent['purchaseAmount']; ?></p>
	    							</a>
	    						</div>
	    						<?php } }else{ echo "No Recent Record"; }?>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </div>
</section>
<!-- Bidder's List Modal -->
<div class="csModal biduserModal">
	<div class="modal fade" id="bidUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?php echo $countBidders;?> Bids</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="listBlock">
						<?php if(!empty($allBidders)){ foreach ($allBidders as $bidVal) { ?>
						<div class="UserBidInfo">
							<div class="bidHead">
								<div class="bidCnt">
									<h2>
										<a href="javascript:void(0);"><?php echo ucwords($bidVal['bidderName']); ?></a>
									</h2>
									<p class="metaP">
										<i class="fa fa-clock-o"></i><?php echo $bidVal['upd']; ?>
									</p>
								</div>
								<div class="bidPrice">
									<p>
										<?php echo $bidVal['bidAmount']; ?>
										<span>Bid Price</span>
									</p>
								</div>
							</div>
						</div>
						<?php } }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bidder's List Modal -->

<input id="lat" value="<?php echo $details->latitude;?>" type="hidden">
<input id="long" value="<?php echo $details->longitude;?>" type="hidden">
<input id="add" value="<?php echo $details->address;?>" type="hidden">

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH_tbuOQjByUQDu3fwDnBzXtVVEyQK9Ao&callback=initialize&libraries=places"
  type="text/javascript"></script> 

<script type="text/javascript">

	$(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });

    /*function initializeAddress() {
        var input = document.getElementById('address');
        new google.maps.places.Autocomplete(input);
    }*/
    

	function deletePropertyImages(id){

		var message = "Are you sure,you want to delete this image?";
		
    	$('<div></div>').appendTo('body')
        .html('<div><h6>'+message+'</h6></div>')
        .dialog({
            modal: true, title: 'Delete message', zIndex: 9999, autoOpen: true,
            width: 'auto', resizable: false,
            buttons: {
                Yes: function () {
                   
                    var pId = '<?php echo $details->id;?>';

				        $.ajax({ 
				            url: '<?php echo base_url();?>seller/deletePropertyImage',
				            data: {id:id,pId:pId},
				            type: 'post',
				            success: function(data) {
				            	$('#showLink').text('Reload page to see affected images in slider');
				            	$('#dImg'+id).html('');
				            	$('#dImg'+id).hide();
				            }
				        });
				        $(this).dialog("close");
                },
                No: function () {    
                    $(this).dialog("close");
                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });
	}

	function addMorePropImg(){

		var file_data = $('#newImgMy').prop("files")[0];
        var form_data = new FormData();
        form_data.append("pImage", file_data);
        form_data.append("pId", <?php echo $details->id;?>);
        form_data.append("countImg", <?php echo $countImg;?>);

        $.ajax({ 
            url: '<?php echo base_url();?>seller/addPropertyImage',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data) {
            	$(".updateSliderImg div.item:last").before(data);
            	$('#showLink').text('Reload page to see affected images in slider');
            }
        });
		
	}

	function PropertyImages(id){
		
		var file_data = $('#imgMy'+id).prop("files")[0];
        var form_data = new FormData();
        form_data.append("pImage", file_data);
        form_data.append("pId", <?php echo $details->id;?>);
        form_data.append("id", id);

        $.ajax({ 
            url: '<?php echo base_url();?>seller/updatePropertyImage',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data) {
            	$('#showLink').text('Reload page to see affected images in slider');
            }
        });
	}

	function updateFPImg(){

		var err = 0;
        var file_data = $("#floorPlan").prop("files")[0];
        var form_data = new FormData();

        form_data.append("floorPlan", file_data);
        form_data.append("id", <?php echo $details->id;?>);

		if( document.getElementById("floorPlan").files.length == 0 ){
	        err=1;                
	        $('#floorPlan-err').html("Please upload floor plan image.");
	    }else{                
	        $('#floorPlan-err').html(""); 
	    }

		if(err){
			return false;
		}else{

			$.ajax({ 
	            url: '<?php echo base_url();?>seller/updateRecord',
	            cache: false,
                contentType: false,
                processData: false,
                data: form_data,
	            type: 'post',
	            success: function(data) {
	            	
	            	$('#thirdClick').click();
	            	$('#showImg').attr('src', $('#idImage').val());
	            	$('#showDImg').attr('src', $('#idImage').val());
	            }
	        });
		}
	}

	function updateDescription(){

		var err = 0;
		var description = $('#description').val();
		var sDate = $('#start-date').val();
		var eDate = $('#end-date').val();

		var id = '<?php echo $details->id;?>';
		var propStatus = '<?php echo $details->propertyStatus;?>';

		if(description ==''){
	        err=1;                
	        $('#des-err').html("Please enter description.");
	    }else{                
	        $('#des-err').html(""); 
	    }

	    if(propStatus == '2'){

        	if(sDate == ''){
	            err=1;                
	            $('#sDate-err').html("Please select start date & time.");
	        }else{                
	            $('#sDate-err').html(""); 
	        }

	        if(eDate ==''){
	            err=1;                
	            $('#eDate-err').html("Please select end date & time.");
	        }else{                
	            $('#eDate-err').html(""); 
	        }
        }   

		if(err){
			return false;
		}else{

			$.ajax({ 
	            url: '<?php echo base_url();?>seller/updateRecord',
	            data: {description:description,id:id,propStatus:propStatus,sDate:sDate,eDate:eDate},
	            type: 'post',
	            success: function(data) {
	            	$('#secondClick').click();
	            	$('#newDes').html(description);
	            	if(data != '1'){
	            		var obj= $.parseJSON(data);
	            		
	            		if(obj != ''){
			            	$('#newSTime').html('<span><i class="fa fa-calendar"></i> Start Time:</span>' +obj.startDate);
			            	$('#newETime').html('<span><i class="fa fa-calendar"></i> End Time:</span>' +obj.endDate);
			            	//$('#start-date').val(obj.endDate);
			            	$('#newDes').html(description);
		            	}
	            	} 
	            	
	            }
	        });
		}
	}

	function updateRecord(){

		var err = 0;
		var propType = $('#property-type').val();
		var area = $('#area').val();
		var bedVal = $('#bedVal').val();
		var bathVal = $('#bathVal').val();
		var parkVal = $('#parkVal').val();
		var poolVal = $('#poolVal').val();
		var address = $('#address').val();

		var propertyName = $('#property-name').val();
		var purchaseAmount = $('#purchase-amt').val();
		var id = '<?php echo $details->id;?>';

		if(propertyName ==''){
	        err=1;                
	        $('#propName-err').html("Please enter property name.");
	    }else{                
	        $('#propName-err').html(""); 
	    }

	    if(propType ==''){
	        err=1;                
	        $('#propType-err').html("Please select property type.");
	    }else{                
	        $('#propType-err').html(""); 
	    }

	    if(purchaseAmount ==''){
	        err=1;                
	        $('#purchsAmt-err').html("Please enter purchase amount.");
	    }else if(purchaseAmount < 1){
	        err=1;                
	        $('#purchsAmt-err').html("Please enter valid purchase amount.");
	    }else{                
	        $('#purchsAmt-err').html(""); 
	    }

	    if(area =='' || area =='0'){
	        err=1;                
	        $('#area-err').html("Please enter area.");
	    }else if(area < 1){
	        err=1;                
	        $('#area-err').html("Please enter valid area.");
	    }else{                
	        $('#area-err').html(""); 
	    }

	    if(address ==''){
	        err=1;                
	        $('#address-err').html("Please select property address.");
	    }else{                
	        $('#address-err').html(""); 
	    }

		if(err){
			return false;
		}else{

			$.ajax({ 
	            url: '<?php echo base_url();?>seller/updateRecord',
	            data: {propType:propType,area:area,bedVal:bedVal,bathVal:bathVal,parkVal:parkVal,poolVal:poolVal,id:id,propertyName:propertyName,purchaseAmount:purchaseAmount,address:address},
	            type: 'post',
	            success: function(data) {

	            	var obj= $.parseJSON(data);

	            	$('#lat').val(obj.latitude);
					$('#long').val(obj.longitude);
					$('#add').val(address);
					initialize();
	            	$('#firstClick').click();
	            	$('#newArea').html('<span>Area:</span> '+area + ' m<sup>2</sup>');
	            	$('#newbedVal').html('<span>Bedrooms:</span> '+bedVal);
	            	$('#newbathVal').html('<span>Bathrooms:</span> '+bathVal);
	            	$('#newparkVal').html('<span>Car Parkings:</span> '+parkVal);
	            	$('#newpoolVal').html('<span>Swimming Pools:</span> '+poolVal);

	            	if(propType){
		            	$('#newpropType').html('<span>Property Type:</span> '+$('#'+propType).text());
		            	$('#imgNewpropType').html($('#'+propType).text());
		            }
		            
		            $('#hpArea').html('<i class="fa fa-object-group" aria-hidden="true"></i> '+area + ' m<sup>2</sup>');
		            
		            $('#hpBR').html('<i class="fa fa-bed" aria-hidden="true"></i> '+ bedVal);
		            $('#hpBathR').html('<i class="fa fa-bath" aria-hidden="true"></i> '+ bathVal);
		            $('#newAddress').html('<i class="fa fa-map-marker property_address-icon"></i> '+ address);

		            $('#hpPN').html(propertyName);
		            $('#hpPA').html('$ '+ purchaseAmount);	            	
	            }
	        });
		}
	}

	function isNumberKey(evt) {

		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (charCode > 31 && charCode !=46 && (charCode < 48 || charCode > 57)) {			
			return false;
		}		
		return true;
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	
	function initialize() {

		var input = document.getElementById('address');
        new google.maps.places.Autocomplete(input);
		var lat = $('#lat').val();
		var longi = $('#long').val();
		var adds = $('#add').val();
	   	var latlng = new google.maps.LatLng(lat,longi);
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
	      '<div class="iw_title"><b>Location</b> : '+adds+'</div></div>';
	      // including content to the infowindow
	      infowindow.setContent(iwContent);
	      // opening the infowindow in the current map and at the current marker location
	      infowindow.open(map, marker);
	    });
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	function readURL(input) {  
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#idImage').val(e.target.result)
		}
			reader.readAsDataURL(input.files[0]);
		}
	}

</script>

<input id="idImage" value="" type="hidden">