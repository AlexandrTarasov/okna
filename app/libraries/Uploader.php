<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader
{	
	
	
	public function upload($file, $target, $generate_name = true, $name = null)
	{
		$filename = ($generate_name ? uniqid() : ($name ? $name : pathinfo($file['name'])['filename'])). '.'. pathinfo($file['name'])['extension'];
		move_uploaded_file($file['tmp_name'], getcwd().$target .'/' .$filename);
		return $filename;
    }
    


	public function image_resize($originalFile, $targetFile, $newWidth, $newHeight, $strict = FALSE) {
	
	    $info = getimagesize($originalFile);
	    $mime = $info['mime'];
	
	    switch ($mime) {
	            case 'image/jpeg':
	                    $image_create_func = 'imagecreatefromjpeg';
	                    $image_save_func = 'imagejpeg';
	                    $new_image_ext = 'jpg';
	                    break;
	
	            case 'image/png':
	                    $image_create_func = 'imagecreatefrompng';
	                    $image_save_func = 'imagepng';
	                    $new_image_ext = 'png';
	                    break;
	
	            case 'image/gif':
	                    $image_create_func = 'imagecreatefromgif';
	                    $image_save_func = 'imagegif';
	                    $new_image_ext = 'gif';
	                    break;
	
	            default: 
	                    throw new Exception('Unknown image type.');
	    }
	
		
	
	    $img = $image_create_func($originalFile);
	    list($width, $height) = getimagesize($originalFile);
	    
	   
		if(!$strict)
		{
			 if($height < $newHeight && $width < $newWidth) // ratio
			 {
				 $newHeight = $height;
				 $newWidth = $width;
				 
			 } elseif($width > $height)
		    	$newHeight = ($height / $width) * $newWidth;
		    else 
				$newWidth = ($width / $height) * $newHeight;
			
		}
	   
	   
	   
	    $tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagealphablending($tmp, false );
		imagesavealpha( $tmp, true );
	    
	    
	    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	
	    if (file_exists($targetFile)) {
	            unlink($targetFile);
	    }
	    $image_save_func($tmp, "$targetFile");
	}

}