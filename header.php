<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * 
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>


    <section class="main-header">

        <div class="container">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="main-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php 
                        
                            if( function_exists('the_custom_logo') ) { 
                                $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
                                echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">';
                            } else {

                        ?>
                            
                            <img src="<?php echo bloginfo('template_directory') . '/assets/images/logo.png'; ?>">
                            <?php } ?>
                        </a>
                    </div>
                </div>
                <div class="offset-md-5 col-md-4">

                    <div class="main-search">

                        <?php $unique_id = esc_attr( uniqid( 'search-form' ) ); ?>
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/')); ?>">
                            <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'pixelsquare');?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                    </div>
                
                </div>
            </div>
            
        </div>

    </section>

    <section class="main-navigation">

        <div class="container">
            <div class="row">

                <div class="nav-container">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">All</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Mock Ups</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Icons</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">UI Kits</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Patterns</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Web Templates</a>
                        </li>
                    </ul>  
                </div><!-- .nav-container -->      

            </div><!-- .row -->
            
        </div><!-- .container -->

    </section><!-- .main-navigation -->
