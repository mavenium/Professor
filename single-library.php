<?php get_header(); ?>
            
            <!-- Left Sec -->
            <section id="left-sec" class="col-md-9 col-sm-8">
                
                <?php if( have_posts() ) : the_post(); ?>
                
                <article class="master-post" id="post-<?php the_ID(); ?>">
                    
                    <header class="post-header">
                        <i class="fa fa-book fa-lg"></i>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                
                    <div class="post-body clearfix">
                        
                        <?php $lib_file = get_post_meta($post->ID, "professor_lib_file", true); ?>
                        <?php $lib_author = get_post_meta($post->ID, "professor_lib_author", true); ?>
                        <?php $lib_translators = get_post_meta($post->ID, "professor_lib_translators", true); ?>
                        <?php $lib_publisher = get_post_meta($post->ID, "professor_lib_publisher", true); ?>
                        <?php $lib_pdate = get_post_meta($post->ID, "professor_lib_pdate", true); ?>
                        <?php $lib_shabak = get_post_meta($post->ID, "professor_lib_shabak", true); ?>
                        <?php $lib_wysiwyg = get_post_meta($post->ID, "professor_lib_wysiwyg", true); ?>
                        
                        <div id="book-info" class="clearfix">
                            
                            <div class="pull-right">
                                
                                <ul class="clearfix">
                                    <li><?php if ($lib_author) { echo 'نویسنده : ' . $lib_author; } else echo 'نویسنده : -'; ?></li>
                                    <li><?php if ($lib_translators) { echo 'مترجم : ' . $lib_translators; } else echo 'مترجم : -'; ?></li>
                                    <li><?php if ($lib_publisher) { echo 'ناشر : ' . $lib_publisher; } else echo 'ناشر : -'; ?></li>
                                    <li><?php if ($lib_pdate) { echo 'تاریخ چاپ : ' . $lib_pdate; } else echo 'تاریخ چاپ : -'; ?></li>
                                    <li><?php if ($lib_shabak) { echo 'شابک : ' . $lib_shabak; } else echo 'شابک : -'; ?></li>
                                </ul>
                                
                                <a class="button" href="<?php echo $lib_file; ?>" title="دانلود <?php the_title(); ?>">
                                    <i class="fa fa-download"></i>
                                    <?php echo 'دانــــلــــود'; ?>
                                </a>
                                
                            </div>
                            
                            <div class="pull-left">
                                
                                <?php if ( has_post_thumbnail() ) { 
                                    the_post_thumbnail(array(240, 240), array('class' => 'book-img img-thumbnail img-responsive'));
                                } else { echo '<img class="book-img img-thumbnail img-responsive" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-thumb.png">'; } ?>

                            </div> 
                            
                        </div>
                        
                        <?php echo $lib_wysiwyg; ?>
                    
                    </div>

                    <footer class="post-footer clearfix">

                        <?php if( function_exists('the_views') ) { ?>
                        <span id="view">
                             <i class="fa fa-eye fa-lg"></i>
                             <?php the_views(); ?>
                        </span>
                        <?php } ?>

                        <span id="date">
                            <i class="fa fa-calendar fa-lg"></i>
                            <?php                        
                                if( get_the_modified_date() != get_the_date() ){
                                    get_the_modified_date('j / m / Y');
                                } else {
                                    the_time('j / m / Y');
                                }                        
                            ?>
                        </span>

                    </footer>
                    
                </article>
                
                <?php endif; wp_reset_postdata(); ?>
                
                <?php comments_template(); ?>
                
            </section>
            <!-- /Left Sec -->
        
<?php get_footer(); ?>