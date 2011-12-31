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

  $banner_class = "";
  $secondary_menu = "";
  
  if(is_home()):
   $banner_class = "home_beta";
  elseif(is_page("learn-more") or is_page("homebeta")):
#    $banner_class = "image";
#    $banner_img   = "banner_calligra-2.4-beta.png";
    $banner_class = "appsmatrix";
  elseif(has_ancestor("words")):
    $banner_class = "words";
    $secondary_menu = "words";
  elseif(has_ancestor("stage")):
    $banner_class = "stage";
    $secondary_menu = "stage";
  elseif(has_ancestor("tables")):
    $banner_class = "tables";
    $secondary_menu = "tables";
  elseif(has_ancestor("kexi")):
    $banner_class = "kexi";
    $secondary_menu = "kexi";
  elseif(has_ancestor("flow")):
    $banner_class = "flow";
    $secondary_menu = "";
  elseif(has_ancestor("plan")):
    $banner_class = "plan";
    $secondary_menu = "";
  elseif(has_ancestor("karbon")):
    $banner_class = "karbon";
    $secondary_menu = "karbon";
  elseif(has_ancestor("krita")):
    $banner_class = "krita";
  elseif(has_ancestor("mobile")):
    $banner_class = "mobile";
  elseif(has_ancestor("braindump")):
    $banner_class = "braindump";
  elseif(has_ancestor("contribute")):
    $banner_class = "contribute";
  elseif(has_ancestor("get-calligra")):
    $banner_class = "getcalligra";
  elseif(has_ancestor("get-help")):
    $banner_class = "gethelp";
  elseif(is_archive() or is_single()):
    $banner_class = "archive";
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
	<?php
	  add_filter( 'nav_menu_css_class', 'fix_main_menu_class', 10, 2);
	?>
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

        <div class="banner banner_image_<?php echo $banner_class; ?>">
          <?php if ($banner_class == "appsmatrix" or $banner_class == "home_appsmatrix"): ?>
          <?php include('banner_appsmatrix.php') ?>
          <?php else: ?>
          <div class="banner_<?php echo $banner_class ?>">
            <?php if ($banner_class == 'words'): ?>
            <strong>Calligra Words</strong> is an intuitive word processor application with desktop publishing features. With it, you can create informative and attractive documents with ease.
            <?php elseif ($banner_class == 'stage'): ?>
            <strong>Calligra Stage</strong> is a powerful and easy to use presentation application.
            <br />
            You can dazzle your audience with stunning slides containing images, videos, animation and more.
            <?php elseif ($banner_class == 'tables'): ?>
            <strong>Calligra Tables</strong> is a fully-featured spreadsheet application. Use it to quickly create spreadsheets with formulas and charts, to calculate and organize your data.
            <?php elseif ($banner_class == 'kexi'): ?>
            <strong>Kexi</strong> for integrated data management
            <?php elseif ($banner_class == 'flow'): ?>
            <strong>Calligra Flow</strong> for diagramming and flowcharting
            <?php elseif ($banner_class == 'plan'): ?>
            <strong>Calligra Plan</strong> for project planning
            <?php elseif ($banner_class == 'karbon'): ?>
            <strong>Karbon</strong> for drawing vector graphics
            <?php elseif ($banner_class == 'krita'): ?>
            <strong>Krita</strong> for painting and drawing
            <?php elseif ($banner_class == 'braindump'): ?>
            <strong>Braindump</strong> for storing your ideas
            <?php elseif ($banner_class == 'mobile'): ?>
            Take <strong>Calligra</strong> in your poket
            <?php elseif ($banner_class == 'contribute'): ?>
            <strong>Contribute</strong> to a vibrant and dynamic <strong>community</strong> with code, documentation, translation, artwork...
            <?php elseif ($banner_class == 'getcalligra'): ?>
            <strong>Calligra Suite</strong> is distributed as source code, but various other projects deliver binary packages.
            <?php elseif ($banner_class == 'gethelp'): ?>
            <strong>Get help</strong> for <strong>Calligra</strong> applications using IRC, forums or wiki
            <?php elseif ($banner_class == 'archive'): ?>
            <strong>Archive</strong> or <strong>news</strong> related to <strong>Calligra</strong>
            <?php elseif ($banner_class == 'home_image' or $banner_class == 'image'): ?>
              <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banners/<?php echo $banner_img; ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
            <?php elseif ($banner_class == 'home_beta'): ?>
              <?php include('banner_beta.php') ?>          
            <?php endif ?>
          </div>
          <?php endif ?>
        </div>
        
			</div><!-- #branding -->
      <!-- Show secondary menu -->
      <?php
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
