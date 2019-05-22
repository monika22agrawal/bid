<?php $page = $this->uri->segment(3);?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Property List</h1>
            <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Property List</li>
        </ol>
    </section>
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Are you sure!!</h4>
                </div>
                <div class="modal-body">
                    You want to delete this property?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="" id="deleteUrl" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">      
        <div class="row">
            <div class="col-xs-12">
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
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="prop-status">
                                        <option value="">Select Property Status</option>
                                        <option value="1">New</option>
                                        <option value="2">Old</option>
                                    </select>   
                                </div> 
                            </div> 
                            <div class="col-md-10">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="search" placeholder="Search by property name / seller / buyer name" autocomplete="on" onkeyup="javascript: ajax_fun('<?php echo base_url(); ?>property/allPropertyList/')" class="form-control" >
                                    <!-- <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div> -->
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div id="ajaxdata" > </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">

    ajax_fun('<?php echo base_url()."property/allPropertyList/".$page; ?>');

    $("#prop-status").change(function () {
       ajax_fun('<?php echo base_url(); ?>property/allPropertyList/');
    });

    function ajax_fun(url)
    {    
        var status =$("#prop-status").val();
        var key= $('#search').val();
        $.ajax({
            url: url,
            type: "POST",
            data:{page: url,key:key,status:status},              
            cache: false,                         
            success: function(data){
                $("#ajaxdata").html(data);
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