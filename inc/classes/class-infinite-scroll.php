<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    use WP_Query;

    class Infinite_Scroll{
        use Singleton;

        private static $reading_page = 1;
        private static $book_length  = 1;
        private static $end_of_book  = false;

        private function __construct(){
            $this->setup_hooks();
            $this->book_length_setter();
        }

        private function setup_hooks(){
            add_action( 'wp_ajax_nopriv_infiscroll', [ $this, 'ajax_feeder' ] );
            add_action( 'wp_ajax_infiscroll', [ $this, 'ajax_feeder' ] );
        }

        private function book_length_setter(){
            $max_pages = wp_count_posts( );
            if ( $max_pages ) {
                self::$book_length = intval( ceil( ( $max_pages->publish ) / 4 ) );
            }
        }

        private function next_page(){ 
            self::$reading_page += 1;
        }

        private function fresh_read(){
            self::$reading_page = 1;
        }

        public function ajax_feeder(){
            if ( ! check_ajax_referer( 'infinite_scroll_nonce', 'ajax_nonce', false ) ) {
                wp_send_json_error( __( 'Invalid security token.', 'the-one' ) );
                wp_die( '0', 400 );
            }
      
            if( ! self::$end_of_book ){
              
                $this->next_page();
                $this->give_feeds( self::$reading_page );
                
                if( self::$reading_page === self::$book_length ){
                    self::$end_of_book = true;
                    wp_die( 'END_OF_BOOK' );
                }
                wp_die();
            }

            wp_die( 'END_OF_BOOK' );

        }

        public function give_feeds( $page_no = 1 ){
            $index = 1;

            if ( 1 <= $page_no && self::$book_length >= $page_no ) {
                $index = $page_no;
            }

            $args = [
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'paged'          => $index,
            ];
            
            $query = new WP_Query( $args );
            if( $query->have_posts() ){
                while ( $query->have_posts() ) {
                    $query->the_post();
                    get_template_part( 'template-parts\posts\article' );
                }
                echo '<div id="load-trigger"></div>';
                wp_reset_postdata();
            }
            if ( self::$reading_page !== $index ){
                self::$reading_page = $index;
            }
        }
    }
?>