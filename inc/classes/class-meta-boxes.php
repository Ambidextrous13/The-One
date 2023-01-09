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
    }

    public function the_one_meta_boxes(){
        $screens = [ 'post' ];
        foreach ($screens as $screen) {
            add_meta_box( 'border_post_at_posts', 'feature Image', [ $this, 'bordered_it' ], $screen, 'side' );
        }
    }

    public function bordered_it( $post ){
?>
        <div class="cmb-form">
        <div class="cmb-pair">
            <label id="cmb-label" for="toggle">Feature Image Border</label>
            <div id="cmb-slider" class="cmb-slider">
                <div id="cmb-i-r" class="cmb-inner-runner cmb-temp-off"></div>
                <input type="checkbox" name="checkbox" id="cmb-toggle">
            </div>
        </div>
        
        <div id="cmb-hidable" class="cmb-hidable cmb-form">
            <div class="cmb-pair">
                <label for="thickness">Thickness</label>
                <input type="text" name="thickness" id="cmb-thickness" placeholder="in pixels">
            </div>
        
            <div class="cmb-pair">
                <label for="color">Color</label>
                <input type="color" name="color" id="cmb-color">
            </div>
    
            <div class="cmb-pair">
                <label for="padding">Padding</label>
                <input type="padding" name="padding" id="cmb-padding">
            </div>
            
        
            <div class="cmb-pair">
                <label for="pattern">Pattern</label>
                <select name="pattern" id="cmb-pattern">
                    <option value = "dotted">Dotted</option>
                    <option value = "dashed">Dashed</option>
                    <option value = "solid">Solid</option> 
                    <option value = "double">Double</option>
                    <option value = "groove">Groove</option>
                    <option value = "ridge">Ridge</option> 
                    <option value = "inset">Inset</option> 
                    <option value = "outset">Outset</option>
                </select>
            </div>
        </div>
    </div>
<?php
    }
}

?>