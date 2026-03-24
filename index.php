<?php
$page         = get_query_var( 'hoogah_page', '' );
$slug         = get_query_var( 'hoogah_slug', '' );
$template_dir = get_template_directory();
$template_uri = get_template_directory_uri();

$file_map = [
    ''             => 'index.html',
    'how-it-works' => 'how-it-works.html',
    'our-belief'   => 'our-belief.html',
    'use-cases'    => 'use-cases.html',
    'pricing'      => 'pricing.html',
    'book-demo'    => 'book-demo.html',
    'blog'         => 'blog.html',
    'homepage-v2'  => 'index-v2.html',
    'thank-you'    => 'thank-you.html',
    'event-organizers' => 'lp-event-organizers.html',
    'homepage-v3'  => 'index-v3.html',
    'lp-ads-organizers' => 'lp-ads-organizers.html',
    'privacy-policy' => 'privacy-policy.html',
    'terms-and-conditions' => 'terms-and-conditions.html',
];

// Handle blog post routes: /blog/{slug}
if ( $page === 'blog-post' && $slug ) {
    $safe_slug = sanitize_file_name( $slug );
    $html_file = 'blog/' . $safe_slug . '.html';
} else {
    $html_file = isset( $file_map[ $page ] ) ? $file_map[ $page ] : 'index.html';
}
$file_path  = $template_dir . '/' . $html_file;

if ( ! file_exists( $file_path ) ) {
    $file_path = $template_dir . '/index.html';
}

$content = file_get_contents( $file_path );

// Fix asset paths — point relative references to the theme directory
// Handle both root-level (href="css/") and blog-level (href="../css/") paths
$content = str_replace( 'href="../css/',      'href="'   . $template_uri . '/css/',      $content );
$content = str_replace( 'href="css/',         'href="'   . $template_uri . '/css/',      $content );
$content = str_replace( 'src="../js/',        'src="'    . $template_uri . '/js/',       $content );
$content = str_replace( 'src="js/',           'src="'    . $template_uri . '/js/',       $content );
$content = str_replace( 'href="../logo.png"', 'href="'   . $template_uri . '/logo.png"', $content );
$content = str_replace( 'href="logo.png"',    'href="'   . $template_uri . '/logo.png"', $content );
$content = str_replace( 'src="../logo.png"',  'src="'    . $template_uri . '/logo.png"', $content );
$content = str_replace( 'src="logo.png"',     'src="'    . $template_uri . '/logo.png"', $content );
$content = str_replace( 'src="../logo-white.png"', 'src="' . $template_uri . '/logo-white.png"', $content );
$content = str_replace( 'src="logo-white.png"',    'src="' . $template_uri . '/logo-white.png"', $content );
$content = preg_replace( '/src="\.\.\/(undraw_[^"]+)"/', 'src="' . $template_uri . '/$1"', $content );
$content = preg_replace( '/src="(undraw_[^"]+)"/',       'src="' . $template_uri . '/$1"', $content );
$content = str_replace( 'src="../images/',    'src="'    . $template_uri . '/images/',    $content );
$content = str_replace( 'src="images/',       'src="'    . $template_uri . '/images/',    $content );

// Rewrite internal navigation links to clean WordPress URLs
// Handle both root-level and ../relative paths from blog posts
$content = str_replace( 'href="../index.html"',        'href="/"',             $content );
$content = str_replace( 'href="index.html"',           'href="/"',             $content );
$content = str_replace( 'href="../how-it-works.html"', 'href="/how-it-works"', $content );
$content = str_replace( 'href="how-it-works.html"',    'href="/how-it-works"', $content );
$content = str_replace( 'href="../our-belief.html"',   'href="/our-belief"',   $content );
$content = str_replace( 'href="our-belief.html"',      'href="/our-belief"',   $content );
$content = str_replace( 'href="../use-cases.html"',    'href="/use-cases"',    $content );
$content = str_replace( 'href="use-cases.html"',       'href="/use-cases"',    $content );
$content = str_replace( 'href="../pricing.html"',      'href="/pricing"',      $content );
$content = str_replace( 'href="pricing.html"',         'href="/pricing"',      $content );
$content = str_replace( 'href="../book-demo.html"',    'href="/book-demo"',    $content );
$content = str_replace( 'href="book-demo.html"',       'href="/book-demo"',    $content );
$content = str_replace( 'href="../blog.html"',         'href="/blog"',         $content );
$content = str_replace( 'href="blog.html"',            'href="/blog"',         $content );
$content = str_replace( 'href="../thank-you.html"',    'href="/thank-you"',    $content );
$content = str_replace( 'href="thank-you.html"',       'href="/thank-you"',    $content );
$content = str_replace( 'href="../privacy-policy.html"', 'href="/privacy-policy"', $content );
$content = str_replace( 'href="privacy-policy.html"',    'href="/privacy-policy"', $content );
$content = str_replace( 'href="../terms-and-conditions.html"', 'href="/terms-and-conditions"', $content );
$content = str_replace( 'href="terms-and-conditions.html"',    'href="/terms-and-conditions"', $content );

// Rewrite blog post links from listing page: blog/slug.html -> /blog/slug
$content = preg_replace( '/href="blog\/([^"]+)\.html"/', 'href="/blog/$1"', $content );

echo $content;
