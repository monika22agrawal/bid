<section class="LRform sec-pad gray-bg">
    <div class="container">
        <div class="RegisForm">
            <div class="form-style-10">
                <h1>Register Now<span>Fill all information to register bid home.</span></h1>
                
                <form onsubmit="return chkVal();" id="signUpForm" action="" method="post" enctype="multipart/form-data">
                    <?php if(isset($error) && !empty($error)){?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <?php if(!empty($this->session->flashdata('error'))){?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                    <br>
                	<!-- <div class="prImg">
                		<div class="log_div">
                            <img src="http://www.cubaselecttravel.com/Content/images/default_user.png" id="pImg">
                            <div class="text-center upload_pic_in_album"> 
                                <input accept="image/*" class="inputfile hideDiv" id="file-1" name="profileImage" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file" value="">
                                <label for="file-1" class="upload_pic">
                                <span class="fa fa-camera"></span></label>
                            </div>
                        </div>
                	</div> -->
                     
                    <div class="userType">
                        <div class="Ustype">
                            <span class="radio-inline">
                                <input type="radio" name="userType" value="2" checked>
                                <label><span><img class="noact" src="<?php echo base_url().FRONT_THEME;?>img/buyer.png"><img class="act" src="<?php echo base_url().FRONT_THEME;?>img/buyer_act.png"></span>
                                <p>Buyer</p></label>
                            </span>
                        </div>
                        <div class="Ustype">
                            <span class="radio-inline">
                                <input type="radio" name="userType" value="1">
                                <label><span><img class="noact" src="<?php echo base_url().FRONT_THEME;?>img/seller.png"><img class="act" src="<?php echo base_url().FRONT_THEME;?>img/seller_act.png"></span>
                                <p>Seller</p></label>
                            </span>
                        </div>
                    </div>  
                	<div class="row">
                		<div class="col-md-6 col-sm-12">
                			<div class="section">Full Name</div>
		                    <div class="inner-wrap">
		                        <input type="text" name="name" placeholder="Name" value="<?php echo ($this->input->post('name') != '') ? $this->input->post('name') : ''; ?>" required title="Please enter full name."/>
		                    </div>
                		</div>
                		<div class="col-md-6 col-sm-12">
                			<div class="section">Email</div>
		                    <div class="inner-wrap">
		                        <input type="text" name="email" placeholder="Email" value="<?php echo ($this->input->post('email') != '') ? $this->input->post('email') : ''; ?>" required title="Please enter email." />
		                    </div>
                		</div>
                		<div class="col-md-6 col-sm-12">
                			<div class="section">Password</div>
		                    <div class="inner-wrap">
		                        <input type="password" name="password" placeholder="Password" value="" required title="Please enter password." />
		                    </div>
                		</div>
                		<div class="col-md-6 col-sm-12">
                            <div class="section">Mobile Number</div>
                            <div class="inner-wrap">
                                <input type="text" name="contactNo" placeholder="Contact Number" value="<?php echo ($this->input->post('contactNo') != '') ? $this->input->post('contactNo') : ''; ?>" required title="Please enter mobile number." />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="section">Postal Code</div>
                            <div class="inner-wrap">
                                <input type="text" name="postcode" placeholder="Postal code" value="<?php echo ($this->input->post('postcode') != '') ? $this->input->post('postcode') : ''; ?>" required title="Please enter postal code." />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                			<div class="section">Uplaod license/Passport</div>
		                    <div class="inner-wrap">
		                        <input type="file" name="identityProof" value="" required title="Please upload your license/Passport."/>
		                    </div>
                		</div>
                        <div class="col-md-12" id="policy">
                            <div class="cntr">
                                <input name="ppcbx" class="hidden-xs-up" id="ppcbx" type="checkbox" required/><label class="cbx" for="ppcbx"></label><label class="lbl" for="ppcbx"> I agree with <a onclick="window.open('<?php echo base_url().FRONT_THEME;?>t&c/PRIVACY_STATEMENT_BIDHOME.pdf')"> privacy statement.</a></label>
                              </div>
                              <p class="error" id="policy-err"></p>
                        </div>
                	</div>                
                    <div class="button-section mt-4 text-center">
                        <button type="submit" name="submit"  class="btn btn-theme">Register</button>
                    </div>
                    <div class="fP">
                        <a href="JavaScript:void();" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <div class="CsLink">
                <p>Already registered? <a href="<?php echo base_url('login');?>">Login</a>.</p>
            </div>
        </div>
    </div>
    <!-- <img src="img/lg.png"> -->
    <!-- <img class="rs" src="img/city-clipart-10.png"> -->
    <!-- <img class="ls" src="img/city-clipart-10.png"> -->
</section>
<div class="modal fade myModal" id="forgotPassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Forgot Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="CSForm" id="forgotForm" method="post">

      <div class="modal-body">
        <div class="bodyCnt">
            <h2>Enter your email id to forgot your password.</h2>
            <!-- <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert" id="errorDiv1" style="display:none;">
                <center><span id="error1"></span></center>
            </div> -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter email">
            </div>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-theme">Send</button>
      </div>
      </form>

    </div>
  </div>
</div>
<script type="text/javascript">

    function chkVal(){
        var error = 0;

        if (!($('#ppcbx').is(':checked'))) {
            error=1;                
            $('#policy-err').html("Please agree our Privacy Statement.");
        }else{
            $('#policy-err').html("");
        }

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#policy-err').html(""); 
            }
            else if($(this).prop("checked") == false){
                error=1;                
            $('#policy-err').html("Please agree our Privacy Statement.");
            }
        });


        /*if (!($('#ppcbx').is(':checked'))) {
            error = 1;
            $('#policy-err').html("Please agree our Privacy Policy.");
        }*/

        if (error) {
            return false;
        } else {
            $('#policy-err').html("");
            return true;
        }
    }
   
    $("#signUpForm").validate({  
        rules:
        {
            email:{ required:true,email: true,remote:"<?php echo base_url('login/checkEmail');?>" },
            password:{ required:true,minlength: 8 },
            contactNo:{required:true,number:true,minlength: 7,maxlength:12,remote:"<?php echo base_url('login/checkCNO');?>"}
        },
        messages: {
            email: {email:"Please enter valid email.",remote:"Email is already exist."},
            password: {minlength:"Please enter atleast 8 digit or character."},
            contactNo:{number:"Numbers only in this field.",minlength:"Please enter minimum 7 digits.",maxlength:"Please enter maximum 12 digits.",remote:"Contact number is already exist."}
        }
    });

    jQuery.validator.addMethod("email", function(value, element) {
        return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
    }, 'Please enter valid email address.');


    // Submit forgot password using ajax
    $("#forgotForm").submit(function(e) {
        
        var BASE_URL = "<?php echo base_url();?>";
        var url = BASE_URL+'/login/forgotPassword'; // the script where you handle the form input.

        $.ajax({
           type: "POST",
           url: url,
           data: $("#forgotForm").serialize(), // serializes the form's elements.
           success: function(data)
           {  
                var obj= $.parseJSON(data);
                console.log(obj.status);
                if(obj.status==0){ 
                    swal("oops!", obj.error, "error");
                    
                    /*$('#errorDiv1').css('display', 'block');
                    $('#error1').html(obj.error);
                    setTimeout(function(){
                        $('.alert-danger').fadeOut('slow');
                    }, 4000);*/
                }
                if(obj.status==1){
                    $(".close").trigger('click');  
                    swal("Congratulations !", "A new password has been sent on your email.", "success");
                    //$('#msg').text("A new password has been sent on your registered email");
                }
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

</script>