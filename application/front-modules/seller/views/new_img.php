<div id="dImg<?php echo $lastId;?>" class="item">
    <img src="<?php echo $newImg; ?>" id="pImg<?php echo $lastId; ?>">
    <div class="itemOverlay"></div>
    <div class="inplabelBlock">
	    <label class="inplabel">Browse<input type="file" id="imgMy<?php echo $lastId;?>" name="pImage" onchange="PropertyImages('<?php echo $lastId;?>'); document.getElementById('pImg'+<?php echo $countImg;?>).src = window.URL.createObjectURL(this.files[0]);" style="display: none;"></label>
	    <label class="inplabel"  onclick="deletePropertyImages('<?php echo $lastId; ?>'); ">Delete</label>
    </div>
</div>