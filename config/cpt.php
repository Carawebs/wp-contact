<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$cpts = [
    [
        'slug'          => 'location',
        'singular_name' => 'location',
        'plural_name'   => 'locations',
        'args'          => [
            'menu_icon'   => 'dashicons-location-alt',
            'has_archive' => true,
        ]
    ],
];
return $cpts;
