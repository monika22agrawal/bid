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
					<div class="EditInfo CSForm">
						<div class="EditInfohead">
							<h2>Upload property information</h2>
						</div>
						<div class="form-style-10 AddPr">
							<div class="stepwizard col-md-offset-3">
							    <div class="stepwizard-row setup-panel">
							      	<div class="stepwizard-step">
								        <a id="first" class="btn btn-act btn-circle">1</a>
								        <p>Property Info</p>
							      	</div>
							      	<div  class="stepwizard-step">
							        	<a id="second" class="btn btn-disabled btn-circle not-active" >2</a>
							        	<p>Property images and proof</p>
								    </div>
							    </div>
							</div>
						  	<form id="addProperty" method="POST" action="<?php echo base_url('seller/addProperty');?>" enctype="multipart/form-data">
						  		<div id="step-1">
				                	<div class="row">
				                		

				                		<div class="col-md-6 col-sm-12">
				                			<div class="form-group">
						    					<div class="section">Property Status</div>
						    					<select onchange="$('#propStatus-err').html('');" class="selectcs" name="propertyStatus" title="Please select property status." id="pStatus" >
						    						<option value="1" <?php echo $this->input->post('1') == '1' ? ' selected="selected"' : '';?>>New</option>
						    						<option value="2" <?php echo $this->input->post('2') == '2' ? ' selected="selected"' : '';?>>Old</option>
						    					</select>
					    						<label class="error"><?php echo form_error('propertyStatus'); ?></label>
					    						<label class="error" id="propStatus-err"></label>
					    					</div>
				                		</div>
				                		
										<div class='custom_proptions col-md-6 col-sm-12' style="display:none;">
										    <div class="inner-wrap">
										    	<div class="section">Start Date and Time</div>
										        <div class='input-group date' id='datetimepicker6'>
										            <input oninput="$('#sDate-err').html('');" type='text' name="startDateTime" value="<?php echo set_value('startDateTime'); ?>" placeholder="Enter start date & time" title="Please enter start date & time." id="start-date" class="form-control" />
										            <span class="input-group-addon">
										                <span class="glyphicon glyphicon-calendar"></span>
										            </span>
										        </div>
										        <label class="error" id="sDate-err"></label>
										    </div>
										</div>
										<div class='custom_proptions col-md-6 col-sm-12' style="display:none;">
										    <div class="inner-wrap">
										    	<div class="section">End Date and Time</div>
										        <div class='input-group date' id='datetimepicker7'>
										            <input oninput="$('#eDate-err').html('');" type='text' name="endDateTime" value="<?php echo set_value('endDateTime'); ?>" placeholder="Enter end date & time" title="Please enter end date & time." id="end-date" class="form-control" />
										            <span class="input-group-addon">
										                <span class="glyphicon glyphicon-calendar"></span>
										            </span>
										        </div>
										         <label class="error" id="eDate-err"></label>
										    </div>
										</div>

				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Property Name</div>
						                    <div class="inner-wrap">
						                        <input oninput="$('#propName-err').html('');" type="text" name="propertyName" value="<?php echo set_value('propertyName'); ?>" title="Please enter property name." placeholder="Enter property name" id="property-name" id="property-name"/>
						                    	<label class="error"><?php echo form_error('propertyName'); ?></label>
						                    	<label class="error" id="propName-err"></label>
						                    </div>
				                		</div>

				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Property Type</div>
						                    <div class="inner-wrap">	
												<select onchange="$('#propType-err').html('');" class="selectcs" name="propertytypeId" title="Please select property type." id="property-type">
													<option value="">Select Property type</option>
													<?php foreach($pType as $pType):  ?>
														<option value="<?php echo $pType->id; ?>" <?php if(isset($_POST['propertytypeId']) && $this->input->post('propertytypeId') == $pType->id){ echo "selected='selected'";}?> ><?php echo ucwords($pType->typeName); ?></option>
													<?php endforeach;?>
												</select>
						                    	<label class="error"><?php echo form_error('propertytypeId'); ?></label>
						                    	<label class="error" id="propType-err"></label>
						                    </div>
				                		</div>

				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Purchase Amount</div>
						                    <div class="inner-wrap">
						                        <input oninput="$('#purchsAmt-err').html('');" type="text" name="purchaseAmount" value="<?php echo set_value('purchaseAmount'); ?>" title="Please enter purchase amount." onkeypress="return isNumberKey(event);" placeholder="Enter purchase amount" id="purchase-amt"/>
						                        <label class="error"><?php echo form_error('purchaseAmount'); ?></label>
						                        <label class="error" id="purchsAmt-err"></label>
						                    </div>
				                		</div>

				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Area (In m<sup>2</sup>)</div>
						                    <div class="inner-wrap">
						                        <input oninput="$('#area-err').html('');" type="text" name="area" onkeypress="return isNumberKey(event);" value="<?php echo set_value('area'); ?>" title="Please enter area." placeholder="Enter area" id="area"/>
					    						<label class="error"><?php echo form_error('area'); ?></label>
					    						<label class="error" id="area-err"></label>
						                    </div>
				                		</div>

				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Property Address</div>
						                    <div class="inner-wrap">
						                        <input oninput="$('#address-err').html('');" type="text" id="address" name="address" value="<?php echo set_value('address'); ?>" title="Please select property address." id="address"/>
						                    	<label class="error"><?php echo form_error('address'); ?></label>
						                    	<label class="error" id="address-err"></label>
						                    </div>
				                		</div>

				                		<?php $Bedroom = array('0','1','2','3','4','5');?>
				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Bedroom</div>
						                    <div class="inner-wrap">
						                        <select class="selectcs" name="bedRoom">
						    						<option value="">Select Value</option>
						    						<?php  foreach($Bedroom as $value):?>
						                            	<option value="<?php echo $value; ?>" <?php if(isset($_POST['bedRoom']) && $this->input->post('bedRoom') == $value){ echo "selected='selected'";}?> ><?php echo $value; ?></option>
						                            <?php endforeach;?>	
					    						</select>
						                    </div>
				                		</div>

				                		<?php $Bathroom = array('0','1','2','3','4','5');?>
				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Bathroom</div>
						                    <div class="inner-wrap">
						                        <select class="selectcs" name="bathRoom">
						    						<option value="">Select Value</option>
						    						<?php  foreach($Bathroom as $val):?>
						                            	<option value="<?php echo $val; ?>" <?php if(isset($_POST['bathRoom']) && $this->input->post('bathRoom') == $val){ echo "selected='selected'";}?> ><?php echo $val; ?></option>
						                            <?php endforeach;?>	
					    						</select>
						                    </div>
				                		</div>

				                		<?php $Parking = array('0','1','2','3','4','5');?>
				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Car Parking</div>
						                    <div class="inner-wrap">
						                        <select class="selectcs" name="carParking">
						    						<option value="">Select Value</option>
						    						<?php  foreach($Parking as $parking):?>
						                            	<option value="<?php echo $parking; ?>" <?php if(isset($_POST['carParking']) && $this->input->post('carParking') == $parking){ echo "selected='selected'";}?> ><?php echo $parking; ?></option>
						                            <?php endforeach;?>	
					    						</select>
						                    </div>
				                		</div>

				                		<?php $Pool = array('0','1','2','3','4','5');?>
				                		<div class="col-md-6 col-sm-12">
				                			<div class="section">Swimming Pool</div>
						                    <div class="inner-wrap">
						                        <select class="selectcs" name="swimmingPool">
						    						<option value="">Select Value</option>
						    						<?php  foreach($Pool as $pool):?>
						                            	<option value="<?php echo $pool; ?>" <?php if(isset($_POST['swimmingPool']) && $this->input->post('swimmingPool') == $pool){ echo "selected='selected'";}?> ><?php echo $pool; ?></option>
						                            <?php endforeach;?>	
					    						</select>
						                    </div>
				                		</div>

				                		<div class="col-md-12 col-sm-12">
				                			<div class="section">Description</div>
						                    <div class="inner-wrap">
						                        <textarea onkeyup="$('#dec-err').html('');" name="description" title="Please enter description." id="description"><?php echo set_value('description'); ?></textarea>
						                        <label class="error"><?php echo form_error('description'); ?></label>
						                        <label class="error" id="dec-err"></label>
						                    </div>
				                		</div>
				                	</div>
				                	<div class="button-section mt-4 text-center">
				                     	<a href="#" id="btnnxt" class="btn btn-theme">Next</a>
				                    </div>
			                	</div>

			                	<div class="showHide" id="step-2">
			                		<div class="row">
			                			<div class="updateSliderImg AddprImage">											
											<span id="newImages"></span>
											<div id="dImg" class="item AddImg">
												<div class="inplabelBlock ImgAdd">
													<label class="inplabel">
														Add New
														<input accept="image/*" type="file" id="newImgMy" name="pImage" onchange="addMorePropImg();">
													</label>
												</div>
											</div>
											<label class="error" id="propImg-err"></label>
											<input type="hidden" id="imgCount" value="" >
								        </div>
				                		<!-- <div class="col-md-12 col-sm-12">
				                			<div class="section">Property Image</div>
						                    <div class="inner-wrap fileinput">
						                        <input onchange="$('#propImg-err').html('');$('#serror').html('');" accept="image/*" id="fileupload" multiple type="file" name="pImage[]" title="Please upload property image." />
						                    </div>
						                    <label class="error"><?php echo form_error('pImage'); ?></label>
						                    <label class="error" id="propImg-err"></label>
						                    <div id="dvPreview">
						                        <label class="error" id="serror"></label>
						                    </div>
				                		</div> -->

				                		<div class="col-md-12 col-sm-12">
				                			<div class="section">Property Proof</div>
						                    <div class="inner-wrap fileinput">
						                        <input onchange="$('#propProof-err').html('');" type="file" id="propProof" name="propertyProof" title="Please upload property proof."/>	
						                    </div>
						                    <label class="error"><?php echo form_error('propertyProof'); ?></label>
						                    <label class="error" id="propProof-err"></label>
				                		</div>

				                		<div class="col-md-12 col-sm-12">
				                			<div class="section">Inspection Report</div>
						                    <div class="inner-wrap fileinput">
						                        <input onchange="$('#insReport-err').html('');" type="file" id="insReport" name="inspectionReport" title="Please upload inspection report."/>	
						                    </div>
						                    <label class="error"><?php echo form_error('inspectionReport'); ?></label>
						                    <label class="error" id="insReport-err"></label>
				                		</div>

				                		<div class="col-md-12 col-sm-12">
				                			<div class="section">Floor Plan</div>
						                    <div class="inner-wrap fileinput">
						                        <input accept="image/*" type="file" id="floorPlan" name="floorPlan" title="Please upload floorPlan."/>	
						                    </div>
				                		</div>
				                		<div id="tc" class="showHide" class="col-md-12">
											<div class="cntr">
												<input name="cbx" class="hidden-xs-up" id="cbx" type="checkbox" /><label class="cbx" for="cbx"></label><label class="lbl" for="cbx"> I agree with the <a onclick="window.open('<?php echo base_url().FRONT_THEME;?>t&c/BUYER_SELLER_MUST_AGREE_THE_TERM_CONDITION.pdf')">Terms and Conditions.</a></label>
											  </div>
											  <label class="error" id="cbx-err"></label>
										</div>
			                		</div>

			                		<div class="button-section mt-4 text-center">
				                     	<a href="#" class="btn btn-theme prev-btn">Previous</a>
				                     	<button type="submit" id="disBtn" class="btn btn-theme" onclick="return imgVal();" >Add</button>
				                    </div>
			                	</div>			                	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBCKpfnLn74Hi2GBmTdmsZMJORZ5xyL1as"></script>

