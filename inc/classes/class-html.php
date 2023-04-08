<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;

    /**
     * Use as HTML Generator.
     */
    class HTML{

        use Singleton;

        private function __construct( ){

        }

        /**
         * This static function returns a string having class id and other inline arguments in HTML format
         *
         * @param array $args
         * @return string
         */
        private static function set_class_id_params( $args = [], $is_end = false, $self_closing = false ){
            $html = '';
            if ( is_array( $args ) && ! empty( $args ) ) {
                foreach ( $args as $key => $value) {
                    if ( 'attributes' === $key ) {
                        if( is_array( $value ) && ! empty( $value ) ){
                            foreach ( $value as $attribute ) {
                                $html .= ' ' . esc_attr( $attribute );
                            }
                        }
                        continue;
                    }
                    if ( 'href' === $key ) {
                        $html .= ' ' . esc_attr( $key ) . '="' . esc_url_raw( $value ) . '"';
                    }
                    $html .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
                }
            }
            if ( $is_end ) {
                $html .= $self_closing ? '/>' : '>';
            }
            return $html;
        }

        private static function set_content( $content, $content_have_html ){
            $html = '';
            if ( $content_have_html ){
                $html .= $content;
            }
            else {
                $html .= esc_html__( $content,'the-one' );
            }
            return $html;
        }

        public static function custom_tag( $tag, $content = '', $is_self_closing = false, $args = [], $content_have_html = false ){
            $html = '<' . $tag;
            $html .= HTML::set_class_id_params( $args, true, $is_self_closing );
            $html .= HTML::set_content( $content, $content_have_html );
            $html .= $is_self_closing ? '' : '</' . $tag . '>';
            return $html;
        }

        /**
         * generate HTML <P>...</p> entity (i.e. paragrapgh tag)
         *
         * @param string $content
         * @param array $args [optional]
         * @param bool $content_have_html
         * @return string
         * @example-> [ 
         *       'class' => 'quick silver',
         *       'id' => 'x-man',
         *       'inline-args' => 
         *       [ 
         *           'attributes' => 
         *           [ 
         *               'hidden', 
         *               'disable', 
         *               'checked' 
         *           ], 
         *           'data' => 'smart-para',
         *           'onclick' => 'show_yellow_alert()'
         *       ] 
         *   ]
         */
        public static function p_tag( $content, $args = [], $content_have_html = false ){
            // $html = '<p';
            // $html .= HTML::set_class_id_params( $args, true );
            // $html .= HTML::set_content( $content, $content_have_html );
            // $html .= '</p>';
            // return $html;
            return HTML::custom_tag( 'p', $content, false, $args, $content_have_html );
        }

        public static function span_tag( $content, $args = [], $content_have_html = false ){
            // $html = '<p';
            // $html .= HTML::set_class_id_params( $args, true );
            // $html .= HTML::set_content( $content, $content_have_html );
            // $html .= '</p>';
            // return $html;
            return HTML::custom_tag( 'span', $content, false, $args, $content_have_html );
        }
        
        public static function label_tag( $content, $for, $args = [], $content_have_html = false ){
            // $html = '<label';
            // $html .= ' for="' . esc_attr( $for ) . '"';
            // $html .= HTML::set_class_id_params( $args, true );
            // $html .= HTML::set_content( $content, $content_have_html );
            // $html .= '</label>';
            // return $html;
            $tag_specific_params = [ 'for' => $for ];
            $args = wp_parse_args( $args, $tag_specific_params );
            return HTML::custom_tag( 'label',  $content, false, $args, $content_have_html);

        }

        public static function input_tag( $type, $args = [] ){
            // $html = '<input';
            // $html .= ' type="' . esc_attr( $type ) . '"';
            // $html .= HTML::set_class_id_params( $args, true, true );
            // return $html;
            $tag_specific_params = [ 'type' => $type ];
            $args = wp_parse_args( $args, $tag_specific_params );
            return HTML::custom_tag( 'input','', true, $args, true );
        }

        public static function div_tag( $content, $content_have_html, $args = [] ){
            return HTML::custom_tag( 'div', $content, false, $args, $content_have_html );
        }

        public static function form_tag( $content, $method, $action, $args = [] ){
            $tag_specific_params = [
                'method' => $method,
                'action' => $action
            ];
            $args = wp_parse_args( $args, $tag_specific_params );
            return HTML::custom_tag( 'form', $content, false, $args, true );
        }

        public static function heading_tag( $level, $content, $args = [], $content_have_html = false ){
            return HTML::custom_tag( 'h' . $level, $content, false, $args, $content_have_html );
        }

    }
?>

