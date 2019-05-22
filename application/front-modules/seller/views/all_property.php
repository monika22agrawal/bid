<?php $page = $this->uri->segment(3); ?>
<section class="MypropertySec sec-pad gray-bg">
    <div class="container">
    	<div class="mainHead mb-5 Hcenter">
			<h2>My <span>Properties</span></h2>
			<div class="at-heading-under-line lCenter">
	            <div class="at-heading-inside-line"></div>
	        </div>
	        <p>“List your property for free. You only pay commission if the property sells. Please read the terms and conditions before proceeding”</p>
		</div>

        <div class="row">
            <div class="col-md-4">

            	<div class="Sidebar property-filter">
            		<h5>Find Your Property</h5>
            		<div class="filterForm">
            			<form method="post">
            				<div class="form-group">
            					<label>Location</label>
            					<input type="text" value="" name="address" id="address" placeholder="Enter Location">
            				</div>
                            <div class="form-group">
                                <div class="price-ranger">
                                    <label>Property Status</label>
                                    <select class="propStatus form-control selectcs" name="propStatus">
                                        <option value="">Select Property type</option>
                                        <option value="1">New</option>
                                        <option value="2">Old</option>
                                    </select>
                                </div>
                            </div>
            				<div class="form-group">
            					<label>Property Type</label>
            					<select class="form-control propType selectcs" name="propertytypeId">
        							<option value="">Select Property type</option>
        							<?php  foreach($pType as $pType):  ?>
        								<option value="<?php echo $pType->id; ?>" <?php if(isset($_POST['propertytypeId']) && $this->input->post('propertytypeId') == $pType->id){ echo "selected='selected'";}?> ><?php echo $pType->typeName; ?></option>
        							<?php endforeach;?>
        						</select>
            				</div>
                            
            				<?php $Bedroom = array('0','1','2','3','4','5');?>
                    		<div class="form-group">
                    			<label>Bedroom</label>
                                <select class="form-control bedRoom selectcs" name="bedRoom">
            						<option value="">Select Value</option>
            						<?php  foreach($Bedroom as $value):?>
                                    	<option value="<?php echo $value; ?>" <?php if(isset($_POST['bedRoom']) && $this->input->post('bedRoom') == $value){ echo "selected='selected'";}?> ><?php echo $value; ?></option>
                                    <?php endforeach;?>	
        						</select>
                    		</div>
            				<?php $Bathroom = array('0','1','2','3','4','5');?>
                    		<div class="form-group">
                    			<label>Bathroom</label>
                                <select class="form-control bathRoom selectcs" name="bathRoom">
            						<option value="">Select Value</option>
            						<?php  foreach($Bathroom as $val):?>
                                    	<option value="<?php echo $val; ?>" <?php if(isset($_POST['bathRoom']) && $this->input->post('bathRoom') == $val){ echo "selected='selected'";}?> ><?php echo $val; ?></option>
                                    <?php endforeach;?>	
        						</select>
                    		</div>
                    		<?php $Parking = array('0','1','2','3','4','5');?>
                    		<div class="form-group">
                    			<label>Car Parking</label>
                                <select class="form-control carParking selectcs" name="carParking">
            						<option value="">Select Value</option>
            						<?php  foreach($Parking as $parking):?>
                                    	<option value="<?php echo $parking; ?>" <?php if(isset($_POST['carParking']) && $this->input->post('carParking') == $parking){ echo "selected='selected'";}?> ><?php echo $parking; ?></option>
                                    <?php endforeach;?>	
        						</select>
                    		</div>
                            <?php $Pool = array('0','1','2','3','4','5');?>
                            <div class="form-group">
                                <label>Swimming Pool</label>
                                <select class="form-control swimmingPool selectcs" name="swimmingPool">
                                    <option value="">Select Value</option>
                                    <?php  foreach($Pool as $Pool):?>
                                        <option value="<?php echo $Pool; ?>" <?php if(isset($_POST['carParking']) && $this->input->post('carParking') == $Pool){ echo "selected='selected'";}?> ><?php echo $Pool; ?></option>
                                    <?php endforeach;?> 
                                </select>
                            </div>
            				<div class="form-group">
            					<div class="price-ranger">
                					<label>Price Range</label>
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <input class="float-right" type="text"  placeholder="From" />
                                        </div>
                                        <div class="col-md-6">
                                            <input class="float-right" type="text" placeholder="To" />
                                        </div>
                                    </div> -->

                    					<!-- <div class="price">
                    						<input class="min float-left" type="text" readonly >
                    						<input class="max float-right" type="text" readonly >
                    					</div>
                    					<div class="rangeSlide" id="slider-range"></div> -->
                                    
                                    <select class="priceVal form-control selectcs" name="priceVal">
                                        <option value="">Select Price</option>
                                        <option value="0-100">0 - 100</option>
                                        <option value="100-500">100 - 500</option>
                                        <option value="500-1000">500 - 1000 </option>
                                        <option value="1000-2000">1000 - 2000</option>
                                        <option value="2000-more">2000 - more</option>
                                    </select>
            					</div>
            				</div>
                            
            				<div class="form-group">
            					<div class="price-ranger">
                					<label>Area (in m<sup>2</sup>)</label>
                					<!-- <div class="price">
                						<input class="Amin float-left" type="text" readonly >
                						<input class="Amax float-right" type="text" readonly >
                					</div>
                					<div class="rangeSlide" id="area-range"></div> -->
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <input class="float-right" type="text"  placeholder="From" />
                                        </div>
                                        <div class="col-md-6">
                                            <input class="float-right" type="text" placeholder="To" />
                                        </div>
                                    </div> -->
                                    <select class="areaVal form-control selectcs" name="areaVal">
                                        <option value="">Select Area</option>
                                        <option value="10-100">10 - 100</option>
                                        <option value="100-500">100 - 500</option>
                                        <option value="500-1000">500 - 1000 </option>
                                        <option value="1000-2000">1000 - 2000</option>
                                        <option value="2500-3000">2500 - 3000</option>
                                        <option value="3000-3500">3000 - 3500</option>
                                        <option value="3500-4000">3500 - 4000</option>
                                        <option value="4000-4500">4000 - 4500</option>
                                        <option value="4500-5000">4500 - 5000</option>
                                        <option value="5000-5500">5000 - 5500</option>
                                        <option value="5500-6000">5500 - 6000</option>
                                        <option value="6000-6500">6000 - 6500</option>
                                        <option value="6500-7000">6500 - 7000</option>
                                    </select>
            					</div>
            				</div>
            				<!-- <div class="form-group text-center mt-5">
            					<a href="#" class="btn btn-theme">Search</a>
            				</div> -->  				
            			</form>
            		</div>
            	</div>
            </div>
            <div class="col-md-8">
                <?php if(!empty($error)){?>
                    <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $error; ?>
                    </div>
                    <?php } ?> 
                    <?php if($this->session->flashdata('success') != null) : ?>  <!-- for Delete -->
                        <div class="">
                            <div class="alert alert-success success" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                <?php  echo $this->session->flashdata('success');?>
                            </div>
                        </div><!-- /.box-body -->
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error') != null) : ?>  <!-- for Delete -->
                        <div class="">
                            <div class="alert alert-danger success" id="error-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                <?php  echo $this->session->flashdata('error');?>
                            </div>
                        </div><!-- /.box-body -->
                    <?php endif; ?>
                <div class="Myproperty">
                    <div class="row" id="productList">
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBCKpfnLn74Hi2GBmTdmsZMJORZ5xyL1as"></script>

