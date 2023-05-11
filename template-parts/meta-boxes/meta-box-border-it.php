<?php
/**
 * Template Part: Box Border Feature.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>

<div class="cmb-pair"> 
	<label id="cmb-label" for="toggle"><?php esc_html_e( 'Feature Image Border', 'the-one' ); ?></label>
	<div id="cmb-slider" class="cmb-slider">
		<div id="cmb-i-r" class="cmb-inner-runner cmb-temp-off"></div>
		<input type="checkbox" name="t-o-p-b-checkbox" id="cmb-toggle" <?php echo 'on' === $args['checkbox'] ? esc_html_e( 'checked', 'the-one' ) : ''; ?>> <!--t-o-p-b === the one post border   -->
	</div>
</div>

<div id="cmb-hidable" class="cmb-hidable cmb-form">
	<div class="cmb-pair">
		<label for="thickness"><?php esc_html_e( 'Thickness( in pixels )', 'the-one' ); ?></label>
		<input type="text" name="t-o-p-b-thickness" id="cmb-thickness" placeholder="in pixels" value = "<?php echo esc_attr( $args['thickness'] ); ?>">
	</div>

	<div class="cmb-pair">
		<label for="color"><?php esc_html_e( 'Color', 'the-one' ); ?></label>
		<input type="color" name="t-o-p-b-color" id="cmb-color" value = "<?php echo esc_attr( $args['color'] ); ?>">
	</div>

	<div class="cmb-pair">
		<label for="padding"><?php esc_html_e( 'Padding ( in pixels )', 'the-one' ); ?></label>
		<input type="padding" name="t-o-p-b-padding" id="cmb-padding" value="<?php echo esc_attr( $args['padding'] ); ?>">
	</div>

	<div class="cmb-pair">
		<label for="pattern"><?php esc_html_e( 'Pattern', 'the-one' ); ?></label>
		<select name="t-o-p-b-pattern" id="cmb-pattern">
			<option <?php selected( $args['pattern'], 'dotted' ); ?> value = "dotted"> <?php esc_html_e( 'Dotted', 'the-one' ); ?> </option> 
			<option <?php selected( $args['pattern'], 'dashed' ); ?> value = "dashed"> <?php esc_html_e( 'Dashed', 'the-one' ); ?> </option>
			<option <?php selected( $args['pattern'], 'solid' ); ?>  value = "solid"> <?php esc_html_e( 'Solid', 'the-one' ); ?> </option> 
			<option <?php selected( $args['pattern'], 'double' ); ?> value = "double"> <?php esc_html_e( 'Double', 'the-one' ); ?> </option>
			<option <?php selected( $args['pattern'], 'groove' ); ?> value = "groove"> <?php esc_html_e( 'Groove', 'the-one' ); ?> </option>
			<option <?php selected( $args['pattern'], 'ridge' ); ?>  value = "ridge"> <?php esc_html_e( 'Ridge', 'the-one' ); ?> </option> 
			<option <?php selected( $args['pattern'], 'inset' ); ?>  value = "inset"> <?php esc_html_e( 'Inset', 'the-one' ); ?> </option> 
			<option <?php selected( $args['pattern'], 'outset' ); ?> value = "outset"> <?php esc_html_e( 'Outset', 'the-one' ); ?> </option>
		</select>
	</div>
</div>
