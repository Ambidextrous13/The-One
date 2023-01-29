<?php
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    
    class Sidebars{
        use Singleton;

        private function __construct() {
            $this -> setup_hooks();
        }

        private function setup_hooks() {
            add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
            add_action( 'widgets_init', [ $this, 'widget_enqueue' ] );
        }

        public function register_sidebars() {   
            register_sidebar( 
                [
                    'name'           => 'The One Sidebar',
                    'id'             => 'sidebar-0',
                    'description'    => 'General purpose sidebar',
                    'class'          => 'sidebar',
                    'before_widget'  => '<div class="widget">',
                    'after_widget'   => '</div>',
                    'before_title'   => '<div class="widget_title"><h4><span>',
                    'after_title'    => '</span></h4></div>',
                    'before_sidebar' => '<div class="col-sm-4 col-md-4 col-lg-4"><div class="sidebar">',
                    'after_sidebar'  => '</div></div>',
                ] 
            );
        }

        public function widget_enqueue() {
            register_widget( 'THE_ONE\Inc\Classes\widget_categories' );
            register_widget( 'THE_ONE\Inc\Classes\widget_search' );
            register_widget( 'THE_ONE\Inc\Classes\widget_tabs' );
            register_widget( 'THE_ONE\Inc\Classes\widget_tags' );
            register_widget( 'THE_ONE\Inc\Classes\widget_archives' );
        }

    }

?>