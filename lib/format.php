<?php
/**
 * Format Class
 */
class Format{

    public function formatDate($date){
        return date('F jS, Y', strtotime($date));
    }

    public function formatDateTime($date){
        return date('F jS, Y h:i A', strtotime($date));
    }

    public function textShorten($text, $limit = 400){
        $text = $text. "";
        $text = substr($text, 0, $limit);
        $text = $text."...";
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function esc($str){
        return htmlspecialchars($str);
    }

    public function resizeImage($resourceType,$image_width,$image_height,$max_resolution) {

        // $resizeWidth = 400;
        // $resizeHeight = 400;
        // $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        // imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        // return $imageLayer;
        

        $original_width = imagesx($resourceType);
        $original_height = imagesy($resourceType);

        if ($original_height > $original_width) {
            
            $ratio = $max_resolution / $original_width;
            $new_width = $max_resolution;
            $new_height = $original_height * $ratio;

            $diff = $new_height - $new_width;

            $x = 0;
            $y = round($diff / 2);

        }else{
            
            $ratio = $max_resolution / $original_height;
            $new_width = $max_resolution;
            $new_height = $original_width * $ratio;

            $diff = $new_width - $new_height;

            $x = round($diff / 2);
            $y = 0;

        }

        if ($resourceType) {
            $imageLayer = imagecreatetruecolor($new_width,$new_height);

            imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$new_width,$new_height, $original_width,$original_height);
            

            $imageCrop = imagecreatetruecolor($max_resolution,$max_resolution);

            imagecolortransparent($imageCrop, imagecolorallocatealpha($imageCrop, 0, 0, 0, 127));
            imagealphablending($imageCrop, false);
            imagesavealpha($imageCrop, true);
            

            imagecopyresampled($imageCrop,$imageLayer,0,0,$x,$y,$max_resolution,$max_resolution, $max_resolution,$max_resolution);

            return $imageCrop;

        }
    }

    public function resizeBannerImage($resourceType,$image_width,$image_height) {
        $resizeWidth = 1000;
        $resizeHeight = 400;
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

    public function resizeAdsImage($resourceType,$image_width,$image_height) {
        $resizeWidth = 572;
        $resizeHeight = 250;
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

    public function resizeCat($resourceType,$image_width,$image_height) {
        $resizeWidth = 150;
        $resizeHeight = 150;
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

    public function get_var($key, $default = ""){

        if (isset($_POST[$key])) {
            
            return $_POST[$key];

        }
        return $default;

    }

    public function empty($key, $default = ""){

        if (isset($_POST[$key])) {
            
            return $_POST[$key];

        }
        return $default;

    }


}
