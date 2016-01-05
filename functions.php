<?php

function avintegra_register_navbar() {
    register_nav_menu('navbar', 'Navigacia');
}

function avintegra_active_link_class($classes, $item) {
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

add_action('init', 'avintegra_register_navbar');

add_filter('nav_menu_css_class' , 'avintegra_active_link_class' , 10 , 2);

add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/img/featured.jpg',
    'width' => 1920,
    'height' => 500,
    'uploads' => TRUE,
));
