<?php
require('vendor/autoload.php');

use oldspice\Product;

$p = new Product();
$products = $p -> getProdcuts();

//twig
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment( $loader );
//loead the template
$template = $twig -> load( 'home.twig' );
//output the template to page
echo $template -> render([
    'products' => $products,
    'title' => 'Home Page'
]);

?>