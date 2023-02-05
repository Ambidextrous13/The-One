<?php
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;

    class THE_ONE
    {   
        use Singleton;

        private function __construct(){
            $this-> setup_hooks();

            Assets::get_instance();
            Sidebars::get_instance();
            Menus::get_instance();
            Meta_Boxes::get_instance();
            Block_Pattern::get_instance();

        }

        private function setup_hooks(){
            add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
            add_action( 'after_setup_theme', [ $this, 'registrar' ] );


            add_filter( 'excerpt_more', [ $this, 'no_excerpt'] );
        }

        public function theme_supports(){
            add_theme_support( 'title-tag' );
            
            add_theme_support(
                'custom-logo',
                [
                    'header-text' => [
                        'site-title',
                        'site-description',
                    ],
                    'height'      => 100,
                    'width'       => 400,
                    'flex-height' => true,
                    'flex-width'  => true,
                ]
            );

            add_theme_support( 'post-thumbnails' );

            add_theme_support( 'customize-selective-refresh-widgets' );

            add_theme_support( 'automatic-feed-links' );

            add_theme_support(
                'html5',
                [
                    'search-form',
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'script',
                    'style',
                ]
            );

            add_theme_support( 'wp-block-styles' );

            add_theme_support( 'align-wide' );

        }

        public function registrar(){
            add_image_size( 'indexing-size', 630, 320, true );
        }

        public function no_excerpt( $more ) {
            return '...';
        }
    }
    
?>