<script type="text/javascript">

    function initialize() {
        var input = document.getElementById('address');
        new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

	ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');

    $(".propType").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });       
    $(".bedRoom").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });       
    $(".bathRoom").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });       
    $(".carParking").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });
    $(".swimmingPool").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });
    $("#address").change(function () {
        setTimeout(function(){
            ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
        }, 500);        
    });
    $(".priceVal").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });
    $(".propStatus").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });
    $(".areaVal").change(function () {
        ajax_fun('<?php echo base_url()."seller/allPropertyList/".$page; ?>');
    });


    function ajax_fun(url)
    { 
        var type =$("select[name='propertytypeId']").val();
        var bedRoom =$("select[name='bedRoom']").val();
        var bathRoom =$("select[name='bathRoom']").val();
        var carParking =$("select[name='carParking']").val();
        var swimmingPool =$("select[name='swimmingPool']").val();
        var propStatus =$("select[name='propStatus']").val();
        var address =$("#address").val();
        var priceVal =$("select[name='priceVal']").val();
        var areaVal =$("select[name='areaVal']").val();
        
        $.ajax({
            url: url,
            type: "POST",
            data:{type:type,bedRoom:bedRoom,bathRoom:bathRoom,carParking:carParking,address:address,priceVal:priceVal,areaVal:areaVal,swimmingPool:swimmingPool,propStatus:propStatus},          
            cache: false,
            beforeSend: function() {
                $("#productList").html("<img class='prloader' style='display: block;margin: 0 auto;' src='<?php echo base_url().FRONT_THEME;?>img/500.GIF' alt='' '>");
            },         
            success: function(data){
                $("#productList").html(data);
            }
        });      
    } 

</script>