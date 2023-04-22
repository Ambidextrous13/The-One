<?php
/**
 * Search Form.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>

<form role="search" class="search-form" method="get" id="site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<span class="screen-reader-text"><?php esc_html_e( 'Search box', 'the-one' ); ?> </span>
		<input class="input-text" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Search here..', 'placeholder', 'the-one' ); ?>" type="search" value="<?php get_search_query(); ?>" />
		<input id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'the-one' ); ?>" type="submit">
	</div>
</form>
