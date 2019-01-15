<?php
/**
 * Template Name: Before Checkout School Food Handler
 *
 */
 
$product_id = $_GET['productID'];


global $woocommerce;
$woocommerce->cart->empty_cart();
$woocommerce->cart->add_to_cart( $product_id );


 header('Location: '.site_url().'/checkout-food-handler-card/');
