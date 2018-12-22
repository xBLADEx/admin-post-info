<?php
/**
 * Plugin Name: Admin Post Info
 * Description: Display the page or post relative URL and template.
 * Author: Rich Edmunds
 * Author URI: https://www.richedmunds.com
 * Text Domain: custom
 * Version: 1.0
 *
 * @package Custom
 */

function rich_edmunds_api_column( $columns ) {
	$columns['url']      = esc_html__( 'URL', 'custom' );
	$columns['template'] = esc_html__( 'Template', 'custom' );

	return $columns;
}

add_filter( 'manage_page_posts_columns', 'rich_edmunds_api_column', 10 );
add_filter( 'manage_post_posts_columns', 'rich_edmunds_api_column', 10 );

function rich_edmunds_api_add_column( $column_name, $post_id ) {
	if ( 'url' === $column_name ) {
		echo esc_html( wp_make_link_relative( get_permalink( $post_id ) ) );
	}

	if ( 'template' === $column_name ) {
		$page_template = basename( get_page_template() );

		if ( 'page.php' !== $page_template ) {
			echo esc_html( $page_template );
		}
	}
}

add_filter( 'manage_page_posts_custom_column', 'rich_edmunds_api_add_column', 10, 2 );
add_filter( 'manage_post_posts_custom_column', 'rich_edmunds_api_add_column', 10, 2 );
