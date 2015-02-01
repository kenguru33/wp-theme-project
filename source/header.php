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
                    <ul id="js-navigation-menu" class="navigation-menu show">
                        <li class="nav-link"><a href="javascript:void(0)">Products</a></li>
                        <li class="nav-link"><a href="javascript:void(0)">About Us</a></li>
                        <li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
                        <li class="nav-link more"><a href="javascript:void(0)">More</a>
                            <ul class="submenu">
                                <li><a href="javascript:void(0)">Submenu Item</a></li>
                                <li><a href="javascript:void(0)">Another Item</a></li>
                                <li class="more"><a href="javascript:void(0)">Item with submenu</a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0)">Sub-submenu Item</a></li>
                                        <li><a href="javascript:void(0)">Another Item</a></li>
                                    </ul>
                                </li>
                                <li class="more"><a href="javascript:void(0)">Another submenu</a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0)">Sub-submenu</a></li>
                                        <li><a href="javascript:void(0)">An Item</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="navigation-tools">
                    <div class="search-bar">
                        <form role="search">
                            <input type="search" placeholder="Enter Search" />
                            <button type="submit">
                                <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
                            </button>
                        </form>
                    </div>
                    <a href="javascript:void(0)" class="sign-up">Sign Up</a>
                </div>
            </div>
        </div><!-- #site-navigation -->
    </header><!-- #masthead -->
	<div id="content" class="site-content">
