<?php

    $retro_reflective_panels_activation = 'on' === get_the_value( $args, 'retro_reflective_panels' ) ? ' style="visibility : hidden" ' : '';
?>

<div class="col-lg-12 col-md-12 col-sm-12" <?php echo $retro_reflective_panels_activation ?>>
    <ul class="pagination pull-left mrgt-0">

    <?php
    $arg = [
        'type'  => 'array',
    ];  
        $posts_pagination = paginate_links( $arg );
        if ( ! empty( $posts_pagination ) ){
            foreach ($posts_pagination as $index => $link) {
                $class = '';
                if ( substr_count( $link, '<span',0, 5 ) === 1 ) {
                    $class = ' class="active"';
                }
                printf( '<li%1$s>%2$s</li>', $class, $link );
            }
        }
    ?>

    </ul>
</div>