<!-- Post -->
<?php $pag=$sn-1; $sn = $sn; 
    if(!empty($propertyBidData)){
        foreach($propertyBidData as $get){ ;?>
<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/images-2.png" alt="user image">
            <span class="username">
                <a href="#"><?php echo ucwords($get['name']);?></a> <small> Buyer Name</small>
                <a href="#" class="pull-right btn-box-tool"><!-- <i class="fa fa-times"></i> --></a>
            </span>
            <span class="username">                
                <a href="#">Booking Amount : <?php echo $get['bookingAmount'].'AUD';?></a>
            </span>
            <span class="username">                
                <a href="#">Bid Amount : <?php echo !empty($get['bidAmount']) ? '$'.$get['bidAmount']:'0';?></a>
            </span>
            <span class="username">
                <a href="#">Bank Statement : 
                    <a href="#" onclick="window.open('<?php echo base_url().'../upload/bankStatement/'.$get['bankStatement']; ?>')" class="btn btn-theme float-right bg-aqua" title="View Document"><i class="fa fa-eye"></i></a>
                </a>
            </span>
            <?php if(date('Y-m-d H:i') < $get['endDateTime']){ ?>
            <span class="username">
                
                    <?php if($get['isApproved'] == 1){?>
                        <button disabled class="btn btn-theme float-check bg-green" title="Approved"><i class="fa fa-check"></i></button>
                    <?php } else{ ?>
                        <a href="<?php echo base_url()."property/approveBidRequest/1/" .$get['id'].'/'.$get['pId'].'/'.$get['sellerId'].'/'.$get['buyerId']; ?>"  class="btn btn-theme float-right bg-green" title="Approve"><i class="fa fa-check"></i></a>
                    <?php } ?>
                    <?php if($get['isApproved'] == 2){?>
                        <button disabled class="btn btn-theme float-right bg-red" title="Not Approved"><i class="fa fa-remove"></i></button>
                    <?php } else{ ?>
                        <a href="<?php echo base_url()."property/approveBidRequest/2/" .$get['id'].'/'.$get['pId'].'/'.$get['sellerId'].'/'.$get['buyerId']; ?>"  class="btn btn-theme float-right bg-red" title="Not Approve"><i class="fa fa-remove"></i></a>
                    <?php } ?>                
            </span>
            <?php } ?>
            <span class="description">Property Request Date : <?php echo date('d M, Y H:i:s',strtotime($get['crd']));?></span>
            <?php if(empty($get['refundId'])){ if(!empty($get['bId']) && $get['bId'] != $get['buyerId']){ ?>
             <span class="username">
               <!-- <button type="button" class="btn btn-theme float-right bg-aquame" data-toggle="modal" data-target="#myModal">Refund</button> -->
                <a data-href="<?php echo base_url()."property/refundAmount/" .$get['chargeId'].'/'.$get['pId'].'/'.$get['sellerId'].'/'.$get['buyerId']; ?>" class="btn btn-theme float-right bg-aquame refund" data-toggle="tooltip" title="Refund">Refund</a>
                
            </span>
            <?php } }else{?>
                <button type="button" class="btn btn-theme float-right bg-green">Refunded</button>
            <?php } ?>
    </div>
    
   <!--  <ul class="list-inline">
        <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
        <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
        </li>
        <li class="pull-right">
        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
        (5)</a></li>
    </ul> -->
</div>
<!-- /.post -->
<?php } }else{ echo "No Request.";}?>
<div class="">   
    <?php echo $links; ?> 
</div>
<script>
    $(".refund" ).click(function() {
        $('#refundConfirm').modal('show');
        $("#refundUrl").attr('href',$(this).data('href'));
    });
</script>
