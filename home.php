<?php
get_header("home");
query_posts('posts_per_page=50');
?>

<div id="container">
  <div id="content" role="main">

    <div class="news">

      <h2>Announcements</h2>
      <?php
      function showpost($category)
      {
          rewind_posts();
          while (have_posts()) :
              the_post();
              # if the post is in the category we want to exclude from the startpage but should show up in the category archives, we just skip to the next post.
              if (!in_category($category)) continue; ?>

              <div class="post" id="post-<?php the_ID(); ?>">
                  <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                  <div class="entry-meta"><?php the_time('F jS, Y') ?></div>

                  <div class="entry">
                      <?php the_excerpt('Read the rest of this entry &raquo;'); ?>
                  </div>
              </div>
              <?php
              break;
          endwhile;
      }
      ?>
      <?php
          showpost('stable');
      //         showpost('unstable');
      //         showpost('freoffice');
      ?>

      <div class="navigation">
              <div class="alignleft">Read <a href="announcements">more announcements</a></div>
      </div>

      <h2 style="margin-top:40px;">News</h2>
      <?php
      rewind_posts();
      if (have_posts()) :
          $counter = 0;
          while (have_posts()) :
              the_post();
              # if the post is in the category we want to exclude from the startpage but should show up in the category archives, we just skip to the next post. -->       
              if (!in_category('news') && !has_tag('frontpage') ) continue;
              if (in_category("announcements")) continue;
              ?>
              <div class="post" id="post-<?php the_ID(); ?>">
                  <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                  <div class="entry-meta"><?php the_time('F jS, Y') ?></div>

                  <div class="entry">
                      <?php the_excerpt('Read the rest of this entry &raquo;'); ?>
                  </div>

              </div>
              <?php
              $counter += 1;
              if ($counter > 5) break;
          endwhile; ?>

          <div class="navigation">
                  <div class="alignleft">Read <a href="news">more news</a></div>
          </div>

      <?php else : ?>

          <h2 class="center">Not Found</h2>
          <p class="center">Sorry, but you are looking for something that isn't here.</p>
          <?php include (TEMPLATEPATH . "/searchform.php"); ?>

      <?php endif; ?>
    </div>

    <div class="lifestream">

      <h2>Life stream</h2>
      <?php
      require_once (ABSPATH . WPINC . '/class-feed.php');
      include_once(ABSPATH . WPINC . '/feed.php');
      add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
      function lifestream($name, $urls)
      {
          echo("<h3>$name</h3>");
          // Get RSS Feed(s)
          // Get a SimplePie feed object from the specified feed source.
          $rsses = array();
          foreach ( $urls as $url ) :
              $rss = fetch_feed($url);
              if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
                  $rsses[] = $rss;
              endif;
          endforeach;
          // Build an array of all the items, starting with element 0 (first element), but limit it to 5
          $rss_items = SimplePie::merge_items($rsses, 0, 5);
          ?>

          <ul>
              <?php
              // Loop through each feed item and display each item as a hyperlink.
              foreach ( $rss_items as $item ) : ?>
              <li>
                  <a href='<?php echo $item->get_permalink(); ?>'
                  title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
                  <?php echo $item->get_title(); ?></a>
              </li>
              <?php endforeach; ?>
          </ul>
      <?php
      }
      lifestream("Blogs", array( 'http://www.koffice.org/category/blogs/feed/', // KOffice developers
                                  'http://blog.cberger.net/category/open-source/koffice/feed/', // Cyrille Berger
                                  'http://www.valdyas.org/fading/index.cgi/index.rss', // Boudewijn Rempt
                                  'http://celarek.at/category/kde/feed/', // Adam
                                  'http://carloslicea.blogspot.com/search/label/koffice', // Carlos Licea
                                  'http://www.kdedevelopers.org/blog/1236/feed', // Casper Boemann
                                  'http://en.munknex.net/feeds/posts/default/-/KDE', // Cyril Oblikov
                                  'http://dimula73.blogspot.com/feeds/posts/default/-/KDE', // Dmitry Kazakov
                                  'http://estan.dose.se/tag/planetkde/feed', // Elvis Stansvik
                                  'http://fyanardi.wordpress.com/category/koffice/feed/?mrss=off', // Fredy Yanardi
                                  'http://ingwa2.blogspot.com/atom.xml', // Inge Wallin
                                  'http://www.kdedevelopers.org/blog/104/feed', // Jarosław Staniek
                                  'http://blog.ben2367.fr/category/kde/koffice/feed/?mrss=off', // Benjamin Port
                                  'http://www.kdedevelopers.org/blog/268/feed', // Jos van den Oever
                                  'http://lukast.mediablog.sk/log/?feed=rss2', // Lukas Tvrdy
                                  'http://www.kdedevelopers.org/blog/7783/feed', // Marc Pegon
                                  'http://www.kdedevelopers.org/blog/2892/feed', // Marijn Kruisselbrink
                                  'http://ramblingsofpsn.blogspot.com/feeds/posts/default', // Peter Simonsson
                                  'http://pinaraf.blogspot.com/rss.xml', // Pierre Ducroquet
                                  'http://slangkamp.wordpress.com/tag/koffice/feed/?mrss=off' // Sven Langkamp
                                  ) );
      lifestream("Forum", array( 'http://forum.kde.org/smartfeed.php?forum=96&limit=NO_LIMIT&count_limit=10&sort_by=standard&feed_type=ATOM1.0&feed_style=COMPACT' ) );
      lifestream("Microblogging", array( 'http://identi.ca/api/statusnet/groups/timeline/1921.atom',
                                          'http://identi.ca/api/statuses/user_timeline/115013.atom' ) );
      ?>
      <h3>KOffice around the web</h3>
      <ul>
      <?php
          wp_list_bookmarks('category=2&orderby=updated&categorize=0&title_li=');
      ?>
      </ul>
    </div>
  </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
