<?php

/* Theme Options */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/theme-options/' );
require_once dirname( __FILE__ ) . '/inc/theme-options/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

add_action( 'optionsframework_custom_scripts', 'theme_options_custom_scripts' );
function theme_options_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	// Logo Active
	jQuery('#option_logo_active').click(function() {
  		jQuery('#section-options_logo').fadeToggle(400);
	});
	if (jQuery('#option_logo_active:checked').val() !== undefined) {
		jQuery('#section-options_logo').show();
	}
	// Logo Active
	
	// Books Active
	jQuery('#option_books_active').click(function() {
  		jQuery('#section-option_books_title').fadeToggle(400);
  		jQuery('#section-option_books_number').fadeToggle(400);
	});
	if (jQuery('#option_books_active:checked').val() !== undefined) {
		jQuery('#section-option_books_title').show();
		jQuery('#section-option_books_number').show();
	}
	// Books Active
	
	// News Active
	jQuery('#option_news_active').click(function() {
  		jQuery('#section-option_news_title').fadeToggle(400);
  		jQuery('#section-option_news_number').fadeToggle(400);
	});
	if (jQuery('#option_news_active:checked').val() !== undefined) {
		jQuery('#section-option_news_title').show();
		jQuery('#section-option_news_number').show();
	}
	// News Active
	
	// Post Active
	jQuery('#option_post_active').click(function() {
  		jQuery('#section-option_post_title').fadeToggle(400);
  		jQuery('#section-option_post_number').fadeToggle(400);
	});
	if (jQuery('#option_post_active:checked').val() !== undefined) {
		jQuery('#section-option_post_title').show();
		jQuery('#section-option_post_number').show();
	}
	// Post Active

});
</script>

<?php
}

function professor_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = 'تنظیمات پوسته';
	$menu['menu_title'] = 'تنظیمات پوسته';
	$menu['menu_slug'] = 'theme-options';
	return $menu;
}
add_filter( 'optionsframework_menu', 'professor_options_menu_filter' );
/* Theme Options */

/* Metabox */
require_once(TEMPLATEPATH . '/inc/metabox/metabox-functions.php');
/* Metabox */

/* Remove Post Type Support */
add_action( 'init', 'my_remove_post_type_support', 10 );
function my_remove_post_type_support() {
    remove_post_type_support( 'page', 'thumbnail' );
    remove_post_type_support( 'page', 'custom-fields' );
    remove_post_type_support( 'page', 'author' );
    remove_post_type_support( 'post', 'custom-fields' );
    remove_post_type_support( 'post', 'author' );
    remove_post_type_support( 'post', 'excerpt' );
    remove_post_type_support( 'post', 'trackbacks' );
}
/* Remove Post Type Support */

/* Remove Page Fields */
function remove_page_fields() {
	remove_meta_box( 'slugdiv' , 'page' , 'normal' ); //removes slugdiv 
	remove_meta_box( 'slugdiv' , 'post' , 'normal' ); //removes slugdiv 
}
add_action( 'admin_menu' , 'remove_page_fields' );
/* Remove Page Fields */

