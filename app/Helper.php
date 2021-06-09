<?php
/**
 * Developer Debugging function
 * @param $value
 * @param int $exit
 */
if (!function_exists('p')) {
    function p($value, $exit = 1)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        if ($exit == 1) {
            die;
        }
    }
}
