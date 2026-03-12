<?php
$page         = get_query_var( 'hoogah_page', '' );
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
];

$html_file = isset( $file_map[ $page ] ) ? $file_map[ $page ] : 'index.html';
$file_path  = $template_dir . '/' . $html_file;

if ( ! file_exists( $file_path ) ) {
    $file_path = $template_dir . '/index.html';
}

$content = file_get_contents( $file_path );

// Fix asset paths — point relative references to the theme directory
$content = str_replace( 'href="css/',      'href="'   . $template_uri . '/css/',      $content );
$content = str_replace( 'src="js/',        'src="'    . $template_uri . '/js/',       $content );
$content = str_replace( 'href="logo.png"', 'href="'   . $template_uri . '/logo.png"', $content );
$content = str_replace( 'src="logo.png"',  'src="'    . $template_uri . '/logo.png"', $content );
$content = str_replace( 'src="logo-white.png"', 'src="' . $template_uri . '/logo-white.png"', $content );
$content = preg_replace( '/src="(undraw_[^"]+)"/', 'src="' . $template_uri . '/$1"', $content );
$content = str_replace( 'src="images/',    'src="'    . $template_uri . '/images/',    $content );

// Rewrite internal navigation links to clean WordPress URLs
$content = str_replace( 'href="index.html"',        'href="/"',             $content );
$content = str_replace( 'href="how-it-works.html"', 'href="/how-it-works"', $content );
$content = str_replace( 'href="our-belief.html"',   'href="/our-belief"',   $content );
$content = str_replace( 'href="use-cases.html"',    'href="/use-cases"',    $content );
$content = str_replace( 'href="pricing.html"',      'href="/pricing"',      $content );
$content = str_replace( 'href="book-demo.html"',    'href="/book-demo"',    $content );
$content = str_replace( 'href="blog.html"',         'href="/blog"',         $content );
$content = str_replace( 'href="thank-you.html"',    'href="/thank-you"',    $content );

echo $content;
