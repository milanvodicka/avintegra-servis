<?php
require __DIR__ . '/form/form.php';
function avintegra_register_navbar() {
    register_nav_menu('navbar', 'Navigacia');
}

function avintegra_active_link_class($classes, $item) {
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

function avintegra_admin() {
    add_settings_field('phone_number', 'Tel. číslo', 'avintegra_admin_phone_number', 'general');
    register_setting('general', 'phone_number');
}

function avintegra_admin_phone_number() {

    echo '<input name="phone_number" type="text" id="phone_number" value="' . get_option('phone_number') . '" class="regular-text">';
}

add_action('init', 'avintegra_register_navbar');

add_filter('nav_menu_css_class' , 'avintegra_active_link_class' , 10 , 2);

add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/img/featured.jpg',
    'width' => 1920,
    'height' => 500,
    'uploads' => TRUE,
));

add_shortcode('avintegra-form', function() {
    $message = NULL;
    if (!empty($_POST)) {
        $message = avintegra_form_process($_POST, avintegra_form_config());
    }

    return avintegra_form_render(avintegra_form_config()['template'], [
        'message' => $message,
    ]);
});

add_theme_support('title-tag');

add_action('admin_init', 'avintegra_admin');