<?php
/**
 * Template Part: 'Pinned' Feature.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>
<div class="pair">
	<label for="t-o-pinned"><?php echo esc_html( 'Pin this post?' ); ?></label>
	<input type="checkbox" name="t-o-pinned" <?php echo ( $args['is_pinned'] ) ? esc_attr( 'checked' ) : ''; ?> />
</div>
