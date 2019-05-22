<?php $page = $this->uri->segment(3); ?>
<section class="Profile sec-pad gray-bg">
	<div class="container">
		<div class="profileAccount">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="MyInfo">
						<?php include_once 'sidebar.php';?>	
					</div>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="Myproperty CartProprty">
						<div class="row" id="cartProductList">
							<!-- <div class="col-lg-6 col-md-6">
								<div class="at-property-item mb-4">
				                    <div class="at-property-img">
				                        <img src="<?php echo base_url().FRONT_THEME;?>img/property/2.jpg" alt="">
				                        <div class="at-property-overlayer"></div>
				                        <a class="btn btn-default at-property-btn" href="javascript:void(0);" role="button">View Details</a>
				                        <h4>For Sale</h4>
				                        <h5>Plot</h5>
				                    </div>
				                    <div class="at-property-dis">
				                        <ul>
				                            <li><i class="fa fa-object-group" aria-hidden="true"></i> 520 sqm</li>
				                            <li><i class="fa fa-bed" aria-hidden="true"></i> 6</li>
				                            <li><i class="fa fa-bath" aria-hidden="true"></i> 3</li>
				                        </ul>
				                    </div>
				                    <div class="at-property-location">
				                        <h3><a href="javascript:void(0);">New Superb Villa</a></h3>
				                        <h5>$59,999</h5>
				                        <p><i class="fa fa-map-marker"></i> 123 1st Width Road, , summit, new york</p>
				                        <span class="note warningNote">Document upload is pending</span>
				                        <a href="javascript:void(0);" class="btn btn-outline btn-circle"><i class="fa  fa-cloud-upload"></i></a>
				                        <p class="note dangerNote">3 days left to upload your fund proof document.</p>
				                        <div class="alert alert-danger">
										  <strong>Alert!</strong> You have 3 days left to upload fund proof document.
										</div>
				                    </div>
				                </div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="at-property-item OldPr mb-4">
				                    <div class="at-property-img">
				                        <img src="<?php echo base_url().FRONT_THEME;?>img/property/2.jpg" alt="">
				                        <div class="at-property-overlayer"></div>
				                        <a class="btn btn-default at-property-btn" href="javascript:void(0);" role="button">View Details</a>
				                        <h4>For Sale</h4>
				                        <h5>Plot</h5>
				                        <h4>Sold</h4>
				                    </div>
				                    <div class="at-property-dis">
				                        <ul>
				                            <li><i class="fa fa-object-group" aria-hidden="true"></i> 520 sqm</li>
				                            <li><i class="fa fa-bed" aria-hidden="true"></i> 6</li>
				                            <li><i class="fa fa-bath" aria-hidden="true"></i> 3</li>
				                        </ul>
				                    </div>
				                    <div class="at-property-location">
				                        <h3><a href="javascript:void(0);">New Superb Villa</a></h3>
				                        <h5>$59,999</h5>
				                        <p><i class="fa fa-map-marker"></i> 123 1st Width Road, , summit, new york</p>
				                        <span class="note infoNote">Property added your cart complete next process.</span>

				                    </div>
				                </div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">


    ajax_fun('<?php echo base_url()."buyer/allCartPropertyList/".$page; ?>');

    function ajax_fun(url)
    {    
        $.ajax({
            url: url,
            type: "POST",
            data:{page: url},              
            cache: false,     
            beforeSend: function() {
                $("#cartProductList").html("<img class='prloader' style='display: block;margin: 0 auto;' src='<?php echo base_url().FRONT_THEME;?>img/500.GIF' alt='' '>");
            },                      
            success: function(data){
                $("#cartProductList").html(data);
            }
        });        
    } 

</script>