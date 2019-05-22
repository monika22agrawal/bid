<?php if(!empty($cartProperty)){ foreach ($cartProperty as $get) { ?>
<div class="col-lg-6 col-md-6">
    <div class="at-property-item mb-4 <?php echo ($get['propertyStatus'] == '2') ? 'OldPr' : '' ?>">
        <div class="at-property-img">
            <img src="<?php echo $get['pImage'];?>" alt="">
            <div class="at-property-overlayer"></div>
            <a class="btn btn-default at-property-btn" href="<?php echo base_url('buyer/viewProperty/').$get['propertyId'];?>" role="button">View Details</a>
            <?php if($get['isSold'] == '1'){ ?>
                <h4>Sold</h4> 
            <?php } ?>
            <h5><?php echo ucwords($get['typeName']);?></h5>
            <?php if($get['propertyStatus'] == '2'){?>
                <div class="rightCor oldCor"><span>Old</span></div>
            <?php } else{ ?>
                <div class="rightCor newCor"><span>New</span></div>
            <?php } ?>
        </div>
        <div class="at-property-dis">
            <ul>
                <li><i class="fa fa-object-group" aria-hidden="true"></i> <?php echo $get['area']. ' m<sup>2</sup>';?> </li>
                <!-- <li><i class="fa fa-bed" aria-hidden="true"></i> 6</li>
                <li><i class="fa fa-bath" aria-hidden="true"></i> 3</li> -->
            </ul>
        </div>
        <div class="at-property-location">
            <!-- <h3><a href="<?php echo base_url('buyer/viewProperty/').$get['propertyId'];?>"><?php echo ucwords($get['propertyName']);?></a></h3> -->
            <h3><?php echo ucwords($get['propertyName']);?></h3>
            <h5><?php echo $get['purchaseAmount'];?></h5>
            <p><i class="fa fa-map-marker"></i> <?php echo $get['address'];?></p>
            <?php if($get['propertyStatus'] == 1 && !empty($get['remDays'])){?>
                <span class="note warningNote">Document upload is pending</span>
                <!-- <a href="javascript:void(0);" class="btn btn-outline btn-circle"><i class="fa  fa-cloud-upload"></i></a> -->  
                <a href="javascript:void(0);" onclick="form(<?php echo $get['propertyId'];?>,<?php echo $get['sellerId'];?>);" class="btn btn-outline btn-circle" data-toggle="modal" data-target="#myModalBS" ><i class="fa  fa-cloud-upload"></i></a>

                <div>                        
                    <span class="note warningNote"> You have <?php echo $get['remDays'];?> to upload fund proof document.</span>                    
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } } else{ echo "<div class='notFound'><h3>No Property On Your Cart</h3></div>"?>           
<?php } ?>      
<div class="pagCustom">    
    <?php echo $links; ?> 
</div>

<div class="modal fade" id="myModalBS">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload Bank Statement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>        
            <!-- Modal body -->
            <div class="modal-body">
              
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url('buyer/uploadDocument/');?>">
                    <input type="hidden" name="sellerId" id="sellerId" value="">
                    <input type="hidden" name="propertyId" id="propertyId" value="">
                    
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
                            <button type="submit" id="btnnxt" class="btn btn-theme">Upload</button>                            
                        </div>
                    </div>
                </form>
            </div>          
            <!-- Modal footer -->
            <!-- <div class="modal-footer">
                <a href="<?php echo base_url('login');?>" class="btn btn-secondary">OK</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>   -->      
        </div>
    </div>
</div>
<script type="text/javascript">

    function form(pId,sId){
        $("#sellerId").val(sId);
        $("#propertyId").val(pId);
    }
    
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name; 
        $("#imageName").val(fileName);              
    });  

    $('#btnnxt').click(function(e){

        var err = 0;
        var base_url = "<?php echo base_url();?>";
        /*var propStatus = "<?php echo $propData->propertyStatus;?>";   */
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
            
        }
    });

</script>