<?php get_header(); ?>
            
            <!-- Left Sec -->
            <section id="left-sec" class="col-md-9 col-sm-8">
				
				<?php
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'Responsive-Slider/responsive-slider.php' ) && of_get_option( 'option_slider' ) == active ) {
					do_shortcode( '[responsive_slider]' );
				}
				
				if ( of_get_option( 'option_books_active' ) == 1 ) {				
					include ("books.php");
				}
				
				if ( of_get_option( 'option_news_active' ) == 1 ) {
					include ("news.php");
				}
				
				include ("post.php");
				?>
                
            </section>
            <!-- /Left Sec -->
        
<?php get_footer(); ?>