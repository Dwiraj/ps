<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This function return full path of image in all over application
 *
 * @param $image string, image name
 * @return string $path, string, path of image
 */
    function image_path($image)
    {
        $path = base_url()."/assets/image/".$image;
        return $path;
    }

/**
 * This function return full path of css file in all over application
 *
 * @param $css , string, name of css file
 * @return string $path, string, path of css file
 */
    function css_path($css)
    {
        $path = base_url()."/assets/css/".$css;
        return $path;
    }

/**
 * This function returns full path of javascript file all over the application
 *
 * @param $js , string, name of javascript file
 * @return string $path, string, path of javascript file
 */
    function js_path($js)
    {
        $path = base_url()."/assets/js/".$js;
        return $path;
    }
?>