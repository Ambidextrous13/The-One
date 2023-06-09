<?php
/**
 * Template Part:  Main Menu.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

use THE_ONE\Inc\Classes\Menus;
$menu_instance = Menus::get_instance();
$menu_location = 'the-one-header-menu';

$menus = $menu_instance->get_one_step_minimized_menu( $menu_location );

if ( is_array( $menus ) && ! empty( $menus ) ) {
	?>


<div class="col-lg-9 col-sm-9 navbar navbar-default navbar-static-top container" role="navigation">
	<!--  <div class="container">-->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'the-one' ); ?></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
	<?php
	the_one_print_menu( $menus );
} else {
		the_one_admin_note( 'Here goes your Nav Menu', 'nav-menu', '#nav-menus-frame' );
}
?>
		</ul>
	</div>
</div>

