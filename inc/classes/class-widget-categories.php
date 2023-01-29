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
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'CATEGORIES', 'the-one' );
		}

		if ( isset( $instance[ 'max_items' ] ) ) {
			$max_items = $instance[ 'max_items' ];
		} else {
			$max_items = __( '5', 'the-one' );
		}
		$ref_title_name = $this->get_field_name( 'title' );
		$ref_title_id = $this->get_field_id( 'title' );
		$ref_max_items_name = $this->get_field_name( 'max_items' );
		$ref_max_items_id = $this->get_field_id( 'max_items' );
		?>
		<p>
			<label for="<?php echo $ref_title_name; ?>"><?php _e( 'Title:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_title_id; ?>" name="<?php echo $ref_title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $ref_max_items_name; ?>"><?php _e( 'Max Categories:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_max_items_id ?>" name="<?php echo $ref_max_items_name; ?>" type="number" value="<?php echo esc_attr( $max_items ); ?>" />
		</p>
		<?php
	}

    public function update( $new_instance, $old_instance ) { // db config
		$instance         	 		= [];
		$instance[ 'title' ] 		= ( ! empty( $new_instance['title'] ) ) 	? strip_tags( $new_instance['title'] ) 		: '';
		$instance[ 'max_items' ] 	= ( ! empty( $new_instance['max_items'] ) ) ? strip_tags( $new_instance['max_items'] ) 	: '';
		return $instance;
	}

}
?>