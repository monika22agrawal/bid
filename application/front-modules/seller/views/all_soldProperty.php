<?php $page = $this->uri->segment(3); ?>
<section class="MypropertySec sec-pad gray-bg">
    <div class="container">
    	<div class="profileAccount">
            <div class="row">               
                <div class="col-lg-4 col-md-12">
                    <div class="MyInfo">                        
                        <?php include_once 'sidebar.php';?>                     
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="Myproperty">
                        <div class="row" id="soldProductList">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    ajax_fun('<?php echo base_url()."seller/allSoldPropertyList/".$page; ?>');

    function ajax_fun(url)
    {    
        $.ajax({
            url: url,
            type: "POST",
            data:{page: url},              
            cache: false,                         
            success: function(data){
                $("#soldProductList").html(data);
            }
        });        
    } 

</script>