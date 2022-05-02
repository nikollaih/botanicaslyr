<?php
/**
 * * Upload image file
 */
function upload_image_file($file, $path, $name, $sizes)
{
    // * If exist some file with image data 
    if (isset($file['name']) && !empty($file['name'])){
        // * If file is an image
        if ($file['type']=='image/png' || $file['type']=='image/jpeg'){
            // * Get the image format type 
            $n = explode('.', $file['name']);
            $img_type = $n[count($n) - 1];
            // * Validate if exist path
            if(!file_exists($path)){
                // * Create the new folder path
                mkdir($path, DIR_WRITE_MODE, true);
            }

            $full_name = $name.'.'.$img_type;
            // * Upload file to server
            if(move_uploaded_file($file["tmp_name"], $path."/".$full_name)){
                uploadThumbs($full_name, $img_type, $path, $sizes);
                return $full_name;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}

/**
 * 
 */
function upload_file($file, $path, $name)
{
    // * If exist some file with image data 
    if (isset($file['name']) && !empty($file['name'])){
        // * Get the image format type 
        $n = explode('.', $file['name']);
        $file_type = $n[count($n) - 1];
        // * Validate if exist path
        if(!file_exists($path)){
            // * Create the new folder path
            mkdir($path, DIR_WRITE_MODE, true);
        }

        $full_name = $name.'.'.$file_type;
        // * Upload file to server
        if(move_uploaded_file($file["tmp_name"], $path."/".$full_name)){
            return $full_name;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}

/**
 * * Generate copies about original path image
 */
function uploadThumbs($name, $format, $path, $sizes = null)
{
    // * Get image´s sizes
    list($w_src, $h_src, $type) = getimagesize($path.$name);
    $proporcion = $h_src / $w_src;
    // * Get the copy of image
    $img_src = get_image_copy($path.$name, $format);
    print_r($img_src);
    // * If exists sizes for new images
    if(is_array($sizes)){
        for ($i=0; $i < count($sizes); $i++) { 
            // * Get the size value
            $s = $sizes[$i];
            // * Generate a blank template with new image sizes
            $img_dst = imagecreatetruecolor($s / $proporcion , $s);
            // * Generate the new image and add this to template
            imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $s / $proporcion, $s, $w_src, $h_src);
            // * Save new image
            imagejpeg($img_dst, $path.$name, 100);
            // * Destroy template
            imagedestroy($img_dst);
        }
    }
    // * Destroy initial image copy
    imagedestroy($img_src); 
}

/**
 * * Create a copy about image
 */
function get_image_copy($path, $format)
{
    if(strtolower($format) == "png")
    {
        $img_src = imagecreatefrompng($path);
    }
    else if(strtolower($format) == "jpg" || strtolower($format) == "jpeg")
    {
        $img_src = imagecreatefromjpeg($path); 
    }
    else
    {
        $img_src = imagecreatefromgif($path);
    }

    return $img_src;
}