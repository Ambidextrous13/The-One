<?php
namespace THE_ONE\Inc\Classes;
use WP_Widget;
use THE_ONE\Inc\Traits\Singleton;

class Widget_Categories extends WP_Widget{
    use Singleton;

    public function __construct() {
        parent::__construct(
            'widget_categories',
            __('The-One: Categories','the-one'),
        );
    }

    public function widget( $arg, $instance ){  // public end
        extract( $arg );
		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		
		get_template_part( 'template-parts/widgets/widget', 'categories', $instance );

		echo $after_widget;
    }

    public function form( $instance ) {  // widget form
		$html_metas = [
			'title' => [
				'label' 	=> 'Title:',
				'input:type'=> 'text',
				'name'		=> $this->get_field_name( 'title' ),
				'attr'		=>[
					'name'		=> $this->get_field_name( 'title' ),
					'id'   		=> $this->get_field_id  ( 'title' ),
					'value'		=>  isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'CATEGORIES:',
				]
			],
			'tab1' =>[
				'label' 	=> 'Max. Categories:',
				'input:type'=> 'number',
				'name'		=> $this->get_field_name( 'max_items' ),
				'attr'		=> [
					'name'		=> $this->get_field_name( 'max_items' ),
					'id'   		=> $this->get_field_id  ( 'max_items' ),
					'value'		=> isset( $instance[ 'max_items' ] ) ? $instance[ 'max_items' ] : 5,
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
		$instance         	 		= [];
		$instance[ 'title' ] 		= ( ! empty( $new_instance['title'] ) ) 	? strip_tags( $new_instance['title'] ) 		: '';
		$instance[ 'max_items' ] 	= ( ! empty( $new_instance['max_items'] ) ) ? strip_tags( $new_instance['max_items'] ) 	: '';
		return $instance;
	}

}
?>