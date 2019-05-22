<div id="dImg<?php echo $imgCount;?>" class="item">
    <img src="<?php echo base_url().'upload/propertyImage/'.$newImg; ?>">
    <div class="itemOverlay"></div>
    <div class="inplabelBlock">	    
	    <label class="inplabel remove" onclick="deletePropertyImages('<?php echo $imgCount; ?>'); ">Delete</label>
    </div>
    <input type="hidden" id="hideImg<?php echo $imgCount;?>" name="img[]" value="<?php echo $newImg; ?>">
</div>