// News Post Type
function custom_post_news() {
    $news_labels = array(
        'name'               => __( 'اخبار' ),
        'singular_name'      => __( 'خبر' ),
        'add_new'            => __( 'افزودن خبر جدید' ),
        'add_new_item'       => __( 'افزودن خبر جدید' ),
        'edit_item'          => __( 'ویرایش خبر' ),
        'new_item'           => __( 'دانلود خبر' ),
        'all_items'          => __( 'همه اخبار' ),
        'view_item'          => __( 'نمایش خبر' ),
        'search_items'       => __( 'جست‌و‌جو خبر' ),
        'not_found'          => __( 'خبری یافت نشد' ),
        'not_found_in_trash' => __( 'خبری در زباله دان یافت نشد' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'اخبار'
    );
    
    $news_args = array(
        'labels'        => $news_labels,
        'description'   => 'انتشار اخبار فعالیت ها',
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'   	=> 'dashicons-megaphone',
        'supports'      => array( 'title', 'editor', 'comments' ),
        'has_archive'   => true,
    );
    
    register_post_type( 'news', $news_args );
}
add_action( 'init', 'custom_post_news' );

function news_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['news'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( 'بخش اخبار بروز شد. <a href="%s">نمایش خبر</a>', esc_url( get_permalink($post_ID) ) ),
	2 => 'زمینه دلخواه خبر بروز شد',
	3 => 'زمینه دلخواه خبر حذف شد',
	4 => 'خبر بروز شد',
	5 => isset($_GET['revision']) ? sprintf( 'خبر بازگردانی شد از تغییر %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( 'خبر منتشر شد. <a href="%s">نمایش خبر</a>', esc_url( get_permalink($post_ID) ) ),
	7 => 'خبر ذخیره شد.',
	8 => sprintf( 'خبر ارسال شد. <a target="_blank" href="%s">پیش نمایش خبر</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( 'خبر برنامه‌ریزی شده برای: <strong>%1$s</strong>. <a target="_blank" href="%2$s">پیش نمایش خبر</a>',
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('پیش‌نویس خبر بروز شد. <a target="_blank" href="%s">پیش نمایش خبر</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'news_updated_messages' );
// News Post Type

// Library Post Type
function custom_post_library() {
    $library_labels = array(
        'name'               => __( 'کتابخانه' ),
        'singular_name'      => __( 'کتاب' ),
        'add_new'            => __( 'افزودن کتاب جدید' ),
        'add_new_item'       => __( 'افزودن کتاب جدید' ),
        'edit_item'          => __( 'ویرایش کتاب' ),
        'new_item'           => __( 'کتاب جدید' ),
        'all_items'          => __( 'همه کتاب ها' ),
        'view_item'          => __( 'نمایش کتاب' ),
        'search_items'       => __( 'جست‌و‌جو کتاب' ),
        'not_found'          => __( 'کتابی یافت نشد' ),
        'not_found_in_trash' => __( 'کتابی در زباله دان یافت نشد' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'کتابخانه'
    );
    
    $library_args = array(
        'labels'        => $library_labels,
        'description'   => 'قرار دادن کتاب جهت دانلود کاربران',
        'public'        => true,
        'menu_position' => 6,
        'menu_icon'   	=> 'dashicons-book-alt',
        'supports'      => array( 'title', 'thumbnail', 'comments' ),
        'has_archive'   => true,
    );
    
    register_post_type( 'library', $library_args );
}
add_action( 'init', 'custom_post_library' );

function library_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['library'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( 'بخش کتاب بروز شد. <a href="%s">نمایش کتاب</a>', esc_url( get_permalink($post_ID) ) ),
	2 => 'زمینه دلخواه کتاب بروز شد',
	3 => 'زمینه دلخواه کتاب حذف شد',
	4 => 'کتاب بروز شد',
	5 => isset($_GET['revision']) ? sprintf( 'کتاب بازگردانی شد از تغییر %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( 'کتاب منتشر شد. <a href="%s">نمایش کتاب</a>', esc_url( get_permalink($post_ID) ) ),
	7 => 'کتاب ذخیره شد.',
	8 => sprintf( 'کتاب ارسال شد. <a target="_blank" href="%s">پیش نمایش کتاب</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( 'کتاب برنامه‌ریزی شده برای: <strong>%1$s</strong>. <a target="_blank" href="%2$s">پیش نمایش کتاب</a>',
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('پیش‌نویس کتاب بروز شد. <a target="_blank" href="%s">پیش نمایش کتاب</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'library_updated_messages' );
// Library Post Type

// Edit Post Messages
function posts_updated_labels( $labels ) {

	$labels->name = 'مقالات';
	$labels->singular_name = 'مقاله';
	$labels->menu_name = 'مقالات';
	$labels->admin_bar_name = 'مقاله';
	$labels->add_new = 'افزودن مقاله جدید';
	$labels->add_new_item = 'افزودن مقاله جدید';
	$labels->edit_item = 'ویرایش مقابه';
	$labels->new_item = 'مقاله جدید';
	$labels->view_item = 'دیدن مقاله';
	$labels->search_items = 'جست‌و‌جو مقاله';
	$labels->not_found = 'مقاله ای یافت نشد';
	$labels->not_found_in_trash = 'مقاله ای در زباله دان یافت نشد';
	$labels->all_items = 'همه مقالات';

	return $labels;

}
add_filter( 'post_type_labels_post', 'posts_updated_labels' );

function posts_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['post'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( 'بخش مقالات بروز شد. <a href="%s">نمایش مقاله</a>', esc_url( get_permalink($post_ID) ) ),
	2 => 'زمینه دلخواه مقاله بروز شد',
	3 => 'زمینه دلخواه مقاله حذف شد',
	4 => 'مقاله بروز شد',
	5 => isset($_GET['revision']) ? sprintf( 'مقاله بازگردانی شد از تغییر %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( 'مقاله منتشر شد. <a href="%s">نمایش مقاله</a>', esc_url( get_permalink($post_ID) ) ),
	7 => 'مقاله ذخیره شد.',
	8 => sprintf( 'مقاله ارسال شد. <a target="_blank" href="%s">پیش نمایش مقاله</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( 'مقاله برنامه‌ریزی شده برای: <strong>%1$s</strong>. <a target="_blank" href="%2$s">پیش نمایش مقاله</a>',
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('پیش‌نویس مقاله بروز شد. <a target="_blank" href="%s">پیش نمایش مقاله</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'posts_updated_messages' );

add_action('init', 'rename_post_category');
function rename_post_category() {
    global $wp_taxonomies;

    $cat = $wp_taxonomies['category'];
    $cat->label = 'دسته های مقالات';
    $cat->labels->singular_name = 'دسته مقالات';
    $cat->labels->name = $cat->label;
    $cat->labels->menu_name = $cat->label;
}

add_action( 'init', 'rename_post_tag');
function rename_post_tag() {
    global $wp_taxonomies;
    $wp_taxonomies['post_tag']->labels = (object)array(
        'name' => 'کلمات کلیدی',
        'menu_name' => 'کلمات کلیدی',
        'singular_name' => 'کلمات کلیدی',
        'search_items' => 'جست‌و‌جو کلمات کلیدی',
        'popular_items' => 'کلمات کلیدی محبوب',
        'all_items' => 'همه کلمات کلیدی',
        'parent_item' => null, // Tags aren't hierarchical
        'parent_item_colon' => null,
        'edit_item' => 'ویرایش کلمه کلیدی',
        'update_item' => 'بروز رسانی کلمه کلیدی',
        'add_new_item' => 'افزودن کلمه کلیدی جدید',
        'new_item_name' => 'نام کلمه کلیدی جدید',
        'separate_items_with_commas' => 'کلمات کلیدی را با ویرگول لاتین (,) جدا کنید',
        'add_or_remove_items' => 'افزودن یا حذف کلملت کلیدی',
        'choose_from_most_used' => 'انتخاب از میان کلمات پر کاربرد',
    );

    $wp_taxonomies['post_tag']->label = 'کلمات کلیدی';
}

add_action( 'admin_menu', 'gowp_admin_menu' );
function gowp_admin_menu() {
  global $menu;
  foreach ( $menu as $key => $val ) {
    if ( __( 'مقالات') == $val[0] ) {
      $menu[$key][6] = 'dashicons-edit';
    }
  }
}
// Edit Post Messages

// Version
function remove_footer_admin () {
  echo 'طراحی و کدنویسی : <a href="https://mavenium.github.io/" title="طراحی حرفه ای انواع پرتال">Mavenium</a>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function change_footer_version() {
  return 'ß 2'; }
add_filter( 'update_footer', 'change_footer_version', 9999 );
// Version

// Theme Setup
function professor_setup() {
    add_theme_support( 'automatic-feed-links' );
    register_nav_menus( array ( 'primary' => ( 'منو اصلی' ) ) );
    add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'professor_setup' );
// Theme Setup

// Add To Menu
function add_search_to_wp_menu ( $items, $args ) {
	if( 'primary' === $args -> theme_location ) {
        $items .= '<li class="menu-item menu-item-search">';
        $items .= '<form id="search_box" method="get" class="menu-search-form" action="' . get_bloginfo('home') . '/"><input class="text_input" type="text" name="s" placeholder="جستجو ..." id="s"></form>';
        $items .= '</li>';
	}
return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);
// Add To Menu

// Professor Scripts
function professor_scripts() {
	wp_enqueue_style( 'professor-colorbox', get_template_directory_uri().'/css/colorbox.css', array(), '1.4.17');
	wp_enqueue_style( 'professor-font-awesome.min', get_template_directory_uri().'/css/font-awesome.min.css', array(), '4.3.0');
    wp_enqueue_style( 'professor', get_template_directory_uri().'/style.css', array(), '1.0');

	wp_enqueue_script( 'professor-colorbox', get_template_directory_uri().'/js/jquery.colorbox-min.js', array(), '1.4.17');
	wp_enqueue_script( 'professor-tooltip', get_template_directory_uri().'/js/tooltip.js', array(), '1.0.0');
	wp_enqueue_script( 'professor-functions', get_template_directory_uri().'/js/functions.js', array(), '1.0');
}
add_action( 'wp_enqueue_scripts', 'professor_scripts' );
// Professor Scripts

// WP Title
function html5reset_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

        //Add the site name.
		$title .= get_bloginfo( 'name' );

        //Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

        //Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'صفحه %s' ), max( $paged, $page ) );

		return $title;
	}
add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );
// WP Title

// Abzarak
if ( function_exists('register_sidebar') ) {
	register_sidebar( array (
		 'name' => 'ابزارک راست',
		 'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		 'after_widget' => '</aside>',
		 'before_title' => '<div class="widget-head"><h4 class="widget-title"><span>',
		 'after_title' => '</span></h4></div>'
	));
	
	register_sidebar( array (
		 'name' => 'ابزارک پایین',
		 'description'   => __( 'لطفاً دو ابزارک قرار دهید.' ),
		 'before_widget' => '<div class="col-md-6 col-sm-6"><aside id="%1$s" class="widget clearfix %2$s">',
		 'after_widget' => '</aside></div>',
		 'before_title' => '<div class="widget-head"><h4 class="widget-title"><span>',
		 'after_title' => '</span></h4></div>'
	));
}
// Abzarak

// unregister widgets
add_action( 'widgets_init', 'my_unregister_widgets' );
function my_unregister_widgets() {
	unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
}
// unregister widgets

// Limit Title
function ST ($text) { // Function name ShortenText
	$chars_limit = 45; // Character length
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));

	if ($chars_text > $chars_limit) {
		$text = $text . " . . .";
	}
	return $text;
}
// Limit Title

// Pagination
function professor_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<!-- Pagination --><ul class="pagination clearfix">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-angle-double-right fa-lg"></i>') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><a href="#">…</a></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><a href="#">…</a></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fa fa-angle-double-left fa-lg"></i>') );

	echo '</ul><!-- /Pagination -->' . "\n";

}
// Pagination

// Comment Layout
function norma_comment_layout($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>

    <!-- Comment-<?php comment_ID() ?> -->
    <section <?php comment_class('clearfix'); ?>>
        
        <?php echo get_avatar($comment, $size = '73'); ?>
        
        <div class="left-com">
            
            <div class="cm-part"></div>
            
            <div class="cm-info clearfix">
                
                <span class="cm-author">
                    <?php echo 'توسط :'; comment_author_link(); ?>
                </span>
                
                <span class="cm-reply">
                    <?php comment_reply_link(array_merge(array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </span>
                
                <span class="cm-date">
                    ( <?php comment_date('j / m / Y'); ?> )
                </span>
                                
            </div>            
            
            <div class="qa-message-content">
                
                <?php if ($comment->comment_approved == '0'): ?>
                <span style="color: #c30d0d;"><?php _e('با تشکر, دیدگاه شما در انتظار تایید است.'); ?></span>
                <?php endif; ?>

                <?php comment_text() ?>
            </div>
        
        </div>
        
    </section>
    <!-- /Comment-<?php comment_ID() ?> -->
		
<?php }
// Comment Layout

// Add Class To Attachment Images
function professor_images_class ($html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
  $classes = 'ajax'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  return $html;
}
add_filter('image_send_to_editor','professor_images_class',10,8);
// Add Class To Attachment Images

// RSS + Pic
function feedFilter($query) {
	if ($query->is_feed) {
		add_filter('the_content', 'feedContentFilter');
		}
	return $query;
}
add_filter('pre_get_posts','feedFilter');

function feedContentFilter($content) {
	$thumbId = get_post_thumbnail_id();

	if($thumbId) {
		$img = wp_get_attachment_image_src($thumbId);
		$image = '<img align="left" src="'. $img[0] .'" alt="" width="'. $img[1] .'" height="'. $img[2] .'" />';
		echo $image;
	}

	return $content;
}
// RSS + Pic

// Modiriyate Tags
function custom_tag_cloud_widget($args) {
	$args['number'] = 40; //adding a 0 will display all tags
	$args['largest'] = 14; //largest tag
	$args['smallest'] = 14; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );
// Modiriyate Tags

// Remove Image Sizes
function remove_image_sizes($image_sizes){
        foreach($image_sizes as $key => $size){
                if($size == 'large' || $size == 'medium')
                        unset($image_sizes[$key]);
        }
        return $image_sizes;
}
add_filter('intermediate_image_sizes', 'remove_image_sizes', 12, 1);
// Remove Image Sizes

function new_content_more($more) {
       global $post;
       return ' <a href="' . get_permalink() . "#more-{$post->ID}\" class=\"more button\">ادامه مطلب</a>";
}   
add_filter( 'the_content_more_link', 'new_content_more' );


// Menu Walk
class professor_Menu_Maker_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
 
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }
 
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
 
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
 
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
   
    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }
   
    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }
   
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
   
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
   
    $output .= $indent . '<li' . $id . $value . $class_names .'>';
   
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
   
    $item_output = $args->before;
      
    if ( ! empty( $item->attr_title ) )
        $item_output .= '<a'. $attributes .'><span class="menuicon fa fa-' . esc_attr( $item->attr_title ) . '"></span>&nbsp;<span>';
    else
        $item_output .= '<a'. $attributes .'><span>';      
    
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;
   
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
 
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}
// Menu Walk

// Emkanate Editor - 1
function add_more_buttons($buttons) {
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'styleselect';

	return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");
// Emkanate Editor - 1

add_filter('loop_shop_per_page', create_function('$cols', 'return 6;'));

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}

function woocommerce_output_related_products() {
    woocommerce_related_products(3,3);
}

?>