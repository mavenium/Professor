<?php get_header(); ?>
            
            <!-- Left Sec -->
            <section id="left-sec" class="col-md-9 col-sm-8">
                
                <!-- News -->
                <section id="news-sec">

                    <header>            
                        <h4 class="dotted"><span><?php echo "بایگانی اخبار"; ?></span></h4>            
                    </header>

                    <div id="news-cont">

                        <ul>
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <li id="news-<?php the_ID(); ?>">
                                <i class="fa fa-angle-double-left"></i>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                                <span>
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
                            <?php endwhile; endif; wp_reset_postdata(); ?>
                        </ul>

                    </div>

                </section>
                <!-- /News -->
                
                <?php professor_posts_nav(); ?>
                
            </section>
            <!-- /Left Sec -->
        
<?php get_footer(); ?>