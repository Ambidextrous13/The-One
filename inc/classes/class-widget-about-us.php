<?php

    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    use WP_Widget;

    class Widget_About_Us extends WP_Widget{
        use Singleton;
        public function __construct(){
            parent::__construct(
                'widget_about_us',
                __( 'The One: About Us','the-one' ), 
            );
        }

        public function widget( $arg, $instance ){
            extract( $arg );

            echo $before_widget;

            $title = apply_filters( 'widget_title', $instance['title'] );
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }

            get_template_part( 'template-parts/widgets/widget', 'about-us', $instance );

            echo $after_widget;
        }

        public function form( $instance ){
            $html_metas = [
                'title' => [
                    'label' 	=> 'Widget Title:',
                    'input:type'=> 'text',
                    'name'		=> $this->get_field_name( 'title' ),
                    'attr'		=>[
                        'name'		=> $this->get_field_name( 'title' ),
                        'id'   		=> $this->get_field_id  ( 'title' ),
                        'value'		=> isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'About Us',
                    ]
                ],
                'about' =>[
                    'label' 	    => 'About You',
                    'tag'           => 'textarea',
                    'name'		    => $this->get_field_name( 'about_us_text' ),
                    'text_content'  => isset( $instance[ 'about_us_text' ] ) ? $instance[ 'about_us_text' ] : '',
                    'attr'		    => [
                        'name'		  => $this->get_field_name( 'about_us_text' ),
                        'id'   		  => $this->get_field_id  ( 'about_us_text' ),
                        'placeholder' => 'Brief About Your Company/Organizations [25 Words]',
                        'maxlength'   => 125,
                        'rows'        => 2,
                        'style'       => 'width:100%'
                    ],
                ],
                'address' =>[
                    'label' 	=> 'Address',
                    'input:type'=> 'text',
                    'name'		=> $this->get_field_name( 'address' ),
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'address' ),
                        'id'   		  => $this->get_field_id  ( 'address' ),
                        'value'		  => isset( $instance[ 'address' ] ) ? $instance[ 'address' ] : '',
                        'placeholder' => 'Your address goes here',
                    ],
                ],
                'country_code' =>[
                    'label' 	=> 'Country Code',
                    'input:type'=> 'tel',
                    'name'		=> $this->get_field_name( 'country_code' ),
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'country_code' ),
                        'id'   		  => $this->get_field_id  ( 'country_code' ),
                        'value'		  => isset( $instance[ 'country_code' ] ) ? $instance[ 'country_code' ] : get_option( 'country_code', '' ),
                        'placeholder' => 'Country Code For Contact Number',
                        'pattern'     => '^\d{1,3}$',
                    ],
                ],
                'phone' =>[
                    'label' 	=> 'Phone Number',
                    'input:type'=> 'tel',
                    'name'		=> $this->get_field_name( 'phone_number' ),
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'phone_number' ),
                        'id'   		  => $this->get_field_id  ( 'phone_number' ),
                        'value'		  => isset( $instance[ 'phone_number' ] ) ? $instance[ 'phone_number' ] : get_option( 'contact_number', '' ),
                        'placeholder' => 'Your phone/telephone number goes here',
                        'pattern'     => '[6-9]{1}[0-9]{9}'
                    ],
                ],
                'email' =>[
                    'label' 	=> 'Email Address',
                    'input:type'=> 'Email',
                    'name'		=> $this->get_field_name( 'email' ),
                    'attr'		=> [
                        'name'		  => $this->get_field_name( 'email' ),
                        'id'   		  => $this->get_field_id  ( 'email' ),
                        'value'		  => isset( $instance[ 'email' ] ) ? $instance[ 'email' ] : get_option( 'contact_email', '' ),
                        'placeholder' => 'Your email goes here'
                    ],
                ],

            ];
            foreach( $html_metas as $_ => $meta ){
                $label = HTML::label_tag( $meta[ 'label' ], $meta[ 'name' ] );
                if( isset( $meta[ 'input:type' ] ) ){
                    $input = HTML::input_tag(
                        $meta[ 'input:type' ],
                        isset( $meta[ 'attr' ] ) ? ( $meta[ 'attr' ] ) : []
                    );
                }
                else{
                    $input = HTML::custom_tag( 
                        $meta[ 'tag' ],
                        $meta[ 'text_content' ],
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
        
        public function update( $new_instance, $old_instance ){
            $instance         	 		    = [];
            $instance[ 'title' ] 		    = ( ! empty( $new_instance['title'] ) ) 	    ? strip_tags( $new_instance['title'] ) 		    : '';
            $instance[ 'about_us_text' ] 	= ( ! empty( $new_instance['about_us_text'] ) ) ? strip_tags( $new_instance['about_us_text'] ) 	: '';
            $instance[ 'address' ] 	        = ( ! empty( $new_instance['address'] ) )       ? strip_tags( $new_instance['address'] ) 	    : '';
            $instance[ 'country_code' ] 	= ( ! empty( $new_instance['country_code'] ) )  ? strip_tags( $new_instance['country_code'] ) 	: '';
            $instance[ 'phone_number' ] 	= ( ! empty( $new_instance['phone_number'] ) )  ? strip_tags( $new_instance['phone_number'] ) 	: '';
            $instance[ 'email' ] 	        = ( ! empty( $new_instance['email'] ) )         ? strip_tags( $new_instance['email'] ) 	        : '';
            return $instance;
        }
    }

?>