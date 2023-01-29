<?php
    
?>

<div class="cmb-pair"> 
    <label id="cmb-label" for="toggle"><?php _e( 'Feature Image Border', 'the-one' ) ?></label>
    <div id="cmb-slider" class="cmb-slider">
        <div id="cmb-i-r" class="cmb-inner-runner cmb-temp-off"></div>
        <input type="checkbox" name="t-o-p-b-checkbox" id="cmb-toggle" <?php echo 'on' === $args[ 'checkbox' ] ? esc_html_e( 'checked', 'the-one' ) : '' ?>> <!--t-o-p-b === the one post border   -->
    </div>
</div>

<div id="cmb-hidable" class="cmb-hidable cmb-form">
    <div class="cmb-pair">
        <label for="thickness"><?php _e( 'Thickness( in pixels )', 'the-one' ) ?></label>
        <input type="text" name="t-o-p-b-thickness" id="cmb-thickness" placeholder="in pixels" value = "<?php echo $args[ 'thickness' ] ?>">
    </div>

    <div class="cmb-pair">
        <label for="color"><?php _e( 'Color', 'the-one' ) ?></label>
        <input type="color" name="t-o-p-b-color" id="cmb-color" value = "<?php echo $args[ 'color' ] ?>">
    </div>

    <div class="cmb-pair">
        <label for="padding"><?php _e( 'Padding ( in pixels )', 'the-one' ) ?></label>
        <input type="padding" name="t-o-p-b-padding" id="cmb-padding" value="<?php echo $args[ 'padding' ] ?>">
    </div>
    

    <div class="cmb-pair">
        <label for="pattern"><?php _e( 'Pattern', 'the-one' ) ?></label>
        <select name="t-o-p-b-pattern" id="cmb-pattern">
            <option selected<? selected( $args[ 'pattern' ], "dotted" )?> value = "dotted"> <?php _e( 'Dotted', 'the-one' ) ?> </option> 
            <option selected<? selected( $args[ 'pattern' ], "dashed" )?> value = "dashed"> <?php _e( 'Dashed', 'the-one' ) ?> </option>
            <option selected<? selected( $args[ 'pattern' ], "solid"  )?> value = "solid"> <?php _e( 'Solid', 'the-one' ) ?> </option> 
            <option selected<? selected( $args[ 'pattern' ], "double" )?> value = "double"> <?php _e( 'Double', 'the-one' ) ?> </option>
            <option selected<? selected( $args[ 'pattern' ], "groove" )?> value = "groove"> <?php _e( 'Groove', 'the-one' ) ?> </option>
            <option selected<? selected( $args[ 'pattern' ], "ridge"  )?> value = "ridge"> <?php _e( 'Ridge', 'the-one' ) ?> </option> 
            <option selected<? selected( $args[ 'pattern' ], "inset"  )?> value = "inset"> <?php _e( 'Inset', 'the-one' ) ?> </option> 
            <option selected<? selected( $args[ 'pattern' ], "outset" )?> value = "outset"> <?php _e( 'Outset', 'the-one' ) ?> </option>
        </select>
    </div>
</div>