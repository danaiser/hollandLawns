<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<!--[if lt IE 9]>
	<link rel='stylesheet'  href='<?php echo get_template_directory_uri(); ?>/ie.css' type='text/css' media='all' />
<![endif]-->
<!--[if lte IE 8]>
	<link rel='stylesheet'  href='<?php echo get_template_directory_uri(); ?>/ie.css' type='text/css' media='all' />
<![endif]-->
<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script><![endif]-->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/responsive.css" />
		<?php wp_head(); ?>       
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<div id="page" class="hfeed">
			<?php do_action( 'before' ); ?>
            
					<header id="branding" role="banner">
                    
                         <div id="logo" itemscope itemtype="http://schema.org/Organization" class="header-element">
            				<a itemprop="url" href="#"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></a>
       								 </div><!--endlogo-->
                                     
                                     		<div id="header-info" class="header-element">
                                                 <?php if ( is_active_sidebar( 'header-info' ) ) : ?>
                                                    <?php dynamic_sidebar( 'header-info' ); ?>
                                                		<?php endif; ?>
                                     						</div><!--endheaderinfo-->
                                     
                                                                    <nav id="access" role="navigation">
                                                                        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                                                                            </nav><!-- #access -->
                                                                                </header><!-- #branding -->

	<div id="main">