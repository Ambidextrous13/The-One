<ul class="tags">
<?php   
    $max_items = 13;
    if ( isset( $args[ 'max_items' ] ) ) {
        $max_items = $args[ 'max_items' ];
    }

    $tags = get_categories( [
        'taxonomy' => 'post_tag',
        'orderby' => 'count',
        'order' => 'DSC',
        'number' => $max_items,
    ] );

    $bold_percent = 30;
    if ( isset( $args[ 'bold_percent' ] ) ) {
        $bold_percent = $args[ 'bold_percent' ];
    } 
    $total_tags = count( $tags );
    $per_tag_percentage = 100 / $total_tags;
    $html = [];
    foreach ( $tags as $tag ) {
        $tag_link = get_term_link( $tag, 'post_tag' );
        $tag_name = $tag -> name;
        $bold_close = '';
        $bold_open = '';
        if ( $bold_percent > 0 && $bold_percent <= 100 ){
            $bold_percent -= $per_tag_percentage;
            $bold_open = '<b>';
            $bold_close = '</b>';
        }

        $dice = random_int( 0, $total_tags - 1 );

        if( ! isset( $html[ $dice ] ) ){
            $html[ $dice ] = sprintf( '<li><a href="%1$s">%2$s%3$s%4$s</a></li>', $tag_link, $bold_open, $tag_name, $bold_close );
        }
        else { 
            $get_place = false;
            $counter = 1;
            while ( ! $get_place ) {
                $lower_place = $dice - $counter;
                $higher_place = $dice + $counter;
                if ( $lower_place >= 0 && ! isset( $html[ $lower_place ] ) ) {
                    $html[ $lower_place ] = sprintf( '<li><a href="%1$s">%2$s%3$s%4$s</a></li>', $tag_link, $bold_open, $tag_name, $bold_close );
                    $get_place = true;
                }
                elseif ( $higher_place <= $total_tags && ! isset( $html[ $higher_place ] ) ) {
                    $html[ $higher_place ] = sprintf( '<li><a href="%1$s">%2$s%3$s%4$s</a></li>', $tag_link, $bold_open, $tag_name, $bold_close );
                    $get_place = true;
                }
                if ( $counter > $total_tags ) {
                    break;
                }
                $counter += 1;
            }  
        }
    }
    for ( $i = 0; $i < $total_tags ; $i++ ) { 
        if ( isset( $html[ $i ] ) ){
            echo $html[ $i ];
        }
    }
?>
</ul>