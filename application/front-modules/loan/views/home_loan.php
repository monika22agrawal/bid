<section class="BusinessForm sec-pad">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
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
                <div class="form-style-10">
                    <h1>Home Loan<span>Fill all the information later our team will contact you.</span></h1>
                    <form id="form" method="post" action="">
                        <div class="section"><span>1</span>Full Name</div>
                        <div class="inner-wrap">
                            <input type="text" name="fullName" value="<?php echo set_value('fullName'); ?>" placeholder="Enter full name" required title="Please enter full name."/>
                            <label class="error"><?php echo form_error('fullName'); ?></label>
                        </div>
                        <div class="section"><span>2</span>Email Id</div>
                        <div class="inner-wrap">
                            <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter email" required title="Please enter email."/>
                            <label class="error"><?php echo form_error('email'); ?></label>
                        </div>
                        <div class="section"><span>3</span>Contact Number</div>
                        <div class="inner-wrap">
                            <input type="text" name="contactNo" value="<?php echo set_value('contactNo'); ?>" placeholder="Enter contact number" required title="Please enter contact number."/>
                            <label class="error"><?php echo form_error('contactNo'); ?></label>
                        </div>
                        <div class="section"><span>4</span>Postcode</div>
                        <div class="inner-wrap">
                            <input type="text" name="postCode" value="<?php echo set_value('postCode'); ?>" placeholder="Enter postcode" required title="Please enter postcode."/>
                            <label class="error"><?php echo form_error('postCode'); ?></label>
                        </div>
                        <!-- <div class="section"><span>4</span>Category</div>
                        <div class="inner-wrap">
                            <select><option>Select Category</option><option>Photographer</option><option>Inspector</option></select>
                        </div> -->
                        <div class="button-section mt-4 text-center">
                         <button type="submit" class="btn btn-theme">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="BusinessCnt">
                <div class="at-about-title">
                    <h1>Contact Us For <span>Home Loan</span></h1>
                </div>
                <p>Our mortgage brokers are professionals who sort through hundreds of loans in the market so borrowers don't have to. A mortgage broker's service is usually free because they earn a commission from the lender. A good mortgage broker can make life easier and they can help borrowers in difficult circumstances to find a home loan that matches their situation.</p>
                <img src="<?php echo base_url().FRONT_THEME;?>img/businessman-pointing.png">
            </div>
            </div>
    </div>
</section>
<script type="text/javascript">

    $("#form").validate({
        rules:
        {
            email:{ required:true,email: true,remote:"<?php echo base_url('loan/checkEmail');?>" },
            contactNo:{required:true,number:true,minlength: 7,maxlength:12,remote:"<?php echo base_url('loan/checkCNO');?>"}
        },
        messages: {
            email: {email:"Please enter valid email.",remote:"Email is already exist."},
            contactNo:{number:"Numbers only in this field.",minlength:"Please enter minimum 7 digits.",maxlength:"Please enter maximum 12 digits.",remote:"Contact number is already exist."}
        }
    });


    jQuery.validator.addMethod("email", function(value, element) {
        return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
    }, 'Please enter valid email address.');

</script>