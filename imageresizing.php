<?php
/*
By: Albara'a Salem
File adds white border to images on toysonfire.ca website that 
are less than 500px for both width and height. 

May 11th, 2022
Version: 1.0
*/

$id = $_GET["id"];  
function resize_image($idNum){
	$url = 'https://www.toysonfire.ca/website/image/product.template/'.$idNum.'/image'; // this is the image url of the passed in image id
	
	//using GD, we can get the dimensions of the image
	//$src = imagecreatefromjpeg($url);
	$src = imagecreatefromstring(file_get_contents($url));
	
	header("Content-Type: image/jpg"); 

	//getting the height and width of image
	$src_width = imagesx($src); 
	$src_height = imagesy($src); 
	
	// setting white padding colour
	$clear = array('red'=>255,'green'=>255,'blue'=>255); 

	// now we check if the image width and width are both a minimum of 500px
	if( ($src_width < 500) && ($src_height < 500)){
		// then we add the white borders to the image
		$width_difference = 500 - $src_width; 
		$height_difference = 500 - $src_height;

		// making the image reach 500x500 with white padding
		$dst_width = $src_width + $width_difference; 
		$dst_height = $src_height + $height_difference; 

		// New resource image at new size
		$dst = imagecreatetruecolor($dst_width, $dst_height);

		// fill the image with the white padding color
		$clear = imagecolorallocate( $dst, $clear["red"], $clear["green"], $clear["blue"]);
		imagefill($dst, 0, 0, $clear);

		// copy the original image on top of the new one
		imagecopymerge($dst,$src,(($dst_width - $src_width)/2),(($dst_height - $src_height)/2),0,0,$src_width,$src_height, 100);

		imagejpeg($dst);
		//return $dst;
		// free resources
		imagedestroy($src);
		imagedestroy($dst);

	}else if($src_width < 500){
		// then we add the white borders to the image
		$width_difference = 500 - $src_width; 

		// making the image reach 500x500 with white padding
		$dst_width = $src_width + $width_difference; 
		$dst_height = $src_height;

		// New resource image at new size
		$dst = imagecreatetruecolor($dst_width, $dst_height);

		// fill the image with the white padding color
		$clear = imagecolorallocate( $dst, $clear["red"], $clear["green"], $clear["blue"]);
		imagefill($dst, 0, 0, $clear);

		// copy the original image on top of the new one
		imagecopymerge($dst,$src,(($dst_width - $src_width)/2),0,0,0,$src_width,$src_height, 100);
		
		imagejpeg($dst);
		
		// free resources
		imagedestroy($src);
		imagedestroy($dst);
	}else if($src_height < 500){ 
		// then we add the white borders to the image
		$height_difference = 500 - $src_height;

		// making the image reach 500x500 with white padding
		$dst_width = $src_width;
		$dst_height = $src_height + $height_difference;

		// New resource image at new size
		$dst = imagecreatetruecolor($dst_width, $dst_height);
 
		// fill the image with the white padding color
		$clear = imagecolorallocate( $dst, $clear["red"], $clear["green"], $clear["blue"]);
		imagefill($dst, 0, 0, $clear);

		// copy the original image on top of the new one
		imagecopymerge($dst,$src,0,(($dst_height - $src_height)/2),0,0,$src_width,$src_height, 100);
		
		imagejpeg($dst);

		//return $dst; 

		// free resources
		imagedestroy($src);
		imagedestroy($dst);

	}else{
		// making the image reach 500x500 with white padding
		$dst_width = $src_width; 
		$dst_height = $src_height; 

		// New resource image at new size
		$dst = imagecreatetruecolor($dst_width, $dst_height);

		// fill the image with the white padding color
		$clear = imagecolorallocate( $dst, $clear["red"], $clear["green"], $clear["blue"]);
		imagefill($dst, 0, 0, $clear);

		// copy the original image on top of the new one
		imagecopymerge($dst,$src,0,0,0,0,$src_width,$src_height, 100);

		imagejpeg($dst);
		//return $dst;
		// free resources
		imagedestroy($src);
		imagedestroy($dst);


	}
}
resize_image($id); 
?>