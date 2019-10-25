<?php


class File
{
    private static $valid_images = ["jpg", "jpeg", "gif", "png"];

    public static function SaveImage($image, $filename){
        $directory = "../images/";
        $storedLocation = $directory.$filename;
        $file = $image["image"]["tmp_name"];

        if(move_uploaded_file($file, $storedLocation)){
            return true;
        }else{
            return false;
        }

    }

    public static function CheckFileType($type){
        if(in_array($type, self::$valid_images)){
            return true;
        }else{
            return false;
        }
    }
}