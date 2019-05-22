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
					<?php if(!empty($this->session->flashdata('success'))){?>
	                    <div class="alert alert-success">
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
	                        <?php echo $this->session->flashdata('success'); ?>
	                    </div>
	                <?php } ?>
	                <div id="show_error"></div>
					<div class="EditInfo CSForm">
						<div class="EditInfohead">
							<ul class="nav nav-tabs" role="tablist">
							  	<li class="nav-item">
							    	<a class="nav-link active" data-toggle="tab" href="#Info" role="tab">My Info</a>
							  	</li>
							  	<li class="nav-item">
							    	<a class="nav-link" data-toggle="tab" href="#chpassword" role="tab">Change Password</a>
							  	</li>
							</ul>
						</div>
						<div class="form-style-10">
						
						<!-- Tab panes -->
						<div class="tab-content">
						  <div class="tab-pane active" id="Info" role="tabpanel">
						  	<!-- <div class="imgBanner">
						  		<img src="img/slide-2.jpg">
						  	</div> -->
						  	<form id="updateProfile" action="<?php echo base_url();?>buyer/editProfile" method="POST"  enctype="multipart/form-data">
								<!-- <div class="prImg">
			                		<div class="log_div">
			                          	<img src="<?php echo $buyer->profileImage; ?>" id="pImg">
			                          	<div class="text-center upload_pic_in_album"> 
			                              	<input accept="image/*" class="inputfile hideDiv" id="file-1" name="profileImage" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file" value="">
			                              	<label for="file-1" class="upload_pic">
			                              	<span class="fa fa-camera"></span></label>
			                          	</div>
			                        </div>
			                	</div> -->
			                	<div class="row">
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">Full Name</div>
					                    <div class="inner-wrap">
					                        <input type="text" name="name" value="<?php echo isset($buyer->name) ? $buyer->name : ''; ?>" required title="Please enter full name" />
					                    </div>
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">Mobile Number</div>
					                    <div class="inner-wrap">
					                        <input type="text" name="contactNo" value="<?php echo isset($buyer->contactNo) ? $buyer->contactNo : ''; ?>"  required title="Please enter mobile number" />
					                    </div>
			                		</div>
			                	</div> 
			                	<div class="button-section mt-4 text-center">
			                     <button type="submit" class="btn btn-theme">Update</button>
			                    </div>
							</form>
						  </div>
						  <div class="tab-pane" id="chpassword" role="tabpanel">
						  	<form method="post" id="chngPassword" action="javascript:void(0);">
			                	<div class="row">
			                		<div class="col-md-12 col-sm-12">
			                			<div class="section">Old Password</div>
					                    <div class="inner-wrap">
					                        <input type="password" name="oldpassword" id="oldpassword" value="" required title="Please enter old password"/>
					                    </div>
					                    <label class="error" id="opwd-err"></label>
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">New Password</div>
					                    <div class="inner-wrap">
					                        <input type="password" name="newpassword" id="newpassword" value="" required title="Please enter new password"/>
					                    </div>
					                    <label class="error" id="npwd-err"></label>
			                		</div>
			                		<div class="col-md-6 col-sm-12">
			                			<div class="section">Confirm New password</div>
					                    <div class="inner-wrap">
					                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-controller" value="" required />
					                    </div>
					                    <label class="error" id="conP-err"></label>
			                		</div>
			                	</div> 
			                	<div class="button-section mt-4 text-center">
			                      	<button type="submit" class="btn btn-theme chngPwd">Update</button>
			                    </div>
							</form>
						  </div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

    $("#updateProfile").validate({
        rules:
        {
            contactNo:{required:true,number:true,minlength: 7,maxlength:12,remote:"<?php echo base_url('buyer/checkCNO');?>"}
        },
        messages: {
            contactNo:{number:"Numbers only in this field.",minlength:"Please enter minimum 7 digits.",maxlength:"Please enter maximum 12 digits.",remote:"Contact number is already exist."}
        }
    });

    $('.chngPwd').click(function(){

    	var flag = 0;
        var base_url = "<?php echo base_url();?>";
        var oldP = $('#oldpassword').val();
        var newP = $('#newpassword').val();      
        var conP = $('#confirmpassword').val();      
          
        if(oldP == ''){
            flag=1;                
            $('#opwd-err').html("Please enter old password");
        }else{                
            $('#opwd-err').html(""); 
        }
        if(newP ==''){
            flag=1;                
            $('#npwd-err').html("Please enter new password");
        }else if(newP.length<8){
            flag=1;
            $('#npwd-err').html("Please enter atleast 8 characters");
        }else{                
            $('#npwd-err').html(""); 
        }

        if(conP==''){
            flag=1;
            $('#conP-err').html("Please enter confirm password");

        }else if(conP.length<8){
            flag=1;
            $('#conP-err').html("Please enter atleast 8 characters");
        }else if(newP != conP){
            flag=1;
            $('#conP-err').html("The confirm password is not matched from new password");
        } else{
            $('#conP-err').html(""); 
        }

        if(flag){
            return false;
        }else{
	        
	        $.ajax({ 
	            url: '<?php echo base_url();?>buyer/changePassword',
	            data: {oldP:oldP,newP:newP},
	            type: 'post',
	            success: function(data) {
	            	
	                var res = jQuery.parseJSON( data );
	                if(res.status){
	                   var messages = '<div class="alert alert-success">Password updated successfully.</div>';
	                    $("#show_error").html(messages);
	                    setTimeout(function(){
	                        $('.alert-success').fadeOut('fast');
	                    }, 4000);
	                    $('#oldpassword,#newpassword,#confirmpassword ').val('');				       
	                }else if(res.status == false){                    
	                    var messages = '<div class="alert alert-danger"><strong>Warning!</strong> Please enter correct old password</div>';
	                    $("#show_error").html(messages);
	                    setTimeout(function(){
	                        $('.alert-danger').fadeOut('fast');
	                    }, 4000);
	                }
	            }
	        });
	    }
    });
</script>