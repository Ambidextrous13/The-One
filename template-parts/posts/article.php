<?php 
    $single_post_link = get_permalink( ); 

    $src = '__NEEDS_TO_FILL__'; 
    if( has_post_thumbnail( ) ) {
        $src = get_the_post_thumbnail_url( '', 'indexing-size' );
    }

    $bordered = [];
    $serialized_data = '';
    if ( '' !== get_post_meta( get_the_ID(  ), 't-o-p-b-checkbox', true ) ) {
        $bordered = [
            'bordered?'      => true,
            'thickness'      => get_post_meta( get_the_ID(  ), 't-o-p-b-thickness', true ),
            'color'          => get_post_meta( get_the_ID(  ), 't-o-p-b-color'    , true ),
            'padding'        => get_post_meta( get_the_ID(  ), 't-o-p-b-padding'  , true ),
            'border_pattern' => get_post_meta( get_the_ID(  ), 't-o-p-b-pattern'  , true )
        ];

        $serialized_data = '?' . $bordered[ 'thickness' ] . 'px ' . $bordered[ 'border_pattern' ] . ' ' . $bordered[ 'color' ] . '?' . $bordered[ 'padding' ] . 'px?';
    }else{
        $bordered = false;
    }

   
?>
<article class="post">
    <figure class="post_img">
        <a href="<?php echo esc_url( $single_post_link, 'the-one' ); ?>">
            <img src="<?php esc_html_e( $src, 'the-one' ); ?>" alt="blog post" class="<?php $bordered ? esc_html_e( 'border-it', 'the-one' ) : '' ?>" data="<?php echo $serialized_data ?>">
        </a>
    </figure>
    <div class="post_date">
        <span class="day"><?php the_time( 'd' ); ?></span>
        <span class="month"><?php the_time( 'M' ); ?></span>
    </div>
    <div class="post_content">
        <div class="post_meta">
            <h2>
                <a href="<?php echo esc_url( $single_post_link ); ?>"><?php the_title( ); ?></a>
            </h2>
            <div class="metaInfo">
                <span><i class="fa fa-calendar"></i> <a href="#"><?php the_time( 'M d, Y' ); ?></a> </span>
                <span><i class="fa fa-user"></i> <?php _e( 'By', 'the-one' ); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author( ); ?></a> </span>
                
                <span><i class="fa fa-tag"></i> <?php the_tags( '', ', ' ); ?> </span>
                <span><i class="fa fa-comments"></i> <a href="<?php echo esc_url( $single_post_link ); ?>"><?php echo get_comments_number( ). ' ' . __( 'Comments','the-one' ); ?></a></span>
            </div>
        </div>
        <?php the_excerpt( ); ?>
        <a class="btn btn-small btn-default" href="<?php echo esc_url( $single_post_link ); ?>"><?php _e( 'Read More', 'the-one' ); ?></a>
    </div>
</article>