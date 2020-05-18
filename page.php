<?php get_header(); ?>
            
            <!-- Left Sec -->
            <section id="left-sec" class="col-md-9 col-sm-8">
                
                <?php if( have_posts() ) : the_post(); ?>
                
                <article class="master-post" id="post-<?php the_ID(); ?>">
                    
                    <header class="post-header">
                        <i class="fa fa-file-text-o fa-lg"></i>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                
                    <div class="post-body clearfix"><?php the_content(); ?></div>

                    <footer class="post-footer clearfix">

                        <?php if( function_exists('the_views') ) { ?>
                        <span id="view">
                             <i class="fa fa-eye fa-lg"></i>
                             <?php the_views(); ?>
                        </span>
                        <?php } ?>

                        <span id="date">
                            <i class="fa fa-calendar fa-lg"></i>
                            <?php the_time('j / m / Y'); ?>
                        </span>
                        
                        <span id="author">
                            <i class="fa fa-user"></i>
                            <?php the_author(' '); ?>
                        </span>

                    </footer>
                    
                </article>
                
                <?php endif; wp_reset_postdata(); ?>
                
                <?php comments_template(); ?>
                
            </section>
            <!-- /Left Sec -->
        
<?php get_footer(); ?>