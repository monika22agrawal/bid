<section class="paymentSec sec-pad ">
    <div class="container">
        <div class="paymentinfo">
            <div class="paymentpay">
                <h2>Pay $100 to View Valuation Report</h2>
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
                    <div class="form-wizard-steps form-wizard-tolal-steps-4"></div>
                        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('buyer/payByCcToStripe/').$this->uri->segment(3); ?>">
                            <div  id="secondDiv">
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
                                    <div class="col-md-12">
                                        <!-- <div class="cntr">
                                        <input name="cbx" class="hidden-xs-up" id="cbx" type="checkbox" /><label class="cbx" for="cbx"></label><label class="lbl" for="cbx"> I agree with the <a href="javascript:void(0);" onclick="window.open('<?php echo base_url().FRONT_THEME;?>t&c/pdf.pdf')">Terms and Conditions.</a></label>
                                        </div>
                                        <label class="error" id="cbx-err"></label> -->
                                    </div>
                                    <!-- <div class="col-md-12 col-sm-12">
                                    <label class="csCheckbox">
                                    <input type="checkBox" value="" id="tc"/> Terms & Conditions
                                    </label>
                                    <label class="error" id="tc-err"></label>
                                    </div> -->
                                </div>

                                <div class="form-wizard-buttons">
                                    <a href="<?php echo base_url('buyer/viewProperty/').$this->uri->segment(3);?>"  class="btn btn-theme">Cancel</a>
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

        /*if (!($('#cbx').is(':checked'))) {
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
        });*/

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

        if(err){
            return false;
        }else{
            return true;
        }
    }

</script>