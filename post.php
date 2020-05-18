<?php for ($i=1 ; $i <= of_get_option ( 'option_box_number' ) ; $i++) { ?>

    <!-- Posts-<?php echo $i; ?> -->
    <section id="post-sec" class="clearfix">
        
        <header>
            <h4>
                <span>
                    <i class="fa fa-file-text-o fa-lg"></i>
                    <?php echo of_get_option ( 'option_post_title'.$i ); ?>
                </span>
            </h4>
        </header>
        
        <?php $post_query = new WP_Query( array('showposts' => of_get_option ( 'option_post_number'.$i ), 'cat'=> of_get_option ( 'options_post_cat'.$i ),) ); ?>
        
        <ul>
            <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
            <li id="post-<?php the_ID(); ?>" class="clearfix">
                
                <?php if ( has_post_thumbnail() ) { 
                    the_post_thumbnail(array(50, 50), array('class' => 'book-img '));
                } else { echo '<img class="book-img" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-thumb.png">'; } ?>
                
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                
                <div class="post-info">                    
                    <?php if( function_exists('the_views') ) { ?>
                    <span id="view">
                        <i class="fa fa-eye"></i>
                        <?php the_views(); ?>
                    </span>
                    <?php } ?>

                    <span id="date">
                        <i class="fa fa-calendar"></i>
                        <?php                        
                            if( get_the_modified_date() != get_the_date() ){
                                get_the_modified_date('j / m / Y');
                            } else {
                                the_time('j / m / Y');
                            }                        
                        ?>
                    </span>                
                </div>
            </li>
            <?php endwhile; endif; wp_reset_postdata(); wp_reset_query; ?>
        </ul>
        
    </section>
    <!-- Posts-<?php echo $i; ?> -->
	
<?php } ?>