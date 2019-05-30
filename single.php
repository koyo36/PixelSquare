

<?php get_header(); ?>
    <section class="main-content">
            <div class="container">
                <div class="row frebie-wrap">
                    <article class="article-wrap col-md-12">

                        <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

                            <h1><?php the_title(); ?></h1>
                            <p class="post-meta">Posted on <span><?php the_date(); ?></span> Tags: <?php the_category(', '); ?></p>

                            <div class="featured-image">
                                <?php if( has_post_thumbnail() ) the_post_thumbnail('freebie'); ?>
                            </div>
                            
                         

                            <?php the_content(); ?>
                            
                            <?php echo post_love_display(); ?>

                            <a href="<?php print_r( get_post_meta($post->ID, 'download_metaboxu', true, true)); ?>" class="ps-btn ps-primary" target="_blank">
                                <i class="fas fa-link"></i> Download Link
                            </a>
                          
                        <?php endwhile; ?>
                        <?php endif; ?>
                        
                    </article>

                </div><!-- .row .frebie-wrap -->
            </div><!-- .container -->

    </section><!-- .main-container -->


<?php get_footer(); ?>
