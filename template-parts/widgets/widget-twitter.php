<?php
    // print_r($args);
    $tweet1 = (json_decode( json_decode( $args['embed_1'],true )[ 'text' ], true ) );
    $tweet2 = (json_decode( json_decode( $args['embed_2'],true )[ 'text' ], true ) );

    function short_text( $text, $limit = 50 ){
        if( $limit < strlen( $text ) ){
            return substr( $text, 0, strpos( $text, ' ', $limit-5 ) ? strpos( $text, ' ', $limit-5 ) : -1 ) . '[...]';
        }
        return $text . '[...]';
    }

?>

<div class="widget_content">
    <ul class="tweet_list">
        <li class="tweet_content item">
            <p class="tweet_link"><a href="<?php esc_attr_e( $tweet1[ 'link' ] ); ?>"><?php esc_attr_e( $tweet1[ 'author' ] ); ?> </a> <?php esc_attr_e( short_text( $tweet1[ 'text' ] ) ); ?></p>
            <span class="time"><?php esc_attr_e( $tweet1[ 'date' ] ); ?></span>
        </li>
        <li class="tweet_content item">
            <p class="tweet_link"><a href="<?php esc_attr_e( $tweet2[ 'link' ] ); ?>"><?php esc_attr_e( $tweet2[ 'author' ] ); ?> </a> <?php esc_attr_e( short_text( $tweet2[ 'text' ] ) ); ?></p>
            <span class="time"><?php esc_attr_e( $tweet2[ 'date' ] ); ?></span>
        </li>
    </ul>
</div>


