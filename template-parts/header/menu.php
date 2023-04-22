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
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">

	<?php
	foreach ( $menus as $id_ => $element ) {
		?>

			<li><a href="<?php echo esc_url( $element['url'] ); ?>"><span class="data-hover"data-hover="<?php echo esc_html( $element['title'] ); ?>"><?php echo esc_html( $element['title'] ); ?></span></a>	
		<?php
		if ( $element['has_child'] ) {
			?>

				<ul class="dropdown-menu">

			<?php
			foreach ( $element['children'] as $id_ => $child ) {
				?>
				<li><a href="<?php echo esc_url( $child['url'] ); ?>"><?php echo esc_html( $child['title'] ); ?></a></li>
	   
				<?php
			}
			?>
				</ul>

			<?php
		}
		?>
			</li>

		<?php
	}
} else {
		admin_note( 'Here goes your Nav Menu', 'nav-menu', '#nav-menus-frame' );
}
?>
		</ul>
	</div>
</div>
