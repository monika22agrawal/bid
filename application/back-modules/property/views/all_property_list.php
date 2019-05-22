<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Property Name</th>
                <th>Property Status</th>
                <th>Seller Name</th>
                <th>Buyer Name</th>
                <th>Is Sold</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $pag=$sn-1; $sn = $sn;
            if(!empty($propertyData)){
                foreach($propertyData as $get){?>
            <tr>
                <td><?php echo $sn;?></td>               
                <td><?php echo !empty($get->propertyName) ? $get->propertyName : 'NA';?></td>
                <td><?php echo ($get->propertyStatus == '1' ) ? 'New' : 'Old';?></td>
                <td><?php echo !empty($get->sName) ? $get->sName : 'NA';?></td>
                <td><?php echo !empty($get->bName) ? $get->bName : 'NA';?></td>
                <td><?php echo ($get->isSold == '1') ? 'Sold' : 'On Sale';?></td>
                <td>                    
                    <a href="<?php echo base_url()."property/propertyDetail/" . $get->id.'/'.$get->sellerId; ?>" class="label label-primary"  title="View"><i class="fa fa-info"></i></a>
                </td>
            </tr>
            <?php $sn++; } } else{ ?>
                <tr class="even pointer">
                    <td class=" " colspan="5">No Record Found</td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <div class="">   
    <?php echo $links; ?> 
</div>
</div>

<!-- /.box-body -->