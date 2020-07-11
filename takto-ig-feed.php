<?php
/**
 * Plugin Name: TAKTO Instagram feed
 * Plugin URI: https://www.takto.sk
 * Description: Display content using a shortcode to insert in a page or post
 * Version: 0.1
 * Text Domain: takto-ig-feed
 * Author: Samuel Krempasky from TAKTO
 * Author URI: https://www.takto.sk
 */

function addJS() {
    wp_enqueue_script(
        'takto-ig-feed-script',
        plugins_url( '/js/dist/InstagramFeed.min.js', __FILE__ )
    );
}
add_action( 'wp_enqueue_scripts',  'addJS' );

function takto_ig_feed($atts = array()) {

 	extract(shortcode_atts(array(
     'username' => 'instagram',
     'display_profile' => 'true',
     'display_biography' => 'true',
     'display_gallery' => 'true',
     'callback' => 'null',
     'styling' => 'true',
     'items' => '8',
     'items_per_row' => '4',
     'margin' => '1',
     'lazy_load' => 'true',
     'id' => rand(1, 99999999)
    ), $atts));
	$Content = "<div id=\"instagram-feed$id\" class=\"instagram_feed\"></div>\r\n";
	$Content .= "<script>(function(){new InstagramFeed({\r\n";
    $Content .= "'username': '$username',\r\n";
    $Content .= "'container': document.getElementById(\"instagram-feed$id\"),\r\n";
    $Content .= "'display_profile': $display_profile,\r\n";
    $Content .= "'display_biography': $display_biography,\r\n";
    $Content .= "'display_gallery': $display_gallery,\r\n";
    $Content .= "'callback': $callback,\r\n";
    $Content .= "'styling': $styling,\r\n";
    $Content .= "'items': $items,\r\n";
    $Content .= "'items_per_row': $items_per_row,\r\n";
    $Content .= "'margin': $margin,\r\n";
    $Content .= "'lazy_load': $lazy_load,\r\n";
    $Content .= "'on_error': console.error\r\n";
	$Content .= "});})();</script>\r\n";

	 
    return $Content;
}

add_shortcode('takto-ig-feed', 'takto_ig_feed');

