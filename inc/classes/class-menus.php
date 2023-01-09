<?php
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;

    class Menus{
        use Singleton;

        private function __construct(){
            $this -> setup_hooks();
        }

        private function setup_hooks(){
            add_action( 'init', [ $this, 'register_menus' ] );
        }

        public function register_menus(){
            register_nav_menus(
                    [
                        'the-one-header-menu' => __( 'Header Menu' ),
                    ]
                );
        }

        public function menu_id( $location ){
            
            $menu_id = $this -> have_menus() ? get_nav_menu_locations(  )[$location] : null;
            return ( ! empty( $menu_id ) ) ? $menu_id : ''; 
        }

        public function have_menus(){
            if ( ! empty( get_nav_menu_locations(  ) ) ){
                return true;
            }
            return false;
        }

        public function get_one_step_minimized_menu( $menu_location ){

            $menu_id = $this -> menu_id( $menu_location );
            $menu = wp_get_nav_menu_items( $menu_id ); 

            if ( ! empty( $menu ) && is_array( $menu ) ) {
                $reduced_menu = [];
                foreach ($menu as $_ => $element) {
                    $key = $element->ID;
                    $value = [
                        'has_child' => isset( $reduced_menu[$key][ 'has_child' ] ) ? true : false,
                        'title' => $element -> title,
                        'url' => $element -> url,
                    ];

                    $parent_key = intval( $element->menu_item_parent );

                    if ( 0 !== $parent_key ) {
                        $reduced_menu[$parent_key][ 'has_child' ] = true;
                        $reduced_menu[$parent_key][ 'children' ][$key] = $value;
                        
                    }else{
                        $reduced_menu[$key] = $value;
                    }         
                } 
                return $reduced_menu;
            }
            return false;    
        }
    }
?>