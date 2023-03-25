<?php
    
    namespace THE_ONE\Inc\Classes;
    use THE_ONE\Inc\Traits\Singleton;
    use THE_ONE\Inc\Classes\HTML;

    class Settings{
        use Singleton;

        private function __construct(){
            $this->setup_hooks();
        }

        private function setup_hooks(){
            add_action( 'admin_menu', [ $this, 'show_settings_page' ] );
            add_action( 'admin_init', [ $this, 'settings_builder' ] );
        }

        public function show_settings_page(){
            add_theme_page( 'The One Settings', 'Theme Settings', 'edit_theme_options', 'the_one_settings', [ $this, 'page_loader' ], 5 );
        }

        public static function page_loader(){  // front end
            suppress_the_echo();
            
            settings_fields( 'settings' ) .
            do_settings_sections( 'the_one_settings' ) . // append all setting between settings_fields and submit_button
            
            submit_button();

            $form_elements = echo_to_returnable();

            echo    HTML::div_tag(
                        HTML::heading_tag( '1', 'The One Theme Settings', [], false ) . 
                        HTML::form_tag( 
                            $form_elements, 'POST', 'options.php'
                        ), true
                    );
        }

        public function settings_builder(){ 
            self::back_end_register();
            self::sections_registration( $this );
            self::fields_registration( $this );
            self::settings_registration();
            
        }
        
        public static function back_end_register(){
            add_option( 'the_one_infinite_scroll'     , 0  );
            add_option( 'company_address'             , '' );
            add_option( 'country_code'                , '' );
            add_option( 'contact_number'              , '' );
            add_option( 'contact_email'               , '' );
            add_option( 'social_media_facebook_check' , '' );
            add_option( 'social_media_twitter_check'  , '' );
            add_option( 'social_media_instagram_check', '' );
            add_option( 'social_media_skype_check'    , '' );
            add_option( 'social_media_linkedin_check' , '' );
            add_option( 'social_media_facebook'       , 'https://www.facebook.com/'  );
            add_option( 'social_media_twitter'        , 'https://www.twitter.com/'   );
            add_option( 'social_media_instagram'      , 'https://www.instagram.com/' );
            add_option( 'social_media_skype'          , 'https://www.skype.com/'     );
            add_option( 'social_media_linkedin'       , 'https://www.linkedin.com/'  );
            
        }
        
        public static function sections_registration( $instance ){
            add_settings_section( 'general_settings'    , 'General Settings', [ $instance, 'general_section_html' ],'the_one_settings' );
            add_settings_section( 'social_media_handles', 'Social Media'    , [ $instance, 'general_section_html' ],'the_one_settings' );
            
        }
        
        public static function fields_registration( $instance ){
            add_settings_field( 'infinite_scroll' , 'Infinite Scroll', [ $instance, 'infinite_scroll_html' ], 'the_one_settings', 'general_settings' );
            add_settings_field( 'e_mail'          , 'Contact Email'  , [ $instance, 'contact_email_html'   ], 'the_one_settings', 'general_settings' );
            add_settings_field( 'contact_number'  , 'Contact Number' , [ $instance, 'contact_number_html'  ], 'the_one_settings', 'general_settings' );
            add_settings_field( 'address_field'   , 'Company Address', [ $instance, 'company_address_html' ], 'the_one_settings', 'general_settings' );
            
            add_settings_field( 'social_media_facebook' , 'Facebook Handle'    , [ $instance, 'facebook_input'  ], 'the_one_settings', 'social_media_handles' );
            add_settings_field( 'social_media_twitter'  , 'Twitter Handle'     , [ $instance, 'twitter_input'   ], 'the_one_settings', 'social_media_handles' );
            add_settings_field( 'social_media_instagram', 'instagram Link'     , [ $instance, 'instagram_input' ], 'the_one_settings', 'social_media_handles' );
            add_settings_field( 'social_media_skype'    , 'Skype Group/ Handle', [ $instance, 'skype_input'     ], 'the_one_settings', 'social_media_handles' );
            add_settings_field( 'social_media_linkedin' , 'linkedin Link'      , [ $instance, 'linkedin_input'  ], 'the_one_settings', 'social_media_handles' );
            
            
        }
        public static function settings_registration( ){
            register_setting( 'settings', 'the_one_infinite_scroll' );
            register_setting( 'settings', 'contact_email'           );
            register_setting( 'settings', 'country_code'            );
            register_setting( 'settings', 'contact_number'          );
            register_setting( 'settings', 'company_address'         );   

            register_setting( 'settings', 'social_media_facebook'       );
            register_setting( 'settings', 'social_media_facebook_check' );
            register_setting( 'settings', 'social_media_twitter'        );
            register_setting( 'settings', 'social_media_twitter_check'  );
            register_setting( 'settings', 'social_media_instagram'      );
            register_setting( 'settings', 'social_media_instagram_check');
            register_setting( 'settings', 'social_media_skype'          );
            register_setting( 'settings', 'social_media_skype_check'    );
            register_setting( 'settings', 'social_media_linkedin'       );
            register_setting( 'settings', 'social_media_linkedin_check' );
            
            
        }

        public function general_section_html(){  // section html
            return null;
        }

        public function infinite_scroll_html(){  // filed html 
            $the_key = 'the_one_infinite_scroll';
            $option_value = get_option( $the_key );
            $args_for_checkbox = [
                'class'      => 'fields',
                'name'       => $the_key,
                'id'         => $the_key,
                'attributes' => [
                    checked( 'on', $option_value, false )
                ]
            ];

            if ( false !== $option_value ) {
                echo    HTML::div_tag(
                            HTML::label_tag( 'Infinite Scroll Mode?', $the_key ) . 
                            HTML::input_tag( 'checkbox', $args_for_checkbox ), true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }

        public function contact_email_html(){  // filed html 
            $the_key = 'contact_email';
            $option_value = get_option( $the_key );
            $args_for_email = [
                'class'      => 'fields',
                'name'       => $the_key,
                'id'         => $the_key,
                'value'      => $option_value,
                'style'      => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between'
            ];

            if ( false !== $option_value ) {
                echo    HTML::div_tag(
                            HTML::label_tag( 'Public Email Address', $the_key ) . 
                            HTML::input_tag( 'email', $args_for_email ), true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }

        public function contact_number_html(){  // filed html 
            $the_key_0 = 'country_code';
            $the_key_1 = 'contact_number';
            $option_value_0 = get_option( $the_key_0 );
            $option_value_1 = get_option( $the_key_1 );

            $args_for_country_code = [
                'class'      => 'fields',
                'name'       => $the_key_0,
                'id'         => $the_key_0,
                'value'      => $option_value_0,
                'pattern'    => '^\d{1,3}$',
                'style'      => 'width : 50px'
            ];

            $args_for_number = [
                'class'      => 'fields',
                'name'       => $the_key_1,
                'id'         => $the_key_1,
                'value'      => $option_value_1,
                'pattern'    => '[6-9]{1}[0-9]{9}',
                'style'      => 'width : 250px'
            ];

            if ( $option_value_0 && $option_value_1  ) {
                echo    HTML::div_tag(
                            HTML::label_tag( 'Contact Number(Numbers Only)', $the_key_1 ) .
                            html::div_tag(
                                html::div_tag(  
                                    HTML::span_tag( '+' ) . 
                                    html::input_tag( 'tel', $args_for_country_code ), 
                                    true 
                                )  .
                                HTML::input_tag( 'tel', $args_for_number ), 
                                true , ['style' => 'display: flex; justify-content: space-between' ]
                            )
                            , true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }
        public function company_address_html(){
            $the_key = 'company_address';
            $option_value = get_option( $the_key );
            $args_for_email = [
                'class'      => 'fields',
                'name'       => $the_key,
                'id'         => $the_key,
                'value'      => $option_value,
                'style'      => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between'
            ];

            if ( false !== $option_value ) {
                echo    HTML::div_tag(
                            HTML::label_tag( 'Public Email Address', $the_key ) . 
                            HTML::input_tag( 'text', $args_for_email ), true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }

        public function text_input( $the_key, $label ){
            $option_value = get_option( $the_key );
            $args_for_field = [
                'class'      => 'fields',
                'name'       => $the_key,
                'id'         => $the_key,
                'value'      => $option_value,
                'style'      => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between'
            ];

            if ( false !== $option_value ) {
                echo    HTML::div_tag(
                            HTML::label_tag( $label, $the_key ) . 
                            HTML::input_tag( 'text', $args_for_field ), true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }

        public function text_input_with_select( $field_key, $checkbox_key, $label, $controls ){
            $field_value = get_option( $field_key );
            $args_for_field = [
                'class'      => 'fields',
                'name'       => $field_key,
                'id'         => $field_key,
                'value'      => $field_value,
                'style'      => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between'
            ];

            $checkbox_value = get_option( $checkbox_key );
            $args_for_checkbox = [
                'class'      => 'fields',
                'name'       => $checkbox_key,
                'id'         => $checkbox_key,
                'attributes' => [
                    checked( 'on', $checkbox_value, false )
                ],
                'controls'   => $controls
            ];

            $div_args = [
                'id'    => $controls,
                'style' => 'width: 600px; display: flex; justify-content: space-between'
            ];

            if ( false !== $field_value && false !== $checkbox_value ) {
                echo    HTML::div_tag(
                            HTML::input_tag( 'checkbox', $args_for_checkbox ) .
                            HTML::div_tag(
                                HTML::label_tag( $label, $field_key ) . 
                                HTML::input_tag( 'text', $args_for_field ),
                                true,
                                $div_args 
                            ), true, [ 'style' => 'max-width: 700px; display: flex; justify-content: space-between; align-items: center; height: 30px' ]
                        );
            }else {
                echo 'error please contact the developer';
            }
        }

        public function facebook_input(){
            $this->text_input_with_select( 'social_media_facebook', 'social_media_facebook_check', 'your facebook page/ profile link', 'facebook_links' );
        }
        public function twitter_input(){
            $this->text_input_with_select( 'social_media_twitter', 'social_media_twitter_check', 'your twitter page/ profile link', 'twitter_link' );
        }
        public function instagram_input(){
            $this->text_input_with_select( 'social_media_instagram', 'social_media_instagram_check', 'your instagram page/ profile link', 'dribble_link' );
        }
        public function skype_input(){
            $this->text_input_with_select( 'social_media_skype', 'social_media_skype_check', 'your skype page/ profile link', 'skype_link' );
        }
        public function linkedin_input(){
            $this->text_input_with_select( 'social_media_linkedin', 'social_media_linkedin_check', 'your linkedin page/ profile link', 'linkedin_link' );
        }

        public static function social_media_handles(){
            $social_links =  [ 
                'facebook' => [ 
                    'enable' => get_option( 'social_media_facebook_check' ),
                    'value'  => get_option( 'social_media_facebook' )
                ], 
                'twitter' => [
                    'enable' => get_option( 'social_media_twitter_check' ),
                    'value'  => get_option( 'social_media_twitter' )
                ],
                'instagram' => [
                    'enable' => get_option( 'social_media_instagram_check' ),
                    'value'  => get_option( 'social_media_instagram' )
                ],
                'skype' => [
                    'enable' => get_option( 'social_media_skype_check' ),
                    'value'  => get_option( 'social_media_skype' )
                ],
                'linkedin' => [
                    'enable' => get_option( 'social_media_linkedin_check' ),
                    'value'  => get_option( 'social_media_linkedin' )
                ],
            ];
            $returnable = []; 
            foreach ( $social_links as $meta => $data ) {
                if( get_the_value( $data, 'enable', false ) && get_the_value( $data, 'value', false ) ){
                    $local_array = [
                        'class' => $meta,
                        'link'  => $data[ 'value' ],
                        'title' => $meta,
                        'icon'  => 'fa fa-' . $meta,
                    ];
                    array_push( $returnable, $local_array );
                }
            }
            return $returnable;

        }

    }

?>