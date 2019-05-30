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

                    <?php

                        // $temp = $wp_query;
                        // $wp_query = new WP_Query();
                        // $wp_query->query('post_type=freebie_articles'.'&paged='.$paged);

                     ?>

                    <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                        <div class="frebie-item col-md-4">
                            <div class="frebie-overlay">
                                <div class="frebie-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                                <div class="frebie-ctrl">
                                    <a href="<?php print_r( get_post_meta($post->ID, 'download_metaboxu', true, true)); ?>" class="btn btn-link" target="_blank"><i class="fas fa-link"></i> Get Link</a>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-love"><i class="far fa-heart"></i> Love It</a>
                                </div>
                                
                            </div>
                            <div class="frebie-img">
                                <?php if(has_post_thumbnail()) the_post_thumbnail('pixelsquare_thumb'); ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
            



                    <!-- <div class="frebie-item col-md-4">
                        <div class="frebie-overlay">
                            <div class="frebie-title">
                                This is the title
                            </div>
                            <div class="frebie-ctrl">
                                <a href="#" class="btn btn-link"><i class="fas fa-link"></i> Get Link</a>
                                <a href="#" class="btn btn-love"><i class="far fa-heart"></i> Love It</a>
                            </div>
                            
                        </div>
                        <div class="frebie-img">
                            <img src="https://via.placeholder.com/550" alt="">
                        </div>
                    </div> -->

                    
     

                
                </div><!-- .row .frebie-wrap -->
            </div><!-- .container -->


            <div class="container">         

                <div class="row frebie-ctrl d-flex justify-content-between ">
                
                   
   


                    <div class="col-md-1 frebie-left">
                         <?php echo get_previous_posts_link('<i class="far fa-arrow-alt-circle-left"></i>'); ?>
                    </div>
                    <div class="col-md-10 frebie-navigation d-flex justify-content-center">

                        <ul class="frebie-nav nav">
                            <?php ps_numeric_posts_nav(); ?>
 
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