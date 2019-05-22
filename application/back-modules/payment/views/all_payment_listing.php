<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <!-- <th>Profile Image</th> -->
                <th>Property Name</th>
                <th>Buyer Name</th>
                <th>Transaction Id</th>
                <th>Refund Id</th>
                <th>Payment Amount</th>
                <th>Payment Status</th>
                <th>Payment Type</th>
            </tr>
        </thead>
        <tbody>
            <?php $pag=$sn-1; $sn = $sn;
            if(!empty($payment)){
                foreach($payment as $get){?>
            <tr>
                <td><?php echo $sn;?></td>
                
                <td><?php echo !empty($get->propertyName) ? $get->propertyName : 'NA';?></td>
                <td><?php echo !empty($get->name) ? $get->name : 'NA';?></td>
                <td><?php echo !empty($get->transactionId) ? $get->transactionId : 'NA';?></td>
                <td><?php echo !empty($get->refundId) ? $get->refundId : 'NA';?></td>
                <td><?php echo !empty($get->totalAmount) ? '$'.$get->totalAmount : 'NA';?></td>
                <td><?php echo !empty($get->paymentStatus) ? $get->paymentStatus : 'NA';?></td>
                <td><?php echo !empty($get->paymentType == 1) ? 'Valuation Report' : 'Bid Amount';?></td>
                
            </tr>
            <?php $sn++; } } else{ ?>
                <tr class="even pointer">
                    <td class=" " colspan="7">No Record Found</td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<div class="">   
    <?php echo $links; ?> 
</div>
<!-- /.box-body -->