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
        $rss_items = SimplePie::merge_items($rsses, 0, 8);
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
    $BlogFeeds = array( 'http://www.calligra-suite.org/category/blogs/feed/', // Calligra developers
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
                        'http://slangkamp.wordpress.com/tag/koffice/feed/?mrss=off', // Sven Langkamp
			'http://frinring.wordpress.com/category/calligra/feed/?mrss=off&category_name=calligra', # Friedrich Kossebau
                        'http://kath-leinir.blogspot.com/feeds/posts/default?alt=rss&category=calligra' # Leinir
                        );
    
    $ForumFeeds = array(
                        'http://forum.kde.org/smartfeed.php?forum=203&limit=NO_LIMIT&count_limit=10&sort_by=standard&feed_type=ATOM1.0&feed_style=COMPACT' );
    
    $MicrobloggingFeeds = array( 'http://identi.ca/api/statusnet/groups/timeline/1921.atom',
                                 'http://identi.ca/api/statuses/user_timeline/115013.atom',
                                 'http://identi.ca/api/statusnet/groups/timeline/22924.atom' );

?>
