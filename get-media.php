<?php
/**
 * Manage post featured image
 *
 * ## EXAMPLES
 *
 * 	wp get-media get_featured 83 --return=id
 *	wp get-media get_featured 83 --return=url
 *
 *	wp get-media set_featured 83 2283
 *
 * @author Hugo Solar. <soy@hugo.solar>
 */
class Get_Media extends \WP_CLI_Command{

	/**
	 * Get feature image from a post
	 *
	 * @synopsis <id> [--return=<return>]
	 */
	public function get_featured( $args, $assoc_args ){

		list( $post_id ) = $args;

		if (!isset($post_id)) {
			WP_CLI::error('You mus specify the post ID');
		}

		if (!empty($assoc_args['return']) ) {
			$return = $assoc_args['return'];
		} else {
			$return = 'id';
		}
		$img = \wp_get_post_thumbnail_id( absint($post_id) );

		if ($return == 'url') {
			$img = \wp_get_attachment_url( $img );
		}
		if ( \is_wp_error( $img ) ) {
			WP_CLI::warning( $terms->get_error_message() );
		} else {
			WP_CLI::print_value( $img, $assoc_args );
		}
	}
	/**
	 * Get feature image from a post
	 *
	 * @synopsis <id> <attachment_id>
	 */
	public function set_featured($args, $assoc_args) {
		list( $post_id, $attachment_id ) = $args;

		if (!isset($post_id)) {
			WP_CLI::error('You mus specify the post ID');
		}
		if (!isset($attachment_id)) {
			WP_CLI::error('You mus specify the Attachment ID');
		}
		$img = \set_post_thumbnail( $post_id, $attachment_id );

		if ( \is_wp_error( $img ) ) {
			WP_CLI::warning( $terms->get_error_message() );
		} else {
			WP_CLI::print_value( $img, $assoc_args );
		}
	}

}

WP_CLI::add_command( 'get-media', 'Get_Media' );
