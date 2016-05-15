<?php
require __DIR__ . '/form/form.php';

// actions

add_action('init', function () {
    register_nav_menu('navbar', 'Navigacia');
});

add_action('admin_init', function () {
    add_settings_field('phone_number', 'Tel. číslo', function () {
        echo '<input name="phone_number" type="text" id="phone_number" value="' . get_option('phone_number') . '" class="regular-text">';
    }, 'general');
    register_setting('general', 'phone_number');
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js', [], '', TRUE);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], '', TRUE);
    wp_enqueue_script('swipebox', get_template_directory_uri() . '/swipebox/js/jquery.swipebox.min.js', ['jquery'], '', TRUE);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', ['bootstrap']);
    wp_enqueue_style('swipebox', get_template_directory_uri() . '/swipebox/css/swipebox.min.css');
});

// filters

add_filter('nav_menu_css_class', function ($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }

    return $classes;
}, 10, 2);

add_filter('wp_mail_from', function () {

    return 'avintegra-servis@avintegra-servis.sk';
});

add_filter('wp_mail_from_name', function () {

    return 'AV Integra Servis';
});

// shortcodes

add_shortcode('avintegra-form', function () {
    $message = NULL;
    if (!empty($_POST)) {
        $message = avintegra_form_process($_POST, avintegra_form_config());
    }

    return avintegra_form_render(avintegra_form_config()['template'], [
        'message' => $message,
    ]);
});

add_shortcode('avintegra-phone', function () {

    return get_option('phone_number');
});

add_shortcode('avintegra-email', function () {

    return get_option('admin_email');
});

add_shortcode('avintegra-form-cta', function() {

    return '<div class="well form-cta"><a href="/kontaktny-formular" class="btn btn-danger btn-lg btn-block">Vyplňiť kontaktný formulár</a></div>';
});

// theme support

add_theme_support('custom-header', [
    'width' => 1920,
    'height' => 500,
    'uploads' => TRUE,
]);

add_theme_support('title-tag');

add_theme_support('post-thumbnails');

set_post_thumbnail_size(1920, 500, ['center', 'center']);

// bootstrap

add_shortcode('row', function ($atts, $content = NULL) {

    $atts = shortcode_atts([
        "xclass" => FALSE,
        "data" => FALSE
    ], $atts);

    $class = 'row';
    $class .= ($atts['xclass']) ? ' ' . $atts['xclass'] : '';

    return sprintf(
        '<div class="%s">%s</div>',
        esc_attr($class),
        do_shortcode($content)
    );
});

add_shortcode('column', function ($atts, $content = NULL) {

    $atts = shortcode_atts([
        "lg" => FALSE,
        "md" => FALSE,
        "sm" => FALSE,
        "xs" => FALSE,
        "offset_lg" => FALSE,
        "offset_md" => FALSE,
        "offset_sm" => FALSE,
        "offset_xs" => FALSE,
        "pull_lg" => FALSE,
        "pull_md" => FALSE,
        "pull_sm" => FALSE,
        "pull_xs" => FALSE,
        "push_lg" => FALSE,
        "push_md" => FALSE,
        "push_sm" => FALSE,
        "push_xs" => FALSE,
        "xclass" => FALSE,
        "data" => FALSE
    ], $atts);

    $class = '';
    $class .= ($atts['lg']) ? ' col-lg-' . $atts['lg'] : '';
    $class .= ($atts['md']) ? ' col-md-' . $atts['md'] : '';
    $class .= ($atts['sm']) ? ' col-sm-' . $atts['sm'] : '';
    $class .= ($atts['xs']) ? ' col-xs-' . $atts['xs'] : '';
    $class .= ($atts['offset_lg'] || $atts['offset_lg'] === "0") ? ' col-lg-offset-' . $atts['offset_lg'] : '';
    $class .= ($atts['offset_md'] || $atts['offset_md'] === "0") ? ' col-md-offset-' . $atts['offset_md'] : '';
    $class .= ($atts['offset_sm'] || $atts['offset_sm'] === "0") ? ' col-sm-offset-' . $atts['offset_sm'] : '';
    $class .= ($atts['offset_xs'] || $atts['offset_xs'] === "0") ? ' col-xs-offset-' . $atts['offset_xs'] : '';
    $class .= ($atts['pull_lg'] || $atts['pull_lg'] === "0") ? ' col-lg-pull-' . $atts['pull_lg'] : '';
    $class .= ($atts['pull_md'] || $atts['pull_md'] === "0") ? ' col-md-pull-' . $atts['pull_md'] : '';
    $class .= ($atts['pull_sm'] || $atts['pull_sm'] === "0") ? ' col-sm-pull-' . $atts['pull_sm'] : '';
    $class .= ($atts['pull_xs'] || $atts['pull_xs'] === "0") ? ' col-xs-pull-' . $atts['pull_xs'] : '';
    $class .= ($atts['push_lg'] || $atts['push_lg'] === "0") ? ' col-lg-push-' . $atts['push_lg'] : '';
    $class .= ($atts['push_md'] || $atts['push_md'] === "0") ? ' col-md-push-' . $atts['push_md'] : '';
    $class .= ($atts['push_sm'] || $atts['push_sm'] === "0") ? ' col-sm-push-' . $atts['push_sm'] : '';
    $class .= ($atts['push_xs'] || $atts['push_xs'] === "0") ? ' col-xs-push-' . $atts['push_xs'] : '';
    $class .= ($atts['xclass']) ? ' ' . $atts['xclass'] : '';

    return sprintf(
        '<div class="%s">%s</div>',
        esc_attr($class),
        do_shortcode($content)
    );
});

// odstranuje neziaduce "br" a "p" okolo stlpcov
add_filter("the_content", function ($content) {
    $block = join("|", ["row", "column"]);
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);

    return $rep;
});
