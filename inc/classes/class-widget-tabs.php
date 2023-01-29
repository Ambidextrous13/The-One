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
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Pin Board', 'the-one' );
		}

		if ( isset( $instance[ 'tab-1' ] ) ) {
			$tab_1 = $instance[ 'tab-1' ];
		} else {
			$tab_1 = __( 'Pinned Notices', 'the-one' );
		}

		if ( isset( $instance[ 'tab-2' ] ) ) {
			$tab_2 = $instance[ 'tab-2' ];
		} else {
			$tab_2 = __( 'Recent', 'the-one' );
		}

		$ref_title_name = $this->get_field_name( 'title' );
		$ref_title_id   = $this->get_field_id( 'title' );

		$ref_tab_1_name = $this->get_field_name( 'tab-1' );
		$ref_tab_1_id   = $this->get_field_id( 'tab-1' );
		$ref_tab_2_name = $this->get_field_name( 'tab-2' );
		$ref_tab_2_id   = $this->get_field_id( 'tab-2' );

		?>
		<p>
			<label for="<?php echo $ref_title_name; ?>"><?php _e( 'Title:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_title_id; ?>" name="<?php echo $ref_title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $ref_tab_1_name; ?>"><?php _e( 'Tab-1 Title:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_tab_1_id; ?>" name="<?php echo $ref_tab_1_name; ?>" type="text" value="<?php echo esc_attr( $tab_1 ); ?>" />

			<label for="<?php echo $ref_tab_2_name; ?>"><?php _e( 'Tab-2 Title:','the-one' ); ?></label>
			<input class="widefat" id="<?php echo $ref_tab_2_id; ?>" name="<?php echo $ref_tab_2_name; ?>" type="text" value="<?php echo esc_attr( $tab_2 ); ?>" />
		</p>
		<?php
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
