<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Property Detail </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('property/allProperty');?>">Property List</a></li>
            <li class="active">Property Detail</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- /.box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Seller Detail</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-user margin-r-5"></i> <?php echo $sellerData->name;?></strong>             
                        <hr>
                        <strong><i class="fa fa-envelope margin-r-5"></i> <?php echo $sellerData->email;?></strong>
                        <hr>
                        <strong><i class="fa fa-mobile-phone margin-r-5"></i> <?php echo $sellerData->contactNo;?></strong>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> <?php echo $sellerData->postcode;?></strong>
                        <!--  <p class="text-muted"><?php echo $sellerData->postcode;?></p> -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- About Me Box -->
            <?php if(!empty($buyerData)){?>
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Buyer Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-user margin-r-5"></i> <?php echo $buyerData->name;?></strong>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> <?php echo $buyerData->email;?></strong>
                    <hr>
                    <strong><i class="fa fa-mobile-phone margin-r-5"></i> <?php echo $buyerData->contactNo;?></strong>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i><?php echo $buyerData->postcode;?></strong>
                </div>
                <!-- /.box-body -->
            </div>
            <?php } ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="modal fade" id="refundConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are you sure!!</h4>
                    </div>
                    <div class="modal-body">
                        You want to refund amount.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="" id="refundUrl" class="btn btn-danger btn-ok">Refund</a>
                    </div>
                </div>
            </div>
        </div>
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
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Property Detail</a></li>
              <?php if($propertyDetail['propertyStatus'] == 2){?>
                <li ><a href="#activity" data-toggle="tab">Bid Requests</a></li>
              <?php }else{ ?>
                <li ><a href="#newPropertyReq" data-toggle="tab">New Property Request</a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">Created Date:
                          <?php echo date('d M, Y',strtotime($propertyDetail['crd']));?>
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-info bg-blue"></i>

                    <div class="timeline-item">
                        
                        <h3 class="timeline-header"><a><?php echo ucwords($propertyDetail['propertyName']);?></a> Property Name</h3>

                        <div class="timeline-body">
                            <?php echo ucwords($propertyDetail['description']);?>
                        </div>
                      
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-pie-chart bg-aqua"></i>

                    <div class="timeline-item">                      

                        <h3 class="timeline-header no-border"><a><?php echo ucwords($propertyDetail['typeName']);?></a> Property Type
                            <div class="pull-right">
                                <span><i class="fa fa-bed"> </i>  <?php echo !empty($propertyDetail['bedRoom']) ? $propertyDetail['bedRoom'] : 'NA';?></span> &nbsp;

                                <span><i class="fa fa-bed"> </i>  <?php echo !empty($propertyDetail['bathRoom']) ? $propertyDetail['bathRoom'] : 'NA';?></span> &nbsp;

                                <span><i class="fa fa-car"> </i>  <?php echo !empty($propertyDetail['carParking']) ? $propertyDetail['carParking'] : 'NA';?></span>&nbsp;

                                <span ><i class="fa fa-object-group"> </i>  <?php echo !empty($propertyDetail['swimmingPool']) ? $propertyDetail['swimmingPool'] : 'NA';?></span>
                            </div>
                        </h3>

                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-map-marker bg-yellow"></i>

                    <div class="timeline-item">
                      

                      <h3 class="timeline-header"><a href="#"><?php echo ($propertyDetail['address']);?></a> Address</h3>
                      
                      <div class="timeline-body">
                        <span>Area : <?php echo $propertyDetail['area'].' m<sup>2</sup>';?></span>
                        
                      </div>
                      <div class="timeline-body">
                        
                        <span>Property Status : <?php echo ($propertyDetail['propertyStatus'] == '1') ? 'New Property' : 'Old Property';?></span>
                       
                      </div>
                      <div class="timeline-body">
                        
                        
                        <span>Is Sold : <?php echo ($propertyDetail['isSold'] == '1') ? 'Sold' : 'On Sale';?></span>
                        
                      </div>
                      <div class="timeline-body">
                        
                        <span>Purchase Amount : <?php echo '$'.($propertyDetail['purchaseAmount']);?></span>
                      </div>
                        <?php if(!empty($propertyDetail['startDateTime']) && !empty($propertyDetail['endDateTime'])){?>
                        <div class="timeline-body">                        
                            <span>Bid Start Date & Time : <?php echo date('d M, Y H:i',strtotime($propertyDetail['startDateTime']));?></span>
                        </div> 
                        <div class="timeline-body">                        
                            <span>Bid End Date & Time : <?php echo date('d M, Y H:i',strtotime($propertyDetail['endDateTime']));?></span>
                        </div>
                        <?php } ?>                      
                    </div>

                  </li>
                  <!-- END timeline item -->
                    <?php if($propertyDetail['propertyStatus'] == '2') {?>
                        <li class="time-label">
                            <span class="bg-green">
                                Upload Valuation Report
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-file-image-o bg-blue"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header no-border"><a>Upload Valuation Report :</a>
                                    <form id='formImg' method="post" action="<?php echo base_url('property/UploadDoc/'). $propertyDetail['id'].'/'.$propertyDetail['sellerId'];?>" enctype="multipart/form-data">
                                        <!-- <label>Browse</label>
                                        <div class="form-group has-feedback">
                                            <input type="file" class="form-control" name="evaluationReport" value="" required title="Please upload evaluation report" >                                            
                                        </div> -->

                                        <div class="form-group is-empty is-fileinput">
                                          <label for="exampleInputFile">Upload Report </label>
                                          <input readonly="" class="form-control" placeholder="Browse..." type="text">
                                          <input id="exampleInputFile" type="file" name="evaluationReport" value="" required title="Please upload valuation report" >
                                        </div>
                                        <div class="doc">
                                            <button type="submit" class="btn btn-theme float-right bg-aqua">Upload</button>
                                        </div>
                                    </form>
                                </h3>                             
                            </div>
                        </li>
                    <?php } ?>
                  <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-green">
                            Documents & Property Images 
                        </span>
                    </li>

                    <li>
                        <i class="fa fa-file-image-o bg-blue"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border"><a>Inspection Report</a>
                                <div class="doc">
                                    <a href="#" onclick="window.open('<?php echo base_url().'../upload/inspectionReport/'.$propertyDetail['inspectionReport']; ?>')" class="btn btn-theme float-right bg-aqua" title="View Document"><i class="fa fa-eye"></i></a>
                                </div>
                            </h3> 
                            <h3 class="timeline-header no-border"><a>Property Proof</a>
                                <div class="doc">
                                    <a href="#" onclick="window.open('<?php echo base_url().'../upload/propertyProof/'.$propertyDetail['propertyProof']; ?>')" class="btn btn-theme float-right bg-aqua" title="View Document"><i class="fa fa-eye"></i></a>
                                    <?php if($propertyDetail['propertyProofStatus'] == 1){?>
                                        
                                        <button disabled class="btn btn-theme float-right bg-green" title="Approve Document"><i class="fa fa-check"></i></button>
                                    <?php } else{ ?>
                                        <a href="<?php echo base_url()."property/activePstatus/1/" . $propertyDetail['id'].'/'.$propertyDetail['sellerId']; ?>"  class="btn btn-theme float-right bg-green" title="Approve Document"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                    <?php if($propertyDetail['propertyProofStatus'] == 2){?>
                                        <button disabled class="btn btn-theme float-right bg-red" title="Not Approve Document"><i class="fa fa-remove"></i></button>
                                    <?php } else{ ?>
                                        <a href="<?php echo base_url()."property/activePstatus/2/" . $propertyDetail['id'].'/'.$propertyDetail['sellerId']; ?>"  class="btn btn-theme float-right bg-red" title="Not Approve Document"><i class="fa fa-remove"></i></a>
                                    <?php } ?>
                                </div>
                            </h3> 
                        </div>
                    </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <!-- <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3> -->

                      <div class="timeline-body">
                        <?php if(!empty($pImages)){ foreach ($pImages as $row) { ?>
                        <img height="150" width="150" src="<?php echo base_url().'../upload/propertyImage/'.$row['pImage'];?>" alt="..." class="margin">
                        <?php } } ?>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-smile-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="activity">
                    <div id="bidData"></div>
              </div>
                <div class="tab-pane" id="newPropertyReq">
                    <?php if(!empty($newPropData)){?>
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/images-2.png" alt="user image">
                            <span class="username">
                                <a href="#"><?php echo ucwords($newPropData['name']);?></a> <small> Buyer Name</small>
                                <a href="#" class="pull-right btn-box-tool"><!-- <i class="fa fa-times"></i>--></a>
                            </span> 
                            <span class="username">                
                                <a href="#">Booking Amount : <?php echo $newPropData['bookingAmount'].'AUD';?></a>
                            </span>
                            <?php if(!empty($newPropData['bankStatement'])){?>
                            <span class="username">
                                <a href="#">Bank Statement : 
                                <a href="#" onclick="window.open('<?php echo base_url().'../upload/bankStatement/'.$newPropData['bankStatement']; ?>')" class="btn btn-theme float-right bg-aqua" title="View Document"><i class="fa fa-eye"></i></a>
                                </a>
                            </span>
                            <span class="username">

                                <?php if($newPropData['isApproved'] == 1){?>
                                    <button disabled class="btn btn-theme float-check bg-green" title="Approved"><i class="fa fa-check"></i></button>

                                <?php } else{ ?>

                                    <a href="<?php echo base_url()."property/approveNewPropRequest/1/" .$newPropData['id'].'/'.$newPropData['pId'].'/'.$newPropData['sellerId'].'/'.$newPropData['buyerId']; ?>"  class="btn btn-theme float-right bg-green" title="Approve"><i class="fa fa-check"></i></a>

                                <?php } ?>

                                <?php if($newPropData['isApproved'] == 2){?>

                                    <button disabled class="btn btn-theme float-right bg-red" title="Not Approved"><i class="fa fa-remove"></i></button>

                                <?php } else{ ?>

                                    <a href="<?php echo base_url()."property/approveNewPropRequest/2/" .$newPropData['id'].'/'.$newPropData['pId'].'/'.$newPropData['sellerId'].'/'.$newPropData['buyerId']; ?>"  class="btn btn-theme float-right bg-red" title="Not Approve"><i class="fa fa-remove"></i></a>

                                <?php } ?>    

                            </span>

                            <?php }else{ ?>

                                <span class="username">
                                    <a href="#">Bank Statement : 
                                        <a class="btn btn-theme float-right bg-aqua">Not Uploaded</a>
                                    </a>
                                </span>

                            <?php } ?>

                            <span class="description">Property Request Date : <?php echo date('d M, Y H:i:s',strtotime($newPropData['crd']));?></span>

                        </div>
                    </div>

                    <?php }else{
                        echo 'No Request for this property.';
                    }  ?>
                </div>
                <!-- /.tab-pane -->
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $("#formImg").validate();


    ajax_fun('<?php echo base_url()."property/allPropertyBidderList/"; ?>');
    function ajax_fun(url)
    {    
        var pId= '<?php echo $propertyDetail["id"]; ?>'; 
        $.ajax({
            url: url,
            type: "POST",
            data:{page: url,pId:pId},              
            cache: false,                         
            success: function(data){
                $("#bidData").html(data);
            }
        });        
    }

    $(document).ready(function(){      
        window.setTimeout(function() {
            $(".success").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    });
</script>