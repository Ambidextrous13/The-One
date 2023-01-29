<ul class="archives_list list_style">
<?php
    $settings = [
        'limit' => isset( $args['max_items'] ) ? $args['max_items'] : 7,
        'show_post_count' => '1',

    ];
    echo wp_get_archives( $settings );
?>
</ul>
