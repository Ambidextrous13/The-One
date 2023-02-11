<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    use WP_Widget;

    class Widget_Flickr extends WP_Widget{
        use Singleton;
        public function __construct(){
            parent::__construct(
                'widget_flickr',
                __( 'The One: Flickr', 'the-one' )
            );
        }

        public function widget( $arg, $instance ){  // public end
            extract( $arg );
            echo $before_widget;
    
            $title = apply_filters( 'widget_title', $instance[ 'title' ] );

            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
    
            get_template_part( 'template-parts/widgets/widget', 'flickr' );
    
            echo $after_widget;
        }
    
        public function form( $instance ) {  // widget form
            $html_metas = [
                'title' => [
                    'label' 	=> 'Title:',
                    'name'		=> $this->get_field_name( 'title' ),
                    'input:type'=> 'text',
                    'attr'		=>[
                        'name'		=> $this->get_field_name( 'title' ),
                        'id'   		=> $this->get_field_id  ( 'title' ),
                        'value'		=>  isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Gallery',
                    ]
                ],
            ];
    
            foreach( $html_metas as $_ => $meta ){
                $label = HTML::label_tag( $meta[ 'label' ], $meta[ 'name' ] );
                $input = HTML::input_tag(
                    $meta[ 'input:type' ],
                    isset( $meta[ 'attr' ] ) ? ( $meta[ 'attr' ] ) : []
                );
                $pera = HTML::p_tag( 
                    $label . $input, 
                    [], 
                    true 
                );
                echo $pera;
            };
        }
    
        public function update( $new_instance, $old_instance ) { // db config
            $instance         	    = [];
            $instance[ 'title' ]    = ( ! empty( $new_instance['title'] ) )    ? strip_tags( $new_instance['title'] )    : '';
            return $instance;
        }
    
    }

?>