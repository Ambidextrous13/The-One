<?php
    
?>
<div class="pair">
    <label for="t-o-pinned"><?php _e( 'Pin this post?', 'the-one' ); ?></label>
    <input type="checkbox" name="t-o-pinned" <?php echo ( $args[ 'is_pinned' ] ) ? esc_attr( 'checked' ) : '' ;?>>
</div>