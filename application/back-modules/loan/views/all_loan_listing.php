<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>                
            </tr>
        </thead>
        <tbody>
            <?php $pag=$sn-1; $sn = $sn;
            if(!empty($loan)){
                foreach($loan as $get){?>
            <tr>
                <td><?php echo $sn;?></td>                
                <td><?php echo !empty($get->fullName) ? $get->fullName : 'NA';?></td>
                <td><?php echo !empty($get->email) ? $get->email : 'NA';?></td>
                <td><?php echo !empty($get->contactNo) ? $get->contactNo : 'NA';?></td>               
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