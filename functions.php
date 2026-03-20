<?php
/**
 * Hoogah Theme – registers clean URL routes for each static HTML page.
 * After deploying, go to WP Admin → Settings → Permalinks → Save Changes
 * to flush the rewrite rules so these routes activate.
 */

function hoogah_rewrite_rules() {
    add_rewrite_rule( '^how-it-works/?$', 'index.php?hoogah_page=how-it-works', 'top' );
    add_rewrite_rule( '^our-belief/?$',   'index.php?hoogah_page=our-belief',   'top' );
    add_rewrite_rule( '^use-cases/?$',    'index.php?hoogah_page=use-cases',    'top' );
    add_rewrite_rule( '^pricing/?$',      'index.php?hoogah_page=pricing',      'top' );
    add_rewrite_rule( '^book-demo/?$',    'index.php?hoogah_page=book-demo',    'top' );
    add_rewrite_rule( '^blog/?$',         'index.php?hoogah_page=blog',         'top' );
    add_rewrite_rule( '^blog/([^/]+)/?$', 'index.php?hoogah_page=blog-post&hoogah_slug=$matches[1]', 'top' );
    add_rewrite_rule( '^homepage-v2/?$',  'index.php?hoogah_page=homepage-v2',  'top' );
    add_rewrite_rule( '^thank-you/?$',   'index.php?hoogah_page=thank-you',   'top' );
    add_rewrite_rule( '^event-organizers/?$', 'index.php?hoogah_page=event-organizers', 'top' );
    add_rewrite_rule( '^homepage-v3/?$',  'index.php?hoogah_page=homepage-v3',  'top' );
    add_rewrite_rule( '^lp-ads-organizers/?$', 'index.php?hoogah_page=lp-ads-organizers', 'top' );
}
add_action( 'init', 'hoogah_rewrite_rules' );

function hoogah_query_vars( $vars ) {
    $vars[] = 'hoogah_page';
    $vars[] = 'hoogah_slug';
    return $vars;
}
add_filter( 'query_vars', 'hoogah_query_vars' );
