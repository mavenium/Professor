    <!-- Books -->
    <section id="books-sec">
        
        <header>            
            <h4 class="dotted"><span><?php echo of_get_option ( 'option_books_title' ); ?></span></h4>            
        </header>
        
        <div class="container-fluid">
            
            <div class="row"><div class="row">
                
                <?php $library_query = new WP_Query( array('showposts' => of_get_option ( 'option_books_number' ), 'post_type'=> 'library',) ); ?>
                
                <?php if ( $library_query->have_posts() ) : while ( $library_query->have_posts() ) : $library_query->the_post(); ?>
                <div class="col-md-4" id="book-<?php the_ID(); ?>">
                    
                    <article class="books">
                        
                        <header>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo ST (get_the_title()); ?></a></h2>
                        </header>                        
                        
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php if ( has_post_thumbnail() ) { 
                            the_post_thumbnail(array(240, 240), array('class' => 'book-img img-thumbnail img-responsive'));
                        } else { echo '<img class="book-img img-thumbnail img-responsive" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-thumb.png">'; } ?>
                        </a>
                        
                        <ul>
                            <li><i class="fa fa-calendar"></i>
                                <span>
                                    <?php                        
                                        if( get_the_modified_date() != get_the_date() ){
                                            get_the_modified_date('j / m / Y');
                                        } else {
                                            the_time('j / m / Y');
                                        }                        
                                    ?>
                                </span>
                            </li>
                            <?php if( function_exists('the_views') ) { ?>
                            <li><i class="fa fa-eye"></i><span><?php the_views(); ?></span></li>
                            <?php } ?>
                        </ul>
                        
                        <a class="book-link signTopUp" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <i class="fa fa-download"></i>
                            <?php echo 'مــشــخــصــات / دانــلــود'; ?>
                        </a>
                        
                    </article>
                    
                </div>
                <?php endwhile; endif; wp_reset_postdata(); wp_reset_query; ?>
                
            </div></div>
            
        </div>
        
    </section>
    <!-- /Books -->