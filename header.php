<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-hydronix
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
session_start();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/noto-sans-v28-latin-regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/noto-sans-v28-latin-700.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php
if (get_field('ga_property', 'options')) {
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property', 'options')?>">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config',
            '<?=get_field('ga_property', 'options')?>'
            );
    </script>
    <?php
}
if (get_field('gtm_property', 'options')) {
    ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?=get_field('gtm_property', 'options')?>'
            );
    </script>
    <!-- End Google Tag Manager -->
    <?php
}
if (get_field('google_site_verification', 'options')) {
    echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
}
if (get_field('bing_site_verification', 'options')) {
    echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
}

wp_head();
?>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Timber Rooms",
            "url": "https://www.timberrooms.co.uk/",
            "logo": "https://www.timberroooms.co.uk/wp-content/theme/cb-timberrooms2023/img/timberrooms-logo.png",
            "description": "...",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Unit 10, Newbrook Business Park, Pound Lane",
                "addressLocality": "Upper Beeding",
                "addressRegion": "West Sussex",
                "postalCode": "BN44 3JD",
                "addressCountry": "UK"
            },
            "telephone": "+44 (0) 1273 839491",
            "email": "hello@timberrooms.co.uk"
        }
        }
    </script>

</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
    <?php
do_action('wp_body_open');
/*
?>
<div id="wrapper-navbar" class="fixed-top p-0">
    <nav class="navbar navbar-expand-md p-0">
        <div class="container-xl py-2 nav-top align-items-center">
            <a href="/" class="logo" aria-label="Timber Rooms Homepage"></a>
            <div class="button-container d-md-none">
                <button class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                </button>
            </div>
           
            <div class="collapse navbar-collapse" id="navbar">
                    <?php
                    wp_nav_menu(
    array(
        'theme_location'  => 'primary_nav',
        'container_class' => 'w-100',
        'menu_class'      => 'navbar-nav justify-content-around',
        'fallback_cb'     => '',
        'menu_id'         => 'navbarr',
        'depth'           => 3,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    )
);
*/
?>
<div id="wrapper-navbar" class="fixed-top p-0">
    <div class="topnav">
        <a href="/" class="logo" aria-label="Timber Rooms Homepage"></a>
        <div class="button-container text-end d-flex align-items-center justify-content-end d-md-none">
            <button class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
            aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
    <nav class="navbar navbar-expand-md p-0">
        <div class="collapse navbar-collapse" id="navbar">
                    <?php
                    wp_nav_menu(
    array(
        'theme_location'  => 'primary_nav',
        'container_class' => 'container-xl w-100',
        'menu_class'      => 'navbar-nav justify-content-around',
        'fallback_cb'     => '',
        'menu_id'         => 'navbarr',
        'depth'           => 3,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    )
);
        ?>
        </div>
    </nav>
</div>
<!--            </div>
        </div>
    </nav>
</div> -->