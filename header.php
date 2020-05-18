<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head data-template-set="professor-theme">

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<link rel="shortcut icon" href="<?php echo of_get_option( 'options_favicon' ); ?>" />
    
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
    
    <?php wp_enqueue_script("jquery"); ?>

	<?php wp_head(); ?>
	
</head>

<body dir="rtl" <?php body_class(); ?>>

    <!-- Master Sec -->
    <section id="master-sec" class="container">
        
        <div class="row">
            
            <!-- Right Sec -->
            <section id="right-sec" class="col-md-3 col-sm-4">
			
				<?php if ( of_get_option( 'option_logo_active' ) == 1 ) { ?>
				<!-- Logo -->
				<div id="logo">
					<img src="<?php echo of_get_option( 'options_logo' ); ?>" title="<?php bloginfo('description'); ?>" alt="<?php bloginfo('description'); ?>">
				</div>
				<!-- /Logo -->
				<?php } ?>
                
                <!-- Primary Menu -->
                <?php wp_nav_menu(array(
                    'menu'              => 'منو اصلی',
                    'theme_location'    => 'primary',
                    'container'         => 'nav',
                    'container_id'      => 'cssmenu',
                    'walker'            => new professor_Menu_Maker_Walker()
                )); ?>
                <!-- /Primary Menu -->
                
                <?php dynamic_sidebar (1); ?>
                
            </section>
            <!-- /Right Sec -->