<?php

class Image_model extends CI_Model {
	function upload_img($profile_image,$folder)
	{ 
		$this->makedirs($folder);

		if($profile_image == 'propertyProof' || $profile_image == 'identityProof' || $profile_image == 'inspectionReport' || $profile_image == 'bankStatement'){
			$allowed_types = "gif|jpg|png|jpeg|JPG|PNG|JPEG|doc|docx|xls|ppt|pdf|txt"; 
		} else{
			$allowed_types = "*";
		}

		$config = array(
			'upload_path' => FCPATH.'upload/'.$folder,
			'allowed_types' => $allowed_types,
			'overwrite' => false,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'encrypt_name'=>TRUE ,
			'remove_spaces'=>TRUE
		);

	  	$this->load->library('upload');
	  	$this->upload->initialize($config);

	  	if(!$this->upload->do_upload($profile_image)){
   			$error = array('error' => $this->upload->display_errors());
			return $error;

		} else {

			$this->load->library('image_lib');
			$folder_thumb = $folder.'/thumb/';
			$this->makedirs($folder_thumb);

			$width = 100;
			$height = 100;

			$image_data = $this->upload->data(); //upload the image

			$resize['source_image'] = $image_data['full_path'];
			$resize['new_image'] = realpath(APPPATH . '../upload/' . $folder_thumb);
			$resize['maintain_ratio'] = true;
			$resize['width'] = $width;
			$resize['height'] = $height;

			//send resize array to image_lib's  initialize function
			$this->image_lib->initialize($resize);
			$this->image_lib->resize();
			$this->image_lib->clear();

			return $image_data['file_name'];
		}
	}

	//Creates directory 
	
	function makedirs($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='upload'){

		if(!@is_dir(FCPATH . $defaultFolder)) {

			mkdir(FCPATH . $defaultFolder, $mode);
		}
		if(!empty($folder)) {

			if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
				mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
			}
		} 
	}
}