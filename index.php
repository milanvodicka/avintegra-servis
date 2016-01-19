<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/img/favicon.ico"/>
    <?php wp_site_icon(); ?>
    <?php wp_head(); ?>
</head>
<body>

    <!-- header -->
    <div class="container-fluid">
        <div class="header row">
            <div class="header__logo col-sm-7">
                <a href="<?=site_url()?>"><img src="<?= get_template_directory_uri(); ?>/img/logo.jpg" alt="AV Integra Servis"/></a>
            </div>
            <?php if (get_option('phone_number')): ?>
            <div class="header__notice col-sm-5">
                <p><span class="glyphicon glyphicon-earphone header__notice__phone-icon"></span><a href="tel:<?=str_replace('+', '00', str_replace(' ', '', get_option('phone_number')))?>"><?=get_option('phone_number')?></a></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
    <?php if (has_nav_menu('navbar')): ?>
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation__links" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand visible-xs-inline">Navigácia</span>
            </div>
            <?php wp_nav_menu(array(
                'menu' => 'navbar',
                'theme_location' => 'primary',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id' => 'navigation__links',
                'menu_class' => 'nav navbar-nav',
                'menu_id' => '',
                'echo' => TRUE,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
                'walker' => ''
            )); ?>
        </div>
    <?php endif; ?>
    </div>

    <!-- <?php echo get_header_image(); ?> -->

    <!-- loop -->
    <?php if (have_posts()): ?>
    <?php the_post(); ?>

    <!-- feature -->
    <?php if (has_post_thumbnail()): ?>
        <div class="feature text-center">
            <?php the_post_thumbnail('post-thumbnail', [
                'alt' => get_bloginfo('title'),
                'class' => 'img-responsive',
            ]); ?>
        </div>
    <?php elseif (get_header_image()): ?>
        <div class="feature text-center">
            <img src="<?php echo(get_header_image()); ?>" alt="<?php echo(get_bloginfo('title')); ?>" class="img-responsive"/>
        </div>
    <?php endif; ?>

    <!-- content -->
    <div class="container-fluid">
        <div class="content row">
            <div class="col-md-12">
                <?php if (get_the_title()): ?>
                <h1><?php the_title(); ?></h1>
                <?php endif; ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php else: ?>

    <!-- 404 -->
    <div class="container-fluid">
        <div class="content row">
            <div class="col-md-12">
               <h1>Ooops!</h1>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <!-- footer -->
    <div class="container-fluid">
        <div class="footer row">
            <div class="col-md-12">
                <p class="footer__up"><a href="#"><span class="glyphicon glyphicon-chevron-up"></span> Hore</a></p>
                <p>&copy; AV Integra servis, s. r. o.</p>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
    <script>
        (function($) {
            $(function() {
                $('.content').Chocolat();
            });
        })(jQuery);
    </script>
</body>
</html>
