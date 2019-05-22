<?php $page = $this->uri->segment(3);?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Loan's User List</h1>
            <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seller</li>
        </ol>
    </section>
   
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
                        <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="search" placeholder="Search" autocomplete="on" onkeyup="javascript: ajax_fun('<?php echo base_url(); ?>loan/allLoanListing')" class="form-control pull-right" >
                                <!-- <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div> -->
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
    ajax_fun('<?php echo base_url()."loan/allLoanListing/".$page; ?>');
    function ajax_fun(url)
    {    
        var key= $('#search').val(); 
        $.ajax({
            url: url,
            type: "POST",
            data:{page: url,key:key},              
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