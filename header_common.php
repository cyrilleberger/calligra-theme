<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();

  $banner_image = "";
  $secondary_menu = "";
  
  if(is_home()):
    $banner_image = "appsmatrix.png";
  elseif(has_ancestor("kpresenter")):
    $banner_image = "kpresenter.png";
    $secondary_menu = "kpresenter";
  endif
  

?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
      <div id="access" role="navigation">
        <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
        <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <div class="menu-header">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/buttonright.png" />
          <?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'theme_location' => 'primary' ) ); ?>
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/buttonleft.png" />
        </div>
      </div><!-- #access -->
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>

        <div class="<?php echo $banner_class; ?>">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banners/<?php echo $banner_image;
          ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
        </div>
        
			</div><!-- #branding -->
      <!-- Show secondary menu -->
      <?php
        
        if(has_ancestor("kpresenter"))
        
        if($secondary_menu != ""):
      ?>
      <div id="access" role="navigation" style="margin-top:-25px">
        <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
        <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
        <div class="menu-header">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/buttonright.png" />
          <?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'theme_location' => 'primary', 'menu' => $secondary_menu ) ); ?>
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/buttonleft.png" />
        </div>
      </div><!-- #access -->
      <?php
        endif
      ?>

		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
