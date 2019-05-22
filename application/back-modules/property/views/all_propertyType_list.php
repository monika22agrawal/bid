<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Property Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $pag=$sn-1; $sn = $sn;
            if(!empty($pType)){
                foreach($pType as $get){?>
            <tr>
                <td><?php echo $sn;?></td>               
                <td><?php echo !empty($get->typeName) ? $get->typeName : 'NA';?></td>
                <td><?php echo $get->status ==1 ? '<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'; ?></td>
                <td>
                    <?php if($get->status == 1) : ?>
                    <a href="<?php echo base_url()."property/activePtype/" . $get->id; ?>"  class="label label-danger" title="Inactive"><i class="fa fa-close"></i></a>
                    <?php else : ?>
                    <a href="<?php echo base_url()."property/activePtype/" . $get->id; ?>" class="label label-primary"  title="Active"><i class="fa fa-check"></i></a>
                    <?php endif; ?>
                    <a href="<?php echo base_url()."property/updatePropertyType/" . $get->id; ?>" class="label label-primary"  title="Update"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
            <?php $sn++; } } else{ ?>
                <tr class="even pointer">
                    <td class=" " colspan="5">No Record Found</td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<div class="">   
    <?php echo $links; ?> 
</div>
<!-- /.box-body -->