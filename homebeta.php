<?php
/*
Template Name: homebeta
*/
?>

<?php
get_header();
query_posts('posts_per_page=50');
?>

<div id="container">
  <div id="content" role="main">
    <div class="introductionbeta">
    <p>
      Calligra aims to deliveer a suite of applications and technologies for Office applications (texts, spreadsheets, presentations, plans, flowcharts, databases...) and Creative applications (vectors, images).
    </p>
    <div class="navigation">
      <div class="alignright"><a href="learn-more">Learn more</a></div>
    </div>
    </div>
    <div class="newsbeta">

      <h3>Announcements</h3>
      <?php
      function showpost($category)
      {
          rewind_posts();
          while (have_posts()) :
              the_post();
              # if the post is in the category we want to exclude from the startpage but should show up in the category archives, we just skip to the next post.
              if (!in_category($category)) continue; ?>

              <div class="post" id="post-<?php the_ID(); ?>">
                  <h3 class="small-entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                  <div style="text-align: right"><div class="entry-meta"><?php the_time('F jS, Y') ?></div></div>
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
              <div class="alignright">Read <a href="announcements">more announcements</a></div>
      </div>

      <h3 style="margin-top:20px;">News</h3>
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
                  <h3 class="small-entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                  <div class="text-align: right"><div class="entry-meta"><?php the_time('F jS, Y') ?></div></div>

              </div>
              <?php
              $counter += 1;
              if ($counter > 2) break;
          endwhile; ?>

          <div class="navigation">
                  <div class="alignright">Read <a href="news">more news</a></div>
          </div>

      <?php else : ?>

          <h2 class="center">Not Found</h2>
          <p class="center">Sorry, but you are looking for something that isn't here.</p>
          <?php include (TEMPLATEPATH . "/searchform.php"); ?>

      <?php endif; ?>
    </div>

    <div class="lifestreambeta">
      <?php
      include("lifestream.php");
      lifestream("Life stream", $BlogFeeds + $ForumFeeds + $MicrobloggingFeeds );
      ?>
    </div>
  </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
