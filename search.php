<?php

/**
 * 
 *  The Search File
 * 
 */
get_header(); ?>

    <section class="main-content">    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="lead-text">Search Results for: <i> <?php echo get_search_query(); ?></i> </h3>
                </div>

            </div>
            <div class="row frebie-wrap search-page">

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

            </div>
        </div>
    </section>

<?php get_footer(); ?>