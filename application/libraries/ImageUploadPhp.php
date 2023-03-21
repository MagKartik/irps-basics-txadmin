<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ImageUploadPhp {
	private $CI;
	function __construct() {
		// Assign by reference with "&" so we don't create a copy
		$this->CI = &get_instance();
		$this->CI->load->library('CloudinaryPhp');
	}
	public function imageUpload($choosen_name, $user_id) {
		$file_name='';
		$upload_path='';
		$this->CI->load->helper('string');
		$ext = explode(".", $_FILES['file']['name']);
		$extension = end($ext);
		$image_upload_path = array(
			"profile_image" => "uploads/profile_image/",
			"product_image" => "uploads/product_image/",
		);
		$validExtesions = array(
			"jpg",
			"jpeg",
			"png"
		);
		if (array_key_exists($choosen_name, $image_upload_path)) {
			$target_dir = $image_upload_path[$choosen_name];
			$target_file = $target_dir . date('dmYHis').str_replace(" ", "", basename($user_id . '-' . 'P' . '-' . time() . '.' . $extension));
			$uploadedFileName = date('dmYHis').str_replace(" ", "", basename($user_id . '-' . 'P' . '-' . time() . '.' . $extension));
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if ($_FILES['file']["size"] > 15728640) {
				$resp['status'] ='failed';
				$resp['msg'] ='Sorry, your file is too large.';
				$resp['uploadok'] =  false;
			}else{
				// Allow certain file formats
				if(in_array($imageFileType,$validExtesions)){
					if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) {
						chmod(FCPATH.'/'.$target_dir.$uploadedFileName, 0777);
						$resp['status'] ='success';
						$resp['msg'] ='The file  has been uploaded.';
						$resp['file'] =  $uploadedFileName;
						$resp['uploadok'] =  true;
					} else {
						$resp['status'] ='falied';
						$resp['msg'] ='Sorry, there was an error uploading your file.';
						$resp['uploadok'] =  false;
					}
				}else{
					$resp['status'] ='failed';
					$resp['msg'] ='Sorry, only jpg and png files are allowed.';
					$resp['uploadok'] =  false;
				}
			}
		} else {
			$resp['status'] ='failed';
			$resp['msg'] ='Please send image name';
			$resp['uploadok'] =  false;
		}
		 return $resp;
	}
	public function cloudinaryImageUpload($cloudinaryImageFile, $cloudinaryimageName,$type,$extension) {
		$cloudinary_upload_path = array(
			"profile_image" => "uploads/profile_image/",
			"product_image" => "uploads/product_image/",
		);
		if (array_key_exists($type, $cloudinary_upload_path)) {
			$path = array("public_id" => $cloudinary_upload_path[$type] . $cloudinaryimageName,"timeout" => 60);
			$image_upload_path_new = $cloudinary_upload_path[$type].$cloudinaryimageName;
			$uploaded = \Cloudinary\Uploader::upload('uploads/'.$image_upload_path_new.'.'.$extension, $path);
			return $uploaded;
		} else {
			return 'error';
		}
	}
}