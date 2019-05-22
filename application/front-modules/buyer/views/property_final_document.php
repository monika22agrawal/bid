<section class="paymentSec sec-pad ">
	<div class="container">
		<div class="paymentinfo">
			<div class="paymentpay">
				<h2>Upload Property Document</h2>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
			</div>
			<div class="paymentOption">
				<div class="form-style-10 AddPr">
					<div class="form-wizard form-header-classic form-body-classic">
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
                      	<form id="myform" method="post" action="<?php echo base_url('buyer/uploadPropertyFinalDocuments/').$this->uri->segment(3);?>" enctype="multipart/form-data">
                      		<input type="hidden" name="sellerId" value="<?php echo $propData->sellerId; ?>">
							<input type="hidden" name="propertyStatus" value="<?php echo $propData->propertyStatus; ?>">
							<div>
		                		<div class="row">
			                		<div class="col-md-12 col-sm-12">
			                			<div class="section">Upload your proof of fund</div>
					                    <div class="inner-wrap fileinput">
					                        <input onchange="return btnUpload(this);" id="fileUpload" type="file" name="proofOfFund" value="" required title="Please upload proof of fund."/>
					                    </div>
					                     <label id="lblError" style="color: red;"></label>
			                		</div>
			                		<div class="col-md-12 col-sm-12">
			                			<div class="section">Upload your EOI (Express of interest)</div>
					                    <div class="inner-wrap fileinput">
					                        <input onchange="return btnUpload(this);" id="EOI" type="file" name="EOI" value="" required title="Please upload EOI (Express of interest)."/>
					                    </div>
					                    <label id="lblErrorEOI" style="color: red;"></label>
			                		</div>
		                		</div>
		                		<div class="form-wizard-buttons">
                                	<button type="submit"  class="btn btn-theme">Upload</button>
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

$( "#myform" ).validate();

function btnUpload(ref) {

    var allowedFiles = [".doc", ".docx", ".pdf",".jpeg",".jpg",".png",".txt",".xsl",'.text'];

    var fileUpload = $(ref);

    var EOI = $("#EOI");

    var lblError = $("#lblError");

    var lblErrorEOI = $("#lblErrorEOI");

    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

    if (!regex.test(fileUpload.val().toLowerCase())) {

		fileUpload.parent().next('label').html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
        //lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
        return false;
    }

    lblError.html('');
    lblErrorEOI.html('');

    return true;
}

</script>