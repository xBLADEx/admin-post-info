<?php
/**
 * Plugin Name: Admin Post Info
 * Plugin URI: https://www.richedmunds.com
 * Description: Display url and other info about posts on overview screen.
 * Author: Rich Edmunds
 * Author URI: https://www.richedmunds.com
 * Text Domain: custom
 * Version: 1.0
 *
 * @package Custom
 */

function rich_edmunds_column( $columns ) {
	$columns['url']      = esc_html__( 'URL', 'custom' );
	$columns['template'] = esc_html__( 'Template', 'custom' );

	return $columns;
}

add_filter( 'manage_page_posts_columns', 'rich_edmunds_column', 10 );
add_filter( 'manage_post_posts_columns', 'rich_edmunds_column', 10 );

function rich_edmunds_add_column( $column_name, $post_id ) {
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

add_filter( 'manage_page_posts_custom_column', 'rich_edmunds_add_column', 10, 2 );
add_filter( 'manage_post_posts_custom_column', 'rich_edmunds_add_column', 10, 2 );

/* @todo Figure out sorting.
function rich_edmunds_sortable_column( $columns ) {
	$columns['template'] = 'custom_template';

	return $columns;
}

add_filter( 'manage_edit-page_sortable_columns', 'rich_edmunds_sortable_column' );
add_filter( 'manage_edit-post_sortable_columns', 'rich_edmunds_sortable_column' );

function rich_edmunds_sort_template( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$order_by = 'template' === $query->get( 'orderby' );

	if ( $order_by ) {
		$query->set( 'meta_key', 'custom_template' );
		$query->set( 'orderby', 'meta_value' );
	}
}

add_action( 'pre_get_posts', 'rich_edmunds_sort_template', 1 );
*/
