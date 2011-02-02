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
          #showpost('unstable');
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
      include("lifestream.php");
      lifestream("Blogs", $BlogFeeds);
      lifestream("Forum", $ForumFeeds);
      lifestream("Microblogging", $MicrobloggingFeeds );
      ?>
      <h3>Calligra around the web</h3>
      <ul>
      <?php
          wp_list_bookmarks('category=2&orderby=updated&categorize=0&title_li=');
      ?>
      </ul>
    </div>
  </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
