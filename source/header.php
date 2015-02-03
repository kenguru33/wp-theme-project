<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package MySite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mysite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->
        <div class="navigation" role="banner">
            <div class="navigation-wrapper">
                <a href="javascript:void(0)" class="logo">
                    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image">
                </a>
                <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
                <nav role="navigation">
                    <?php

                    $defaults = array(
                        'theme_location'  => '',
                        'menu'            => '',
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'menu show',
                        'menu_id'         => 'js-navigation-menu',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => ''
                    );

                    wp_nav_menu( $defaults );

                    ?>
                </nav>
                <div class="navigation-tools">
                    <div class="search-bar">
                        <?php get_search_form(); ?>
                    </div>
                    <a href="javascript:void(0)" class="sign-up">Sign Up</a>
                </div>
            </div>
        </div><!-- #site-navigation -->
    </header><!-- #masthead -->
	<div id="content" class="site-content">
