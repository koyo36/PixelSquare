<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>


    <section class="main-content">
            <div class="container">
                <div class="row frebie-wrap">

                    <div class="col-md-12">
                    
                        <h1 class="lead-text text-center">404, page not found</h1>
                    
                    </div>
     

                
                </div><!-- .row .frebie-wrap -->
            </div><!-- .container -->


            <div class="container">         

                <div class="row frebie-ctrl d-flex justify-content-between ">
                

                    <div class="col-md-1 frebie-left">
                         <?php echo get_previous_posts_link('<i class="far fa-arrow-alt-circle-left"></i>'); ?>
                    </div>
                    <div class="col-md-10 frebie-navigation d-flex justify-content-center">

                        <ul class="frebie-nav nav">
                            <?php wp_link_pages(); ?> 
                            <!-- <li class="nav-item"><a class="nav-link active" href="#">1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">2</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">3</a></li> -->
                           
                        </ul>

                    </div>
                    <div class="col-md-1 frebie-right">
                        <?php echo get_next_posts_link('<i class="far fa-arrow-alt-circle-right"></i>'); ?>
                    </div>
                </div><!-- .row .frebie-ctrl -->

            </div><!-- .container -->

    </section><!-- .main-container -->







<?php get_footer(); ?>