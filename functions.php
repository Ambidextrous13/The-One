<?php
    define( 'THE_BASE', get_template_directory(  ) . '/' ); // for absolute location used at filemtime
    define('ABS_DEV_ASSETS_PATH', THE_BASE . 'assets/src/' );
    define('ABS_THE_ONE_JS', ABS_DEV_ASSETS_PATH . 'js/' );
    define('ABS_THE_ONE_CSS', ABS_DEV_ASSETS_PATH . 'css/' );

    define( 'THE_ROOT', untrailingslashit( get_template_directory_uri() ) . '/' );
    define('DEV_ASSETS_PATH', THE_ROOT . 'assets/src/' );
    define('THE_ONE_JS', DEV_ASSETS_PATH . 'js/' );
    define('THE_ONE_CSS', DEV_ASSETS_PATH . 'css/' );
    
    require_once THE_BASE . 'inc/helpers/autoloader.php';
    
    function _init_(){
        return THE_ONE\inc\classes\THE_ONE::get_instance();    
    }
   
    $theme_instance = _init_();