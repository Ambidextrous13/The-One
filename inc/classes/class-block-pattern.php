<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;

    class Block_Pattern {
        use Singleton;

        private function __construct(){
            $this -> setup_hooks();
        }

        private function setup_hooks(){
            add_action( 'init', [$this, 'registrar'] );
        }

        public function registrar(){

            $register = [
                'about-us-pattern' => [
                    'title' => __('About Us', 'the-one' ),
                    'description' => __( 'Brief about your company or business. Contact information and address', 'the-one' ),
                    'content' => the_template_part( 'template-parts\block-patterns\about-us' ),
                    // 'categories' => 'footer-stuff'
                ],

                'recent-posts-pattern' => [
                    'title' => __('Recent Posts', 'the-one' ),
                    'description' => __( 'Shows recent posts', 'the-one' ),
                    'content' => the_template_part( 'template-parts\block-patterns\recent-posts' ),
                    // 'categories' => 'footer-stuff'
                ],

                'twitter-feeds-pattern' => [
                    'title' => __('Twitter Feeds', 'the-one' ),
                    'description' => __( 'Your twitter feed', 'the-one' ),
                    'content' => the_template_part( 'template-parts\block-patterns\twitter-feeds' ),
                    // 'categories' => 'footer-stuff'
                ],

                'gallery-pattern' => [
                    'title' => __('Gallery', 'the-one' ),
                    'description' => __( '3x3 photos gallery', 'the-one' ),
                    'content' => the_template_part( 'template-parts\block-patterns\gallery' ),
                    // 'categories' => 'footer-stuff'
                ]

                
            ];

            foreach ($register as $index => $entry) {
                register_block_pattern( $index, $entry );
            };
        }

    }

?>