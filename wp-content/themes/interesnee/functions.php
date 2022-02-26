<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-styles', get_template_directory_uri() . '/style.css');
});

include_once __DIR__ . '/project/init.php';