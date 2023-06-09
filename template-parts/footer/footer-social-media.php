<?php
/**
 * Template Part: Footer Social media.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

use THE_ONE\Inc\Classes\HTML;
use THE_ONE\Inc\Classes\Settings;
$metas = Settings::give_selected_social_media_handles();
foreach ( $metas as $_ => $meta ) {
	//phpcs:ignore -- data sanitizing is taken care by HTML class itself
	echo HTML::custom_tag(
		'li',
		HTML::custom_tag(
			'a',
			html::custom_tag( 'i', '', false, [ 'class' => $meta['icon'] ] ),
			false,
			[
				'class'          => $meta['class'],
				'href'           => $meta['link'],
				'data-placement' => 'top',
				'data-toggle'    => 'tooltip',
				'title'          => $meta['title'],
			],
			true
		),
		false,
		[],
		true
	);
}
