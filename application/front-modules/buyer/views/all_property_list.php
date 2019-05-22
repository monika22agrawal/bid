<?php if(!empty($propertyList)){ foreach ($propertyList as $get) { ?>
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
            <h3><a href="<?php echo base_url('buyer/viewProperty/').$get['propertyId'];?>"><?php echo ucwords($get['propertyName']);?></a></h3>
            <h5><?php echo $get['purchaseAmount'];?></h5>
            <p><i class="fa fa-map-marker"></i> <?php echo $get['address'];?></p>
        </div>
    </div>
</div>
<?php } } else{ echo "<div class='notFound'><h3>No Record found</h3></div>"?>           
<?php } ?>      
<div class="pagCustom">   
    <?php echo $links; ?> 
</div>

