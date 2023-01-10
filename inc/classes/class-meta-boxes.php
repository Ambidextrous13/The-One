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
?>
        <div class="cmb-pair">  <!-- CMB === custom meta box -->
            <label id="cmb-label" for="toggle">Feature Image Border</label>
            <div id="cmb-slider" class="cmb-slider">
                <div id="cmb-i-r" class="cmb-inner-runner cmb-temp-off"></div>
                <input type="checkbox" name="t-o-p-b-checkbox" id="cmb-toggle" <?php echo 'on' === $stored_data['checkbox'] ? esc_html_e( 'checked', 'the-one' ) : '' ?>> <!--t-o-p-b === the one post border   -->
            </div>
        </div>
        
        <div id="cmb-hidable" class="cmb-hidable cmb-form">
            <div class="cmb-pair">
                <label for="thickness">Thickness( in pixels )</label>
                <input type="text" name="t-o-p-b-thickness" id="cmb-thickness" placeholder="in pixels" value = "<?php echo $stored_data['thickness'] ?>">
            </div>
        
            <div class="cmb-pair">
                <label for="color">Color</label>
                <input type="color" name="t-o-p-b-color" id="cmb-color" value = "<?php echo $stored_data['color'] ?>">
            </div>
    
            <div class="cmb-pair">
                <label for="padding">Padding ( in pixels )</label>
                <input type="padding" name="t-o-p-b-padding" id="cmb-padding" value="<?php echo $stored_data['padding'] ?>">
            </div>
            
        
            <div class="cmb-pair">
                <label for="pattern">Pattern</label>
                <select name="t-o-p-b-pattern" id="cmb-pattern">
                    <option selected<? selected( $stored_data[ 'pattern' ], "dotted" )?> value = "dotted">Dotted</option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "dashed" )?> value = "dashed">Dashed</option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "solid"  )?> value = "solid">Solid</option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "double" )?> value = "double">Double</option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "groove" )?> value = "groove">Groove</option>
                    <option selected<? selected( $stored_data[ 'pattern' ], "ridge"  )?> value = "ridge">Ridge</option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "inset"  )?> value = "inset">Inset</option> 
                    <option selected<? selected( $stored_data[ 'pattern' ], "outset" )?> value = "outset">Outset</option>
                </select>
            </div>
        </div>
<?php
    }

    public function save_meta_data( $post_id ){
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