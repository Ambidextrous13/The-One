<?php
/**
 * Single post page handler.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

	get_header( null, [ 'header_text' => 'POST' ] );

	get_template_part( 'template-parts/post/single-post' );

	get_footer();

