<?php

/**
 * Functions.php
 *
 * @package  Musician_Woocommerce
 * @author   Michael Esch
 * @since    1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/*********************************
 * Products / Bootstrap Cards -- Begin
 */

function musician_woocommerce_before_shop_loop_item()
{
	echo '<div class="card bg-light text-dark">';
}

function musician_woocommerce_after_shop_loop_item()
{
	echo '</div>';
}

function musician_woocommerce_before_shop_loop_item_title()
{
	global $product;
	$link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

	echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
	echo $product->get_image('woocommerce_thumbnail', array('class' => 'card-img-top'));
	echo '</a>';
}

function musician_woocommerce_shop_loop_item_title()
{
	global $product;
	$link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
	$link = esc_url($link);
	$title_text = $product->get_title();
	$item_title = <<<END
	<div class="card-header">
	<a href="$link">
	<h5 class="card-title display-6">$title_text</h5>
	</a>
	</div>
	<div class="card-body">	

	END;
	echo $item_title;
}

function musician_woocommerce_after_shop_loop_item_title()
{
	global $product;
	// echo '</div>';
	$price = $product->get_price_html();
	$url = $product->add_to_cart_url();
	$add_to_cart = $product->add_to_cart_text();

	$card_body = <<<END
	<div class='container'>
		<div class="row">
			<div class="col d-flex justify-content-center align-items-center">
				<div class='card-text'>$price</div>
			</div>
			<div class="col">
				<a href='$url' class='btn btn-primary'>$add_to_cart</a>
			</div>
		</div>
	</div></div>
	END;
	echo $card_body;
}


add_action('woocommerce_before_shop_loop_item_title', 'musician_woocommerce_before_shop_loop_item_title', 5);
add_action('woocommerce_after_shop_loop_item', 'musician_woocommerce_after_shop_loop_item', 50);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_before_shop_loop_item', 'musician_woocommerce_before_shop_loop_item', 5);
add_action('woocommerce_shop_loop_item_title', 'musician_woocommerce_shop_loop_item_title', 5, 1);
add_action('woocommerce_after_shop_loop_item_title', 'musician_woocommerce_after_shop_loop_item_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

/*********************************
 * Products / Bootstrap Cards -- END
 */


function musician_woocommerce_before_cart() {
	echo "<div class='musician-cart'>";
}
function musician_woocommerce_after_cart() {
	echo "</div>";
}

function musician_woocommerce_cart_totals_before_order_total() {
	echo "<div class='musician-cart-totals'>";
}

function musician_woocommerce_cart_totals_after_order_total() {
	echo "</div>";

}

add_action('woocommerce_after_cart', 'musician_woocommerce_after_cart', 50);
add_action('woocommerce_before_cart', 'musician_woocommerce_before_cart', 5);
add_action('woocommerce_cart_totals_before_order_total', 'musician_woocommerce_cart_totals_before_order_total', 5);
add_action('woocommerce_cart_totals_after_order_total', 'musician_woocommerce_cart_totals_after_order_total', 50);