<script type="text/javascript">

	$(function () {
        $('#datetimepicker6').datetimepicker({minDate: '<?php echo date("Y-m-d H:i:s");?>'});
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

    function initialize() {
        var input = document.getElementById('address');
        new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

	function deletePropertyImages(id){

		var count = $('#imgCount').val();
        var imgCount = Number(count)-Number(1);   
		$('#imgCount').val(imgCount);
		$('#dImg'+id).remove();
		$('#hideImg'+id).val('');
	}


	function addMorePropImg(){

		var count = $('#imgCount').val();
        var imgCount = Number(count)+Number(1);   

		var file_data = $('#newImgMy').prop("files")[0];
        var form_data = new FormData();
        form_data.append("pImage", file_data);
        form_data.append("imgCount", imgCount);
        
        $.ajax({ 
            url: '<?php echo base_url();?>seller/uploadPropertyImage',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data) {  
            	if(data == '0'){
            		$('#propImg-err').html("Please upload valid image.");
            	}else{
	            	$('#imgCount').val(imgCount);
	            	$("#newImages").append(data); 
	            	$('#propImg-err').html("");           	
	            }
            }
        });		
	}
	
	function isNumberKey(evt) {

		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (charCode > 31 && charCode !=46 && (charCode < 48 || charCode > 57)) {			
			return false;
		}		
		return true;
	}

	$(function () {
        $("#fileupload").change(function () {
            var imgLen = document.getElementById('fileupload').files.length;
           	$('#disBtn').removeAttr("disabled");
            if(imgLen > 0 && imgLen >= 10){
            	$('#disBtn').removeAttr("disabled");
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.JPG|.JPEG|.PNG)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:100px;width: 100px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            $('#serror').html(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                	$('#disBtn').attr("disabled","disabled");
                    $('#serror').html("This browser does not support HTML5 FileReader.");
                    return false;
                }
            }else{
	            $('#disBtn').attr("disabled","disabled");
                $('#serror').html('Please select atleast 10 or greater than 10 images.');
                return false;
            }
        });
    });
	
	function imgVal() { 
		var err = 0;
		var propImg = $('#imgCount').val();      
	    var propProof = $('#propProof').val();  
	    var insReport = $('#insReport').val();  
	    var propStatus = $('#pStatus').val();

	    if(propStatus == '2'){
	    	
		    if (!($('#cbx').is(':checked'))) {
	            err=1;                
		        $('#cbx-err').html("Please accept Terms & Conditions.");
	        }else{
	        	$('#cbx-err').html("");
	        }

		    $('input[type="checkbox"]').click(function(){
	            if($(this).prop("checked") == true){
	                $('#cbx-err').html(""); 
	            }
	            else if($(this).prop("checked") == false){
	                err=1;                
		        $('#cbx-err').html("Please accept Terms & Conditions.");
	            }
	        });
		}
	    
	    if(propImg ==''){
	        err=1;                
	        $('#propImg-err').html("Please upload atleast 10 property image.");
	    }else if(propImg < 10){
	        err=1;                
	        $('#propImg-err').html("Please upload atleast 10 property image.");
	    }else{                
	        $('#propImg-err').html(""); 
	    }

	    if(propProof ==''){
	        err=1;                
	        $('#propProof-err').html("Please upload property proof.");
	    }else{                
	        $('#propProof-err').html(""); 
	    }

	    if(insReport ==''){
	        err=1;                
	        $('#insReport-err').html("Please upload inspection report.");
	    }else{                
	        $('#insReport-err').html(""); 
	    }

	    if(err){
	        return false;
	    }else{
	    	return true;
	    }
	}
	
	$('.prev-btn').click(function() { 
		$("#second").removeClass("btn-act");
    	$("#second").addClass("btn-disabled");
    	$("#first").addClass("btn-act");
    	$("#first").removeClass("btn-disabled");
		$("#step-1").show();
	    $("#step-2").hide();
	});

	$('#btnnxt').click(function() {
	    $("#step-1").removeClass("showHide");
	    var err = 0;
	    var base_url = "<?php echo base_url();?>";
	    var propStatus = $('#pStatus').val();
	    var sDate = $('#start-date').val();
	    var eDate = $('#end-date').val();      
	    var propName = $('#property-name').val();      
	    var propType = $('#property-type').val();      
	    var purchsAmt = $('#purchase-amt').val();      
	    var area = $('#area').val();      
	    var address = $('#address').val();      
	    var dec = $('#description').val(); 
	    
	    if(propStatus ==''){
	        err=1;                
	        $('#propStatus-err').html("Please select property status.");
	    }else{     
	        $('#propStatus-err').html(""); 
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
	    }    

	    if(propName ==''){
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

	    if(purchsAmt ==''){
	        err=1;                
	        $('#purchsAmt-err').html("Please enter purchase amount.");
	    }else if(purchsAmt < 1){
	        err=1;                
	        $('#purchsAmt-err').html("Please enter valid purchase amount.");
	    }else{                
	        $('#purchsAmt-err').html(""); 
	    }

	    if(area ==''){
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
	        $('#address-err').html("Please enter property address.");
	    }else{                
	        $('#address-err').html(""); 
	    }

	    if(dec ==''){
	        err=1;                
	        $('#dec-err').html("Please enter description.");
	    }else{                
	        $('#dec-err').html("");
	    }

	    if(err){
	        return false;
	    }else{
	    	$("#first").removeClass("btn-act");
	    	$("#first").addClass("btn-disabled");
	    	$("#second").addClass("btn-act");
	    	$("#second").removeClass("btn-disabled");

	    	$("#step-1").hide();
	    	$("#step-2").show();
	    }
	});

	$('#pStatus').change(function() {
        if ($(this).find(':selected').val() === '2') {

            $('div.custom_proptions').slideDown('slow');
            $("#tc").removeClass("showHide");
        } else {
        	$("#tc").addClass("showHide");
            $('div.custom_proptions').slideUp('slow');
        }
    });
    
</script>