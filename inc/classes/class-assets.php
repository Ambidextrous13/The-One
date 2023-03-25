<?php
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    class Assets{
        use Singleton;

        private function __construct()
        {
            $this -> setup_hooks();
        }

        private function setup_hooks(){
            add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts' ] );
            add_action( 'admin_enqueue_scripts', [$this, 'scripts_for_admin' ] );
        }

        /**
         * adds necessary JS files and Stylesheets files
         *
         * @return void
         */
        public function  load_scripts(){

            // JS File enqueuing
            wp_register_script( 'bootstrap-js',       THE_ONE_JS . 'bootstrap.min.js',         [ 'jquery' ], filemtime( ABS_THE_ONE_JS . 'bootstrap.min.js' ),                   true );
            wp_register_script( 'flicker-feed-js',    THE_ONE_JS . 'jflickrfeed.js',                     [], filemtime( ABS_THE_ONE_JS . 'jflickrfeed.js' ),                     true );
            wp_register_script( 'main-js',            THE_ONE_JS . 'main.js',                            [], filemtime( ABS_THE_ONE_JS . 'main.js' ),                            true );
            wp_register_script( 'carousel-js',        THE_ONE_JS . 'owl.carousel.min.js',                [], filemtime( ABS_THE_ONE_JS . 'owl.carousel.min.js' ),                true );
            wp_register_script( 'retina-js',          THE_ONE_JS . 'retina-1.1.0.min.js',                [], filemtime( ABS_THE_ONE_JS . 'retina-1.1.0.min.js' ),                true );
            wp_register_script( 'switch-js',          THE_ONE_JS . 'styleswitch.js',                     [], filemtime( ABS_THE_ONE_JS . 'styleswitch.js' ),                     true );
            wp_register_script( 'swipe-js',           THE_ONE_JS . 'swipe.js',                           [], filemtime( ABS_THE_ONE_JS . 'swipe.js' ),                           true );
            wp_register_script( 'contact-js',         THE_ONE_JS . 'view.contact.js',                    [], filemtime( ABS_THE_ONE_JS . 'view.contact.js' ),                    true );
            wp_register_script( 'wow-js',             THE_ONE_JS . 'wow.min.js',                         [], filemtime( ABS_THE_ONE_JS . 'wow.min.js' ),                         true );
            wp_register_script( 'jquery-easing-js',   THE_ONE_JS . 'jquery.easing.1.3.js',               [], filemtime( ABS_THE_ONE_JS . 'jquery.easing.1.3.js' ),               true );
            wp_register_script( 'jquery-cookie-js',   THE_ONE_JS . 'jquery.cookie.js',                   [], filemtime( ABS_THE_ONE_JS . 'jquery.cookie.js' ),                   true );
            wp_register_script( 'jquery-smenus-js',   THE_ONE_JS . 'jquery.smartmenus.min.js',           [], filemtime( ABS_THE_ONE_JS . 'jquery.smartmenus.min.js' ),           true );
            wp_register_script( 'jquery-sm-bs-js',    THE_ONE_JS . 'jquery.smartmenus.bootstrap.min.js', [], filemtime( ABS_THE_ONE_JS . 'jquery.smartmenus.bootstrap.min.js' ), true );
            wp_register_script( 'jquery-magnific-js', THE_ONE_JS . 'jquery.magnific-popup.min.js',       [], filemtime( ABS_THE_ONE_JS . 'jquery.magnific-popup.min.js' ),       true );
            wp_register_script( 'jquery-isotope-js',  THE_ONE_JS . 'jquery.isotope.min.js',              [], filemtime( ABS_THE_ONE_JS . 'jquery.isotope.min.js' ),              true );
            wp_register_script( 'jquery-sticky-js',   THE_ONE_JS . 'jquery.sticky.js',                   [], filemtime( ABS_THE_ONE_JS . 'jquery.sticky.js' ),                   true );
            wp_register_script( 'bordered-it-js',     THE_ONE_JS . 'meta-boxes/bordered-post-posts.js',  [], filemtime( ABS_THE_ONE_JS . 'meta-boxes/bordered-post-posts.js' ),  true );
            wp_register_script( 'infinite-scroll-js', THE_ONE_JS . 'infinite-scroll.js',                 [], filemtime( ABS_THE_ONE_JS . 'infinite-scroll.js' ),                 true );
            //enrolling 
            wp_enqueue_script( 'bootstrap-js' );
            wp_enqueue_script( 'flicker-feed-js' );
            wp_enqueue_script( 'main-js' );
            wp_enqueue_script( 'carousel-js' );
            wp_enqueue_script( 'retina-js' );
            wp_enqueue_script( 'switch-js' );
            wp_enqueue_script( 'swipe-js' );
            wp_enqueue_script( 'contact-js' );
            wp_enqueue_script( 'wow-js' );
            wp_enqueue_script( 'jquery-easing-js' );
            wp_enqueue_script( 'jquery-cookie-js' );
            wp_enqueue_script( 'jquery-smenus-js' );
            wp_enqueue_script( 'jquery-sm-bs-js'  );
            wp_enqueue_script( 'jquery-magnific-js' );
            wp_enqueue_script( 'jquery-isotope-js' );
            wp_enqueue_script( 'jquery-sticky-js' );
            wp_enqueue_script( 'bordered-it-js' );
            wp_enqueue_script( 'infinite-scroll-js' );

            wp_localize_script( 'infinite-scroll-js', 'siteConfig', [
                'ajax_url'    => admin_url( 'admin-ajax.php' ),
                'ajax_nonce' => wp_create_nonce( 'infinite_scroll_nonce' ),
            ] );

            
            // CSS File enqueuing
            wp_register_style( 'bootstrap-css',   THE_ONE_CSS . 'bootstrap.min.css',  [], filemtime( ABS_THE_ONE_CSS . 'bootstrap.min.css' ),  'all' );
            wp_register_style( 'main-css',        THE_ONE_CSS . 'style.css',          [], filemtime( ABS_THE_ONE_CSS . 'style.css' ),          'all' );
            wp_register_style( 'skins',           THE_ONE_CSS . 'style.css',          [], filemtime( ABS_THE_ONE_CSS . 'style.css' ),          'screen' );
            wp_register_style( 'layout',          THE_ONE_CSS . 'layout/wide.css',    [], filemtime( ABS_THE_ONE_CSS . 'layout/wide.css' ),    'all');
            wp_register_style( 'switcher',        THE_ONE_CSS . 'switcher.css',       [], filemtime( ABS_THE_ONE_CSS . 'switcher.css' ),       'screen' );
            //enrolling
            wp_enqueue_style( 'bootstrap-css' );
            wp_enqueue_style( 'main-css' );
            wp_enqueue_style( 'skins' );
            wp_enqueue_style( 'layout' );
            wp_enqueue_style( 'switcher' );
        }

        public function scripts_for_admin(){
            wp_register_script( 'custom-meta-box-js', THE_ONE_JS . 'meta-boxes/custom-meta-box.js', [], filemtime( ABS_THE_ONE_JS . 'meta-boxes/custom-meta-box.js' ), true );
            wp_register_script( 'theme-settings-js', THE_ONE_JS . 'theme-settings.js',              [], filemtime( ABS_THE_ONE_JS . 'theme-settings.js' )            , true );
            wp_enqueue_script( 'custom-meta-box-js' );
            wp_enqueue_script( 'theme-settings-js' );

            wp_register_style( 'custom-meta-box', THE_ONE_CSS . 'meta-boxes/custom-meta-box.css',[], filemtime( ABS_THE_ONE_CSS . 'meta-boxes/custom-meta-box.css' ), 'all' );
            wp_enqueue_style( 'custom-meta-box' );
        }
    }
?>