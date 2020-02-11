<?php
/**
 * @package Koalect_Title_Plugin
 * @version 1.0.0
 */
/*
Plugin Name: Koalect Title Plugin
Description: Plugin to add the epic word "- Koalect" to all posts titles
Version: 1.0.0
Author: Jimmy Morrens
Author URI: https://github.com/Askerx9
*/

add_filter( "the_title", "Koalect_Title_init" );

/**
 * Init function
 */
function Koalect_Title_init ($title) {
    return get_post_type() === 'events' && !strpos($title, ' — Koalect') ? $title .= ' — Koalect' : $title;
}