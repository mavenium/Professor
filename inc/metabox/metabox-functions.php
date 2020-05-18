<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'professor_';

	// Meta Box - Library
	$meta_boxes['library_metabox'] = array(
		'id'         => 'library_metabox',
		'title'      => 'مشخصات کتاب',
		'pages'      => array( 'library', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => 'بارگذاری کتاب',
				'desc' => 'اگر کتاب شما رایگان است لطفا آن را بارگذاری کنید یا آدرس فایل آن را وارد کنید.',
				'id'   => $prefix . 'lib_file',
				'type' => 'file',
			),
			array(
				'name' => 'نویسنده',
				'desc' => 'نویسنده کتاب را وارد کنید.',
				'id'   => $prefix . 'lib_author',
				'type' => 'text_medium',
			),
			array(
				'name' => 'مترجم',
				'desc' => 'مترجم کتاب را وارد کنید.',
				'id'   => $prefix . 'lib_translators',
				'type' => 'text_medium',
			),
			array(
				'name' => 'ناشر',
				'desc' => 'ناشر کتاب را وارد کنید.',
				'id'   => $prefix . 'lib_publisher',
				'type' => 'text_medium',
			),
			array(
				'name' => 'تاریخ چاپ',
				'desc' => 'تاریخ چاپ کتاب را وارد کنید.',
				'id'   => $prefix . 'lib_pdate',
				'type' => 'text_date',
			),
			array(
				'name' => 'شابک',
				'desc' => 'شابک کتاب را وارد کنید.',
				'id'   => $prefix . 'lib_shabak',
				'type' => 'text_medium',
			),
			array(
				'name'    => 'توضیحات',
				'desc'    => 'توضیحاتی پیرامون این کتاب.',
				'id'      => $prefix . 'lib_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
			),
		),
	);
	// Meta Box - Library

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
