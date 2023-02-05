<?php

namespace THE_ONE\Inc\Classes;
use THE_ONE\Inc\Traits\Singleton;
use WP_Widget;

class Widget_Search extends WP_Widget{
    use Singleton;

    public function __construct() {
        parent::__construct(
            'widget_search',
            __('The-One: Search','the-one'),
        );
    }

    public function widget( $arg, $instance ){  // public end
		extract( $arg );
		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance[ 'title' ] );

		if( isset( $instance[ 'checkbox' ] ) ){
			if ( 'on' === $instance[ 'checkbox' ] && ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			}
		}

        get_search_form( );

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
					'value'		=>  isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Search Field',
				]
			],
			'checkbox' =>[
				'label' 	=> "Show title ?\t",
				'name'		=> $this->get_field_name( 'checkbox' ),
				'input:type'=> 'checkbox',
				'attr'		=> [
					'name'		=> $this->get_field_name( 'checkbox' ),
					'id'   		=> $this->get_field_id  ( 'checkbox' ),
					'attributes'=> [
						( isset( $instance[ 'checkbox' ] ) && 'on' === $instance[ 'checkbox' ] ) ? 'Checked': '',
						]
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
		$instance[ 'checkbox' ] = ( ! empty( $new_instance['checkbox'] ) ) ? strip_tags( $new_instance['checkbox'] ) : '';
		return $instance;
	}

}
?>