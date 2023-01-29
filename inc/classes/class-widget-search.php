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
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Search Field', 'the-one' );
		}

		if ( isset( $instance[ 'checkbox' ] ) ) {
			$checkbox = $instance[ 'checkbox' ];
		} else {
			$checkbox = __( 'Search Field', 'the-one' );
		}

		$ref_title_name = $this->get_field_name( 'title' );
		$ref_title_id   = $this->get_field_id( 'title' );

		$ref_check_name = $this->get_field_name( 'checkbox' );
		$ref_check_id   = $this->get_field_id( 'checkbox' );
		

		?>
		<p>
			<label for="<?php echo $ref_title_name; ?>"><?php _e( 'Title:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_title_id; ?>" name="<?php echo $ref_title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $ref_check_name; ?>"><?php _e( 'Title On:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_check_id; ?>" name="<?php echo $ref_check_name; ?>" type="checkbox" <?php echo  ( 'on' === $checkbox ) ? 'Checked': ''; ?> />
		</p>

		<?php
	}

    public function update( $new_instance, $old_instance ) { // db config
		$instance         	    = [];
		$instance[ 'title' ]    = ( ! empty( $new_instance['title'] ) )    ? strip_tags( $new_instance['title'] )    : '';
		$instance[ 'checkbox' ] = ( ! empty( $new_instance['checkbox'] ) ) ? strip_tags( $new_instance['checkbox'] ) : '';
		return $instance;
	}

}
?>