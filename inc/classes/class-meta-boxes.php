<?php

namespace THE_ONE\Inc\Classes;
use THE_ONE\Inc\Traits\Singleton;

class Meta_Boxes{
    use Singleton; 
    private function __construct()  
    {
        $this -> setup_hooks();
    }

    private function setup_hooks(){
        add_action( 'add_meta_boxes', [ $this, 'the_one_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'save_meta_data' ] );
    }

    public function the_one_meta_boxes(){
        $screens = [ 'post' ];
        foreach ($screens as $screen) {
            add_meta_box( 'border_post_at_posts', 'feature Image', [ $this, 'bordered_it_html' ], $screen, 'side' );
        }
    }

    public function bordered_it_html( $post ){
        $keys = [ 'checkbox', 'thickness', 'color', 'padding', 'pattern' ]; 
        $stored_data = [];
        foreach ($keys as $key) {
            $stored_data[ $key ] = get_post_meta( $post->ID, 't-o-p-b-' . $key, true );
        }
        wp_nonce_field( 'saving_values_of_post_border_form', 'nonce_for_post_border_form' );
?>
        <div class="cmb-pair">  <!-- CMB === custom meta box -->
            <label id="cmb-label" for="toggle"><?php _e( 'Feature Image Border', 'the-one' ) ?></label>
            <div id="cmb-slider" class="cmb-slider">
                <div id="cmb-i-r" class="cmb-inner-runner cmb-temp-off"></div>
                <input type="checkbox" name="t-o-p-b-checkbox" id="cmb-toggle" <?php echo 'on' === $stored_data['checkbox'] ? esc_html_e( 'checked', 'the-one' ) : '' ?>> <!--t-o-p-b === the one post border   -->
            </div>
        </div>
        
        <div id="cmb-hidable" class="cmb-hidable cmb-form">
            <div class="cmb-pair">
                <label for="thickness"><?php _e( 'Thickness( in pixels )', 'the-one' ) ?></label>
                <input type="text" name="t-o-p-b-thickness" id="cmb-thickness" placeholder="in pixels" value = "<?php echo $stored_data['thickness'] ?>">
            </div>
        
            <div class="cmb-pair">
                <label for="color"><?php _e( 'Color', 'the-one' ) ?></label>
                <input type="color" name="t-o-p-b-color" id="cmb-color" value = "<?php echo $stored_data['color'] ?>">
            </div>
    
            <div class="cmb-pair">
                <label for="padding"><?php _e( 'Padding ( in pixels )', 'the-one' ) ?></label>
                <input type="padding" name="t-o-p-b-padding" id="cmb-padding" value="<?php echo $stored_data['padding'] ?>">
            </div>
            
        
            <div class="cmb-pair">
                <label for="pattern"><?php _e( 'Pattern', 'the-one' ) ?></label>
                <select name="t-o-p-b-pattern" id="cmb-pattern">
                    <option selected<? selected( $stored_data[ 'pattern' ], "dotted" )?> value = "dotted"> <?php _e( 'Dotted', 'the-one' ) ?> </option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "dashed" )?> value = "dashed"> <?php _e( 'Dashed', 'the-one' ) ?> </option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "solid"  )?> value = "solid"> <?php _e( 'Solid', 'the-one' ) ?> </option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "double" )?> value = "double"> <?php _e( 'Double', 'the-one' ) ?> </option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "groove" )?> value = "groove"> <?php _e( 'Groove', 'the-one' ) ?> </option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "ridge"  )?> value = "ridge"> <?php _e( 'Ridge', 'the-one' ) ?> </option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "inset"  )?> value = "inset"> <?php _e( 'Inset', 'the-one' ) ?> </option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "outset" )?> value = "outset"> <?php _e( 'Outset', 'the-one' ) ?> </option>
                </select>
            </div>
        </div>
<?php
    }

    public function save_meta_data( $post_id ){
        if ( ! isset( $_POST[ 'nonce_for_post_border_form' ] ) || ! wp_verify_nonce( $_POST[ 'nonce_for_post_border_form' ], 'saving_values_of_post_border_form' )) {
           return null;
        }
        $keys = [ 't-o-p-b-checkbox', 't-o-p-b-thickness', 't-o-p-b-color', 't-o-p-b-padding', 't-o-p-b-pattern' ]; 
        foreach ($keys as $key) {
            if( isset( $_POST[ $key ] ) ){
                update_post_meta( $post_id, $key, $_POST[ $key ] );
            }else {
                update_post_meta( $post_id, $key, 0 );
            }
        }
    }
}

?>