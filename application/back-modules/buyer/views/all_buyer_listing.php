<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <!-- <th>Profile Image</th> -->
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Postal Code</th>
                <th>Identity Proof</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $pag=$sn-1; $sn = $sn;
            if(!empty($buyer)){
                foreach($buyer as $get){?>
            <tr>
                <td><?php echo $sn;?></td>
                <?php if(!empty($get->profile_img)){ 
                    $url = base_url()."../upload/profile/buyer/thumb/".$get->profileImage;
                }else{ 
                    $url = base_url().ADMIN_THEME.'asset/dist/img/default-user.png';
                } ?>
                <!-- <td>
                    <img style="height:50px;width:50px;" alt="..." src="<?php echo $url;?>"/>
                </td> -->
                <td><?php echo !empty($get->name) ? $get->name : 'NA';?></td>
                <td><?php echo !empty($get->email) ? $get->email : 'NA';?></td>
                <td><?php echo !empty($get->contactNo) ? $get->contactNo : 'NA';?></td>
                <td><?php echo !empty($get->postcode) ? $get->postcode : 'NA';?></td>
                <td>
                    <?php if(!empty($get->identityProof)){?>
                    <a href="javascript:void(0);" onclick="window.open('<?php echo base_url().'../upload/identityProof/'.$get->identityProof; ?>')" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-file"></i></a>
                    <?php } else { echo 'NA';}?>
                </td>
                <td><?php echo $get->status ==1 ? '<span class="label label-success">Approved</span>':'<span class="label label-danger">Disapproved</span>'; ?></td>
                <td>
                    <?php if($get->status == 1) : ?>
                    <a href="<?php echo base_url()."buyer/activeBuyer/" . $get->id; ?>"  class="label label-danger" title="Disapproved"><i class="fa fa-close"></i></a>
                    <?php else : ?>
                    <a href="<?php echo base_url()."buyer/activeBuyer/" . $get->id; ?>" class="label label-primary"  title="Approved"><i class="fa fa-check"></i></a>
                    <?php endif; ?>
                </td>
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