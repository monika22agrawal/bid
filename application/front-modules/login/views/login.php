<section class="LRform sec-pad gray-bg">
    <div class="container">
        <div class="">
            <div class="form-style-10">
                <h1>Login<span>Enter your email id and password to enter bid home.</span></h1>
                
                <form id="loginForm" method="post" action="">
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
                    <div class="userType">
                        <div class="Ustype">
                            <span class="radio-inline">
                                <input type="radio" name="userType" value="2" <?php echo set_value('userType', $this->input->post('userType')) == '2' ? "checked" : ""; ?> />
                                <label><span><img class="noact" src="<?php echo base_url().FRONT_THEME;?>img/buyer.png"><img class="act" src="<?php echo base_url().FRONT_THEME;?>img/buyer_act.png"></span>
                                <p>Buyer</p></label>
                            </span>
                        </div>
                        <div class="Ustype">
                            <span class="radio-inline">
                                <input type="radio" name="userType" value="1" <?php echo set_value('userType', $this->input->post('userType')) == '1' ? "checked" : ""; ?> />
                                <label><span><img class="noact" src="<?php echo base_url().FRONT_THEME;?>img/seller.png"><img class="act" src="<?php echo base_url().FRONT_THEME;?>img/seller_act.png"></span>
                                <p>Seller</p></label>
                            </span>
                        </div>
                    </div>
                    <div class="section">Email</div>
                    <div class="inner-wrap">
                        <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" required title="Please enter email."/>
                    </div>
                    <div class="section">Password</div>
                    <div class="inner-wrap">
                        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required title="Please enter password."/>
                    </div>
                    <div class="button-section mt-4 text-center">
                        <button type="submit" name="submit" value="submit" class="btn btn-theme">Login</button>
                    </div>
                    <div class="fP">
                        <a href="JavaScript:void();" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <div class="CsLink">
                <p>Don't have an account? <a href="<?php echo base_url('login/signUp');?>">Register Now</a>.</p>
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
        
    $("#loginForm").validate({  
        rules:
        {
            email:{ required:true,email: true },
            password:{ required:true,minlength: 8 }
        },
        messages: {
            email: {email:"Please enter valid email."},
            password: {minlength:"Please enter atleast 8 digit or character."}
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