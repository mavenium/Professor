<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'professor';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// Number
	$number_array = array(
		'1' => 'یک',
		'2' => 'دو',
		'3' => 'سه',
		'4' => 'چهار',
		'5' => 'پنج',
        '6' => 'شش',
        '7' => 'هفت',
        '8' => 'هشت',
        '9' => 'نه',
        '10' => 'ده'
	);
    // Number
	
	// Even Number
	$even_number_array = array(
		'2' => 'دو',
		'4' => 'چهار',
        '6' => 'شش',
        '8' => 'هشت',
        '10' => 'ده'
	);
    // Even Number

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

    // Basic Settings
	$options[] = array(
		'name' => 'تنظیمات پایه',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => 'فاوآیکن (Favicon)',
		'desc' => 'بارگذاری فاوآیکن وب سایت در اندازه 16*16',
		'id'   => 'options_favicon',
        'std'  => $imagepath . 'favicon.png',
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => 'فعال کردن نماد وب سایت',
		'desc' => 'آیا نماد وب سایت فعال باشد ؟',
		'id'   => 'option_logo_active',
		'type' => 'checkbox'
	);
    
	$options[] = array(
		'name' => 'نماد وب سایت (Logo)',
		'desc' => 'بارگذاری نماد وب سایت در اندازه 210*210',
		'id'   => 'options_logo',
        'std'  => $imagepath . 'logo.png',
		'class' => 'hidden',
		'type' => 'upload'
	);
    
	$options[] = array(
		'name' => 'حق تآلیف (Copyright)',
		'desc' => 'نوشتن محتوا حق تآلیف وب سایت.',
		'id' => 'options_copyright',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);
    // Basic Settings
    
    // Advanced Settings
	$options[] = array(
		'name' => 'تنظیمات پیشرفته',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => 'فعال کردن اسلایدر',
		'desc' => 'اسلایدر در صفحه اصلی فعال باشد ؟',
		'id' => 'option_slider',
		'std' => 'active',
		'type' => 'radio',
        'options' => array(
            'active' => 'بله',
            'dactive' => 'خیر'
            )
	);
	
	$options[] = array(
		'name' => 'فعال کردن بخش کتابخانه',
		'desc' => 'آیا بخش کتابخانه در صفحه اصلی فعال باشد ؟',
		'id'   => 'option_books_active',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => 'عنوان بخش کتابخانه',
		'desc' => 'عنوان بخش کتابخانه در صفحه اصلی را وارد کنید.',
		'id' => 'option_books_title',
		'std' => 'آخرین های کتابخانه',
		'class' => 'hidden',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'تعداد کتاب ها',
		'desc' => 'تعداد کتاب های قابل نمایش در صفحه اصلی.',
		'id' => 'option_books_number',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini hidden', //mini, tiny, small
		'options' => $number_array
	);
	
	$options[] = array(
		'name' => 'فعال کردن بخش آخرین اخبار',
		'desc' => 'آیا بخش آخرین اخباردر صفحه اصلی فعال باشد ؟',
		'id'   => 'option_news_active',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => 'عنوان بخش آخرین اخبار',
		'desc' => 'عنوان بخش آخرین اخبار در صفحه اصلی را وارد کنید.',
		'id' => 'option_news_title',
		'std' => 'آخرین اخبار',
		'class' => 'hidden',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'تعداد خبرها',
		'desc' => 'تعداد خبرهای قابل نمایش در صفحه اصلی.',
		'id' => 'option_news_number',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini hidden', //mini, tiny, small
		'options' => $number_array
	);
	
	$options[] = array(
		'name' => 'تعداد جعبه های مقالات',
		'desc' => 'تعداد جعبه های نمایش دهنده مقالات در صفحه اصلی.',
		'id' => 'option_box_number',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $number_array
	);
	
	for ($i=1 ; $i <= of_get_option ( 'option_box_number' ) ; $i++) {
	
		$options[] = array(
			'name' => 'عنوان جعبه آخرین مقالات '.$i,
			'desc' => 'عنوان جعبه شماره '.$i.' آخرین مقالات در صفحه اصلی را وارد کنید.',
			'id' => 'option_post_title'.$i,
			'std' => 'آخرین مقالات '.$i,
			'type' => 'text'
		);
		
		$options[] = array(
			'name' => 'تعداد مقاله ها در جعبه شماره '.$i,
			'desc' => 'تعداد مقاله های قابل نمایش در جعبه شماره '.$i.' را وارد کنید.',
			'id' => 'option_post_number'.$i,
			'std' => '4',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $even_number_array
		);
		
		if ( $options_categories ) {
			$options[] = array(
				'name' => 'دسته مقالات برای جعبه شماره '.$i,
				'desc' => 'انتخاب دسته برای نمایش مقالات در جعبه شماره '.$i,
				'id' => 'options_post_cat'.$i,
				'type' => 'select',
				'options' => $options_categories
			);
		}
	
	}
    // Advanced Settings

	return $options;
}