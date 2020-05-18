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
                    
                </article>
                
                <?php endif; wp_reset_postdata(); ?>
                
            </section>
            <!-- /Left Sec -->
        
<?php get_footer(); ?>