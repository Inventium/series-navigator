<?php 
/*
 * Plugin name: Plugin Series navigator
 * 
 * Custom field handling for 
 * fast, uniform navigation bars for the plugin 
 * series of articles on Website In A Weekend.
 */

$plugin_series_css_url = WP_PLUGIN_URL.'/series-navigator/css/series-navigator.css';
$plugin_series_css_file = WP_PLUGIN_DIR.'/series-navigator/css/series-navigator.css';

if (file_exists($plugin_series_css_file)) {
    wp_register_style('series_stylesheet', $plugin_series_css_url);
    wp_enqueue_style('series_stylesheet');
}

function build_nav_link($k, $v) {

    $values = get_post_custom_values($k);
    list($url,$anchor,$description) = explode("::", $values[0]);

    if (!$url) {
        return NULL;
    }
    
    if (!$anchor) {
        $link = "<a href=\"$url\"/>$v</a> $description";
    } else {
        $link = "<a href=\"$url\"/>$anchor</a> $description";
    }
    return $link;
}


function plugin_series_navigation() {
    
    $next = build_nav_link('next-plugin',"Next");    
    if (!$next) {
        return NULL;
    }
    $prev = build_nav_link('previous-plugin',"Prev");
    // One of these could point to Table of Contents
    //$home = build_nav_link('home',"Home");    
    //$end  = build_nav_link('end',"Home");    
           
    $links .= "<table class=\"plugin-series\">";
    $links .= "<tr>";
    $links .= "<th>Previous plugin</th>";
    $links .= "<th>Next plugin</th>";
    $links .= "</tr>";
    $links .= "<tr>";
    $links .= "<td>".$prev."</td>";
    $links .= "<td>".$next."</td>";
    $links .= "</tr>";
    $links .= "</table>";
    
    return $links;
}
add_shortcode('plugin-series','plugin_series_navigation');

?>