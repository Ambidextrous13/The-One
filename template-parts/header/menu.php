<?php
    use THE_ONE\Inc\Classes\Menus;
    $menu_instance = Menus::get_instance();
    $menu_location = 'the-one-header-menu';
    
    $menu =  $menu_instance -> get_one_step_minimized_menu( $menu_location );
?>


<div class="col-lg-9 col-sm-9 navbar navbar-default navbar-static-top container" role="navigation">
    <!--  <div class="container">-->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">

        <?php foreach ($menu as $id => $element) { ?>

            <li><a href="<?php esc_url( $element[ 'url' ] ) ?>"><span class="data-hover"data-hover="<?php esc_html_e( $element[ 'title' ], 'the-one' ) ?>"><?php esc_html_e( $element[ 'title' ], 'the-one' ) ?></span></a>
        
        <?php   if( $element[ 'has_child' ] ){ ?>

                <ul class="dropdown-menu">

        <?php       foreach ($element[ 'children' ] as $id => $child) { ?>
            
                    <li><a href="<?php esc_url( $child[ 'url' ] ) ?>"><?php esc_html_e( $child[ 'title' ], 'the-one' ) ?></a></li>
       
        <?php       } ?>

                </ul>

        <?php   }  ?>
            </li>
        <?php } ?>
            
        </ul>
    </div>
</div>