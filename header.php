
<!-- 
* ====================
 *  @Package EFT Theme
 * ====================
 */
 -->

<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php
	 if (function_exists('is_tag') && is_tag()) {
			echo 'Tag Archive for &quot;'.$tag.'&quot; | '; 
	} 
	elseif (is_archive()) {
			 wp_title(''); echo ' category | '; 
	}
	 elseif (is_search()) {
		  echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
	}
	 elseif (!(is_404()) && (is_single()) || (is_page())) { 
		 wp_title(''); echo ' | '; 
	}
	elseif (is_404()) { echo 'Not Found | '; }
			 
	if (is_home()) {
				  bloginfo('name'); echo ' | '; bloginfo('description'); 
	} 
	else { 
		bloginfo('name');
	 }
				  
		 ?>
		 </title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Menu section -->
<header class="header-area">
	 <div class="header-section bg-black">
	 	<nav class="navbar navbar-expand-md navbar-dark bg-balck">
			 <div class="container">
				<a href="#" class="navbar-brand"><?php the_custom_logo(); ?> </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	 				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php
					$args= array(
						'theme_location' 	=> 	'primary_menu',
						'container'    		=> 	' ',
						'menu_class'		=>	'navbar-nav nav justify-content-end menu_nav',
						'walker'			=> 	new eft_Walker_Nav(),
					);
					 	wp_nav_menu( $args ); 
					 ?>
				</div>
			 </div>
		 </nav>
	 </div>
</header>