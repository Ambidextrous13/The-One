<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    use WP_Widget, DOMDocument;

    class Widget_Twitter extends WP_Widget{
        use Singleton;
        public function __construct(){
            parent::__construct(
                'widget_twitter',
            __( 'The One: Twitter Highlights','the-one' ), 
            );
        }

        public function widget($args, $instance)
        {
            extract( $args );
            echo $before_widget;

            $title = apply_filters( 'widget_title', $instance[ 'title' ] );
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }

            get_template_part( 'template-parts/widgets/widget', 'twitter', $instance );

            echo $after_widget;
        }

        public function form( $instance )
        {
            $html_metas = [
                'title' => [
                    'label' 	=> 'Widget Title:',
                    'input:type'=> 'text',
                    'name'		=> $this->get_field_name( 'title' ),
                    'attr'		=>[
                        'name'		=> $this->get_field_name( 'title' ),
                        'id'   		=> $this->get_field_id  ( 'title' ),
                        'value'		=> isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Tweets',
                    ]
                ],
                'embed1' =>[
                    'label' 	=> 'Embed Code',
                    'tag'       => 'textarea',
                    'name'		=> $this->get_field_name( 'embed_1' ),
                    'innertext' => isset( $instance[ 'embed_1' ] ) ? $instance[ 'embed_1' ] : '',
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'embed_1' ),
                        'id'   		  => $this->get_field_id  ( 'embed_1' ),
                        'placeholder' => 'Click on right side three dot on your tweet, click on embed tweet then copy code and paste it here.We will take care the remaining',
                        'rows'        => 2,
                        'style'       => 'width:100%'
                    ],
                ],
                'embed2' =>[
                    'label' 	=> 'Embed Code',
                    'tag'       => 'textarea',
                    'name'		=> $this->get_field_name( 'embed_2' ),
                    'innertext' => isset( $instance[ 'embed_2' ] ) ? $instance[ 'embed_2' ] : '',
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'embed_2' ),
                        'id'   		  => $this->get_field_id  ( 'embed_2' ),
                        'placeholder' => 'One last time or you can leave it.......',
                        'rows'        => 2,
                        'style'       => 'width:100%'
                    ],
                ],
                

            ];
            $form = '';
            foreach( $html_metas as $_ => $meta ){
                if( isset( $meta[ 'label' ] ) && isset( $meta[ 'name' ] ) ){
                    $label = HTML::label_tag( $meta[ 'label' ], $meta[ 'name' ] );
                }
                if( isset( $meta[ 'input:type' ] ) ){
                    $input = HTML::input_tag(
                        $meta[ 'input:type' ],
                        isset( $meta[ 'attr' ] ) ? ( $meta[ 'attr' ] ) : []
                    );
                }
               if( isset( $meta[ 'tag' ] ) && isset( $meta[ 'attr' ] ) ){
                   $input = HTML::custom_tag( 
                       $meta[ 'tag' ],
                       $meta[ 'innertext' ],
                       false,
                       $meta[ 'attr' ]
                   );
               }
                
                $pera = HTML::p_tag( 
                    $label . $input, 
                    [], 
                    true 
                );
                echo $pera;
            };
        }

        public function update($new_instance, $old_instance)
        {
            $instance         	 	= [];
            $instance[ 'title' ]    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) 		: '';
            $instance[ 'embed_1' ] 	= ( ! empty( $new_instance['embed_1'] ) )  ? self::rectifier( $new_instance['embed_1'] ) : '';
            $instance[ 'embed_2' ] 	= ( ! empty( $new_instance['embed_2'] ) )  ? self::rectifier( $new_instance['embed_2'] ) : '';
            return $instance;
        }

        private static function rectifier( $code ){
            $arr = [];
            $dom = new DOMDocument();
            $dom->loadHTML( $code );
            foreach( $dom->getElementsByTagName( 'p' ) as $element ){
                $text = $element->nodeValue;
                $arr[ 'text' ] = strip_tags( $text ); 
            }

            foreach( $dom->getElementsByTagName( 'blockquote' ) as $element ){
                $str =  $element->nodeValue;
                $regex = '/\(@.{1,}\)/';
                $match = [];
                preg_match( $regex, $str, $match );
                if( ! empty( $match ) ){
                    $arr[ 'author' ] = strip_tags( substr( $match[0], 1, -1 ) ); 
                }
            }

            foreach( $dom->getElementsByTagName( 'a' ) as $element ){
                $date  = $element->nodeValue;
                $regex = '/.{1,}\s[0-9]{1,2}, [0-9]{2,4}/';
                $match = [];
                preg_match( $regex, $date, $match );
                if( ! empty( $match ) ){
                    $arr[ 'date' ] = strip_tags( $match[0] );
                }
                else{
                    $arr[ 'date' ] = strip_tags( '' );
                }

                $link  = $element->getAttribute( 'href' );
                $regex = '/https:\/\/twitter.com\/.{1,}/';
                $match = [];
                preg_match( $regex, $link, $match );
                if( ! empty( $match ) ){
                    $arr[ 'link' ] = strip_tags( $match[0] );
                }
                else{
                    if( isset( $arr[ 'author' ] ) ){
                        $arr[ 'link' ] = strip_tags( 'https://twitter.com/' . substr( $arr[ 'author' ], 1 ) );
                    }
                    $arr[ 'link' ] = strip_tags( 'https://twitter.com/' );
                }
            }  
            return json_encode( $arr );
        }
        
    }

?>