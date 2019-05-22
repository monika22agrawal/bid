<section class="paymentSec sec-pad ">
	<div class="container">
		<div class="paymentinfo">
			<div class="paymentpay">
				<h2>Pay $2000 to book property</h2>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
			</div>
			<div class="paymentOption">
				<div class="form-style-10 AddPr">
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
					<div class="form-wizard form-header-classic form-body-classic">
						<div class="form-wizard-steps form-wizard-tolal-steps-4">
							<div id="first" class="form-wizard-step active">
								<div class="form-wizard-step-icon">1</div>
								<p>Upload Document</p>
							</div>
							<div id="second" class="form-wizard-step ">
								<div class="form-wizard-step-icon">2</div>
								<p>Payment </p>
							</div>
						</div>
						<form method="post" enctype="multipart/form-data" action="<?php echo base_url('buyer/addPropertyPayment/').$this->uri->segment(3);?>">
							<input type="hidden" name="sellerId" value="<?php echo $propData->sellerId; ?>">
							<input type="hidden" name="propertyStatus" value="<?php echo $propData->propertyStatus; ?>">
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
	                                <a href="javascript:void(0);" id="btnnxt" class="btn btn-theme">Upload</a>
	                                <?php if($propData->propertyStatus == '1'){?>
	                                	<button type="button" class="btn btn-theme btn-next">Skip</button>
	                                <?php } ?>
	                            </div>
		                	</div>
					  	
					  		<div class="showHide" id="secondDiv">
					  			<h2>Enter credit card info for payment</h2>
			                	<div class="row">
			                		<div class="col-md-6 col-sm-12">
			                			<div class="form-group">
					    					<div class="section">Card Holder Name</div>
					    					<div class="inner-wrap">
						                        <input name="name" oninput="$('#cardName-err').html('');" type="text" value="" id="cardName" />
						                        <label class="error" id="cardName-err"></label>
						                    </div>						                    
				    					</div>
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">Card Number</div>
					                    <div class="inner-wrap">
					                        <input name="cardNumber" onkeypress="return isNumberKey(event);" oninput="$('#cardNumber-err').html('');" type="text" value="" id="cardNumber" />
					                        <label class="error" id="cardNumber-err"></label>
					                    </div>					                    
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">Expiration Date</div>
			                			<div class="row">
			                				<div class="col-md-6 col-sm-6">
			                					<?php $months = array('January','February','March','April','May','June','July','August','September','October','November','December');?>
			                					<div class="inner-wrap">
							                        <select onchange="$('#expMonth-err').html('');" class="selectcs" id="expMonth" name="expMonth">
							    						<option value="">Month</option>
							    						<?php foreach($months as $months):?>
					                                    	<option value="<?php echo $months; ?>" <?php if(isset($_POST['expMonth']) && $this->input->post('expMonth') == $months){ echo "selected='selected'";}?> ><?php echo $months; ?></option>
					                                    <?php endforeach;?>
						    						</select>
						    						<label class="error" id="expMonth-err"></label>
							                    </div>
			                				</div>
			                				<div class="col-md-6 col-sm-6">
			                					<?php $year = array('2018','2019','2020','2021','2022','2023');?>
			                					<div class="inner-wrap">
							                        <select name="expYear" onchange="$('#expYear-err').html('');" class="selectcs" id="expYear">
							    						<option value="">Year</option>
							    						<?php foreach($year as $year):?>
					                                    	<option value="<?php echo $year; ?>" <?php if(isset($_POST['expYear']) && $this->input->post('expYear') == $year){ echo "selected='selected'";}?> ><?php echo $year; ?></option>
					                                    <?php endforeach;?>
						    						</select>
						    						<label class="error" id="expYear-err"></label>
							                    </div>
			                				</div>
			                			</div>						                    
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">CVV</div>
					                    <div class="inner-wrap">
					                        <input name="cvv" onkeypress="return isNumberKey(event);" oninput="$('#cvv-err').html('');" type="password" value="" id="cvv" />
					                        <label class="error" id="cvv-err"></label>
					                    </div>
			                		</div>
			                		<?php if( $propData->propertyStatus == '2'){ ?>
			                		<div class="col-md-12">
										<div class="cntr">
											<input name="cbx" class="hidden-xs-up" id="cbx" type="checkbox" /><label class="cbx" for="cbx"></label><label class="lbl" for="cbx"> I agree with the <a onclick="window.open('<?php echo base_url().FRONT_THEME;?>t&c/BUYER_SELLER_MUST_AGREE_THE_TERM_CONDITION.pdf')">Terms and Conditions.</a></label>
										  </div>
										  <label class="error" id="cbx-err"></label>
									</div>
									<div class="col-md-12">
										<div class="cntr">
											<input name="wcbx" class="hidden-xs-up" id="wcbx" type="checkbox" /><label class="cbx" for="wcbx"></label><label class="lbl" for="wcbx"> I agree with <a onclick="window.open('<?php echo base_url().FRONT_THEME;?>t&c/WARNING_ABOUT_BIDDERS_OBLIGATIONS.pdf')"> Warning about bidders obligations.</a></label>
										  </div>
										  <label class="error" id="wcbx-err"></label>
									</div>
									<?php } ?>
			                		<!-- <div class="col-md-12 col-sm-12">
		                				<label class="csCheckbox">
				                        	<input type="checkBox" value="" id="tc"/> Terms & Conditions
				                        </label>
				                        <label class="error" id="tc-err"></label>
			                		</div> -->
			                	</div>
		                		
		                	<div class="form-wizard-buttons">
                  	 			<button type="button" class="btn btn-theme btn-previous">Previous</button>
                                <button type="submit" onclick="return formVal();" class="btn btn-theme">Pay</button>
                            </div>
                            </div>
				        </form>		               				                								
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
		
	$('.btn-next').click(function() { 
    	$("#second").addClass("active");
    	$("#first").removeClass("active");		
		$("#firstDiv").hide();
	    $("#secondDiv").show();
	});

	$('.btn-previous').click(function() { 
		$("#first").addClass("active");
    	$("#second").removeClass("active");			
		$("#firstDiv").show();
	    $("#secondDiv").hide();
	});

	function isNumberKey(e) {
     	//if the letter is not digit then display error and don't type anything
     	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        //display error message
	        $("#cardNumber").html("Please enter only digits.").show();
	        return false;
	    }
	    return true;
    }

	function formVal() { 

		var err = 0;
		var cardName = $('#cardName').val();      
	    var cardNumber = $('#cardNumber').val();  
	    var expMonth = $('#expMonth').val();  
	    var expYear = $('#expYear').val();  
	    var cvv = $('#cvv').val(); 

	    if (!($('#cbx').is(':checked'))) {
            err=1;                
	        $('#cbx-err').html("Please accept Terms & Conditions.");
        }else{
        	$('#cbx-err').html("");
        }

	    $('input[name="cbx"]').click(function(){
            if($(this).prop("checked") == true){
                 $('#cbx-err').html(""); 
            }
            else if($(this).prop("checked") == false){
                err=1;                
	        $('#cbx-err').html("Please accept Terms & Conditions.");
            }
        });

        if (!($('#wcbx').is(':checked'))) {
            err=1;                
	        $('#wcbx-err').html("Please check this conditions.");
        }else{
        	$('#wcbx-err').html("");
        }

	    $('input[name="wcbx"]').click(function(){
            if($(this).prop("checked") == true){
                 $('#wcbx-err').html(""); 
            }
            else if($(this).prop("checked") == false){
                err=1;                
	        $('#wcbx-err').html("Please check this conditions.");
            }
        });

	    if(cardName ==''){
	        err=1;                
	        $('#cardName-err').html("Please enter card holder name.");
	    }else{                
	        $('#cardName-err').html(""); 
	    }
	    if(cardNumber ==''){
	        err=1;                
	        $('#cardNumber-err').html("Please enter card number.");
	    }else if(cardNumber.length < 13 || cardNumber.length > 19){
	        err=1;                
	        $('#cardNumber-err').html("Please enter minimum 13 or maximum 19 number.");
	    }else{                
	        $('#cardNumber-err').html(""); 
	    }

	    if(expMonth ==''){
	        err=1;                
	        $('#expMonth-err').html("Please select expiration month.");
	    }else{                
	        $('#expMonth-err').html(""); 
	    }

	    if(expYear ==''){
	        err=1;                
	        $('#expYear-err').html("Please select expiration year.");
	    }else{                
	        $('#expYear-err').html(""); 
	    }

	    if(cvv ==''){
	        err=1;                
	        $('#cvv-err').html("Please enter cvv.");
	    }else if(cvv.length < 3 || cvv.length > 4){
	        err=1;                
	        $('#cvv-err').html("Please enter minimum 3 or maximum 4 cvv number.");
	    }else{                
	        $('#cvv-err').html(""); 
	    }

	    /*if(cbx ==''){
	        err=1;                
	        $('#cbx-err').html("Please accept Terms & Conditions.");
	    }else{                
	        $('#cbx-err').html(""); 
	    }*/

	    if(err){
	        return false;
	    }else{
	    	return true;
	    }
	}

	$('input[type="file"]').change(function(e){
    	var fileName = e.target.files[0].name; 
		$("#imageName").val(fileName);	        	
    });  

	$('#btnnxt').click(function(e){

	    var err = 0;
	    var base_url = "<?php echo base_url();?>";
	    var propStatus = "<?php echo $propData->propertyStatus;?>";   
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
	    	$("#second").addClass("active");
    		$("#first").removeClass("active");	
	    	$("#firstDiv").hide();
	    	$("#secondDiv").show();
	    }
	});

</script>