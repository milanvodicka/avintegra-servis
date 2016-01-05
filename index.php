<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <title><?php wp_title(); ?></title>
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/img/favicon.ico"/>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/style.css?v=1.0">
    <?php wp_site_icon(); ?>
    <?php wp_head(); ?>
</head>
<body>

    <!-- header -->
    <div class="container-fluid">
        <div class="header row">
            <div class="header__logo col-sm-7">
                <a href="#"><img src="<?= get_template_directory_uri(); ?>/img/logo.jpg" alt="AV Integra Servis"/></a>
            </div>
            <div class="header__notice col-sm-5">
                <p><span class="glyphicon glyphicon-earphone header__notice__phone-icon"></span><a href="tel:00421903704700">+421 903 704 700</a></p>
            </div>
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

    <!-- feature -->
    <?php if (get_header_image()): ?>
    <div class="feature">
        <img src="<?php echo(get_header_image()); ?>" alt="<?php echo(get_bloginfo('title')); ?>" class="img-responsive"/>
    </div>
    <?php endif; ?>

    <!-- content -->
    <?php if (have_posts()): ?>
    <?php while (have_posts()): ?>
    <div class="container-fluid">
        <div class="content row">
            <div class="col-md-12">
                <?php the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
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

    <script src="<?= get_template_directory_uri(); ?>/js/jquery-1.11.3.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/jquery.validate.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/messages_sk.min.js"></script>
    <script>
        $.validator.addMethod('phone', function(number) {
            return number.match(/((((\+|00)[0-9]{3})|0)[0-9]{9})/);
        }, 'Zadajte prosím správne telefónne číslo!');
        $(function() {
            $('.form form').validate({
                debug: false,
                rules: {
                name: {
                    required: true,
                        minlength: 4
                    },
                zip: {
                    rangelength: [5, 5]
                    },
                phone: {
                    required: true,
                        digits: true,
                        minlength: 10
                    },
                email: {
                    required: true,
                        email: true
                    },
                city: {
                    required: true,
                        minlength: 2
                    },
                text: {
                    required: true,
                        minlength: 10
                    }
            },
                highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
                unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
                errorClass: 'help-block',
                errorElement: 'span'
            });
        });
    </script>
    <?php wp_footer(); ?>
</body>
</html>
