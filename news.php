    <!-- News -->
    <section id="news-sec" class="effect2">
        
        <header>            
            <h4 class="dotted"><span><?php echo of_get_option ( 'option_news_title' ); ?></span></h4>            
        </header>
        
        <div id="news-cont">
            
            <?php $news_query = new WP_Query( array('showposts' => of_get_option ( 'option_news_number' ), 'post_type'=> 'news',) ); ?>
            
            <ul>
                <?php if ( $news_query->have_posts() ) : while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <li id="news-<?php the_ID(); ?>">
                    <i class="fa fa-angle-double-left"></i>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <span class="hidden-xs">
                        <i class="fa fa-calendar"></i>
                        <?php                        
                            if( get_the_modified_date() != get_the_date() ){
                                get_the_modified_date('j / m / Y');
                            } else {
                                the_time('j / m / Y');
                            }                        
                        ?>
                    </span>
                </li>
                <?php endwhile; endif; wp_reset_postdata(); wp_reset_query; ?>
            </ul>
            
        </div>
        
    </section>
    <!-- /News -->