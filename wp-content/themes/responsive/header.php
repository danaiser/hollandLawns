<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
<!--Responsive Select Menu-->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tinynav.js"></script>
</head>

<body <?php body_class(); ?>>
    <div class="container" id="header-container">
        <div class="row">
            <div itemscope itemtype="http://schema.org/Organization" class="sixcol" id="logo">
                <a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" alt="Logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png"/></a>
            </div>
            <div class="sixcol last" id="header">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Header'))  ?>
            </div>
        </div>
    </div>
    <div class="container" id="navigation-container">
        <div class="row">
            <div class="twelvecol last" id="header-menu">
                <?php wp_nav_menu(array('container' => 'false', 'theme_location' => 'header-menu')); ?>	
            </div>
        </div>
    </div>		
    <?php if (is_front_page()) { ?>
        <!--Slideshow-->
        <div class="row">
            <div class="twelvecol last" id="slideshow">
                <?php echo do_shortcode('[responsive_slider]'); ?>
            </div>
        </div>
    <?php } ?>
    </div>