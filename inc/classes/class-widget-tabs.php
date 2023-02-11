<?php

namespace THE_ONE\Inc\Classes;
use THE_ONE\Inc\Traits\Singleton;
use WP_Widget;

class Widget_Tabs extends WP_Widget{
    use Singleton;

    public function __construct() {
        parent::__construct(
            'widget_tabs',
            __( 'The-One: The Tabs', 'the-one' ),
        );
    }

    public function widget( $arg, $instance ){  // public end
        extract( $arg );
		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
        
		
		get_template_part( 'template-parts/widgets/widget', 'tabs', $instance );

		echo $after_widget;
    }

    public function form( $instance ) {  // widget form
		$html_metas = [
			'title' => [
				'label' 	=> 'Title:',
				'input:type'=> 'text',
				'name'		=> $this->get_field_name( 'title' ),
				'attr'		=> [
					'name'		=> $this->get_field_name( 'title' ),
					'id'   		=> $this->get_field_id  ( 'title' ),
					'value'		=>  isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Pin Board',
				]
			],
			'tab1' =>[
				'label' 	=> 'Tab-1 Title:',
				'input:type'=> 'text',
				'name'		=> $this->get_field_name( 'tab-1' ),
				'attr'		=> [
					'name'		=> $this->get_field_name( 'tab-1' ),
					'id'   		=> $this->get_field_id  ( 'tab-1' ),
					'value'		=> isset( $instance[ 'tab-1' ] ) ? $instance[ 'tab-1' ] : 'Pinned Notices',
				]
			],
			'tab2' =>[
				'label' 	=> 'Tab-2 Title:',
				'input:type'=> 'text',
				'name'		=> $this->get_field_name( 'tab-2' ),
				'attr'		=> [
					'name'		=> $this->get_field_name( 'tab-2' ),
					'id'   		=> $this->get_field_id  ( 'tab-2' ),
					'value'		=> isset( $instance[ 'tab-2' ] ) ? $instance[ 'tab-2' ] : 'Recent',
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
		$instance         	 = [];
		$instance[ 'title' ] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance[ 'tab-1' ] = ( ! empty( $new_instance['tab-1'] ) ) ? strip_tags( $new_instance['tab-1'] ) : '';
		$instance[ 'tab-2' ] = ( ! empty( $new_instance['tab-2'] ) ) ? strip_tags( $new_instance['tab-2'] ) : '';
		return $instance;
	}

}
?>
