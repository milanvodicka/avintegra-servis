<?php
require __DIR__ . '/form/form.php';

// actions

add_action('init', function() {
    register_nav_menu('navbar', 'Navigacia');
});

add_action('admin_init', function() {
    add_settings_field('phone_number', 'Tel. číslo', function() {
        echo '<input name="phone_number" type="text" id="phone_number" value="' . get_option('phone_number') . '" class="regular-text">';
    }, 'general');
    register_setting('general', 'phone_number');
});

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js', [], '', TRUE);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], '', TRUE);
});

// filters

add_filter('nav_menu_css_class' , function($classes, $item) {
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
} , 10 , 2);

add_filter('wp_mail_from', function() {

    return 'avintegra-servis@avintegra-servis.sk';
});

add_filter('wp_mail_from_name', function() {

    return 'AV Integra Servis';
});

// shortcodes

add_shortcode('avintegra-form', function() {
    $message = NULL;
    if (!empty($_POST)) {
        $message = avintegra_form_process($_POST, avintegra_form_config());
    }

    return avintegra_form_render(avintegra_form_config()['template'], [
        'message' => $message,
    ]);
});

add_shortcode('avintegra-phone', function() {

    return get_option('phone_number');
});

add_shortcode('avintegra-email', function() {

    return get_option('admin_email');
});

// theme support

add_theme_support('custom-header', array(
    'width' => 1920,
    'height' => 500,
    'uploads' => TRUE,
));

add_theme_support('title-tag');

add_theme_support('post-thumbnails');

set_post_thumbnail_size(1920, 500, ['center', 'center']);